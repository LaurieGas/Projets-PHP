<?php

session_start();
session_unset(); // suppression des variables de session
session_destroy(); // destruction variables de session et c'est irrécupérable
header("location:session.php");




?>