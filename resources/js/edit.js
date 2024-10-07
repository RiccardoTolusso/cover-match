// prendo il form di modifica con i relativi campi e li savlo per dopo
const edit_modal = document.getElementById("edit-modal");

// campo che mostra il nome
const show_model_1 = document.getElementById("show-model-1");
const show_model_2 = document.getElementById("show-model-2");

// input hidden che tiene l'id della compatibilità modificata
const compatibility_id = document.getElementById("compatibility-id");

//
const switch_verified = document.getElementById("verified");
const switch_possible = document.getElementById("possible");

//bottone per chuidere la modale
const modal_close_button = document.getElementById("close-modal");

// prendo la tabella e ci attacco un event listner
const comp_table = document.getElementById("compatibility-table")

comp_table.addEventListener('click', function(event){
    const button = event.target
    if(button.tagName === "BUTTON"){
        // aggiorno i dati della modale
        show_model_1.innerText = button.dataset.model1
        show_model_2.innerText = button.dataset.model2
        compatibility_id.value = button.dataset.id
        console.log(button.dataset);
       
        if(button.dataset.verified === "1"){
            switch_verified.checked = true;
        } else {
            switch_verified.checked = false;
        }
       
        if(button.dataset.possible === "1"){
            switch_possible.checked = true;
        } else {
            switch_possible.checked = false;
        }
       
        //mostro la modale
        edit_modal.classList.toggle("d-none");
        
    }
})


// gestisco la chiusura della modale
modal_close_button.addEventListener("click", function(event){
    edit_modal.classList.toggle("d-none");
})