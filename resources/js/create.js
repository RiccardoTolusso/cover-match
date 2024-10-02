const option_groups = document.querySelectorAll("optgroup");
const brand_select = document.getElementById("brand");

function update_models(){
    option_groups.forEach(option_group => {
        if (option_group.dataset.brandId === brand_select.value){
            option_group.hidden = false
            option_group.firstElementChild.selected = true
            
        } else {
            option_group.hidden = true
        };
    });
}

update_models()

brand_select.addEventListener('input', update_models)