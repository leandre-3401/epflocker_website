function verif_rfidBDD(valeur) {
  const mysql = require('mysql');

  // Créez une connexion à la base de données MySQL
  const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'epflocker_db',
  });

  // Connectez-vous à la base de données
  connection.connect((error) => {
    if (error) {
      console.error('Erreur lors de la connexion à la base de données :', error);
    } else {
      console.log('Connecté à la base de données MySQL.');
    }
  });

  const selectQuery = `SELECT Adresse_mail FROM rfid WHERE Id_Rfid= '${valeur}'`;

  connection.query(selectQuery, (error, results) => {
    if (error) {
      console.error('Erreur lors de l\'exécution de la requête :', error);
    } else {
      if (results.length > 0) {
        const valeurAutreColonne = results[0];
        console.log('Valeur de l\'autre colonne :', valeurAutreColonne);
      } else {
        console.log('Aucun résultat trouvé pour la valeur spécifiée.');//action pour écrir mail en face du rfid
      }
    }
  });

  connection.end((error) => {
    if (error) {
      console.error('Erreur lors de la fermeture de la connexion à la base de données :', error);
    } else {
      console.log('Connexion à la base de données fermée.');
    }
  });
}


verif_rfidBDD("123");
