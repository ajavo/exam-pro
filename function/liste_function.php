<?php


function getPlayerById($bdd, $id){
    $query = $bdd->prepare("SELECT * FROM team WHERE id = :id");
    $query->execute(["id"=>$id]);
    $article = $query->fetch();

    return $article;
}



function removeplayerById($bdd, $id){
    $query = $bdd->prepare("DELETE FROM team WHERE id = :id");
    $query->execute(["id"=> $id]);

    
    header("location: admin.php");
}



?>