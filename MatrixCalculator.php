<?php

class MatrixCalculator
{
    public static function add(Matrix $matrixA, Matrix $matrixB): Matrix
    {
        $matrixAData = $matrixA->getData();
        $matrixBData = $matrixB->getData();
        $result = [];
        for ($i = 0; $i < $matrixA->getRows(); ++$i) {
            for ($j = 0; $j < $matrixA->getCols(); ++$j) {
                $result[$i][$j] = $matrixAData[$i][$j] + $matrixBData[$i][$j];
            }
        }

        return new Matrix($matrixA->getRows(), $matrixA->getCols(), $result);
    }

    public static function subtract(Matrix $matrixA, Matrix $matrixB): Matrix
    {
        $matrixAData = $matrixA->getData();
        $matrixBData = $matrixB->getData();
        $result = [];
        for ($i = 0; $i < $matrixA->getRows(); ++$i) {
            for ($j = 0; $j < $matrixA->getCols(); ++$j) {
                $result[$i][$j] = $matrixAData[$i][$j] - $matrixBData[$i][$j];
            }
        }

        return new Matrix($matrixA->getRows(), $matrixA->getCols(), $result);
    }

    public static function multiply(Matrix $matrixA, Matrix $matrixB): Matrix
    {
        $matrixAData = $matrixA->getData();
        $matrixBData = $matrixB->getData();
        $result = [];
        for ($i = 0; $i < $matrixA->getRows(); ++$i) {
            for ($j = 0; $j < $matrixB->getCols(); ++$j) {
                $result[$i][$j] = 0;
                for ($k = 0; $k < $matrixA->getCols(); ++$k) {
                    $result[$i][$j] += $matrixAData[$i][$k] * $matrixBData[$k][$j];
                }
            }
        }

        return new Matrix($matrixA->getRows(), $matrixB->getCols(), $result);
    }

    public static function transpose(Matrix $matrix): Matrix
    {
        $rows = $matrix->getCols();
        $cols = $matrix->getRows();
        $result = [];

        for ($i = 0; $i < $rows; ++$i) {
            for ($j = 0; $j < $cols; ++$j) {
                $result[$i][$j] = $matrix->getData()[$j][$i];
            }
        }

        return new Matrix($rows, $cols, $result);
    }
}
