<?php 
    $dsn = 'mysql:host=localhost;port=3307;dbname=epflocker_db';
    $user = 'epflocker';// epflocker
    $pass = '3pfl0ck3r'; // A mettre après user dans $db
    $db = new PDO ($dsn,$user,$pass); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // on lance l'authentification Azure directement 
        include 'auth.php';//co azure
        $Auth = new modAuth();
        $Adresse_mail = $Auth->userName;//recup adresse mail 
        //attribution table courante 
     
        $sql = 'INSERT INTO users (Adresse_mail, Password, Level)
        VALUES ($Adresse_mail, "microsoft_psw", 2);'; 

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['Adresse_mail' => $Adresse_mail]);
        header('Location: https://epflocker.mde.epf.fr/index.php');
        exit();
?>


<?php 
$dsn = 'mysql:host=localhost;port=3307;dbname=epflocker_db';
$user = 'epflocker';
$pass = '3pfl0ck3r';

try {
    // Connexion à la base de données
    $db = new PDO($dsn, $user, $pass); 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inclusion et utilisation de l'authentification Azure
    include 'inc/auth.php'; // Inclure le fichier d'authentification
    $Auth = new modAuth();
    $Adresse_mail = $Auth->userName; // Récupérer l'adresse mail de l'utilisateur authentifié

    // Définir les valeurs pour le mot de passe et le niveau
    $Password = 'microsoft_psw';
    $Level = 2;

    // Préparer et exécuter l'insertion dans la base de données
    $sql = 'INSERT INTO users (Adresse_mail, Password, Level) VALUES (:Adresse_mail, :Password, :Level)';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'Adresse_mail' => $Adresse_mail,
        'Password' => $Password,
        'Level' => $Level
    ]);

    // Redirection après succès
    header('Location: https://epflocker.mde.epf.fr/index.php');
    exit();
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit();
}
?>








?>