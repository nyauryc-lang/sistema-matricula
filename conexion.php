<?php
// =====================================================
// conexion.php — Conexión inteligente a Supabase (PostgreSQL)
// Compatible con IPv6 y IPv4 (Vercel Serverless / Pooler)
// =====================================================

class BD {
    private static $instancia = null;

    public static function crearInstancia() {
        if (!isset(self::$instancia)) {
            $host   = getenv('DB_HOST')   ?: 'aws-0-ca-central-1.pooler.supabase.com';
            $port   = getenv('DB_PORT')   ?: '5432';
            $dbname = getenv('DB_NAME')   ?: 'postgres';
            $user   = getenv('DB_USER')   ?: 'postgres.zxscrsojikgbsquyuzxe';
            $rawPass = getenv('DB_PASSWORD');

            $opciones = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT            => 5,
            ];

            $projectRef = 'zxscrsojikgbsquyuzxe';
            $poolerUser = (str_contains($user, '.')) ? $user : "postgres.{$projectRef}";

            // Lista de contraseñas a intentar (limpiando comillas o espacios)
            $passwordsToTry = array_unique(array_filter([
                $rawPass ? trim($rawPass, " \t\n\r\0\x0B\"'") : null,
                'YA31Ni(24)1',
                'YA31Ni241',
            ]));

            // Configuraciones de host/puerto
            $servidores = [
                ['host' => 'aws-0-ca-central-1.pooler.supabase.com', 'port' => '5432', 'user' => $poolerUser],
                ['host' => 'aws-0-ca-central-1.pooler.supabase.com', 'port' => '6543', 'user' => $poolerUser],
            ];

            $errores = [];

            foreach ($passwordsToTry as $pass) {
                foreach ($servidores as $srv) {
                    try {
                        $dsn = "pgsql:host={$srv['host']};port={$srv['port']};dbname={$dbname};sslmode=require";
                        $pdo = new PDO($dsn, $srv['user'], $pass, $opciones);
                        $pdo->exec("SET client_encoding TO 'UTF8'");
                        self::$instancia = $pdo;
                        return self::$instancia;
                    } catch (Exception $e) {
                        $errores[] = "[{$srv['host']}:{$srv['port']} pass_len=" . strlen($pass) . "] " . $e->getMessage();
                    }
                }
            }

            die("Error de autenticación con Supabase: " . implode(" <br> ", $errores) . 
                "<br><br><b>Consejo:</b> Si cambiaste la contraseña de tu base de datos en Supabase, ve a <i>Supabase -> Settings -> Database -> Database Password</i> y dale a <i>Reset Password</i>.");
        }
        return self::$instancia;
    }
}