<?php
echo "toto test2";

// Inclure les fichiers PHPMailer nécessaires

require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/PHPMailer.php';
require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


// Créer une instance de PHPMailer
$mail = new PHPMailer();

/*// Configurer les paramètres SMTP
$mail->isSMTP();
$mail->Host = 'mailto'; //saveur.o2switch.netmail.gmx.com
$mail->SMTPAuth = true;
$mail->Username = 'energylab@gmx.fr'; //locker@epf-mtp.fr
$mail->Password = 'EnergyLab'; //JeGnYfrfNPTS
$mail->SMTPSecure = 'ssl';
$mail->Port = 465; //587 // 465

// Configurer les informations de l'expéditeur et du destinataire
$mail->setFrom('energylab@gmx.fr', 'EPF Locker');
$mail->addAddress('a.de.m@live.fr', 'Locker User');*/
// Configurer les paramètres SMTP
$mail->isSMTP();
$mail->Host = 'saveur.o2switch.net';
$mail->SMTPAuth = true;
$mail->Username = 'locker@epf-mtp.fr';
$mail->Password = 'JeGnYfrfNPTS';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465; //587 // 465
// Configurer les informations de l'expéditeur et du destinataire

$mail->setFrom('locker@epf-mtp.fr', 'EPF Locker');

$mail->addAddress('ilona.bematol@epfedu.fr', 'Locker User');
// Configurer le contenu de l'email
$mail->Subject = 'Sujet de l\'email';
$mail->Body = 'Contenu de l\'email';

// Envoyer l'email
if(!$mail->send()) {
    echo 'Erreur lors de l\'envoi de l\'email : ' . $mail->ErrorInfo;
} else {
    echo 'Email envoyé avec succès !';
}
?>
