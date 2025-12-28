
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

<body >

  <div class="heroservice_area" id="navbar">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href=<?php echo ($lien_retour)?>>
          <span>
          <?php

          if ($btn_retour==true)  { ?>
          <img src="images/btn_retour.png" alt=""style="width:10vh;height:10,5vh;">
          <?php }?>
          </span></a>

          <a class="navbar-brand" href="">
          <span>
            <img src="images/logo1.png" alt=""style="width:150px;height:90px;">
            
            </span>
          </a>
          

          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="s-1"> </span>
            <span class="s-2"> </span>
            <span class="s-3"> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  "> 
              <?php if ( ($navbar == "index.php")) { ?>
                <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil</a>
                </li>
              <?php } else { ?>
                <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
             <?php } ?>
                 
             <?php if ($navbar=="Explain.php"){?>
                <li class="nav-item active">
                <a class="nav-link" href="Explain.php">Nos Services </a>
                </li>  
              <?php } else { ?> 
                  <li class="nav-item "> 
                  <a class="nav-link" href="Explain.php">Nos Services <span class="sr-only">(current)</span></a>
                </li>
                <?php } ?>
                
              <?php if ($navbar=="about.php"){?>
                <html> <li class="nav-item active">
                  <a class="nav-link" href="about.php">A propos de nous </a>
                </li>  
              <?php } else { ?> 
                   <li class="nav-item "> 
                    <a class="nav-link" href="about.php">A propos de nous <span class="sr-only">(current)</span></a>
                   </li>
                  <?php } ?>

              <?php if ($navbar=="signaler_pb.php"){?>
                   <li class="nav-item active">
                   <a class="nav-link" href="signaler_pb.php">Nous contacter  </a>
                   </li> 
                <?php } else { ?> 
                <li class="nav-item "> 
                <a class="nav-link" href="signaler_pb.php">Nous contacter  <span class="sr-only">(current)</span></a>
                 </li>
                 <?php } ?> 
              </ul>
            </div>
           
            <a class="navbar-brand" href="">
            <span class ="profil" face="arial">
              <u>
            <?php 
                echo   $Adresse_mail ;
		//echo $Auth->displayName;
                  ?>
                  </u>
                
            </span>
          </a>

          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  

  <!-- service section -->
  
    
</div>
</body>

</html>
