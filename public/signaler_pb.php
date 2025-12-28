<!DOCTYPE html>
<html>

<head>

</head>

<body class="sub_page">

  <div class="hero_area">
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
    <section class="contact_section layout_padding" id="contactLink" style="padding-top: 0;">
      <div class="container" style="margin-top: -20px;">
        <div class="heading_container" style="margin-bottom: 0;">
          <h2 style="margin-bottom: 0;">
            Contacte le support du campus
          </h2>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-8 mx-auto">
            <form style="margin-top: -20px;" method="post">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control form-control-lg" id="inputName4" name="inputName4" placeholder="Nom">
                </div>
                <div class="form-group col-md-6">
                  <input type="email" class="form-control form-control-lg" id="inputEmail4" name="inputEmail4" placeholder="Email">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <input type="text" class="form-control form-control-lg" id="inputSubject4" name="inputSubject4" placeholder="Sujet">
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control form-control-lg" id="inputMessage" name="inputMessage" placeholder="Message" rows="5"></textarea>
              </div>
              <div class="d-flex justify-content-center">
                <button type="submit" name="submit">Envoyer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>

<?php

require '../inc/bdd.php';
require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/PHPMailer.php';
require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/SMTP.php';
require '/var/www/html/EPF_Locker2/public/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire
  $name = $_POST['inputName4'];
  $email = $_POST['inputEmail4'];
  $subject = $_POST['inputSubject4'];
  $message = $_POST['inputMessage'];

  // Créer une instance de PHPMailer
  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = 'saveur.o2switch.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'locker@epf-mtp.fr';
    $mail->Password = 'JeGnYfrfNPTS';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465; //587 // 465
    // Configurer les informations de l'expéditeur et du destinataire
    
    $mail->setFrom('locker@epf-mtp.fr', $email);

    // Configurer les informations de l'expéditeur

    $mail->addAddress('support.montpellier@epf.fr'); // Remplacez par l'adresse e-mail du destinataire

    $mail->Subject = $subject;
    $mail->Body = $message;
    // Envoyer l'e-mail
    $mail->send();
    echo 'E-mail envoyé avec succès.';
  } catch (Exception $e) {
    echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
  }
}
