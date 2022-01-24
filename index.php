<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Liste selection</title>
<?php
        include 'parts/global-css.php';
    ?>

</head>


<?php
require 'function/Bdd-connect.php';

$bdd = BddConnect();


$reponse = $bdd->query('SELECT * FROM team ORDER BY poste LIMIT  23');
$resultats= $reponse->fetchAll();


?>

    <body>
    <div class="container">
       
    <h1 class="text-center mb-5">Liste joueurs Sélectionnés euro 2021</h1>
        <table class="table">
        <thead>
            <tr>
            
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Poste</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($resultats as $result){
                    $date = $result['date_naissance'];
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($date), date_create($today));

                    
                    echo('<tr>
                    <th scope="row">'.$result["nom"].'</th>
                    <td>'.$result["prenom"].'</td>
                    <td>'. $diff->format('%y') .' ans</td>
                    <td>'.$result["poste"].'</td>
                    <td>
                    </td>
                    </tr>');
                }
            ?>


        </tbody>
        </table>


    </div>
    <?php 
    include 'parts/global-css.php';
    ?>

            </div>

    </div>
 
    </body>
</html>
