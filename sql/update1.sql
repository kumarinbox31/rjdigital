CREATE TABLE `computer_talent_certificate` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    class VARCHAR(200) NOT NULL,
    session INT NOT NULL,
    college_name VARCHAR(200) NOT NULL,
    status BOOLEAN,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE `computer_talent_certificate`
ADD COLUMN `center_id` INT DEFAULT 0 AFTER `id`;