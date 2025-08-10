CREATE DATABASE IF NOT EXISTS food_app;
USE food_app;

CREATE TABLE if not exists admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100),
    phone VARCHAR(20),
    order_item VARCHAR(255),
    order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Insert test admin (password = admin123)
INSERT INTO admins (username, password)
VALUES ('admin', '<?= password_hash("admin123", PASSWORD_DEFAULT) ?>');
select*

