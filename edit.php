<?php

session_start();
require 'function/Bdd-Connect.php';
require 'function/liste_function.php';
require 'function/utilisateur-function.php';

checkAuthentification();

$bdd = BddConnect();
$joueur = getPlayerById($bdd, $_GET["id"]);


$poste = [
    'Gardien',
    'Défenseur',
    'Milieu',
    'Attaquant'
];
$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST") {
$bdd = BddConnect();
        if (empty($_POST["prenom"])) {
            $errors[] = "Veuillez saisir un prenom";
        }

        if (empty($_POST["nom"])) {
            $errors[] = "Veuillez saisir un nom";
        }

        if (!in_array($_POST["poste"], $poste)) {
            $errors[] = "Impossible ce type n'existe pas !";
        }
        if(count($errors) == 0){
            try {

        $query =
            $bdd->prepare("UPDATE team SET prenom=:prenom, nom=:nom, poste=:poste, date_naissance=:date_naissance WHERE id=:id");
        $query->execute([
            "prenom" => $_POST["prenom"],
            "nom" => $_POST["nom"],
            "poste" => $_POST["poste"],
            "date_naissance" => $_POST["date_naissance"],
            'id'=> $joueur["id"]
        ]);

        header('Location: admin.php');
    }   catch (\PDOException $e){
        throw $e;
}
}
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
    
    <a href="admin.php" class="text-end"><button type="button" class="btn btn-outline-secondary mt-2 ms-2">Retour</button></a>
    <a href="logout.php" class="text-end"><button type="button" class="btn btn-outline-danger mt-2">Me Déconnecter</button></a>

    <h1 class="text-center">Editer un joueur</h1>

    <form enctype="multipart/form-data" method="post" action="edit.php?id=<?php echo($joueur["id"]);?>">
        <div class="mb-3">
            <label for="prenom" class="form-label">prenom</label>
            <input value="<?php echo($joueur["prenom"]);?>" type="text" name="prenom"  class="form-control" id="prenom" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">nom</label>
            <input value="<?php echo($joueur["nom"]);?>" type="text" name="nom"  class="form-control" id="nom">
        </div>

        <div class="mb-3">
            <label for="poste" class="form-label">Poste</label>
            <select id="poste" name="poste" class="form-control">
                <?php
                foreach ($poste as $post){
                    if($post == $joueur["poste"]){
                        echo('<option selected value="'.$post.'">'.$post.'</option>');
                    } else{
                        echo('<option  value="'.$post.'">'.$post.'</option>');
                    }
                }

                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">date de naissance</label>
            <input value="<?php echo($joueur["date_naissance"]);?>" type="date" name="date_naissance" class="form-control" id="date_naissance ">
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
