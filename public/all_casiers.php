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
    <h1 class="text-white font-weight-bold text-center mt-10">Liste Des Casiers</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php
            $dsn = 'mysql:host=localhost;port=3306;dbname=epflocker_db';
            $user = 'epflocker';
            $password = '3pfl0ck3r';

            try {
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $email = $_SESSION['user_email'];

                $sql = "SELECT * FROM casier;
                
                ";
                $stmt = $pdo->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $status = $row["Status"];
                    $cardBorder = $status ? 'border-primary' : 'border-danger';
                    echo '<div class="col-md-3 mb-4 d-flex justify-content-center">';
                    echo '<div class="card border ' . $cardBorder . ' shadow-0">';
                    echo '<div class="card-header text-center font-weight-bold">' . $row["ID_Casier"] . '</div>';
                    echo '<img src="images\casier_unique.png" class="card-img-top" alt="Casier">';
                    echo '<div class="card-body text-primary">';
                    echo '<p class="card-text text-center">Status: ' . (!$status ? 'En cours d\'utilisation':'Inactif') . '</p>';
                    if ($row["ID_Casier"] == 'A1') {
                        echo '<div class="text-center "><a href="select_item.php" class="btn btn-success">Emprunter</a></div>';
                    } else {
                        if ($status) {
                            echo '<div class="text-center "><a href="get_code.php?id=' . $row["ID_Casier"] . '" class="btn btn-primary btn-block">Reserve</a></div>';
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>