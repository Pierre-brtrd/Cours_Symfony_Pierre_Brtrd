# Cours Symfony :

Le but de ce cours est de découvrir le framework Symfony est de pouvoir développer des applications web.

Nous verrons pendant la formation :

- L'initialisation d'un projet Symfony,
- Faire la configuration de la base de donnée avec l'ORM Doctrine,
- La configuration de la partie backend de l'application avec la gestion des controllers ainsi que les différentes routes de l'application,
- La partie développement du backend ainsi que la gestion de l'administration des données.

## Prérequis pour la formation :

Il est important d'avoir certaines base de connaissance avant de débuter la formation Symfony :

- Connaissance en HTML/CSS/JS
- Connaissance en PHP
- La connaissance du SQL est un plus
- Savoir utiliser un terminal de commande

## Configurer votre environnement :

### VsCode :

Pour développer, je vous conseille l'IDE VsCode qui permet d'avoir une bonne vision sur l'arboresence dossier dans un projet, et qui permet également d'installer des plugin d'aide au développement qui nous seront utiles pour la formations. Pour télécharger le logiciel, <a href="https://code.visualstudio.com/download" target="_blank">cliquez ici</a>

### Github :

Nous allons travailler avec Github, ce qui va permettre de versionner notre code et pouvoir ainsi avoir une vision claire sur l'historique des modifications.

Vous devez dans un premier temps configurer votre environnement avec Git :

- **Pour les MACs** :

  - Ouvrez un terminal de commande et entrez la commande :

  ```shell
  xcode-select –install
  ```

  Une fenêtre va s’ouvrir vous demandant si vous voulez installer des outils de ligne de commande, cliquez sur installer

  - Ensuite, vous devez configurer vos informations Git : _(Ne pas oublier les guillemets)_

    ```shell
    git config --global user.name "Votre Nom et Prénom"
    ```

    Ensuite : _(Ne pas mettre les guillemets)_

    ```shell
    git config --global user.email votre email
    ```

    Pour vérifier les informations, entrez la commande :

    ```shell
    git config –list
    ```
    
### Yarn

Yarn est un manager de paquets en ligne de commande qui va nous permettre d'installer et de gérer des composants de notre application symfony.

Pour l'installer sur vos postes, vous devez :

- Ouvrir un terminal de commande
- Entrez la commande :
	```shell
	/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
	```
	* Si vous avez une erreur, Attendre que Hombrew soit installer pour lancer la commande suivante et mettre le mot de passe de votre poste :
	```shell
	sudo chown -R $(whoami) /usr/local/share/zsh /usr/local/share/zsh/site-founctions
	```
- Entrez la commande :
	```shell
	brew install yarn
	```
	
### Docker

Pour faciliter la configuration de l'environnement de chaque participants, nous allons utiliser **Docker** (pour les plus curieux, voici <a href="https://docs.docker.com/" target="_blank">la doc de docker</a>.

Pour ça, vous avez simplement à télécharger et installer Docker sur votre poste : le lien est <a href="https://www.docker.com/products/docker-desktop" target="_blank">juste ici</a>.

## Télécharger le repos :

Maintenant que vous avez finis votre configuration d'environnement, vous pouvez télécharger le repos en local pour pouvoir modifier les fichiers et passer à la pratique.

Voici les étapes à suivre :

- Allez sur le repos dans l'onglet `code`
- cliquez sur le bouton vert `code` et sélectionnez l'onglet `https`
- Copiez le lien du repos
- Ouvrer un terminal de commande
- Allez dans le dossier où vous voulez télécharger le repos.
  - Pour rappel `cd NomDossier` -> changement de dossier en ligne de commande
  - `cd ..` -> revenir dans le dossier précédent
  - `ls` -> montrer les fichiers dans le dossier actuel
- Entrez la commande

  ```shell
  git clone https://github.com/Pierre-brtrd/cours_symfony_pierre_brtrd.git
  ```

## Ouvrir sa branch de développement :

Pour pouvoir travailler avec Github, vous ne devez pas faire votre développement sur la branch `Master`, c'est la branch d'origin et ne doit jamais être modifié directement. Pour pouvoir travailler de manière efficace, vous allez créer votre propre branch de développement depuis la branch `Master`.

Pour ça, ouvrez le dossier du repos que vous venez de télécharger avec VsCode.

- Ouvrir un terminal de commande VsCode
- Entrez la commande suivante : 
```shell
git checkout -b le-nom-de-votre-branch
```

## Lancement de l'environnement avec Docker :

Une fois que vous avez le repos en local, il ne reste plus que 2 choses à faire : lancer l'environnement Docker, et installer le projet Symfony.

### Docker :

- Ouvrez le dossier du repos avec VsCode
- Ouvrez un terminal VsCode `Terminal > New Terminal`
- Entrez la commande
  ```shell
  docker-compose build
  ```
- Ensuite, entrez la commande
  ```shell
  docker-compose up -d
  ```
- Enfin, entrez la commande
  ```shell
  docker exec -it -u dev app_symfony bash
  ```
- Vous êtes maintenant sur le terminal de l'environnement Docker et vous allez pouvoir débuter l'installation du projet Symfony.

### Installer un projet Symfony

Dans un premier temps, vous allez avoir besoin du client Symfony pour pouvoir utiliser des lignes de commandes Symfony sur votre environnement, vous pouvez retrouver la documentation d'installation sur ce [lien](https://symfony.com/download)

Ensuite, vous devez vérifier que votre environnement peut faire tourner une application symfony, pour ça, vous avez une nouvelle commande à entrer dans un terminal (grâce au client Symfony) :

```bash
symfony check:requirements
```

Une fois que vous savez que votre environnement peut faire tourner une application Symfony, vous devez rentrer la commande qui va permettre d'installer un projet vierge Symfony dans un terminal :

