document.getElementById("togglePassword").addEventListener("click", function () {
    const passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        this.textContent = "🙈";
    } else {
        passwordField.type = "password";
        this.textContent = "👁️";
    }
});