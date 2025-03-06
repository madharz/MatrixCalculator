<?php

session_start();

require_once 'MatrixInput.php';

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $rows = isset($_POST['rows']) ? (int) $_POST['rows'] : 0;
    $cols = isset($_POST['cols']) ? (int) $_POST['cols'] : 0;
    $operation = $_POST['operation'] ?? '';

    if ($rows < 1 || $rows > 10 || $cols < 1 || $cols > 10) {
        echo 'Invalid matrix size';

        return;
    }

    $matrixInputService = new MatrixInput();
    $matrixA = $matrixInputService->input($_POST['matrixA'] ?? [], $rows, $cols);
    $matrixB = $matrixInputService->input($_POST['matrixB'] ?? [], $rows, $cols);

    if (!$matrixA || !$matrixB) {
        echo 'Invalid matrix data';

        return;
    }

    $_SESSION['matrixA'] = $matrixA;
    $_SESSION['matrixB'] = $matrixB;
    $_SESSION['rows'] = $rows;
    $_SESSION['cols'] = $cols;
    $_SESSION['operation'] = $operation;

    header('Location: MatrixOperations.php');

    exit;
}
