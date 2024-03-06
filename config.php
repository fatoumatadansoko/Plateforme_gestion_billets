<?php 
define("DBHOST", "Localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "Traitement_billet");

//create connexion
$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>


