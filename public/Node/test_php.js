const express = require('express');
const phpExpress = require('php-express')({
  binPath: '/usr/bin/php', // Chemin vers l'exécutable PHP // Chemin vers l'exécutable PHP (assurez-vous que PHP est installé et accessible depuis le chemin spécifié)
  rootPath: __dirname, // Répertoire racine où se trouvent les fichiers PHP
});

const app = express();
app.use('/', phpExpress.router);

app.listen(8000, () => {
  console.log('Serveur PHP en cours d\'exécution sur le port 8000');
});
