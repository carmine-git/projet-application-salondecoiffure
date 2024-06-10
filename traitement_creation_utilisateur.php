<?php
// Inclure le fichier d'initialisation de la connexion à la base de données
require_once "sql_init.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $mot_de_passe = $_POST['mot_de_passe'];

    var_dump($_POST);
    // Valider les données (ex : vérifier si les champs ne sont pas vides)
    if (!empty($login) && !empty($mot_de_passe)) {
        // Hasher le mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        try {
            $requete = $connexion->prepare("INSERT INTO utilisateurs (login, mot_de_passe) VALUES (?, ?)");
            $requete->bindParam("ss", $login, $mot_de_passe_hash);
        } catch (PDOException $e) {
            echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
        };
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
} else {
    // Redirection si le formulaire n'a pas été soumis
    header("Location: creation_utilisateur.html");
    exit;
};
