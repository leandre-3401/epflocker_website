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

  <title>EPF Locker</title>
  <link rel="website icon" type="png" href="images/logo1.png">

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>
<body>

 
    <!-- end header section -->

    <div class="hero_area">
    <a class="navbar-brand" href="">
            
            <span>
              <img src="images/logo1.png" alt=""style="width:150px;height:90px;">
              </span>
            </a>
            
    <div class="container">
    <div class="text">L'EPFLocker s'ouvre...</div>
  </div>
    
  <div class="loading-container">
    <div class="loading-text">Loading...</div>
    <div class="progress-bar">
      <div class="progress-bar-fill"></div>
    
    </div>
</div>
  


  <script>
    // JavaScript pour masquer le contenu après un délai simulé
    window.addEventListener('load', function() {
      var loadingContainer = document.querySelector('.loading-container');
      var progressBar = document.querySelector('.progress-bar');

      // Simuler un délai de chargement de 2 secondes
      setTimeout(function() {
        loadingContainer.style.display = 'none'; // Masquer le conteneur de chargement
        progressBar.style.display = 'none'; // Masquer la barre de progression
        // Afficher le contenu principal ou effectuer d'autres actions
      }, 60000);
    });
  </script> 
  <script>
        
            setTimeout(function() {
                var boutons = document.querySelectorAll('.load_button');
                boutons.forEach(function(bouton){bouton.style.display="inline-block";
                });
            }, 60530);

    </script>


    
  <div class="btncontainer">
    <a  class="load_button" id="load1" href="admin.php">
        Opération réussie </a>
    <a  class="load_button" id="load2" href="">
        Signaler un problème </a>  
</div>
</div>


  </div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

</body>

<iframe id="import" src=<?php

echo("http://localhost:8080/powerAll.html");
?> width="0" height ="0" frameborder="1" style="visibility: hidden;">
</iframe>

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