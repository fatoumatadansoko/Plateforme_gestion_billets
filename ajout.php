<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once "config.php";

if (isset($_POST['send'])) {
    if (
        isset($_POST['date_reservation']) &&
        isset($_POST['heure_reservation']) &&
        isset($_POST['prix']) &&
        isset($_POST['statut']) &&
        isset($_POST['siege']) &&
        isset($_POST['destination']) &&
        isset($_POST['client_id']) &&
        $_POST['date_reservation'] != "" &&
        $_POST['heure_reservation'] != "" &&
        $_POST['prix'] != "" &&
        $_POST['statut'] != "" &&
        $_POST['siege'] != "" &&
        $_POST['destination'] != "" &&
        $_POST['client_id'] != ""
    ) {
        $sql = "INSERT INTO Billets (date_reservation, heure_reservation, prix, statut, siege, destination, client_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        // Utilisation de requête préparée pour éviter les injections SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $_POST['date_reservation'], $_POST['heure_reservation'], $_POST['prix'], $_POST['statut'], $_POST['siege'], $_POST['destination'], $_POST['client_id']);
        
        if ($stmt->execute()) {
            header("location:billeterie.php");
        } else {
            echo "Erreur lors de l'ajout du billet";
        }
    } else {
        echo "Erreur lors de l'ajout du billet : tous les champs doivent être remplis";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un billet</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="banniere">
        <img src="img/illusta.jpg" alt="" height="350px">
    </div>
    
    <div>
        <form action="" method="post">
            <h1>Acheter un billet</h1>
            Date de réservation <input type="date" name="date_reservation" value="" placeholder="date_reservation">
            Heure de réservation <input type="time" name="heure_reservation" value="" placeholder="heure_reservation">
            Prix du billet <input type="text" name="prix" value="" placeholder="prix">
            Le statut <input type="text" name="statut" value="" placeholder="statut">
            Le siège du client <input type="text" name="siege" value="" placeholder="siege">
            La destination <input type="text" name="destination" value="" placeholder="destination">
            L'identifiant du client <input type="text" name="client_id" value="" placeholder="client_id">
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
