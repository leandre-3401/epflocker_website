<?php
$user = 'epflocker';// epflocker
$pass = '3pfl0ck3r'; // A mettre après user dans $db
 try {
$db = new PDO('mysql:host=localhost;dbname=epflocker_db', $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Supprimer toutes les lignes de la table
$db->exec('DELETE FROM table_courante');

$stmt = $db->prepare('INSERT INTO table_courante (Adresse_mail, Id_Badge) VALUES (:adresse_mail, :id_badge)');
$stmt->bindValue(':adresse_mail', 'None');
$stmt->bindValue(':id_badge', 'None');
$stmt->execute();

} catch (PDOException $e) {
print "Erreur :" . $e->getMessage() . "<br/>";
die; // Arrête tout le programme
}

header("Location: https://epflocker.mde.epf.fr/authentification.php");
       exit;




?>