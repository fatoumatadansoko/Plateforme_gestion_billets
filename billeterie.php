<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billeterie</title>
    <link rel="stylesheet" href="billeterie.css">
</head>
<body>
    <main>
        <div class="contenu">
            <a href="ajout.php">Ajouter un billet</a>
        </div>
        <table>
            <thead>

<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "config.php";
//liste des utilisateurs
$sql =  "SELECT * FROM Billets";
$result =mysqli_query($conn,$sql);
if (mysqli_num_rows($result) >0) {
    //Afficher les résultats
?>

                <tr>
                    <th>date_reservation</th>
                    <th>heure_reservation</th>
                    <th>prix</th>
                    <th>Statut</th>
                    <th>siege</th>
                    <th>destination</th>
                    <th>client_id</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
<?php
                while($row = mysqli_fetch_assoc($result)) {
 ?>
                <tr>

                    <td><?=$row['date_reservation']?></td>
                    <td><?=$row['heure_reservation']?></td>
                    <td><?=$row['prix']?></td>
                    <td><?=$row['statut']?></td>
                    <td><?=$row['siege']?></td>
                    <td><?=$row['destination']?></td>
                    <td><?=$row['client_id']?></td>
                    <td class="image"> <a href="modifier.php?id=<?=$row['id_billet']?>"><img src="img/write.png" alt=""></a></td>
                    <td class="image"> <a href="supprimer.php?id=<?=$row['id_billet']?>"><img src="img/remove.png" alt=""></a></td>
                </tr>
 <?php
                }
                }
                else {
                   echo "<p class='message'>0 idée ajoutée !</p>"; 
                }
?>
            </tbody>
        </table>
    </main>
    
</body>
</html>