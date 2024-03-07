<?php 
$id_billet = $_GET['id'];
include_once "config.php";
$sql = "DELETE FROM Billets where id_billet = $id_billet";
if (mysqli_query($conn, $sql)) {
    header("location:billeterie.php?message=DeleteSuccess");
}
else {
    header("location:billeterie.php?message=DeleteFail"); 
}
?>