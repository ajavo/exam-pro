<?php
session_start();

require 'function/Bdd-connect.php';
    require 'function/utilisateur-function.php';
    $bdd = BddConnect();


$errors= [];

if($_SERVER["REQUEST_METHOD"] == 'POST'){

    if(empty($_POST["username"])){
        $errors[] = "Veuillez saisir un username";
    }
    if(empty($_POST["password"])){
        $errors[] = "Veuillez saisir un username";
    }

    $user = getUserByUsername($bdd, $_POST["username"]);
 
    if(!$user){
        $errors[] = "Les identifiants sont mauvais";
    } else {
        // Le mot de passe
        if(!password_verify($_POST["password"], $user["password"])){
            $errors[] = "Les identifiants sont mauvais";
        }  else {
           $_SESSION["user"] = $user;
           header("Location: admin.php");
        }

    }


}
?>

<html>
    <head>
        <?php
        include 'parts/global-css.php'
        ?>
    </head>
    <body>
        <div class="container">
            <h1 class="text-center mb-5" >Connexion selectionneur !</h1>

            <form method="post" action="login.php">
  <div class="mb-3">
    <label for="exampleInputUser1" class="form-label">Nom utilisateur</label>
    <input type="text" name="username" class="form-control" id="exampleInputUsername1" aria-describedby="emailHelp">
  
</div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
    foreach ($errors as $error){
        echo('<div class="alert alert-danger" role="alert">
        '.$error.'
      </div>
      ');
    }
?>
</div>
</body>
</html>