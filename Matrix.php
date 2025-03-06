<?php

class Matrix
{
    private array $data;
    private int $rows;
    private int $cols;

    public function __construct($rows, $cols, $data = null)
    {
        $this->rows = $rows;
        $this->cols = $cols;
        $this->data = $data ?: array_fill(0, $rows, array_fill(0, $cols, 0));
    }

    public function getData()
    {
        return $this->data;
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function getCols(): int
    {
        return $this->cols;
    }

}
