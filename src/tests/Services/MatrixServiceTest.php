<?php

declare(strict_types=1);

// Cannot provide namcespace here.

use App\Services\MatrixService;

class MatrixServiceTest extends TestCase
{
    /**
     * Providing data for testing integers to alphabets conversion.
     */
    public function providerTestCharacterize()
    {
        return array(
            array(1, 'A'),
            array(2, 'B'),
            array(6, 'F'),
            array(26, 'Z'),
            array(27, 'AA'),
            array(28, 'AB'),
            array(51, 'AY'),
            array(52, 'AZ'),
            array(53, 'BA'),
            array(54, 'BB'),
            array(77, 'BY'),
            array(78, 'BZ'),
        );
    }

    /**
     * Testing integers to alphabets conversion.
     *
     * @dataProvider providerTestCharacterize
     */
    public function testCharacterize($input, $expectedResult)
    {
        $matrix = new MatrixService();
        $result = $matrix->characterize($input);
        return $this->assertEquals($expectedResult, $result);
    }

    /**
     * Providing data for testing sum.
     */
    public function providerTestCalculateSum()
    {
        return array(
            array([1], [1], 1),
            array([1, 2, 3], [1, 2, 3], 14),
            array([2, 2], [2, 2], 8),
            array([3, 1, 8], [1, 9, 0], 12),
        );
    }

    /**
     * Testing sum.
     *
     * @dataProvider providerTestCalculateSum
     */
    public function testCalculateSum($inputA, $inputB, $expectedResult)
    {
        $matrix = new MatrixService();
        $result = $matrix->calculateSum($inputA, $inputB);
        return $this->assertEquals($expectedResult, $result);
    }

    /**
     * Providing data for testing array shift.
     */
    public function providerTestArrayShiftKey()
    {
        return array(
            array(
                [
                    [0, 1, 4],
                    [0, 2, 5],
                    [0, 3, 6]
                ],
                0,
                [0, 0, 0]
            ),
            array(
                [
                    [0, 1, 4],
                    [0, 2, 5],
                    [0, 3, 6]
                ],
                1,
                [1, 2, 3]
            ),
            array(
                [
                    [0, 1, 4],
                    [0, 2, 5],
                    [0, 3, 6]
                ],
                2,
                [4, 5, 6]
            ),
        );
    }

    /**
     * Testing array shift.
     *
     * @dataProvider providerTestArrayShiftKey
     */
    public function testArrayShiftKey($inputA, $inputB, $expectedResult)
    {
        $matrix = new MatrixService();
        $result = $matrix->arrayShiftKey($inputA, $inputB);
        return $this->assertEquals($expectedResult, $result);
    }

    /**
     * Providing data for testing matrix multiplication.
     */
    public function providerTestGetMultiplication()
    {
        return array(
            array(
                [
                    [1, 1, 4],
                    [1, 1, 5],
                ],
                [
                    [1, 1],
                    [1, 1],
                    [1, 1],
                ],
                [
                    ['F', 'F'],
                    ['G', 'G'],
                ],
            ),
            array(
                [
                    [2, 1, 4],
                    [1, 3, 5],
                ],
                [
                    [1, 1],
                    [1, 1],
                    [1, 1],
                ],
                [
                    ['G', 'G'],
                    ['I', 'I'],
                ],
            ),
        );
    }

    /**
     * Testing matrix multiplication.
     *
     * @dataProvider providerTestGetMultiplication
     */
    public function testGetMultiplication($inputA, $inputB, $expectedResult)
    {
        $matrix = new MatrixService();
        $result = $matrix->getMultiplication($inputA, $inputB);
        return $this->assertEquals($expectedResult, $result);
    }
}
