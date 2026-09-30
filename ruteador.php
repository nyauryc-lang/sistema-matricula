<?php
// Incluir el autoloader de Composer si no está cargado
if (!class_exists('Composer\Autoload\ClassLoader') && file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

if (!isset($controlador) || $controlador == "") {
    $controlador = $_GET['controlador'] ?? "paginas";
}
if (!isset($accion) || $accion == "") {
    $accion = $_GET['accion'] ?? "inicio";
}

// --- Control de acceso por rol ---

// Rutas públicas accesibles sin iniciar sesión
$rutasPublicas = [
    "login" => ["mostrar", "verificar"],
];
$esRutaPublica = isset($rutasPublicas[$controlador]) && in_array($accion, $rutasPublicas[$controlador]);

// Redirigir al login si no ha iniciado sesión
if (!$esRutaPublica && !isset($_SESSION["idUsuario"])) {
    header("Location: ./?controlador=login&accion=mostrar");
    exit();
}

// Restricciones para el rol Docente
if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "docente") {
    $rutasPermitidasDocente = [
        "paginas"  => ["inicio", "nosotros"],
        "cursos"   => ["inicio", "verAlumnos"],
        "notas"    => ["calificar", "guardar"],
        "reportes" => ["inicio", "actaExcel", "enviarNotificacion"],
        "login"    => ["salir"],
    ];

    $accionPermitida = isset($rutasPermitidasDocente[$controlador]) 
                       && in_array($accion, $rutasPermitidasDocente[$controlador]);

    if (!$accionPermitida) {
        header("Location: ./?controlador=cursos&accion=inicio");
        exit();
    }
}

$archivoControlador = __DIR__ . "/controladores/controlador_" . $controlador . ".php";

if (file_exists($archivoControlador)) {
    include_once $archivoControlador;
    $nombreClase = "Controlador" . ucfirst($controlador);
    if (class_exists($nombreClase)) {
        $instanciaControlador = new $nombreClase();
        if (method_exists($instanciaControlador, $accion)) {
            $instanciaControlador->$accion();
        } else {
            echo "Acción no encontrada: " . htmlspecialchars($accion);
        }
    } else {
        echo "Clase no encontrada: " . htmlspecialchars($nombreClase);
    }
} else {
    echo "Controlador no encontrado: " . htmlspecialchars($controlador);
}