<?php

require_once 'Matrix.php';
class GenerateMatrix
{
    public static function generate($rows, $cols): Matrix
    {
        $matrix = [];
        for ($i = 0; $i < $rows; ++$i) {
            for ($j = 0; $j < $cols; ++$j) {
                $matrix[$i][$j] = rand(1, 10);
            }
        }

        return new Matrix($rows, $cols, $matrix);
    }
}
