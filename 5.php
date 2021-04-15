<?php

//PHP. Есть массив объектов одного класса. Предложите как можно больше вариантов сортировки
//массива по одному из свойств объектов.

#region usort

$key = 'someKey';
usort($array, function (object $a, object $b) use ($key) {
    return $a->$key <=> $b->$key;
});

#endregion


#region bubbleSort

function bubbleSort($array, $key)
{
    $length = count($array);
    if (!$length) {
        return $array;
    }
    for ($outer = 0; $outer < $length; $outer++) {
        for ($inner = 0; $inner < $length; $inner++) {
            if ($array[$outer]->$key < $array[$inner]->$key) {
                $tmp = $array[$outer]->$key;
                $array[$outer]->$key = $array[$inner]->$key;
                $array[$inner]->$key = $tmp;
            }
        }
    }
    return $array;
}

bubbleSort($array, 'value');

#endregion


#region SplMaxHeap

class SortObjects extends SplMaxHeap
{
    public $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    function compare($a, $b)
    {
        return $b->{$this->key} - $a->{$this->key};
    }
}

$sorter = new SortObjects('value');
array_map([$sorter, 'insert'], $array);
$sortedArray = iterator_to_array($sorter);

#endregion