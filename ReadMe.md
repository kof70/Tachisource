# Project Title: TachiSource



# Guide d'installation du projet Symfony

Ce guide décrit les étapes pour cloner le projet Symfony depuis GitHub, installer les dépendances, configurer la base de données, charger les fixtures et lancer l'application sur différentes plateformes (Mac, Windows, Linux).

## Prerequit
ce projet est fait avec une version de php>=8.1
veuiller installer la version adequoit de **[php](https://www.php.net/downloads.php)** et **[composer](https://getcomposer.org/download/)** au prealable et de **[symfony cli](https://symfony.com/download)** 

---

## Clonage du projet

1. Ouvrez un terminal.

2. Clonez le projet depuis GitHub :
```bash
git clone https://github.com/kof70/Tachisource.git
```

3. Accédez au répertoire du projet :
```bash
cd Tachisource
```


---

## Installation des dépendances

1. Assurez-vous d'avoir PHP et Composer installés sur votre système.

2. Installez les dépendances du projet :

```bash
composer install
```


---

## Configuration de la base de données

1. Copiez le fichier `.env.dist` en `.env` :


2. Configurez les paramètres de la base de données dans le fichier `.env` en fonction du gestionnaire de BD que vous utiliser

3. Créez la base de données :
```bash
php bin/console doctrine:database:create
```
- pour ceux qui ont `symfony cli` d'installer 
```bash
symfony console doctrine:database:create
```
4. creer les table avec cette commande 
```bash
php bin/console doctrine:schema:update --force
```

---

## Chargement des fixtures (données de test)

1. Chargez les fixtures :
```bash
php bin/console doctrine:fixtures:load
```


---

## Lancement de l'application

1. Lancez le serveur web local :
```bash 
php bin/console serve:start
```
ou 
```bash
php -S 127.0.0.1:8000 -t public  
```

- pour ce qui ont symfony cli d'installer 
```bash
symfony serve
```



---

## Plateformes supportées

- Mac OS
- Windows
- Linux

###### ***```Par contre vous devrait cherche les commance adapter a votre systeme si ceux fournie ne marche pas avec le votre ```***
---

## Contact

Pour toute question ou problème, contactez-nous à [sessoklinaulrich@gamil.com](mailto:sessoklinaulrich@gmail.com) ou 
[djakpakoffi@gmail.com](mailto:djakpakoffi7029@gmail.com).
