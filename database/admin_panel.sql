USE admin_panel;

CREATE TABLE
    IF NOT EXISTS admins (
        id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )