<?php
if ($_COOKIE["aeae"]){
    echo "exist";


}else{
echo "not exist";

}
echo 'Bonjour ' . htmlspecialchars($_COOKIE["name"]) . '!';

  // Suppression du cookie designPrefere
  setcookie("naea", '', time()-3600,'/');
  // Suppression de la valeur du tableau $_COOKIE
 
?>