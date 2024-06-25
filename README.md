# Recette

Ce projet représente un site de recettes créé en PHP et MySQL lors de la formation à Elan Formation.

## Premier temps

Mise en place du MCD, ciblage des besoins et identification des différentes tables nécessaires pour la création d'un site de recettes.

<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/ScreenShot%20UML.png" height="200px">

## En détail 

Cette application permet de gérer un recueil de recettes que l'on peut modifier ou supprimer si nécessaire.

### Création de recettes

Chaque recette se caractérise par un nom, un temps de cuisson, un type de plat, une liste d'ingrédients avec leurs quantités et une image pour rendre la recette plus attrayante.

<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/creation-img-exemple.png" height="200px">

Les modules pour créer une recette sont divisés en trois parties :
- Informations générales sur la recette
- Partie ingrédient
- Partie instructions

La partie ingrédient est dynamique grâce à du JavaScript permettant d'ajouter ou supprimer des ingrédients. Les ingrédients sont sélectionnés à partir d'une liste déroulante des ingrédients déjà enregistrés dans la base de données. Si un ingrédient n'est pas encore enregistré, vous pouvez l'ajouter via un bouton dédié.

<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/nouvel-ingrédient.png" height="200px">

Pour les instructions, j'ai utilisé Quill (un éditeur WYSIWYG) pour permettre une mise en page soignée des recettes.

### Liste des recettes

Vous pouvez retrouver toutes les recettes créées, avec la possibilité de les consulter en détail.

<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/liste-recette.png" height="200px">

Les recettes sont présentées sous forme de cartes avec une image, le titre, une courte introduction, le type de plat, le temps de cuisson et un bouton "Voir plus" pour consulter les détails.

### Détail de la recette

<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/recette-detail.png" height="200px">
<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/recette-detail-bottom.png" height="200px">
<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/recette-detail-mid.png" height="200px">

La vue détaillée d'une recette affiche la photo, le temps de cuisson, le coût approximatif des ingrédients, la liste des ingrédients avec leurs quantités, les instructions et un navigateur permettant de :
- Aller à la recette suivante/précédente
- Éditer la recette
- Supprimer la recette
