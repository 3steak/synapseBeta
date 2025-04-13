# Synapse - Application de Gestion et de Traitement de Recherches Scientifiques

## Description
Synapse est une application web interne sécurisée destinée aux scientifiques, permettant de gérer et de traiter des recherches scientifiques via des fonctions Python prédéfinies. Elle propose des fonctionnalités d'authentification sécurisée, un historique des recherches et une interface d'administration pour les super administrateurs.

## Fonctionnalités principales
- **Authentification sécurisée** avec 2FA (Double authentification) via Laravel Fortify.
- **Soumission de recherches scientifiques** exécutées par des scripts Python.
- **Consultation de l'historique des recherches** avec filtres avancés.
- **Gestion des utilisateurs** (création, suppression, gestion des rôles) par un super administrateur.
- **Tableau de bord scientifique** avec visualisation des résultats des recherches.
- **Exécution des recherches** via une API Python synchrone ou asynchrone.

## Stack Technique
- **Frontend** : Laravel Blade, Tailwind CSS
- **Backend** : Laravel 10+ (PHP 8.1+)
- **Scripts Python** : FastAPI / Flask (exécutés via API interne ou queue)
- **Base de données** : MySQL / PostgreSQL (via Laravel Eloquent ORM)
- **Authentification** : Laravel Fortify avec 2FA (TOTP ou email/SMS OTP)
- **Environnement de développement** : Visual Studio Code

## Prérequis
- PHP 8.1+
- Composer
- Node.js + npm
- MySQL ou PostgreSQL
- Python (pour les scripts métier)
- Laravel 10+

## Installation

1. Clonez ce dépôt dans votre répertoire local :
    ```bash
    git clone https://github.com/votre-utilisateur/synapse.git
    ```
2. Installez les dépendances PHP :
    ```bash
    cd synapse
    composer install
    ```
3. Installez les dépendances JavaScript :
    ```bash
    npm install
    ```
4. Créez et configurer votre fichier .env
Modifiez les variables d'environnement pour la connexion à la base de données et autres configurations nécessaires.
5. Générez la clé d'application Laravel :
    ```bash
    php artisan key:generate
    ```
6. Exécutez les migrations de la base de données :
    ```bash
    php artisan migrate
    ```
7. Lancer le server en local :
    ```bash
    php artisan serve
    ```
8. Si vous utilisez des scripts Python, configurez l'API Python (FastAPI ou Flask) pour exécuter les fonctions scientifiques.

## Tests
Les tests sont écrits en suivant la méthodologie TDD (Test Driven Development). Vous pouvez exécuter les tests de l'application à l'aide de la commande suivante :

    ```bash
    php artisan test
    ```
Cela exécutera tous les tests définis dans le projet et vous fournira un retour détaillé sur l'état de chaque fonctionnalité.


## Contribuer
Si vous souhaitez contribuer au projet **Synapse**, voici les étapes à suivre :

1. **Fork** le dépôt.
2. Créez une **branche** pour votre fonctionnalité (`git checkout -b feature-nom-de-la-fonctionnalité`).
3. **Commit** vos changements (`git commit -am 'Ajout de la fonctionnalité'`).
4. Poussez votre branche (`git push origin feature-nom-de-la-fonctionnalité`).
5. Ouvrez une **pull request** pour intégrer vos changements.

Assurez-vous que les tests passent avant de soumettre votre pull request.

## License
Ce projet est sous la **licence MIT**. Vous pouvez consulter le fichier [LICENSE](LICENSE) pour plus de détails.

## Auteurs
- **Cyprien** - Développeur principal