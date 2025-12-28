<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php
//ce code est run dans loader.php
//atribution au hasard casier 


//partie tirage aléatoire pour test remplacer par la recherche dans la bdd
//$min = 1;
//$max =2;
//$colonne ="A";
//$casier = $colonne . strval(rand($min, $max));

//Partie recherche dans la bdd quel casier est libre et qui correspond à la demande qu client 
//Le top ça serait d'écrire dans la bdd déjà le mec avec son casier et juste la on choissit quel est le casier
//code écrire dans la bdd quel casier à qui )=> attribution casier.php

//ici lire dans la bdd la dernières ligne et le casier qu'il faut ouvrir (celui atribué au client actuel)

// dans la varialbe casier il faut sortir le casier qu'on souhaite ouvrir 
//le lien ressort renvoie vers le code qui esffectue la commande arduino en cachette 
$lien = "http://localhost:8080/power" .$casier .".html";
echo($lien); //important =< un seul echo !!!
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