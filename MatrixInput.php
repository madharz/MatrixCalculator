<?php

class MatrixInput
{
    public static function input($rows, $cols, $inputData): Matrix
    {
        $matrix = [];
        $index = 0;
        for ($i = 0; $i < $rows; ++$i) {
            for ($j = 0; $j < $cols; ++$j) {
                $matrix[$i][$j] = $inputData[$index++];
            }
        }

        return new Matrix($rows, $cols, $matrix);
    }
}
