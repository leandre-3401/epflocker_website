<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>



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
//disableScroll();
</script>

<html style="font-size: 16px;" lang="fr"><head>
    <title>EPF Locker</title>
    <link rel="icon" href="images/logo1.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="INTUITIVE">
    <meta name="description" content="">
    <title>Nos Services</title>
    <link rel="stylesheet" href="css/nicepage.css" media="screen">
    <link rel="stylesheet" href="css/Accueil.css" media="screen">
    <script class="u-script" type="text/javascript" src="js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.10.10, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
        
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": ""
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Accueil">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <!--onselectstart="return false"oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;"-->
  <body data-home-page="Accueil.html" data-home-page-title="Nos Services" class="u-body u-xl-mode" data-lang="fr"  >
    <section class="u-align-center u-clearfix u-image u-shading u-section-1" src="" data-image-width="1600" data-image-height="844" id="sec-de1a">
    <?php $navbar=basename($_SERVER["PHP_SELF"])?>
      <?php 
      $lien_retour = "";
      $btn_retour = false;
      include('Navbar.php')?>
    <div class="u-clearfix u-sheet u-sheet-1">
        <h1 class="u-custom-font u-font-montserrat u-text u-text-default u-title u-text-1"  style="position: relative; top: -100px; ">EPF Locker&nbsp; </h1>
        <p class="u-align-center u-custom-font u-font-montserrat u-large-text u-text u-text-default u-text-variant u-text-2" style="position: relative; top: -100px; ">Bienvenue sur le site de l'EPF Locker, le projet étudiant innovant qui va révolutionner la vie des étudiants ! Nous avons créé des casiers autonomes contenant du matériel que chaque élève peut emprunter librement en se connectant sur la borne. Grâce à nos casiers, vous pourrez charger votre ordinateur en toute sécurité et réserver un espace temporaire pour stocker vos affaires.&nbsp;</p>
        <div class="button_next">
        <a href="Explain.php#sec-72ea" class="u-btn u-btn-round u-button-style u-custom-color-1 u-hover-palette-5-base u-radius-25 u-btn-1"style="position: relative; top: -150px; ">Read More</a>
     </div>
     </div>
    </section>
    <section class="u-clearfix u-section-2" id="sec-72ea">
      <div class="u-clearfix u-sheet u-sheet-1">
        <img class="u-align-left u-image u-image-default u-image-1" data-image-width="6720" data-image-height="4480" src="images/giorgio-trovato-8krX0HkXw8c-unsplash.jpg">
        <div class="u-container-style u-custom-color-1 u-group u-radius-50 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1">
            <h2 class="u-custom-font u-font-montserrat u-text u-text-1">Emprunt d'ordinateur</h2>
            <p class="u-align-justify u-custom-font u-font-montserrat u-text u-text-2">Ton ordinateur a un problème ?<br>
              <br>L'EPF te prête un ordinateur pour la journée !&nbsp;<br>En te connectant sur l'EPF LOCKER tu peux accèder à ton ordinateur de prêt. Tu dois le ramener avant 19h30 en te connectant de nouveau tu pourras le deposer et le mettre a charger dans son casier en toute sécurité.&nbsp;
            </p>
          </div>
        </div>
        <a href="Explain.php#carousel_3489" class="u-btn u-btn-round u-button-style u-custom-color-1 u-hover-palette-5-base u-radius-25 u-btn-1"style="position: relative ; top: 50px; left: 50% ">Next</a>
      </div>
    </section>
    <section class="u-clearfix u-section-3" id="carousel_3489">
      <div class="u-clearfix u-sheet u-sheet-1">
        <img class="u-border-4 u-border-grey-75 u-image u-image-contain u-image-default u-preserve-proportions u-image-1" src="images/multiprise.jpg" alt="" data-image-width="1110" data-image-height="1110">
        <img class="u-border-4 u-border-grey-75 u-image u-image-contain u-image-default u-preserve-proportions u-image-2" src="images/hdmicable.jpg" alt="" data-image-width="345" data-image-height="345">
        <div class="u-container-style u-custom-color-2 u-group u-radius-50 u-shape-round u-group-1">
          <div class="u-container-layout u-container-layout-1">
            <h2 class="u-custom-font u-font-montserrat u-text u-text-1">Emprunt de matériel</h2>
            <p class="u-align-justify u-custom-font u-font-montserrat u-text u-text-2">La prise est trop loin ? Il n'y a pas assez de prise ?<br>
              <br>L'EPF te prête du des cables !&nbsp;<br>En te connectant sur l'EPF LOCKER tu peux emprunter du matériel. Une fois connecté tu peux prendre ce dont tu as besoin et notifier la quantité que tu as pris. En te connectant de nouveau tu pourras déposer ce que tu as emprunter.&nbsp;&nbsp;
            </p>
          </div>
        </div>
        <a href="Explain.php#carousel_a938" class="u-btn u-btn-round u-button-style u-custom-color-1 u-hover-palette-5-base u-radius-25 u-btn-1"style="position: relative ; top: 50px; left: 50% ">Next</a>
      </div>
    </section>
    <section class="u-clearfix u-section-4" id="carousel_a938">
      <div class="u-clearfix u-sheet u-sheet-1">
        <img class="u-align-left u-image u-image-default u-image-1" data-image-width="550" data-image-height="366" src="images/550x366.jpg">
        <div class="u-container-style u-custom-color-3 u-group u-radius-50 u-shape-round u-group-1">
          <div class="u-container-layout u-valign-top-lg u-valign-top-md u-valign-top-sm u-valign-top-xs u-container-layout-1">
            <h2 class="u-custom-font u-font-montserrat u-text u-text-1">Recharge &amp; depôt de materiel&nbsp;&nbsp;</h2>
            <p class="u-align-justify u-custom-font u-font-montserrat u-text u-text-2">Tu veux stocker et charger ton ordinateur?<br>&nbsp;<br>En te connectant sur l'EPF LOCKER tu peux réserver un casier afin de charger ton ordinateur et déposer un sac en sécurité.&nbsp; Tu as juste besoin de te reconnecter pour récupérer tes affaires. Attention tu dois venir chercher tes affaires avant la fin de la journée.
            </p>
          </div>
        </div>
        <a href="Explain.php#sec-de1a" class="u-btn u-btn-round u-button-style u-custom-color-1 u-hover-palette-5-base u-radius-25 u-btn-1"style="position: relative ; top: 50px; left: 50%; right: 50% ">Haut de page</a>
      </div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-0041"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-custom-font u-font-montserrat u-small-text u-text u-text-variant u-text-1">@EPFLOCKER&nbsp; &nbsp; 2023</p>
      </div></footer>
    
  
</body></html>

<?php
}else{
    echo "<h1>Cette page est accessible uniquement sur l'EPF locker</h1><br>";

    ?>
    <title>:(----:)</title>
    <?php

}

?>