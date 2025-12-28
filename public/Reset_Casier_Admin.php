<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<html>



<?php


session_start(); // Démarre la session

$user = "epflocker";
$pass = "3pfl0ck3r";

$tabletest = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['Casier'])) {
    $idCasier = $_GET['Casier'];
    $_SESSION['idCasier'] = $idCasier; // Stocke la valeur de idCasier dans la session
    

    // Faire quelque chose avec la valeur récupérée
    // echo "Le casier à ouvrir est " . $idCasier . "<br>";

  } else {
    // Le paramètre n'a pas été transmis, gérer l'erreur
    echo "Le paramètre Casier n'a pas été transmis.";
    exit;
  }
}


$db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user, $pass);
$tables = array("cables", "casiers_emprunt", "casiers_libre_service", "rallonge", "souris");

foreach ($tables as $table) {
  // Requête SQL pour vérifier si la valeur existe dans la table
  $idCasier = $_SESSION['idCasier'];
  $checkQuery = $db->prepare("SELECT COUNT(*) FROM " . $table . " WHERE Id_Casiers = :idCasier");
  $checkQuery->bindParam(':idCasier', $idCasier);
  $checkQuery->execute();

  $rowCount = $checkQuery->fetchColumn();

  if ($rowCount > 0) {
    $tabletest = $table;
    $_SESSION['tabletest'] = $tabletest;
    break;
  }
}

if ($tabletest == 'casiers_emprunt' || $tabletest == 'casiers_libre_service') {
  $idCasier = $_SESSION['idCasier'];
  $stmt = $db->prepare('SELECT * FROM ' . $tabletest . ' WHERE Id_Casiers = :IdCasier');
  $stmt->bindParam(':IdCasier', $idCasier);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $idCasier = $row["Id_Casiers"];
  $Adresse_mail = $row["Adresse_mail"];
  $Date_debut_lock = $row["Date_debut_lock"];
  $Dateh = date("Y-m-d H:i:s");

  $updateStmt = $db->prepare("INSERT INTO toutes_locs (Id_Casiers, Adresse_mail, Date_debut_lock, Date_fin_lock) VALUES (:idCasier, :Adresse_mail, :Date_debut_lock, :Date_fin_lock)");
  $updateStmt->bindParam(':idCasier', $idCasier);
  $updateStmt->bindParam(':Adresse_mail', $Adresse_mail);
  $updateStmt->bindParam(':Date_debut_lock', $Date_debut_lock);
  $updateStmt->bindParam(':Date_fin_lock', $Dateh);
  $updateStmt->execute();

  foreach ($tables as $table) {
    // Requête SQL pour mettre à jour les identifiants de casiers
    $updateStmt2 = $db->prepare("UPDATE " . $table . " SET Adresse_mail = NULL, Date_debut_lock = NULL WHERE Id_Casiers = :idCasier");
    $updateStmt2->bindParam(':idCasier', $idCasier);

    if ($updateStmt2->execute()) {
      //echo "Les identifiants de casiers ont été mis à jour dans la table " . $table . "<br>";
    } else {
      echo "Erreur lors de la mise à jour des identifiants de casiers dans la table " . $table . ": " . $updateStmt->errorInfo()[2] . "<br>";
    }
  }
  header("Location: modiflocker_admin.php");
  exit;









} else {
  //echo $tabletest;

?>

<html>

<head>
  <h1> Nous sommes dans une impasse. Plusieurs personnes peuvent emprunter dans ce casier unique.</h1>
  <title>Reset par adresse mail</title>
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
    <label for="mot">Saisie de l'adresse mail de la personne à enlever de l'emprunt :</label>
    <input type="text" name="mot" id="mot">
    <input type="submit" value="Valider">
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mot'])) {
      $motSaisi = $_POST['mot'];
      $idCasier = $_SESSION['idCasier'];
      $tabletest = $_SESSION['tabletest'];
      echo "L'adresse mail saisie est : " . $motSaisi . "<br>";
      echo "L'Id du casier est : " . $idCasier . "<br>";
      echo "La table est : " . $tabletest . "<br>";

      $stmt = $db->prepare('SELECT * FROM ' . $tabletest . ' WHERE Id_Casiers = :IdCasier AND Adresse_mail = :Adresse_mail');
      $stmt->bindParam(':IdCasier', $idCasier);
      $stmt->bindParam(':Adresse_mail', $motSaisi);
      $stmt->execute();
    
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      
      
      $nombre_lignes = $stmt->rowCount();

      if ($nombre_lignes > 0) {
      
      $idCasier2 = $row["Id_Casiers"];
      $Adresse_mail = $row["Adresse_mail"];
      $Date_debut_lock = $row["Date_debut_lock"];
      $Dateh = date("Y-m-d H:i:s");

      $updateStmt1 = $db->prepare("INSERT INTO toutes_locs (Id_Casiers, Adresse_mail, Date_debut_lock, Date_fin_lock) VALUES (:idCasier, :Adresse_mail, :Date_debut_lock, :Date_fin_lock)");
      $updateStmt1->bindParam(':idCasier', $idCasier2);
      $updateStmt1->bindParam(':Adresse_mail', $Adresse_mail);
      $updateStmt1->bindParam(':Date_debut_lock', $Date_debut_lock);
      $updateStmt1->bindParam(':Date_fin_lock', $Dateh);
      $updateStmt1->execute();

      $stmt = $db->prepare('DELETE FROM ' . $tabletest . ' WHERE Id_Casiers = :IdCasier AND Adresse_mail = :Adresse_mail');
      $stmt->bindParam(':IdCasier', $idCasier);
      $stmt->bindParam(':Adresse_mail', $motSaisi);
      $stmt->execute();

      header("Location: modiflocker_admin.php");
      exit;

      }else{
        echo "Adresse mail introuvable dans cette table, veuillez réessayer";

      }

      


    } else {
      echo "Aucun mot n'a été saisi.";
    }





  }


}

  
  ?>



</body>



</html>

<?php
}else{
    echo "<h1>Not Found</h1><br>";
    echo "The requested URL was not found on this server.";

    ?>
    <title>404 Not Found</title>
    <?php

}

?>