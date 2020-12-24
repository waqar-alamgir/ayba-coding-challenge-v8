<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Rules\SelfMatrix;
use App\Services\MatrixService;

/*
|--------------------------------------------------------------------------
| MatrixController
|--------------------------------------------------------------------------
|
| This controller handles matrix multiplication end-point.
|
*/

class MatrixController extends Controller
{
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MatrixService $service)
    {
        $this->service = $service;
    }

    /**
     * Calculates matrix product from the input parameters.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getProduct(Request $request): JsonResponse
    {
        $selfMatrixRule = new SelfMatrix();
        $matrixA = isset($request->matrixA) ? $request->matrixA : [[]];

        // Validation:
        // For Matrix multiplication, the column count in the first matrix should
        // be equal to the row count of the second matrix. If this condition is not
        // met, the app should throw a validation error.
        $validator = Validator::make($request->all(), [
            'matrixA'  => [
                'bail',
                'required',
                'array',
                $selfMatrixRule
            ],
            'matrixB' => [
                'bail',
                'required',
                'array',
                $selfMatrixRule,
                'size:' . count($matrixA[0])
            ]
        ]);

        // If validation fails then generate 422 error.
        if ($validator->fails()) {
            return response()->json([
                'result' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        // Matrices are valid. Perform matrix multiplication.
        $product = $this->service->getMultiplication(
            $request->matrixA,
            $request->matrixB
        );

        // Return json response.
        return response()->json([
            'result' => 'success',
            'data' => $product
        ]);
    }
}
