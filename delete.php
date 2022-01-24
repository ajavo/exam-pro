<?php
require 'function/Bdd-connect.php';
require 'function/list_function.php';
$bdd = BddConnect();


$idAsupprimer = $_GET["id"];

$article = getPlayerById($bdd, $idAsupprimer);

if(is_null($article)){

}else {
    removePlayerById($bdd, $idAsupprimer);
}


?>