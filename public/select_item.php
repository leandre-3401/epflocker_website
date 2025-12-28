<!DOCTYPE html>
<html>

<head>
    <title>Formulaire de produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .card {
        width: 50%;
        margin: auto;
        margin-top: 50px;
    }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center">Faites votre choix</h2>
            <form method="post" action="traitement.php">
                <div class="form-group">
                    <label for="produit">Produit:</label>
                    <select class="form-control" id="produit" name="produit">
                        <?php
                        try {
                            $serveur = "localhost";
                            $username = "epflocker";
                            $password = "3pfl0ck3r";
                            $dsn = "mysql:host=localhost;port=3306;dbname=epflocker_db";
                            $connexion = new PDO($dsn, $username, $password);
                            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $requete = "SELECT id, nom, quantite FROM produit";
                            $resultat = $connexion->query($requete);
                            while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
                            }
                        } catch (PDOException $e) {
                            echo "Erreur de connexion à la base de données : " . $e->getMessage();
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantite">Quantité:</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" min="1" max="1">
                </div>
                <button type="button" class="btn btn-success mt-2" id="getCodeBtn">Get Code</button>

                <span id="alertContainer"></span>
                <input type="hidden" id="code" name="code">


                <button type="submit" class="btn btn-primary btn-block" name="save" id="saveBtn" disabled>Save Code</button>
            </form>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.getElementById("getCodeBtn").addEventListener("click", function() {
        var code = generateRandomPassword(20);
        var alertMessage = "Le code est : " + code;
        var alertContent = '<div class="alert alert-success" role="alert">' + alertMessage + '</div>';
        document.getElementById("alertContainer").innerHTML = alertContent;
        document.getElementById("code").value = code;

        document.getElementById("saveBtn").removeAttribute("disabled");
    });

    function generateRandomPassword(length = 10) {
        var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var randomString = '';
        for (var i = 0; i < length; i++) {
            randomString += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return randomString;
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>