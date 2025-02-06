document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-decrease").forEach(button => {
        button.addEventListener("click", function () {
            updateQuantity(this.dataset.id, -1);
        });
    });

    document.querySelectorAll(".btn-increase").forEach(button => {
        button.addEventListener("click", function () {
            updateQuantity(this.dataset.id, 1);
        });
    });
});

function showErrorMessage(message) {
    let errorContainer = document.querySelector(".toast-container");
    if (!errorContainer) {
        errorContainer = document.createElement("div");
        errorContainer.className = "position-fixed top-25 start-50 translate-middle-x p-3 toast-container";
        document.body.appendChild(errorContainer);
    }
    
    let toast = document.createElement("div");
    toast.className = "toast align-items-center text-bg-danger border-0 show";
    toast.setAttribute("role", "alert");
    toast.setAttribute("aria-live", "assertive");
    toast.setAttribute("aria-atomic", "true");
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    errorContainer.appendChild(toast);
    setTimeout(() => { toast.remove(); }, 3000);
}

function updateQuantity(cartItemId, change) {
    let qtyElem = document.getElementById("quantity-" + cartItemId);
    let currentQty = parseInt(qtyElem.value);
    let availableQty = parseInt(qtyElem.getAttribute('data-available-qty'));

    if (currentQty + change >= 1 && currentQty + change <= availableQty) {
        fetch("../php/updateCart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "cart_item_id=" + cartItemId + "&quantity=" + (currentQty + change)
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            if (data === "success") {
                qtyElem.value = currentQty + change;
                location.reload();
            } else {
                showErrorMessage("Errore nell'aggiornamento della quantità. Risposta: " + data);
            }
        })
        .catch(error => {
            console.error("Errore nella richiesta:", error);
            showErrorMessage("Si è verificato un errore nella richiesta.");
        });
    } else {
        showErrorMessage("La quantità non disponibile");
    }
}