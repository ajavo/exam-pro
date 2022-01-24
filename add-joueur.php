<?php

session_start();

require 'function/Bdd-connect.php';
require 'function/liste_function.php';
require 'function/utilisateur-function.php';

checkAuthentification();

$bdd = BddConnect();
$poste = [
    'Gardiens',
    'Défenseurs',
    'milieux',
    'Attaquants'
];
$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $bdd = BddConnect();

    
    if (empty($_POST["prenom"])) {
        $errors[] = "Veuillez saisir un prénom";
    }

    if (empty($_POST["nom"])) {
        $errors[] = "Veuillez saisir un nom";
    }

    if (!in_array($_POST["poste"], $poste)) {
        $errors[] = "Impossible ce poste n'existe pas !";
    }

    if (!in_array($_POST["date_naissance"], $date_naissance)) {
        $errors[] = "Impossible ce poste n'existe pas !";
    }



        $query =
            $bdd->prepare("INSERT INTO team (prenom, nom , date_naissance, poste)
            VALUES (:prenom, :nom, :date_naissance, :poste)");
        $query->execute([
            "prenom" => $_POST["prenom"],
            "nom" => $_POST["nom"],
            "date_naissance" => $_POST["date_naissance"],
            "poste" => $_POST["poste"]
         
        ]);
        header("Location: admin.php");
    }




?>

<html>
<head>
    <?php
    include 'parts/global-css.php';
    ?>
</head>
<body>
<div class="container">
    <a href="logout.php">Me déco !</a><br>
    <a href="admin.php">Retour !</a>

    <h1>Ajouter un joueur !</h1>

    <form enctype="multipart/form-data" method="post" action="add-joueur.php">
        <div class="mb-3">
            <label for="prenom" class="form-label">prenom</label>
            <input type="text" name="prenom"  class="form-control" id="prenom" aria-describedby="emailHelp">
        </div>


        <div class="mb-3">
            <label for="nom" class="form-label">nom</label>
            <input type="text" name="nom"  class="form-control" id="nom" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="poste" class="form-label">Poste</label>
            <select id="poste" name="poste" class="form-control">
                <?php
                foreach ($poste as $post){
                    echo('<option value="'.$post.'">'.$post.'</option>');
                }

                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" name="date_naissance" class="form-control" id="date_naissance">
        </div>


        <input type="submit" class="btn btn-success">

    </form>

    <?php
    foreach ($errors as $error){
        echo('<div class="alert alert-danger" role="alert">
  '.$error.'
</div>');
    }
    ?>

</div>
</body>
</html>
