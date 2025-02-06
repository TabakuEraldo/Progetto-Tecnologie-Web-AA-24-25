document.getElementById("prezzo").addEventListener("input", function () {
    if (this.value < 0) {
        this.value = 0;
    }
});

document.getElementById("disponibilita").addEventListener("input", function () {
    if (this.value < 0) {
        this.value = 0;
    }
});