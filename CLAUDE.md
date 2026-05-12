## Objectif et Rôle
Agis en tant que Lead Développeur Full Stack et formateur expérimenté. 

Accompagne l'utilisateur dans la structuration et la création de son projet de soutenance (mémoire et application web). 

Privilégie la pédagogie et la compréhension plutôt que la production brute de code. L'utilisateur doit apprendre par lui-même grâce à tes conseils.

## Méthodologie de Travail
Analyse les besoins du projet et aide à définir une architecture robuste.

Pose des questions guidées pour amener l'utilisateur à trouver ses propres solutions techniques.

Si l'utilisateur demande du code, explique d'abord la logique et les concepts avant de donner des exemples minimalistes.

Aide à la rédaction du mémoire en structurant les sections techniques et en conseillant sur la démarche scientifique.


## Interaction et Feedback
Sois exigeant mais bienveillant, comme un mentor professionnel.
Vérifie régulièrement la compréhension avant de passer à l'étape suivante.

Utilise des analogies pour expliquer des concepts complexes.


## Portée du Projet

Couvre tous les aspects : Front-end, Back-end, DevOps, documentation.

Assure-toi que les choix technologiques sont justifiés et cohérents avec les objectifs de la soutenance.

Ton Professionnel, pédagogique et encourageant. Langage clair et technique sans jargon inexpliqué. Posture de mentor qui transmet son savoir-faire.

# WheelBuilds — Trame complète du projet
**Stack : Laravel + Sanctum SPA + SvelteKit + Cloudflare R2 + Laravel Cloud**
**Dernière mise à jour : 12 mai 2026**

---

## 1. BASE DE DONNÉES & MIGRATIONS

### Migrations
- [x] `makes` — marques de voitures
- [x] `car_models` — modèles de voitures
- [ ] ~~`generations`~~ — **supprimée, remplacée par `year` dans builds**
- [x] `wheel_brands` — marques de jantes
- [x] `wheels` — modèles de jantes
- [x] `users` — utilisateurs
- [ ] `builds` — **à modifier : remplacer `generation_id` par `car_model_id` + ajouter `year`**
- [x] `build_photos` — photos des builds (colonne `display_order`)
- [x] `likes` — likes des builds

### Seeders
- [x] `MakeSeeder` — 22 marques de voitures
- [x] `CarModelSeeder` — modèles par marque
- [x] `WheelBrandSeeder` — 16 marques de jantes
- [ ] `WheelSeeder` — modèles de jantes par marque

---

## 2. BACK-END LARAVEL

### Authentification (Sanctum SPA)
- [x] Register
- [x] Login
- [x] Logout
- [x] Verify email
- [x] Reset password
- [x] Tests auth complets

### Modèles Eloquent & Relations
- [ ] `Make` — hasMany CarModels
- [ ] `CarModel` — belongsTo Make · hasMany Builds
- [ ] `WheelBrand` — hasMany Wheels
- [ ] `Wheel` — belongsTo WheelBrand · hasMany Builds
- [ ] `User` — hasMany Builds · belongsToMany Builds (likes)
- [ ] `Build` — belongsTo User · belongsTo CarModel · belongsTo Wheel · hasMany BuildPhotos · belongsToMany Users (likes)
- [ ] `BuildPhoto` — belongsTo Build
- [ ] `Like` — belongsTo User · belongsTo Build

### CRUD Builds
- [ ] `GET /api/builds` — feed paginé (reverse chronologique)
- [ ] `GET /api/builds/{id}` — détail d'un build
- [ ] `POST /api/builds` — créer un build (auth requis)
- [ ] `DELETE /api/builds/{id}` — supprimer son build (auth requis)
- [ ] Policy — un user ne peut supprimer que ses propres builds
- [ ] Validation des données en entrée (FormRequest)

### Upload Photos
- [ ] Cloudflare R2 — bucket créé + clés API générées
- [ ] `composer require league/flysystem-aws-s3-v3`
- [ ] `config/filesystems.php` — disk R2 configuré
- [ ] `.env` — variables R2 ajoutées
- [ ] Upload photos vers R2 — `Storage::disk('r2')->put(...)`
- [ ] Validation — max 5 photos · formats JPG/PNG · max 5Mo/photo
- [ ] Gestion de l'ordre — `display_order`
- [ ] Suppression des photos R2 quand un build est supprimé

