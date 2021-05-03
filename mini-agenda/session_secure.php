<?php

// session_start();

// if(isset($_POST["login"]) && !empty($_POST["login"]) &&
//    isset($_POST["mdp"]) && !empty($_POST["mdp"]) ) {

//     $login = htmlentities($_POST["login"]);
//     $mdp = htmlentities($_POST["mdp"]);

//     require_once "config/config_bdd.php";
    // ETAPE 1 : CONNEXION

    // try {
        //Options PDO de connexion
    //     $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    //     $bdd = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', USER, PWD, $options);
    // }
    // catch(Exception $e) {
    //     echo $e->getMessage();
    //     die();
    // }
    // print_r($bdd);
    // die();
    // ETAPE 2 : REQUETE SELECT preparée OU avec query car données déjà présentes dans notre bdd et ne proviennent pas de l'extérieur ?
    // $requeteSelect = $bdd->prepare("SELECT * FROM utilisateur");
    // $requeteSelect->execute([
    //     'login'=> $login,
    //     'mdp' => $mdp
    // ]);

    // $requeteSelect->fetchAll(PDO:: FETCH_ASSOC);
    // print_r($requeteSelect);
    // die();

//     if($_POST["login"] === $login && $_POST["mdp"] === $mdp ) {

//         header("location:index.php?login=$login");
//     }
    
// }

// else {
//     echo "Veuillez saisir identifiant et/ou mot de passe valide !";
//     header("location:session.php");
// }


?>