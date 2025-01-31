CREATE DATABASE IF NOT EXISTS studentmarket;
USE studentmarket;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('buyer', 'seller') NOT NULL,  -- ruolo dell'utente (compratore o venditore)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,  -- riferimento all'utente venditore
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,  -- prezzo del prodotto
    quantity INT DEFAULT 1,  -- quantità disponibile
    image_url VARCHAR(255),  -- URL dell'immagine del prodotto
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,  -- riferimento all'utente compratore
    product_id INT,  -- riferimento al prodotto nel carrello
    quantity INT NOT NULL,  -- quantità del prodotto nel carrello
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,  -- riferimento all'utente compratore
    total_price DECIMAL(10, 2) NOT NULL,  -- totale dell'ordine
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',  -- stato dell'ordine
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,  -- riferimento all'ordine
    product_id INT,  -- riferimento al prodotto acquistato
    quantity INT NOT NULL,  -- quantità acquistata
    price DECIMAL(10, 2) NOT NULL,  -- prezzo del prodotto al momento dell'acquisto
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,  -- riferimento all'ordine
    transaction_id VARCHAR(255),  -- ID della transazione di pagamento (per esempio, un codice di pagamento)
    amount DECIMAL(10, 2) NOT NULL,  -- importo pagato
    payment_method ENUM('credit_card', 'paypal', 'bank_transfer') NOT NULL,  -- metodo di pagamento
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',  -- stato della transazione
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS product_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,  -- riferimento al prodotto recensito
    user_id INT,  -- riferimento all'utente che lascia la recensione
    rating INT NOT NULL,  -- valutazione da 1 a 5
    review TEXT,  -- testo della recensione
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,  -- riferimento al prodotto
    image_url VARCHAR(255) NOT NULL,  -- URL dell'immagine
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
