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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $pdo = connectDB();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE Adresse_mail = :email AND Password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['user_id'] = $user['ID']; 
            $_SESSION['user_email'] = $user['Adresse_mail']; 
            header("Location: list_casiers.php");
            exit();
        } else {
            $error_message = "Adresse e-mail ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-image: url('images/fond1.png');
        background-size: cover;
        background-position: center;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-6">
            <h2 class="mb-4 text-white">Connexion</h2>
            <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
            <?php } ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label text-white font-weight-bold">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white font-weight-bold">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>