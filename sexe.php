<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Choix du sexe</title>
    <link rel="stylesheet" href="sexe.css" />
</head>

<body>
    <div>
        <?php
        session_start();

        var_dump($_GET);

        $_SESSION['date'] = $_GET['date'];
        $_SESSION['time'] = $_GET['time'];

        var_dump($_SESSION);
        ?>
        <h1 class="titre">Choisir votre sexe</h1><br>
        <a href="homme.html"><button class="button-1" id="sexe-homme" name="sexe-homme"> Homme </button></a>
        <a href="femme.html"><button class="button-2" id="sexe-femme" name="sexe-femme"> Femme </button></a>
    </div>
</body>

</html>