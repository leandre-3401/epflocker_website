<?php
// Adresse e-mail à qui envoyer le fichier CSV
$to = "ilona.bematol@epfedu.fr";
// Sujet de l'e-mail
$subject = "Fichier CSV mon poulet";


// Entêtes de l'e-mail
$headers = "From: votre_adresse_email@exemple.com\r\n";
$headers .= "Reply-To: votre_adresse_email@exemple.com\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"frontier\"\r\n";

// Contenu de l'e-mail
$message = "--frontier\r\n";
$message .= "Content-Type: text/plain\r\n";
$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$message .= "Veuillez trouver ci-joint le fichier CSV demandé.\r\n";
$message .= "--frontier\r\n";

$message .= "Content-Transfer-Encoding: base64\r\n";

$message .= "--frontier--\r\n";

// Envoie l'e-mail
if (mail($to, $subject, $message, $headers)) {
    echo "Le fichier a été envoyé avec succès à $to.";
} else {
    echo "Erreur lors de l'envoi de l'e-mail.";
}

?>
