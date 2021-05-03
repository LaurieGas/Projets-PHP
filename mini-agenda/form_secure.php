<?php

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$adresse = $_POST["adresse"];
$email = $_POST["email"];
$telephone = $_POST["telephone"];
$photo = $_FILES["photo"];

if( isset($nom) && isset($prenom) && isset($adresse) && isset($email) && isset($telephone) && 
!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($email) && !empty($telephone)
) {
     htmlentities($nom); // ici on securise l'entree et la saisie dans le formulaire/ protection des données/valeurs envoyées.
     htmlentities($prenom);
     htmlentities($adresse);
     htmlentities($email);
     htmlentities($telephone);
    //  htmlentities($photo); => pas nécessaire car il ne vient pas de l'extérieur

    //  echo "Bienvenue ".$nom." ".$prenom; // pour verifier que les variables sont bien récupérées
    // header("location:new_page.php");

    //  $telephone = isset($_POST["telephone"]) ? htmlentities($_POST["telephone"]) : " "; // syxtaxe ternaire : autre manière de faire un IF
    //  $email = isset($_POST["email"]) ? htmlentities($_POST["email"]) : " ";
    

    // ETAPE UPLOAD DU FICHIER PHOTO

    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        //vérification de la taille
        if($_FILES["photo"]["size"] <= 1000000) {
            // vérification de l'extension
            $infofile = pathinfo($_FILES["photo"]["name"]);  
            $extension = $infofile["extension"];
            // echo $extension; pathinfo = met les infos recupéres ds un array, intéréssant poour attraper l'extension d'un fichier
            $extension_allowed = array("jpg", "gif", "jpeg", "png");

            $source = $_FILES["photo"]["tmp_name"];

            if(in_array($extension,$extension_allowed)) {
                // création du dossier photos avec les droits si ce dernier n'existe pas (création de dossier à la volée, facultative, si le dossier où les photos devront être stocker n'existe pas)
                if(!file_exists("photo/")) {
                    mkdir("photo/", 0755); // 0755 => chmod
                }  
                $nomPhoto = 'logement_' .time() . '.'.$extension;
                $destination = "photo/".$nomPhoto;
                
                // $destination = "photo/".$_FILES["photo"]["name"];
                $filename = $_FILES["photo"]["name"];
               
                // rename("test_write.txt", "new_file.txt");
                move_uploaded_file($source, $destination);// uploader la photo : source et destination
                
            }
            else {

                die("Extension de fichier non autorisée !");
            }
        }
        else {

            die("Le fichier est trop lourd (>1Mo) !");
        }
    }


    
    // ETAPE 1 : CONNEXION

    try {
        //Options PDO de connexion
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO("mysql:host=localhost;dbname=miniagenda;charset=utf8", "root", "", $options);
    }
    catch(Exception $e) {
        echo $e->getMessage();
        die("Erreur lors de la tentative de connexion à la BDD !");
    }
    
    if(isset($filename)) {
        $photo = $filename;
    }
    else {
        $photo = null;
    }

    // OU syntaxe ternaire

    // $photo = isset($filename) ? $filename : null;



    // ETAPE 2 : REQUETE
    
    $requeteInsert = $bdd->prepare("INSERT INTO contact (nom, prenom, adresse, telephone, email, photo) VALUES (:nom, :prenom, :adresse, :telephone, :email, :photo)"); // on est pas obligé de reprendre $requeteSelectAll car form_secure lié à formulaire et formulaire lié à index et dans index le code reprends le petit chemin qui emmene vers requeteselectAll (requete->query); si un user n'ajoute pas de photo ça ne sera pas bloquant car ds la bdd on l'a mis a NULL (nn obligatoire)
    $requeteInsert->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'adresse' => $adresse,
        'telephone' => $telephone,
        'email' => $email,
        'photo' => $photo
    ]);
    
        // echo "Vos informations ont bien été sauvegardés !";
        header("location:index.php?nom=$nom"); //variable=resultat /valeur=paramètre => query string : ici on veut confirmer au user que ses infos ont bien été enregistré, on recupere le $_GET
    
}
else {
    echo "Merci de remplir les champs !";
}


?>