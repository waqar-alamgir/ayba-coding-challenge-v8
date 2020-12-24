<?php

declare(strict_types=1);

namespace App\Services;

/*
|--------------------------------------------------------------------------
| MatrixService
|--------------------------------------------------------------------------
|
| This service provides core matrix operations to calculate matrxi multiplications.
|
*/

class MatrixService
{
    /** @var array */
    protected $characters = [
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D',
        5 => 'E',
        6 => 'F',
        7 => 'G',
        8 => 'H',
        9 => 'I',
        10 => 'J',
        11 => 'K',
        12 => 'L',
        13 => 'M',
        14 => 'N',
        15 => 'O',
        16 => 'P',
        17 => 'Q',
        18 => 'R',
        19 => 'S',
        20 => 'T',
        21 => 'U',
        22 => 'V',
        23 => 'W',
        24 => 'X',
        25 => 'Y',
        26 => 'Z',
    ];

    /**
     * Multiply two matrices.
     *
     * @param array $matrixA
     * @param array $matrixB
     *
     * @return array
     */
    public function getMultiplication(array $matrixA, array $matrixB): array
    {
        $final = [];
        $total = count($matrixB[0]);

        // Looping through all matrix A values as rows.
        foreach ($matrixA as $key => $currentRow) {
            // Looping through all matrix B values as columns.
            for ($i = 0; $i < $total; $i++) {
                // Performing matrix multiplication.
                $currentColumn = $this->arrayShiftKey($matrixB, $i);
                $cellSum = $this->calculateSum($currentRow, $currentColumn);
                $final[$key][] = $this->characterize($cellSum);
            }
        }
        return $final;
    }

    /**
     * Converts columns into rows for matrix multiplication.
     *
     * @param array $arr Sub array.
     * @param int $index The index to use for each array.
     *
     * @return array
     */
    public function arrayShiftKey(array $arr, int $index): array
    {
        $t = [];
        foreach ($arr as $array) {
            $t[] = $array[$index];
        }
        return $t;
    }

    /**
     * Adds the product of two arrays.
     *
     * @param array $row
     * @param array $col
     *
     * @return int
     */
    public function calculateSum(array $row, array $col): int
    {
        $totalSum = 0;
        $total = count($row);

        // Looping through all rows and columns.
        for ($i = 0; $i < $total; $i++) {
            $totalSum += $row[$i] * $col[$i];
        }
        return $totalSum;
    }

    /**
     * Retrieves the alphabetic representation for the parameter.
     *
     * @param int $key
     *
     * @return string
     */
    public function characterize(int $key): string
    {
        $return = '';
        $totalChars = count($this->characters);
        $reminder = $key % $totalChars;
        $index = floor($key / $totalChars);

        // Checking if it is exactly multiple of 26.
        if ($reminder !== 0) {
            if ($index > 0) {
                $return = $this->characters[$index];
            }
            $return .= $this->characters[$reminder];
        } else {
            if ($index - 1 > 0) {
                $return = $this->characters[$index - 1];
            }
            // Adding last character i.e. Z.
            $return .= end($this->characters);
        }
        return $return;
    }
}
