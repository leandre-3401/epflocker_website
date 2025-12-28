<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casiers</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-..." crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    body {
        background-image: url('images/fond1.png');
        background-size: cover;
        background-position: center;
    }
    </style>

</head>
<?php session_start();?>
<?php
include("header.php");
?>
<?php
include("welcome_back_user.php")
?>

<body>
    <h1 class="text-white font-weight-bold text-center mt-10">Mes Réservations et Emprunts</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center text-white">Emprunts</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nom du casier</th>
                                <th scope="col">Code</th>
                                <th scope="col">Nom du Produit</th>
                                <th scope="col">Etat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dsn = 'mysql:host=localhost;port=3306;dbname=epflocker_db';
                            $user = 'epflocker';
                            $password = '3pfl0ck3r';

                            try {
                                $pdo = new PDO($dsn, $user, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $email = $_SESSION['user_email'];

                                $sql = "SELECT casier.ID_Casier, casier.Fonction, emprunt.type, casier.Status, produit.nom, produit.id, produit.quantite AS id_produit, emprunt.Code_acces
                                    FROM casier
                                    INNER JOIN emprunt ON casier.ID_Casier = emprunt.ID_Casier
                                    INNER JOIN produit ON emprunt.id_produit = produit.id
                                    WHERE emprunt.Adresse_email = '$email' AND emprunt.type = 'Emprunt' AND Date_retour IS NULL";                
                                $stmt = $pdo->query($sql);
                                
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $status = $row["Status"];
                                    echo '<tr>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["ID_Casier"] . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["Code_acces"] . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["nom"] . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">';
                                    echo '<a href="back_code.php?id=' . $row["ID_Casier"] .'&produit=' . urlencode($row["id_produit"]) .'" class="btn btn-warning">Rendre</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                
                                if ($stmt->rowCount() == 0) {
                                    echo '<tr><td colspan="6" class="text-center">Aucun emprunt en cours.</td></tr>';
                                }
                                
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-center text-white">Réservations</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nom du casier</th>
                                <th scope="col">Code</th>
                                <th scope="col">Etat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $sql = "SELECT casier.ID_Casier,  emprunt.type, casier.Status, emprunt.Code_acces
                                    FROM casier
                                    INNER JOIN emprunt ON casier.ID_Casier = emprunt.ID_Casier
                                    WHERE emprunt.Adresse_email = '$email' AND emprunt.type != 'Emprunt' AND Date_retour IS NULL";                
                                $stmt = $pdo->query($sql);
                                
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $status = $row["Status"];
                                    echo '<tr>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["ID_Casier"] . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["Code_acces"] . '</td>';


                                    echo '<td style="color: white; font-weight: bold;">';
                                    echo '<a href="back_code.php?id=' . $row["ID_Casier"] . '" class="btn btn-warning">Retouner</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                
                                if ($stmt->rowCount() == 0) {
                                    echo '<tr><td colspan="6" class="text-center">Aucune réservation en cours.</td></tr>';
                                }
                                
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>