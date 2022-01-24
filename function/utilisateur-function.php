<?php
function getUserByUsername($bdd, $user){
    $query = $bdd->prepare('SELECT * FROM user WHERE username = :username');
    $query->execute(["username"=> $user]);
    $resultat = $query->fetch();

    return $resultat;
}

function checkAuthentification(){
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }
}
