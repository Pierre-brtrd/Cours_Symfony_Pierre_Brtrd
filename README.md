# Cours Symfony :

<p>
  <img src="https://img.shields.io/badge/Code-Php-blueviolet?style=flat&logo=php&color=787CB5" />
  <img src="https://img.shields.io/badge/Code-Twig-brightgreen?style=flat&color=AFC97E" />
  <img src="https://img.shields.io/badge/Code-Javascipt-blueviolet?style=flat&logo=javascript&color=yellow" />
  <img src="https://img.shields.io/badge/Code-Scss-blueviolet?style=flat&logo=sass&color=CD6799" />
</p>
<p>
  <img alt="GitHub Workflow Status (event)" src="https://img.shields.io/github/workflow/status/Pierre-brtrd/Cours_Symfony_Pierre_Brtrd/Full%20CI%20process%20for%20Symfony%206?label=Build&logo=github">
  <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/Pierre-brtrd/Cours_Symfony_Pierre_Brtrd?label=Last%20Commit">
  <img alt="GitHub commit activity" src="https://img.shields.io/github/commit-activity/m/Pierre-brtrd/Cours_Symfony_Pierre_Brtrd?label=Commit%20Activity">
  <img alt="GitHub top language" src="https://img.shields.io/github/languages/top/Pierre-brtrd/Cours_Symfony_Pierre_Brtrd">
  <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/Pierre-brtrd/Cours_Symfony_Pierre_Brtrd?label=Languages&color=yellow">
  <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Fsymfony-cours-app.herokuapp.com%2F">
    <img alt="W3C Validation" src="https://img.shields.io/w3c-validation/html?label=validate&logo=w3c&targetUrl=http%3A%2F%2Fsymfony-cours-app.herokuapp.com%2F">
  </a>
  <img alt="GitHub release (latest SemVer)" src="https://img.shields.io/github/v/release/Pierre-brtrd/Cours_Symfony_Pierre_Brtrd?display_name=tag">
</p>

**Minimum requirements pour les stacks :**
<p>
  <img src="https://img.shields.io/badge/Php-8.1-brightgreen?style=flat&logo=php&color=787CB5"/>
  <img src="https://img.shields.io/badge/Node-18.0-brightgreen?style=flat&logo=nodedotjs&color=3C873A"/>
  <img src="https://img.shields.io/badge/Yarn-4.0-brightgreen?style=flat&logo=yarn&color=25799f"/>
  <img src="https://img.shields.io/badge/Mysql-8.0.25-brightgreen?style=flat&logo=mysql&color=00758F&logoColor=F29111"/>
</p>

Le but de ce cours est de d??couvrir le framework Symfony est de pouvoir d??velopper des applications web.

Nous verrons pendant la formation :

- L'initialisation d'un projet Symfony,
- Faire la configuration de la base de donn??e avec l'ORM Doctrine,
- La configuration de la partie backend de l'application avec la gestion des controllers ainsi que les diff??rentes routes de l'application,
- La partie d??veloppement du backend ainsi que la gestion de l'administration des donn??es.

## Pr??requis pour la formation :

Il est important d'avoir certaines base de connaissance avant de d??buter la formation Symfony :

- Connaissance en HTML/CSS/JS
- Connaissance en PHP
- La connaissance du SQL est un plus
- Savoir utiliser un terminal de commande

## Configurer votre environnement :

### VsCode :

Pour d??velopper, je vous conseille l'IDE VsCode qui permet d'avoir une bonne vision sur l'arboresence dossier dans un projet, et qui permet ??galement d'installer des plugin d'aide au d??veloppement qui nous seront utiles pour la formations. Pour t??l??charger le logiciel, <a href="https://code.visualstudio.com/download" target="_blank">cliquez ici</a>

### Github :

Nous allons travailler avec Github, ce qui va permettre de versionner notre code et pouvoir ainsi avoir une vision claire sur l'historique des modifications.

Vous devez dans un premier temps configurer votre environnement avec Git :

- **Pour les MACs** :

  - Ouvrez un terminal de commande et entrez la commande :

  ```shell
  xcode-select ???install
  ```

  Une fen??tre va s???ouvrir vous demandant si vous voulez installer des outils de ligne de commande, cliquez sur installer

  - Ensuite, vous devez configurer vos informations Git : _(Ne pas oublier les guillemets)_

    ```shell
    git config --global user.name "Votre Nom et Pr??nom"
    ```

    Ensuite : _(Ne pas mettre les guillemets)_

    ```shell
    git config --global user.email votre email
    ```

    Pour v??rifier les informations, entrez la commande :

    ```shell
    git config ???list
    ```

### Yarn

Yarn est un manager de paquets en ligne de commande qui va nous permettre d'installer et de g??rer des composants de notre application symfony.

Pour l'installer sur vos postes, vous devez :

- Pour les macs

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

