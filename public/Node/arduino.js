var usbserial = '/dev/ttyACM0';
//var usbserial = '/dev/ttyACM0';

var https = require('https');
var fs = require('fs');
var path = require("path");
var url = require("url");

const IP = '192.168.138.102'; // Remplacez par l'adresse IP souhaitée
const PORT = 8080;

// Charger les certificats SSL
var options = {
  key: fs.readFileSync('private-key.pem'),
  cert: fs.readFileSync('certificate.pem')
};

// Gestion des pages HTML
function sendError(errCode, errString, response) {
  response.writeHead(errCode, { "Content-Type": "text/plain" });
  response.write(errString + "\n");
  response.end();
  return;
}

function executerScriptPythonDansArduinoJs() {
  const { exec } = require('child_process');

  return new Promise((resolve, reject) => {
    exec('python rfid_lecture.py', (error, stdout, stderr) => {
      if (error) {
        console.error(`Erreur d'exécution du code Python : ${error}`);
        reject(error);
        return;
      }

      // Récupérer la valeur renvoyée par le script Python (stdout) et la stocker dans une variable
      const valeurRenvoyee = stdout.trim();

      // Résoudre la promesse avec la valeur renvoyée
      resolve(valeurRenvoyee);
      //badge admin ?

     if(badge_admin(valeurRenvoyee) === true) {
      console.log("Admin action");
      return ("Badge_admin");
     
     }
     else{
      console.log("Connexion badge");
      verif_rfidBDD(valeurRenvoyee);
      return (valeurRenvoyee);
     }
      //Appel à la vérification dans la BDD
      
      //return (valeurRenvoyee);
    });
  });
}


//Fonction verif bdd
function verif_rfidBDD(valeur) {
  const mysql = require('mysql');
  // Créez une connexion à la base de données MySQL
  const connection = mysql.createConnection({
    host: 'localhost', //atention faut changer 
    user: 'epflocker',
    password: '3pfl0ck3r',
    database: 'epflocker_db',
  });
  // Connectez-vous à la base de données
  connection.connect((error) => {
    if (error) {
      console.error('Erreur lors de la connexion à la base de données :', error);
    } else {
      console.log('Connecté à la base de données MySQL.');
    
      //Gestion d'un badge d'authenfication
      const selectQuery = `SELECT Adresse_mail FROM RFID WHERE Id_Rfid = ?`; // je cherche si mon id a une adresse mail attribuée
      const selectValues = [valeur];//badge valeur

      connection.query(selectQuery, selectValues, (error, results) => {
        if (error) {
          console.error('Erreur lors de l\'exécution de la requête SELECT :', error);
        } else {
          if (results.length > 0) {
            const valeurAutreColonne = results[0];
            console.log('Valeur de l\'autre colonne :', valeurAutreColonne); // si oui c'est carré
            
            //Insère dans la table Courante 
            const updateQuery = 'UPDATE table_courante SET Id_Badge = ? WHERE Id_Badge  = ?';
            const updateValues = [valeur, "None"];
            connection.query(updateQuery, updateValues, (err, result) => {
              if (err) {
                console.error('Erreur lors de l\'exécution de la requête UPDATE :', err);
              } else {
                console.log('Données mises à jour avec succès !');
              }
            });
            

         }
          else {

            //si non j'insère la valeur du badge et adresse mail est égale à "None" j'ioentife ma valeur que je dois remplir 
            console.log('Aucun résultat trouvé pour la valeur spécifiée.');

            const insertQuery = `INSERT INTO RFID (Id_Rfid, Adresse_mail) VALUES (?, ?)`;
            const insertValues = [valeur, 'None'];

            connection.query(insertQuery, insertValues, (err, result) => {
              if (err) {
                console.error('Erreur lors de l\'exécution de la requête INSERT :', err);
              } else {
                console.log('Données insérées avec succès !');
              }

              //Insère dans la table Courante attribution None à l'adresse mail => première connexion 
            const updateQuery1 = 'UPDATE table_courante SET Id_Badge = ? WHERE Id_Badge = ?';
            const updateValues1 = [valeur, "None"];
            connection.query(updateQuery1, updateValues1, (err, result) => {
              if (err) {
                console.error('Erreur lors de l\'exécution de la requête UPDATE :', err);
              } else {
                console.log('Données mises à jour avec succès !');
              }
            });

              connection.end((error) => {
                if (error) {
                  console.error('Erreur lors de la fermeture de la connexion à la base de données :', error);
                } else {
                  console.log('Connexion à la base de données fermée.');
                }
              });
            });
          }
        }
      });
    }
  });
}

