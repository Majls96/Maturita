<?php

require 'View.php';
if (isset($_POST["name"]) && isset($_POST["pass"]) && isset($_POST["passrep"]) && isset($_POST["mail"])) {
    
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $mail = $_POST["mail"];

    $err = 0;
    
    
    $jmenoNo = '';
    $passNo = '';
    $mailNo = '';

    function random_string($len = "10") {
        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $generate = '';
        for ($i = 0; $i < $len; $i++) {
            $generate .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
        }

        return $generate;
    }

    if (strlen($name) > 5) {
        $jmenoYes = 'jmeno je v poradku';
    } else {
        $err++;
        $jmenoNo = 'jmeno je kratke';
    }

    if (strlen($pass) > 5) {

        if ($pass == $_POST["passrep"]) {

            $passYes = 'heslo je v poradku';
        } else {
            $err++;
            $passNo = 'hesla nejsou stejna';
        }
    } else {
        $err++;
        $passLenght = 'heslo je kratke';
    }
    if (checkEmail($mail)) {
        $mailYes = 'mail je v poradku';
    } else {
        $err++;
        $mailNo = 'mail neni v poradku';
    }


    if ($err == 0) {

        $salt = "#$%^&*@#$%^&*";
        $genepass = random_string(20);

        require '../database/model.php';
        $model = new Model();
        $result = $model->registration($name, sha1($pass . $salt), $mail, $genepass);

        if ($result === true) {
            $registrovan = 'Registrovan';
            $view = new View();
            echo $view->render('../templates/regYes.php', array('nameyes' => $jmenoYes,
                                                                'passyes' => $passYes,
                                                                'mailyes' => $mailYes,
                                                                'regresultYes' => $registrovan));
        } 
    }
    else {
            $neregistrovan = 'neco se pokazilo';
            $view = new View();
            echo $view->render('../templates/errorReg.php', array('nameno' => $jmenoNo,
                                                                //  'namelenght'=>$namelenght,
                                                                  'passno' => $passNo,
                                                                  'mailno' => $mailNo,
                                                                  'regresultNo' => $neregistrovan));
             
             
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