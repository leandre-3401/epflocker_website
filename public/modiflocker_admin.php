<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<html>

<head>
<link rel="stylesheet" href="stylepopupadmin.css">
<script src = "js/popup_admin.js"></script>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    

    <?php
    $variable_js = '';

    $btn_retour = true;
    $navbar = "Explain.php";
    $lien_retour = "admin.php";
    include('Navbar.php');
    ?>

<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (isset($_POST['variable_js'])) {
            $variable_js = $_POST['variable_js'];
            // Faites ce que vous souhaitez avec la valeur de $variable_js

            // Assigner la valeur à la variable PHP
            
          }
        }
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
        <img src="images/casier_image.png" usemap="#Casier_map" alt="">
        
      </div>

      <map name="Casier_map">
        <area onclick = "envoyerVariable()"  id="A1" target="" alt="Casier A1" title="Casier A1" coords="41,35,142,126" shape="rect" />
        <area onclick = "envoyerVariable1()" id="B1" target="" alt="Casier B1" title="Casier B1" coords="154,36,252,128" shape="rect" />
        <area onclick = "envoyerVariable2()" id="C1" target="" alt="Casier C1" title="Casier C1" coords="276,35,373,126" shape="rect" />
        <area onclick = "envoyerVariable3()" id="D1" target="" alt="Casier D1" title="Casier D1" coords="386,37,483,125" shape="rect" />
        <area onclick = "envoyerVariable4()" id="A2" target="" alt="Casier A2" title="Casier A2" coords="43,138,140,231" shape="rect" />
        <area onclick = "envoyerVariable5()" id="C2" target="" alt="Casier C2" title="Casier C2" coords="276,139,373,231" shape="rect" />
        <area onclick = "envoyerVariable6()" id="D2" target="" alt="Casier D2" title="Casier D2" coords="387,138,483,231" shape="rect" />
        <area onclick = "envoyerVariable7()" id="A3" target="" alt="Casier A3" title="Casier A3" coords="42,251,141,343" shape="rect" />
        <area onclick = "envoyerVariable8()" id="B3" target="" alt="Casier B3" title="Casier B3" coords="154,252,252,345" shape="rect" />
        <area onclick = "envoyerVariable9()" id="C3" target="" alt="Casier C3" title="Casier C3" coords="276,252,373,343" shape="rect" />
        <area onclick = "envoyerVariable10()" id="D3" target="" alt="Casier D3" title="Casier D3" coords="386,251,484,343" shape="rect" />
        <area onclick = "envoyerVariable11()" id="A4" target="" alt="Casier A4" title="Casier A4" coords="44,358,142,449" shape="rect" />
        <area onclick = "envoyerVariable12()" id="B4" target="" alt="Casier B4" title="Casier B4" coords="154,356,250,447" shape="rect" />
        <area onclick = "envoyerVariable13()" id="C4" target="" alt="Casier C4" title="Casier C4" coords="276,356,372,449" shape="rect" />
        <area onclick = "envoyerVariable14()" id="D4" target="" alt="Casier D4" title="Casier D4" coords="384,356,483,449" shape="rect" />
      
        <style>
          .custom-btn {
            color: #fff;
            background-color: #3c0399;
            border-color: #3c0399;
          }

          .custom-btn:hover {
            background-color: #2e076e;
            border-color: #2e076e;
          }
        </style>




        

      </map>



      



      <div class="d-flex justify-content-center">
        <div class="box">
          <button id="btnreset" class="btn btn-outline-primary custom-btn mr-1">RESET</button>
          <div id="overlayreset" class = "overlayreset">
            <div id = "popupreset" class = "popupreset">
            
              <h2>M.De Mauléon, <br> Etes-vous sur de vouloir reset le casier <?php echo $variable_js; ?> ?
                        </h2>

                        <p>Vous pouvez retourner en arrière, sans conséquences.
                        </p>

                        <h2>
                        </h2>

                        <span id = "btnretourreset" class = "btnretourreset">
                                Retour
                        </span>

                        <a id="btnsuivantreset" class="btnsuivantreset" href="Reset_Casier_Admin.php?Casier=<?php echo urlencode($variable_js); ?>">
                          Suivant
                        </a>

            </div>

          </div>
          
        </div>  

          


          <div class="box">
          <button id="btnblock" class="btn btn-outline-primary custom-btn mr-1">BLOCK</button>
          <div id="overlayblock" class = "overlayblock">
            
            <div id = "popupblock" class = "popupblock">
          
          <?php
            

            $db = new PDO('mysql:host=localhost;dbname=epflocker_db', 'epflocker', '3pfl0ck3r');
            $tables = array("cables", "casiers_emprunt", "casiers_libre_service", "rallonge", "souris");
            
            foreach ($tables as $table) {
              // Requête SQL pour vérifier si la valeur existe dans la table
              $checkQuery = $db->prepare("SELECT COUNT(*) FROM " . $table . " WHERE Id_Casiers = :idCasier");
              $checkQuery->bindParam(':idCasier', $variable_js);
              $checkQuery->execute();
            
              $rowCount = $checkQuery->fetchColumn();
            
              if ($rowCount > 0) {
                $tabletest = $table;
                $_SESSION['tabletest'] = $tabletest;
                break;
              }
            }
            
            if ($tabletest == 'cables' || $tabletest == 'rallonge' || $tabletest == 'souris') {

          

          ?>
              <h2>M.De Mauléon, <br> Vous ne pouvez pas blocker ce casier <?php echo $variable_js; ?> .
                        </h2>

                        <h2>
                        </h2>

                        <span id = "btnretourblock" class = "btnretourblock">
                                Retour
                        </span>

                   
                <?php
                 }else{
                ?>        

                  <h2>M.De Mauléon, <br> Etes-vous sur de vouloir bloquer le casier <?php echo $variable_js; ?> ?
                        </h2>

                        <p>Vous pouvez retourner en arrière, sans conséquences.
                        </p>

                        <h2>
                        </h2>

                        <span id = "btnretourblock" class = "btnretourblock">
                                Retour
                        </span>

                        <a id="btnsuivantblock" class="btnsuivantblock" href="Block_Casier_Admin.php?Casier=<?php echo urlencode($variable_js); ?>">
                          Suivant
                        </a>




                <?php
                 }
                ?>


            </div>

          
        </div>
        
          
        </div>
        


        
        <div class="box">
          <button id="btnechanger" class="btn btn-outline-primary custom-btn">ECHANGER 2 CASIERS</button>
          <div id="overlayechanger" class = "overlayechanger">
            <div id = "popupechanger" class = "popupechanger">
            
              <h2>M.De Mauléon, <br> Etes-vous sur de vouloir déplacer le casier <?php echo $variable_js; ?> ?
                        </h2>

                        <p>Vous pouvez retourner en arrière, sans conséquences.
                        </p>

                        <h2>
                        </h2>

                        <span id = "btnretourechanger" class = "btnretourechanger">
                                Retour
                        </span>

                        <a id="btnsuivantechanger" class="btnsuivantechanger" href="Changer_Casier_Admin.php?Casier=<?php echo urlencode($variable_js); ?>">
                          Suivant
                        </a>

            </div>
          </div>
          
        </div>
        
        </div>










        <div class="d-flex justify-content-center">
        <div class="box">
          <button id="btnchanger" class="btn btn-outline-primary custom-btn mt-1">CHANGER LE CONTENU D'UN CASIER</button>
          <div id="overlaychanger" class = "overlaychanger">
            <div id = "popupchanger" class = "popupchanger">
            
              <h2>M.De Mauléon, <br> Etes-vous sur de vouloir changer le contenu du casier <?php echo $variable_js; ?> ?
                        </h2>

                        <p>Vous pouvez retourner en arrière, sans conséquences.
                        </p>

                        <h2>
                        </h2>

                        <span id = "btnretourchanger" class = "btnretourchanger">
                                Retour
                        </span>

                        <a id="btnsuivantchanger" class="btnsuivantchanger" href="Changer_contenu_admin.php?Casier=<?php echo urlencode($variable_js); ?>">
                          Suivant
                        </a>

            </div>

          </div>
          
        </div>
        </div>
        




        

        <div class="text-right">
          <a class="btn btn-outline-primary custom-btn mr-4" href="Requetesql_admin.php">REQUETE SQL</a>
        </div>




        

    </section>

    


    <!-- end service section -->

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>

    
    
    


    




