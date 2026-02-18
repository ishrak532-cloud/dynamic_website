
DROP TABLE IF EXISTS cars;

CREATE TABLE cars (
  id INT AUTO_INCREMENT PRIMARY KEY,
  model VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'Available',
  image VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS requests;

CREATE TABLE requests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(50) NOT NULL,
  car_model VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS site_stats;

CREATE TABLE site_stats (
  id INT PRIMARY KEY,
  total_cars INT NOT NULL DEFAULT 0,
  available_cars INT NOT NULL DEFAULT 0,
  offer_requests INT NOT NULL DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO site_stats (id, total_cars, available_cars, offer_requests)
VALUES (1, 0, 0, 0)
ON DUPLICATE KEY UPDATE id=id;
INSERT INTO cars (model, description, price, status, image) VALUES
('Mercedes M4', 'Great performance.', 45000.00, 'Available', 'carsh2.jpg'),
('Mercedes X5', 'great for roads.', 52000.00, 'Available', 'cars7.jpg'),
('Mercedes A6', 'Comfortable and best car ever.', 39000.00, 'Available', 'cars3.jpg');

