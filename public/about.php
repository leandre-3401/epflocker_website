<!DOCTYPE html>
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

  <title>EPF Locker</title>
    <link rel="icon" href="images/logo1.png" type="image/png">
  
  <link rel="stylesheet" type="text/css" href="about.css">

  <!-- Custom styles for this template -->
  <link href="css/about.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  </head>
  <!-- onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;"-->
<body > 
  <div class="Completepage">

    <?php $navbar=basename($_SERVER["PHP_SELF"]);
  $lien_retour = "";
  $btn_retour = false;
  include('Navbar.php');?>        <!-- bar de Navigation fond transparent -->


  <div class="block1" id="block1">
 <img src="images/photo_groupe.png" alt="Image" class="imagegrp" data-image-width="1262" data-image-height="934">
    <div class="content">
    <div class="title-icon">
    <img src="images/Toge.png" alt="Icon" class="icon">
      <h1 class="title">La Team EPF Locker</h1>
      </div>
      <p class="text">C'est dans le cadre du module "Projet Challenge" que nous avons décidé de former cette équipe composée de 10 étudiants de 3ème année de la P2025. Le but était de réaliser le projet "EPF Locker" proposé par M. Amalric de Mauléon. Le projet a été lancé le 17 mars 2023 et s'est terminé le 22 juin 2023. Grâce à ce projet, nous avons acquis de nombreuses compétences ingénieurs mais ce fut également l'occasion de souder notre équipe. Ce projet fut pour nous une opportunité de vivre une réelle expérience avec l'aide des enseignants du campus de Montpellier et grâce au financement accordé par M. François Stephan.</p>
     <div class="button-container">
        <a href="about.php#block2 " class="button">View more</a>
      </div>
    </div>
  </div>

  <div class="block" id="block2">
  <div class="video-container">
      <video controls>
        <source src="images/epflocker.mp4" type="video/mp4">
        Votre navigateur ne prend pas en charge la lecture de vidéos HTML5.
      </video>
    <div class="button-container">
        <a href="about.php#block3" class="button">View more</a>
      </div>
    </div>
    
  </div>

  <div class="block3" id="block3">
  <div class="logo-container-row">
  <div class="logo-container1">
    <img src="images/pole_elec.png" alt="Image 1" class="imageblk3">
    <div class="text-container_prenom">
    <div class="text-frame_prenom" id="grp1">
      <div class="name">Axel FOURCADE</div>
      <div class="name">Marion KERVELLA</div>
      <div class="name">Scott FULLAGAR</div>
    </div>
    <div class="photo-container">
      <img src="images/grp_elec.jpg" alt="Photo" class="photo">
    </div>
  </div>
  
</div>

  <div class="logo-container2">
    <img src="images/pole_web.png" alt="Image 2" class="imageblk3" id="imgweb">
    <div class="text-container_prenom">
      <div class="photo-container">
      <img src="images/grp_web.jpg" alt="Photo" class="photo" id="web">
    </div>
    <div class="text-frame_prenom" id="grp2">
      <div class="name">Anthony NAVARRO</div>
      <div class="name">Hugo LACOMBE</div>
      <div class="name">Ilona BEMATOL</div>
      <div class="name">Baptiste BARBERAN</div>
    </div>
    
  </div>
  
    </div> 
    </div> 


    <div class="logo-container3">
    <img src="images/pole_montage.png" alt="Image 1" class="imageblk3" id="imgmont">
    <div class="text-container_prenom">
    <div class="text-frame_prenom" id="grp1">
      <div class="name">Noa LEGIER</div>
      <div class="name">Pierre TORDO</div>  
      <div class="name">Aurelier ZELJKO</div>

    </div>
    <div class="photo-container">
      <img src="images/grp_montage.jpg" alt="Photo" class="photo">
    </div>
    
  </div>
  
</div>
<div class="button-container" id="back">
        <a href="about.php#navbar " class="button">Back Top</a>
      </div>
</div>

</div>
</body>

</html>