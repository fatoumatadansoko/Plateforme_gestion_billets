<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "config.php";

if (isset($_GET['id'])) {
    $client_id = $_GET['id'];

    // Utilisation d'une requête préparée
    $sql = "DELETE FROM Clients WHERE client_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "i", $client_id);

    // Exécution de la requête préparée
    if (mysqli_stmt_execute($stmt)) {
        header("location:client.php?message=DeleteSuccess");
    } else {
        header("location:client.php?message=DeleteFail");
    }
} else {
    header("location:client.php?message=InvalidID");
}
?>
