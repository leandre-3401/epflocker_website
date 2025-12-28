<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>



<?php
session_start(); // Démarre la session

$user = "epflocker";
$pass = "3pfl0ck3r";

$tabletest = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['Casier'])) {
    $idCasier = $_GET['Casier'];
    $_SESSION['idCasier'] = $idCasier; // Stocke la valeur de idCasier dans la session
    //echo "Vous voulez modifier le contenu du casier : " . $_SESSION['idCasier']  . ".<br>";
    //echo "<br>";

    // Faire quelque chose avec la valeur récupérée
    // echo "Le casier à ouvrir est " . $idCasier . "<br>";

  } else {
    // Le paramètre n'a pas été transmis, gérer l'erreur
    echo "Le paramètre Casier n'a pas été transmis.";
    exit;
  }
}



// Connexion à la base de données
$servername = "localhost"; // Remplacez localhost par le nom de votre serveur
$username = "epflocker"; // Remplacez votre_nom_utilisateur par votre nom d'utilisateur
$password = "3pfl0ck3r"; // Remplacez votre_mot_de_passe par votre mot de passe
$dbname = "epflocker_db"; // Remplacez nom_de_votre_bdd par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupération des noms de tables
$sql = "SHOW TABLES";
$result = $conn->query($sql);

// Vérification des résultats et affichage des noms de tables
if ($result->num_rows > 0) {
    
    echo "Vous voulez modifier le contenu du casier : " . $_SESSION['idCasier']  . ".<br>";
    echo "<br>";

    echo "Voici le nom des tables de votre bdd :<br>";
    while ($row = $result->fetch_assoc()) {
        if ($row["Tables_in_" . $dbname] == "rfid" || $row["Tables_in_" . $dbname] == "RFID" || $row["Tables_in_" . $dbname] == "toutes_locs"|| $row["Tables_in_" . $dbname] == "tblAuthSessions"|| $row["Tables_in_" . $dbname] == "admin" || $row["Tables_in_" . $dbname] == "table_courante"|| $row["Tables_in_" . $dbname] == "badge_bash"){
        
        }else{
            echo "- " . $row["Tables_in_" . $dbname] . "<br>";
        }
    }
} else {
    echo "Aucune table trouvée dans la base de données.";
}

// Fermeture de la connexion
$conn->close();

?>





<html>

<head>
  <h1>Entrez la valeur de la nouvelle table :</h1>
</head>

<body>

<style>
  body {
    background-image: url('images/Fond1.png');
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<label for="mot">Saisie de la valeur de la nouvelle table :</label>
<input type="text" name="mot" id="mot">
<input type="submit" value="Valider">
</form>



<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mot'])) {
      $motSaisi = $_POST['mot'];
      echo "La table saisie est : " . $motSaisi . "<br>";
      
    try {
    $connexion = new PDO("mysql:host=localhost;dbname=epflocker_db", $user, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requete = $connexion->prepare("SHOW TABLES LIKE ?");
    $requete->execute([$motSaisi]);

    $resultat = $requete->fetch(PDO::FETCH_ASSOC);

    if ($resultat) {
        echo "Table trouvée.";

        $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user, $pass);
        $tables = array("cables", "casiers_emprunt", "casiers_libre_service", "rallonge", "souris");

        foreach ($tables as $table) {
        // Requête SQL pour vérifier si la valeur existe dans la table
        $checkQuery = $db->prepare("DELETE FROM " . $table . " WHERE Id_Casiers = :idCasier");
        $checkQuery->bindParam(':idCasier', $_SESSION['idCasier']);
        $checkQuery->execute();
        }

        $updateStmt = $db->prepare("INSERT INTO " .$motSaisi. "(Id_Casiers) VALUES (:idCasier)");
        $updateStmt->bindParam(':idCasier', $_SESSION['idCasier']);
        $updateStmt->execute();

        header("Location: modiflocker_admin.php");
        exit;

    } else {
        echo "La table n'existe pas dans la base de données. Veuillez rentrer une nouvelle valeur";
    }

} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

}
}


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
