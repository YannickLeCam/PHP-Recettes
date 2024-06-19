/**
 * Partie gestion des boutons NEWRECETTE
 */

const boutonAddNewLine = document.getElementById("buttonAddNewLineIngredient").children[0];
const tabButtonDelete = document.getElementsByClassName("buttonDeleteLine");
const formIngredient = document.getElementById("formIngredient");



console.log(tabButtonDelete);

function updateEventListener() {
    for (let index = 0; index < tabButtonDelete.length; index++) {
        const element = tabButtonDelete[index];
        var buttonDelete=element.children[0];
        buttonDelete.addEventListener("click",function(){
            console.log("Je suis dans event listenner");
            this.parentNode.parentNode.remove();
        })
    }
}

//On le met apres le setter de la page pour qu'il copie aussi le addlistener
const modelNewLineIngredient = document.getElementById("ingredientBox");
boutonAddNewLine.addEventListener("click",function () {
    insertNode=modelNewLineIngredient.cloneNode(true);
    formIngredient.appendChild(insertNode);
    updateEventListener();
})


