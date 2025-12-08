# Guide d'installation - Ets Modeste

Ce guide explique comment installer et configurer le projet après l'avoir cloné depuis GitHub.

---

## Prérequis

Avant de commencer, assure-toi d'avoir installé :

| Outil | Version minimum | Comment vérifier |
|-------|-----------------|------------------|
| PHP | 8.2+ | `php -v` |
| Composer | 2.0+ | `composer -V` |
| Node.js | 18+ | `node -v` |
| NPM | 9+ | `npm -v` |
| MySQL/MariaDB | 5.7+ / 10.3+ | `mysql --version` |

### Installation des prérequis (Ubuntu/Debian)

```bash
# PHP et extensions requises
sudo apt update
sudo apt install php php-cli php-mbstring php-xml php-curl php-mysql php-zip php-gd unzip

# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Node.js (via NodeSource)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install nodejs

# MySQL
sudo apt install mysql-server
```

---

## Étape 1 : Cloner le projet

```bash
git clone https://github.com/ton-username/ets-modeste.git
cd ets-modeste
```

---

## Étape 2 : Installer les dépendances PHP

```bash
composer install
```

Cette commande lit le fichier `composer.json` et télécharge tous les packages PHP nécessaires (Laravel, Jetstream, etc.) dans le dossier `vendor/`.

**Si tu as une erreur de mémoire :**
```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

---

## Étape 3 : Installer les dépendances JavaScript

```bash
npm install
```

Cette commande lit le fichier `package.json` et télécharge les packages JS dans `node_modules/`.

---

## Étape 4 : Configurer l'environnement

### 4.1 Copier le fichier d'environnement

```bash
cp .env.example .env
```

### 4.2 Générer la clé d'application

```bash
php artisan key:generate
```

### 4.3 Configurer la base de données

Ouvre le fichier `.env` et modifie ces lignes :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ets_modeste
DB_USERNAME=ton_utilisateur
DB_PASSWORD=ton_mot_de_passe
```

### 4.4 Créer la base de données

Connecte-toi à MySQL :

```bash
mysql -u root -p
```

Puis crée la base :

```sql
CREATE DATABASE ets_modeste CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

---

## Étape 5 : Créer les tables

```bash
php artisan migrate
```

Cette commande lit tous les fichiers de migration dans `database/migrations/` et crée les tables correspondantes.

**Si tu veux aussi les données de test :**
```bash
php artisan migrate --seed
```

Ou pour tout remettre à zéro :
```bash
php artisan migrate:fresh --seed
```

---

## Étape 6 : Configurer le stockage

Laravel stocke les fichiers uploadés (images produits) dans `storage/app/public`. Pour les rendre accessibles depuis le navigateur :

```bash
php artisan storage:link
```

Cela crée un lien symbolique `public/storage` → `storage/app/public`.

**Vérifier que le dossier existe :**
```bash
mkdir -p storage/app/public/produits
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## Étape 7 : Peupler la base de données

Le projet inclut des seeders pour créer des données initiales (utilisateurs, catégories, tags, produits).

### Option A : Exécuter tous les seeders

```bash
php artisan db:seed
```

Cette commande exécute les seeders suivants :
- `AdminSeeder` : Crée un administrateur et un utilisateur test
- `CategoryTableSeeder` : Crée les catégories de produits
- `TagTableSeeder` : Crée les tags
- `ProduitsTableSeeder` : Crée des produits de démonstration

### Option B : Migration + Seed en une commande

```bash
php artisan migrate --seed
```

### Option C : Réinitialiser et repeupler

```bash
php artisan migrate:fresh --seed
```

### Option D : Créer manuellement avec Tinker

```bash
php artisan tinker
```

Puis :

```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@exemple.com';
$user->password = bcrypt('motdepasse123');
$user->is_admin = true;
$user->save();
exit
```

---

## Étape 8 : Lancer le projet

### Mode développement (2 terminaux)

**Terminal 1 - Serveur PHP :**
```bash
php artisan serve
```
Le site sera accessible sur `http://127.0.0.1:8000`

**Terminal 2 - Serveur Vite (assets) :**
```bash
npm run dev
```
Permet le hot-reload des fichiers CSS/JS.

### Mode production

```bash
npm run build
php artisan serve
```

---

## Vérification

Une fois le serveur lancé, vérifie que tout fonctionne :

| URL | Ce que tu dois voir |
|-----|---------------------|
| `http://127.0.0.1:8000` | Page d'accueil de la boutique |
| `http://127.0.0.1:8000/login` | Page de connexion |
| `http://127.0.0.1:8000/admin` | Dashboard admin (après connexion) |

---

## Résolution des problèmes courants

### Erreur "Class not found"

```bash
composer dump-autoload
php artisan cache:clear
php artisan config:clear
```

### Erreur de permissions

```bash
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Page blanche / Erreur 500

Vérifie les logs :
```bash
tail -f storage/logs/laravel.log
```

### Les styles ne s'affichent pas

```bash
npm run build
# ou en dev :
npm run dev
```

### Erreur de connexion à la base de données

1. Vérifie que MySQL est lancé : `sudo systemctl status mysql`
2. Vérifie les identifiants dans `.env`
3. Vérifie que la base existe : `mysql -u root -p -e "SHOW DATABASES;"`

### Les images ne s'affichent pas

```bash
php artisan storage:link
ls -la public/storage  # Doit pointer vers storage/app/public
```

---

## Commandes utiles

| Commande | Description |
|----------|-------------|
| `php artisan serve` | Démarrer le serveur |
| `php artisan migrate` | Exécuter les migrations |
| `php artisan migrate:fresh` | Réinitialiser la BDD |
| `php artisan db:seed` | Insérer données de test |
| `php artisan cache:clear` | Vider le cache |
| `php artisan route:list` | Lister toutes les routes |
| `php artisan tinker` | Console interactive PHP |
| `npm run dev` | Serveur Vite (développement) |
| `npm run build` | Compiler pour production |

---

## Structure des identifiants par défaut

Si tu utilises les seeders (`php artisan db:seed`), les comptes suivants sont créés :

| Type | Nom | Email | Mot de passe |
|------|-----|-------|--------------|
| Administrateur | Admin Zute | admin@zute.com | password |
| Utilisateur | Utilisateur Test | user@zute.com | password |

**Important :** Change ces identifiants en production !

---

## Mise en production

Pour déployer en production :

1. Configurer `.env` avec `APP_ENV=production` et `APP_DEBUG=false`
2. Compiler les assets : `npm run build`
3. Optimiser Laravel :
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. Configurer un serveur web (Apache/Nginx) pour pointer vers `public/`

---

## Besoin d'aide ?

- Documentation Laravel : https://laravel.com/docs
- Issues du projet : [lien GitHub]
