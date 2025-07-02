# 🎯 Objectif de l'Application

Développer une application web pour centraliser et simplifier la gestion des demandes d'absence, de retard et de congé dans une organisation.

L'application doit permettre une interaction fluide entre :

- Employés
- Superviseurs
- Ressources Humaines (RH)
- Direction

---

# 👤 Rôles et Fonctionnalités

## Employé

- Soumettre des demandes (congé, retard, justification d'absence)
- Consulter le statut de ses demandes
- Voir l’historique de ses absences/retards/congés

## Superviseur

- Voir les demandes de son équipe
- Valider ou rejeter les demandes (1er niveau)
- Consulter l’historique de son équipe

## Ressources Humaines

- Traiter les demandes validées par les superviseurs (validation finale)
- Gérer les données globales
- Générer des rapports/statistiques d’absentéisme

## Directeur

- Vue d’ensemble sur les rapports d’absentéisme
- Prendre des décisions stratégiques
- Valider des demandes exceptionnelles si besoin

---

# 🧱 Technologies

- **Backend** : Laravel (PHP)
- **Frontend** : Bootstrap
- **Base de données** : MySQL
- **Environnement local** : XAMPP

---

# 🧠 Directives pour Gemini CLI

## Ce que tu dois faire :

1. **Reprendre tout le code existant**
2. **Corriger et améliorer** toutes les parties :
   - Optimiser la performance
   - Rendre le code clair, propre et bien commenté (si complexe)
   - Appliquer les bonnes pratiques Laravel et Bootstrap
3. **Ajouter une suite complète de tests automatisés (PHPUnit)**
   - Écrire tous les tests en **français**
   - Tester chaque rôle : Employé, Superviseur, RH, Directeur
4. **Mettre en place un système de rôles (middleware/guards)**

## Ce que tu ne dois PAS faire :

- ❌ **Ne pas modifier l’intégration Google OAuth**
- ❌ **Ne pas changer la configuration `.env`**

---

# 🔐 Sécurité

- Authentification par **Google OAuth uniquement** (déjà en place)
- **Toutes les routes doivent être protégées** via middleware et rôles

---

# ✅ Résultat attendu

- Application propre et fonctionnelle
- Code maintenable et commenté
- Couverture de test élevée
- Aucun changement sur la partie Auth