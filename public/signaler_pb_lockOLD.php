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
  <meta name="viewport" content="width-device-width, initial-scale-1.0"/>

    <!-- popup -->
    <link rel="stylesheet" href="stylepopup.css">
    <link rel="stylesheet" href="stylepopupbddremplie.css">

  <title>EPF Locker</title>
  <link rel="website icon" type="png" href="images\logo1.png">




  
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

<body class="sub_page">

  <div class="hero_area">
    
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
                <button type="submit" name="submit" onclick="rediriger()">Envoyer</button>
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
  <script>
  function rediriger() {
    window.location.href = "https://epflocker.mde.epf.fr/service.php"; // Remplacez "https://www.example.com" par l'URL de la page vers laquelle vous souhaitez être redirigé.
  }
</script>
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
    //echo 'E-mail envoyé avec succès.';
  } catch (Exception $e) {
    echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
  }
}
