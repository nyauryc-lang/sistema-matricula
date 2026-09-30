CREATE DATABASE IF NOT EXISTS sistema-matricula;
USE sistema-matricula;

CREATE TABLE IF NOT EXISTS estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    direccion VARCHAR(100),
    telefono VARCHAR(15),
    email VARCHAR(100),
    foto VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS profesores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    especialidad VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_curso VARCHAR(100) NOT NULL,
    creditos INT,
    id_profesor INT NOT NULL,
    FOREIGN KEY (id_profesor) REFERENCES profesores(id)
);

DROP TABLE IF EXISTS detalle_matricula;
DROP TABLE IF EXISTS matricula;
DROP TABLE IF EXISTS matriculas;

CREATE TABLE matricula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_estudiante INT NOT NULL,
    fecha_matricula DATE NOT NULL,
    total_creditos INT NOT NULL DEFAULT 0,
    estado ENUM('matriculado','retirado') DEFAULT 'matriculado',
    FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id)
) ENGINE=InnoDB;

CREATE TABLE detalle_matricula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_matricula INT NOT NULL,
    id_curso INT NOT NULL,
    creditos INT NOT NULL,
    FOREIGN KEY (id_matricula) REFERENCES matricula(id) ON DELETE CASCADE,
    FOREIGN KEY (id_curso) REFERENCES cursos(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS registro_notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_estudiante INT NOT NULL,
    id_curso INT NOT NULL,
    promedio_final DECIMAL(4,2) NOT NULL,
    estado ENUM('aprobado','desaprobado') NOT NULL,
    FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_curso) REFERENCES cursos(id) ON DELETE CASCADE
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','docente') NOT NULL,
    id_profesor INT NULL,
    FOREIGN KEY (id_profesor) REFERENCES profesores(id) ON DELETE SET NULL
) ENGINE=InnoDB;