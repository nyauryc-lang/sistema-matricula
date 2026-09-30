USE sistema-matricula;
INSERT INTO profesores (id, nombres, apellidos, especialidad) VALUES (1, 'Profesor', 'Oak', 'Investigador Pokemon')
ON DUPLICATE KEY UPDATE nombres=VALUES(nombres);

INSERT INTO cursos (id, nombre_curso, creditos, id_profesor) VALUES (1, 'Pokedex 101', 4, 1)
ON DUPLICATE KEY UPDATE nombre_curso=VALUES(nombre_curso);

INSERT INTO estudiantes (id, nombres, apellidos, direccion, telefono, email, foto) VALUES (1, 'Ash', 'Ketchum', 'Pueblo Paleta 123', '987654321', 'ash.ketchum@example.com', 'default.png')
ON DUPLICATE KEY UPDATE nombres=VALUES(nombres);

INSERT INTO matricula (id, id_estudiante, fecha_matricula, total_creditos, estado) VALUES (1, 1, CURDATE(), 4, 'matriculado')
ON DUPLICATE KEY UPDATE estado=VALUES(estado);

INSERT INTO detalle_matricula (id, id_matricula, id_curso, creditos) VALUES (1, 1, 1, 4)
ON DUPLICATE KEY UPDATE creditos=VALUES(creditos);

INSERT INTO registro_notas (id, id_estudiante, id_curso, promedio_final, estado) VALUES (1, 1, 1, 17.50, 'aprobado')
ON DUPLICATE KEY UPDATE promedio_final=VALUES(promedio_final);
INSERT INTO usuarios (id, usuario, password, rol, id_profesor) VALUES
(1, 'admin', '\\\.AdR.U2bMsAJbXpARED/iRGW', 'admin', NULL),
(2, 'jvela', '\\\.AdR.U2bMsAJbXpARED/iRGW', 'docente', 1)
ON DUPLICATE KEY UPDATE password=VALUES(password), rol=VALUES(rol), id_profesor=VALUES(id_profesor);