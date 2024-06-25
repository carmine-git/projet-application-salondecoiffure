<?php session_start();
$sessionExit = session_unset();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

if ($sessionExit) {
    session_destroy();
    echo 'vous vous êtes déconnecté du site web';
    echo ' <a href="accueil.php"><button>Revenir à l\'accueil</button></a>';
} else {
    echo 'La déconnexion n\'a pas aboutie';
}

exit;
