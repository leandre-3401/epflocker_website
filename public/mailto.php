<?php

$usersql = "epflocker";
$passsql = "3pfl0ck3r";

try {
    $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $usersql, $passsql);

    // Récupérer la date d'aujourd'hui
    $currentDate = date('Y-m-d');
    echo $currentDate;

    // Récupérer les adresses e-mail de la table 'cables' ajoutées aujourd'hui
    $stmt = $db->prepare('SELECT Adresse_mail FROM cables WHERE DATE(Date_debut_lock) = :currentDate');
    $stmt->bindValue(':currentDate', $currentDate);
    $stmt->execute();
    $cablesEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Récupérer les adresses e-mail de la table 'rallonge' ajoutées aujourd'hui
    $stmt = $db->prepare('SELECT Adresse_mail FROM rallonge WHERE DATE(Date_debut_lock) = :currentDate');
    $stmt->bindValue(':currentDate', $currentDate);
    $stmt->execute();
    $rallongeEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Récupérer les adresses e-mail de la table 'casiers_emprunt' ajoutées aujourd'hui
    $stmt = $db->prepare('SELECT Adresse_mail FROM casiers_emprunt WHERE DATE(Date_debut_lock) = :currentDate');
    $stmt->bindValue(':currentDate', $currentDate);
    $stmt->execute();
    $casiersEmpruntEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Récupérer les adresses e-mail de la table 'casiers_libre_service' ajoutées aujourd'hui
    $stmt = $db->prepare('SELECT Adresse_mail FROM casiers_libre_service WHERE DATE(Date_debut_lock) = :currentDate');
    $stmt->bindValue(':currentDate', $currentDate);
    $stmt->execute();
    $casiersLibreServiceEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Récupérer les adresses e-mail de la table 'souris' ajoutées aujourd'hui
    $stmt = $db->prepare('SELECT Adresse_mail FROM souris WHERE DATE(Date_debut_lock) = :currentDate');
    $stmt->bindValue(':currentDate', $currentDate);
    $stmt->execute();
    $sourisEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Fusionner toutes les adresses e-mail dans un tableau unique
    $allEmails = array_merge($cablesEmails, $rallongeEmails, $casiersEmpruntEmails, $casiersLibreServiceEmails, $sourisEmails);

    // Supprimer les doublons des adresses e-mail
    $uniqueEmails = array_unique($allEmails);

    // Afficher les adresses e-mail
    foreach ($uniqueEmails as $email) {
        echo $email . '<br>';
    }

} catch (PDOException $e) {
    echo "Une erreur s'est produite lors de la connexion à la base de données : " . $e->getMessage();
}

// Inclure le fichier d'exception de PHPMailer
require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/Exception.php';

// Inclure les fichiers PHPMailer nécessaires
require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/PHPMailer.php';
require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Créer une instance de PHPMailer
$mail = new PHPMailer();

// Configurer les paramètres SMTP


// Configurer les informations de l'expéditeur
$mail->isSMTP();
$mail->Host = 'saveur.o2switch.net';
$mail->SMTPAuth = true;
$mail->Username = 'locker@epf-mtp.fr';
$mail->Password = 'JeGnYfrfNPTS';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465; //587 // 465
// Configurer les informations de l'expéditeur et du destinataire

$mail->setFrom('locker@epf-mtp.fr', 'EPF Locker');


foreach ($uniqueEmails as $email) {
    // Configurer le destinataire
    $mail->addAddress($email);

    // Définir le contenu spécifique de l'e-mail en fonction de l'adresse e-mail
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $message = file_get_contents('/var/www/html/EPF_Locker2/public/design_mail.html');
    $message = utf8_encode($message);
    //$message = ''; 
    // Configurer le contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Rendu EPF LOCKER';
    $mail->msgHTML($message);
    $mail->CharSet = 'UTF-8';
    // Envoyer l'e-mail
    if (!$mail->send()) {
        echo 'Erreur lors de l\'envoi de l\'e-mail à ' . $email . ': ' . $mail->ErrorInfo . '<br>';
    } else {
        echo 'E-mail envoyé avec succès à ' . $email . '<br>';
    }

    // Réinitialiser les destinataires pour l'e-mail suivant
    $mail->clearAddresses();
}

?>
