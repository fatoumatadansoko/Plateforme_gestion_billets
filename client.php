<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientèle</title>
    <link rel="stylesheet" href="billeterie.css">
</head>
<body>
    <main>
        <div class="contenu">
            <a href="ajout_client.php">Ajouter un client</a>
        </div>
        <table>
            <thead>

<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "config.php";
//liste des utilisateurs
$sql =  "SELECT * FROM Clients";
$result =mysqli_query($conn,$sql);
if (mysqli_num_rows($result) >0) {
    //Afficher les résultats
?>

                <tr>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>telephone</th>
                    <th>email</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
<?php
                while($row = mysqli_fetch_assoc($result)) {
 ?>
                <tr>

                    <td><?=$row['nom']?></td>
                    <td><?=$row['prenom']?></td>
                    <td><?=$row['telephone']?></td>
                    <td><?=$row['email']?></td>
                    <td class="image"> <a href="modifier_client.php?id=<?=$row['client_id']?>"><img src="img/write.png" alt=""></a></td>
                    <td class="image"> <a href="supprimer_client.php?id=<?=$row['client_id']?>"><img src="img/remove.png" alt=""></a></td>
                </tr>
 <?php
                }
                }
                else {
                   echo "<p class='message'>0 client ajoutée !</p>"; 
                }
?>
            </tbody>
        </table>
        <a href="ajout.php">Réservez un billet</a>

    </main>
    
</body>
</html>