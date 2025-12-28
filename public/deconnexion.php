<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php
// Code PHP



include '../inc/auth.php';
$Auth = new modAuth();



?>

<?php
}else{
    echo "<h1>Not Found</h1><br>";
    echo "The requested URL was not found on this server.";

    ?>
    <title>404 Not Found</title>
    <?php

}

?>
