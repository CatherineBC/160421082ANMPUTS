<?php
error_reporting(E_ERROR | E_PARSE);
$c = new mysqli("localhost", "root", "", "anmp_uts");

if ($c->connect_errno) {
    $arrayerror = array('result' => 'ERROR',
        'msg' => 'Failed to connect DB');
    echo json_encode($arrayerror);
    die();
}

if (isset($_POST['pass']) && isset($_POST['username'])) {
    $pass = $_POST['pass'];
    $username = $_POST['username'];
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$pass'";

    $result = $c->query($sql);

    $obj = $result->fetch_object();

    if (!empty($obj)) {
        $arrayjson = array(
            'result' => 'OK',
            'data' => $obj
        );
    } else {
        $arrayjson = array(
            'result' => 'ERROR',
            'msg' => 'User not found'
        );
    }
    echo json_encode($arrayjson);
    die();
}
?>