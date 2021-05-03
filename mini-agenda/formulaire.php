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
    
    <!-- Formulaire -->
    <div class = "container">
        <br>
        <h1>Ajouter un contact</h1>
        <br>

        <form method="post" action="form_secure.php" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir votre nom" required>
                </div>
                <div class="form-group col-md-4">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Saisir votre prénom" required>
                </div>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Saisir votre adresse" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="telephone">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name ="telephone" placeholder="Saisir votre téléphone">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name ="email" placeholder="Saisir votre email" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo de profil</label>
                <input type="file" class="form-control" id="email" name ="photo">
            </div>
            <button type="submit" class="btn btn-dark">Enregistrer</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>




