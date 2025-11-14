Base de datos:
CREATE DATABASE evento_inscripciones CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE pais (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

INSERT INTO pais (nombre) VALUES
('Panamá'),
('Costa Rica'),
('Colombia'),
('México');



CREATE TABLE area_interes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

INSERT INTO area_interes (nombre) VALUES
('Desarrollo Web'),
('Ciberseguridad'),
('Inteligencia Artificial'),
('Bases de Datos');



CREATE TABLE inscriptor (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  edad TINYINT UNSIGNED NOT NULL,
  sexo ENUM('M','F','O') NOT NULL,
  pais_id INT NOT NULL,
  nacionalidad VARCHAR(100) NOT NULL,
  area_id INT NOT NULL,
  correo VARCHAR(150) NOT NULL,
  celular VARCHAR(20) NOT NULL,
  observaciones TEXT,
  fecha_formulario DATE NOT NULL,
  FOREIGN KEY (pais_id) REFERENCES pais(id),
  FOREIGN KEY (area_id) REFERENCES area_interes(id)
);
