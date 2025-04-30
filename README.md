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

# Structure du Projet - Plateforme de Réservation d'Hôtel

Ce document décrit l'architecture et l'organisation des dossiers du projet de plateforme de réservation d'hôtels, de salles de fêtes et de chambres.

## Structure des Dossiers

-   **/app**

    -   **Objectif :** Contient la logique métier principale de l'application, suivant le modèle MVC.
    -   **Contenu :**
        -   Modèles (ex. Hotel.php, Room.php, User.php)
        -   Contrôleurs (dans Http/Controllers)
        -   Middleware (dans Http/Middleware)
        -   Services et utilitaires
    -   **Techno :** PHP, Laravel
    -   **Bonnes pratiques :**
        -   Suivre les conventions de nommage PSR-4
        -   Un modèle par entité
        -   Utiliser les traits pour la réutilisation de code
    -   **Améliorations :**
        -   Ajouter des repositories pour séparer la logique d'accès aux données
        -   Implémenter des services pour les opérations complexes

-   **/app/Models**

    -   **Objectif :** Contient les modèles Eloquent qui représentent les tables de la base de données.
    -   **Contenu :**
        -   EventHall.php (Salles de fêtes)
        -   Hotel.php
        -   Room.php (Chambres)
        -   User.php
        -   Ville.php
    -   **Techno :** Eloquent ORM, PHP
    -   **Bonnes pratiques :**
        -   Définir les relations entre modèles clairement
        -   Utiliser les scopes pour les requêtes fréquentes
        -   Définir les propriétés $fillable ou $guarded
    -   **Améliorations :**
        -   Ajouter des modèles manquants (Reservation, Task, Notification)

-   **/app/Http/Controllers**

    -   **Objectif :** Contient les contrôleurs qui gèrent les requêtes HTTP
    -   **Contenu :**
        -   Contrôleurs pour chaque entité (HotelController, RoomController, etc.)
        -   Contrôleurs d'authentification
    -   **Techno :** Laravel, PHP
    -   **Bonnes pratiques :**
        -   Limiter les méthodes à 7 actions RESTful standards
        -   Valider les entrées avec Request
        -   Renvoyer des réponses formatées
    -   **Améliorations :**
        -   Implémenter une API REST complète
        -   Utiliser des Resource classes pour la transformation de données

-   **/config**

    -   **Objectif :** Contient les fichiers de configuration de l'application
    -   **Contenu :**
        -   Fichiers de configuration (\*.php)
        -   Configuration de la BDD, mail, services externes
    -   **Techno :** PHP
    -   **Bonnes pratiques :**
        -   Ne pas stocker de secrets directement dans les fichiers
        -   Utiliser des variables d'environnement
    -   **Améliorations :**
        -   Documentation des options disponibles

-   **/database**

    -   **Objectif :** Contient les migrations, seeders et factories pour la base de données
    -   **Contenu :**
        -   Migrations (création de tables)
        -   Seeders (données de test)
        -   Factories (génération de données)
    -   **Techno :** PHP, Laravel Migrations
    -   **Bonnes pratiques :**
        -   Nommer les migrations de façon descriptive
        -   Documenter les champs complexes
        -   Prévoir les rollbacks
    -   **Améliorations :**
        -   Ajouter plus de seeders pour faciliter le développement
        -   Mettre à jour les migrations avec les nouvelles fonctionnalités

-   **/public**

    -   **Objectif :** Point d'entrée de l'application et stockage des fichiers publics
    -   **Contenu :**
        -   index.php (point d'entrée)
        -   CSS, JS compilés
        -   Images et médias accessibles publiquement
    -   **Techno :** PHP, Assets web
    -   **Bonnes pratiques :**
        -   Ne pas stocker de code applicatif dans ce dossier
        -   Organiser les assets par type
    -   **Améliorations :**
        -   Optimiser les images pour le web
        -   Mettre en place un CDN pour les assets statiques

-   **/resources**

    -   **Objectif :** Contient les fichiers de ressources non compilés
    -   **Contenu :**
        -   Vues Blade (\*.blade.php)
        -   CSS/SCSS source
        -   JavaScript non compilé
        -   Fichiers de langue
    -   **Techno :** Blade, CSS, JavaScript, Alpine.js
    -   **Bonnes pratiques :**
        -   Organiser les vues par section
        -   Utiliser des composants réutilisables
        -   Séparer la logique et la présentation
    -   **Améliorations :**
        -   Implémenter des composants Blade/Livewire

-   **/routes**

    -   **Objectif :** Définit les routes de l'application
    -   **Contenu :**
        -   web.php (routes web)
        -   api.php (routes API)
        -   console.php (commandes personnalisées)
        -   auth.php (routes d'authentification)
    -   **Techno :** Laravel Routes
    -   **Bonnes pratiques :**
        -   Grouper les routes par préfixe ou middleware
        -   Nommer les routes
        -   Utiliser des contrôleurs dédiés
    -   **Améliorations :**
        -   Organiser les routes par domaine fonctionnel
        -   Ajouter une documentation des API

-   **/storage**

    -   **Objectif :** Stockage des fichiers générés par l'application
    -   **Contenu :**
        -   Logs
        -   Fichiers téléchargés
        -   Cache
        -   Sessions
    -   **Techno :** Laravel Storage
    -   **Bonnes pratiques :**
        -   Configurer correctement les permissions
        -   Utiliser le système de disques de Laravel
    -   **Améliorations :**
        -   Mettre en place une stratégie de rotation des logs
        -   Configurer un stockage cloud pour les uploads

-   **/tests**

    -   **Objectif :** Contient les tests automatisés
    -   **Contenu :**
        -   Tests unitaires
        -   Tests fonctionnels
        -   Tests d'intégration
    -   **Techno :** PHPUnit, Laravel Testing
    -   **Bonnes pratiques :**
        -   Couvrir les fonctionnalités critiques
        -   Organiser les tests par fonctionnalité
        -   Utiliser des factories pour générer des données de test
    -   **Améliorations :**
        -   Augmenter la couverture de tests
        -   Ajouter des tests d'interface utilisateur

-   **/vendor**
    -   **Objectif :** Contient les dépendances installées par Composer
    -   **Contenu :**
        -   Packages externes
        -   Laravel framework
        -   Bibliothèques PHP
    -   **Techno :** Composer
    -   **Bonnes pratiques :**
        -   Ne jamais modifier directement les fichiers
        -   Exclure du contrôle de version
        -   Utiliser composer.lock pour des installations cohérentes
    -   **Améliorations :**
        -   Régulièrement mettre à jour les dépendances
        -   Auditer les dépendances pour des problèmes de sécurité

## Conventions et Pratiques Générales

-   Suivre les conventions de nommage Laravel (PascalCase pour les classes, snake_case pour les variables)
-   Utiliser l'injection de dépendances plutôt que les façades quand c'est possible
-   Documenter le code avec des commentaires PHPDoc
-   Respecter les principes SOLID
-   Utiliser la validation des formulaires côté serveur
