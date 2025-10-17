-- save as themepark.sql and import via phpMyAdmin
CREATE DATABASE IF NOT EXISTS themepark CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE themepark;

CREATE TABLE IF NOT EXISTS attractions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  short_desc VARCHAR(500),
  long_desc TEXT,
  price DECIMAL(8,2) DEFAULT 0.00,
  image VARCHAR(255),
  status TINYINT(1) DEFAULT 1
);

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(50),
  attraction_id INT,
  visit_date DATE,
  tickets INT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (attraction_id) REFERENCES attractions(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- sample attractions (make sure images exist in images/)
INSERT INTO attractions (name, short_desc, long_desc, price, image) VALUES
('SkyBlaster Roller Coaster', 'High-speed thrill ride with loops and drops.', 'An adrenaline-packed roller coaster reaching heights of 60ft, loops and heart-stopping drops — recommended for 12+.', 500.00, 'skyblaster.jpg'),
('Pirate Bay Water Ride', 'Splashy family water ride with pirate theme.', 'A family-friendly water attraction with interactive pirate scenes and splash zones.', 350.00, 'water_ride.jpg'),
('Magic Carousel', 'Classic carousel, perfect for kids.', 'A beautifully decorated carousel with hand-carved horses and gentle music.', 150.00, 'magic_carousel.jpg');
