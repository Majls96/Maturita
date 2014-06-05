<?php

//session_start();
require 'View.php';

$db = mysqli_connect("localhost", "root", "", "mydb");
$mail = $_POST['mail'];
$pass = $_POST['pass'];
$salt = "#$%^&*@#$%^&*";

require '../database/model.php';
$model = new Model();
$row = $model -> login($mail, sha1($pass . $salt));

$view = new View();
if ($row !== NULL) {
    $view = new View();
    echo $view->render('neco.php', array('username' => $row[1]));
} else {
    $view = new View();
    echo $view->render('errorLog.php', array('errorlog' => 'Neco se pokazilo'));
}
?>
