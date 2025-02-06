    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Benvenuto su StudentMarket</h1>
            <p>Compra e vendi prodotti tra studenti in modo facile e veloce!</p>
            <a href="shop.php" class="btn btn-light">Scopri i prodotti</a>
        </div>
    </header>

    <section class="container mt-5 py-5">
        <h2 class="text-center">Categorie in evidenza</h2>
        <div class="row text-center mt-4">
            <div class="col-md-4">
                <a href="shop.php?search=didattica" class="text-decoration-none text-dark">
                    <div class="card p-4 shadow">
                        <h3>Didattica</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="shop.php?search=elettronica" class="text-decoration-none text-dark">
                    <div class="card p-4 shadow">
                        <h3>Elettronica</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="shop.php?search=usato" class="text-decoration-none text-dark">
                    <div class="card p-4 shadow">
                        <h3>Usato</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="container mt-5 py-5 text-center">
    <h3>Come Funziona</h3>
    <p class="text-muted">Compra e vendi in pochi semplici passi su StudentMarket.</p>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <h4>📦 Trova il prodotto giusto</h4>
            <p>Esplora le categorie o usa la barra di ricerca per trovare il prodotto che ti serve tra gli annunci degli studenti.</p>
        </div>
        <div class="col-md-4">
            <h4>🛒 Ordina</h4>
            <p>Aggiungi il prodotto al carrello e completa l'ordine</p>
        </div>
        <div class="col-md-4">
            <h4>🚚 Ricevi il prodotto</h4>
            <p>Scegli la modalità di consegna o di ritiro più comoda per te e per le tue esigenze.</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="#chisiamo" class="btn btn-primary">Scopri di più</a>
    </div>
</section>

    <section class="container mt-5">
    <h2 class="mb-4 text-center">Ultimi Annunci</h2>
    <div class="row" id="latest-listings">
    </div>
</section>


<section class="container mt-5 py-5" id="chisiamo">
    <h2 class="text-center">Chi Siamo</h2>
    <p class="text-center text-muted">
        StudentMarket è la piattaforma ideale per studenti che vogliono comprare e vendere prodotti in modo semplice e veloce. 
        Che tu stia cercando libri, dispositivi elettronici o oggetti di seconda mano, qui troverai tutto quello che ti serve da altri studenti come te.
    </p>
</section>


<section class="container mt-5 py-5">
    <h2 class="text-center">Domande Frequenti (FAQ)</h2>
    <div class="accordion mt-4" id="faqAccordion">

        <div class="accordion-item">
            <h3 class="accordion-header" id="faqHeading1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
                    Come posso vendere un prodotto su StudentMarket?
                </button>
            </h3>
            <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Vendere un prodotto è semplice! Basta registrarsi, accedere al proprio profilo e cliccare su "Vendi un prodotto". Compila i dettagli, carica una foto e pubblica l'annuncio. Una volta trovato un acquirente, potrai organizzare la consegna o la spedizione.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h3 class="accordion-header" id="faqHeading2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                Quanto costa vendere un prodotto?
                </button>
            </h3>
            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Pubblicare un annuncio su StudentMarket è completamente gratuito! Tuttavia, potresti scegliere di mettere in evidenza il tuo annuncio con una piccola commissione per aumentarne la visibilità.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h3 class="accordion-header" id="faqHeading3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                Posso vendere qualsiasi tipo di prodotto?
                </button>
            </h3>
            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                No, su StudentMarket è consentita solo la vendita di prodotti adatti a un ambiente studentesco, come libri, elettronica, materiale didattico e oggetti di seconda mano. È vietata la vendita di articoli illegali, pericolosi o non conformi alle nostre linee guida
                </div>
            </div>
        </div>

    </div>
</section>


<script>
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
</script>
