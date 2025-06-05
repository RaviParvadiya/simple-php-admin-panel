CREATE DATABASE IF NOT EXISTS `admin_panel`;

USE `admin_panel`;

CREATE TABLE
    IF NOT EXISTS `admins` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS `products` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT,
        image_url VARCHAR(255) NOT NULL,
        title VARCHAR(255) NOT NULL,
        price INT NOT NULL,
        discounted_price INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS `categories` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS `users` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(100) UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS `orders` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        payment_method VARCHAR(50),
        order_status ENUM (
            'Pending',
            'Processing',
            'Shipped',
            'Delivered',
            'Cancelled'
        ) DEFAULT 'Pending',
        payment_status ENUM ('Unpaid', 'Paid', 'Refunded') DEFAULT 'Unpaid',
        total_amount DECIMAL(10, 2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users (id)
    );

CREATE TABLE
    IF NOT EXISTS `order_items` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT,
        product_id INT,
        price INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products (id)
    );

    SELECT SUM(discounted_price) FROM products WHERE (SELECT COUNT(product_id) WHERE )

/* 
-- Lookup Table flexible for dynamic values instead ENUM 
CREATE TABLE
order_statuses (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE
payment_statuses (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL UNIQUE
); */