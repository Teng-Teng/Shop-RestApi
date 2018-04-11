<?php
require_once('database.php');

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

$param = $_GET['param'];

// 1. list/add
// 2. list
// 3. list/delete/{id}
// 4. send

$param_array = explode('/', $param);

// echo '<pre>';
// print_r($param_array);
// echo '</pre>';


// $param_array[0] = emailList   url输入emailList
if(!file_exists($param_array[0] . '.php')) {
    echo 'sorry, wrong route';
    exit;
}

require_once($param_array[0] . '.php');

$handle_obj = new $param_array[0]();

if (array_key_exists(1, $param_array)) {
    $method = $param_array[1] . 'Item';
} else {
    $method = 'indexItem';
}

if (array_key_exists(2, $param_array) && !array_key_exists(3, $param_array)) {
    echo $handle_obj->$method($param_array[2]);
} else if (array_key_exists(3, $param_array) && !array_key_exists(4, $param_array)) {
    echo $handle_obj->$method($param_array[2], $param_array[3]);
} else if (array_key_exists(5, $param_array)) {
    echo $handle_obj->$method($param_array[2],$param_array[3],$param_array[4],$param_array[5]);
} else {
    echo $handle_obj->$method();
}







