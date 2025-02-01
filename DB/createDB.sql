CREATE DATABASE ECommerceDB;

USE ECommerceDB;

CREATE TABLE Utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE Prodotti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    immagine VARCHAR(255),
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
    FOREIGN KEY (id_Vendita) REFERENCES Vendite(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Prodotto) REFERENCES Prodotti(id) ON DELETE CASCADE
);

CREATE TABLE Notifiche (
    id INT AUTO_INCREMENT PRIMARY KEY,
    testo VARCHAR(4096),
    id_Utente INT NOT NULL,
    id_Vendita INT,
    id_Prodotto INT,
    id_Acquisto INT,
    FOREIGN KEY (id_Utente) REFERENCES Utenti(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Prodotto) REFERENCES Prodotti(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Vendita) REFERENCES Vendite(id) ON DELETE CASCADE,
    FOREIGN KEY (id_Acquisto) REFERENCES Acquisti(id) ON DELETE CASCADE
);
