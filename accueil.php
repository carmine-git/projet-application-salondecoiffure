<?php
session_start();
include_once('mysqli.php');

function getUserCredentials()
{
  $user = "";

  if (!isset($_SESSION['prenom']) && !isset($_SESSION['nom'])) {
    $user = "guest";
    return $user;
  }

  $user = array(
    "nom" => $_SESSION['nom'],
    "prenom" => $_SESSION['prenom'],
  );

  return $user;
}

function getAppointmentDatas($user_id, $connexion)
{
  try {
    $query = "SELECT date, heure_debut FROM agenda WHERE client_id = ?";
    $st = $connexion->prepare($query);
    $st->bind_param('s', $user_id);
    $st->execute();
    $res = $st->get_result();
    $rows = resultToArray($res);
    $res->free();
    return $rows;
  } catch (Error $e) {
    echo $e;
    exit;
  } finally {
    $st->close();
    $connexion->close();
  }
}

function resultToArray($result)
{
  $rows = array();
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }
  return $rows;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accueil</title>
  <link rel="stylesheet" href="accueil.css" />
</head>

<body>
  <?php

  if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 120)) {
    session_unset();
    session_destroy();
    header("location: login.html");
  };

  $_SESSION['start'] = time();
  ?>
  <div class="navbar">
    <h1>Bienvenue sur le site <?php echo getUserCredentials()['nom'] ?? "invité" ?>, <?php echo getUserCredentials()['prenom'] ?? "" ?></h1>

    <a href="login.html"><button class="button" id="connexion" name="connexion">
        Se connecter
      </button></a>
    <a href="inscription.html"><button class="button" id="inscription" name="inscription">
        S'inscrire
      </button></a>
    <a href="calendar.php"><button class="button" id="rdv" name="rdv">
        Prendre un rendez-vous
      </button></a>

    <a href="logout.php">
      <button class="logout-button" id="logout-button" name="logout-button">
        Se déconnecter
      </button>
    </a>
  </div>

  <div class="appointments">
    <?php
    if (isset($_SESSION['client_id'])) {
      echo '<h2>Mes rendez-vous</h2>';

      $data = getAppointmentDatas($_SESSION['client_id'], $connexion);

      if (count($data) > 0) {
        echo '<table border="1">';
        echo '<tr><th>Date</th><th>Horaire</th></tr>';

        foreach ($data as $row) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($row['date']) . '</td>';
          echo '<td>' . htmlspecialchars($row['heure_debut']) . '</td>';
          echo '</tr>';
        }

        echo '</table>';
      } else {
        echo "Pas de rendez-vous confirmé pour le moment";
      }
    }
    ?>
  </div>

  <div class="footer-container">
    <img src="https://th.bing.com/th/id/R.93da4e5efaa9a3c7576f7e9bcf0ddaf9?rik=mUUdzfIdjAeIBA&pid=ImgRaw&r=0" alt="logo" />
    <footer>
      <ul>
        <li class="li-contact">Contact</li>
        <li>adresse</li>
        <li>téléphone</li>
        <li>e-mail</li>
      </ul>
    </footer>
  </div>
</body>

</html>