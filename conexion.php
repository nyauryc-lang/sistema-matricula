<?php
// =====================================================
// conexion.php — Conexión inteligente a Supabase (PostgreSQL)
// Compatible con IPv6 y IPv4 (Vercel Serverless / Pooler)
// =====================================================

class BD {
    private static $instancia = null;

    public static function crearInstancia() {
        if (!isset(self::$instancia)) {
            $host     = getenv('DB_HOST')     ?: 'localhost';
            $port     = getenv('DB_PORT')     ?: '5432';
            $dbname   = getenv('DB_NAME')     ?: 'postgres';
            $user     = getenv('DB_USER')     ?: 'postgres';
            $password = getenv('DB_PASSWORD') ?: '';

            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT            => 5,
            ];

            // Lista de configuraciones a intentar (Directo -> Pooler sa-east-1 -> Pooler us-east-1)
            $intentos = [];

            // 1. Configuración configurada por variables de entorno
            $intentos[] = [
                'host' => $host,
                'port' => $port,
                'user' => $user,
            ];

            // Si el host es un dominio directo de Supabase (db.xxxx.supabase.co),
            // en entornos sin IPv6 como Vercel se debe usar el connection pooler IPv4.
            if (preg_match('/db\.([a-z0-9]+)\.supabase\.co/i', $host, $matches)) {
                $projectRef = $matches[1];
                $poolerUser = (str_contains($user, '.')) ? $user : "postgres.{$projectRef}";

                // Pooler región São Paulo (sa-east-1)
                $intentos[] = [
                    'host' => 'aws-0-sa-east-1.pooler.supabase.com',
                    'port' => '5432',
                    'user' => $poolerUser,
                ];
                $intentos[] = [
                    'host' => 'aws-0-sa-east-1.pooler.supabase.com',
                    'port' => '6543',
                    'user' => $poolerUser,
                ];
                // Pooler región US East (us-east-1)
                $intentos[] = [
                    'host' => 'aws-0-us-east-1.pooler.supabase.com',
                    'port' => '5432',
                    'user' => $poolerUser,
                ];
                $intentos[] = [
                    'host' => 'aws-0-us-east-1.pooler.supabase.com',
                    'port' => '6543',
                    'user' => $poolerUser,
                ];
            }

            $ultimoError = null;
            foreach ($intentos as $config) {
                try {
                    $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$dbname};sslmode=require";
                    $pdo = new PDO($dsn, $config['user'], $password, $opciones);
                    $pdo->exec("SET client_encoding TO 'UTF8'");
                    self::$instancia = $pdo;
                    return self::$instancia;
                } catch (Exception $e) {
                    $ultimoError = $e;
                    // Continuar al siguiente intento si falla
                }
            }

            die("Error de conexión a la base de datos Supabase: " . ($ultimoError ? $ultimoError->getMessage() : 'Desconocido'));
        }
        return self::$instancia;
    }
}