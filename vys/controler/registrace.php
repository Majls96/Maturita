<?php

if (isset($_POST["name"]) && isset($_POST["pass"]) && isset($_POST["passrep"]) && isset($_POST["mail"])) {



    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $mail = $_POST["mail"];

    $err = 0;

    function random_string($len = "10") {
        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $generate = '';
        for ($i = 0; $i < $len; $i++) {
            $generate .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
        }

        return $generate;
    }

    if (strlen($name) > 5) {
        echo '<br>Jmeno je v poradku</br>';
    } else {
        $err++;
        echo '<br>Jmeno je kratke</br>';
    }

    if (strlen($pass) > 5) {

        if ($pass == $_POST["passrep"]) {

            echo "<br>Heslo je spravne</br>";
        } else {
            $err++;
            echo "<br>Hesla nejsou stejna</br>";
        }
    } else {
        $err++;
        echo "<br>Kratke heslo</br>";
    }
    if (checkEmail($mail)) {
        echo '<br>Mail je v poradku</br> ';
    } else {
        $err++;
        echo '<br>  Mail neni v poradku</br>';
    }


    if ($err == 0) {

        $salt = "#$%^&*@#$%^&*";
        $genepass = random_string(20);

        require 'model.php';
        $result = Model::registration($name, sha1($pass . $salt), $mail);

        if ($result === true) {
            $view = new View();
            echo $view->render('viewfile.php', array('foo' => 'bar'));
        } else {
            $view = new View();
            echo $view->render('viewfile.php', array('foo' => 'bar'));
        }
    }
}

function checkEmail($mail) {
    if (preg_match("/^[^@]+@[^@]+\.[a-z]+$/", $mail) == 1) {
        return true;
    } else {
        return false;
    }
}

?>