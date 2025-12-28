<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<html>
<?php
        $navbar = "Explain.php";
        $btn_retour = true;
        $lien_retour = "admin.php";
        include('Navbar.php');
        ?>   
<head>

<link rel="stylesheet" href="historique.css">
    <style>
        table {
            color: white; /* Couleur du texte */
            border-collapse: collapse; /* Fusionner les bordures */
            background-color: grey;
        
        }

        .container2 {
            margin-left: 0; /* Réinitialiser la marge à gauche */
            margin-right: auto; /* Centrer horizontalement */
            text-align: left; /* Alignement du texte à gauche */
            /*max-height: 200px;*/ /* Ajustez la hauteur maximale selon vos besoins */
            align-items: center;
            overflow: auto;
        }

        th, td {
            padding: 10px;
            border: 1px solid black; /* Bordures des cellules */

        }

        th {
            background-color: rgb(60,3,153); /* Fond noir pour les en-têtes */
        }

        h1 {
            color: white; /* Couleur du texte */
            text-decoration: underline; /* Soulignement du texte */
            margin-left: 20px; /* Décalage à droite */
            font-size: 15px; /* Taille de la police */
            margin-bottom: 20px; /* Espace en bas du titre */
            text-align: center;
        }

        body {
    background-color: rgb(230, 3, 3) ; /* Chemin vers votre image de fond */
    background-repeat: repeat; /* Répétition de l'image de fond */
    background-size: 150%; /* Ajustement de la taille de l'image de fond (50% de la taille d'origine) */
    background-position: center; /* Centrer l'image de fond horizontalement et verticalement */


        }
        
        .section {
            margin-top: 75px;
            margin-bottom: 50px; /* Espace en bas de chaque section */
        }

    .table-scroll {
        max-height: 500px; /* Ajustez la hauteur maximale selon vos besoins */
        overflow: auto;
       align-items: center;
        margin: 0 auto;
    }

    .table-scroll thead th {
        position: sticky;
        top: 0;
        background-color: rgb(60,3,153); /* Couleur de fond pour les en-têtes */
        color: white; /* Couleur du texte pour les en-têtes */
        text-align: center;
    }


    </style>
</head>



<body>
    



<h1>Historique complet</h1>
<div class="section table-scroll">
           
        <div class="container2">
    <table class="table-style">
        <thead>
            <tr>
                <th>Casier</th>
                <th>Mail</th>
                <th>Date de début du prêt</th>
                <th>Date de retour du prêt</th>
            </tr>
        </thead>
        

        <tbody>
           <?php  
             $user = 'epflocker';
             $pass = '3pfl0ck3r';
             $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
             $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stmt = $db->query('SELECT * FROM toutes_locs');
             
               //echo "Table emprunt ordinateurs : <br>";
           
               $resultats = $stmt->fetchAll();
           
           
           foreach($resultats as $row) { ?>
            <tr>
                <td><?php echo($row['Id_Casiers']);?></td>
                <td><?php echo($row['Adresse_mail']); ?></td>
                <td><?php echo($row['Date_debut_lock']); ?></td>
                <td><?php echo($row['Date_fin_lock']); ?></td>
          
            </tr>
      
           <?php }; ?>
        </tbody>

    </table>
           </div>
           </div>


           <?php

  $user = 'epflocker';
  $pass = '3pfl0ck3r';
  $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $db->query('SELECT * FROM casiers_emprunt');
  
    //echo "Table emprunt ordinateurs : <br>";

    $resultats = $stmt->fetchAll();
  
    
