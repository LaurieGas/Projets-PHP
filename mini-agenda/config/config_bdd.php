<?php

// ici, on definit des constantes pour éviter de copier/coller 100000 fois le try and catch pour se connecter à la bdd ET SURTOUT si notre password change ou notre localhost, on fera les modif que dans notre fichier config
// on va inclure ce fichier via un require ou include

const HOST = 'localhost';
const DB_NAME = 'miniagenda';
const USER = 'root';
const PWD = '';

// OU
// define('PWD, 'root'); 

?>