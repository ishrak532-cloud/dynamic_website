CREATE TABLE IF NOT EXISTS cars (
  id INT AUTO_INCREMENT PRIMARY KEY,
  model VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'Available',
  image VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO cars (model, description, price, status, image) VALUES
('Mercedes M4', 'Great performance and premium interior.', 57850.00, 'Available', 'cars10.jpg'),
('Mercedes C63', 'Powerful brake system and smart features.', 65120.00, 'Premium', 'cars3.jpg'),
('Mercedes E5', 'Comfort-focused ride, great engine.', 49990.00, 'Available', 'cars7.jpg');
CREATE TABLE IF NOT EXISTS requests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  car_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS site_stats (
  id INT PRIMARY KEY,
  total_visits INT DEFAULT 0,
  total_requests INT DEFAULT 0
);
INSERT INTO site_stats (id, total_visits, total_requests)
VALUES (1, 0, 0);
