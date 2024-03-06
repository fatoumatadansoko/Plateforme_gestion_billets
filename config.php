<?php 
define("DBHOST", "Localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "Traitement_billet");

//create connexion
$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if ($conn === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
}


