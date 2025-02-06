document.querySelectorAll(".togglePassword").forEach(button => {
    button.addEventListener("click", function () {
        const passwordField = this.previousElementSibling;
        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.textContent = "🙈";
        } else {
            passwordField.type = "password";
            this.textContent = "👁️";
        }
    });
});