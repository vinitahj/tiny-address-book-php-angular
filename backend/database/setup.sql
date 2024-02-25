CREATE TABLE address_book.cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE address_book.entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    first_name VARCHAR(35) NOT NULL,
    email VARCHAR(60),
    street VARCHAR(255),
    zip_code VARCHAR(10),
    city_id INT,
    FOREIGN KEY (city_id) REFERENCES cities(id)
);

INSERT INTO address_book.cities (name) VALUES ('New York'), ('Los Angeles'), ('Chicago'), ('Houston');

INSERT INTO address_book.entries (name, first_name, email, street, zip_code, city_id) VALUES
('Doe', 'John', 'john.doe@example.com', '123 Elm Street', '12345', 1),
('Smith', 'Jane', 'jane.smith@example.com', '456 Oak Avenue', '67890', 2),
('Johnson', 'Jim', 'jim.johnson@example.com', '789 Pine Road', '10112', 3),
('Williams', 'Jill', 'jill.williams@example.com', '101 Maple Lane', '13141', 4),
('Brown', 'Jack', 'jack.brown@example.com', '202 Birch Plaza', '16171', 1),
('Davis', 'Jenny', 'jenny.davis@example.com', '303 Cedar Path', '18181', 2),
('Miller', 'Jake', 'jake.miller@example.com', '404 Spruce Circle', '20212', 3),
('Wilson', 'Julia', 'julia.wilson@example.com', '505 Redwood Blvd', '22232', 4);