- Pour les windows :

  - Vous devez avoir install?? au pr??alable **node** pour avoir **npm** [lien de la documentation](https://nodejs.org/en/download/).

  - Ensuite rentrez la commande dans un terminal :

    ```bash
    npm install -g yarn
    ```

### Installer votre stack

Une stack est un environnement de d??veloppement pour votre application, votre stack se compose de tout les composants indispensables pour faire tourner votre application.

Avec Symonfy 6, vous devez obligatoirement avec sur votre environnement PHP 8 au minimum.

#### PHP

Pour installer Php 8 avec un windows :

- Rendez-vous sur le site de Php pour [t??l??charger le dossier](https://windows.php.net/download#php-8.1)

  - Vous devez t??l??charger la derni??re version de Php en **Thread Safe** :

    ![Capture d???e??cran 2022-08-02 a?? 10.09.13](/Users/pierre/Desktop/Capture d???e??cran 2022-08-02 a?? 10.09.13.png)

    

  - Un fois le dossier zip t??l??charg?? vous allez devoir l'extraire ?? la racine de votre environnement **(dossier `C:\`)** dans un dossier que vous allez nommer **`php`** :

  

  - Ensuite vous allez devoir configurer le **php.ini**, rendez-vous dans le nouveau dossier php que vous avez cr???? et dupliquez le fichier **`C:\php\php.ini-development`** que vous allez renommer en **`C:\php\php.ini`**. 

    

  - Maintenant vous allez devoir ouvrir ce nouveau fichier et ajouter les extensions indispensable pour utiliser Symfony, faite un ctrl + f pour chercher les lignes **`Dynamic Extensions`**, vous allez devoir d??commenter certaines lignes pour ajouter les extensions utiles pour votre serveur PHP :

    ```ini
    extension=curl
    extension=fileinfo
    extension=gd
    extension=intl
    extension=mbstring
    extension=openssl
    extension=pdo_mysql
    ```

    Cherchez ces lignes et enlevez le `;` en d??but de ligne pour activer les extensions, puis enregistrez vos modifications.

    

  - Ajouter php dans vos variables d'environnement syst??me, chercher dans la barre de recherche windows **`Modifier les variables d'environnement syst??mes`**, ouvrez la page, cliquez sur le bouton **`Variables d'environnement`**, ensuite trouvez la section **`Variables syst??me`**, dans la liste cliquez sur la ligne qui commence par **`Path`** et ensuite sur le bouton **`Modifier`**. Maintenant cliquez sur le bouton **`nouveau`** et ajouter la ligne **`C:\php`**.

  - Maintenant vous pouvez ouvrir un CMD et lancer la commande `php -v` pour v??rifier votre version de php, si vous avez bien ce r??sultat : 

    ```bash
    PHP 8.1.8 (cli) (built: Jul  7 2022 03:11:30) (NTS)
    ```

    C'est que Php est bien install?? sur votre syst??me. Sinon essayez de fermer votre CMD et de le rouvrir en lan??ant la m??me commande.

#### Composer

Composer est un gestionnaire de d??pendance pour PHP qui est indispensable quand vous utilisez un projet symfony, pour l'installer rendez-vous sur la [documentation composer](https://getcomposer.org/download/) et install?? l'installer de composer pour windows, vous n'aurez plus qu'?? le lancer et suivre les indications d'installations.

#### Le Symfony CLI

Pour faciliter l'installation et le d??marrage d'un serveur symfony nous allons utiliser le CLI Symfony, pour l'installer suivez ces ??tapes :

- Ouvrez un terminal PowerShell

- Entrez la commande 

  ```powershell
  Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
  ```

- Puis :

  ```powershell
  irm get.scoop.sh | iex
  ```

- Et enfin :

  ```powershell
  scoop install symfony-cli
  ```

### Installer un projet Symfony

Dans un premier temps, vous allez avoir besoin du client Symfony pour pouvoir utiliser des lignes de commandes Symfony sur votre environnement, vous pouvez retrouver la documentation d'installation sur ce [lien](https://symfony.com/download)

Ensuite, vous devez v??rifier que votre environnement peut faire tourner une application symfony, pour ??a, vous avez une nouvelle commande ?? entrer dans un terminal (gr??ce au client Symfony) :

```bash
symfony check:requirements
```

Une fois que vous savez que votre environnement peut faire tourner une application Symfony, vous devez rentrer la commande qui va permettre d'installer un projet vierge Symfony dans un terminal :

```bash
symfony new my_project_directory --version="6.*" --webapp
```

Cette commande va vous installer un projet Symfony vierge avec l'installation des d??pendances.

**Versions multiple de php sur votre environnement**, Si vous utilisez WAMP ou que vous avez plusieurs version de Php sur votre syst??me, il se peut que l'installation de Symfony soit en erreur si Symfony n'utilise pas la version de Php 8.1, pour corriger se probl??me, vous devez simplement entrez une commande ?? l'emplacement o?? vous voulez installer votre nouveau projet :

```bash
echo 8.1 > .php-version
```

Cette commande devrait vous cr??er un fichier .php-version avec seulement ??crit ?? l'int??rieur 8.1, ce fichier va stipuler ?? Symfony quelle version de php il doit utiliser pour faire l'installation, une fois le fichier cr????, vous pouvez relancer la commande ci-dessus pour installer un nouveau projet.

Derni??re chose ?? faire, installer une d??pendance ?? notre projet PHPStan, qui va permettre d'analyser votre code PHP pendant le d??veloppement.

```bash
composer require --dev phpstan/phpstan
```

Pour lancer les tests vous aurez simplement ?? lancer la commande :

```bash
vendor/bin/phpstan analyse -l 0 src
```

### Symfony :

Pour installer les d??pendances de Symfony et lancemer l'environnement de d??veloppement, vous devez :

- Dans le terminal de VsCode (terminal Docker), entrez la commande
  ```shell
  composer install
  ```
- Ensuite, vous avez simplement ?? vous rendre sur votre navigateur sur l'url `localhost`, vous verrez la page d'accueil de l'application Symfony.

## Configuration de la connexion en base de donn??e :

Pour que le framework Symfony puisse communiquer avec votre base de donn??e, nous allons devoir modifier l'url vers la database pour que Symfony se connecte et interagisse avec elle via Doctrine ORM.

Aller dans le fichier `.env` et cherchez la ligne commen??ant par `DATABASE_URL=...`.

Nous allons de voir modifier l'url pour ajouter celle de notre base de donn??e que nous avons gr??ce ?? l'environnement docker.

La database URL se d??compose comme suit :

- `myql://` -> qui d??finit le type de base de donn??es, ici nous utilisons une base de donn??e mysql.
- `db_user` -> qui d??finit le user de la base de donn??es, ici nous avons param??tr?? le user `root`
- `db_password` -> qui d??finit le mot de passe pour acc??der ?? la base de donn??es, il faut laisser vide si pas de mot de passe, ici nous n'avons pas de mot de passe de param??tr??, donc on passe directement ?? la suite de l'url.
- `@127.0.0.1` -> qui d??finit le serveur host de la base donn??e, ici nous avons le host `@db_symfony` car l'host est configur?? par notre image Docker db_symfony.
- `:3306` -> qui d??finit le port ?? utiliser pour la connexion.
- `/db_name`-> qui d??finit le nom de la base de donn??e, ici nous avons une database qui se nomme `db_cours`
- `?serverVersion=5.7` -> qui d??finit la version du serveur que nous utilisons, ici nous utilisons un serveur Mysql `version 5.7`.

Ce qui fait que notre database URL est :

```shell
mysql://root:@db_symfony:3306/db_cours?serverVersion=5.7
```

Voici ?? quoi ressemble une URL de base de donn??e.

## Lancement du server

Maintenant que nous avons install?? notre projet Syfmony et configur?? notre base de donn??es, nous pouvons lancer le server local Symfony.

Symfony va lancer un server gr??ce ?? php install?? en local sur votre syst??me.

Pour lancer le serveur, rentrer la commande dans un terminal :

```bash
symfony server:start
```

Une fois la commande lanc??e, vous devriez voir une url sur votre terminal, c'est l'url sur laquelle vous allez pouvoir voir le rendu de votre application Symfony.

## Framework MVC

Symfony utilise le design pattern MVC, c'est ?? dire un patron de conception qui d??signe une certaine architecture dans une application web.

Voici un petit sch??ma pour mieux comprendre :

![sche??ma-MVC](/Users/pierre/Formations/Visuel Cours/sche??ma-MVC.png)

Concr??tement, comment ??a marche ?

Le client (le navigateur) va envoyer une URL ?? notre __Routeur__, le routeur ?? pour but de trouver le bon contr??leur (il cherche une m??thode dans un contr??leur en particulier suivant l'url envoy??e).

Ensuite le __contr??leur__ va traiter les informations : aller chercher dans les mod??les dans informations en base de donn??es (les mod??les vont ex??cuter les requ??tes et renvoyer les donn??es).

Ensuite le contr??leur va envoyer les informations ?? une __vue__ qui doit g??n??rer le HTML, et rendre la page au client (navigateur).

## Les dossiers

Une fois que vous avez install?? un nouveau projet symfony, vous pourrez voir qu'il y a plusieurs dossiers qui viennent avec lac structure de base, passons en revu ces dossiers et leurs int??r??t.

### Assets

Comme son nom l???indique, ce dossier contient tous les assets n??cessaires pour le front de notre application Symfony.

Les assets sont principalement des fichiers **.css** et **.js** qui seront par la suite compil??s ?? l???aide du package **Webpack Encore**.

### Bin

Ce dossier contient les fichiers de commandes permettant, par exemple, de vider le cache Symfony, mettre ?? jour la base de donn??es ou encore lancer nos tests unitaires.

On utilise g??n??ralement la commande `php bin/console` qui affiche toutes les commande Symfony disponibles.

### Config

Toute la configuration des packages, services et routes se fera dans ce dossier.

Cela permettra, entre autre, de configurer notre connexion ?? la base de donn??es, mettre en place tout un syst??me de s??curit??, ou encore personnaliser les services que nous d??velopperons.

Les fichiers de configuration sont par d??faut en **YAML**, m??me s???il est tout ?? fait possible d???utiliser **PHP** ou **XML**.

### Public

C???est le point d???entr??e de l???application : chaque requ??te / demande passe forc??ment par ce dossier et le fichier `index.php`.

??tant accessible par tous, il est g??n??ralement utilis?? pour mettre ?? disposition des fichiers de ressources, principalement des images.

### Src

C???est le c??ur du projet ! L???endroit o?? vous passerez le plus de temps ?? coder. Il regroupe tout le code PHP de votre application, c???est ici que vous mettrez en place toute la logique de votre application.

Les dossiers qui seront obligatoires ?? utiliser pour le fonctionnement de l???application sont :

- **[Controller]** : D??finition des points d???entr??e de votre application. Il se charge de rediriger vers les Manager / Service / Repository. Aucun traitement de donn??es, acc??s ?? la BDD (base de donn??es) ne doit se faire depuis un Controller (tr??s important). Possibilit?? de choisir les m??thodes d???entr??e (GET, POST, PUT, DELETE, ... ) ainsi que le type de r??ponse retourn??e (JSON, XML, ... ).
- **[Entity]** : D??finition de la structure de votre BDD (base de donn??es) au travers de classes. Chaque Entity repr??sente g??n??ralement une table en BDD. La commande `php bin/console doctrine:migrations` nous permettra de mettre ?? jour notre BDD ?? chaque modification de l???Entity.
- **[Repository]** : Un Repository est toujours rattach?? ?? une Entity, il nous permet de cr??er nos fonctions qui iront requ??ter la table de notre Entity (ainsi que les tables li??es). Symfony utilise l???ORM **Doctrine** qui permet de cr??er nos requ??tes SQL ?? travers les **queryBuilder** (tr??s utile si l???on d??teste faire du SQL).

### Templates

Symfony utilise depuis ses d??buts le moteur de templates **Twig**.

Les fichiers de template Twig ont comme format `monfichier.html.twig` et viennent rajouter quelques fonctionnalit??s au HTML classique :

- **{{ ... }}** : appel ?? une variable ou une fonction PHP, ou un template Twig parent.
- **{% ... %}** : commande, comme une affectation, une condition, une boucle ou un bloc HTML.
- **{# ... #}** : commentaires.

Pour avoir plus d???infos et en apprendre plus sur Twig, vous trouverez ici une [documentation](https://twig.symfony.com/doc/2.x/) assez compl??te.

### Tests

Les tests unitaires **PHPUnit** seront d??finis ici pour tester notre application.

La commande pour lancer nos tests :

```shell
php bin/phpunit
```

Il faut n??anmoins s???assurer que le **package phpunit** soit install?? en utilisant la commande suivante :

```shell
composer require --dev symfony/phpunit-bridge
```

### Translation

L???internationalisation des applications est tr??s importante aujourd???hui. Il est donc n??cessaire de mettre en place un syst??me de traduction d??s le d??but du projet. Cela reste n??anmoins facultatif si vous ??tes certain de ne jamais avoir ?? traduire votre application.

Pour cela, on installe le **package translation** et on suit la [documentation](https://symfony.com/doc/current/translation.html) Symfony :

```shell
 composer require symfony/translation
```

### Var

Ici seront stock??s le **cache** et les fichiers de **log**.

Il est possible dans les fichiers de config de param??trer la mise en cache et ce que l???on ??crit dans les logs.

### Le fichier composer.json

Tous les **packages** sont enregistr??s dans ce fichier.

Ils sont install??s automatiquement dans le dossier `vendors` lors de l???initialisation du projet mais on peut utiliser la commande `composer install` pour les installer manuellement si besoin.

Pour mettre ?? jour les packages, on utilise la commande `composer update` et pour ajouter un package on utilise `composer require monpackage`

## Les controllers :

Symfony utilise les controllers pour afficher les pages et int??grer des requ??tes en base de donn??e afin de pouvoir r??cup??rer les informations, et les afficher ensuite sur la page.

Pour cr??er un controller, vous pouvez cr??er un fichier `FrontController.php` par exemple dans le dossier `src/controller`.

Notez que tous les controllers de Symfony sont ??crit en PHP et qu'ils ont tous la m??me structure :

```PHP
<?php // <- Ouverture de la balise PHP

namespace App\Controller; // <- D??fintion du namespace (Dans quel dossier se trouve le fichier)

// La partie `use` permet d'importer des modules(classe) de symfony et d'indiquer au fichier o?? chercher un module quand on l'appelle dans le code. (De chercher dans le bon namepsace la bonne classe)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// d??finition de la class du fichier (la class est utiliser pour importer le controller dans un autre fichier si besoin).La fonction extends d??finit que le Controller ??tends de l'AbstractController qui est un composant de symfony et qui va aider le d??veloppement du Controller. Attention, le nom de la class doit ??tre identique au nom du fichier (sans l'extension .php)
class FrontController extends AbstractController
{
  /* Le traitement de votre controller... */
}
```

Maintenant, nous allons ??crire dans le FrontController une fonction qui va afficher 'Hello World!' sur la page d'accueil :

```PHP
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; // <- va permettre de pouvoir r??cup??rer la reponse de la requete
use Symfony\Component\Routing\Annotation\Route; // <- va permettre de d??finir les routes pour les functions

class FrontController extends AbstractController
{
  #[Route('/', name: 'home')]
  public function index(): Response
    {
        return new Response("Hello World !"); // On demande au controller d'envoyer une r??ponse avec le contenu Hello World
    }
}
```

Maintenant, plut??t que de simplement envoyer une r??ponse avec hello world, nous allons vouloir rendre une vue, c'est ?? dire rendre un fichier html, pour ??a nous allons utiliser la m??thode render que nous pouvons utiliser gr??ce ?? la classe parente AbstractController.

Donc pour rendre une vous vous avez simplement ?? retourner la fonction render en stipulant le chemin vers votre vue en partant du dossier template :

```php
public function index(): Response
{
  return $this->render('Home/index.html.twig');
}
```

Gr??ce ?? cette m??thode, nous pouvons rendre une vue twig depuis notre contr??leur, maintenant il nous reste ?? voir comment nous pouvons envoyer des donn??es ?? notre vue :

```php
public function index(): Response
{
  $data = ['Pierre', 'Paul', 'Jacques'];
  return $this->render('Home/index.html.twig', [
    'data' => $data
  ]);
}
```

Ici, avant d'envoyer ma vue, je d??finit une variable PHP $data dans laquelle je stocke un tableau, pour envoyer cette information ?? ma vue, je vais la passer dans la fonction render, juste apr??s avoir d??finit le chemin vers le fichier,  j'ouvre un tableau associatif (cl??/valeur) la cl?? que je mets dans le tableau va ??tre le nom de la variable qui va ??tre g??n??r??e dans ma vue twig, et la valeur sera la valeur que je pourrai afficher dans ma vue twig.

Vous pouvez envoyer plusieurs donn??es dans une m??me vue.

### G??n??rer un contr??leur

Nous venons de voir comment nous pouvons cr??er un contr??leur manuellement, mais Symfony nous permet de pouvoir cr??er un contr??leur avec une commande en terminal :

```shell
php bin/console make:controller MonController
```

Gr??ce ?? cette commande, Symfony va vous g??n??rer un nouveau contr??leur d??j?? pr??t avec sa vue dans le dossier twig.

## Twig :

Twig est le moteur de template utiliser par Symfony, il va permettre de cr??er des gabarits de pages (templates) et de pouvoir y int??grer des variables que nous avec notre controller simplement et de mani??re beaucoup plus lisible qu'en PHP.

Les fichiers Twig sont utilis??s par Symfony pour faire le rendu des pages de l'application, grossi??rement, on peut dire que Twig ressemble au langage HTML, mais avec plus de fonctionnalit??s pour le rendu de variables PHP.

Tous les fichiers Twig doivent se trouver dans le dossier templates de votre projet (c'est dans ce dossier que Symfony va chercher les fichiers Twig), ils doivente ??galement avoir l'extentsion `fichier.html.twig`.

TWIG reprend la strucure et les balises du HTML mais utilise des balises sp??cifiques pour afficher des variables, ou mettre en place des structures logiques ?? l'int??rieur du code. Ces balises sont simple afin de ne pas avoir un code trop lourd et illisble.

Voici les diff??rentes balises Twig :

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

Les balises avec `{% %}` 1 acolades et pourcent permettent d'afficher des structures logiques, ?? noter que la pluparts du temps, cest balise doivent ??tres ferm??es avec `{% endif %}` (ou endblock, ou endfor... Tout d??pend la structure logique que vous avez ouverte).

Ces fonctionnalit??es vont nous permettre d'avoir un affichage dynamique et de couvrir un maximum les besoins de n'importe quelles application web.

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

Nous pouvons voir que le TWIG supporte le HTML, il permet d'afficher des variables de mani??re dynamique et ??galement int??grer des strucures logiques : boucles For, While, condition If etc...

### Le fichier base Twig :

Les diff??rents fichiers TWIG de votre projet vont tous ??tendre d'un fichier de base, souvent nomm?? `base.html.twig`.

Ce fichier est la base de toutes vos pages, la structure globale de vos pages, c'est dans ce fichier que vous allez cr??er votre l'architecture de votre code (la partie head avec les balises meta, et la partie body avec votre contenu)

Voici un exemple d'un fichier base.html.twig :

```TWIG
!DOCTYPE html>
<html>
	<head>
    <!-- Les m??tas qui doivent ??tre sur toutes les pages et qui seront toujours appel??es -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>

		{% block title %}{% endblock %}  <!-- La balise qui indique o?? le contenu du block Title des autres fichiers va ??tre int??gr?? -->

		</title>

    {% block stylesheets %}{% endblock %} <!-- La balise qui indique o?? le contenu du block CSS des autres fichiers va ??tre int??gr?? -->

	</head>
  <body>
    <nav>
      <!-- La navbar de votre site qui sera sur toutes les pages -->
    </nav>

    {% block body %}{% endblock %} <!-- La balise qui indique o?? le contenu body des autres fichiers va ??tre int??gr?? -->

  {% block javascripts %}{% endblock %} <!-- La balise qui indique o?? les balises javascript des autres fichiers va ??tre int??gr?? -->

  </body>
</html>
```

Maintenant voyons comment les autres fichiers vont appeler ce fichier de base et int??grer du contenu dans les balises que nous avons pr??par??es dans le fichier base.html.twig :

```TWIG
{% extends 'base.html.twig' %} <!-- Le fichier commence par la balise extends qui va permmetre de d??finir le fichier de base ?? utiliser pour ce fichier -->

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

Comme vous pouvez le voir, nous avons utilis?? les balises que nous avons plac?? dans le fichier base.html.twig, mais cette fois, nous avons int??gr?? le contenu sp??cifique pour ce fichier(page). cette page va donc reprendre tout le fichier base.html.twig en int??grant le contenu des balises du fichiers. Cette m??thode permet de pouvoir gagner du temps en ne devant pas red??velopper la structure ?? chaque fichier et de pouvoir faire de la r??utilisation de composent.

### Cr??ation de la table User

Pour presque toutes les applications web, nous avons besoin de cr??er une table User afin de pouvoir g??rer nos utilisateurs ainsi que les admins qui seront amener ?? utiliser le back office de notre application.

Pour ??a, Symfony dispose d'une commande tr??s simple qui permet de cr??er une classe User avec les propri??t??s ad??quates pour g??rer nos utilisateurs :

```shell
php bin/console make:user
```

Cette commande va vous poser plusieurs questions pour la gestion de vos utilisateur, en r??pondant aux questions dans le terminal, Symfony va vous g??n??rer le fichier classe User ainsi que faire la configuration du bundle s??curit?? de Symfony.

### Cr??er ou modifier une Entity

Une Entity dans Symfony c'est simplement une classe de modele, c'est ?? dire que chaque Entity est une classe PHP qui repr??sente une table dans votre base de donn??es.

Ici encore, Symfony dispose d'une commande en terminal pour cr??er ainsi que modifier une entity existante :

```shell
php bin/console make:entity MaClasse
```

Le nom que vous allez donner apr??s make:entity sera le nom de votre future entity, ou si vous souhaitez modifier une entity d??j?? existante, vous n'avez qu'?? mettre le nom d'une classe existante, Symfony va automatiquement v??rifier si la classe existe ou non et va soit cr??er le fichier, soit modifier un fichier existant.

Toutes les informations vous sont donn??es avec la commande make:entity (nom du champ type de donn??es etc...)

### Modifier la table User

Par d??faut l'Entity user g??n??r??e par la commande `php bin/console make:user`, est un peu vide (tr??s peu d'information sur l'utilisateur), si nous voulons rajouter le nom, le pr??nom, une adresse email, une adresse etc... Il va falloir modifier notre entity User.

Donc vous allez devoir rentrer la commande :

```shell
php bin/console make:entity User
```

Et automatiquement, Symfony va savoir que vous voulez modifier la classe User.

Une fois que vous avez ajout?? toutes les propri??t??s que vous le vouliez, il faut maintenant utiliser l'ORM Doctrine (package qui nous permet de traduire nos classes PHP en requ??te SQL pour cr??er ou modifier nos tables).

Quand vous souhaitez faire une migration en base de donn??es (appliquer les changements fait sur Syfmony dans votre base de donn??es), vous devez le faire en 2 ??tapes :

**1. G??n??rer le fichier de migration**

Pour se faire, vous devez simplement lancer la commande :

```sh
php bin/console make:migration
```

Avec cette commande, vous allez g??n??rer un fichier de migration qui sera disponible dans le dossier migrations, ce fichier de migration va comporter les requ??tes SQL ?? faire en base de donn??es pour mettre ?? jour les informations et synchroniser ce que vous avez sur votre application Symfony (vos entity) et les tables de votre base de donn??es.

**2. Executer la migration**

Une fois que le fichier de migration et g??n??r??, vous n'avez plus qu'?? dire ?? doctrine d'ex??cuter le fichier que vous venez de g??n??rer :

```sh
php bin/console doctrine:migrations:migrate
```

Avec cette commande, votre fichier de migration va ??tre ex??cut??, et votre base de donn??es sera ?? jour.

## S??curisation de votre application

Avant toute chose, il faut penser ?? s??curiser le BO de votre application, seul les utilisateurs avec le role admin pourront acc??der aux pages du BO.

Symfony ?? d??j?? pr??par?? le terrain pour vous, il vous suffit de vous rendre dans le dossier config > packages et vous trouvez un fichier **Security.yaml**.

C'est dans ce fichier que vous allez configurer la s??curisation de votre application :

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

Si vous regardez bien le fichier, vous devriez voir une partie **`access_control`**, c'est ici que nous allons d??finir les r??gles ainsi que les acc??s par certains utilisateur.

Vous pouvez d??commenter la ligne `# - { path: ^/admin, roles: ROLE_ADMIN }` ce qui veut dire que toutes url qui d??bute par /admin ne sont accessible qu'aux utilisateur admin.

### Le formulaire de connexion

Maintenant que notre admin est s??curis??, il va falloir cr??er une page pour se connecter ?? l'application, sinon personne ne pourra jamais acc??der au BO.

Pour ??a vous allez devoir cr??er un nouveau contr??leur que nous appellerons SecurityController, donc vous allez lancer la commande :

```sh
php bin/console make:controller Security/SecurityController
```

Cette commande va vous cr??er un nouveau dossier s??curity dans le dossier controller ?? l'int??rieur duquel vous allez avoir un nouveau controller. Nous allons l??g??rement le modifier pour qu'il puisse g??n??rer une page avec le formulaire de connexion :

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

Ici vous voyez que nous faisons 2 choses avant de rendre la vue, d'abord nous instancions la classe AuthenticationUtils qui va nous permettre de r??cup??rer les erreurs s'il y en a pour une tentative de connexion ainsi que le dernier utilisateur de connect?? sur la session de l'utilisateur.

Ensuite nous envoyons ces informations ?? la notre vue (dans le dossier templates/Security/login.html.twig).

### La vue

Maintenant que nous avons notre contr??leur, nous devons cr??er la vue dans le fichier login.html.twig dans le dossier templates/security, ?? l'int??rieur, nous allons simplement mettre un formulaire de connexion simple :

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

### Int??gration de bootstrap

Comme vous pouvez le voir, nous utilisons des classes bootstrap, mais nous ne l'avons pas encore install?? sur notre projet, nous allons utiliser webpack Encore qui va nous permettre de g??n??rer tous nos assets scss, css et js.

Vous pouvez retrouver la documentation en [cliquant ici](https://symfony.com/doc/current/frontend/encore/bootstrap.html).

###	 Configuration des routes

Derni??re chose ?? faire pour que notre formulaire de connexion soit op??rationnel, de g??rer les routes avec le fichier s??curity.yaml.

En effet nous allons ajouter un peu de configuration ?? ce fichier pour que notre application puisse savoir vers qu'elle route rediriger s'il y a besoin de se connecter.

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

En rajoutant dans le main firewall le form_login ainsi que le logout vous avez g??rer les routes pour se connecter ainsi que pour se d??connecter.

## Les Fixtures

Pour le moment, nous avons g??rer la s??curisation de notre application mais pour le moment, nous n'avons pas d'utilisateurs en base de donn??es. Il faut donc en cr??er, mais plut??t que de devoir rentrer dans le vif du sujet tout de suite en g??n??rant des formulaires, cr??er des contr??leurs, des vues etc... Nous allons vouloir cr??er un utilisateur rapidement en PHP, et pour ??a, nous allons utiliser des fixtures.

Tout d'abord, nous allons devoir installer le bundle avec la commande :

```sh
composer require --dev orm-fixtures
```

Vous devriez voir un nouveau dossier dans le dossier Src qui se nomme DataFixtures, et ?? l'int??rieur un fichier AppFixtures.php.

C'est avec ce fichier que nous allons pouvoir cr??er un user rapidement, ouvrez le fichier et modifier le comme suit :

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
            ->setVille('Chamb??ry');

        $manager->persist($user);
        $manager->flush();
    }
}

```

Ici nous avons cr??er un nouvel objet de type User et d??finit ces propri??t??s, mais attention pour le mot de passe, il va falloir le hasher afin que notre application soit bien s??curis??.

Nous allons tout d'abord importer la classe UserPasswordHasherInterface que va nous permettre de hasher notre password, pour se faire, nous allons devoir cr??er un constructeur :

```php
public function __construct(
  private UserPasswordHasherInterface $hasher
) {
}
```

Maintenant, dans notre fonction de cr??ation de fixture user, nous allons pouvoir utiliser le password hash avec `$this->hash->hashPassword()` :

```php
public function __construct(
  private UserPasswordHasherInterface $hasher
) {
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
    ->setVille('Chamb??ry');

  $manager->persist($user);
  $manager->flush();
}
```

Maintenant, il faut dire ?? doctrine de charger en base de donn??es cet fixture :

```sh
php bin/console doctrine:fixtures:load --append 
```

Et voil??, vous avez maintenant un utilisateur en base de donn??es.

## Cr??ation de la table article

Maintenant que nous avons s??curis?? notre application, nous pouvons commencer ?? construire notre BO, commen??ons par la table article.

Vous devez cr??er une table article avec les propri??t??s suivantes :

- titre -> string
- content -> string
- createdAt -> datetime
- updatedAt -> datetime

Vous pouvez cr??er la classe avec la commande :

```sh
php bin/console make:entity Article
```

Qui va vous g??n??rer la classe automatiquement.

### Le timestample 

Pour les champs createdAt et updatedAt, nous voulons que ces champs soit mis ?? jour automatiquement, nous allons donc utiliser une extension de doctrine pour permette cela :

```sh
composer require stof/doctrine-extensions-bundle
```

Autoris?? les recettes pour que la configuration se fasse.

Une fois finit, vous devriez voir dans votre dossier config/packages un nouveau fichier `stof_doctrine_extensions.yaml`, vous devez l'ouvrir et le modifier comme suit :

```yaml
stof_doctrine_extensions:
    default_locale: fr_FR
    orm:
        default:
            timestampable: true
            sluggable: true
```

Nous venons d'ajouter 2 extensions ?? notre ORM, timestampable pour mettre ?? jour automatiquement les champs createdAt et updatedAt ainsi que sluggable que va nous permettre de g??n??rer des slugs rapidement.

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

Et voil??, nous sommes pr??t ?? faire notre migration `php bin/console make:migration` et l'ex??cuter `php bin/console doctrine:migrations:migrate`.

## Les formulaires

Maintenant que nous avons cr???? une table article, nous allons vouloir cr??er une page de cr??ation d'article avec un formulaire.

Pour commencer, nous allons cr??er un nouveau contr??leur pour l'admin (AdminController) vous pouvez utiliser la commande `php bin/console make:controller AdminController` :

```php
<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
}
```

Nous avons pr??fix?? les routes avec /admin, ce qui veut dire que chaque m??thode que nous allons cr??er, au niveau des routes, elles auront toujours au d??but `/admin`.

Nous allons simplement cr??er une m??thode qui nous servira pour la page de cr??ation des articles :

```php
 #[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request)
{
  return $this->render('Backend/Article/create.html.twig');
}
```

Pour le moment nous ne faisons rien d'autre que d'appeler la vue, mais il va falloir que nous g??n??rions notre formulaire et que nous l'envoyions ?? notre vue (n'oubliez pas de cr??er le fichier twig pour la vue).

### G??n??rer un formulaire

Vous pouvez g??n??rer automatiquement une classe formulaire qui va permettre d'automatiser la g??n??ration d'un formulaire en indiquant l'entity qui sera rattach??.

La commande ?? faire est :

```sh
php bin/console make:form
```

Le terminal va simplement vous demander quelle entity doit ??tre reli?? au formulaire et vous g??n??rer un nouveau fichier dans le dossier src/form qui contient :

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

La m??thode buildForm va g??n??rer les diff??rent champs ?? int??grer dans le formulaire (ces champs repr??sente toutes les propri??t??s que nous voulons remplir par le formulaire pour nos articles).

Par d??faut, Symfony va essayer de donn??es le type ?? l'input automatiquement en fonction du type de donn??es qui est reli??, mais vous pouvez modifier le type de l'input facilement en ajoutant une option apr??s le nom du champ :

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

N'oubliez pas d'importer les classes (les uses). Ensuite vous pouvez ??galement ajouter un 3??me param??tre ?? vos inputs, un tableau d'option (vous pouvez retrouver toutes les informations sur la [documentation](https://symfony.com/doc/current/forms.html)) :

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

Et voil??, notre classe ArticleType va permettre de g??n??rer automatiquement un formulaire pour cr??er un article.

### Envoyer le formulaire ?? la vue

Maintenant que nous avons notre classe de g??n??ration de notre formulaire, il faut l'appeler et le g??n??rer dans le contr??leur pour l'envoyer ?? la vue, donc retour dans l'AdminController :

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

Nous avons simplement cr???? un article vide pour le moment, ensuite nous avons cr???? un formulaire avec notre classe ArticleType, en lui passant l'article vide (qui sera rempli par l'utilisateur dans le formulaire).

Enfin nous envoyons le form ?? la vue, Attention pour que Twig puisse g??rer l'affichage du formulaire en frontend il faut envoyer la variable $form avec la m??thode `createView()` qui va permettre de g??n??rer le form afin que twig puisse lire le formulaire et l'afficher.

### La vue

Maintenant, il faut seulement afficher ce formulaire dans notre vue :

```twig 
{% extends "layout.html.twig" %}

{% block title %}
	Cr??ation d'un article |
	{{ parent() }}
{% endblock %}

{% block body %}
	<div class="container-fluid mt-4">
		<div class="card w-50 mx-auto p-3">
			<h1 class="text-center">Cr??ation d'un article</h1>
			{{ form_start(form) }}
			{{ form_end(form) }}
		</div>
	</div>
{% endblock %}

```

Ici nous utilisons la balise `form_start(form)` et `form_end(form)` pour que twig ouvre la balise form avec le formulaire que le contr??leur ?? envoy??.

Juste en faisant ??a, vous devriez voir sur la page le formulaire, mais sans bouton de soumission.

Si nous ne stipulons pas ?? Twig ?? l'int??rieur des balises `form_start(form)` et `form_end(form)` o?? et comment nous voulons afficher nos champs, il va les mettre automatiquement les uns ?? la suite des autres, mais nous nous voulons rajouter ?? la fin un bouton de soumission, mais il doit ??tre ?? l'int??rieur du form.

Nous allons donc devoir r????crire l??g??rement le code de notre formulaire :

```twig
{{ form_start(form) }}
			{{ form_row(form.titre) }}
			{{ form_row(form.content) }}
			<div class="text-center">
				<button type="submit" class="btn btn-primary btn-inline">Cr??er</button>
			</div>
{{ form_end(form) }}
```

Avec les balise `form_row()` vous pouvez afficher sp??cifiquement un champ, le form_row va vous afficher le lable ainsi que l'input, il faut stipuler le nom du formulaire ainsi que le champ concern?? (?? afficher).

Mais imaginons que vous ne vouliez pas du label, seulement de l'input en int??grant un placeholder ? Et bien c'est possible gr??ce ?? la balise `form_widget()` 

```twig
{{ form_start(form) }}
			{{ form_widget(form.titre, {'attr': {'class': 'mb-4', 'placeholder': "Titre de l'article"} } ) }}
			{{ form_widget(form.content, {'attr': {'class': 'mb-4', 'placeholder': "Contenu de l'article", 'rows': 10} } ) }}
			<div class="text-center">
				<button type="submit" class="btn btn-primary btn-inline">Cr??er</button>
			</div>
{{ form_end(form) }}
```

Ici nous avons utilis?? `form_widget(form.titre)` en ajoutant un tableau d'option `attr` pour ajouter un attribut sur l'input, et ensuite ajout?? une classe ains que des placeholder.

Vous savez maintenant comment manipuler vos formulaires dans vos vues twig.

### Validation d'un formulaire

Maintenant il nous reste la validation du formulaire pour que notre article soit cr????, nous allons ??crire la validation directement dans le contr??leur, donc AdminController :

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

Nous avons simplement utilis?? la classe Request qui permet de r??cup??rer par exemple les variable superglobale `$_GET` ou `$_POST`, Symfony vous facilite la vie ??tant donn??e que vous n'avez seulement qu'?? r??cup??rer la request, et ensuite de v??rifier si le formulaire est soumis et s'il est valide.

Ensuite nous allons devoir importer l'`EntityManagerInterface` qui va nous permettre d'envoyer ce nouvel article en base de donn??es. Pour importer la classe, vous avez 2 solutions :

1. Importer directement la classe en param??tre par d??faut la m??thode que nous sommes entrain de d??velopper :

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

Nous stockons l'instance directement dans la variable $em et nous l'utilisons ensuite dans la m??thode avec `persist()` pour envoyer l'object en base de donn??es et `flush()` qui permet de sauvegarder les modifications que nous avons fait en base de donn??es. 

2.  Importer globalement la classe EntityManagerInterface pour pouvoir l'utiliser dans d'autre m??thode de notre classe AdminController, pour ce faire nous allons l'instancier dans le constructeur de notre classe AdminController :

```php
public function __construct(
  private EntityManagerInterface $em
){
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

Avant de vouloir envoyer l'article en base de donn??es, nous allons vouloir lui rattacher un auteur (un utilisateur).

Pour ??a nous allons devoir modifier l??g??rement notre table Article pour ajouter une relation **OneToMany** avec la table User ??tant donn??e qu'un article ne peut avoir qu'un auteur, et qu'un auteur peut ??crire plusieurs articles.

Faites la commande `php bin/console make:entity Article` et ajoutez le champs **user** de type relation ?? la table user.

Vous devriez avoir se r??sultat :

```php
/* .... Autres propri??t??s */

#[ORM\ManyToOne(inversedBy: 'articles')]
private ?User $user = null;

/* .... Autres accesseurs */
public function getUser(): ?User
{
  return $this->user;
}

public function setUser(?User $user): self
{
  $this->user = $user;

  return $this;
}
```

Maintenant vous pouvez envoyer ces modifications en base de donn??es (`php bin/console make:migration` PUIS `php bin/console doctrine:migrations:migrate`).

Maintenant, vos articles ont besoins d'avoir un utilisateur, donc si nous soumettons le formulaire, nous n'allons pas d??finir l'auteur automatiquement.

Nous allons devoir ajouter un peu de logique : 

Pour ??crire un article, il faut que l'utilisateur soit connect?? sur notre application, donc nous allons pouvoir r??cup??rer l'utilisateur tr??s facilement.

Dans votre **Admin Controller**, vous devez importer dans le constructeur la class **Security** qui permet entre autre, de r??cup??rer rapidement l'utilisateur qui est connect??.

```php
public function __construct(
  private EntityManagerInterface $em,
  private Security $security
) {
}
```

Une fois que c'est fait, nous allons devoir ajouter l'utilisateur automatiquement si le formulaire de cr??ation d'un article est soumis, donc rendez vous toujours dans votre AdminController dans la m??thode `createArticle` :

```php
public function __construct(
  private EntityManagerInterface $em
){
}

#[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request)
{
  $article = new Article();

  $form = $this->createForm(ArticleType::class, $article);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    // On r??cup??re l'article et on lui injecte l'utilisateur avant de l'envoyer en base
    $article->setUser($this->security->getUser());
    $this->em->persist($article);
    $this->em->flush();
  }

  return $this->render('Backend/Article/create.html.twig', [
    'form' => $form->createView()
  ]);
}
```

Et voil??, votre article a bien un utilisateur maintenant !

Derni??re chose ?? faire, ajouter un petit message et rediriger vers une autre page :

```php
#[Route('/article/create', name: 'admin.article.create')]
public function createArticle(Request $request)
{
  $article = new Article();

  $form = $this->createForm(ArticleType::class, $article);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $article->setUser($this->security->getUser());
    $this->em->persist($article);
    $this->em->flush();
    $this->addFlash('success', 'Article cr???? avec succ??s');
    return $this->redirectToRoute('admin');
  }

  return $this->render('Backend/Article/create.html.twig', [
    'form' => $form->createView()
  ]);
}
```

## La route admin

Maintenant que nous avons une page qui cr??e des articles nous allons pouvoir faire une page qui liste les articles ainsi que les utilisateurs dans l'admin.

Donc dans l'AdminController nous allons rajouter une nouvelle m??thode :

```php
#[Route('', name: 'admin')]
public function index(): Response
{
  return $this->render('Backend/index.html.twig');
}
```

N'oubliez pas de cr??er le fichier twig dans templates.

Maintenant nous voulons pouvoir r??cup??rer tous les users ainsi que tous les articles de notre bases de donn??es, pour ??a nous allons devoir utiliser les Repository, avec Symfony, ces classes vous permettent de pouvoir rechercher rapidement dans une table de votre base de donn??es. 

Nous allons devoir importer 2 classe globalement (dans notre constructeur) le UserRepository ainsi que le ArticleRepository :

```php
public function __construct(
  private ArticleRepository $repoArticle, 
  private UserRepository $repoUser, 
  private EntityManagerInterface $em
){
}
```

Maintenant nous pouvons appeler la classe ArticleRepository et UserRepository n'importe o?? dans notre AdminController avec les alias `$this->repoArticle` et `$this->repoUser`.

Donc nous pouvons ??crire dans notre m??thode de liste admin : 

```php
 #[Route('', name: 'admin')]
public function index(): Response
{
  // R??cup??rer tout les users
  $users = $this->repoUser->findAll();

  // R??cup??rer tout les articles
  $articles = $this->repoArticle->findAll();

  return $this->render('Backend/index.html.twig', [
    'articles' => $articles,
    'users' => $users,
  ]);
}
```

Il ne vous reste plus qu'?? afficher les informations sur votre vue.

## Modifier un article

Il nous reste tout de m??me ?? laisser la possibilit?? de modifier un article.

Toujours dans l'AdminController, nous allons cr??er une nouvelle m??thode qui va ??tre tr??s proche de celle que nous avons cr???? pour la cr??ation d'un article ?? quelques d??tails pr??t :

```php
 #[Route('/article/edit/{id}', name: 'admin.article.edit', methods: 'GET|POST')]
public function editArticle(Article $article, Request $request)
{
  $form = $this->createForm(ArticleType::class, $article);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $this->em->persist($article);
    $this->em->flush();
    $this->addFlash('success', 'Article modifi?? avec succ??s');
    return $this->redirectToRoute('admin');
  }

  return $this->render('Backend/Article/edit.html.twig', [
    'form' => $form->createView()
  ]);
}
```

Dans un premier temps, vous voyez que dans le commentaire pour d??finir la route, nous avons passer un param??tre dynamique `/article/edit/{id}` les accolades dans une url symbolise un param??tre qui sera envoy?? directement dans l'url, en l'occurrence, nous voulons r??cup??rer l'id de l'article ?? modifier afin de le retrouver en base de donn??es et de g??n??rer le formulaire avec les informations qui sont disponible en base de donn??es.

Ensuite plut??t que de cr??er un nouvel article avant la g??n??ration du formulaire, nous avons simplement recherch?? l'article avec l'id, et nous avons envoy?? cet article dans le formulaire.

Vous pouvez maintenant cr??er ou modifier des articles.

## Ajouter une image ?? un article

Maintenant que nous pouvons cr??er et modifier des articles, nous allons vouloir rajouter une image ?? un article, pour ce faire, nous allons utiliser un bundle de Symfony : **VichUploader** qui va nous simplifier l'upload de l'image sur les articles.

### Installation et configuration du bundle

La premi??re ?? faire est d'installer le bundle, pour ce faire vous devez entrez la commande suivante dans un terminal :

```bash
composer require vich/uploader-bundle
```

N'oubliez pas d'autoriser la recette de cette installation (configuration automatique du bundle) ce qui va permettre de cr??er les fichier de config.

Une fois l'installation finit, vous pourrez retrouver un nouveau fichier dans le dossier **config/packages/vich_uploader.yaml** qui va configurer votre upload d'image.

Vous allez devoir cr??er un nouveau mapping, ce qui signifie que vous allez dire ?? votre nouveau bundle o?? il doit uploader vos fichiers pour les articles ainsi que les options :

```yaml
vich_uploader:
    db_driver: orm

    mappings:
    		# Mapping pour l'image des articles
        articles_image:
            uri_prefix: /images/articles
            upload_destination: "%kernel.project_dir%/public/images/articles"
            namer: Vich\UploaderBundle\Naming\SmartUniqueNamer
            inject_on_load: false
            delete_on_update: true
            delete_on_remove: true

    metadata:
        type: attribute
```

### Configuration de la table article

Maintenant que vous avez configur?? votre nouveau mapping, il va falloir modifier votre Entity Article pour modifier votre table et stocker le nom de l'image rattach??e ?? votre article.

Rendez-vous donc dans le fichier **src/Entity/Article.php**.

Premi??re chose ?? faire c'est d'indiquer ?? Symfony que cette table contient des champs uploadable :

```php
namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[Vich\Uploadable]
class Article
{
}
```

N'oubliez pas les uses pour importer les classes.

Maintenant il va falloir ajouter les champs utiles pour l'upload d'image :

```php
// [...] Autres propri??t??s de la table

#[Vich\UploadableField(mapping: 'articles_image', fileNameProperty: 'imageName', size: 'imageSize')]
private ?File $imageFile = null;

#[ORM\Column(length: 255)]
private ?string $imageName = null;

#[ORM\Column]
private ?int $imageSize = null;
```

Pour fonctionner, VichUploader ?? besoin de 3 champs indispensables :

- **ImageFile** qui va stoker l'image et permettre l'upload, notez que cette propri??t?? ne sera pas en base de donn??es, elle sert simplement ?? VichUpload de r??cup??rer le fichier et de faire le traitement de l'upload.
  Nous avons ??galement rajouter des options ?? cette propri??t?? pour que VichUploader g??re tout seul les informations :
  - **`mapping`** -> qui indique le nom du mapping ?? utiliser (celui que nous avons configurer dans le fichier yaml du bundle), il faut que le nom du mapping soit identique ?? celui que vous avez mis dans le fichier vich_uploader.yaml.
  - **`fileNameProperty`** -> qui va automatiquement remplir le champ **imageName** en base de donn??es pour stocker le nom de l'image rattach??e ?? l'article en base de donn??es.
  - **`size`** -> qui va automatiquement remplir le champ **ImageSize** en base de donn??es stockant la taille de l'image.

Maintenant il faut ajouter les accesseurs pour ces propri??t??s :

```??php
// [...] Autres accesseurs
public function setImageFile(?File $imageFile = null): void
{
  $this->imageFile = $imageFile;

  if (null !== $imageFile) {
    // Il faut biensur que la propri??t?? updatedAt soit cr??e sur l'Entity.
    $this->updatedAt = new \DateTimeImmutable();
  }
}

public function getImageFile(): ?File
{
  return $this->imageFile;
}

public function setImageName(?string $imageName): void
{
  $this->imageName = $imageName;
}

public function getImageName(): ?string
{
  return $this->imageName;
}

public function setImageSize(?int $imageSize): void
{
  $this->imageSize = $imageSize;
}

public function getImageSize(): ?int
{
  return $this->imageSize;
}
```

Une fois que vous avez fait vos modifications, n'oubliez pas de faire les deux commande pour envoyer ces modifications en base de donn??es :

- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`

### Ajout du champ dans le formulaire

Maintenant que nous avons nos champs en base de donn??es et fait la configuration du bundle, il ne nous reste plus qu'?? ajouter le champ dans le formulaire.

Ouvrez le fichier **src/Form/ArticleType.php** et ajoutez le champs `imageFile` :

```php
<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ])
          	->add('imageFile', VichImageType::class, [
              'required' => false,
              'download_uri' => false,
              'image_uri' => true,
              'asset_helper' => true,
              'label' => 'Image',
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

N'oubliez pas d'importer les classes que nous utilisons.

### Modification de la vue

Maintenant, il ne nous reste plus qu'?? modifier notre vue pour afficher le nouvel input de type file qui va nous permettre d'uploader une image dans la vu qui est utilis??e pour la cr??ation et l'??dition d'un article en ajoutant o?? vous souhaitez dans votre formulaire le champ :

```twig
{{ form_row(form.imageFile)}}
```

## Supprimer un article

Maintenant pour avoir toutes les actions **CRUD** sur nos articles, il faut g??rer la suppression d'un article.

Pour ??a nous allons devoir cr??er une nouvelle m??thode dans l'AdminController qui va nous permettre de supprimer un article.

Cependant, quand on parle de suppression en base de donn??es, il faut ??tre tr??s prudent, donc nous allons devoir faire des v??rifications plus pouss??es avant de faire quoique ce soit en base.

Pour ce faire Symonfy g??n??re automatiquement des tokens de validation de formulaire, ce qui va nous permettre de v??rifier si un formulaire est bien soumis via notre application et que la requ??te n'a pas ??t?? intercept??e ni modifier entre temps, c'es le **token Csrf** de Symfony, nous allons devoir en g??n??rer un dans la vue sur le bouton de soumission du formulaire de suppression, et v??rifier dans le controller que le token est valide avant de supprimer l'??l??ment.

Tout d'abord, faisons notre m??thode dans le controller :

```php
#[Route('/article/delete/{id}', name: 'admin.article.delete', methods: 'DELETE|POST')]
public function deleteArticle(Article $article, Request $request)
{
  // M??thode de suppression d'un article
}
```

Nous pouvons voir que dans l'url nous allons passer l'id d'un article afin de pouvoir identifier quel article doit ??tre supprim?? que nous stockons dans la variable php $article.

Maintenant nous allons devoir v??rifier le token Csrf avant de supprimer cet article :

```php
#[Route('/article/delete/{id}', name: 'admin.article.delete', methods: 'DELETE|POST')]
public function deleteArticle(Article $article, Request $request)
{
  if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token'))) {
    // Le token est valide on suprrime l'article
    $this->em->remove($article);
    $this->em->flush();
    $this->addFlash('success', 'Article supprim?? avec succ??s');
    
    return $this->redirectToRoute('admin');
  }

  $this->addFlash('error', 'Le token n\'est pas valide');

  return $this->redirectToRoute('admin');
}
```

Maintenant nous devons modifier la vue qui liste nos article en ajoutant un formulaire avec le token que nous allons g??n??rer ainsi que le bouton de suppression pour chaque article :

```twig
<form method="POST" action="{{ path('admin.article.delete', {'id': article.id}) }}" onsubmit="return confirm('??tes-vous s??r de vouloir supprimer cet article ?')">
  <input type="hidden" name="_method" value="DELETE">
  <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ article.id) }}">
  <button class="btn btn-danger text-light">Supprimer</button>
</form>
```

## Ajout de cat??gories aux articles

Maintenant, nous allons vouloir ajouter une nouvelle table et une nouvelle fonctionnalit?? ?? notre application, l'attribution de cat??gorie ?? nos article afin de les trier.

### Cr??ation de la table

Pour commencer nous allons stocker les cat??gories dans une nouvelle table, vous devez donc cr??er une nouvelle entity.

Pour ce faire utiliser le maker bundle avec la commande **`php bin/console make:entity Categorie`**, pour la structure de votre table vous devez avoir les champs suivants :

- `titre` -> string maxi 100 caract??res
- `articles` -> relation ManyToMany avec la table article

La relation va ??tre g??r?? automatiquement avec doctrine, donc vous avez simplement ?? suivre les instructions dans le terminal pour cr??er ce champ et cette relation.

Une fois que vous avez ajouter les deux champs, faites la migration en base de donn??es -> `php bin/console make:migration` PUIS `php bin/console doctrine:migrations:migrate`.

### G??n??ration du CRUD

Nous avons vu pr??c??demment comment mettre en place manuellement notre CRUD sur les articles, mais Symfony nous laisse la possibilit?? de g??n??rer automatiquement le controller avec toutes les m??thodes CRUD d??j?? pr??te, ainsi que toutes les vues.

Pour g??n??rer tout ??a, vous avez simplement ?? lancer la commande **`php bin/console make:crud`**, ensuite vous devez simplement d??finir qu'elle entity va ??tre concern??e pour la g??n??ration du CRUD, et enfin quelle doit ??tre le nom du controller que Symfony va vous g??n??rer.

Et automatiquement, vous avez un nouveau controller avec toutes les m??thodes CRUD pour votre entity, ainsi que le Form builder pour votre entity et enfin toutes les vues pour les diff??rentes pages du CRUD.

Vous pouvez d??placer les fichiers g??n??r??s automatiquement dans les diff??rents dossiers pour garder une architecture plus propre, mais attention ?? changer les namespaces ainsi que les liens vers les vues dans le controller si besoin.

### Ajouter des cat??gories

Maintenant vous pouvez vous rendre sur la page de cr??ation de cat??gories pour en cr??er plusieurs.

Il ne restera plus qu'?? modifier le formulaire des articles pour que l'on puisse r??cup??rer toutes les cat??gories stock??es en base de donn??es et de pouvoir rattacher des  cat??gories ?? nos articles.

### Relier les cat??gories aux articles

Maintenant que tout est en place, il faut modifier le formulaire des articles pour ajouter des cat??gories, modifier donc votre fichier **`ArticleType`** :

```php
<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre:',
                'required' => true
            ])
          	->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'label' => 'Categories:',
                'multiple' => true,
                'choice_label' => 'titre',
                'by_reference' => false,
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu:',
                'required' => true
            ])
          	->add('imageFile', VichImageType::class, [
              'required' => false,
              'download_uri' => false,
              'image_uri' => true,
              'asset_helper' => true,
              'label' => 'Image',
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

Nous avons rajout?? le champs categories qui est de type **`EntityType`**, ce qui veut dire que Symfony va g??n??rer soit une liste d??roulante soit une liste ?? choix multiple avec toutes les entr??es de la table Cat??gorie, et va pouvoir attribuer les cat??gories aux articles rapidement et automatiquement avec le formulaire.

Pour finir, n'oubliez pas de modifier la vue avec les formulaire des articles pour afficher ce nouveau champ o?? vous souhaitez.

## Cr??ation des pages frontend article

Maintenant que nous avons g??r?? la partie backend, nous pouvons cr??er les pages qui vont afficher un seul article.

Pour ce faire, nous allons cr??er un nouveau contr??leur ArticleController qui sera dans le dossier **src/frontend** afin de ne pas m??langer les controllers pour le frontend et ceux pour le backend.

Pour cr??er le nouveau contr??leur, faites la commande `php bin/console make:controller ArticleController` ce qui va vous g??n??rer le controller, ensuite vous devez le ranger dans le bon dossier (src/frontend) et changer le namespace du fichier g??n??r??.

Le fichier doit ressembler ?? cela :

```php
<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article')]
class ArticleController extends AbstractController
{
}
```

Maintenant nous allons cr??er une m??thode qui va afficher une page avec 1 seul article, pour ce faire nous devons envoyer dans l'url le **slug** en param??tre pour que notre controller puisse retrouver l'article en base de donn??es et envoyer toutes les informations ?? la vue :

```php
#[Route('/details/{slug}', name: 'article.show')]
public function index(?Article $article, ArticleRepository $repo): Response
{
  // Si aucun article trouv??, on redirige vers la page d'accueil avec un message d'erreur
  if (!$article instanceof Article) {
    $this->addFlash('error', 'Article non trouv??');

    return $this->redirectToRoute('home');
  }
  
  // On envoie les informations ?? la vue
  return $this->renderForm('frontend/article/show.html.twig', [
    'article' => $article,
  ]);
}
```

Rien de plus simple, maintenant il faut cr??er le fichier pour la vue et afficher les informations.

Une fois votre vue mise en place, vous pouvez maintenant modifier la page d'accueil pour qu'elle puisse afficher la liste de tous les articles et int??grer des liens vers les pages des articles, pour ??a modifiez simplement le MainController :

```php
<?php

namespace App\Controller\Frontend;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findAll();

        return $this->render('frontend/Home/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
```

On utilise l'`ArticleRepository` pour chercher tous les articles dans la table et on les envoie ?? la vue, il ne vous reste plus qu'?? modifier la vue pour avoir les articles sur la page d'accueil.

## G??rer les utilisateurs

Maintenant, il nous reste une partie importante sur notre application, la gestion des utilisateurs, que ce soit pour enregistrer un nouvel utilisateur, ou pour que l'administrateur puisse modifier les droits de chaque utilisateur.

### Inscription des utilisateurs

Dans un premier temps, nous allons cr??er la page d'inscription utilisateur.

Pour ??a nous allons cr??er un nouveau formulaire pour les inscriptions des utilisateurs, vous pouvez g??n??rer ce formulaire avec la commande `php bin/console make:form` et vous pouvez appeler ce nouveau formulaire **RegistrationFormType**

Une fois que vous avez g??n??rez le fichier vous allez devoir le modifier l??g??rement :

```php
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre Email:',
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => ['autocomplete' => 'new-password'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez un mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit faire plus de {{ limit }} caract??res',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'Mot de passe',
                ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password'],
                    'label' => 'R??p??tez le mot de passe',
                ],
                'invalid_message' => 'Les mot de passe ne correspondent pas.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Pr??nom:',
                'required' => true,
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom:',
                'required' => true,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse:',
                'required' => true,
            ])
            ->add('zipCode', IntegerType::class, [
                'label' => 'Code postal:',
                'required' => true,
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville:',
                'required' => true,
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image: ',
                'required' => false,
                'download_uri' => false,
                'image_uri' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
```

Maintenant que vous avez un beau formulaire, vous allez pouvoir cr??er la page qui peut enregistrer de nouveau utilisateurs, donc passer par un controller, vous pouvez passer par le SecurityController si vous le souhaitez et ajouter la m??thode suivante :

```php
#[Route('/register', name: 'register')]
public function register(
  Request $request,
  UserPasswordHasherInterface $passwordEncoder,
  UserRepository $repo
) {
  $user = new User();

  $form = $this->createForm(RegistrationFormType::class, $user);
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    // Hash the password
    $user->setPassword(
      $passwordEncoder->hashPassword(
        $user,
        $form->get('password')->getData()
      )
    );

    $repo->add($user, true);

    $this->addFlash('success', 'Vous ??tes bien inscrit ?? notre application');

    return $this->redirectToRoute('login');
  }

  return $this->renderForm('Security/register.html.twig', [
    'form' => $form,
  ]);
}
```

Et il ne vous reste plus qu'?? cr??er votre vue.

### Gestion des r??les

Maintenant que vous avez g??rer l'inscription, il va falloir laisser la possibilit?? aux utilisateurs admin de pouvoir modifier le r??les des utilisateurs.

Pour ??a vous allez cr??er un nouveau controller dans le dossier **src/backend** que vous nommerez UserController et dans lequel vous allez vouloir cr??er les m??thodes CRUD (sans le create) :

```php
<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('Backend/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Backend/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
```

Je vous laisse bien entendu faire vos vue.

Si vous suivez bien, vous aurez remarqu?? que pour la partie admin, nous utilisons un autre FormType pour les utilisateurs, c'est normal car nous ne voulons pas que l'admin puisse modifier les informations personnel des utilisateurs, seulement les r??les.

Donc nous allons cr??er un nouveau FormType qui va int??grer plusieurs conditions :

- Si l'utilisateur connect?? en tant qu'Admin
- Si l'utilisateur connect?? est le m??me que l'utilisateur qui va ??tre modifi?? (si oui, il aura acc??s ?? plus de champs pour modifier son profil)

Nous faisons cela pour vous montrer que nous pouvons g??n??rer des formulaires en int??grant des conditions, et que certains champs vont ??tre affich?? de mani??re dynamique en fonction de condition sans besoin de devoir cr??er plusieurs FormType pour le m??me objet.

Donc g??n??rez votre fichier UserType.php et modifiez-le comme ceci :

```php
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class UserType extends AbstractType
{
    public function __construct(
      private Security $security
    ){
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      // On ajoute une condition dans notre FormType
      $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
        $user = $event->getData();
        $form = $event->getForm();

        // On v??rifie si l'utilisateur qui est connect?? est celui qui va ??tre modifi??
        if ($user == $this->security->getUser()) {
          // On ajoute les champs pour la modification de son propre profil
          $form
            ->add('prenom', TextType::class, [
              'label' => 'Pr??nom:',
              'required' => true,
            ])
            ->add('nom', TextType::class, [
              'label' => 'Nom:',
              'required' => true,
            ])
            ->add('address', TextType::class, [
              'label' => 'Adresse:',
              'required' => true,
            ])
            ->add('zipCode', IntegerType::class, [
              'label' => 'Code postal:',
              'required' => true,
            ])
            ->add('ville', TextType::class, [
              'label' => 'Ville:',
              'required' => true,
            ])
            ->add('imageFile', VichImageType::class, [
              'label' => 'Image: ',
              'required' => false,
              'download_uri' => false,
              'image_uri' => true,
              'by_reference' => false,
            ]);
        }

        // On v??rifie si l'utillisateur connect?? est un admin
        if ($this->security->isGranted('ROLE_ADMIN')) {
          // On ajoute le champ r??le pour g??rer les r??les
          $form->add('roles', ChoiceType::class, [
            'choices' => [
              'Utilisateur' => 'ROLE_USER',
              '??diteur' => 'ROLE_EDITOR',
              'Administrateur' => 'ROLE_ADMIN',
            ],
            'label' => 'Roles:',
            'required' => false,
            'expanded' => true,
            'multiple' => true,
          ]);
        }
      });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
```

Vous noterez que dans ce formulaire, nous n'int??grons pas la modification du mot de passe, nous allons mettre en place une structure de r??initialisation de mot de passe plus complexe et plus s??curis?? (que nous ferons plus tard).

Maintenant la vue de votre formulaire d'??dition d'utilisateur doit ??galement ??tre modifi?? :

```twig
{{ form_start(form) }}
{% if form.prenom is defined and form.nom is defined %}
	<div class="row">
		<div class="col-md-6">
			{{ form_row(form.prenom) }}
		</div>
		<div class="col-md-6">
			{{ form_row(form.nom) }}
		</div>
	</div>
{% endif %}

{% if form.imageFile is defined %}
	<div class="row">
		{{ form_row(form.imageFile)}}
	</div>
{% endif %}

{% if form.roles is defined %}
	<div class="col-md-12">
		{{ form_row(form.roles) }}
	</div>
{% endif %}

{% if form.address is defined and form.zipCode is defined and form.ville is defined %}
	<div class="row">
		<div class="col-md-8">
			{{ form_row(form.address) }}
		</div>
		<div class="col-md-4">
			{{ form_row(form.zipCode) }}
		</div>
	</div>

	<div class="col-md-6">
		{{ form_row(form.ville) }}
	</div>
{% endif %}

<div class="text-center">
	<button class="btn btn-primary">{{ button_label|default('Save') }}</button>
</div>
{{ form_row(form._token) }}
{{ form_end(form, {render_rest: false}) }}
```

Avant de vouloir afficher les champs, on v??rifie qu'ils ont ??t?? g??n??r?? et qu'ils existent.

Maintenant, quand vous allez modifier un user, votre formulaire va prendre en compte toute nos conditions pour afficher les bons champs en fonction de la situation.

### La partie frontend des utilisateurs

Nous avons g??r?? pour le moment seulement le cas o?? les admin souhaite modifier un utilisateur, mais nous n'avons pas g??r?? le cas o?? un utilisateur qui est connect?? souhaite afficher ces informations ainsi que modifier ces informations personnelles.

Dans un premier temps, vous allez devoir modifier votre bundle security pour ajouter une r??gle sur les urls qui commencent par '/compte', pour que ces pages soient disponible uniquement aux utilisateurs connect??.

Ouvrez-le fichier **config/packages/security.yaml** et faites la modification suivante :

```yaml
access_control:
    - { path: ^/admin, roles: ROLE_ADMIN }
    - { path: ^/compte, roles: ROLE_USER }
```

De ce fait, vous avez s??curis?? les urls qui commencent par '/compte' pour qu'elles soient disponible seulement aux utilisateurs connect??.

Maintenant il va falloir cr??er les pages de compte et d'??dition pour les utilisateurs qui sont connect??, donc un nouveau controller.

G??n??rez un nouveau controller dans le dossier frontend du nom de UserController :

```php
<?php

namespace App\Controller\Frontend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/compte')]
class UserController extends AbstractController
{
    public function __construct(
        private Security $security,
        private UserRepository $repo
    ) {
    }

    #[Route('', name: 'compte')]
    public function show(): Response
    {
        $user = $this->security->getUser();

        return $this->render('frontend/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/edit-account', name: 'front_user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        UserRepository $userRepository
    ): Response {

        $user = $this->security->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('compte', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Backend/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'title_heading' => 'Editez votre profil'
        ]);
    }
}
```

Vous devez biensur cr??er vos vue maintenant.

### Le reset password

Derni??re chose ?? mettre en place pour les utilisateurs, c'est la fonctionnalit?? de changer de mot de passe, en effet pour le moment nous ne laissons pas la possibilit?? ?? nos utilisateurs de modifier leur mot de passe (par mesure de s??curit??).

Nous voulons ajouter cette feature de sorte ?? ce qu'un utilisateur qui veut changer son mot de passe doit faire une demande sur l'application en rentrant son adresse email, et qu'automatiquement notre application lui envoie un email avec un lien s??curis?? pour r??initialiser son mot de passe.

Pour ??a nous allons utiliser un bundle de Symfony pour simplifier les choses.

#### Installation du bundle

Pour installer le bundle vous devez rentrer la commande :

```bash
composer require symfonycasts/reset-password-bundle
```

Une fois que vous avez install?? le bundle entrez la commande :

```bash
php bin/console make:reset-password
```

Ce qui va vous g??n??rer tout les fichiers dont vous avez besoin pour effectuer un reset de password (m??me les vues !).

Ensuite vous allez devoir faire la migration en base de donn??es des changements que le bundle ?? fait (cr??ation d'un table qui stocke les demande de r??initialisation de mot de passe avec les token), donc -> `php bin/console make:migration` PUIS `php bin/console doctrine:migrations:migrate`.

#### Configuration du bundle

Avec l'installation, vous avez un nouveau fichier **config/packages/reset_password.yaml**, c'est le fichier de configuration du bundle de reset password. Modifi?? le comme ceci :

```yaml
symfonycasts_reset_password:
    request_password_repository: App\Repository\ResetPasswordRequestRepository
    lifetime: 5300
    enable_garbage_collection: true
```

Ensuite, afin de pouvoir tester l'envoi d'email, vous pouvez utiliser mailldev ou mailltrap qui va nous permettre de pouvoir tester l'envoie d'email de notre application sans avoir besoin d'avoir un serveur SMTP sous la main.

Premi??re ??tapes, vous devez modifier le fichier **config/packages/messenger.yaml** :

```yaml
framework:
    messenger:
        failure_transport: failed

        transports:
            # https://symfony.com/doc/current/messenger.html#transport-configuration
            async:
                dsn: "%env(MESSENGER_TRANSPORT_DSN)%"
                options:
                    use_notify: true
                    check_delayed_interval: 60000
                retry_strategy:
                    max_retries: 3
                    multiplier: 2
            failed: "doctrine://default?queue_name=failed"
            # sync: 'sync://'

        routing:
        		# Commentez la ligne ci dessous
            #Symfony\Component\Mailer\Messenger\SendEmailMessage: async
            Symfony\Component\Notifier\Message\ChatMessage: async
            Symfony\Component\Notifier\Message\SmsMessage: async

            # Route your messages to the transports
            # 'App\Message\YourMessage': async
```

Ensuite vous allez devoir vous cr??er un compte sur le [site de mailTrap](https://mailtrap.io/) (service gratuit).

Une fois que vous l'avez fait, vous devriez tomber sur la page d'int??gration de mailtrap dans vos applications, vous devriez voir un menu d??roulant avec marqu?? `curl`, ouvrez ce menu et s??lectionnez Symfony 5+ :

![image-20220802161647629](/Users/pierre/Library/Application Support/typora-user-images/image-20220802161647629.png)

Copiez ensuite la ligne qui commence par **MAILER_DSN** et allez dans le fichier .env de votre projet Symfony, cherchez la ligne qui commence par **MAILER_DSN**  dans le fichier .env et remplacez-l?? par celle que vous avez copi?? sur Mailtrap.

Derni??re ??tape lancez la commande :

```bash
composer dump-env dev
```

Terminez le process avec la commande :

```bash
php bin/console cache:clear
```

#### Tester le reset de password

Maintenant il ne nous reste plus qu'?? tester que tout fonctionne correctement, pour ??a, rendez-vous sur l'url reset-password et rentrez une adresse email d'un utilisateur existant dans votre base de donn??es.

En soumettant le formulaire, cela va envoyer un email avec le lien pour modifier le mot de passe de l'utilisateur qui a fait la demande. 

Vous pourrez retrouver ce lien en allant sur votre compte mailtrap en ligne dans l'onglet Inboxes > My inbox.

Cliquez sur le lien et modifiez le mot de passe, ensuite essayer de vous connecter avec l'utilisateur dont vous avez modifi?? le mot de passe pour v??rifier qu'il a bien ??t?? chang??.

## Gestion des commentaires

Maintenant que nous avons une application fonctionnelle avec des utilisateurs, la possibilit?? de cr??er des articles, les modifier, les supprimer, nous allons pouvoir ajoute un **module de commentaires** sur les articles.

Nous voulons que chaque utilisateur identifi?? (connect??) puisse pouvoir laisser un commentaire pour chaque article.

### La table commentaire

Premi??re chose ?? faire, nous devons cr??er la table commentaire, pour ??a faites la commande `php bin/console make:entity Comment`

Ensuite vous allez devoir ajouter les champs suivants :

- Titre -> string
- Content -> string
- createdAt -> date time
- updatedAt -> date time
- Note -> integer
- Active -> boolean
- Rgpd -> Boolean
- User -> Relation ManyToOne avec la table user
- Article -> Relation ManyToOne avec la table article

Une fois que votre classe est faite, il faut envoyer les modifications en base de donn??es avec `php bin/console make:migration` puis `php bin/console doctrine:migrations:migrate`.

### Le formulaire de commentaire

Maintenant, il faut cr??er un formulaire pour pouvoir laisser la possibilit?? de poster un commentaire, donc pour cr??er le formulaire, faites la commande `php bin/console make:form` et s??lectionnez l'entity que nous venons de cr??er (Comment).

Maintenant il ne reste plus qu'?? modifier notre fichier CommentType pour lui donner les champs souhaitez :

```php
<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
              	'label' => 'Titre:',
                'attr' => [
                    'placeholder' => 'Titre du commentaire',
                ],
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le titre de votre commentaire doit ??tre sup??rieur ?? {{ limit }} caract??res',
                        'max' => 150,
                        'maxMessage' => 'Le titre de votre commentaire ne doit pas d??passer {{ limit }} caract??res',
                    ]),
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu:',
                'attr' => [
                    'placeholder' => 'Contenu de votre commentaire',
                ],
                'required' => true,
            ])
            ->add('note', RangeType::class, [
                'label' => 'Note:',
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                    'value' => 3,
                ],
                'help' => 'S??lectionnez une note pour l\'article',
                'required' => true,
            ])
            ->add('rgpd', CheckboxType::class, [
                'label' => 'Rgpd',
                'help' => 'En cochant cette case vous acceptez notre politique de confidentialit??',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez cocher la case RGPD pour poster un commentaire',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
```

### Envoyer le formulaire ?? la vue

Maintenant que nous avons tout pr??par??, nous allons envoyer ce nouveau formulaire ?? une vue pour que nos utilisateurs puissent laisser des commentaires.

Pour ??a, nous allons utiliser la page de details d'un article pour afficher le formulaire de commentaires, donc rendez vous dans le fichier **src/Controller/Frontend/ArticleController.php** pour envoyer le formulaire de soumission de commentaire.

Tout d'abord nous allons devoir importer le repository pour retrouver les commentaires s'il y en a :

```php
/* Constructeur de notre classe */
public function __construct(
  private ArticleRepository $repo,
  /* On ajoute le repository des commentaires pour retrouver les commentaires s'il y en a */
  private CommentsRepository $repoComment,
) {
}
```

### Ajouter une m??thode de recherche custom

Avant d'aller plus loins dans l'envoi du formulaire ?? la vue, il va falloir qu'on ajoute une m??thode de recherche custom pour retrouver les commentaires, en effet, nous allons vouloir **r??cup??rer tous les commentaires pour 1 seul article** (??tant donn??e que nous allons afficher les commentaires sur la page de details d'un article).

De plus nous allons vouloir cr??er 2 m??thodes de recherche, une pour le frontend qui affichera **seulement les commentaires actifs**, et une autre pour le backend qui affichera tout les commentaires pour les g??rer.

Pour ajouter une m??thode de rechercher dans une table custom, nous avons simplement ?? rajouter une nouvelle m??thode dans le repository de la table cibl??e, dans notre cas, le **CommentRepository**.

Donc rendez-vous dans le fichier pour ajouter nos m??thodes de recherche, d'abord la recherche de commentaires actif pour un seul article :

```php
public function findActiveByArticle(int $articleId)
{
  return $this->createQueryBuilder('C');
}
```

Pour le moment, notre nouvelle m??thode envoie seulement une queryBuilder (un builder de requ??te), vous noterez que nous **donnons un alias ?? notre queryBuilder** pour lui ajouter plus facilement les options. 

Autre point ?? noter ici, notre **m??thode prend l'id de l'article en param??tre**, ce qui veut dire que quand on voudra executer cette requ??te, nous allons **obligatoirement devoir lui passer l'id de l'article**.

Mais maintenant, nous allons devoir lui stipuler les options de recherches il doit ajouter avant de lui demander de r??cup??rer toutes les entr??es qui correspondent ?? notre recherche :

```php
public function findActiveByArticle(int $articleId)
{
  return $this->createQueryBuilder('c')
    /* On filtre sur l'article (on utilise la relation entre les deux tables */
    ->andWhere('c.article = :id')
    /* On attribut la valeur du marker de la ligne ci-dessus */
    ->setParameter('id', $articleId)
    /* On ne s??lectionne que les commentaires actifs */
    ->andWhere('c.active = :active')
    /* On attribut la valeur du marker de la ligne ci-dessus */
    ->setParameter('active', true)
    /* On ordonnance les r??sultats en r??cup??rant les derniers commentaires en premier */
    ->orderBy('c.createdAt', 'DESC')
    /* On r??cup??re la requ??te SQL compl??te */
    ->getQuery()
    /* On r??cup??re les r??sultats de la requ??te que notre m??thode va renvoyer */
    ->getResult();
}
```

Maintenant nous allons faire la deuxi??me m??thode de recherche qui va r??cup??rer tout les commentaires (m??me inactif) pour un article :

```php
public function findByArticle(int $articleId, string $slug)
{
  return $this->createQueryBuilder('c')
    ->join('c.article', 'a')
    ->andWhere('a.id = :articleId')
    ->setParameter('articleId', $articleId)
    ->andWhere('a.slug = :slug')
    ->setParameter('slug', $slug)
    ->orderBy('c.createdAt', 'DESC')
    ->getQuery()
    ->getResult();
}
```

C'est exactement la m??me chose que pr??c??demment, mais cette fois, on ne filtre pas sur le champ actif pour r??cup??rer tous les commentaires.

### Utiliser nos recherches custom

Maintenant que nous avons nos m??thode de recherche, nous allons pouvoir les utiliser, d'abord sur la partie frontend afin de r??cup??rer seulement les articles actifs, donc dans le ArticleController (frontend), nous allons ajouter une variables comments qui va stocker les commentaires de l'article, les envoyer ?? la vue, et ensuite nous allons g??n??rer notre formulaire de soumission de commentaire :

```php
#[Route('/article/details/{slug}', name: 'article.show')]
public function show(?Article $article, Security $security, Request $request): Response 
{
  if (!$article instanceof Article) {
    $this->addFlash('error', 'Article non trouv??');

    return $this->redirectToRoute('home');
  }

  /* On cherche les commentaires de notre article */
  $comments = $this->repoComment->findActiveByArticle($article->getId());

  /* On instancie le commentaire vide */
  $comment = new Comments();

  /* On g??n??re le formulaire */
  $form = $this->createForm(CommentsType::class, $comment);
  $form->handleRequest($request);
  
  return $this->renderForm('Frontend/Article/show.html.twig', [
    'article' => $article,
    /* On envoie le formulaire ainsi que les commentaires ?? la vue */
    'form' => $form,
    'comments' => $comments,
  ]);
}
```

Maintenant il va falloir g??rer la validation du formulaire pour cr??er un commentaire :

```php
if ($form->isSubmitted() && $form->isValid()) {
  /* On ajoute l'utilisateur connect?? au commentaire */
  $comment->setUser($security->getUser())
    /* On ajoute l'article qui va ??tre ratach?? au commentaire */
    ->setArticle($article)
    /* On d??finit par d??faut actif le commentaire */
    ->setActive(true);

  /* On ajoute le commentaire en base de donn??es */
  $this->repoComment->add($comment, true);

  /* On redirige sur la m??me page pour mettre ?? jour les commentaires */
  $this->addFlash('success', 'Votre commentaire a ??t?? post?? avec succ??s');

  return $this->redirectToRoute('article.show', [
    'slug' => $article->getSlug(),
  ], 301);
}
```

### Envoyer ?? la vue

Tr??s bien, maintenant il va falloir g??rer la vue pour afficher les commentaires s'il y en a, et afficher le formulaire mais seulement si l'utilisateur est connect??, dans le cas contraire, on lui demande de se connecter.

Dans ce contexte, l'id??al est de s??parer ces fichiers twig en cr??ant un petit fichier qui va afficher les commentaires, et de l'appeler sur la page de details via un include, ce qui va ??viter d'avoir un seul fichier trop lourd et incompr??hensible.

Donc dans le dossier template/Frontend/Article, cr??ez un nouveau dossier Commentaires dans lequel vous allez mettre tout les fichiers partials qui concerne les commentaires.

Commen??ons par l'affichage du formulaire :

```twig
{# Commentaires/_formComment.html.twig #}

{{ form_start(form) }}
{{ form_row(form.note) }}
{{ form_widget(form.titre, {'attr' : {'class': 'mt-4'} }) }}
{{ form_errors(form.titre)}}
{{ form_widget(form.content, {'attr' : {'class': 'mt-4 mb-4', 'rows': 5} }) }}
{{ form_row(form.rgpd)}}
<button type="submit" class="btn btn-primary">{{ button_label|default('Save')}}</button>
{{ form_end(form) }}
```

Maintenant, sur le fichier article show.html.twig, nous allons devoir v??rifier si l'utilisateur est connect?? ou non, si oui on lui affiche le formulaire, sinon on lui affiche un message pour qu'il se connecte :

```twig
{# Article/show.html.twig #}

<div class="comments card p-3 mt-4">
  <h2>Ajouter un commentaire</h2>
  {% if app.user %}
  	{% include "Frontend/Article/Commentaires/_formComment.html.twig" with { button_label: 'Envoyer'} %}
  {% else %}
    <div class="alert alert-info mt-2" role="alert">
      <p>
      <b>Attention!</b>
      <br/>
      Vous devez
      <a href="{{ path('login') }}">??tre connect??</a>
      pour laisser un commentaire.
      </p>
  	</div>
	{% endif %}
</div>
```

Et voil??, votre formulaire ne va s'afficher que si un utilisateur est connect?? !

Derni??re chose ?? faire, afficher les commentaires s'il y en a, pour a rien de plus simple, vous savez que votre variable `comments` stocke les commentaires actif, donc vous allez pouvoir l'utiliser pour afficher les commentaires sur la vue :

```twig
{# Article/show.html.twig #}

{% if comments|length > 0 %}
  <div class="show-comments mt-4">
    <h2>Commentaires: </h2>
    <div class="comments-list">
      {% for comment in comments %}
      {% include "Frontend/Article/Commentaires/_comment.html.twig" %}
      {% endfor %}
    </div>
  </div>
{% endif %}
```

Vous l'aurez compris, il faut maintenant cr??er le fichier partial `_comment.html.twig` pour afficher chaque commentaire :

```twig
{# Commentaires/_comment.html.twig #}

<div class="comment-item">
	<div class="comment-header">{{ comment.titre }}</div>
	<div class="comment-item-content">
		<em class="card-text">{{ comment.user.fullName }}</em>
		<p class="card-text">{{ comment.content }}</p>
		<div class="ratings">
			{% for number in range(1,5) %}
				{% if number <= comment.note %}
					<i class="fas fa-star rating-color"></i>
				{% else %}
					<i class="far fa-star rating-color"></i>
				{% endif %}
			{% endfor %}
		</div>
		<p class="card-text">
			<small class="text-muted">{{ comment.createdAt|ago }}</small>
		</p>
	</div>
</div>
```

**Attention**, ici nous avons utilis?? un filtre twig **`|ago`** qui n'existe pas par d??faut. Ce filtre va nous permettre de calculer depuis combien de temps le commentaire est post?? et d'afficher un message. Mais il faut rajouter un bundle pour pouvoir l'utiliser, c'est le bundle [knpTimeBundle](https://github.com/KnpLabs/KnpTimeBundle), et pour l'installer, il vous suffit de rentrer la commande :

```bash
composer require knplabs/knp-time-bundle
```

Une fois que vous avez install?? ce bundle, votre vue va fonctionner et vous verrez depuis combien de temps votre commentaire a ??t?? post??.

Voil?? pour la partie frontend des commentaires !

### Gestion backend des commentaires

Maintenant que nos utilisateurs peuvent ajouter des commentaires, nous allons devoir ajouter la gestion en admin des commentaires pour pouvoir les rendre inactif ou supprimer les commentaires si besoin.
