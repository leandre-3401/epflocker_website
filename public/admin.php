<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<html>
  
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <meta name="viewport" content="width-device-width, initial-scale-1.0"/>

    <!-- popup -->
    <link rel="stylesheet" href="stylepopup.css">
    <link rel="stylesheet" href="stylepopupbddremplie.css">

  <title>EPF Locker</title>
  <link rel="website icon" type="png" href="../images\logo1.png">

              
    
</head>
<body >
  <div class="hero_area">
  <?php $navbar=basename($_SERVER["PHP_SELF"]);
  $lien_retour = "index.php";
  $btn_retour = true;
  include('Navbar.php');?>    
  
  <!-- service section -->
  <section class="service_section layout_padding">
    <div class="container-fluid">
      <div class="heading_container">
        <h2>
          Administrateur
        </h2>
        <p id ="test" href="">
          Fonctionnalités administrateur
        </p>
       
      </div>
      <div class="service_container">
        <div class="box">
          <div class="img-box">
            <button id="btn1" class="service_container">
             <a href="historique.php"> 
            <img id="test" src="images/historique.png" alt="" style="width:150px;height:150px;">
             </a>
            </button>
          </div>
          
          <div class="detail-box">
            <h5>
              Voir l'historique des prêts
            </h5>

          </div>

        </div>

        <div class="box">

          <div class="img-box">
          <button class="service_container" >
            <a href="modiflocker_admin.php"> 
            <img src="images/modifcasier_image.png" alt="" style="width:175px;height:175px;" >
            </a>
            </button>
          </div>
          <div class="detail-box">
            <h5>
              Modifier l'EPF Locker
            </h5>
            
          </div>
          
        </div>
        <div class="box">
          <div class="img-box">
          <button class="service_container" >
          <a href="https://192.168.138.102:8080/powerAll.html"> 
            <img src="images/cle_dev.png" alt="" style="width:150px;height:150px;">
            </a>
            </button>
          </div>
          <div class="detail-box">
            <h5>
             Ouvrir l'EPF Locker
            </h5>
          
          </div>
          </div>
          <div class="box">
          <div class="img-box">
          <button class="service_container" >
          <a href="envoyer_mail.php"> 
            <img src="images/mail_admin.png" alt="" style="width:150px;height:150px;">
            </a>
            </button>
          </div>
          <div class="detail-box">
            <h5>
             Envoyer un mail
            </h5>
          
          </div>
        </div>

<div class="btn-box">
      <a id="boite" href = "https://epflocker.mde.epf.fr/boite_aux_l.php?Adresse_mail=<?php echo urlencode($Adresse_mail); ?>" style="position: absolute; bottom: 100px; right: 100px;">Boîte aux lettres</a>
    
  </div>

       
      </div>
    </div>
    <div class="btn-box">
        <a onclick="relancerNavigateur()">
          Déconnexion 
        </a>
    </div>
  </section>
  <!-- end service section -->
 
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script src = "script_popup.js"></script>
  <script src = "script_popupbddremplie.js"></script>


  <script>
function relancerNavigateur() {
  // Ouvrir la première URL dans un nouvel onglet
  //var nouvelleOnglet1 = window.open("https://epflocker.mde.epf.fr", "_blank");
  
  var nouvelleOnglet2 = window.open("https://epflocker.mde.epf.fr/service.php?action=logout", "_blank");

  // Temporisation de 4 secondes (4000 millisecondes) avant d'ouvrir la deuxième URL
  setTimeout(function() {
    // Ouvrir la deuxième URL dans un nouvel onglet

    // Redirection vers "https://192.168.138.102:8080/page_deco.html"
    window.location.href = "https://192.168.138.102:8080/page_deco.html";
  }, 3000);
}
</script>






</div>
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