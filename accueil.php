<?php session_start(); ?>

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

  <div class="footer-container">
    <img src="https://th.bing.com/th/id/R.93da4e5efaa9a3c7576f7e9bcf0ddaf9?rik=mUUdzfIdjAeIBA&pid=ImgRaw&r=0" alt="logo" />
    <footer>
      <ul>
        <li class="li-contact">Contact</li>
        <li>adresse :</li>
        <li>téléphone :</li>
        <li>e-mail :</li>
      </ul>
    </footer>
  </div>
</body>

</html>