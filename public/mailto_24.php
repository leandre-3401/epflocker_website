<?php

$usersql = "epflocker";
$passsql = "3pfl0ck3r";

        
try {
        $db = new PDO('mysql:host=localhost;dbname=epflocker_db', $usersql, $passsql);
        // Récupérer la date d'aujourd'hui
        $currentDate = date('Y-m-d H-i-s', strtotime('-24 hours'));
        echo $currentDate;
    
        // Récupérer les adresses e-mail de la table 'casiers_libre_service' ajoutées il y a plus de 24 heures
        $stmt = $db->prepare('SELECT Adresse_mail FROM casiers_libre_service WHERE Date_debut_lock < :currentDate');
        $stmt->bindValue(':currentDate', $currentDate);
        $stmt->execute();
        $casiersLibreServiceEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);


        // Récupérer les adresses e-mail de la table 'cables' ajoutées il y a plus de 24 heures
        $stmt = $db->prepare('SELECT Adresse_mail FROM cables WHERE Date_debut_lock < :currentDate');
        $stmt->bindValue(':currentDate', $currentDate);
        $stmt->execute();
        $cablesEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Récupérer les adresses e-mail de la table 'rallonge' ajoutées il y a plus de 24 heures
        $stmt = $db->prepare('SELECT Adresse_mail FROM rallonge WHERE Date_debut_lock < :currentDate');
        $stmt->bindValue(':currentDate', $currentDate);
        $stmt->execute();
        $rallongeEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Récupérer les adresses e-mail de la table 'casiers_emprunt' ajoutées il y a plus de 24 heures
        $stmt = $db->prepare('SELECT Adresse_mail FROM casiers_emprunt WHERE Date_debut_lock < :currentDate');
        $stmt->bindValue(':currentDate', $currentDate);
        $stmt->execute();
        $casiersEmpruntEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);
        // Récupérer les adresses e-mail de la table 'souris' ajoutées il y a plus de 24 heures
        $stmt = $db->prepare('SELECT Adresse_mail FROM souris WHERE Date_debut_lock < :currentDate');
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
        
        }   
        catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la connexion à la base de données : " . $e->getMessage();
        }
    
        // Inclure les fichiers PHPMailer nécessaires
        require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/PHPMailer.php';
        require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/SMTP.php';
        require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/Exception.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        // Créer une instance de PHPMailer
        $mail = new PHPMailer();
        // Configurer les informations de l'expéditeur
        //$mail->setFrom('epflocker@gmail.com', 'EPF Locker');
       /* $mail->isSMTP();
        $mail->Host = 'mail.gmx.com'; //saveur.o2switch.netmail.gmx.com
        $mail->SMTPAuth = true;
        $mail->Username = 'epflocker2@gmx.fr'; //locker@epf-mtp.fr
        $mail->Password = 'EpfL0ck€r?!'; //JeGnYfrfNPTS
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465; //587 // 465*/

        // Configurer les informations de l'expéditeur et du destinataire


        $mail->isSMTP();
        $mail->Host = 'saveur.o2switch.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'locker@epf-mtp.fr';
        $mail->Password = 'JeGnYfrfNPTS';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465; //587 // 465
        $mail->setFrom('locker@epf-mtp.fr', 'EPF Locker'); //locker@epf-mtp.fr


        // Envoyer un e-mail à chaque adresse
        foreach ($uniqueEmails as $email) {
            // Configurer le destinataire
            $mail->addAddress($email);

            $message = file_get_contents('/var/www/html/EPF_Locker2/public/design_mail_24.html');
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
