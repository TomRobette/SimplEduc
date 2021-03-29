//Ici seront décrites les modifications faites
===================================
#29/03/2021#TomRobette#
-Mise en place d'une liste dans tâche
-Mise en place d'une liste des devs dans la vue projet

#25/03/2021#TomRobette#
-Amélioration de la vue tache
-Mise en place du chemin vers tache

#22/03/2021#TomRobette#
-Création de la vue tache.html.twig
-Reformatage de changelog.txt en CHANGELOG.md(ce fichier)
-Mise en null de dateFin de la table Tache dans la BD
-Création de ajoutTacheControleur.php

#10/11/2020#TomRobette#
-Ajout de ListeTache
-Ajout d'un controleur et d'une vue "Tache" accessible depuis les listes de tache
-La page Tache affiche  pour une tâche d'un projet la date de début, la date de fin (si elle est connue) de chaque
développeur. 

#29/10/2020#TomRobette#
-Ajout d'une fonction getTachesFromProjet et getProjetById
-Ajout d'un controleur et d'une vue "projet" accessible depuis les listes de projets
-La page projet affiche les données du projet correspondant dont son coût et temps total, la liste des tâches associées, etc

#26/10/2020#TomRobette#
-Ajout d'un élément mdp dans la table utilisateur et dans les classes
-Ajout du mot de passe dans les formulaires de développeurs

#20/10/2020#TomRobette#
-Ajout de getEntrepriseById dans la classe entreprise
-Ajout d'un élément libelle dans la table entreprise (le nom de l'entreprise)
-Modification des classe correspondant à la modif ci-dessus
-Création de la page client avec la liste des projets (Le système de pagination a dû être commenté)

#13/10/2020#RemiAccart#
-Ajout de la page d'ajout des clients
-Ajout du controlleur et de la fonction d'ajout d'un client

#13/10/2020#TomRobette#
-Correction du gitignore concernant "parametres.php"
-Correction de l'auto-incrémentation des tables
-Ajout de quelques valeurs de test dans la BD
-Ajout de l'élément cout dans la table Tâche
-Suppression de la table cout_global dans la table Contrat
-Correction de la classe Tâche
-Ajout de la liste clients

#13/10/2020#HugoFontaine#
-Correction de la base de donnée 

#10/10/2020#TomRobette#
-Correction de la table developpeur
-Ajout de la vue et du controlleur "liste_devs"

#06/10/2020#TomRobette#
-Ajout d'une classe Developpeur
-Ajout d'un formulaire ajoutDeveloppeur

#29/09/2020#TomRobette#
-Ajout des fonctions delete, selectLimit et selectCount dans class_projet
-Création du controleur liste_projets et de sa vue
-Création des classes tâche et client (qui est vide)

#22/09/2020#HugoFontaine#
-Mise en place des liaisons

#22/09/2020#RémiAccart
-Ajout de la BD
-Correction route ,ajout d'un menu et création de la page accueils
-Ajout d'une page maintenance

#22/09/2020#TomRobette#
-Mise en .gitignore les parametres.php
-Création de la classe projet
-Ajout de la fonction getProjets dans la classe projet
-Ajout de la fonction getProjetsFromClient dans la classe projet
-Ajout de la table Utilisateur et Rôles

#15/09/2020#HugoFontaine#
-Création du MCD

#15/09/2020#RémiAccart#
-Création des tables Competence, Developpeur, Projet, Tache

#15/09/2020#TomRobette#
-Création du repository Github
-Constitution de la structure MVC du site
-Création du MLD
