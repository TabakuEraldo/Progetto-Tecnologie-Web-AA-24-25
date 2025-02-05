<?php
require_once 'start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = trim($_POST['nome']);
    $prezzo = trim($_POST['prezzo']);
    $categoria = trim($_POST['categoria']);
    $quantita = $_POST['disponibilita'];
    $descrizione = $_POST['descrizione'];
    $img;
    if(empty($_FILES['immagine']['name'])){
        $img = $_POST["immagine_attuale"];
    }
    else{
        $img = $_FILES['immagine']['name'];
    }
    
    if(empty($id)){
        die("Errore nella modifica del prodotto");
    }

    if ($db->modificaProdotto($id, $nome, $prezzo, $categoria, $quantita, $descrizione, $img)) {
        echo "<script>
                alert('Prodotto modificato con successo');
                window.location.href = 'manageProducts.php';
              </script>";
    } else {
        die("Errore durante la modifica");
    }
}
?>