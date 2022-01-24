<?php
session_start();

require 'function/Bdd-connect.php';
require 'function/liste_function.php';
require 'function/utilisateur-function.php';

$bdd = BddConnect();
checkAuthentification();


$reponse = $bdd->query('SELECT * FROM team ORDER BY poste LIMIT 23');
$users = $reponse->fetchAll();


?>

<html>
<head>
    <?php
    include 'parts/global-css.php';
    ?>
</head>
<body>
<div class="container">
    <?php
     include 'parts/menu.php'
     ?>
     <h1 class="text-center mt-3">Liste des 23 Joueurs !</h1>
     <div class="row">
         <div class="col-2">
    <a href="logout.php"><button type="button" class="btn btn-outline-danger mt-5 mb-5">Me déconnecter</button></a>
</div>
<div class="col-10">
    <a href="add-joueur.php"><button type="button" class="btn btn-outline-success mt-5 mb-5">Ajouter un joueur</button></a>
</div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">prenom</th>
                <th scope="col">nom</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">poste</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($users as $user){
                    $date = $user['date_naissance'];
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($date), date_create($today));
  
                    echo(' <tr>
                <th scope="row">'.$user["prenom"].'</th>
                <td>'.$user["nom"].'</td>
                <td>'. $diff->format('%y') .' ans</td>
                <td>'.$user["poste"].'</td>
                <td>
                <a href="edit.php?id='.$user["id"].'"><button type="button" class="btn btn-outline-primary">Editer</button></a> 
                 <a href="remove-joueur.php?id='.$user["id"].'"><button type="button" class="btn btn-outline-danger ">SUPPR.</button></a>
</td>
            </tr>');
                }
                
            ?>

            </tbody>
        </table>
    </div>
</div>
</body>
</html>
