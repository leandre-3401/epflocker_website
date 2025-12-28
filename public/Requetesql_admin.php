<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php
session_start(); // Démarre la session

$tabletest = "";

// Informations de connexion à la base de données
$user = "epflocker";
$pass = "3pfl0ck3r";
$serveur = 'localhost';
$baseDeDonnees = 'epflocker_db';

// Connexion à la base de données
$connexion = new mysqli($serveur, $user, $pass, $baseDeDonnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Erreur de connexion à la base de données : " . $connexion->connect_error);
}

// Requête SQL pour récupérer les noms des tables
$sql = "SHOW TABLES";
$resultat = $connexion->query($sql);

// Vérification du résultat de la requête
if ($resultat === false) {
    die("Erreur lors de l'exécution de la requête : " . $connexion->error);
}

echo "<h1>Le nom de la base de données est : epflocker_db</h1><br><br>";
echo "<h2>Voici le nom des tables ainsi que des colonnes associées :</h2><br><br>";

// Affichage des noms des tables
?>
<div class="box">
    <?php
    while ($rowTable = $resultat->fetch_row()) {
        $nomTable = $rowTable[0];
        echo "<strong>Nom de la table :</strong> " . $nomTable . "<br>";

        // Requête SQL pour récupérer les noms des colonnes de la table actuelle
        $sqlColonnes = "SHOW COLUMNS FROM " . $nomTable;
        $resultatColonnes = $connexion->query($sqlColonnes);

        // Vérification du résultat de la requête
        if ($resultatColonnes === false) {
            die("Erreur lors de l'exécution de la requête : " . $connexion->error);
        }

        $ligne = 1;

        // Afficher les noms des colonnes
        while ($rowColonne = $resultatColonnes->fetch_assoc()) {
            $nomColonne = $rowColonne['Field'];
            echo "<strong>Nom de la colonne " . $ligne . " :</strong> " . $nomColonne . "<br>";
            $ligne += 1;
        }

        echo "<br>"; // Ajouter une ligne vide entre chaque table
    }

    // Fermeture de la connexion
    $connexion->close();
    ?>
</div>

<html>

<head>
    <h1>Entrez votre requête SQL :</h1>
</head>

<body>

    <style>
        body {
            background-image: url('images/Fond1.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="mot">Requête :</label>
        <input type="text" name="mot" id="mot">
        <input type="submit" value="Valider">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['mot'])) {
            $motSaisi = $_POST['mot'];
            echo "<h2>La requête est :</h2> " . $motSaisi . "<br>";

            $servername = "localhost";
            $username = "epflocker";
            $password = "3pfl0ck3r";
            $dbname = "epflocker_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Votre requête SQL stockée dans une variable
            $sql = $motSaisi;

            // Exécution de la requête
            $result = $conn->query($sql);

            // Vérification des erreurs
            if ($result === false) {
                echo "<h3>Erreur d'exécution de la requête :</h3> " . $conn->error;
                // Autre traitement de l'erreur si nécessaire
            } else {
                // Vérifier le type de requête
                if ($result instanceof mysqli_result) {
                    // Requête SELECT
                    if ($result->num_rows > 0) {
                        echo "<h3>Résultats :</h3>";
                        // Affichage des résultats
                        while ($row = $result->fetch_assoc()) {
                            // Faites quelque chose avec les résultats
                            print_r($row);
                        }
                    } else {
                        echo "<h3>La requête SELECT n'a renvoyé aucun résultat.</h3>";
                    }
                } else {
                    // Requête DELETE
                    if ($conn->affected_rows > 0) {
                        echo "<h3>La requête a été exécutée avec succès. Nombre de lignes affectées :</h3> " . $conn->affected_rows;
                    } else {
                        echo "<h3>La requête n'a touché aucune ligne.</h3>";
                    }
                }
            }

            // Fermeture de la connexion à la base de données
            $conn->close();
        } else {
            echo "<h3>Aucun mot n'a été saisi.</h3>";
        }
    }
    ?>

</body>

</html>

<?php
}else{
    echo "<h1>Not Found</h1><br>";
    echo "The requested URL was not found on this server.";

    ?>
    <title>404 Not Found</title>
    <?php

}

?>
