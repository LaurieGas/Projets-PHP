<?php
session_start(); // initialiser les sessions

if(!isset($_SESSION["user"]) OR empty($_SESSION["user"])) { // si la session user n'existe pas OU si elle est vide dirige moi là =>
    header("location:session.php");
}
// else {
//     header("location:index.php");
// }


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

// var_dump($bdd); // petite verif que ça affiche l'objet
// die();

// ETAPE 2 : REQUETE : recuperer toutes les données tout les contacts
$requeteSelectAll = $bdd->query("SELECT * FROM contact");

// =====> pas besoin de faire un prepare() car pas de risque d'injection sql, etant donnée que les infos sont déja dans notre base de données
// =====> query = recup une requete , exec = recup + enregistrer données qq part , prepare =  lorsque que on a des PARAMETRES à passer à notre requete (type id = ?)

// ETAPE 3 : parcourir les données pour les afficher

$contacts = $requeteSelectAll->fetchAll(PDO::FETCH_ASSOC);
// print_r($contacts) // tchek pour voir ce que contient le tableau



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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="formulaire.php">Ajouter un contact</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                </li>                    
            </ul>
        </div>
    </nav>
    <div class="container">
        <br>
        <h1>Liste de mes contacts</h1>
        <h4>Bienvenue <?= $_SESSION["user"] ?><h4>
        <br>

        <?php if (isset($_GET['nom']) && !empty($_GET['nom'])) { // pour ajouter msg qui indique que les données ont bien été ajouté : "si get nom existe et n'est pas vide, plus bas on a ajouté une alert bootstrap
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" >
            <strong>Félicitations</strong> Le contact <?= $_GET['nom']; ?> a bien été ajouté !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <br>
        <?php
        }
        ?>

        <?php if (isset($_GET['feedback']) && !empty($_GET['feedback']) && ($_GET['feedback']) === 'suppress') { // pour ajouter msg qui indique que les données ont bien été ajouté : "si get nom existe et n'est pas vide, plus bas on a ajouté une alert bootstrap
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" >
            <strong>Félicitations</strong> Le contact a bien été supprimé !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <br>
        <?php
        }
        ?>
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th> 
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Date d'ajout</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($contacts as $contact) { /* while($contact = $requeteSelectAll ->fetch()) { */?> 
                <tr>
                    <th scope="row"><?= $contact['id']; ?></th>
                    <td><?= strtoupper($contact['nom']).' '.$contact['prenom']; ?></td>
                    <td><?= $contact['adresse']; ?></td>
                    <td><?= $contact['telephone']; ?></td>
                    <td><?= date('d/m/Y',strtotime($contact['date_ajout'])); ?></td>
                    <td>
                        <a href="profil.php?id=<?=$contact['id'];?>" class="btn btn-primary btn-sm">Afficher</a> 
                        <a href="modif_form.php?id=<?=$contact['id'];?>" class="btn btn-success btn-sm">Modifier</a> 
                        <a href="supprimer_profil.php?id=<?=$contact['id'];?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce contact ?')" class="btn btn-danger btn-sm">Supprimer</a> 
                    </td>
                </tr>
                <?php }  ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


