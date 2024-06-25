# Recette

Ce projet va représenter un site de recette avec un mixte en PHP et mySQL fait lors de la formation a Elan Formation.

## Premier temps

Mise en place du MCD, Savoir ciblé la demande et les différentes tables qui va nous falloir pour faire composé un site de recette

<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/ScreenShot%20UML.png" height="200px">

## En detail 

Sur cette applications nous pouvons pouvons avoir un receuil de recette ou nous allons pouvoir modifier et/ou supprimer par la suite si celle-ci ne nous convient pas. Pour l'instant nous avons que la possibilité.

### La création de recette

La recette se caractérise comme l'UML au-dessus par un noms, temps de cuisson , un type de plat , un liste d'ingrédient avec sa quantité, et j'ai également ajouter une image afin de rendre la recette plus acceuillant

<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/creation-img-exemple.png" height="200px">

Comme nous pouvons voir les differents modules pour pouvoir mettre en place la recette, J'ai fais le choix de la séparer en 3 parties: 
  - Une générale avec les informations "Classique" d'une recette 
  - Une partie ingrédient
  - Une partie instructions
La partie ingrédient est une partie dynamique qui avec du javscript permet d'afficher ou de supprimer un ingrédient a la recette. De plus la selection de l'ingrédient pour la recette est dans une liste déroulante avec tous les ingrédients déjà enregistré dans la BDD . Cependant si votre ingrédient n'est pas encore enregistré pas de panique vous pouvez le faire avec le bouton ajouter un ingrédient, alors un menu déroulant s'ouvrira et vous permettra d'ajouter un élément.

<img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/nouvel-ingrédient.png" height="200px">

 Pour la partie instructions j'ai choisi de partir sur un MCE (Quill), pour pouvoir faire une mise en page propre des recette et pouvoir donner l'occation aux utilisateur de créer proprement leurs recettes 

 ### Liste des recettes

 Ici nous allons pouvoir retrouver toute les recettes deja crée avec la possibilité de la voir en détail. 

 <img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/liste-recette.png" height="200px">

 Elles se présente sous la forme de cards avec l'image, le titre de la recette une courte introduction de ce qu'est la recette , le type de plat , son temps de cuisson avec un bouton "Voir plus" qui va nous permettre d'aller voir en détail la recette

 ### La recette en détail

  <img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/recette-detail.png" height="200px">

  <img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/recette-detail-bottom.png" height="200px">
  
  <img src="https://github.com/YannickLeCam/PHP-Recettes/blob/main/AssetReadMe/recette-detail-mid.png" height="200px">

  Nous pouvons la photo de la recette, le temps de cuisson , le prix de revient de la recette (Une approximation du prix de chaque ingrédient , la liste des ingrédients et leurs quantité la liste des instructions et pour finir un navigateur :
    -Aller a la recette suivante/précédente
    -Editer la recette
    -Supprimer la recette
