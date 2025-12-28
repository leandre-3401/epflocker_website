<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>



<?php

$user = "epflocker";
$pass = "3pfl0ck3r";

$tabletest = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['Casier'])) {
    $idCasier = $_GET['Casier'];

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

  
    // Requête SQL pour mettre à jour les identifiants de casiers
    
    $Adresse_mail = "support.montpellier@epf.fr";
    $updateStmt2 = $db->prepare("UPDATE " . $tabletest . " SET Adresse_mail = :Adresse_mail, Date_debut_lock = :Date_debut_lock WHERE Id_Casiers = :idCasier");
    $updateStmt2->bindParam(':Adresse_mail', $Adresse_mail);
    $updateStmt2->bindParam(':Date_debut_lock', $Dateh);
    $updateStmt2->bindParam(':idCasier', $idCasier);

    if ($updateStmt2->execute()) {
      //echo "Les identifiants de casiers ont été mis à jour dans la table " . $table . "<br>";
    } else {
      echo "Erreur lors de la mise à jour des identifiants de casiers dans la table " . $table . ": " . $updateStmt->errorInfo()[2] . "<br>";
    }
  

  header("Location: modiflocker_admin.php");
  exit;

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