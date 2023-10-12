# Blog

Premier blog de FLX

# Sommaire

[[_TOC_]]

# Fonctionnement

## Organisation du projet

Ce projet repose sur **Slim Framework v4.8.1**, sa documentation : https://www.slimframework.com/docs/v4/

Slim n'impose rien, mais une documentation est associée aux skeleton officiel, on la respecte donc :
https://odan.github.io/slim4-skeleton/directory-structure.html

Ce skeleton suit d'ailleurs un standard tentant d'harmoniser les structures des projets web :
https://github.com/php-pds/skeleton

# Installation, update et développement

## Installation du projet

Quelques étapes simples pour installer ce projet en local ou en production : 

1. Cloner le projet : `git clone git@gitlab.com:FLXwkg/blog.git`
2. Entrer dans le répertoire du projet : `cd blog`
3. Installer les dépendances depuis le composer.lock : `composer install`
4. Copier la configuration d'exemple : `cp config/application.config.php.dist config/application.config.php`
5. Créer un host sur le serveur web pointant sur le répertoire `public`, documentation : https://www.slimframework.com/docs/v4/start/web-servers.html  

En cas de problème liés au serveur ou aux dépendances de l'application, lancer la commande : 
`composer check-platform-reqs` pour vérifier que tout est compatible.

Exemple de retour quand tout est OK :

```bash
➜  blog git:(master) ✗ composer check-platform-reqs
ext-curl      7.3.23    success
ext-json      1.7.0     success
ext-mbstring  7.3.23    success
php           8.2.1     success
```

**Attention** : En production, la configuration `debug` doit être sur `false` **impérativement** car les pages d'erreur contiennent un `var_dump` de l'exception déclenchée quand le debug est activé !

## Update du projet

Avant d'update, vérifier si de nouveaux éléments sont apparus dans la configuration de démo
(`config/application.config.php.dist`) et si oui, ajouter les clés dans la configuration du projet

Ensuite, il suffit de : 

1. rapatrier les changements `git pull origin master`
2. installation/update des dépendances figées dans le composer.lock : `composer install`




## Développement local

### Environnement local

Personnellement, j'utilise **Vagrant**, **Virtualbox** et la box **Laravel-Homestead** pour mon setup
de développement local, il permet de créer un Virtual Host en quelques lignes de configuration.

Plus d'infos sur Homestead : https://laravel.com/docs/8.x/homestead

### Les commits

Tous les changements sont versionnés via git. Pour mieux identifier les commits, 
j'utilise **Gitmoji** qui permet, via une nomenclature d'emoji, de voir rapidement pour quelles raisons le commit a été fait.
Les emojis étant affichés dans les gestionnaires Github et Gitlab, on peut facilement visualiser les changements juste en parcourant la liste des commits.
Ca permet aussi  d'éviter les commits à rallonge devenant illisibles en faisant des commits plus courts.

Plus d'infos sur Gitmoji : https://gitmoji.dev/

### Editorconfig

Pour que les développeurs utilisent tous la même norme d'indentation, charset et autres éléments de configuration propre à l'IDE, 
j'utilise la norme basée sur les fichiers `.editorconfig`. Ces fichiers sont compris par la plupart des IDE soit en natif, soit via un plugin et 
permettent d'éviter qu'un développeur ré-indente tout les fichiers qu'il a ouvert (et donc pollue les commits et l'homogénéité du code).
Le fichier `.editorconfig` est versionné dans le projet.

Plus d'infos sur editorconfig : https://editorconfig.org/

### Composer

Pour éviter qu'un développeur ait une version d'une dépendance et un autre développeur, une autre version, le fichier `composer.lock` est **versionné**.
Les développeurs font des `composer install` pour tous installer des versions identiques des dépendances.

Quand la commande `composer update` est executée, un commit doit suivre pour versionner la mise à jour du fichier `composer.lock`.
Sur les serveurs de préproduction et de production, c'est uniquement la commande `composer install` qui doit être éxecutée.

# Evolutions possibles ou à prévoir

## Ajouts

- [ ] Icônes diverses
- [ ] Fonts

## Optimisations possibles ou à prévoir

- [ ] Création d'une méthode slugify à affecter sur toutes les urls