<?php
// =====================================================
// conexion.php — Conexión inteligente a Supabase (PostgreSQL)
// Compatible con IPv6 y IPv4 (Vercel Serverless / Pooler)
// =====================================================

class BD {
    private static $instancia = null;

    public static function crearInstancia() {
        if (!isset(self::$instancia)) {
            $host     = getenv('DB_HOST')     ?: 'aws-0-ca-central-1.pooler.supabase.com';
            $port     = getenv('DB_PORT')     ?: '5432';
            $dbname   = getenv('DB_NAME')     ?: 'postgres';
            $user     = getenv('DB_USER')     ?: 'postgres.zxscrsojikgbsquyuzxe';
            $password = getenv('DB_PASSWORD') ?: 'YA31Ni(24)1';

            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT            => 5,
            ];

            $projectRef = 'zxscrsojikgbsquyuzxe';
            $poolerUser = (str_contains($user, '.')) ? $user : "postgres.{$projectRef}";

            // Lista de configuraciones en orden de prioridad:
            // Tu proyecto está en la región Canada Central (ca-central-1)
            $intentos = [
                [
                    'host' => 'aws-0-ca-central-1.pooler.supabase.com',
                    'port' => '5432',
                    'user' => $poolerUser,
                ],
                [
                    'host' => 'aws-0-ca-central-1.pooler.supabase.com',
                    'port' => '6543',
                    'user' => $poolerUser,
                ],
                [
                    'host' => 'aws-0-sa-east-1.pooler.supabase.com',
                    'port' => '5432',
                    'user' => $poolerUser,
                ],
                [
                    'host' => 'aws-0-sa-east-1.pooler.supabase.com',
                    'port' => '6543',
                    'user' => $poolerUser,
                ],
                [
                    'host' => "db.{$projectRef}.supabase.co",
                    'port' => '5432',
                    'user' => 'postgres',
                ],
            ];

            // Si DB_HOST vino configurado y no es db.xxxx, ponerlo al inicio
            if ($host && !str_starts_with($host, 'db.')) {
                array_unshift($intentos, [
                    'host' => $host,
                    'port' => $port,
                    'user' => $user,
                ]);
            }

            $errores = [];
            foreach ($intentos as $config) {
                try {
                    $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$dbname};sslmode=require";
                    $pdo = new PDO($dsn, $config['user'], $password, $opciones);
                    $pdo->exec("SET client_encoding TO 'UTF8'");
                    self::$instancia = $pdo;
                    return self::$instancia;
                } catch (Exception $e) {
                    $errores[] = "[{$config['host']}:{$config['port']}] " . $e->getMessage();
                }
            }

            die("Error de conexión a la base de datos Supabase: " . implode(" | ", $errores));
        }
        return self::$instancia;
    }
}