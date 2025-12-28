<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php 
//diff. ip local =>192.168.138.102 renvoie vers co. Azure sinon visualisation casier

    $user = 'epflocker';// epflocker
    $pass = '3pfl0ck3r'; // A mettre après user dans $db
    $db = new PDO ('mysql:host=localhost;dbname=epflocker_db',$user,$pass); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($IP=='192.168.138.102'){ //au locker

    //$stmt = $db->query('SELECT '. $variableRequete .' FROM `Casiers_Emprunt`');
    $stmt = $db->query('SELECT * FROM table_courante ');
   // $stmt->bindParam(':badge', $idRfid);
    $resultats = $stmt->fetchAll();
    foreach ($resultats as $row) {
        $Adresse_mail = $row['Adresse_mail']; //récupère la valeur de l'adresse mail (soit None soit la bonne )
        $idRfid = $row['Id_Badge']; 
      }
    
    //On regarde ce qu'il y a dans la bdd courante 

    //Connexion avec un badge 
    if($idRfid != "None"){
        $stmt1 = $db->query('SELECT  Adresse_mail FROM RFID WHERE Id_Rfid='.$idRfid.'');
        $resultats1 =$stmt1->fetchAll();
        $Adresse_mail=$resultats1[0]['Adresse_mail'];
        
        //première co. avec un badge => renvoie vers Azure
        if($Adresse_mail=="None"){ 
            include '../inc/oauth.php';//co azure
            $Auth = new modAuth();
            $Adresse_mail = $Auth->userName;//recup adresse mail 
            //Attricbution dans la BDD  RFID 
            $stmt2 = $db->prepare('UPDATE RFID SET Adresse_mail = :adresse WHERE Id_Rfid = :badge');
            $stmt2->bindParam(':badge', $idRfid);
            $stmt2->bindParam(':adresse', $Adresse_mail);
            $stmt2->execute();
            //attribution table courante et renvoi vers service 
            $stmt3 = $db->prepare('UPDATE table_courante SET Adresse_mail = :adresse WHERE Id_Badge = :badge'); //adresse mail dans table courante en face du badge
            $stmt3->bindParam(':badge', $idRfid);
            $stmt3->bindParam(':adresse', $Adresse_mail);
            $stmt3->execute();
            //renvoi en fonction du compte 
            $stmt6 = $db->prepare('SELECT * FROM admin WHERE Adresse_mail = :adresse ');
            $stmt6->bindParam(':adresse', $Adresse_mail);
            $stmt6->execute();
            $resultats6 = $stmt6->fetchAll();
            if(count($resultats6)==1){
            header('Location: https://epflocker.mde.epf.fr/admin.php');
            exit();
            }
            //redir service.php

            header('Location: https://epflocker.mde.epf.fr/service.php');
            exit();
        }
        
        else{
            //attribution table courante pareil 
            $stmt4 = $db->prepare('UPDATE table_courante SET Adresse_mail = :adresse WHERE Id_Badge = :badge'); //adresse mail dans table courante en face du badge
            $stmt4->bindParam(':badge', $idRfid);
            $stmt4->bindParam(':adresse', $Adresse_mail);
            $stmt4->execute();
             //renvoi en fonction du compte 
             $stmt7 = $db->prepare('SELECT * FROM admin WHERE Adresse_mail = :adresse ');
             $stmt7->bindParam(':adresse', $Adresse_mail);
             $stmt7->execute();
             $resultats7 = $stmt7->fetchAll();
             if(count($resultats7)==1){
             header('Location: /admin.php');
             exit();
             }
            //renvoi 
            header('Location: /service.php');
            exit();
        }


    }
    //on ne passe pas par le badge 
    else{
        // on lance l'authentification Azure directement 
        include '../inc/auth.php';//co azure
        $Auth = new modAuth();
        $Adresse_mail = $Auth->userName;//recup adresse mail 
        //attribution table courante 
        $stmt5 = $db->prepare('UPDATE table_courante SET Adresse_mail = :adresse WHERE Id_Badge = "None"'); //adresse mail dans table courante en face du badge
        $stmt5->bindParam(':adresse', $Adresse_mail);
        $stmt5->execute();

         //renvoi en fonction du compte 
         $stmt8 = $db->prepare('SELECT * FROM admin WHERE Adresse_mail = :adresse');
         $stmt8->bindParam(':adresse', $Adresse_mail);
         $stmt8->execute();
         $resultats8 = $stmt8->fetchAll();
         if(count($resultats8)==1){
         header('Location: /admin.php');
         exit();
         }

        //redirection vers service.php 
        header('Location: /service.php');
        exit();

    }
}
  

   
else{
    header('Location: https://epflocker.mde.epf.fr/visualisation_casiers.php');
    exit();
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