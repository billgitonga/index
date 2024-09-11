-- Create the database
CREATE DATABASE IF NOT EXISTS beauty_services;

-- Switch to the new database
USE beauty_services;

-- Create the bookings table
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,              -- Primary key with auto-increment
    services TEXT NOT NULL,                        -- Store service details
    payment_method VARCHAR(20) NOT NULL,           -- Store payment method
    total_cost DECIMAL(10, 2) NOT NULL,            -- Store total cost with precision
    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Automatically set booking time
    INDEX (payment_method)                        -- Optional: Add an index on payment_method for faster queries
);

-- Optional: Add comments to describe each column (for clarity)
-- id: Unique identifier for each booking
-- services: Details of the services booked
-- payment_method: Method used for payment
-- total_cost: Total cost of the booking
-- booking_time: Timestamp of when the booking was created