```bash
symfony new my_project_directory --version="6.*" --webapp
```

Cette commande va vous installer un projet Symfony vierge avec l'installation des dépendances.

Dernière chose à faire, installer une dépendance à notre projet PHPStan, qui va permettre d'analyser votre code PHP pendant le développement.

```bash
composer require --dev phpstan/phpstan
```

Pour lancer les tests vous aurez simplement à lancer la commande :

```bash
vendor/bin/phpstan analyse -l 0 src
```

### Symfony :

Pour installer les dépendances de Symfony et lancemer l'environnement de développement, vous devez :

- Dans le terminal de VsCode (terminal Docker), entrez la commande
  ```shell
  composer install
  ```
- Ensuite, vous avez simplement à vous rendre sur votre navigateur sur l'url `localhost`, vous verrez la page d'accueil de l'application Symfony.

## Configuration de la connexion en base de donnée :

Pour que le framework Symfony puisse communiquer avec votre base de donnée, nous allons devoir modifier l'url vers la database pour que Symfony se connecte et interagisse avec elle via Doctrine ORM.

Aller dans le fichier `.env` et cherchez la ligne commençant par `DATABASE_URL=...`.

Nous allons de voir modifier l'url pour ajouter celle de notre base de donnée que nous avons grâce à l'environnement docker.

La database URL se décompose comme suit :

- `myql://` -> qui définit le type de base de données, ici nous utilisons une base de donnée mysql.
- `db_user` -> qui définit le user de la base de données, ici nous avons paramétré le user `root`
- `db_password` -> qui définit le mot de passe pour accéder à la base de données, il faut laisser vide si pas de mot de passe, ici nous n'avons pas de mot de passe de paramétré, donc on passe directement à la suite de l'url.
- `@127.0.0.1` -> qui définit le serveur host de la base donnée, ici nous avons le host `@db_symfony` car l'host est configuré par notre image Docker db_symfony.
- `:3306` -> qui définit le port à utiliser pour la connexion.
- `/db_name`-> qui définit le nom de la base de donnée, ici nous avons une database qui se nomme `db_cours`
- `?serverVersion=5.7` -> qui définit la version du serveur que nous utilisons, ici nous utilisons un serveur Mysql `version 5.7`.

Ce qui fait que notre database URL est :

```shell
mysql://root:@db_symfony:3306/db_cours?serverVersion=5.7
```

Voici à quoi ressemble une URL de base de donnée.

## Lancement du server

Maintenant que nous avons installé notre projet Syfmony et configuré notre base de données, nous pouvons lancer le server local Symfony.

Symfony va lancer un server grâce à php installé en local sur votre système.

Pour lancer le serveur, rentrer la commande dans un terminal :

```bash
symfony server:start
```

Une fois la commande lancée, vous devriez voir une url sur votre terminal, c'est l'url sur laquelle vous allez pouvoir voir le rendu de votre application Symfony.

## Framework MVC

Symfony utilise le design pattern MVC, c'est à dire un patron de conception qui désigne une certaine architecture dans une application web.

Voici un petit schéma pour mieux comprendre :

![schéma-MVC](/Users/pierre/Formations/Visuel Cours/schéma-MVC.png)

Concrètement, comment ça marche ?

