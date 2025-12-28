<?php session_start();?>

<?php
if(isset($_POST['save'])) {
    $produit_id = $_POST['produit']; 
    $quantite_entree = $_POST['quantite'];
    $code = $_POST['code'];
    $id_casier = 'A1';
    $serveur = "localhost";
    $username = "epflocker";
    $password = "3pfl0ck3r";
    $dsn = "mysql:host=localhost;port=3306;dbname=epflocker_db";

    try {
        $connexion = new PDO($dsn, $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete_quantite_existante = "SELECT quantite FROM produit WHERE id = ?";
        $statement = $connexion->prepare($requete_quantite_existante);
        $statement->execute([$produit_id]);
        $quantite_existante = $statement->fetchColumn();
        $email = $_SESSION['user_email'];

        $type="Emprunt";
        if ($quantite_entree <= $quantite_existante) {
            $nouvelle_quantite = $quantite_existante - $quantite_entree;
            $sql_update_produit = "UPDATE produit SET quantite = :nouvelle_quantite WHERE id = :produit_id";
            $statement_update_produit = $connexion->prepare($sql_update_produit);
            $statement_update_produit->bindParam(':nouvelle_quantite', $nouvelle_quantite);
            $statement_update_produit->bindParam(':produit_id', $produit_id);
            $statement_update_produit->execute();

            $sql_insert_emprunt = "INSERT INTO emprunt (id_produit, quantite, Date_emprunt, type, Code_acces, ID_Casier , Adresse_email) VALUES (:produit_id, :quantite,  NOW(), :type, :code, :id_casier, :email)";
            $statement_insert_emprunt = $connexion->prepare($sql_insert_emprunt);
            $statement_insert_emprunt->bindParam(':produit_id', $produit_id);
            $statement_insert_emprunt->bindParam(':quantite', $quantite_entree);
            $statement_insert_emprunt->bindParam(':type', $type);
            $statement_insert_emprunt->bindParam(':code', $code);
            $statement_insert_emprunt->bindParam(':id_casier', $id_casier);
            $statement_insert_emprunt->bindParam(':email', $email);


            $statement_insert_emprunt->execute();
            header("Location: list_casiers.php");
        } else {
            echo "Erreur : La quantité demandée est supérieure à la quantité disponible.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>