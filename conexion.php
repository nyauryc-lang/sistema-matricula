<?php
// =====================================================
// conexion.php — Conexión a Supabase (PostgreSQL)
// Sistema de Matrículas
// =====================================================
// Carga las variables de entorno desde .env
// (nunca subas .env a Git — ya está en .gitignore)

class BD {
    private static $instancia = null;

    public static function crearInstancia() {
        if (!isset(self::$instancia)) {
            // Leer variables de entorno (archivo .env)
            $host     = getenv('DB_HOST')     ?: 'localhost';
            $port     = getenv('DB_PORT')     ?: '5432';
            $dbname   = getenv('DB_NAME')     ?: 'postgres';
            $user     = getenv('DB_USER')     ?: 'postgres';
            $password = getenv('DB_PASSWORD') ?: '';

            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                $dsn = "pgsql:host={$host};port={$port};dbname={$dbname};sslmode=require";
                self::$instancia = new PDO($dsn, $user, $password, $opciones);
                self::$instancia->exec("SET client_encoding TO 'UTF8'");
            } catch (Exception $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}