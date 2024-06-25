<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/Raphitpt/exoTechnique/main/resources/assets/logo/logo.svg" width="400" alt="Laravel LaFerme Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## À propos

LaFerme est une application web développée sur Laravel, avec Vue.js et Tailwind CSS. Cette application permet à la ferme de répertorier et de vendre ses animaux. On y retrouve les informations telles que :

-   Le nom
-   L'âge (en mois)
-   Le type (chien, cheval, brebis, cochon)
-   La race (labrador, frison, pottok, irish cob, mérinos, solognote)
-   Une description de l'animal
-   Le prix TTC / Lors de l'ajout de l'animal dans le back-office, le prix est **hors charges**
-   Des photos

Ceci est une V1 d'un projet fictif, que j'ai dû réaliser lors d'un exercice technique pour l'agence bordelaise Mink.

Temps passé : **16 heures**


## Installation

Tout d'abord, cloner le dépôt :

```sh
git clone https://github.com/Raphitpt/exoTechnique
```

Ensuite, aller dans le dossier :

```sh
cd ./exoTechnique
```

Installer les dépendances de Composer :

```sh
composer install
```

Installer les dépendances de Vite.JS, Vue.JS, TailwindCSS :

```sh
npm i
```

**Avant de démarrer le serveur**

Renommer le fichier **.env.example** en **.env**.

Ensuite, pour le système de connexion, j'utilise jwt-auth. Il faut donc créer la clé secrète en exécutant la commande :

```sh
php artisan jwt:secret
```

Pour importer la base de données, il faut faire une migration :

```sh
php artisan migrate
```

On peut importer des données d'animaux qui sont pré-définies :

```sh
php artisan db:seed
```

Pour l'import d'image, il faut faire un lien pour les dossiers :

```sh
php artisan storage:link
```

**Pour créer un compte back-office**

Il faut exécuter la commande suivante. Il vous sera demandé le **nom**, l'**email**, et le **mot de passe**.

_Un seul compte par email est possible_ :

```sh
php artisan app:create-back-account
```

**On peut désormais lancer le serveur** :

```sh
php artisan serve
npm run dev
```