### Filtrage & Recherche
- [ ] `GET /api/makes` — liste des marques
- [ ] `GET /api/makes/{id}/car-models` — modèles par marque
- [ ] `GET /api/wheel-brands` — liste des marques de jantes
- [ ] `GET /api/wheel-brands/{id}/wheels` — modèles par marque de jante
- [ ] Filtrage builds par marque
- [ ] Filtrage builds par modèle
- [ ] Filtrage builds par année
- [ ] Filtrage builds par marque de jante
- [ ] Filtrage builds par modèle de jante

### Likes
- [ ] `POST /api/builds/{id}/like` — liker un build (auth requis)
- [ ] `DELETE /api/builds/{id}/like` — unliker un build (auth requis)
- [ ] Contrainte unique — un user ne like qu'une fois par build

### Paiement fictif
- [ ] Intégration Stripe sandbox (mode test)
- [ ] Controller paiement
- [ ] Route paiement

### Sécurité Back-end
- [ ] Validation des entrées sur tous les endpoints (FormRequest)
- [ ] Rate limiting sur les routes sensibles
- [ ] CORS configuré pour le front React
- [ ] Headers de sécurité
- [ ] Protection CSRF via Sanctum

### Tests Back-end
- [x] Tests auth (login, logout, register, verify email, reset password)
- [ ] Tests CRUD builds
- [ ] Tests upload photos
- [ ] Tests likes
- [ ] Tests filtrage
- [ ] Couverture ≥ 50%

### Industrialisation Back
- [ ] CI back — GitHub Actions (tests automatisés sur push)
- [ ] Documentation API — commentaires PHPDoc sur les controllers
- [ ] Changelog structuré (CHANGELOG.md)

---

## 3. FRONT-END SVELTEKIT

### Setup
- [ ] SvelteKit — init projet (`npm create svelte@latest`)
- [ ] `fetch` natif configuré (baseURL + credentials: 'include')
- [ ] Sanctum SPA — cookie CSRF configuré
- [ ] Tailwind CSS
- [ ] ESLint + Prettier
- [ ] Structure des dossiers (components, routes, lib, services)

### Pages publiques
- [ ] Page feed — liste builds paginée + filtres en cascade
- [ ] Page détail build — galerie photos, infos véhicule/jante, likes
- [ ] Page profil utilisateur — ses builds + stats

### Pages authentifiées
- [ ] Page login
- [ ] Page register
- [ ] Page verify email
- [ ] Page reset password
- [ ] Formulaire post — sélecteurs make→model + upload photos + dimensions
- [ ] Page mon profil

### Composants Svelte
- [ ] Navbar — logo, liens, avatar, bouton "Partager un build"
- [ ] BuildCard — photo, véhicule, jante, dimensions, likes, user
- [ ] PhotoGallery — galerie avec navigation
- [ ] FilterBar — filtres en cascade marque→modèle + jante
- [ ] LikeButton — toggle like/unlike
- [ ] UploadZone — drag & drop, preview, max 5 photos
- [ ] Pagination

### UX & Design
- [ ] Wireframes Figma — feed, détail build, formulaire post, profil
- [ ] Charte graphique — couleurs, typographie
- [ ] Responsive mobile
- [ ] Accessibilité — balises ARIA, contraste, navigation clavier

### Sécurité Front
- [ ] Headers HTTP sécurisés
- [ ] CSP (Content Security Policy)
- [ ] Protection XSS

### SEO
- [ ] Balises meta (title, description) sur chaque page
- [ ] Open Graph (partage réseaux sociaux)
- [ ] Mots-clés pertinents
- [ ] Audit SEOptimer — score ≥ 70%

### Tests Front
- [ ] Tests unitaires composants (Vitest + @testing-library/svelte)
- [ ] Tests fonctionnels
- [ ] Plan de test documenté

---

## 4. DÉPLOIEMENT & DEVOPS

### Infrastructure
- [ ] Nom de domaine réservé
- [ ] DNS configurés
- [ ] Certificat SSL/TLS valide
- [ ] Laravel Cloud — environnement staging
- [ ] Laravel Cloud — environnement production
- [ ] Variables d'environnement prod configurées
- [ ] Base de données production configurée

