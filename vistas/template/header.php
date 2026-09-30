<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Matricula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3 mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="./?controlador=paginas&accion=inicio">SISTEMA DE MATRICULA</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./?controlador=paginas&accion=inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./?controlador=paginas&accion=nosotros">Nosotros</a>
                    </li>

                    <!-- Opciones solo para Administrador -->
                    <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin"): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./?controlador=matricula&accion=inicio">Matrícula</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./?controlador=profesores&accion=inicio">Profesores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./?controlador=estudiantes&accion=inicio">Estudiantes</a>
                        </li>
                    <?php endif; ?>

                    <!-- Cursos visible para cualquier usuario autenticado -->
                    <?php if (isset($_SESSION["idUsuario"])): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./?controlador=cursos&accion=inicio">Cursos</a>
                        </li>
                    <?php endif; ?>

                    <!-- Reportería visible para cualquier usuario autenticado -->
                    <?php if (isset($_SESSION["idUsuario"])): ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-semibold" href="./?controlador=reportes&accion=inicio">Reportería</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <?php if (isset($_SESSION["idUsuario"])): ?>
                        <span class="badge bg-secondary px-3 py-2">
                            👤 <?php echo htmlspecialchars($_SESSION["usuario"]); ?> 
                            (<?php echo strtoupper($_SESSION["rol"]); ?>)
                        </span>
                        <a class="btn btn-outline-light btn-sm" href="./?controlador=login&accion=salir">Salir</a>
                    <?php else: ?>
                        <a class="btn btn-primary btn-sm" href="./?controlador=login&accion=mostrar">Iniciar Sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>