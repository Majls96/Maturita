<?php

class Model {

    function login($mail, $pass) {
        $db = mysqli_connect("localhost", "root", "", "mydb");
        $query = "SELECT ID FROM uzivatel WHERE Email LIKE('" . $mail . "') AND Password LIKE('" . $pass . "') ";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_row($result);
        if ($row !== NULL) {
            return $row;
        }
        return NULL;
    }

    function registration($name, $pass, $mail) {
        $db = mysqli_connect("localhost", "root", "", "mydb");
        $result = mysqli_query($db, "INSERT INTO uzivatel (ID,  Jmeno,Email, Password,Aktivace,Img,Trener,Adress,City,PSC) VALUES ('','" . $name . "','" . $mail . "', '" . $pass . "','" . $genepass . "', NULL, NULL, NULL, NULL,NULL)");

        return $result;
    }

}

?>
