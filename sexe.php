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
        require_once('mysqli.php');

        $date_rdv = $_GET['date'];
        $time_rdv = $_GET['time'];
        $id_employé = 2;

        try {
            $query = "INSERT INTO agenda (date_rdv, heure_rdv, client_id, id_employé) VALUES (?, ?, ? ,?)";
            $st = $connexion->prepare($query);
            $st->bind_param("sssi", $date_rdv, $time_rdv, $_SESSION['client_id'], $id_employé);
            $st->execute();
            $st->close();
            $connexion->close();
        } catch (Error $e) {
            echo "Prepare failed: " . $connexion->error;
        }

        $_SESSION['date'] = $date_rdv;
        $_SESSION['time'] = $time_rdv;

        ?>
        <h1 class="titre">Choisir votre sexe</h1><br>
        <a href="homme.php"><button class="button-1" id="sexe-homme" name="sexe-homme"> Homme </button></a>
        <a href="femme.php"><button class="button-2" id="sexe-femme" name="sexe-femme"> Femme </button></a>
    </div>
</body>

</html>