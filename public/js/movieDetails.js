{   
    const showFormBtn = document.getElementById("show-comment-form")
    showFormBtn.addEventListener("click", () => {
        form = document.getElementById("comment-form");
        form.hidden = form.hidden ? false : true;

        if(form.hidden)
            showFormBtn.innerText = "Commenter"
        else
            showFormBtn.innerText = "Retour"
    });


    const showAddBtn = document.getElementById("add-list-btn");
    showAddBtn.addEventListener("click", () => {
        form = document.getElementById("add-list-form");
        form.hidden = form.hidden ? false : true;

        if(form.hidden)
            showAddBtn.innerText = "Ajouter";
        else
            showAddBtn.innerText = "Retour";
    });
}