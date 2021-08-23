<?php

require_once 'classes/auth.class.php';
require_once 'classes/answers.class.php';

$_auth = new Auth();
$_answers = new Answers();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $post = file_get_contents("php://input");
    $dataArray = $_auth->login($post);
    print_r(json_encode($dataArray));
}else{
    echo "No allowed method";
}