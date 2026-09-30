<?php
// Punto de entrada para Vercel Serverless Functions
// Cambia al directorio raíz para mantener las rutas relativas
chdir(__DIR__ . '/..');

// Carga la aplicación MVC principal
require __DIR__ . '/../index.php';
