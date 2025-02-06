document.getElementById("togglePassword").addEventListener("click", function () {
    const passwordField = document.getElementById("password");
    passwordField.type = passwordField.type === "password" ? "text" : "password";
    this.textContent = passwordField.type === "password" ? "👁️" : "🙈";
});

document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
    const passwordField = document.getElementById("confirmPassword");
    passwordField.type = passwordField.type === "password" ? "text" : "password";
    this.textContent = passwordField.type === "password" ? "👁️" : "🙈";
});