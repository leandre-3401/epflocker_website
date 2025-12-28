<?php

// Prend la valeur du badge soit je recup le mail ou alors j'attribue le mail grâce à la connexion Azure
$user = 'epflocker';// epflocker
$pass = '3pfl0ck3r'; // A mettre après user dans $db



try
{
    $db = new PDO ('mysql:host=localhost;dbname=epflocker_db',$user,$pass); //Ici je suis en local donc>    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$stmt = $db->query('SELECT '. $variableRequete .' FROM `Casiers_Emprunt`');
    $stmt = $db->query('SELECT  Adresse_mail FROM RFID WHERE Id_Rfid='.$idRfid.'');
   // $stmt->bindParam(':badge', $idRfid);
    $resultats = $stmt->fetchAll();
    foreach ($resultats as $row) {
        $Adresse_mail = $row['Adresse_mail']; //récupère la vlaeur de l'adresse mail 
      }
    if($Adresse_mail=="None"){
        echo"Il faut attribuer une adresse mail !";
        // conexxion Azure 
        $retour="mail_rfid.php";
        include '../inc/auth.php';
        $Auth = new modAuth();
        $Adresse_mail = $Auth->userName;
        //$Adresse_mail="hugo.lacombe@epfedu.fr";
        //on rentre l'adresse mail correspondant à la vlaeur du badge 
        $stmt1 = $db->prepare('UPDATE RFID SET Adresse_mail = :adresse WHERE Id_Rfid = :badge');
        $stmt1->bindParam(':badge', $idRfid);
        $stmt1->bindParam(':adresse', $Adresse_mail);
        $stmt1->execute();
    }

    
}
catch (PDOException $e)
{
    print "Erreur :" . $e->getMessage() . "<br/>";
    die; //arrête tout le programme
}
//echo($Adresse_mail); 
?>