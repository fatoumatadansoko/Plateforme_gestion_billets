<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once "config.php";

if (isset($_POST['send'])) {
    if (
        isset($_POST['nom']) &&
        isset($_POST['prenom']) &&
        isset($_POST['telephone']) &&
        isset($_POST['email']) &&
        !empty($_POST['nom']) &&
        !empty($_POST['prenom']) &&
        !empty($_POST['telephone']) &&
        !empty($_POST['email'])
    ) {
        $sql = "INSERT INTO Clients (nom, prenom, telephone, email) VALUES (?, ?, ?, ?)";
        
        // Utilisation de requête préparée pour éviter les injections SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['email']);
        
        if ($stmt->execute()) {
            // Message de succès
            echo "Client ajouté avec succès!";
            header("location:client.php");

        } else {
            // Message d'erreur
            echo "Erreur lors de l'ajout du client";
        }
    } else {
        // Message d'erreur pour les champs vides
        echo "Erreur : tous les champs doivent être remplis";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="banniere">
        <img src="img/client.jpg" alt="" height="350px">
    </div>
    
    <div>
        <form action="" method="post">
            <h1>Ajouter un client</h1>
            Nom<input type="text" name="nom" value="" placeholder="Nom">
            Prénom<input type="text" name="prenom" value="" placeholder="Prénom">
            Téléphone<input type="text" name="telephone" value="" placeholder="Téléphone">
            Email<input type="text" name="email" value="" placeholder="Email">
            <input type="submit" value="Ajouter" name="send">
            <a class="link back" href="client.php">Annuler</a>
        </form>
    </div>
    <div class="avion">
        <div>
            <img src="img/illustration.png" alt="">
        </div>
        <div>
            <img src="img/illustration2.png" alt="">
        </div>
    </div>
</body>

</html>
