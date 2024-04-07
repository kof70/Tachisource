const fs = require('fs');
const path = require('path');

// Chemin du répertoire à lire
const directoryPath = '.../ressource/apps';

// Lecture du répertoire
fs.readdir(directoryPath, (err, files) => {
  if (err) {
    console.error('Erreur lors de la lecture du répertoire :', err);
    return;
  }

  // Affichage des noms des fichiers
  files.forEach(file => {
    console.log(file);
  });
});
