# Login PHP

Le but : créer un système de login basique mais fonctionnel permettant à un utilisateur autorisé d'accéder à la partie non publique d'un site. 


# Steps

Les différentes étapes

## Création de la structure de fichiers

> php_login/
>> index.html
>> home.php
>> authenticate.php
>> logout.php
>> profile.php
>
>> css/
>>> style.css




## Création de la base de données

> BDD : phplogin
>> Table : accounts
>> Fields :
>>> **id**: int, AI, primary
>>> **username**: varchar(255), NOT_NULL
>>> **password**: varchar(255), NOT_NULL
>>> **role**: varchar(50), DEFAULT 'user', NOT_NULL
>>> **created_at**: DATETIME, DEFAULT 'CURRENT_TIMESTAMP', NOT_NULL

## index.html

### Contenu HTML
CSS links :
- [FontAwesome](https://use.fontawesome.com/releases/v5.7.1/css/all.css) : https://use.fontawesome.com/releases/v5.7.1/css/all.css
- css/style.css

Formulaire de login :
> action: authenticate.php
> method: POST
> inputs: 
>> username: type=text, name=username
>> password: type=password, name=password
>> submit: type=submit, value=login

## authenticate.php

- Etablit une connexion avec la DB
- Reçoit les informations du formulaire, les vérifie et les sécurise
- Fait une requête à la DB pour vérifier que l'utilisateur existe

> Oui ?
>> ouvre une session pour l'utilisateur
>> redirige l'utilisateur vers home.php

>Non ?
>> redirige l'utilisateur vers index.html

## home.php

- Vérifie si l'utilisateur est connecté
> Oui ?
>> affiche le contenu HTML de la page et un message personnalisé de bienvenue

> Non ?
>> redirige l'utilisateur vers index.html

### Contenu HTML

CSS links :
- [FontAwesome](https://use.fontawesome.com/releases/v5.7.1/css/all.css) : https://use.fontawesome.com/releases/v5.7.1/css/all.css
- css/style.css

- Menu vers **profile.php** et **login.php**
- Titre et message de bienvenue personnalisé

## profile.php

- Vérifie si l'utilisateur est connecté
> Oui ?
>> rétablit une connexion avec la DB
>> récupère les informations sur l'utilisateur
>> affiche ces informations dans le contenu HTML de la page

> Non ?
>> redirige l'utilisateur vers index.html

### Contenu HTML

CSS links :
- [FontAwesome](https://use.fontawesome.com/releases/v5.7.1/css/all.css) : https://use.fontawesome.com/releases/v5.7.1/css/all.css
- css/style.css

- Menu vers **profile.php** et **login.php**
- Titre et table contenant les informations de l'utilisateur

## logout.php

- détruit la session de l'utilisateur
- redirige l'utilisateur vers index.html 


