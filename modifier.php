<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_billet = $_GET['id'];

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
    )  {

        include_once "config.php";
        extract($_POST);
        // Utilisation d'une requête préparée
        $sql = "UPDATE Billets SET date_reservation = ?, heure_reservation = ?, prix = ?, statut = ?, siege = ?, destination = ?, client_id = ? WHERE id_billet = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // Liaison des paramètres
        mysqli_stmt_bind_param($stmt, "ssssssii", $_POST['date_reservation'], $_POST['heure_reservation'], $_POST['prix'], $_POST['statut'], $_POST['siege'], $_POST['destination'], $_POST['client_id'], $id_billet);

        // Exécution de la requête préparée
        if (mysqli_stmt_execute($stmt)) {
            header("location:billeterie.php");
        } else {
            header("location:billeterie.php?message=ModifyFail");
        }
    } else {
        header("location:billeterie.php?message=EmptyFields");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un billet</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    include_once "config.php";

    // Liste des infos utilisateurs
    $sql = "SELECT * FROM Billets WHERE id_billet = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_billet);
    mysqli_stmt_execute($stmt);

    // Récupération des résultats
    $result = mysqli_stmt_get_result($stmt);

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <form action="" method="post">
            <h1>Modifier un billet</h1>
            Date de réservation <input type="date" name="date_reservation" value="<?= $row['date_reservation'] ?>" placeholder="date_reservation">
            Heure de réservation <input type="time" name="heure_reservation" value="<?= $row['heure_reservation'] ?>" placeholder="heure_reservation">
            Prix du billet <input type="text" name="prix" value="<?= $row['prix'] ?>" placeholder="prix">
            Le statut <input type="text" name="statut" value="<?= $row['statut'] ?>" placeholder="statut">
            Le siège du client <input type="text" name="siege" value="<?= $row['siege'] ?>" placeholder="siege">
            La destination <input type="text" name="destination" value="<?= $row['destination'] ?>" placeholder="destination">
            L'identifiant du client <input type="text" name="client_id" value="<?= $row['client_id'] ?>" placeholder="client_id">
            <input type="submit" value="Modifier" name="send">
            <a class="link back" href="billeterie.php">Annuler</a>
        </form>
    <?php
    }
    ?>
</body>

</html>
