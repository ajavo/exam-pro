<?php
require "function/utilisateur-function.php";
require "function/liste_function.php";
require "function/Bdd-connect.php";

$bdd = BddConnect();
checkAuthentification();
$id = $_GET["id"];
removePlayerById($bdd, $id);
header("Location: admin.php");