?>


        <h1>Emprunt des ordinateurs</h1>
        <div class="section">

            <div class="container2">
                <table class="table-style table-scroll">
                    <thead>
                        <tr>
                            <th>Casier</th>
                            <th>Mail</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultats as $row) { ?>
                        <tr>
                            <td><?php echo($row['Id_Casiers']);?></td>
                            <td><?php echo($row['Adresse_mail']); ?></td>
                            <td><?php echo($row['Date_debut_lock']); ?></td>
                        </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Répétez les sections suivantes pour les autres tables -->
        <h1>Emprunt des câbles HDMI</h1>
        <div class="section">
            
            <div class="container2">
                <table class="table-style table-scroll">
                    <thead>
                        <tr>
                            <th>Casier</th>
                            <th>Mail</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user = 'epflocker';
                        $pass = '3pfl0ck3r';
                        $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $db->query('SELECT * FROM cables');
                        $resultats = $stmt->fetchAll();
                        foreach($resultats as $row) { ?>
                        <tr>
                            <td><?php echo($row['Id_Casiers']);?></td>
                            <td><?php echo($row['Adresse_mail']); ?></td>
                            <td><?php echo($row['Date_debut_lock']); ?></td>
                        </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <h1>Emprunt des casiers en libre-service</h1>
        <h1> </h1>
        <div class="section">
            
            <div class="container2">
                <table class="table-style table-scroll">
                    <thead>
                        <tr>
                            <th>Casier</th>
                            <th>Mail</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user = 'epflocker';
                        $pass = '3pfl0ck3r';
                        $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $db->query('SELECT * FROM casiers_libre_service');
                        $resultats = $stmt->fetchAll();
                        foreach($resultats as $row) { ?>
                        <tr>
                            <td><?php echo($row['Id_Casiers']);?></td>
                            <td><?php echo($row['Adresse_mail']); ?></td>
                            <td><?php echo($row['Date_debut_lock']); ?></td>
                        </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section">
            <h1>Emprunt des rallonges</h1>
             <div class="container2">
                 <table class="table-style table-scroll">
                   <thead>
                       <tr>
                        <th>Casier</th>
                        <th>Mail</th>
                        <th>Date</th>
                      </tr>
                 </thead>
        <tbody>
           <?php  
             $user = 'epflocker';
             $pass = '3pfl0ck3r';
             $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
             $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stmt = $db->query('SELECT * FROM rallonge');
             
               //echo "Table emprunt ordinateurs : <br>";
           
               $resultats = $stmt->fetchAll();
           foreach($resultats as $row) { ?>
            <tr>
                <td><?php echo($row['Id_Casiers']);?></td>
                <td><?php echo($row['Adresse_mail']); ?></td>
                <td><?php echo($row['Date_debut_lock']); ?></td>
          
            </tr>
      
           <?php }; ?>
        </tbody>

            </table>
           </div>
           </div>
        <div class="section"> 
           <h1>Emprunt des souris</h1>
        <div class="container2">
        
    <table class="table-style table-scroll">

        <thead>
            <tr>
                <th>Casier</th>
                
                <th>Mail</th>
                <th>Date</th>
            </tr>
        </thead>
        

        <tbody>
           <?php  
             $user = 'epflocker';
             $pass = '3pfl0ck3r';
             $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
             $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stmt = $db->query('SELECT * FROM souris');
             
               //echo "Table emprunt ordinateurs : <br>";
           
               $resultats = $stmt->fetchAll();
           
           
           foreach($resultats as $row) { ?>
            <tr>
                <td><?php echo($row['Id_Casiers']);?></td>
                <td><?php echo($row['Adresse_mail']); ?></td>
                <td><?php echo($row['Date_debut_lock']); ?></td>
          
            </tr>
      
           <?php }; ?>
        </tbody>

    </table>
           </div>
           </div>



           <div class="section"> 
           <h1>Boîte aux lettres</h1>
        <div class="container2">
        
    <table class="table-style table-scroll">

        <thead>
            <tr>
                <th>Mail</th>
                
                <th>Date d'ouverture</th>
            </tr>
        </thead>
        

        <tbody>
           <?php  
             $user = 'epflocker';
             $pass = '3pfl0ck3r';
             $db = new PDO('mysql:host=localhost;dbname=epflocker_db',$user,$pass);
             $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $stmt = $db->query('SELECT * FROM boite_aux_lettres');
             
               //echo "Table emprunt ordinateurs : <br>";
           
               $resultats = $stmt->fetchAll();
           
           
           foreach($resultats as $row) { ?>
            <tr>
                <td><?php echo($row['Adresse_mail']);?></td>
                <td><?php echo($row['Date_ouverture']); ?></td>
          
            </tr>
      
           <?php }; ?>
        </tbody>

    </table>
           </div>
           </div>

           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>


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