<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[WebReinvent](https://webreinvent.com/)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Jump24](https://jump24.co.uk)**
-   **[Redberry](https://redberry.international/laravel/)**
-   **[Active Logic](https://activelogic.com)**
-   **[byte5](https://byte5.de)**
-   **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Plateforme de Réservation de Salles et Locations

## Description

Une plateforme web moderne permettant la réservation en ligne de salles de fêtes et de locations, gérée par des agences. Le système offre une interface intuitive pour les clients et un espace d'administration complet pour les gestionnaires.

## Fonctionnalités Principales

### Pour les Clients

-   Recherche et filtrage des salles et locations
-   Système de réservation en ligne
-   Gestion des réservations personnelles
-   Notifications par email
-   Système de paiement intégré

### Pour les Managers

-   Gestion des agences
-   Administration des salles et locations
-   Validation des réservations
-   Tableau de bord analytique
-   Gestion des utilisateurs

### Pour les Administrateurs

-   Supervision complète du système
-   Gestion des managers
-   Configuration globale
-   Rapports et statistiques

## Technologies Utilisées

### Backend

-   Laravel 12
-   PHP 8.2+
-   MySQL
-   Blade/Livewire

### Frontend

-   Alpine.js
-   Tailwind CSS
-   Bootstrap
-   HTML5/CSS3

## Structure du Projet

```
├── app/
│   ├── Models/
│   ├── Http/Controllers/
│   ├── Services/
│   └── Repositories/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
└── tests/
```

## Installation

1. Cloner le repository

```bash
git clone [URL_DU_REPO]
```

2. Installer les dépendances

```bash
composer install
npm install
```

3. Configurer l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

4. Configurer la base de données

```bash
php artisan migrate
php artisan db:seed
```

5. Lancer le serveur de développement

```bash
php artisan serve
npm run dev
```

## Fonctionnalités Détaillées

### Système de Réservation

-   Vérification en temps réel des disponibilités
-   Processus de réservation en plusieurs étapes
-   Système de statuts (Pending, Accepted, Booked, Completed)
-   Notifications automatiques par email
-   Calcul automatique des prix

### Gestion des Locations

-   Caractéristiques détaillées (nom, description, localisation, capacité)
-   Système de photos multiples
-   Filtres de recherche avancés
-   Calcul des prix basé sur la durée

### Gestion des Salles de Fêtes

-   Gestion des types d'événements
-   Système de capacité
-   Taxe de séjour
-   Gestion des disponibilités

## Sécurité

-   Authentification sécurisée
-   Protection CSRF
-   Validation des données
-   Gestion des permissions
-   Chiffrement des données sensibles

## Contribution

Les contributions sont les bienvenues ! Veuillez suivre ces étapes :

1. Fork le projet
2. Créer une branche pour votre fonctionnalité
3. Commiter vos changements
4. Pousser vers la branche
5. Ouvrir une Pull Request

## Licence

[À DÉFINIR]

## Contact

[À DÉFINIR]
