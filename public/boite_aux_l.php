<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php

require '../inc/bdd.php';
$Adresse_mail = $_GET['Adresse_mail'];

  try
  {
      $db = new PDO ('mysql:host=localhost;dbname=epflocker_db',$user,$pass);    
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $dateActuelle = date('Y-m-d H-i-s');

      $sql = "INSERT INTO boite_aux_lettres (Date_ouverture, Adresse_mail) VALUES (:dateh, :mail)";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':dateh', $dateActuelle);
      $stmt->bindValue(':mail', $Adresse_mail);

    // Exécution de la requête
    $stmt->execute();

    header("Location: https://192.168.138.102:8080/powerB2.html");
    exit;
  
      
  }
  catch (PDOException $e)
  {
      print "Erreur :" . $e->getMessage() . "<br/>";
      die; //arrête tout le programme
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