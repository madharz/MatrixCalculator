<?php
include 'Matrix.php';

include 'GenerateMatrix.php';

include 'MatrixInput.php';

include 'MatrixCalculator.php';

include 'MatrixOperations.php';

$operation = $_POST['operation'] ?? null;
$rows = $_POST['rows'] ?? 2;
$cols = $_POST['cols'] ?? 2;
$matrixA = null;
$matrixB = null;
$result = null;

if (isset($_POST['generate'])) {
    $matrixA = GenerateMatrix::generate($rows, $cols);
    $matrixB = GenerateMatrix::generate($rows, $cols);
}

if (isset($_POST['manual'])) {
    $matrixA = new Matrix($rows, $cols);
    $matrixB = new Matrix($rows, $cols);
}

if (isset($_POST['submit_manual'])) {
    $inputDataA = $_POST['matrixA'] ?? [];
    $inputDataB = $_POST['matrixB'] ?? [];
    if (!empty($inputDataA) && !empty($inputDataB)) {
        $matrixA = new Matrix($rows, $cols, $inputDataA);
        $matrixB = new Matrix($rows, $cols, $inputDataB);
    }
}

if (isset($_POST['execute'])) {
    try {
        $matrixA = new Matrix($rows, $cols, json_decode($_POST['matrixA'], true));
        $matrixB = new Matrix($rows, $cols, json_decode($_POST['matrixB'], true));

        $result = MatrixOperations::handleOperation($operation, $matrixA, $matrixB);
    } catch (Exception $e) {
        echo 'Exception: '.$e->getMessage();
    }
}

function renderMatrixTable(Matrix $matrix, $name = '')
{
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    foreach ($matrix->getData() as $i => $row) {
        echo '<tr>';
        foreach ($row as $j => $cell) {
            $inputName = "{$name}[{$i}][{$j}]";
            echo "<td><input type='number' name='{$inputName}' value='{$cell}' required></td>";
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Matrix Calculator</title>
</head>
<body>

<h1>Matrix Calculator</h1>

<form method="POST">
    <label>Rows:</label>
    <input type="number" name="rows" value="<?php echo $rows; ?>" required>

    <label>Cols:</label>
    <input type="number" name="cols" value="<?php echo $cols; ?>" required>

    <button type="submit" name="generate">Generate</button>
    <button type="submit" name="manual">Input</button>
</form>

<?php if ($matrixA && $matrixB) { ?>
    <form method="POST">
        <h2>Matrix A</h2>
        <?php renderMatrixTable($matrixA, 'matrixA'); ?>
        <h2>Matrix B</h2>
        <?php renderMatrixTable($matrixB, 'matrixB'); ?>
        <input type="hidden" name="rows" value="<?php echo $rows; ?>">
        <input type="hidden" name="cols" value="<?php echo $cols; ?>">
        <button type="submit" name="submit_manual">Save data</button>
    </form>

    <form method="POST">
        <input type="hidden" name="rows" value="<?php echo $rows; ?>">
        <input type="hidden" name="cols" value="<?php echo $cols; ?>">
        <input type="hidden" name="matrixA" value="<?php echo htmlspecialchars(json_encode($matrixA->getData())); ?>">
        <input type="hidden" name="matrixB" value="<?php echo htmlspecialchars(json_encode($matrixB->getData())); ?>">

        <label>Operation:</label>
        <select name="operation">
            <option value="add">Add</option>
            <option value="subtract">Subtract</option>
            <option value="multiply">Multiply</option>
            <option value="transpose_A">Transpose A</option>
            <option value="transpose_B">Transpose B</option>
        </select>
        <button type="submit" name="execute">Execute</button>
    </form>

    <?php if ($result) { ?>
        <h2>Result</h2>
        <?php renderMatrixTable($result); ?>
    <?php } ?>
<?php } ?>

</body>
</html>
