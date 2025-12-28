<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php
// Connexion à la base de données
$servername = "localhost";
$username = "epflocker";
$password = "3pfl0ck3r";
$dbname = "epflocker_db";

$value1 = "r";
$value2 = "r";

/*While(strlen($value1) != 2 && strlen($value2) != 2){
// Demande à l'utilisateur de saisir une valeur
$value1 = readline("Veuillez entrer une première valeur de casier à remplacer : ");
$value2 = readline("Avec quelautre casier voulez-vous échanger ? : ");
}*/




$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Tableau contenant les noms des tables concernées
$tables = array("cables", "casiers_emprunt", "casiers_libre_service", "rallonge", "souris");

// Parcours des tables
foreach ($tables as $table) {
    // Requête SQL pour mettre à jour les identifiants de casiers
    $updateQuery = "UPDATE " . $table . " SET Id_Casiers = REPLACE(Id_Casiers, '".$value1."', 't')";
    
    // Exécution de la première requête
    if ($conn->query($updateQuery) === TRUE) {
        echo "Les identifiants de casiers ont été mis à jour dans la table " . $table . "<br>";
    } else {
        echo "Erreur lors de la mise à jour des identifiants de casiers dans la table " . $table . ": " . $conn->error . "<br>";
    }
    
    // Requête SQL supplémentaire pour remplacer "B4" par "B1"
    $updateQueryB4 = "UPDATE " . $table . " SET Id_Casiers = REPLACE(Id_Casiers, '".$value2."', '".$value1."')";
    
    // Exécution de la deuxième requête
    if ($conn->query($updateQueryB4) === TRUE) {
        echo "Les identifiants de casiers ont été mis à jour dans la table " . $table . " (B4 remplacé par B1)<br>";
    } else {
        echo "Erreur lors de la mise à jour des identifiants de casiers dans la table " . $table . ": " . $conn->error . "<br>";
    }
    

}


foreach ($tables as $table) {
// Requête SQL supplémentaire pour remplacer "temp" par "B4"
$updateQueryTemp = "UPDATE " . $table . " SET Id_Casiers = REPLACE(Id_Casiers, 't', '".$value2."')";
    
// Exécution de la troisième requête
if ($conn->query($updateQueryTemp) === TRUE) {
    echo "Les identifiants de casiers ont été mis à jour dans la table " . $table . " (temp remplacé par B4)<br>";
} else {
    echo "Erreur lors de la mise à jour des identifiants de casiers dans la table " . $table . ": " . $conn->error . "<br>";
}
}



// Fermeture de la connexion
$conn->close();
?>

<?php
}else{
    echo "<h1>Not Found</h1><br>";
    echo "The requested URL was not found on this server.";

    ?>
    <title>404 Not Found</title>
    <?php

}

?>