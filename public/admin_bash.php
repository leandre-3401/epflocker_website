<?php
include('getIP.php');
$IP = getIP();
if ($IP == "192.168.138.102"){
  
  ?>

<?php


function executerScriptShell($cheminVersScript, $motDePasse) {
    // Vérifier si le fichier .sh existe
    if (file_exists($cheminVersScript)) {
        // Échapper les caractères spéciaux dans le chemin du script
        $cheminVersScript = escapeshellcmd($cheminVersScript);

        // Exécuter le script shell avec sudo
        $commande = "echo $motDePasse | sudo -S bash $cheminVersScript";
        $resultat = shell_exec($commande);

        // Retourner le résultat de l'exécution
        return $resultat;
    } else {
        return "Le fichier script n'existe pas.";
    }
}

$cheminVersMonScript = __DIR__ . '/bash.sh';
$motDePasse = 'epflocker';

$resultatExecution = executerScriptShell($cheminVersMonScript, $motDePasse);
echo $resultatExecution;

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