# Installation

POC pour le hackathon de BestWestern

  
Markdown is a lightweight markup language based on the formatting conventions that people naturally use in email.  As [John Gruber] writes on the [Markdown site][df1]

### Version
1.0.0

### Installation
Clonez le projet ou téléchargez le au format zip

Lancer la commande composer install pour installer les dépendances du rojet
```sh
$ composer install
```

Puis, créer une base de données de votre choix

Lancer la commande suivante afin de générer une clé utilisable par l'application

```sh
$ php artisan key:generate
```

Créez un fichier d'environnement ".env" à la racine du projet

et rentrez les informations suivantes:
````
APP_ENV=local
APP_DEBUG=true
APP_KEY=bqCZL8GIzBYqcPjs25rXE38Y0zGxSwOw

DB_HOST=127.0.0.1
DB_DATABASE=nom de votre base de données
DB_USERNAME=votre nom d'utilisateur pour se connecter à la base de données
DB_PASSWORD=votre mot de passe pour se connecter à la base de données

CACHE_DRIVER=memcached
SESSION_DRIVER=memcached
QUEUE_DRIVER=database

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
````

Enfin, lancez la commande suivante afin de peupler votre base de données 
```sh
$ php artisan migrate && php artisan db:seed
```


## Accéder aux comptes de test:

### Compte prospect (non ambassadeur):
*  pseudo :anonymous
*  email: anonymous@gmail.com
*  mot de passe: password

### Comptes clients (ambassadeurs):
*  Compte 1: 
*  email: benoit@gmail.com
*  mot de passe: password
* Compte 2: 
*  email: francis@gmail.com
*  mot de passe: password

###  Compte administrateur:
*  email: admin@admin.com
*  password: password



