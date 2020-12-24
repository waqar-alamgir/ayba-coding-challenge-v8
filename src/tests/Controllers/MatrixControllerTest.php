<?php

declare(strict_types=1);

// Cannot provide namcespace here.

class MatrixControllerTest extends TestCase
{
    /**
     * Tests final multiplication
     *
     * @return void
     */
    public function testGetProduct()
    {
        $matrixA = [
            [1, 1, 4],
            [1, 1, 5]
        ];

        $matrixB = [
            [1, 1],
            [1, 1],
            [1, 1]
        ];

        $result = [
            'result' => 'success',
            'data' => [
                ['F', 'F'],
                ['G', 'G']
            ]
        ];

        $this->post('api/v1/matrix', ['matrixA' => $matrixA, 'matrixB' => $matrixB]);

        $this->assertEquals(
            json_encode($result),
            $this->response->getContent()
        );
    }
}
