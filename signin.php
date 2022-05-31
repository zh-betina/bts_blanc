<?php

use classes\DB\DB;
use classes\Signin\Signin;

include "./classes/DB.php";
include "./classes/Signin.php";

$response = "";
$displayForm = true;
$condition = isset($_POST["prenom"]) && isset($_POST["mdp"]);
$dbTable = "E5";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($condition) {
        $db = new DB($dbTable);
        if ($db) {
            $conn = $db->connect();
            $query = new Signin($conn, $_POST["prenom"], $_POST["mdp"]);

            if ($query->signin()) {
                $response = "<p class='success'>Tu est bien connecté.e " . $_POST['prenom'] . " !</p>";
                $displayForm = false;
            } else $response = "<p class='err'>Connection échouée ! Vérifie bien les informations fournis</p>";
        }
    } else {
        $response = "<p class'err'>Il manque les informations ! S'il vous plaît, remplissez tous les champs !</p>";
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
    <title>Connection</title>
</head>

<body>
    <h1>Connection</h1>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
        <path d="M416 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c17.67 0 32 14.33 32 32v256c0 17.67-14.33 32-32 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c53.02 0 96-42.98 96-96V128C512 74.98 469 32 416 32zM342.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L242.8 224H32C14.31 224 0 238.3 0 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C355.1 266.1 355.1 245.9 342.6 233.4z" />
    </svg>
    <?php if (strlen($response) > 0) {
        echo $response;
    }
    ?>
    <?php
    if ($displayForm) {
        include "./signinForm.php";
    }
    ?>

    <a href="./index.html">Retour à la page d'acceuil</a>
</body>

</html>