### CI/CD
- [ ] GitHub Actions — pipeline test → deploy staging → deploy prod
- [ ] Déploiement automatisé opérationnel

### Supervision
- [ ] Journalisation logs applicatifs
- [ ] Alertes en cas d'erreur
- [ ] Outils de sauvegarde

---

## 5. MÉMOIRE — BLOC 1 (évalué sur pièces)

- [ ] **E1** — Reformulation demande client · public cible · enjeux · problématique
- [ ] **E2** — Planning prévisionnel + ébauche de budget
- [ ] **E3** — Note de synthèse préconisations techniques (justifier SvelteKit, Laravel, Sanctum, R2)
- [ ] **E4** — Procédure environnement dev (Git workflow, IDE, stack locale)
- [ ] **E5** — Méthode agile choisie + justification
- [ ] **E6** — Trame compte rendu d'activité (template sprint/kanban)
- [ ] **E7** — Wireframes Figma commentés (au moins une vue complète)
- [ ] **E8** — Dossier de conception : MCD · MPD · cas d'utilisation · architecture logicielle

---

## 6. MÉMOIRE — BLOC 2 (front-end)

- [ ] **C13** — Interface utilisateur — composants, accessibilité, responsive
- [ ] **C14** — Charte graphique — couleurs, typographie, identité visuelle
- [ ] **C15** — Pages et navigation — routing, UX
- [ ] **C16** — Sécurité front — headers, CSP, CORS
- [ ] **C17** — Consommation API Laravel depuis React (format échange, auth)
- [ ] **C18** — Plan de tests front — unitaires + fonctionnels
- [ ] **C19** — Industrialisation front — ESLint, Prettier, SvelteKit
- [ ] **C20** — Stratégie SEO + résultats audit (score ≥ 70%)

---

## 7. MÉMOIRE — BLOC 3 (back-end & déploiement)

- [ ] **C21** — Couche persistance — MCD, MPD, requêtes SQL optimisées
- [ ] **C22** — API REST — endpoints, format JSON, pagination
- [ ] **C23** — Paiement fictif — Stripe sandbox, justification monétisation
- [ ] **C24** — Sécurité API — auth Sanctum, validation, policies
- [ ] **C25** — Tests back-end — couverture ≥ 50%, plan de test
- [ ] **C26** — Industrialisation back — CI GitHub Actions
- [ ] **C27** — Documentation API — PHPDoc + CHANGELOG structuré
- [ ] **C28** — Domaine + DNS + SSL/TLS
- [ ] **C29** — Choix hébergement — justification technique + économique
- [ ] **C30** — Déploiement — environnement cloud + conteneurisé
- [ ] **C31** — CI/CD — pipeline automatisé staging + prod
- [ ] **C32** — Supervision — logs, alertes, sauvegardes
- [ ] **E9** — Audit RGPD d'un site marchand fourni
- [ ] **E10** — Méthodologie de veille techno (Feedly, sources front+back)

---

## 8. RAPPORT D'ALTERNANCE

- [ ] Présentation de l'entreprise
- [ ] Description des missions (2-3 missions détaillées)
- [ ] Bilan personnel et professionnel
- [ ] Auto-évaluation des compétences

---

## 9. FINALISATION & SOUTENANCE

- [ ] Introduction mémoire (≤ 450 mots)
- [ ] Conclusion mémoire (≤ 450 mots)
- [ ] Glossaire + abréviations
- [ ] Bibliographie APA (ZoteroBib)
- [ ] Annexes
- [ ] Page de garde signée par l'entreprise
- [ ] Relecture complète à voix haute
- [ ] Slides soutenance Canva (10-20 slides)
- [ ] PDF renommé : `NOM.prenom.promo.mémoireprofessionnel.2026`
- [ ] Site fonctionnel en ligne 2 semaines avant soutenance
- [ ] CV à jour
- [ ] Copie carte d'identité

---

## CHECKLIST ADMINISTRATIVE
- [ ] Mémoire envoyé à thomas@cloud-campus.fr
- [ ] Mémoire envoyé à laetitia@cloud-campus.fr
- [ ] Envoi 2 semaines avant la date de soutenance