<?php
    function BddConnect(){

        try {
            $bdd = new PDO("mysql:dbname=exam_pdo;host=127.0.0.1", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        } catch (\Exception $e){
            echo ('Impossible de se connecter !');
            throw $e;
        }
    }

?>