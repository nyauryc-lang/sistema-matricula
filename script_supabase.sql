-- =====================================================
-- script_supabase.sql — Schema para PostgreSQL/Supabase
-- Sistema de Matrículas
-- Ejecutar en: Supabase → SQL Editor
-- =====================================================

-- Tabla: estudiantes
CREATE TABLE IF NOT EXISTS estudiantes (
    id SERIAL PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    direccion VARCHAR(100),
    telefono VARCHAR(15),
    email VARCHAR(100),
    foto VARCHAR(255)
);

-- Tabla: profesores
CREATE TABLE IF NOT EXISTS profesores (
    id SERIAL PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    especialidad VARCHAR(100)
);

-- Tabla: cursos
CREATE TABLE IF NOT EXISTS cursos (
    id SERIAL PRIMARY KEY,
    nombre_curso VARCHAR(100) NOT NULL,
    creditos INT,
    id_profesor INT NOT NULL,
    FOREIGN KEY (id_profesor) REFERENCES profesores(id)
);

-- Tabla: matricula
DROP TABLE IF EXISTS detalle_matricula;
DROP TABLE IF EXISTS matricula;

CREATE TABLE matricula (
    id SERIAL PRIMARY KEY,
    id_estudiante INT NOT NULL,
    fecha_matricula DATE NOT NULL,
    total_creditos INT NOT NULL DEFAULT 0,
    estado VARCHAR(20) DEFAULT 'matriculado' CHECK (estado IN ('matriculado','retirado')),
    FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id)
);

-- Tabla: detalle_matricula
CREATE TABLE detalle_matricula (
    id SERIAL PRIMARY KEY,
    id_matricula INT NOT NULL,
    id_curso INT NOT NULL,
    creditos INT NOT NULL,
    FOREIGN KEY (id_matricula) REFERENCES matricula(id) ON DELETE CASCADE,
    FOREIGN KEY (id_curso) REFERENCES cursos(id)
);

-- Tabla: registro_notas
CREATE TABLE IF NOT EXISTS registro_notas (
    id SERIAL PRIMARY KEY,
    id_estudiante INT NOT NULL,
    id_curso INT NOT NULL,
    promedio_final DECIMAL(4,2) NOT NULL,
    estado VARCHAR(20) NOT NULL CHECK (estado IN ('aprobado','desaprobado')),
    FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_curso) REFERENCES cursos(id) ON DELETE CASCADE
);

-- Tabla: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL CHECK (rol IN ('admin','docente')),
    id_profesor INT NULL,
    FOREIGN KEY (id_profesor) REFERENCES profesores(id) ON DELETE SET NULL
);

-- =====================================================
-- Datos de prueba (sample data)
-- =====================================================
INSERT INTO profesores (id, nombres, apellidos, especialidad)
VALUES (1, 'Profesor', 'Oak', 'Investigador Pokemon')
ON CONFLICT (id) DO UPDATE SET nombres=EXCLUDED.nombres;

INSERT INTO cursos (id, nombre_curso, creditos, id_profesor)
VALUES (1, 'Pokedex 101', 4, 1)
ON CONFLICT (id) DO UPDATE SET nombre_curso=EXCLUDED.nombre_curso;

INSERT INTO estudiantes (id, nombres, apellidos, direccion, telefono, email, foto)
VALUES (1, 'Ash', 'Ketchum', 'Pueblo Paleta 123', '987654321', 'ash.ketchum@example.com', 'default.png')
ON CONFLICT (id) DO UPDATE SET nombres=EXCLUDED.nombres;

INSERT INTO matricula (id, id_estudiante, fecha_matricula, total_creditos, estado)
VALUES (1, 1, CURRENT_DATE, 4, 'matriculado')
ON CONFLICT (id) DO UPDATE SET estado=EXCLUDED.estado;

INSERT INTO detalle_matricula (id, id_matricula, id_curso, creditos)
VALUES (1, 1, 1, 4)
ON CONFLICT (id) DO UPDATE SET creditos=EXCLUDED.creditos;

INSERT INTO registro_notas (id, id_estudiante, id_curso, promedio_final, estado)
VALUES (1, 1, 1, 17.50, 'aprobado')
ON CONFLICT (id) DO UPDATE SET promedio_final=EXCLUDED.promedio_final;

INSERT INTO usuarios (id, usuario, password, rol, id_profesor)
VALUES
  (1, 'admin', '\\.AdR.U2bMsAJbXpARED/iRGW', 'admin', NULL),
  (2, 'jvela', '\\.AdR.U2bMsAJbXpARED/iRGW', 'docente', 1)
ON CONFLICT (id) DO UPDATE SET rol=EXCLUDED.rol, id_profesor=EXCLUDED.id_profesor;
