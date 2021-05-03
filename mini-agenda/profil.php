<?php 

if(isset($_GET['id']) && !empty($_GET['id']) ) {
    $id = htmlentities($_GET['id']);

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

            //ETAPE 2 : Requête
        $reqSelectById = $bdd->prepare("SELECT * FROM contact WHERE id = ?"); // un prepare car info envoyé par un GET via URL, on se protège des injections sql
        $reqSelectById-> execute([$id]);

        $contact = $reqSelectById->fetch(PDO::FETCH_ASSOC); // ici on utilise fetch car on veut recup un seul resultat, si fetchAl il va recup tableau d'un tableau

        // echo "<pre>";
        // print_r($contact);
        // echo "</pre>";
        
                                    
}
else {
    header("location:index.php");
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

    <title>Mon mini Agenda</title>
  </head>
  <body>
        <!-- NavBar -->
    <?php include "navbar.php"; /* inclure la navbar qui est dans un fichier à part */ ?>

    <div class="container">
    <br>
    <h1>Informations du contact</h1>
    <br>

        <!-- Jumbotron -->
    <div class="jumbotron">
    <h1 class="display-4"><?php echo strtoupper($contact['nom']).' '.$contact['prenom'];?></h1>
    <p class="lead">
    <img src="photo/<?= $contact['photo']; ?>"> 
    Adresse : <?php echo $contact['adresse'];?><br>
    Téléphone : <?php echo $contact['telephone'];?><br>
    Email : <?php echo $contact['email'];?>
    </p>
    <hr class="my-4">
    <p><?php date('Crée : d/m/Y à H:i:s', strtotime($contact['date_ajout']) );?><br></p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="index.php" role="button">Retour accueil</a>
    </p>
    </div>


    <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


