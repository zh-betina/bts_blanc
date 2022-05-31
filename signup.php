<?php

use classes\DB\DB;
use classes\Signup\Signup;

include "./classes/DB.php";
include "./classes/Signup.php";

$response = "";
$displayForm = true;
$condition = isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["mdp"]);
$dbTable = "E5";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($condition) {
        $db = new DB($dbTable);
        if ($db) {
            $conn = $db->connect();
            $query = new Signup($_POST);

            if ($query->addToDB($conn)) {
                $response = "<p class='success'>Super, " . $_POST['prenom'] . " ! Ton compte a été crée !</p>";
                $displayForm = false;
            } else $response = "<p class='err'>Un probleme lors de rajout à la DB est survenu</p>";
        }
    } else {
        $response = "<p class='err'>Il manque les informations ! S'il vous plaît, remplissez tous les champs !</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./index.css" rel="stylesheet" />
    <title>Creer compte</title>
</head>

<body>
    <h1>Création de compte</h1>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
        <path d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM616 200h-48v-48C568 138.8 557.3 128 544 128s-24 10.75-24 24v48h-48C458.8 200 448 210.8 448 224s10.75 24 24 24h48v48C520 309.3 530.8 320 544 320s24-10.75 24-24v-48h48C629.3 248 640 237.3 640 224S629.3 200 616 200z" />
    </svg>
    <?php if (strlen($response) > 0) {
        echo "<p>$response</p>";
    }
    ?>
    <?php
    if ($displayForm) {
        include "./form.php";
    }
    ?>

    <a href="./index.html">Retour à la page d'acceuil</a>
</body>

</html>