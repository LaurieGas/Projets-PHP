<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Mon mini agenda</title>
  </head>
  <body>
    <!-- NavBar -->
    <?php include "navbar.php"; /* inclure la navbar qui est dans un fichier à part */ ?>

    <div class = "container">
        <br>
        <h1>Supprimer un contact</h1>
        <br>
    </div>
    
    <!-- php -->
    <?php

if(isset($_GET['id']) && !empty($_GET['id']) ) {
    $id = htmlentities($_GET['id']);
    // print_r($id);
    // die();

      //ETAPE 1 : CONNEXION
    try {
        //Options PDO de connexion
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO("mysql:host=localhost;dbname=miniagenda;charset=utf8", "root", "", $options);
            }
    catch(Exception $e) {
        echo $e->getMessage();
        die("Erreur lors de la tentive de connexion à la BDD !");
            }
    // print_r($bdd);
    

        // ETAPE 2 : REQUETE PREPAREE DELETE : pour supprimer l'ensemble des infos du user liées à l'ID

    $requeteSuppr = $bdd->prepare("DELETE FROM contact WHERE id=:id ");
    $requeteSuppr->execute([
        'id' => $id
    ]);
    header("location:index.php?feedback=suppress");
}

else {
    header("location:index.php");
}
    ?>

        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


<!-- Notes : -->
<!-- Ici, la partie html n'était nécessaire car la supression est quasi immédiate, pas besoin de header, footer à part si on voulait faire une confirmation de suppression par exemple -->
<!-- pour la confirmation : => index => hmtl + js on utilise les attributs event de javacripts: onclique() -->