function badge_admin(id) {
  // Badge qui permet d'effectuer un reboot de la carte

  // Connection à la BDD
  const mysql = require('mysql');
  // Créez une connexion à la base de données MySQL
  const connection = mysql.createConnection({
    host: 'localhost', // Attention, il faut changer ça
    user: 'epflocker',
    password: '3pfl0ck3r',
    database: 'epflocker_db',
  });

  connection.connect((error) => {
    if (error) {
      console.error('Erreur lors de la connexion à la base de données:', error);
    } else {
      console.log('Connecté à la base de données MySQL.');
  
      // Gestion du badge d'administrateur
      const selectQuery1 = `SELECT action_bash FROM badge_bash WHERE Id_Badge = ?`; // Vérifie si le badge est spécial
      const selectValues1 = [id]; // Valeur du badge
      connection.query(selectQuery1, selectValues1, (error, results) => {
        if (error) {
          console.error('Erreur lors de l\'exécution de la requête SELECT:', error);
        } else {
          console.log('BEN MA');
          if (results.length === 0) {
            console.log('La table est vide. Faire quelque chose en conséquence.');
            
          } else if (results[0].action_bash === 'reboot') {
            console.log('C\'est bon');
            connection.end();
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
              return true;
            });
          }
          else if (results[0].action_bash === 'open') {
            console.log('open');
            
            const { exec } = require('child_process');
            const cheminVersScript = 'open.sh'; // Remplacez par le chemin approprié vers votre script shell
            exec(`sh ${cheminVersScript}`, (erreur, stdout, stderr) => {
              if (erreur) {
                console.error(`Une erreur s'est produite lors de l'exécution du script : ${erreur}`);
                return;
              }
             
              console.log('Le script a été exécuté avec succès');
              console.log('Sortie :', stdout);
              console.error('Erreur :', stderr);
              return true;
            });
          }

      

        }
        // Ferme la connexion à la base de données
        connection.end();
        return false;
      });
    }
  });
}

function deconnexion(){

  const { exec } = require('child_process');
  const cheminVersScript = 'deco.sh'; // Remplacez par le chemin approprié vers votre script shell
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
  


function sendFile(err, file, response) {
  if (err) return sendError(500, err, response);
  response.writeHead(200);
  response.write(file, "binary");
  response.end();
}

function getFile(exists, response, localpath) {
  if (!exists) return sendError(404, '404 Not Found', response);
  fs.readFile(localpath, "binary",
    function (err, file) { sendFile(err, file, response); });
}

function getFilename(request, response) {
  var urlpath = url.parse(request.url).pathname;
  var localpath = path.join(process.cwd(), urlpath);
  fs.exists(localpath, function (result) { getFile(result, response, localpath) });
}

var server = https.createServer(options, getFilename);

// -- socket.io --
// Chargement
var io = require('socket.io')(server);

// -- SerialPort --
// Chargement
var { SerialPort } = require('serialport');
var arduino = new SerialPort({ path: usbserial, baudRate: 115200, autoOpen: false });

/************ IMPORTANT ********
Pour fonctionner correctement, le fichier 'serialport' @ Users/node_modules/serialport/lib/serialport.js
à été modifié à la ligne 32
baudRate: 115200,

La communication série dans les sketches arduino doit être paramètrés à 115200 bauds : Serial.begin(115200);  
*/

// Overture du port serie
arduino.open(function (err) {
  if (err) {
    return console.log('Error opening port: ', err.message);
  }
  else {
    console.log("Communication serie Arduino 115200 bauds : Ok")
  }
});

// Requetes
io.sockets.on('connection', function (socket) {
  // Message à la connection
  console.log('Connexion socket : Ok');
  //socket.emit('message', 'Connexion : Ok');
  // Le serveur reçoit un message" du navigateur    
  socket.on('message', function (msg) {
   
   
    // socket.emit('message', 'Veuillez patienter !\n');
    if (msg === "Rfid") {

      executerScriptPythonDansArduinoJs()
        .then((valeur) => {
          if(valeur==="Badge_admin"){
            socket.emit('message', "Badge_admin");
          }
          else{

          
          console.log('Valeur renvoyée par le script Python :', "R:" + valeur);
          //Faites ce que vous souhaitez avec la valeur renvoyée
          console.log("Prêt pour le code python");
          socket.emit('message', "R:" + valeur); //renvoie du code
          }
        })
        .catch((erreur) => {
          console.error('Erreur lors de l\'exécution du script Python :', erreur);
        });
     // console.log("Prêt pour le code python");
      //socket.emit('message', 'YEES !\n' );
      //socket.emit(executerScriptPythonDansArduinoJs());
    }
    
   else if( msg === "z"){
    console.log("Hamza");
    deconnexion();    
   }
   
    else{
    arduino.write(msg, function (err) {
      if (err) {
        io.sockets.emit('message', err.message);
        return console.log('Error: ', err.message);
      }
    });
  }
  });
});


arduino.on('data', function (data) {
  let buf = new Buffer(data);
  io.sockets.emit('message', buf.toString('ascii'));
  console.log(buf.toString('ascii'));
  //console.log(buf);
});

//lecture_bdd("casiers_emprunt");
server.listen(PORT, IP, () => {
  console.log(`Server running at ${IP}:${PORT}`);
});
