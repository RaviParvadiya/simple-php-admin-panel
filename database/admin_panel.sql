CREATE DATABASE IF NOT EXISTS `admin_panel`;

USE `admin_panel`;

CREATE TABLE
    IF NOT EXISTS `admins` (
        id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
CREATE TABLE
    IF NOT EXISTS `products` (
        product_id INT (10) AUTO_INCREMENT PRIMARY KEY,
        product_image VARCHAR(255) NOT NULL,
        product_title VARCHAR(255) NOT NULL,
        original_price INT NOT NULL,
        discounted_price INT NOT NULL
    )