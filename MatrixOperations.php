<?php

class MatrixOperations
{
    public static function handleOperation($operation, Matrix $matrixA, Matrix $matrixB): Matrix
    {
        switch ($operation) {
            case 'add':
                return MatrixCalculator::add($matrixA, $matrixB);

            case 'subtract':
                return MatrixCalculator::subtract($matrixA, $matrixB);

            case 'multiply':
                return MatrixCalculator::multiply($matrixA, $matrixB);

            case 'transpose_A':
                return MatrixCalculator::transpose($matrixA);

            case 'transpose_B':
                return MatrixCalculator::transpose($matrixB);

            default:
                throw new Exception('Invalid operation');
        }
    }
}
