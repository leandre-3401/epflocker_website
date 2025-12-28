<?php
session_start(); // Démarrer la session

if (isset($_GET['id'])) {
    $_SESSION['id_casier'] = $_GET['id'];
    $_SESSION['id_produit'] = $_GET['produit']??'';
}

$id = $_SESSION['id_casier'] ?? ''; 
$id_produit =  $_SESSION['id_produit']?? '';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
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
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Entrez votre code du casier <?php echo $id; ?></h5>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            try {
                                $dsn = "mysql:host=localhost;port=3306;dbname=epflocker_db";
                                $user = 'epflocker';
                                $password = '3pfl0ck3r';
                                $pdo = new PDO($dsn, $user, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                if ($id) {
                                    $numero = $id;
                                    $code = $_POST["code"];
                                    $sql = "SELECT * FROM emprunt WHERE ID_Casier = ? AND Code_acces = ?";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute([$numero, $code]);
                                    $result = $stmt->fetchAll();

                                    if (count($result) > 0) {
                                        if ($numero === "A1") {
                                            $updateSql = "UPDATE emprunt SET Date_retour = NOW() WHERE ID_Casier = ? AND date_retour IS NULL AND id_produit=?";
                                            $updateStmt = $pdo->prepare($updateSql);
                                            $updateStmt->execute([$numero,$id_produit]);
                                        } else {
                                            $updateSql = "UPDATE emprunt SET Date_retour = NOW() WHERE ID_Casier = ? AND date_retour IS NULL";
                                            $updateStmt = $pdo->prepare($updateSql);
                                            $updateStmt->execute([$numero]);
                                        }

                                        echo '<div class="alert alert-success" role="alert">';
                                        echo "Tout est OK. Le casier $numero a été sélectionné avec succès.";
                                        echo '</div>';
                                        echo '<meta http-equiv="refresh" content="4;url=list_casiers.php">';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo "Les informations saisies pour le casier $numero sont incorrectes. Veuillez vérifier le numéro du casier et le code.";
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo "Aucun numéro de casier n'a été passé dans l'URL.";
                                    echo '</div>';
                                }
                                $pdo = null;
                            } catch (PDOException $e) {
                                die("Erreur de connexion à la base de données : " . $e->getMessage());
                            }
                        }
                        ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="code" placeholder="Code d'accès">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>