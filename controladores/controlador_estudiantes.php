<?php

require_once("./modelos/Estudiantes.php");

class ControladorEstudiantes {

    public function inicio()
    {
        $conexion = BD::crearInstancia();
        $consulta = $conexion->prepare("SELECT * FROM estudiantes ORDER BY apellidos");
        $consulta->execute();

        $listaEstudiantes = [];
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $listaEstudiantes[] = new Estudiantes(
                $fila["id"],
                $fila["nombres"],
                $fila["apellidos"],
                $fila["direccion"],
                $fila["telefono"],
                $fila["email"],
                $fila["foto"]
            );
        }

        require_once("./vistas/estudiantes/inicio.php");
    }

    public function crear()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombreArchivo = "default.png";

            if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK && !empty($_FILES["foto"]["name"])) {
                $nombreArchivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
                $destino = "./uploads/" . $nombreArchivo;
                move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);
            }

            $conexion = BD::crearInstancia();
            $consulta = $conexion->prepare("INSERT INTO estudiantes (nombres, apellidos, direccion, telefono, email, foto) VALUES (?, ?, ?, ?, ?, ?)");
            $consulta->execute([
                $_POST["nombres"],
                $_POST["apellidos"],
                $_POST["direccion"],
                $_POST["telefono"],
                $_POST["email"],
                $nombreArchivo
            ]);

            header("Location: ./?controlador=estudiantes&accion=inicio");
            exit;
        } else {
            require_once("./vistas/estudiantes/crear.php");
        }
    }

    public function editar()
    {
        $conexion = BD::crearInstancia();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $consulta = $conexion->prepare("SELECT foto FROM estudiantes WHERE id = ?");
            $consulta->execute([$id]);
            $fotoActual = $consulta->fetchColumn();
            $nombreArchivo = $fotoActual ?: "default.png";
            if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK && !empty($_FILES["foto"]["name"])) {
                $nombreArchivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
                $destino = "./uploads/" . $nombreArchivo;
                move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);
                if ($fotoActual && $fotoActual !== "default.png" && file_exists("./uploads/" . $fotoActual)) {
                    unlink("./uploads/" . $fotoActual);
                }
            }

            $consulta = $conexion->prepare("UPDATE estudiantes SET nombres=?, apellidos=?, direccion=?, telefono=?, email=?, foto=? WHERE id=?");
            $consulta->execute([
                $_POST["nombres"],
                $_POST["apellidos"],
                $_POST["direccion"],
                $_POST["telefono"],
                $_POST["email"],
                $nombreArchivo,
                $id
            ]);

            header("Location: ./?controlador=estudiantes&accion=inicio");
            exit;
        } else {
            $id = $_GET["id"] ?? null;
            $consulta = $conexion->prepare("SELECT * FROM estudiantes WHERE id = ?");
            $consulta->execute([$id]);
            $fila = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($fila) {
                $estudiante = new Estudiantes(
                    $fila["id"],
                    $fila["nombres"],
                    $fila["apellidos"],
                    $fila["direccion"],
                    $fila["telefono"],
                    $fila["email"],
                    $fila["foto"]
                );
                require_once("./vistas/estudiantes/editar.php");
            } else {
                header("Location: ./?controlador=estudiantes&accion=inicio");
                exit;
            }
        }
    }

    public function eliminar()
    {
        $id = $_GET["id"] ?? null;
        if ($id) {
            $conexion = BD::crearInstancia();

            $consulta = $conexion->prepare("SELECT foto FROM estudiantes WHERE id = ?");
            $consulta->execute([$id]);
            $foto = $consulta->fetchColumn();

            // Borrar físico solo si no es la default
            if ($foto && $foto !== "default.png") {
                $ruta = "./uploads/" . $foto;
                if (file_exists($ruta)) {
                    unlink($ruta);
                }
            }

            $consulta = $conexion->prepare("DELETE FROM estudiantes WHERE id = ?");
            $consulta->execute([$id]);
        }

        header("Location: ./?controlador=estudiantes&accion=inicio");
        exit;
    }
}
