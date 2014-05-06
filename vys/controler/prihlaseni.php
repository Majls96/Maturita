<?php

//session_start();
require 'View.php';

$db = mysqli_connect("localhost", "root", "", "mydb");
$mail = $_POST['mail'];
$pass = $_POST['pass'];
$salt = "#$%^&*@#$%^&*";

require '../database/model.php';
$row = Model::login($mail, sha1($pass . $salt));


if ($row !== NULL) {
    $view = new View();
    echo $view->render('neco.php', array('username' => 'Petr'));
} else {
    $view = new View();
    echo $view->render('error.php', array('errorlog' => 'Neco se pokazilo'));
}
?>
