-- Check and create cities table if it doesn't exist
CREATE TABLE IF NOT EXISTS address_book.cities (
    id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL
);

-- Check and create contacts table if it doesn't exist
CREATE TABLE IF NOT EXISTS address_book.contacts (
    id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, first_name VARCHAR(35) NOT NULL, email VARCHAR(60), street VARCHAR(255), zip_code VARCHAR(10), city_id INT, FOREIGN KEY (city_id) REFERENCES cities (id)
);


-- Check and create groups table if it doesn't exist
CREATE TABLE IF NOT EXISTS address_book.groups (
    id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, description TEXT
);
