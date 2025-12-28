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

<body>
  <div class="hero_area">
    <!-- header section strats -->
    

    <?php
    $btn_retour = true;
    $navbar = "Explain.php";
    $lien_retour = "admin.php";
    include('Navbar.php');
    ?>

    <!-- service section -->
    <section class="service_section layout_padding">
      <div class="heading_container">
        <h2>
          Administrateur
        </h2>
        <p id="test" href="">
          Fonctionnalités administrateur
        </p>

      </div>

       
      <div class="service_container">
        
        <div class="box">
          <div class="img-box">
            <button id="btn1" class="service_container">
             <a href="mailto.php"> 
            <img id="test" src="images/mail_admin.png" alt="" style="width:150px;height:150px;">
             </a>
            </button>
          </div>
          
          <div class="detail-box">
            <h5>
              Rappel rendu avant 19h30
            </h5>

          </div>

        </div>
        <div class="box">
          <div class="img-box">
            <button id="btn1" class="service_container">
             <a href="mailto_24.php"> 
            <img id="test" src="images/24.png" alt="" style="width:150px;height:150px;">
             </a>
            </button>
          </div>
          
          <div class="detail-box">
            <h5>
              Rappel +24h
            </h5>
          </div>
        </div>
      </div>
      
      </div>
      <div class="btn-box">
        <a href="/?action=logout">
          Déconnexion 
        </a>
      </div>

     </section> 
  
</body>


<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script src = "script_popup.js"></script>
  <script src = "script_popupbddremplie.js"></script>



</html>

<?php
}else{
    echo "<h1>Not Found</h1><br>";
    echo "The requested URL was not found on this server.";

}

?>