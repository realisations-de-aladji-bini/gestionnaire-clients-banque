## Description
Ce projet back-end réalisé en Laravel développe des APIs d'une application de gestion des clients d'une banque. Ces clients sont appelés "abonnes" dans le code. 
Il expose des endpoints CRUD pour les clients, les comptes et les statistiques générales dans le fichier api.php du répertoire routes. Des seeders sont mis en place vous permettant donc de peupler votre bd une fois que l'aurez créée.

## Fonctionnalités

#### Gestion des clients 
    - Liste de tous les clients
    - Liste de tous les clients avec leurs comptes respectifs
    - Ajout d'un nouveau client
    - Infos d'un client
    - Détails d'un client avec ses comptes
    - Modification des infos d'un client existant
    - Suppression d'un client

#### Gestion des comptes clients
    - Liste de tous les comptes
    - Ajout d'un nouveau compte
    - Détails d'un compte
    - Modification des détails d'un compte
    - Liaison d'un client à son compte
    - Retrouver les comptes d'un client donné

#### Statistiques
    - Statistiques d'un client
    - Statistiques générales
    

## Installation et exécution

Il faut avoir installé Laravel sur votre machine hôte. Voir le [guide d'installation](https://laravel.com/docs/11.x/installation) sur le site officiel de Laravel [ici](https://laravel.com/docs/11.x/installation) 

### Mise en place de la base de données 

Une fois php et Laravel correctement installés et configurés, il faut créer la base de données type MYSQL dans votre SGBD préféré(Wamp, MySQL,...). Le nom de la bd utilisée est **dbclientsbanque**. Vous pouvez toutefois le changer dans la configuration du projet. Il s'agit d'éditer la ligne 14 (la variable d'environnement DB_DATABASE) du fichier *.env* situé à la racine du projet. NB: Le nom de votre bd doit être exactement identique à celui de la valeur de la variable d'environnement DB_DATABASE.
Après création de la bd, il faut créer les différentes tables et relations entre elles dans cette bd. Pour ce faire, il faut suivre les étapes suivantes

+ Exécuter depuis le répertoire racine du projet, la commande
```php artisan migrate```
Cette commande lancera les migrations pour la création des tables

+ Une fois les tables créées, on le peuple de données prédéfinies dans le code via la commande : 
```php artisan db:seed```  
Cette commande permet de peupler, avec des données prédéfinies, votre base de données nouvellement créée.
Vous pouvez également raffraîchir les données de votre base par la commande : 
```php artisan migrate:fresh --seed```
À chaque fois qu'elle est exécutée, cette commande supprime toutes les tables et les recrée avec le peuplement. Pour plus de détails sur les *seeders*, [suivez ce lien](https://laravel.com/docs/11.x/seeding).  

### Exécution de l'application

Ouvrir un terminal à la racine du projet et entrer la commande suivante
    ```php artisan serve``` 
