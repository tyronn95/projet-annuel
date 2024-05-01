CREATE TABLE IF NOT EXISTS `properties` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `type` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `image_url` VARCHAR(255)
);
