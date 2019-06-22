<?php

function __load($n) {
    require_once "src/{$n}.php";
}

// __load("SmartList");

// $list = new SmartList();

// $list->Add(1);
// $list->Add(6);
// $list->Add(8);
// $list->Add(9);
// $list->Add(3);

// echo $list->ElementAt(6);


__load("Node");
__load("BaseNode");
__load("EmptyNode");

$list = new BaseNode();
$list->Add(2);
$list->Add(3);
$list->Add(4);

//echo $list->Count();

//echo $list->ElementAt(1);

$list2 = new BaseNode();
$list2->Add(10);
$list2->Add(15);
$list2->Add(20);

$list->AddNode($list2);

// $array = array(
//     'kaas',
//     'kroket',
//     'worst'
// );

// $list->AddArray($array);

$mapping = function($value) {
    return $value + 100;
};

$operator = function($value) {
    if($value > 109) {
        return true;
    } else {
        return false;
    }
};

$list = $list->Map($mapping)->Where($operator)->Map($mapping);

for($i = 0; $i < $list->Count(); $i++) {
    echo $list->ElementAt($i) . "<br>";
}

// $list_array = $list->ToArray();

// print_r($list_array);

// echo "<br>";



