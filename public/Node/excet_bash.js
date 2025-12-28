function reboot_system(){

const { exec } = require('child_process');

const cheminVersScript = 'bash.sh'; // Remplacez par le chemin approprié vers votre script shell

exec(`sh ${cheminVersScript}`, (erreur, stdout, stderr) => {
  if (erreur) {
    console.error(`Une erreur s'est produite lors de l'exécution du script : ${erreur}`);
    return;
  }
  
  console.log('Le script a été exécuté avec succès');
  console.log('Sortie :', stdout);
  console.error('Erreur :', stderr);
});
}