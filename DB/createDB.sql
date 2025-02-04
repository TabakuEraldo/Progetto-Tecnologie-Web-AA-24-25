CREATE DATABASE ECommerceDB;

USE ECommerceDB;

CREATE TABLE Utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    cognome VARCHAR(255) NOT NULL,
    indirizzo VARCHAR(1024) NOT NULL,
    imgProfilo VARCHAR(4906),
    password VARCHAR(255) NOT NULL
);

CREATE TABLE Prodotti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    immagine VARCHAR(4096) NOT NULL,
    categoria VARCHAR(255) NOT NULL,
    prezzo DECIMAL(6, 2) NOT NULL,
    descrizione VARCHAR(1000),
    disponibilita INT NOT NULL
);

CREATE TABLE Listini (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Utente INT NOT NULL,
    FOREIGN KEY (id_Utente) REFERENCES Utenti(id) ON DELETE CASCADE
);

CREATE TABLE ProdottiInListino (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Listino INT NOT NULL,
    id_Prodotto INT NOT NULL,
    FOREIGN KEY (id_Listino) REFERENCES Listini(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Prodotto) REFERENCES Prodotti(id) ON DELETE CASCADE
);

CREATE TABLE Carrelli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Utente INT NOT NULL,
    FOREIGN KEY (id_Utente) REFERENCES Utenti(id) ON DELETE CASCADE
);

CREATE TABLE ProdottiInCarrello (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Carrello INT NOT NULL,
    id_Prodotto INT NOT NULL,
    quantita INT NOT NULL DEFAULT 1,
    FOREIGN KEY (id_Carrello) REFERENCES Carrelli(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Prodotto) REFERENCES Prodotti(id) ON DELETE CASCADE
);

CREATE TABLE Acquisti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Utente INT NOT NULL,
    FOREIGN KEY (id_Utente) REFERENCES Utenti(id) ON DELETE CASCADE
);

CREATE TABLE AcquistoProdotti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Acquisto INT NOT NULL,
    id_Prodotto INT NOT NULL,
    quantita INT NOT NULL DEFAULT 1,
    FOREIGN KEY (id_Acquisto) REFERENCES Acquisti(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Prodotto) REFERENCES Prodotti(id) ON DELETE CASCADE
);

CREATE TABLE Vendite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Utente INT NOT NULL,
    FOREIGN KEY (id_Utente) REFERENCES Utenti(id) ON DELETE CASCADE
);

CREATE TABLE VenditaProdotti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Vendita INT NOT NULL,
    id_Prodotto INT NOT NULL,
    quantita INT NOT NULL DEFAULT 1,
    FOREIGN KEY (id_Vendita) REFERENCES Vendite(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Prodotto) REFERENCES Prodotti(id) ON DELETE CASCADE
);

CREATE TABLE Notifiche (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(255) NOT NULL,
    testo VARCHAR(4096) NOT NULL,
    isLetto BOOLEAN DEFAULT 0,
    id_Utente INT NOT NULL,
    id_Vendita INT,
    id_Prodotto INT,
    id_Acquisto INT,
    FOREIGN KEY (id_Utente) REFERENCES Utenti(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Prodotto) REFERENCES Prodotti(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Vendita) REFERENCES Vendite(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Acquisto) REFERENCES Acquisti(id) ON DELETE CASCADE
);
