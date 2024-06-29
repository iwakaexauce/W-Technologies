<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form_db";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si les données du formulaire sont envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Échapper les données pour éviter les injections SQL
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $telephone = $conn->real_escape_string($_POST["telephone"]);
    $date = $conn->real_escape_string($_POST["date"]);
    $message = $conn->real_escape_string($_POST["message"]);

    // Requête SQL pour insérer les données dans la table messages
    $sql = "INSERT INTO messages (name, email, telephone, date, message) VALUES ('$name', '$email', '$telephone', '$date', '$message')";

    // Exécuter la requête et vérifier si elle réussit
    if ($conn->query($sql) === TRUE) {
        // Redirection vers la page de remerciement
        header("Location: merci.html");
        exit();
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>