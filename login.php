<?php session_start();

require_once "mysqli.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $mdp = hash('sha256', $_POST['mdp']);

    $query = "SELECT * FROM comptes_client WHERE email = ?";
    $st = $connexion->prepare($query);
    $st->bind_param("s", $email);
    $st->execute();

    try {
        $res = $st->get_result();
        $row = mysqli_fetch_row($res);
        $name = $row[1] ?? "";
        $firstName = $row[2] ?? "";
        $hash = $row[4] ?? false;
        $connexion->close();
    } catch (mysqli_sql_exception $e) {
        var_dump($e);
        exit;
    }

    if ($mdp === $hash) {
        $_SESSION['nom'] = $name;
        $_SESSION['prenom'] = $firstName;
        header("Location: accueil.php");
    } else {
        echo 'Incorrect Password!';
    }
} else {
    header("Location: calendar.php");
    exit;
}