Le client (le navigateur) va envoyer une URL à notre __Routeur__, le routeur à pour but de trouver le bon contrôleur (il cherche une méthode dans un contrôleur en particulier suivant l'url envoyée).

Ensuite le __contrôleur__ va traiter les informations : aller chercher dans les modèles dans informations en base de données (les modèles vont exécuter les requêtes et renvoyer les données).

Ensuite le contrôleur va envoyer les informations à une __vue__ qui doit générer le HTML, et rendre la page au client (navigateur).

## Les dossiers

Une fois que vous avez installé un nouveau projet symfony, vous pourrez voir qu'il y a plusieurs dossiers qui viennent avec lac structure de base, passons en revu ces dossiers et leurs intérêt.

### Assets

Comme son nom l’indique, ce dossier contient tous les assets nécessaires pour le front de notre application Symfony.

Les assets sont principalement des fichiers **.css** et **.js** qui seront par la suite compilés à l’aide du package **Webpack Encore**.

### Bin

Ce dossier contient les fichiers de commandes permettant, par exemple, de vider le cache Symfony, mettre à jour la base de données ou encore lancer nos tests unitaires.

On utilise généralement la commande `php bin/console` qui affiche toutes les commande Symfony disponibles.

### Config

Toute la configuration des packages, services et routes se fera dans ce dossier.

Cela permettra, entre autre, de configurer notre connexion à la base de données, mettre en place tout un système de sécurité, ou encore personnaliser les services que nous développerons.

Les fichiers de configuration sont par défaut en **YAML**, même s’il est tout à fait possible d’utiliser **PHP** ou **XML**.

### Public

C’est le point d’entrée de l’application : chaque requête / demande passe forcément par ce dossier et le fichier `index.php`.

Étant accessible par tous, il est généralement utilisé pour mettre à disposition des fichiers de ressources, principalement des images.

### Src

C’est le cœur du projet ! L’endroit où vous passerez le plus de temps à coder. Il regroupe tout le code PHP de votre application, c’est ici que vous mettrez en place toute la logique de votre application.

Les dossiers qui seront obligatoires à utiliser pour le fonctionnement de l’application sont :

- **[Controller]** : Définition des points d’entrée de votre application. Il se charge de rediriger vers les Manager / Service / Repository. Aucun traitement de données, accès à la BDD (base de données) ne doit se faire depuis un Controller (très important). Possibilité de choisir les méthodes d’entrée (GET, POST, PUT, DELETE, ... ) ainsi que le type de réponse retournée (JSON, XML, ... ).
- **[Entity]** : Définition de la structure de votre BDD (base de données) au travers de classes. Chaque Entity représente généralement une table en BDD. La commande `php bin/console doctrine:migrations` nous permettra de mettre à jour notre BDD à chaque modification de l’Entity.
- **[Repository]** : Un Repository est toujours rattaché à une Entity, il nous permet de créer nos fonctions qui iront requêter la table de notre Entity (ainsi que les tables liées). Symfony utilise l’ORM **Doctrine** qui permet de créer nos requêtes SQL à travers les **queryBuilder** (très utile si l’on déteste faire du SQL).

### Templates

Symfony utilise depuis ses débuts le moteur de templates **Twig**.

Les fichiers de template Twig ont comme format `monfichier.html.twig` et viennent rajouter quelques fonctionnalités au HTML classique :

- **{{ ... }}** : appel à une variable ou une fonction PHP, ou un template Twig parent.
- **{% ... %}** : commande, comme une affectation, une condition, une boucle ou un bloc HTML.
- **{# ... #}** : commentaires.

Pour avoir plus d’infos et en apprendre plus sur Twig, vous trouverez ici une [documentation](https://twig.symfony.com/doc/2.x/) assez complète.

### Tests

Les tests unitaires **PHPUnit** seront définis ici pour tester notre application.

La commande pour lancer nos tests :

```shell
php bin/phpunit
```

Il faut néanmoins s’assurer que le **package phpunit** soit installé en utilisant la commande suivante :

```shell
composer require --dev symfony/phpunit-bridge
```

### Translation

L’internationalisation des applications est très importante aujourd’hui. Il est donc nécessaire de mettre en place un système de traduction dès le début du projet. Cela reste néanmoins facultatif si vous êtes certain de ne jamais avoir à traduire votre application.

Pour cela, on installe le **package translation** et on suit la [documentation](https://symfony.com/doc/current/translation.html) Symfony :

```shell
 composer require symfony/translation
```

### Var

Ici seront stockés le **cache** et les fichiers de **log**.

Il est possible dans les fichiers de config de paramétrer la mise en cache et ce que l’on écrit dans les logs.

### Le fichier composer.json

Tous les **packages** sont enregistrés dans ce fichier.

Ils sont installés automatiquement dans le dossier `vendors` lors de l’initialisation du projet mais on peut utiliser la commande `composer install` pour les installer manuellement si besoin.

Pour mettre à jour les packages, on utilise la commande `composer update` et pour ajouter un package on utilise `composer require monpackage`

## Les controllers :

Symfony utilise les controllers pour afficher les pages et intégrer des requêtes en base de donnée afin de pouvoir récupérer les informations, et les afficher ensuite sur la page.

Pour créer un controller, vous pouvez créer un fichier `FrontController.php` par exemple dans le dossier `src/controller`.

Notez que tous les controllers de Symfony sont écrit en PHP et qu'ils ont tous la même structure :

```PHP
<?php // <- Ouverture de la balise PHP

namespace App\Controller; // <- Défintion du namespace (Dans quel dossier se trouve le fichier)

// La partie `use` permet d'importer des modules(classe) de symfony et d'indiquer au fichier où chercher un module quand on l'appelle dans le code. (De chercher dans le bon namepsace la bonne classe)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// définition de la class du fichier (la class est utiliser pour importer le controller dans un autre fichier si besoin).La fonction extends définit que le Controller étends de l'AbstractController qui est un composant de symfony et qui va aider le développement du Controller. Attention, le nom de la class doit être identique au nom du fichier (sans l'extension .php)
class FrontController extends AbstractController
{
  /* Le traitement de votre controller... */
}
```

Maintenant, nous allons écrire dans le FrontController une fonction qui va afficher 'Hello World!' sur la page d'accueil :

```PHP
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; // <- va permettre de pouvoir récupérer la reponse de la requete
use Symfony\Component\Routing\Annotation\Route; // <- va permettre de définir les routes pour les functions

class FrontController extends AbstractController
{
  /**
   * @Route("/", name="home")
   *    Nous définition ci-dessus la route "/" (donc la home page) que nous allons appeler home
   * @return Response
   *    Permets de dire à symfony qu'il faut qu'il renvoi une réponse après le traitement de la donnée
   */
  public function index(): Response
    {
        return new Response("Hello World !"); // On demande au controller d'envoyer une réponse avec le contenu Hello World
    }
}
```

Maintenant, plutôt que de simplement envoyer une réponse avec hello world, nous allons vouloir rendre une vue, c'est à dire rendre un fichier html, pour ça nous allons utiliser la méthode render que nous pouvons utiliser grâce à la classe parente AbstractController.

Donc pour rendre une vous vous avez simplement à retourner la fonction render en stipulant le chemin vers votre vue en partant du dossier template :

```php
public function index(): Response
{
  return $this->render('Home/index.html.twig');
}
```

Grâce à cette méthode, nous pouvons rendre une vue twig depuis notre contrôleur, maintenant il nous reste à voir comment nous pouvons envoyer des données à notre vue :

```php
public function index(): Response
{
  $data = ['Pierre', 'Paul', 'Jacques'];
  return $this->render('Home/index.html.twig', [
    'data' => $data
  ]);
}
```

Ici, avant d'envoyer ma vue, je définit une variable PHP $data dans laquelle je stocke un tableau, pour envoyer cette information à ma vue, je vais la passer dans la fonction render, juste après avoir définit le chemin vers le fichier,  j'ouvre un tableau associatif (clé/valeur) la clé que je mets dans le tableau va être le nom de la variable qui va être générée dans ma vue twig, et la valeur sera la valeur que je pourrai afficher dans ma vue twig.

Vous pouvez envoyer plusieurs données dans une même vue.

### Générer un contrôleur

Nous venons de voir comment nous pouvons créer un contrôleur manuellement, mais Symfony nous permet de pouvoir créer un contrôleur avec une commande en terminal :

```shell
php bin/console make:controller MonController
```

Grâce à cette commande, Symfony va vous générer un nouveau contrôleur déjà prêt avec sa vue dans le dossier twig.

## Twig :

Twig est le moteur de template utiliser par Symfony, il va permettre de créer des gabarits de pages (templates) et de pouvoir y intégrer des variables que nous avec notre controller simplement et de manière beaucoup plus lisible qu'en PHP.

Les fichiers Twig sont utilisés par Symfony pour faire le rendu des pages de l'application, grossièrement, on peut dire que Twig ressemble au langage HTML, mais avec plus de fonctionnalités pour le rendu de variables PHP.

Tous les fichiers Twig doivent se trouver dans le dossier templates de votre projet (c'est dans ce dossier que Symfony va chercher les fichiers Twig), ils doivente également avoir l'extentsion `fichier.html.twig`.

TWIG reprend la strucure et les balises du HTML mais utilise des balises spécifiques pour afficher des variables, ou mettre en place des structures logiques à l'intérieur du code. Ces balises sont simple afin de ne pas avoir un code trop lourd et illisble.

Voici les différentes balises Twig :

- ```TWIG
  {{ maVariable }}
  ```
- ```TWIG
  {% if foo = 0 %}
    Condition 1
  {% else %}
    Sinon 1
  {% endif %}
  ```

Les balises twig avec `{{ }}` 2 acolades permettent d'afficher des variables.

Les balises avec `{% %}` 1 acolades et pourcent permettent d'afficher des structures logiques, à noter que la pluparts du temps, cest balise doivent êtres fermées avec `{% endif %}` (ou endblock, ou endfor... Tout dépend la structure logique que vous avez ouverte).

Ces fonctionnalitées vont nous permettre d'avoir un affichage dynamique et de couvrir un maximum les besoins de n'importe quelles application web.

Voici un exemple de fichier Twig :

```TWIG
{% extends 'base.html.twig' %}

{% block title %}Page d'accueil du site{% endblock %}

{% block body %}

  {% if maVariable is defined and maVariable is not null %}

    <div class="row">
      <div class="content">
        <p>{{ maVariable }}</p>
      </div>
    </div>

  {% else %}

    <div class="row">
      <div class="content">
        <p>La variable n'existe pas !</p>
      </div>
    </div>

  {% endif %}

{% endblock %}
```

Nous pouvons voir que le TWIG supporte le HTML, il permet d'afficher des variables de manière dynamique et également intégrer des strucures logiques : boucles For, While, condition If etc...

### Le fichier base Twig :

Les différents fichiers TWIG de votre projet vont tous étendre d'un fichier de base, souvent nommé `base.html.twig`.

Ce fichier est la base de toutes vos pages, la structure globale de vos pages, c'est dans ce fichier que vous allez créer votre l'architecture de votre code (la partie head avec les balises meta, et la partie body avec votre contenu)

Voici un exemple d'un fichier base.html.twig :

```TWIG
!DOCTYPE html>
<html>
	<head>
    <!-- Les métas qui doivent être sur toutes les pages et qui seront toujours appelées -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>

		{% block title %}{% endblock %}  <!-- La balise qui indique où le contenu du block Title des autres fichiers va être intégré -->

		</title>

    {% block stylesheets %}{% endblock %} <!-- La balise qui indique où le contenu du block CSS des autres fichiers va être intégré -->

	</head>
  <body>
    <nav>
      <!-- La navbar de votre site qui sera sur toutes les pages -->
    </nav>

    {% block body %}{% endblock %} <!-- La balise qui indique où le contenu body des autres fichiers va être intégré -->

  {% block javascripts %}{% endblock %} <!-- La balise qui indique où les balises javascript des autres fichiers va être intégré -->

  </body>
</html>
```

Maintenant voyons comment les autres fichiers vont appeler ce fichier de base et intégrer du contenu dans les balises que nous avons préparées dans le fichier base.html.twig :

```TWIG
{% extends 'base.html.twig' %} <!-- Le fichier commence par la balise extends qui va permmetre de définir le fichier de base à utiliser pour ce fichier -->

{% block title %}
  Titre de la page
{% endblock %}

{% block stylesheets %}
  <link rel="stylesheet" href="/css/index.css">
{% endblock %}

{% block body %}
  Le contenu de votre page
{% endblock %}
```

Comme vous pouvez le voir, nous avons utilisé les balises que nous avons placé dans le fichier base.html.twig, mais cette fois, nous avons intégré le contenu spécifique pour ce fichier(page). cette page va donc reprendre tout le fichier base.html.twig en intégrant le contenu des balises du fichiers. Cette méthode permet de pouvoir gagner du temps en ne devant pas redévelopper la structure à chaque fichier et de pouvoir faire de la réutilisation de composent.

### Création de la table User

Pour presque toutes les applications web, nous avons besoin de créer une table User afin de pouvoir gérer nos utilisateurs ainsi que les admins qui seront amener à utiliser le back office de notre application.

Pour ça, Symfony dispose d'une commande très simple qui permet de créer une classe User avec les propriétés adéquates pour gérer nos utilisateurs :

```shell
php bin/console make:user
```

Cette commande va vous poser plusieurs questions pour la gestion de vos utilisateur, en répondant aux questions dans le terminal, Symfony va vous générer le fichier classe User ainsi que faire la configuration du bundle sécurité de Symfony.

### Créer ou modifier une Entity

Une Entity dans Symfony c'est simplement une classe de modele, c'est à dire que chaque Entity est une classe PHP qui représente une table dans votre base de données.

Ici encore, Symfony dispose d'une commande en terminal pour créer ainsi que modifier une entity existante :

```shell
php bin/console make:entity MaClasse
```

Le nom que vous allez donner après make:entity sera le nom de votre future entity, ou si vous souhaitez modifier une entity déjà existante, vous n'avez qu'à mettre le nom d'une classe existante, Symfony va automatiquement vérifier si la classe existe ou non et va soit créer le fichier, soit modifier un fichier existant.

Toutes les informations vous sont données avec la commande make:entity (nom du champ type de données etc...)

### Modifier la table User

Par défaut l'Entity user générée par la commande `php bin/console make:user`, est un peu vide (très peu d'information sur l'utilisateur), si nous voulons rajouter le nom, le prénom, une adresse email, une adresse etc... Il va falloir modifier notre entity User.

Donc vous allez devoir rentrer la commande :

```shell
php bin/console make:entity User
```

Et automatiquement, Symfony va savoir que vous voulez modifier la classe User.

Une fois que vous avez ajouté toutes les propriétés que vous le vouliez, il faut maintenant utiliser l'ORM Doctrine (package qui nous permet de traduire nos classes PHP en requête SQL pour créer ou modifier nos tables).

Quand vous souhaitez faire une migration en base de données (appliquer les changements fait sur Syfmony dans votre base de données), vous devez le faire en 2 étapes :

**1. Générer le fichier de migration**

Pour se faire, vous devez simplement lancer la commande :

```sh
php bin/console make:migration
```

Avec cette commande, vous allez générer un fichier de migration qui sera disponible dans le dossier migrations, ce fichier de migration va comporter les requêtes SQL à faire en base de données pour mettre à jour les informations et synchroniser ce que vous avez sur votre application Symfony (vos entity) et les tables de votre base de données.

**2. Executer la migration**

Une fois que le fichier de migration et généré, vous n'avez plus qu'à dire à doctrine d'exécuter le fichier que vous venez de générer :

```sh
php bin/console doctrine:migrations:migrate
```

Avec cette commande, votre fichier de migration va être exécuté, et votre base de données sera à jour.

## Sécurisation de votre application

Avant toute chose, il faut penser à sécuriser le BO de votre application, seul les utilisateurs avec le role admin pourront accéder aux pages du BO.

Symfony à déjà préparé le terrain pour vous, il vous suffit de vous rendre dans le dossier config > packages et vous trouvez un fichier **Security.yaml**.

C'est dans ce fichier que vous allez configurer la sécurisation de votre application :

```yaml
security:
    # https://symfony.com/doc/current/security.html#registering-the-user-hashing-passwords
    password_hashers:
        Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface: "auto"
    # https://symfony.com/doc/current/security.html#loading-the-user-the-user-provider
    providers:
        # used to reload user from session & other features (e.g. switch_user)
        app_user_provider:
            entity:
                class: App\Entity\User
                property: username
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            lazy: true
            provider: app_user_provider
     
    # Easy way to control access for large sections of your site
    # Note: Only the *first* access control that matches will be used
    access_control:
        # - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }

when@test:
    security:
        password_hashers:
        # By default, password hashers are resource intensive and take time. This is
        # important to generate secure password hashes.
        # are not important, waste resources and increase test times. The following
        # reduces the work factor to the lowest possible values.
            Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface:
                algorithm: auto
                cost: 4 # Lowest possible value for bcrypt
                time_cost: 3 # Lowest possible value for argon
                memory_cost: 10 # Lowest possible value for argon
```

Si vous regardez bien le fichier, vous devriez voir une partie **`access_control`**, c'est ici que nous allons définir les règles ainsi que les accès par certains utilisateur.

Vous pouvez décommenter la ligne `# - { path: ^/admin, roles: ROLE_ADMIN }` ce qui veut dire que toutes url qui débute par /admin ne sont accessible qu'aux utilisateur admin.

### Le formulaire de connexion

Maintenant que notre admin est sécurisé, il va falloir créer une page pour se connecter à l'application, sinon personne ne pourra jamais accéder au BO.

Pour ça vous allez devoir créer un nouveau contrôleur que nous appellerons SecurityController, donc vous allez lancer la commande :

```sh
php bin/console make:controller Security/SecurityController
```

Cette commande va vous créer un nouveau dossier sécurity dans le dossier controller à l'intérieur duquel vous allez avoir un nouveau controller. Nous allons légèrement le modifier pour qu'il puisse générer une page avec le formulaire de connexion :

```php
<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('Security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}
```

Ici vous voyez que nous faisons 2 choses avant de rendre la vue, d'abord nous instancions la classe AuthenticationUtils qui va nous permettre de récupérer les erreurs s'il y en a pour une tentative de connexion ainsi que le dernier utilisateur de connecté sur la session de l'utilisateur.

Ensuite nous envoyons ces informations à la notre vue (dans le dossier templates/Security/login.html.twig).

### La vue

Maintenant que nous avons notre contrôleur, nous devons créer la vue dans le fichier login.html.twig dans le dossier templates/security, à l'intérieur, nous allons simplement mettre un formulaire de connexion simple :

```twig
{% extends "layout.html.twig" %}

{% block title %}
	Se connecter |
	{{ parent() }}
{% endblock %}

{% block body %}
	<div class="container-fluid mt-4">
		<form action="{{ path('login') }}" method="post" class="p-3 form card w-50 mx-auto">
			{% if error %}
  			<div class="alert alert-danger" role="alert">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
			{% endif %}
			<h1 class="title text-center">Se connecter</h1>
			<label for="username" class="form-label">Username:</label>
			<input type="text" id="username" name="_username" class="form-control" value="{{ last_username }}"/>

			<label for="password" class="form-label mt-2">Mot de passe:</label>
			<input type="password" id="password" name="_password" class="form-control"/>

			<div class="d-grid gap-2 d-md-block mt-4 text-center">
				<button type="submit" class="btn btn-inline btn-primary">Se connecter</button>
			</div>
		</form>
	</div>
{% endblock %}
```

### Intégration de bootstrap

Comme vous pouvez le voir, nous utilisons des classes bootstrap, mais nous ne l'avons pas encore installé sur notre projet, nous allons utiliser webpack Encore qui va nous permettre de générer tous nos assets scss, css et js.

Vous pouvez retrouver la documentation en [cliquant ici](https://symfony.com/doc/current/frontend/encore/bootstrap.html).

###	 Configuration des routes

Dernière chose à faire pour que notre formulaire de connexion soit opérationnel, de gérer les routes avec le fichier sécurity.yaml.

En effet nous allons ajouter un peu de configuration à ce fichier pour que notre application puisse savoir vers qu'elle route rediriger s'il y a besoin de se connecter.

```yaml
firewalls:
  dev:
    pattern: ^/(_(profiler|wdt)|css|images|js)/
    security: false
  main:
    lazy: true
    provider: app_user_provider
    form_login:
      login_path: login
      check_path: login
    logout:
      path: /logout
      target: /
```

En rajoutant dans le main firewall le form_login ainsi que le logout vous avez gérer les routes pour se connecter ainsi que pour se déconnecter.

## Les Fixtures

Pour le moment, nous avons gérer la sécurisation de notre application mais pour le moment, nous n'avons pas d'utilisateurs en base de données. Il faut donc en créer, mais plutôt que de devoir rentrer dans le vif du sujet tout de suite en générant des formulaires, créer des contrôleurs, des vues etc... Nous allons vouloir créer un utilisateur rapidement en PHP, et pour ça, nous allons utiliser des fixtures.

Tout d'abord, nous allons devoir installer le bundle avec la commande :

```sh
composer require --dev orm-fixtures
```

Vous devriez voir un nouveau dossier dans le dossier Src qui se nomme DataFixtures, et à l'intérieur un fichier AppFixtures.php.

C'est avec ce fichier que nous allons pouvoir créer un user rapidement, ouvrez le fichier et modifier le comme suit :

```php
<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setPrenom('Pierre')
            ->setNom('Bertrand')
            ->setAge(25)
            ->setUsername('Pierre-brtrd')
            ->setEmail('pierre@example.com')
            ->setPassword('test1234') // Nous devons hasher le password
            ->setRoles(["ROLE_ADMIN"])
            ->setVille('Chambéry');

        $manager->persist($user);
        $manager->flush();
    }
}

```

Ici nous avons créer un nouvel objet de type User et définit ces propriétés, mais attention pour le mot de passe, il va falloir le hasher afin que notre application soit bien sécurisé.

Nous allons tout d'abord importer la classe UserPasswordHasherInterface que va nous permettre de hasher notre password, pour se faire, nous allons devoir créer un constructeur :

```php
 private UserPasswordHasherInterface $hasher;

public function __construct(UserPasswordHasherInterface $hasher)
{
  $this->hasher = $hasher;
}
```

Maintenant, dans notre fonction de création de fixture user, nous allons pouvoir utiliser le password hash avec `$this->hash->hashPassword()` :

```php
 private UserPasswordHasherInterface $hasher;

public function __construct(UserPasswordHasherInterface $hasher)
{
  $this->hasher = $hasher;
}

public function load(ObjectManager $manager): void
{
  // $product = new Product();
  // $manager->persist($product);

  $user = new User();
  $user->setPrenom('John')
    ->setNom('Doe')
    ->setAge(25)
    ->setUsername('John-Do')
    ->setEmail('john@example.com')
    ->setRoles(["ROLE_ADMIN"])
    ->setPassword($this->hasher->hashPassword($user, 'test1234'))
    ->setVille('Chambéry');

  $manager->persist($user);
  $manager->flush();
}
```

Maintenant, il faut dire à doctrine de charger en base de données cet fixture :

```sh
php bin/console doctrine:fixtures:load --append 
```

Et voilà, vous avez maintenant un utilisateur en base de données.

## Création de la table article

Maintenant que nous avons sécurisé notre application, nous pouvons commencer à construire notre BO, commençons par la table article.

Vous devez créer une table article avec les propriétés suivantes :

- titre -> string
- content -> string
- createdAt -> datetime
- updatedAt -> datetime

Vous pouvez créer la classe avec la commande :

```sh
php bin/console make:entity Article
```

Qui va vous générer la classe automatiquement.

### Le timestample 

Pour les champs createdAt et updatedAt, nous voulons que ces champs soit mis à jour automatiquement, nous allons donc utiliser une extension de doctrine pour permette cela :

```sh
composer require stof/doctrine-extensions-bundle
```

Autorisé les recettes pour que la configuration se fasse.

Une fois finit, vous devriez voir dans votre dossier config/packages un nouveau fichier `stof_doctrine_extensions.yaml`, vous devez l'ouvrir et le modifier comme suit :

```yaml
stof_doctrine_extensions:
    default_locale: fr_FR
    orm:
        default:
            timestampable: true
            sluggable: true
```

Nous venons d'ajouter 2 extensions à notre ORM, timestampable pour mettre à jour automatiquement les champs createdAt et updatedAt ainsi que sluggable que va nous permettre de générer des slugs rapidement.

Maintenant retour dans notre entity User pour mettre en place le timestampable ainsi que le slug :

```php
<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'text')]
    private $content;

    #[ORM\Column(length: 260, unique: true)]
    #[Gedmo\Slug(fields: ['id', 'titre'])]
    private $slug;
  
  	#[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
  
  	public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
```

Et voilà, nous sommes prêt à faire notre migration `php bin/console make:migration` et l'exécuter `php bin/console doctrine:migrations:migrate`.

## Les formulaires

Maintenant que nous avons créé une table article, nous allons vouloir créer une page de création d'article avec un formulaire.

Pour commencer, nous allons créer un nouveau contrôleur pour l'admin (AdminController) vous pouvez utiliser la commande `php bin/console make:controller AdminController` :

```php
<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Admin Controller
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
}
```

Nous avons préfixé les routes avec /admin, ce qui veut dire que chaque méthode que nous allons créer, au niveau des routes, elles auront toujours au début `/admin`.

Nous allons simplement créer une méthode qui nous servira pour la page de création des articles :

```php
 #[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request)
{
  return $this->render('Backend/Article/create.html.twig');
}
```

Pour le moment nous ne faisons rien d'autre que d'appeler la vue, mais il va falloir que nous générions notre formulaire et que nous l'envoyions à notre vue (n'oubliez pas de créer le fichier twig pour la vue).

### Générer un formulaire

Vous pouvez générer automatiquement une classe formulaire qui va permettre d'automatiser la génération d'un formulaire en indiquant l'entity qui sera rattaché.

La commande à faire est :

```sh
php bin/console make:form
```

Le terminal va simplement vous demander quelle entity doit être relié au formulaire et vous générer un nouveau fichier dans le dossier src/form qui contient :

```php
<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('content');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

```

La méthode buildForm va générer les différent champs à intégrer dans le formulaire (ces champs représente toutes les propriétés que nous voulons remplir par le formulaire pour nos articles).

Par défaut, Symfony va essayer de données le type à l'input automatiquement en fonction du type de données qui est relié, mais vous pouvez modifier le type de l'input facilement en ajoutant une option après le nom du champ :

```php
<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('content', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

```

N'oubliez pas d'importer les classes (les uses). Ensuite vous pouvez également ajouter un 3ème paramètre à vos inputs, un tableau d'option (vous pouvez retrouver toutes les informations sur la [documentation](https://symfony.com/doc/current/forms.html)) :

```php
<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre:',
                'required' => true
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu:',
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

```

Et voilà, notre classe ArticleType va permettre de générer automatiquement un formulaire pour créer un article.

### Envoyer le formulaire à la vue

Maintenant que nous avons notre classe de génération de notre formulaire, il faut l'appeler et le générer dans le contrôleur pour l'envoyer à la vue, donc retour dans l'AdminController :

```php
#[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request)
{
  $article = new Article();

  $form = $this->createForm(ArticleType::class, $article);
 
  return $this->render('Backend/Article/create.html.twig', [
    'form' => $form->createView()
  ]);
}
```

Nous avons simplement créé un article vide pour le moment, ensuite nous avons créé un formulaire avec notre classe ArticleType, en lui passant l'article vide (qui sera rempli par l'utilisateur dans le formulaire).

Enfin nous envoyons le form à la vue, Attention pour que Twig puisse gérer l'affichage du formulaire en frontend il faut envoyer la variable $form avec la méthode `createView()` qui va permettre de générer le form afin que twig puisse lire le formulaire et l'afficher.

### La vue

Maintenant, il faut seulement afficher ce formulaire dans notre vue :

```twig 
{% extends "layout.html.twig" %}

{% block title %}
	Création d'un article |
	{{ parent() }}
{% endblock %}

{% block body %}
	<div class="container-fluid mt-4">
		<div class="card w-50 mx-auto p-3">
			<h1 class="text-center">Création d'un article</h1>
			{{ form_start(form) }}
			{{ form_end(form) }}
		</div>
	</div>
{% endblock %}

```

Ici nous utilisons la balise `form_start(form)` et `form_end(form)` pour que twig ouvre la balise form avec le formulaire que le contrôleur à envoyé.

Juste en faisant ça, vous devriez voir sur la page le formulaire, mais sans bouton de soumission.

Si nous ne stipulons pas à Twig à l'intérieur des balises `form_start(form)` et `form_end(form)` où et comment nous voulons afficher nos champs, il va les mettre automatiquement les uns à la suite des autres, mais nous nous voulons rajouter à la fin un bouton de soumission, mais il doit être à l'intérieur du form.

Nous allons donc devoir réécrire légèrement le code de notre formulaire :

```twig
{{ form_start(form) }}
			{{ form_row(form.titre) }}
			{{ form_row(form.content) }}
			<div class="text-center">
				<button type="submit" class="btn btn-primary btn-inline">Créer</button>
			</div>
{{ form_end(form) }}
```

Avec les balise `form_row()` vous pouvez afficher spécifiquement un champ, le form_row va vous afficher le lable ainsi que l'input, il faut stipuler le nom du formulaire ainsi que le champ concerné (à afficher).

Mais imaginons que vous ne vouliez pas du label, seulement de l'input en intégrant un placeholder ? Et bien c'est possible grâce à la balise `form_widget()` 

```twig
{{ form_start(form) }}
			{{ form_widget(form.titre, {'attr': {'class': 'mb-4', 'placeholder': "Titre de l'article"} } ) }}
			{{ form_widget(form.content, {'attr': {'class': 'mb-4', 'placeholder': "Contenu de l'article", 'rows': 10} } ) }}
			<div class="text-center">
				<button type="submit" class="btn btn-primary btn-inline">Créer</button>
			</div>
{{ form_end(form) }}
```

Ici nous avons utilisé `form_widget(form.titre)` en ajoutant un tableau d'option `attr` pour ajouter un attribut sur l'input, et ensuite ajouté une classe ains que des placeholder.

Vous savez maintenant comment manipuler vos formulaires dans vos vues twig.

### Validation d'un formulaire

Maintenant il nous reste la validation du formulaire pour que notre article soit créé, nous allons écrire la validation directement dans le contrôleur, donc AdminController :

```php
 #[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request)
{
  $article = new Article();

  $form = $this->createForm(ArticleType::class, $article);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    // Formulaire soumis est valide
  }

  return $this->render('Backend/Article/create.html.twig', [
    'form' => $form->createView()
  ]);
}
```

Nous avons simplement utilisé la classe Request qui permet de récupérer par exemple les variable superglobale `$_GET` ou `$_POST`, Symfony vous facilite la vie étant donnée que vous n'avez seulement qu'à récupérer la request, et ensuite de vérifier si le formulaire est soumis et s'il est valide.

Ensuite nous allons devoir importer l'`EntityManagerInterface` qui va nous permettre d'envoyer ce nouvel article en base de données. Pour importer la classe, vous avez 2 solutions :

1. Importer directement la classe en paramètre par défaut la méthode que nous sommes entrain de développer :

```php
#[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request, EntityManagerInterface $em)
{
  $article = new Article();

  $form = $this->createForm(ArticleType::class, $article);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $em->persist($article);
    $em->flush();
  }

  return $this->render('Backend/Article/create.html.twig', [
    'form' => $form->createView()
  ]);
}
```

Nous stockons l'instance directement dans la variable $em et nous l'utilisons ensuite dans la méthode avec `persist()` pour envoyer l'object en base de données et `flush()` qui permet de sauvegarder les modifications que nous avons fait en base de données. 

2.  Importer globalement la classe EntityManagerInterface pour pouvoir l'utiliser dans d'autre méthode de notre classe AdminController, pour ce faire nous allons l'instancier dans le constructeur de notre classe AdminController :

```php
/**
* Entity manager interface
*
* @var EntityManagerInterface
*/
private $em;

public function __construct(EntityManagerInterface $em)
{
  $this->em = $em;
}

#[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request)
{
  $article = new Article();

  $form = $this->createForm(ArticleType::class, $article);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $this->em->persist($article);
    $this->em->flush();
  }

  return $this->render('Backend/Article/create.html.twig', [
    'form' => $form->createView()
  ]);
}
```

Dernière chose à faire, ajouter un petit message et rediriger vers une autre page :

```php
#[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request)
{
  $article = new Article();

  $form = $this->createForm(ArticleType::class, $article);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $this->em->persist($article);
    $this->em->flush();
    $this->addFlash('success', 'Article créé avec succès');
    return $this->redirectToRoute('admin');
  }

  return $this->render('Backend/Article/create.html.twig', [
    'form' => $form->createView()
  ]);
}
```

## La route admin

Maintenant que nous avons une page qui crée des articles nous allons pouvoir faire une page qui liste les articles ainsi que les utilisateurs dans l'admin.

Donc dans l'AdminController nous allons rajouter une nouvelle méthode :

```php
#[Route('', name: 'admin')]
public function index(): Response
{
  return $this->render('Backend/index.html.twig');
}
```

N'oubliez pas de créer le fichier twig dans templates.

Maintenant nous voulons pouvoir récupérer tous les users ainsi que tous les articles de notre bases de données, pour ça nous allons devoir utiliser les Repository, avec Symfony, ces classes vous permettent de pouvoir rechercher rapidement dans une table de votre base de données. 

Nous allons devoir importer 2 classe globalement (dans notre constructeur) le UserRepository ainsi que le ArticleRepository :

```php
/**
* Article repository to find article object
* 
* @var ArticleRepository
*/
private $repoArticle;

/**
* User repository to find user object
* 
* @var UserRepository
*/
private $repoUser;

/**
* Entity manager interface
*
* @var EntityManagerInterface
*/
private $em;

public function __construct(ArticleRepository $repoArticle, UserRepository $repoUser, EntityManagerInterface $em)
{
  $this->repoArticle = $repoArticle;
  $this->repoUser = $repoUser;
  $this->em = $em;
}
```

Maintenant nous pouvons appeler la classe ArticleRepository et UserRepository n'importe où dans notre AdminController avec les alias `$this->repoArticle` et `$this->repoUser`.

Donc nous pouvons écrire dans notre méthode de liste admin : 

```php
 #[Route('', name: 'admin')]
public function index(): Response
{
  // Récupérer tout les users
  $users = $this->repoUser->findAll();

  // Récupérer tout les articles
  $articles = $this->repoArticle->findAll();

  return $this->render('Backend/index.html.twig', [
    'articles' => $articles,
    'users' => $users,
  ]);
}
```

Il ne vous reste plus qu'à afficher les informations sur votre vue.

## Modifier un article

Il nous reste tout de même à laisser la possibilité de modifier un article.

Toujours dans l'AdminController, nous allons créer une nouvelle méthode qui va être très proche de celle que nous avons créé pour la création d'un article à quelques détails prêt :

```php
 #[Route('/article/edit/{id}', name: 'admin.article.edit', methods: 'GET|POST')]
public function editArticle($id, Request $request)
{
  $article = $this->repoArticle->find($id);

  $form = $this->createForm(ArticleType::class, $article);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $this->em->persist($article);
    $this->em->flush();
    $this->addFlash('success', 'Article modifié avec succès');
    return $this->redirectToRoute('admin');
  }

  return $this->render('Backend/Article/edit.html.twig', [
    'form' => $form->createView()
  ]);
}
```

Dans un premier temps, vous voyez que dans le commentaire pour définir la route, nous avons passer un paramètre dynamique `/article/edit/{id}` les accolades dans une url symbolise un paramètre qui sera envoyé directement dans l'url, en l'occurrence, nous voulons récupérer l'id de l'article à modifier afin de le retrouver en base de données et de générer le formulaire avec les informations qui sont disponible en base de données.

Ensuite plutôt que de créer un nouvel article avant la génération du formulaire, nous avons simplement recherché l'article avec l'id, et nous avons envoyé cet article dans le formulaire.
