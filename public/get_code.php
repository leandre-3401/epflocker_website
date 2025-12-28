<?php
session_start();

function connectDB() {
    $dsn = 'mysql:host=localhost;port=3306;dbname=epflocker_db';
    $user = 'epflocker';
    $password = '3pfl0ck3r';

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

function generateRandomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$message = ""; 
$redirectTo = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm'])) {
        $code_acces = generateRandomPassword(10);

        if (isset($_SESSION['user_email'])) {
            $email = $_SESSION['user_email'];
            $pdo = connectDB();
            $id_casier = $_GET['id'] ?? '0';
            $type = "Reservation";
            $stmt = $pdo->prepare("INSERT INTO emprunt (ID_Casier, Date_emprunt, Code_acces, Date_retour, Adresse_email, nombre_actions,type) VALUES (?, NOW(), ?, NULL, ?, 0, ?)");
            $stmt->execute([$id_casier, $code_acces, $email, $type]);

            $stmt = $pdo->prepare("UPDATE casier SET Status = 0 WHERE ID_Casier = ?");
            $stmt->execute([$id_casier]);

            $message = '<strong>La réservation a été confirmée !</strong> Votre code d\'accès est : ' . $code_acces;
            $redirectTo = "all_casiers.php";
        }
    } elseif (isset($_POST['cancel'])) {
        $message = "La réservation a été annulée.";
        $redirectTo = "all_casiers.php";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
body {
    background-image: url('images/fond1.png');
    background-size: cover;
    background-position: center;
}
</style>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Confirmer la réservation du Casier Numero <?php echo $_GET["id"]?></h5>
                        <p class="card-text">Êtes-vous sûr de vouloir réserver ?</p>
                        <form method="post">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name="confirm">Oui</button>
                                <button type="submit" class="btn btn-secondary" name="cancel">Non</button>
                            </div>
                        </form>
                        <?php if (!empty($message)): ?>
                        <div class="alert alert-success mt-3"><?php echo $message; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php if (!empty($redirectTo)): ?>
    <script>
    setTimeout(function() {
        window.location.href = '<?php echo $redirectTo; ?>';
    }, 4000);
    </script>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>