<?php
// controladores/controlador_login.php
require_once __DIR__ . "/../conexion.php";
require_once __DIR__ . "/../modelos/Usuario.php";

class ControladorLogin {

    public function mostrar() {
        if (isset($_SESSION["idUsuario"])) {
            if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "docente") {
                header("Location: ./?controlador=cursos&accion=inicio");
            } else {
                header("Location: ./?controlador=paginas&accion=inicio");
            }
            exit();
        }

        $error = $_SESSION["error_login"] ?? null;
        unset($_SESSION["error_login"]);

        require_once __DIR__ . "/../vistas/login/mostrar.php";
    }

    public function verificar() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: ./?controlador=login&accion=mostrar");
            exit();
        }

        $usuario = trim($_POST["usuario"] ?? "");
        $password = trim($_POST["password"] ?? "");

        $conexion = BD::crearInstancia();
        $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $consulta->execute([$usuario]);
        $fila = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($fila && password_verify($password, $fila["password"])) {
            $_SESSION["idUsuario"] = $fila["id"];
            $_SESSION["usuario"] = $fila["usuario"];
            $_SESSION["rol"] = $fila["rol"];
            $_SESSION["idProfesor"] = $fila["id_profesor"];

            if ($fila["rol"] === "docente") {
                header("Location: ./?controlador=cursos&accion=inicio");
            } else {
                header("Location: ./?controlador=paginas&accion=inicio");
            }
            exit();
        } else {
            $_SESSION["error_login"] = "Usuario o contraseña incorrectos.";
            header("Location: ./?controlador=login&accion=mostrar");
            exit();
        }
    }

    public function salir() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: ./?controlador=login&accion=mostrar");
        exit();
    }
}