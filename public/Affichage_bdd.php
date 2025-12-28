<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php

  $user = 'epflocker';
  $pass = '3pfl0ck3r';
  $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);

  if($table =="emprunt_ordi"){
  $stmt = $db->query('SELECT * FROM casiers_emprunt');
  
    //echo "Table emprunt ordinateurs : <br>";

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo ($row['Id_Casiers'] . " , " . $row['Adresse_mail'] . " , " . $row['Date_debut_lock'] . "<br>");
    
}

  }

  if($table =="cable"){
    $stmt = $db->query('SELECT * FROM cables');
    
      //echo "Table emprunt câbles : <br>";
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo ($row['Id_Casiers'] . " , " . $row['Adresse_mail'] . " , " . $row['Date_debut_lock'] . "<br>");
  
  }
    }
  
    if($table =="libre"){
      $stmt = $db->query('SELECT * FROM casiers_libre_service');
      
        //echo "Table emprunt libre-service : <br>";
    
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo ($row['Id_Casiers'] . " , " . $row['Adresse_mail'] . " , " . $row['Date_debut_lock'] . "<br>");
    
    }
      }
      if($table =="rallonge"){
        $stmt = $db->query('SELECT * FROM rallonge');
        
          //echo "Table emprunt rallonge : <br>";
      
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo ($row['Id_Casiers'] . " , " . $row['Adresse_mail'] . " , " . $row['Date_debut_lock'] . "<br>");
      
      }
        }
        if($table =="souris"){
          $stmt = $db->query('SELECT * FROM souris');
          
            //echo "Table emprunt souris : <br>";
        
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo ($row['Id_Casiers'] . " , " . $row['Adresse_mail'] . " , " . $row['Date_debut_lock'] . "<br>");
        
        }
          }
          if($table =="location"){
            $stmt = $db->query('SELECT * FROM toutes_locs');
            
             // echo "Table emprunt historique : <br>";
          
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo ($row['Id_Casiers'] . " , " . $row['Adresse_mail'] . " , " . $row['Date_debut_lock'] . "<br>");
          
          }
            }

            if($table =="boite_aux_lettres"){
              $stmt = $db->query('SELECT * FROM boite_aux_lettres');
              
               // echo "Table emprunt historique : <br>";
            
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo ($row['Adresse_mail'] . " , " . $row['Date_ouverture'] . "<br>");
            
            }
              }
  

?>

<?php
}else{
    echo "<h1>Not Found</h1><br>";
    echo "The requested URL was not found on this server.";

}

?>