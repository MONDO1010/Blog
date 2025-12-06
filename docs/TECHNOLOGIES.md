# Technologies utilisées - Ets Modeste

Ce document explique de manière simple les technologies utilisées dans ce projet.

---

## Backend (Côté serveur)

### PHP 8.2+
**C'est quoi ?** Le langage de programmation qui fait tourner le site côté serveur.

**À quoi ça sert ?** Quand tu visites une page, PHP génère le HTML que ton navigateur affiche. Il gère aussi la logique : connexion utilisateur, ajout au panier, enregistrement en base de données, etc.

---

### Laravel 11
**C'est quoi ?** Un framework PHP (une boîte à outils) qui structure le code.

**À quoi ça sert ?** Au lieu d'écrire tout le code à la main, Laravel fournit des fonctions prêtes à l'emploi :
- **Routes** : Définir quelle page afficher pour quelle URL (`/produits`, `/admin`, etc.)
- **Controllers** : Organiser la logique métier (afficher produits, ajouter au panier...)
- **Models** : Représenter les données (Produit, Catégorie, User...)
- **Views (Blade)** : Les templates HTML avec du PHP simplifié
- **Migrations** : Créer/modifier les tables de la base de données

**Fichiers clés :**
- `routes/web.php` - Toutes les URLs du site
- `app/Http/Controllers/` - La logique des pages
- `app/Models/` - Les modèles de données
- `resources/views/` - Les fichiers HTML/Blade

---

### Laravel Jetstream + Fortify
**C'est quoi ?** Des packages Laravel pour l'authentification.

**À quoi ça sert ?**
- **Fortify** : Gère la logique de connexion/inscription (vérification mot de passe, etc.)
- **Jetstream** : Fournit les pages prêtes (login, register, profil utilisateur)

Tu n'as pas à coder toi-même le système de connexion, c'est déjà fait !

---

### MySQL / MariaDB
**C'est quoi ?** Une base de données relationnelle.

**À quoi ça sert ?** Stocker toutes les données du site :
- Les produits (nom, prix, stock, description...)
- Les utilisateurs (email, mot de passe hashé...)
- Les catégories, tags, panier...

**Comment ça marche ?** Les données sont organisées en tables (comme des tableaux Excel) avec des relations entre elles. Par exemple, un Produit appartient à une Catégorie.

---

## Frontend (Côté navigateur)

### HTML + CSS
**C'est quoi ?** Les langages de base du web.

**À quoi ça sert ?**
- **HTML** : Structure la page (titres, paragraphes, images, boutons...)
- **CSS** : Met en forme (couleurs, tailles, positions, animations...)

---

### Bootstrap 4
**C'est quoi ?** Une bibliothèque CSS préfaite par Twitter.

**À quoi ça sert ?** Fournit des styles prêts à l'emploi :
- Grille responsive (colonnes qui s'adaptent à l'écran)
- Boutons, formulaires, cartes, alertes...
- Design cohérent sans tout coder à la main

**Exemple :** `class="btn btn-primary"` = un bouton bleu stylé

---

### CSS personnalisé

Le projet utilise plusieurs fichiers CSS custom :

| Fichier | Usage |
|---------|-------|
| `neumorphism.css` | Design "soft UI" avec ombres douces pour le site client |
| `admin-flat.css` | Design épuré et moderne pour l'administration |

---

### JavaScript (Vanilla)
**C'est quoi ?** Le langage qui rend les pages interactives.

**À quoi ça sert dans ce projet ?**
- `particles.js` : Animation de particules en arrière-plan
- Aperçu d'image avant upload
- Confirmations de suppression
- Interactions diverses

---

### Font Awesome 5
**C'est quoi ?** Une bibliothèque d'icônes.

**À quoi ça sert ?** Afficher des icônes partout sur le site :
- `<i class="fas fa-shopping-cart"></i>` = icône panier
- `<i class="fas fa-user"></i>` = icône utilisateur

---

## Outils de développement

### Composer
**C'est quoi ?** Le gestionnaire de packages PHP.

**À quoi ça sert ?** Installer et gérer les dépendances PHP (Laravel, Jetstream, etc.)

**Commande principale :** `composer install`

---

### NPM (Node Package Manager)
**C'est quoi ?** Le gestionnaire de packages JavaScript.

**À quoi ça sert ?** Installer les outils frontend (Vite, etc.)

**Commandes principales :**
- `npm install` - Installer les dépendances
- `npm run dev` - Lancer le serveur de développement
- `npm run build` - Compiler pour la production

---

### Vite
**C'est quoi ?** Un outil de build frontend ultra-rapide.

**À quoi ça sert ?**
- Compiler les assets (CSS, JS)
- Hot reload en développement (la page se rafraîchit automatiquement quand tu modifies un fichier)

---

### Artisan
**C'est quoi ?** L'outil en ligne de commande de Laravel.

**À quoi ça sert ?** Exécuter des tâches courantes :
- `php artisan serve` - Démarrer le serveur
- `php artisan migrate` - Créer les tables en BDD
- `php artisan make:controller` - Générer du code

---

## Architecture du projet

```
Blog/
├── app/                    # Code PHP principal
│   ├── Http/
│   │   ├── Controllers/    # Logique des pages
│   │   ├── Middleware/     # Filtres (auth, admin...)
│   │   └── Requests/       # Validation des formulaires
│   └── Models/             # Modèles de données
│
├── config/                 # Configuration de l'app
│
├── database/
│   ├── migrations/         # Structure des tables
│   └── seeders/            # Données de test
│
├── public/                 # Fichiers accessibles publiquement
│   ├── css/                # Feuilles de style
│   ├── js/                 # Scripts JavaScript
│   └── storage/            # Lien vers les uploads
│
├── resources/
│   └── views/              # Templates Blade (HTML)
│       ├── admin/          # Pages d'administration
│       ├── layouts/        # Layouts communs
│       └── shop/           # Pages boutique
│
├── routes/
│   └── web.php             # Définition des URLs
│
├── storage/                # Fichiers uploadés, cache, logs
│
└── .env                    # Variables d'environnement
```

---

## Flux d'une requête

Voici ce qui se passe quand un visiteur accède à `/produit/5` :

1. **Route** (`web.php`) : Trouve quelle fonction appeler
2. **Middleware** : Vérifie les permissions si nécessaire
3. **Controller** : Récupère le produit #5 en base de données
4. **Model** : Interagit avec la table `produits`
5. **View** : Génère le HTML avec les données du produit
6. **Navigateur** : Affiche la page au visiteur

---

## Résumé

| Techno | Rôle |
|--------|------|
| PHP + Laravel | Logique serveur |
| MySQL | Stockage données |
| Blade | Templates HTML |
| Bootstrap | Mise en page responsive |
| CSS custom | Design personnalisé |
| JavaScript | Interactions client |
| Composer | Packages PHP |
| NPM + Vite | Build frontend |
