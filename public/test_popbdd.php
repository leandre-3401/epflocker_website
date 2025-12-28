<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php
if (isset($_GET['Adresse_mail']) && isset($_GET['typeaction']) && isset($_GET['table'])) {
  $Adresse_mail = $_GET['Adresse_mail'];
  $typeaction = $_GET['typeaction'];
  $table = $_GET['table'];

  // Faire quelque chose avec la valeur récupérée
  //echo "Mon adresse mail : " . $Adresse_mail . "<br>";
  //echo "Je veux : " . $typeaction . "<br>";
  //echo "Il y a " . $nblignes . " lignes dans la table en question" . "<br>";

} else {
  // Le paramètre n'a pas été transmis, gérer l'erreur
  echo "Les paramètres  n'ont pas été transmis.";
}

$lignevide = 0;
//$user = 'root';
$user = 'epflocker';
$pass = '3pfl0ck3r';


if($table == 'casiers_emprunt'){
    if ($typeaction == "Emprunter") {

    $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
    
    $stmt = $db->query('SELECT * FROM casiers_emprunt WHERE Adresse_mail IS NULL ORDER BY RAND() LIMIT 1');
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($row);
    
    $idCasier = $row["Id_Casiers"];
    //echo $idCasier;

    $Dateh = date("Y-m-d H:i:s");


    $updateStmt = $db->prepare("UPDATE casiers_emprunt SET Adresse_mail = :Adresse_mail, Date_debut_lock = :Dateh WHERE Id_Casiers = :idCasier");
    $updateStmt->bindParam(':Adresse_mail', $Adresse_mail);
    $updateStmt->bindParam(':idCasier', $idCasier);
    $updateStmt->bindParam(':Dateh', $Dateh);

    if ($updateStmt->execute()) {
        //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
        header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
        exit;
        
    } else {
        //echo "Une erreur s'est produite lors de la mise à jour de l'adresse e-mail.";
    }
    
    

    
    }elseif($typeaction == "Rendre"){
    
    $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
    
    $selectStmt = $db->prepare('SELECT * FROM casiers_emprunt WHERE Adresse_mail = :Adresse_mail');
    $selectStmt->bindParam(':Adresse_mail', $Adresse_mail);
    $selectStmt->execute();

    $row = $selectStmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($row);
    
    $idCasier = $row["Id_Casiers"];
    $Date_debut_lock = $row["Date_debut_lock"];
    $Dateh = date("Y-m-d H:i:s");

    //echo $idCasier;


    $updateStmt = $db->prepare("UPDATE casiers_emprunt SET Adresse_mail = NULL, Date_debut_lock = NULL WHERE Adresse_mail = :Adresse_mail");
    $updateStmt->bindParam(':Adresse_mail', $Adresse_mail);

    if ($updateStmt->execute()) {
        //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
        $updateStmt1 = $db->prepare("INSERT INTO toutes_locs (Id_Casiers, Adresse_mail, Date_debut_lock, Date_fin_lock) VALUES (:idCasier, :Adresse_mail, :Date_debut_lock, :Date_fin_lock)");
        $updateStmt1->bindParam(':idCasier', $idCasier);
        $updateStmt1->bindParam(':Adresse_mail', $Adresse_mail);
        $updateStmt1->bindParam(':Date_debut_lock', $Date_debut_lock);
        $updateStmt1->bindParam(':Date_fin_lock', $Dateh);
        $updateStmt1->execute();

        header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
        exit;
    } else {
        //echo "Une erreur s'est produite lors de la mise à jour de l'adresse e-mail.";
    }




    }









}elseif($table == 'cables'){
    if ($typeaction == "Emprunter") {

        $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
        
        $stmt = $db->query('SELECT * FROM cables WHERE Adresse_mail IS NULL');
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //var_dump($row);
        
        $idCasier = $row["Id_Casiers"];
        //echo $idCasier;
    
        $Dateh = date("Y-m-d H:i:s");
    
    
        $updateStmt = $db->prepare("INSERT INTO cables (`Id_Casiers`, `Adresse_mail`, `Date_debut_lock`) VALUES (:idCasier, :Adresse_mail, :Dateh)");
        $updateStmt->bindParam(':Adresse_mail', $Adresse_mail);
        $updateStmt->bindParam(':idCasier', $idCasier);
        $updateStmt->bindParam(':Dateh', $Dateh);
    
        if ($updateStmt->execute()) {
            //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
            header("Location: https://192.168.138.102:8080/power" .$idCasier . ".html");
            exit;
        } else {
            //echo "Une erreur s'est produite lors de la mise à jour de l'adresse e-mail.";
        }
        
        
    
        
        }elseif($typeaction == "Rendre"){
        
        $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
        
        $stmt = $db->prepare('SELECT * FROM cables WHERE Adresse_mail = :Adresse_mail');
        $stmt->bindParam(':Adresse_mail', $Adresse_mail);

        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //var_dump($row);
        
        $idCasier = $row["Id_Casiers"];
        $Date_debut_lock = $row["Date_debut_lock"];
        $Dateh = date("Y-m-d H:i:s");

        $stmt = $db->prepare('DELETE FROM cables WHERE Adresse_mail = :Adresse_mail');
        $stmt->bindParam(':Adresse_mail', $Adresse_mail);
        $stmt->execute();
    
        //echo $idCasier;
    
    
        
        //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
        $updateStmt1 = $db->prepare("INSERT INTO toutes_locs (Id_Casiers, Adresse_mail, Date_debut_lock, Date_fin_lock) VALUES (:idCasier, :Adresse_mail, :Date_debut_lock, :Date_fin_lock)");
        $updateStmt1->bindParam(':idCasier', $idCasier);
        $updateStmt1->bindParam(':Adresse_mail', $Adresse_mail);
        $updateStmt1->bindParam(':Date_debut_lock', $Date_debut_lock);
        $updateStmt1->bindParam(':Date_fin_lock', $Dateh);
        $updateStmt1->execute();

        header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
        exit;
        }  
       


}elseif($table == 'rallonge'){
    if ($typeaction == "Emprunter") {

        $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
        
        $stmt = $db->query('SELECT * FROM rallonge WHERE Adresse_mail IS NULL');
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //var_dump($row);
        
        $idCasier = $row["Id_Casiers"];
        //echo $idCasier;
    
        $Dateh = date("Y-m-d H:i:s");
    
    
        $updateStmt = $db->prepare("INSERT INTO rallonge (`Id_Casiers`, `Adresse_mail`, `Date_debut_lock`) VALUES (:idCasier, :Adresse_mail, :Dateh)");
        $updateStmt->bindParam(':Adresse_mail', $Adresse_mail);
        $updateStmt->bindParam(':idCasier', $idCasier);
        $updateStmt->bindParam(':Dateh', $Dateh);
    
        if ($updateStmt->execute()) {
            //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
            header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
            exit;
        } else {
            //echo "Une erreur s'est produite lors de la mise à jour de l'adresse e-mail.";
        }
        
        }elseif($typeaction == "Rendre"){
        
        $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
        
        $stmt = $db->prepare('SELECT * FROM rallonge WHERE Adresse_mail = :Adresse_mail');
        $stmt->bindParam(':Adresse_mail', $Adresse_mail);

        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //var_dump($row);
        
        $idCasier = $row["Id_Casiers"];
        $Date_debut_lock = $row["Date_debut_lock"];
        $Dateh = date("Y-m-d H:i:s");

        $stmt = $db->prepare('DELETE FROM rallonge WHERE Adresse_mail = :Adresse_mail');
        $stmt->bindParam(':Adresse_mail', $Adresse_mail);
        $stmt->execute();
    
        //echo $idCasier;
    
    
        
        //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
        $updateStmt1 = $db->prepare("INSERT INTO toutes_locs (Id_Casiers, Adresse_mail, Date_debut_lock, Date_fin_lock) VALUES (:idCasier, :Adresse_mail, :Date_debut_lock, :Date_fin_lock)");
        $updateStmt1->bindParam(':idCasier', $idCasier);
        $updateStmt1->bindParam(':Adresse_mail', $Adresse_mail);
        $updateStmt1->bindParam(':Date_debut_lock', $Date_debut_lock);
        $updateStmt1->bindParam(':Date_fin_lock', $Dateh);
        $updateStmt1->execute();

        header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
        exit;
        
    
        }  
       


}elseif($table == 'souris'){
    if ($typeaction == "Emprunter") {

        $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
        
        $stmt = $db->query('SELECT * FROM souris WHERE Adresse_mail IS NULL');
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //var_dump($row);
        
        $idCasier = $row["Id_Casiers"];
        //echo $idCasier;
    
        $Dateh = date("Y-m-d H:i:s");
    
    
        $updateStmt = $db->prepare("INSERT INTO souris (`Id_Casiers`, `Adresse_mail`, `Date_debut_lock`) VALUES (:idCasier, :Adresse_mail, :Dateh)");
        $updateStmt->bindParam(':Adresse_mail', $Adresse_mail);
        $updateStmt->bindParam(':idCasier', $idCasier);
        $updateStmt->bindParam(':Dateh', $Dateh);
    
        if ($updateStmt->execute()) {
            //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
            header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
            exit;
        } else {
            //echo "Une erreur s'est produite lors de la mise à jour de l'adresse e-mail.";
        }
        
        }elseif($typeaction == "Rendre"){
        
        $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
        
        $stmt = $db->prepare('SELECT * FROM souris WHERE Adresse_mail = :Adresse_mail');
        $stmt->bindParam(':Adresse_mail', $Adresse_mail);

        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //var_dump($row);
        
        $idCasier = $row["Id_Casiers"];
        $Date_debut_lock = $row["Date_debut_lock"];
        $Dateh = date("Y-m-d H:i:s");

        $stmt = $db->prepare('DELETE FROM souris WHERE Adresse_mail = :Adresse_mail');
        $stmt->bindParam(':Adresse_mail', $Adresse_mail);
        $stmt->execute();
    
        //echo $idCasier;
    
    
        
        //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
        $updateStmt1 = $db->prepare("INSERT INTO toutes_locs (Id_Casiers, Adresse_mail, Date_debut_lock, Date_fin_lock) VALUES (:idCasier, :Adresse_mail, :Date_debut_lock, :Date_fin_lock)");
        $updateStmt1->bindParam(':idCasier', $idCasier);
        $updateStmt1->bindParam(':Adresse_mail', $Adresse_mail);
        $updateStmt1->bindParam(':Date_debut_lock', $Date_debut_lock);
        $updateStmt1->bindParam(':Date_fin_lock', $Dateh);
        $updateStmt1->execute();

        header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
        exit;
    
        }  
       


}else if($table == 'casiers_depot'){
    if ($typeaction == "Emprunter") {

    $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
    
    $stmt = $db->query('SELECT * FROM casiers_libre_service WHERE Adresse_mail IS NULL ORDER BY RAND() LIMIT 1');
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($row);
    
    $idCasier = $row["Id_Casiers"];
    //echo $idCasier;

    $Dateh = date("Y-m-d H:i:s");


    $updateStmt = $db->prepare("UPDATE casiers_libre_service SET Adresse_mail = :Adresse_mail, Date_debut_lock = :Dateh WHERE Id_Casiers = :idCasier");
    $updateStmt->bindParam(':Adresse_mail', $Adresse_mail);
    $updateStmt->bindParam(':idCasier', $idCasier);
    $updateStmt->bindParam(':Dateh', $Dateh);

    if ($updateStmt->execute()) {
        //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
        header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
        exit;
    } else {
        //echo "Une erreur s'est produite lors de la mise à jour de l'adresse e-mail.";
    }
    
    

    
    }elseif($typeaction == "Rendre"){
    
    $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user,$pass);
    
    $selectStmt = $db->prepare('SELECT * FROM casiers_libre_service WHERE Adresse_mail = :Adresse_mail');
    $selectStmt->bindParam(':Adresse_mail', $Adresse_mail);
    $selectStmt->execute();

    $row = $selectStmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($row);
    
    $idCasier = $row["Id_Casiers"];
    $Date_debut_lock = $row["Date_debut_lock"];
    $Dateh = date("Y-m-d H:i:s");

    //echo $idCasier;


    $updateStmt = $db->prepare("UPDATE casiers_libre_service SET Adresse_mail = NULL, Date_debut_lock = NULL WHERE Adresse_mail = :Adresse_mail");
    $updateStmt->bindParam(':Adresse_mail', $Adresse_mail);

    if ($updateStmt->execute()) {
        //echo "La mise à jour de l'adresse e-mail a été effectuée avec succès.";
        $updateStmt1 = $db->prepare("INSERT INTO toutes_locs (Id_Casiers, Adresse_mail, Date_debut_lock, Date_fin_lock) VALUES (:idCasier, :Adresse_mail, :Date_debut_lock, :Date_fin_lock)");
        $updateStmt1->bindParam(':idCasier', $idCasier);
        $updateStmt1->bindParam(':Adresse_mail', $Adresse_mail);
        $updateStmt1->bindParam(':Date_debut_lock', $Date_debut_lock);
        $updateStmt1->bindParam(':Date_fin_lock', $Dateh);
        $updateStmt1->execute();

       // header("Location: loader.php?idCasier=" . urlencode($idCasier));
       header("Location: https://192.168.138.102:8080/power" .$idCasier. ".html");
       exit;
    } else {
        //echo "Une erreur s'est produite lors de la mise à jour de l'adresse e-mail.";
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