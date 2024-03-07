<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$client_id = $_GET['id'];

if (isset($_POST['send'])) {
    if (
        isset($_POST['nom']) &&
        isset($_POST['prenom']) &&
        isset($_POST['telephone']) &&
        isset($_POST['email']) &&
        $_POST['nom'] != "" &&
        $_POST['prenom'] != "" &&
        $_POST['telephone'] != "" &&
        $_POST['email'] != ""
    ) {

        include_once "config.php";
        extract($_POST);
        // Utilisation d'une requête préparée
        $sql = "UPDATE Clients SET nom = ?, prenom = ?, telephone = ?, email = ? WHERE client_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // Liaison des paramètres
        mysqli_stmt_bind_param($stmt, "ssssi", $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['email'], $_POST['client_id']);

        // Exécution de la requête préparée
        if (mysqli_stmt_execute($stmt)) {
            header("location:client.php");
        } else {
            header("location:client.php?message=ModifyFail");
        }
    } else {
        header("location:client.php?message=EmptyFields");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    include_once "config.php";

    // Liste des infos utilisateurs
    $sql = "SELECT * FROM Clients WHERE client_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $client_id);
    mysqli_stmt_execute($stmt);

    // Récupération des résultats
    $result = mysqli_stmt_get_result($stmt);

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <form action="" method="post">
            <h1>Modifier un client</h1>
            Nom <input type="text" name="nom" value="<?= $row['nom'] ?>" placeholder="nom">
            Prénom <input type="text" name="prenom" value="<?= $row['prenom'] ?>" placeholder="prenom">
            Téléphone <input type="tel" name="telephone" value="<?= $row['telephone'] ?>" placeholder="telephone">
            Email <input type="text" name="email" value="<?= $row['email'] ?>" placeholder="email">
            <input type="submit" value="Modifier" name="send">
            <a class="link back" href="client.php">Annuler</a>
        </form>
    <?php
    }
    ?>
</body>

</html>
