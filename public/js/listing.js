{
    const rateButtons = document.querySelectorAll(".rate-btn");
    rateButtons.forEach(button => {
        button.addEventListener("click", () => {
            const formId = button.getAttribute("data-form-id");
            const form = document.getElementById(formId);
            if (form) {
                if (form.hidden) {
                    form.hidden = false;
                    button.innerText = "Valider";
                } else {
                    form.submit();
                }
            }
        });
    });
}
