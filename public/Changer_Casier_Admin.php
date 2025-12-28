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
    

    // Faire quelque chose avec la valeur récupérée
    // echo "Le casier à ouvrir est " . $idCasier . "<br>";

  } else {
    // Le paramètre n'a pas été transmis, gérer l'erreur
    echo "Le paramètre Casier n'a pas été transmis.";
    exit;
  }
}
?>


<html>

<head>
  <h1>Entrez la valeur du deuxième casier pour l'échange:</h1>
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
    <label for="mot">Saisie de la valeur du deuxième casier :</label>
    <input type="text" name="mot" id="mot">
    <input type="submit" value="Valider">
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mot'])) {
      $motSaisi = $_POST['mot'];
      $idCasier = $_SESSION['idCasier'];
      echo "Le casier saisi est : " . $motSaisi . "<br>";
      echo "L'Id du premier casier est : " . $idCasier . "<br>";
      
      

      $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user, $pass);
      $tables = array("cables", "casiers_emprunt", "casiers_libre_service", "rallonge", "souris");
      
      foreach ($tables as $table) {
        $stmt = $db->prepare('SELECT * FROM ' . $table . ' WHERE Id_Casiers = :motSaisi');
        $stmt->bindParam(':motSaisi', $motSaisi);
        $stmt->execute();
        $resultats = $stmt->fetchAll();
      
        // Vérifier s'il y a des résultats
        if (count($resultats) > 0) {
          
          break; // Sortir de la boucle si des résultats sont trouvés
        }
      }
      //$nblignesdanscasiersemprunt = count($resultats);
  
        if (count($resultats) == 0) {
            echo "Aucune correspondance trouvée, réessayez avec un autre Id Casier.";
      
        }else{

        
            $conn = new mysqli("localhost", $user, $pass, "epflocker_db");

            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Erreur de connexion à la base de données : " . $conn->connect_error);
            }
            
            // Tableau contenant les noms des tables concernées
            $tables = array("cables", "casiers_emprunt", "casiers_libre_service", "rallonge", "souris");
            
            // Parcours des tables
            foreach ($tables as $table) {
                // Requête SQL pour mettre à jour les identifiants de casiers
                $updateQuery = "UPDATE " . $table . " SET Id_Casiers = REPLACE(Id_Casiers, '".$idCasier."', 't')";

                // Exécution de la première requête
                if ($conn->query($updateQuery) === TRUE) {
                    echo "Les identifiants de casiers ont été mis à jour dans la table " . $table . "<br>";
                } else {
                    echo "Erreur lors de la mise à jour des identifiants de casiers dans la table " . $table . ": " . $conn->error . "<br>";
                }
                
                
                // Requête SQL supplémentaire pour remplacer "B4" par "B1"
                $updateQueryB4 = "UPDATE " . $table . " SET Id_Casiers = REPLACE(Id_Casiers, '".$motSaisi."', '".$idCasier."')";

                if ($conn->query($updateQueryB4) === TRUE) {
                    echo "Les identifiants de casiers ont été mis à jour dans la table " . $table . " (B4 remplacé par B1)<br>";
                } else {
                    echo "Erreur lors de la mise à jour des identifiants de casiers dans la table " . $table . ": " . $conn->error . "<br>";
                }
                
            
            }
            
            
            foreach ($tables as $table) {
            // Requête SQL supplémentaire pour remplacer "temp" par "B4"
            $updateQueryTemp = "UPDATE " . $table . " SET Id_Casiers = REPLACE(Id_Casiers, 't', '".$motSaisi."')";

            if ($conn->query($updateQueryTemp) === TRUE) {
                echo "Les identifiants de casiers ont été mis à jour dans la table " . $table . " (temp remplacé par B4)<br>";
            } else {
                echo "Erreur lors de la mise à jour des identifiants de casiers dans la table " . $table . ": " . $conn->error . "<br>";
            }
                
        
            }
            
            
            
            // Fermeture de la connexion
            $conn->close();


        header("Location: modiflocker_admin.php");
        exit;
        }





      

      

      


    } else {
      echo "Aucun mot n'a été saisi.";
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