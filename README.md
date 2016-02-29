# UStA
[//]: # (A Symfony project created on August 3, 2015, 7:07 pm.)

**UStA** (**U**ser **St**orage **A**pplication) est une application Web de gestion des cotisations annuelle des membres d'une association.

  - Développeurs : **Yasin SENEL** & **Sadetdin EYILI**
  - À : **Bordeaux <3**
  -  Projet développé sous : **Linux**

### Version
0.0.1 Alpha

### Technologies

UStA est propulsé par plusieurs technologies :

- Un serveur **HTTP Apache**
- Un serveur de Base de Données **MySQL**
- Le langage PHP avec le framework **Symfony**
- Le framework HTML CSS et JS **Bootstrap**
- Le service d'hébergement et de versionnement du code **GitHub**
- Le pack d'icônes **Font Awesome**

### Installation

##### Ubuntu
 1/ Installation du serveur LAMP

`sudo apt-get install apache2 php5 mysql-server libapache2-mod-php5 php5-mysql` (lors de l'installation, il vous sera demandé d'entrer le mot de passe de la base de données MySQL)

Installer le module php intl `sudo apt-get install php5-intl`

Éditer le fichier `/etc/php5/apache2/php.ini` et définir le date.timezone (ligne 884) `date.timezone = Europe/Paris`

Ensuite redémarrer le serveur `sudo service apache2 restart`

 2/ Installer composer

 ```
 curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/bin/composer
 ```
 Faites `sudo composer` pour vous assurer que composer est bien installé.

 3/ Cloner le repository

 Aller dans `/var/www/html` et faites `sudo git clone https://github.com/sad270/UStA.git`

Gérer les permissions des logs et caches :
```
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
```

Puis `php bin/console cache:clear` pour tester les permissions

Renommer `web\app_dev.php.dist` en  `web\app_dev.php`

 4/ Créer la base de données

`mysql -u root -p` puis entrer le mot de passe que vous avez entré lors de l'installation du serveur
`CREATE DATABASE UStA COLLATE 'utf8_general_ci';` puis `exit` pour quitter MySQL

 5/ Installer les dépendances

 Aller dans `/var/www/html/UStA` faites `sudo composer install` et attendre que composer installe toutes les dépendances.

 Il vous demandera d'entrer certains paramètres que voici :
 ```
database_host: 127.0.0.1
database_port: null
database_name: UStA
database_user: root
database_password: *mot_de_passe*
mailer_transport: smtp
mailer_host:127.0.0.1
mailer_user: null
mailer_password: null
secret: *entrer un token généré sur http://nux.net/secret*
 ```

 6/ Installer la BDD

Connectez-vous à votre base de données et créez manuellement la table `usta_membershipFees_members`

```
mysql -u root -p UStA
CREATE TABLE usta_membershipFees_members (
  membership_fee_id INT NOT NULL,
  member_id INT NOT NULL,
  PRIMARY KEY(membership_fee_id, member_id)
)
DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
exit
```

Puis laissez Doctrine générer le reste de la base de données à l'aide de la commande `php bin/console doctrine:schema:update --force`


 7/ Créer le super-admin

Entrer la commande (remplacer admin par le nom d'utilisateur du super-administrateur) `php bin/console fos:user:create admin --super-admin` puis saisissez l'adresse mail et le mot de passe de l'admin

*TO DO*

### Code source
Le code source de USTA est disponible sur GitHub et est sous Licence libre MIT

> La licence donne à toute personne recevant le logiciel le droit illimité de l'utiliser, le copier, le modifier, le fusionner, le publier, le distribuer, le vendre et de changer sa licence.
source [Wikipedia][df1]

### Todos

 - [ ] Finir le Todos :p
 - [x] Guide d'installation pour Ubuntu

Licence
===

> The MIT License (MIT)
>
> Copyright (c) 2016 Yasin SENEL & Sadetdin EYILI
>
> Permission is hereby granted, free of charge, to any person obtaining a copy
> of this software and associated documentation files (the "Software"), to deal
> in the Software without restriction, including without limitation the rights
> to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
> copies of the Software, and to permit persons to whom the Software is
> furnished to do so, subject to the following conditions:

> The above copyright notice and this permission notice shall be included in all
> copies or substantial portions of the Software.
>
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
> IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
> FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
> AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
> LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
> SOFTWARE.

[df1]: <https://fr.wikipedia.org/wiki/Licence_MIT>
