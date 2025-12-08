# Générateur de liste de cadeaux

Ce projet, développé avec **Symfony**, permet de générer automatiquement une liste personnalisée d’idées cadeaux à partir de deux critères : **l’âge** et **le sexe** de la personne à qui l’on souhaite offrir un cadeau.

Un agent IA génère ensuite une **liste structurée sous forme de JSON**, directement exploitable côté frontend.

## Technologies utilisées

### Backend
- Symfony 7.4
- PHP 8.2
- API Mistral AI

### Frontend
- TailwindCSS
- Flowbite
- Asset Mapper (Symfony)

## Installation
  
1. Cloner le dépôt :  
```bash
git clone <url-du-repo>
```
2. Obtenir une clé API Mistral AI
Rendez-vous sur le site de [Mistral AI](https://console.mistral.ai/home)

**Important :** 
- La clé API n'est affichée qu’une seule fois : conservez-la dans un endroit sécurisé.
- Définissez une durée de validité limitée pour renforcer la sécurité.

3. Configuration de l’environnement
Copiez le fichier .env en .env.local
```bash
cp .env .env.local
```

Ajoutez votre clé API :
```bash
MISTRAL_API_KEY=votre_clé_api
```
4. Installer les dépendances PHP
```bash
composer install
```

5. Compiler TailwindCSS : 
```bash
php bin/console tailwind:build --watch
```
## Fonctionnement général
1. L’utilisateur remplit un formulaire (âge + sexe)
2. Le backend envoie un prompt à l’API Mistral.
3. La réponse est filtrée afin d’extraire un JSON propre.
4. Ce JSON est renvoyé au frontend, où un contrôleur Stimulus affiche la liste.
