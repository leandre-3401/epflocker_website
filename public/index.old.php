<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

setcookie("PHPSESSID", "", time() - 3600);
?>

  <?php
//Suppresion des cookies pour le badge Id_Rfid
//setcookie("Id_Rfid", '', time()-3600,'/');



// Suppression des cookies-------------------------------------------------------------------------------
$cookies = $_COOKIE;

if (is_array($cookies)) {
    // Parcourt chaque cookie et le supprime
    foreach ($cookies as $cookie_name => $cookie_value) {
        setcookie($cookie_name, '', time() - 3600, '/');
        // Définit la date d'expiration du cookie à une heure dans le passé
        // et le chemin '/' pour s'assurer qu'il est valide pour tout le site
    }
}

// Pas besoin de rafraîchir la page ici

//exit();

// ------------------------------------------------------------------------------------------------------



// Connexion à la base de données
$user = 'epflocker';// epflocker
$pass = '3pfl0ck3r'; // A mettre après user dans $db
$db = new PDO('mysql:host=localhost;port=3307;dbname=epflocker_db',$user,$pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $db->query('SELECT * FROM casiers_emprunt WHERE Adresse_mail IS NULL' );
$resultats = $stmt->fetchAll();
$nombre_lignes = $stmt->rowCount();
$db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt1 = $db->query('SELECT * FROM casiers_libre_service WHERE Adresse_mail IS NULL' );
$resultats = $stmt1->fetchAll();
$nombre_lignes1 = $stmt1->rowCount();
//Nettoie la table badge
$db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt14 = $db->query('DELETE FROM RFID WHERE Adresse_mail="None"');
$nombre_lignes_supprimees = $stmt14->rowCount();


// Suppression de toutes les lignes (éviter les qu'il y ait plusieurs lignes => beug) et ajout de la ligne avec None None dans la table_courante --

include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  try {
    $db = new PDO('mysql:host=localhost;port=3307;dbname=epflocker_db', $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Supprimer toutes les lignes de la table
    $db->exec('DELETE FROM table_courante');

    $stmt = $db->prepare('INSERT INTO table_courante (Adresse_mail, Id_Badge) VALUES (:adresse_mail, :id_badge)');
    $stmt->bindValue(':adresse_mail', 'None');
    $stmt->bindValue(':id_badge', 'None');
    $stmt->execute();

  } catch (PDOException $e) {
    print "Erreur :" . $e->getMessage() . "<br/>";
    die; // Arrête tout le programme
  }
}
//-------------------------------------------------------------------------------------------------------------------------------------------------


if(getIP()=='192.168.138.102'){
  $variableip = 0;
}else{
  $variableip = 1;
}
  ?>



<html>
  <script>
    
  
function disableScroll() {
  // Stocke la position actuelle de défilement
  var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

  // Désactive le défilement
  window.onscroll = function() {
    window.scrollTo(scrollLeft, scrollTop);
  };
}
disableScroll();
</script>
<head>
  <title>EPF Locker</title>
  <link rel="icon" href="images/logo1.png" type="image/png">
</head>
<body onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;" >

 
    <!-- end header section -->
    <div class="hero_area">

  <?php $navbar=basename($_SERVER["PHP_SELF"]);
  $lien_retour = "";
  $btn_retour = false;
  include('Navbar.php');?>        <!-- bar de Navigation fond transparent -->
  
    <!-- slider section -->
    <section class=" slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="detail_box">
                    <h1>
                      Emprunte un ordinateur !
                    </h1>
                    <p>
                      Emprunt d'un ordinateur pour 24h c'est possible !
                    </p>
                    <div class="btn-box">
                      <a href="https://epflocker.mde.epf.fr/nettoie_table.php" class="btn-1" value= "Connexion">
                        Connexion
                      </a>
                     
                   
                    
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/laptop_image.png" alt="" style="width:350px;height:350px;">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="detail_box">
                    <h1>
                      Disponibilités
                    </h1>
                    <p>
                      Actuellement dans l'EPFLocker il y a <?php echo($nombre_lignes) ?> ordinateurs disponibles  </p>
                      <p> et <?php echo($nombre_lignes1) ?> casiers libres disponibles 
                    </p>
                    <div class="btn-box">
                    <a href="https://epflocker.mde.epf.fr/nettoie_table.php" class="btn-1">
                      Connexion
                      </a>
                      
                   
                    
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/avaibility.png" alt="" >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="detail_box">
                    <h1>
                      Réserve un casier !
                    </h1>
                    <p>
                      Connecte-toi pour réserver un casier dans lequel tu peux recharger ton ordinateur !
                    </p>
                    <div class="btn-box">
                    <a href="https://epflocker.mde.epf.fr/nettoie_table.php" class="btn-1">
                      Connexion
                      </a>

                   
                    
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/casier_unique.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="detail_box">
                    <h1>
                      Emprunte un cable HDMI
                    </h1>
                    <p>
                      Connecte toi pour emprunter un cable HDMI!
                    </p>
                    <div class="btn-box">
                    <a href="https://epflocker.mde.epf.fr/nettoie_table.php" class="btn-1">
                      Connexion
                      </a>

                   
                    
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/hdmi.png" alt="" style="width:50% ;height: auto;">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="detail_box">
                    <h1>
                    Emprunte une rallonge
                    </h1>
                    <p>
                    Connecte toi pour emprunter une rallonge!
                    </p>
                    <div class="btn-box">
                    <a href="https://epflocker.mde.epf.fr/nettoie_table.php" class="btn-1">
                      Connexion
                      </a>

                    
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/rallonge_.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-container">
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="sr-only">Next</span>
        </div>  
        </div>
 
    </section>
    
    
        
    <!-- end slider section -->
  </div>
  </div>

 
<!-- MAINTENANCE RFID -->
  <div class="box">

<!--
<?php
if ($variableip == 0){
?>
  //<button id="btn_nfc" class="nfc">
  //<a class="btn_nfc" href="https://192.168.138.102:8080/lecture_rfid.html" style="position: absolute; bottom: 100px; right: 100px;">
  //Badge ta carte étudiante !
  //</a>
  //</button>

  <?php
}else{

}
?>

</div>

-->

 


  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>

