<?php
// Connexion à la base de données
$user = 'epflocker';
$pass = '3pfl0ck3r';
$db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $db->query('SELECT * FROM casiers_emprunt WHERE Adresse_mail IS NULL' );
$resultats = $stmt->fetchAll();
$nombre_lignes = $stmt->rowCount();
?>


<html>
<head>
    <style>
      h3 {
        color: white;
      }
      .dispo{
  font-family: Montserrat, sans-serif;
  text-shadow: 2px 2px 4px rgba(10, 10, 10, 0.507);

  margin-left: 10%;
 margin-top:5%;
}
    </style>
  </head>
  <body>
    <div class="hero_area">
      <!-- header section starts -->
      <?php
      $btn_retour = true;
      $navbar = "";
      $lien_retour = "index.php";
      include('Navbar.php');
      ?>   

      <!-- service section -->
      <section class="service_section layout_padding">
        <div class="heading_container">
          <h2>
            Disponibilités
          </h2>
          
        </div> 
    
        <div class="service_container">
          <div style="float: left; margin-right: 20px;">
            <a href=""> 
              <img src="images/casier_image.png" usemap="#Casier_map" alt="" width="400">
            </a>
          </div>
    
          <div class= "dispo">
            <h3><strong>Disponibilité ordinateur : <?php echo($nombre_lignes)?></strong></h3>
            <!-- Votre code pour afficher les informations sur la disponibilité des ordinateurs ici -->
            <?php
            $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt1 = $db->query('SELECT * FROM casiers_libre_service WHERE Adresse_mail IS NULL' );
            $resultats = $stmt1->fetchAll();
            $nombre_lignes1 = $stmt1->rowCount();
            ?>
            <h3><strong>Disponibilité casier libre service :<?php echo($nombre_lignes1)?></strong></h3>
           
            <!-- Votre code pour afficher les informations sur la disponibilité des casiers ici -->
          </div>
        </div>
    
        <map name="Casier_map">
          <!-- Vos coordonnées pour les zones de l'image avec les liens vers les pages Casierbdd_admin.php ici -->
        </map>
      </section>
      <!-- end service section -->
 
      <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript" src="js/custom.js"></script>
      <script src="script_popup.js"></script>
      <script src="script_popupbddremplie.js"></script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
  </body>
</html>
