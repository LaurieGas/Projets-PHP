<?php

if( isset($_POST["nom"]) && !empty($_POST["nom"]) &&
    isset($_POST["prenom"]) && !empty($_POST["prenom"]) &&
    isset($_POST["adresse"]) && !empty($_POST["adresse"]) &&
    isset($_POST["telephone"]) && !empty($_POST["telephone"]) &&
    isset($_POST["email"]) && !empty($_POST["email"]) &&
    isset($_POST["id"]) && !empty($_POST["id"]) ) {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $id = $_POST["id"];

    htmlentities($nom);
    htmlentities($prenom);
    htmlentities($adresse);
    htmlentities($telephone);
    htmlentities($email);
    htmlentities($id);

    // OU

    // $telephone = isset($_POST["telephone"]) ? htmlentities($_POST["telephone"]) : ";" 
    // $email = isset($_POST["email"]) ? htmlentities($_POST["email"]) : ";" // autre façon de faire l'htmlentities (condition IF syntaxe ternaire)


    // ETAPE 1 : CONNEXION A LA BDD

    try {
        //Options PDO de connexion
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO("mysql:host=localhost;dbname=miniagenda;charset=utf8", "root", "", $options);
            }
    catch(Exception $e) {
        echo $e->getMessage();
        die("Erreur lors de la tentative de connexion à la BDD !");
            }
  

        // ETAPE 2 : REQUETE PREPAREE UPDATE car on veut modifier les données du user déjà pré remplies que l'on a recupéré via son ID

    $requeteUpdate = $bdd->prepare("UPDATE contact SET nom=:nom, prenom=:prenom, adresse=:adresse, telephone=:telephone, email=:email WHERE id=:id");
    $requeteUpdate->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'adresse' => $adresse,
        'telephone' => $telephone,
        'email' => $email,
        'id' => $id
    ]);

    header("location:index.php?nom=$nom");
    // OU
    // header("location:profil.php?id=$id");


    }
else {
    echo "Merci de remplir les champs !";
}

?>