</div>
  
    

  
</body>




<script>
function nouveauInput() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'A1';
}
function nouveauInput1() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'B1';
}
function nouveauInput2() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'C1';
}
function nouveauInput3() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'D1';
}function nouveauInput4() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'A2';
}
function nouveauInput5() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'C2';
}
function nouveauInput6() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'D2';
}
function nouveauInput7() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'A3';
}
function nouveauInput8() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'B3';
}
function nouveauInput9() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'C3';
}
function nouveauInput10() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'D3';
}
function nouveauInput11() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'A4';
}function nouveauInput12() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'B4';
}
function nouveauInput13() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'C4';
}
function nouveauInput14() {
  // Modifier la valeur de variable_js avant d'envoyer le formulaire
  document.getElementById("variable_js").value = 'D4';
}






function envoyerVariable() {
  nouveauInput(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable1() {
  nouveauInput1(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable2() {
  nouveauInput2(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable3() {
  nouveauInput3(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable4() {
  nouveauInput4(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable5() {
  nouveauInput5(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable6() {
  nouveauInput6(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable7() {
  nouveauInput7(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable8() {
  nouveauInput8(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable9() {
  nouveauInput9(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable10() {
  nouveauInput10(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable11() {
  nouveauInput11(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable12() {
  nouveauInput12(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable13() {
  nouveauInput13(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}
function envoyerVariable14() {
  nouveauInput14(); // Appeler la fonction nouveauInput pour mettre à jour variable_js
  document.getElementById("myForm").submit();
}

</script>




<form id="myForm" action="modiflocker_admin.php" method="post">
  <input type="hidden" name="variable_js" id="variable_js" value="">
</form>








<link rel="stylesheet" href="stylepopupadmin.css">
<script src = "js/popup_admin.js"></script>



</html>

<?php
}else{
    echo "<h1>Not Found</h1><br>";
    echo "The requested URL was not found on this server.";

}

?>