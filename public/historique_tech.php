<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casiers</title>
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
            <div class="col-md-10">
                <h2 class="text-center text-white">Historique des Emprunts (7 derniers jours)</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nom du casier</th>
                                <th scope="col">Code</th>
                                <th scope="col">Nom du Produit</th>
                                <th scope="col">Date Emprunt</th>

                                <th scope="col">Date de retour</th>
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
                                $seven_days_ago = date('Y-m-d H:i:s', strtotime('-7 days'));

                                $sql_emprunt = "SELECT casier.ID_Casier, casier.Fonction, casier.Status, produit.nom, produit.id AS id_produit, emprunt.Code_acces, emprunt.Date_retour, emprunt.Date_emprunt
                                    FROM casier
                                    INNER JOIN emprunt ON casier.ID_Casier = emprunt.ID_Casier
                                    LEFT JOIN produit ON emprunt.id_produit = produit.id
                                    WHERE emprunt.Adresse_email = '$email' AND emprunt.Date_retour IS NOT NULL AND emprunt.Date_retour >= '$seven_days_ago' AND emprunt.type = 'Emprunt'";                
                                $stmt_emprunt = $pdo->query($sql_emprunt);
                                
                                while ($row = $stmt_emprunt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<tr>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["ID_Casier"] . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["Code_acces"] . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">' . ($row["nom"] ?? 'N/A') . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["Date_emprunt"] . '</td>';

                                    echo '<td style="color: white; font-weight: bold;">' . $row["Date_retour"] . '</td>';
                                    echo '</tr>';
                                }
                                
                                if ($stmt_emprunt->rowCount() == 0) {
                                    echo '<tr><td colspan="4" class="text-center">Aucun retour d\'emprunt dans les 7 derniers jours.</td></tr>';
                                }
                                
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="text-center text-white">Historique des Réservations (7 derniers jours)</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nom du casier</th>
                                <th scope="col">Code</th>
                                <th scope="col">Date de retour</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $sql_reservation = "SELECT casier.ID_Casier, casier.Fonction, casier.Status, emprunt.Code_acces, emprunt.Date_retour
                                    FROM casier
                                    INNER JOIN emprunt ON casier.ID_Casier = emprunt.ID_Casier
                                    WHERE emprunt.Adresse_email = '$email' AND emprunt.Date_retour IS NOT NULL AND emprunt.Date_retour >= '$seven_days_ago' AND emprunt.type = 'Reservation'";                
                                $stmt_reservation = $pdo->query($sql_reservation);
                                
                                while ($row = $stmt_reservation->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<tr>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["ID_Casier"] . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["Code_acces"] . '</td>';
                                    echo '<td style="color: white; font-weight: bold;">' . $row["Date_retour"] . '</td>';
                                    echo '</tr>';
                                }
                                
                                if ($stmt_reservation->rowCount() == 0) {
                                    echo '<tr><td colspan="3" class="text-center">Aucun retour de réservation dans les 7 derniers jours.</td></tr>';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>