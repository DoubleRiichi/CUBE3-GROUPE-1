{
    const showFormBtn = document.getElementById("show-comment-form")
    showFormBtn.addEventListener("click", () => {
        form = document.getElementById("comment-form");
        form.hidden = form.hidden ? false : true;

        if (form.hidden)
            showFormBtn.innerText = "Commenter"
        else
            showFormBtn.innerText = "Retour"
    });

    function display(id) {
        form = document.getElementById("comment-form-" + id);
        form.hidden = form.hidden ? false : true;
    }
}