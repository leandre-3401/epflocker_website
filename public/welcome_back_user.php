<?php

if (!isset($_SESSION['last_display_time']) || (time() - $_SESSION['last_display_time']) > 60) {
    $_SESSION['last_display_time'] = time(); 
?>

<div class="alert alert-success font-weight-bold" role="alert">
    Bienvenue de retour! <?php echo $_SESSION['user_email']?>
</div>
<?php
}
?>