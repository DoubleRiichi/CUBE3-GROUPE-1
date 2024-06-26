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
}