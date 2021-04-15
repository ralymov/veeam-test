<?php

//PHP.Найти первые три числа больше заданного в отсортированном массиве.

//Without missing number
function findNumbers(array $array, float $inputNumber): array
{
    $inputNumberIndex = array_search($inputNumber, $array);
    if ($inputNumberIndex === false) {
        $inputNumberIndex = -1;
    }
    return array_slice($array, $inputNumberIndex + 1, 3);
}

//With missing numbers - binary search closest to $inputNumber
function findNumbersWithMissing(array $array, float $inputNumber): array
{
    $n = count($array);
    if ($inputNumber <= $array[0]) {
        return array_slice($array, 1, 3);
    }
    if ($inputNumber >= $array[$n - 1]) {
        return array_slice($array, $n, 3);
    }

    $i = 0;
    $j = $n;
    $mid = 0;
    while ($i < $j) {
        $mid = floor(($i + $j) / 2);

        if ($array[$mid] === $inputNumber) {
            return array_slice($array, $mid + 1, 3);
        }

        if ($inputNumber < $array[$mid]) {
            if ($mid > 0 && $inputNumber > $array[$mid - 1]) {
                return array_slice($array, $mid, 3);
            }
            $j = $mid;
        } else {
            if ($mid < $n - 1 && $inputNumber < $array[$mid + 1]) {
                return array_slice($array, $mid + 1, 3);
            }
            $i = $mid + 1;
        }
    }

    return array_slice($array, $mid, 3);
}