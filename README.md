# TPNoteSymfony

## 1. Liste des routes disponibles

| **Route**                        | **Méthode HTTP** | **Description**                                         |
|-----------------------------------|------------------|---------------------------------------------------------|
| `/login`                          | GET              | Affiche le formulaire de connexion                      |
| `/logout`                         | GET              | Permet de se déconnecter                               |
| `/register`                       | POST             | Permet de créer un nouvel utilisateur                   |
| `/user/profile`                   | GET              | Affiche le profil de l'utilisateur connecté            |
| `/user/profile/edit`              | POST             | Permet de mettre à jour les informations du profil     |
| `/user/reservations`              | GET              | Liste des réservations de l'utilisateur connecté       |
| `/user/reservation/new`           | POST             | Permet de créer une nouvelle réservation               |
| `/admin/users`                    | GET              | Liste des utilisateurs pour l'administrateur           |
| `/admin/user/{id}/edit`           | POST             | Permet de modifier un utilisateur (admin)              |
| `/admin/user/{id}/delete`         | DELETE           | Permet de supprimer un utilisateur (admin)             |
| `/admin/reservations`             | GET              | Liste des réservations pour l'administrateur           |

## 2. Exemples de requêtes (format JSON)

### 2.1. Créer un utilisateur (POST `/register`)

**Requête :**
POST /register
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "securepassword"
}


### 2.2. Connexion de l'utilisateur (POST /login)

**Requête :**
POST /login
Content-Type: application/json

{
    "username": "user@example.com",
    "password": "securepassword"
}


### 2.3. Créer une réservation (POST /user/reservation/new)

**Requête :**
POST /user/reservation/new
Content-Type: application/json
Authorization: Bearer JWT-Token-Here

{
    "date": "2024-12-15",
    "timeSlot": "18:00-20:00",
    "eventName": "Concert"
}

### 2.4. Liste des réservations de l'utilisateur (GET /user/reservations)
GET /user/reservations
Authorization: Bearer JWT-Token-Here



## 3. Instructions pour démarrer et tester le projet
### 3.1. Prérequis
Avant de démarrer le projet, assurez-vous que vous avez les éléments suivants installés sur votre machine :

PHP (version >= 8.0)
Composer (gestionnaire de dépendances PHP)
Symfony CLI (facultatif, mais recommandé)
Un serveur de base de données (MySQL, PostgreSQL, SQLite, etc.)

### 3.2. Installation
Cloner le projet depuis GitHub :

git clone https://github.com/BajoueHugo/TPNoteSymfony.git
cd TPNoteSymfony
Installer les dépendances avec Composer :

composer install
Créer la base de données :

Si vous n'avez pas encore configuré la base de données, créez-la et configurez les paramètres dans le fichier .env (par exemple, pour MySQL) :

DATABASE_URL="mysql://username:password@127.0.0.1:3306/database_name"
Mettre à jour la base de données :

Exécutez les migrations pour créer les tables nécessaires dans la base de données.

php bin/console doctrine:migrations:migrate

### 3.3. Démarrer le serveur de développement
Lancez le serveur Symfony en local :

symfony server:start
Vous pouvez maintenant accéder à votre application à l'adresse http://127.0.0.1:8000.

### 3.4. Test des API
Ouvrez Postman ou Insomnia.
Testez les différentes routes en utilisant les exemples de requêtes ci-dessus.
Utilisez le token JWT dans l'en-tête Authorization pour les routes protégées par l'authentification.

### 3.5. Test avec cURL (optionnel)
Exemple pour tester la route de création d'utilisateur avec cURL :

curl -X POST http://127.0.0.1:8000/register \
    -H "Content-Type: application/json" \
    -d '{"email":"user@example.com","password":"securepassword"}'
Cela devrait renvoyer une réponse comme :

{
    "message": "User registered successfully!"
}
### 3.6. Accès à l'interface admin
Se connecter en tant qu'administrateur à l'interface /login avec des identifiants administrateur (si vous avez configuré un utilisateur avec un rôle ROLE_ADMIN).
Gérer les utilisateurs via /admin/users.
Gérer les réservations via /admin/reservations.
