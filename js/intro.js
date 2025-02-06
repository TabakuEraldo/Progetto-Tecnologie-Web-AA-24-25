document.addEventListener("DOMContentLoaded", function() {
    fetch("../php/getLatestListings.php")
        .then(response => response.json())
        .then(data => {
            let listingsContainer = document.getElementById("latest-listings");
            listingsContainer.innerHTML = "";
            
            data.forEach(item => {
                let listingCard = `
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="../img/${item.immagine}" class="card-img-top" alt="${item.nome}">
                            <div class="card-body">
                                <h5 class="card-title">${item.nome}</h5>
                                <p class="card-text">€${item.prezzo}</p>
                                <a href="shop.php" class="btn btn-primary">Vai allo shop</a>
                            </div>
                        </div>
                    </div>`;
                listingsContainer.innerHTML += listingCard;
            });
        })
        .catch(error => console.error("Errore nel recupero degli annunci:", error));
});