document.addEventListener("DOMContentLoaded", function () {
    // Simula lo stato di accesso
    const isLoggedIn = true; // Cambia in true per testare l'accesso al profilo

    // Controlla l'accesso al profilo
    const profileSection = document.getElementById("profile");
    if (!isLoggedIn) {
        // Mostra solo il modulo di login se non loggato
        const loginForm = profileSection.querySelector(".login-form");
        const registerForm = profileSection.querySelector(".register-form");

        loginForm.style.display = "block";
        registerForm.style.display = "none";
    } else {
        // Mostra i dettagli utente se loggato
        profileSection.innerHTML = `
            <div class="profile-info">
                <img src="default-avatar.png" alt="Avatar utente" class="profile-avatar">
                <h3>Benvenuto, <span id="user-name">Mario Rossi</span></h3>
                <p>Email: <span id="user-email">mario.rossi@email.com</span></p>
                <p>Telefono: <span id="user-phone">987654321</span></p>
            </div>

            <div class="orders">
                <h3>Ordini Effettuati</h3>
                <ul id="order-history">
                    <li>Prodotto 1 - €10.00 - 12/01/2025</li>
                    <li>Prodotto 2 - €20.00 - 15/01/2025</li>
                </ul>
            </div>

            <div class="orders">
                <h3>Ordini Ricevuti</h3>
                <ul id="received-orders">
                    <li>Prodotto A - €15.00 - 10/01/2025</li>
                    <li>Prodotto B - €30.00 - 13/01/2025</li>
                </ul>
            </div>
        `;
    }
});
