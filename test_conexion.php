<?php
require_once "conexion.php";
try {
    $pdo = BD::crearInstancia();
    echo "Conexion exitosa";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
