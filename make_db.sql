-- Create a new database
CREATE DATABASE IF NOT EXISTS warranty_registration;

-- Switch to the created database
USE warranty_registration;

-- Create a table named 'warranty_registration'
CREATE TABLE IF NOT EXISTS warranty_registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    iso_number VARCHAR(255) NULL,
    model_name VARCHAR(255) NULL,
    name VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(20) NULL,
    address VARCHAR(255) NULL,
    city VARCHAR(255) NULL,
    state VARCHAR(255) NULL,
    pincode VARCHAR(10) NULL,
    serial_number VARCHAR(255) NULL,
    purchase_date VARCHAR(255) NULL,
    invoice_pdf VARCHAR(255) NULL,
    warranty_form_pdf VARCHAR(255) NULL
);

-- Add any additional constraints or indexes as needed
