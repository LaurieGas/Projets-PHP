<?php

 session_start();

 if(isset($_POST["login"]) && !empty($_POST["login"]) &&
 isset($_POST["mdp"]) && !empty($_POST["mdp"]) ) {
    $login = htmlentities($_POST["login"]);
    $mdp = htmlentities($_POST["mdp"]);

    require_once "config/config_bdd.php";
    // ETAPE 1 : CONNEXION

    try {
        //Options PDO de connexion
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', USER, PWD, $options);
    }
    catch(Exception $e) {
        echo $e->getMessage();
        die();
    }

   // ETAPE 2 : REQUETE SELECT preparée car données déjà présentes dans notre bdd et proviennent  de l'extérieur, ca ns permet de recupérer un user avec son mdp et qui corresponds à ce qu'on a ds notre bdd
    $requeteSelect = $bdd->prepare("SELECT * FROM utilisateur WHERE login = :login AND mdp =:mdp");
    $requeteSelect->bindValue('login', $login); // bindValue équivaut à un execute, BindValue autant que l'on a de parametres, dc ici 2
    $requeteSelect->bindValue('mdp', $mdp);
    $requeteSelect->execute();  

    $utilisateur = $requeteSelect->fetch(PDO:: FETCH_ASSOC); // car on sait que l'on va recup une seule pers (bdd : un seul contact insérer dans le cadre de l'exo)
    // **fetch = renvoit false à la fin quand il n'y a plus de données ds la bdd
    // **fetchAll = renvoit un tableau vide

    // print_r($utilisateur); // vérification
    // die();

    if(!empty($utilisateur)) {
      $_SESSION["user"] = $login;
      header("location:index.php");
    }
    else {
      $error = "erreur";
    }

}

?>


<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Mon Mini agenda</title>
  </head>
  <body>
   
    <br>
    <br>
    <div class="container">
        <h1>Connexion</h1>
        <br>
        <?php if (isset($error)) { // pour ajouter msg qui indique que les données ne sont pas conformes : "si $error n'existe pas et n'est pas vide, plus bas on a ajouté une alert bootstrap ?>
           <div class="alert alert-warning alert-dismissible fade show" role="alert" >
           <strong>ERREUR : </strong> Erreur à l'identification !
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
        <?php }?>
        <?php if (empty($_SESSION["user"])) { // pour ajouter msg qui indique que le user n'est plus connecté ?>
           <div class="alert alert-warning alert-dismissible fade show" role="alert" >
           <strong>DECONNEXION : </strong> Vous n'êtes plus connecté !
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
        <?php }?>


        <br>
        <form method="post">
            <div class="form-group">
                <label for="user">Login :</label>
                <input type="text" class="form-control" id="login" aria-describedby="login" name="login" placeholder="Saisir votre identifiant">
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe :</label>
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Saisir un mot de passe">
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
         </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>