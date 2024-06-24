/**
 * Partie gestion des boutons NEWRECETTE
 */

const boutonAddNewLine = document.getElementById("buttonAddNewLineIngredient").children[0];
const tabButtonDelete = document.getElementsByClassName("buttonDeleteLine");
const formIngredient = document.getElementById("formIngre");

const modelNewLineIngredient = document.getElementById("ingredientBox");

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
updateEventListener();

boutonAddNewLine.addEventListener("click",function () {
    insertNode=modelNewLineIngredient.cloneNode(true);
    insertNode.querySelector("#floatingInputDisabled").value="";
    formIngredient.appendChild(insertNode);
    updateEventListener();
})
/**
 * Partie la ge
 */
const buttonIngredientForm = document.getElementById("openIngredientForm");
const buttonCancelButton = document.getElementById("cancelButton");
const ingredientForm = document.getElementById("ingredientForm");

buttonIngredientForm.addEventListener("click",(event)=>{
    event.preventDefault();
    ingredientForm.style.display="flex";
});

buttonCancelButton.addEventListener("click",()=>{
    event.preventDefault();
    ingredientForm.style.display="none";
})

