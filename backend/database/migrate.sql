CREATE TABLE address_book.cities (
    id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL
);

CREATE TABLE address_book.contacts (
    id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, first_name VARCHAR(35) NOT NULL, email VARCHAR(60), street VARCHAR(255), zip_code VARCHAR(10), city_id INT, FOREIGN KEY (city_id) REFERENCES cities (id)
);

INSERT INTO
    address_book.cities (name)
VALUES ('New York'),
    ('Los Angeles'),
    ('Chicago'),
    ('Houston');

