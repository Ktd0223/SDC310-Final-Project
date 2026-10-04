CREATE DATABASE IF NOT EXISTS gameswap CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gameswap;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    category VARCHAR(50) NOT NULL,
    platform VARCHAR(50) NOT NULL DEFAULT '',
    description VARCHAR(500) NOT NULL DEFAULT '',
    price DECIMAL(10,2) UNSIGNED NOT NULL,
    stock_quantity INT UNSIGNED NOT NULL DEFAULT 0,
    image_url VARCHAR(255) NOT NULL DEFAULT '',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(120) NOT NULL,
    customer_email VARCHAR(190) NOT NULL,
    shipping_address VARCHAR(500) NOT NULL,
    total_amount DECIMAL(10,2) UNSIGNED NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'Completed',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE order_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    unit_price DECIMAL(10,2) UNSIGNED NOT NULL,
    CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    CONSTRAINT fk_order_items_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

INSERT INTO products (name, category, platform, description, price, stock_quantity) VALUES
('The Legend of Zelda: Tears of the Kingdom', 'Game', 'Nintendo Switch', 'Explore Hyrule in an open-world adventure.', 49.99, 8),
('Marvel Spider-Man 2', 'Game', 'PlayStation 5', 'Swing through New York as two Spider-Men.', 54.99, 6),
('Forza Horizon 5', 'Game', 'Xbox Series X/S', 'Race through a vibrant open world in Mexico.', 39.99, 10),
('Nintendo Switch OLED', 'Console', 'Nintendo Switch', 'OLED console with white Joy-Con controllers.', 299.99, 3),
('DualSense Wireless Controller', 'Accessory', 'PlayStation 5', 'Wireless controller with haptic feedback.', 69.99, 12),
('Master Chief Collectible Figure', 'Collectible', 'Xbox', 'Detailed display figure for Halo fans.', 34.99, 5);

