<div class="row justify-content-center my-5">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <span class="badge bg-primary p-3 rounded-circle mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                          <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.546-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
                          <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"/>
                        </svg>
                    </span>
                    <h3 class="fw-bold mt-2 mb-1">Iniciar Sesión</h3>
                    <p class="text-muted small">Sistema de Gestión de Matrícula</p>
                </div>

                <?php if (isset($error) && !empty($error)): ?>
                    <div class="alert alert-danger py-2 small" role="alert">
                        <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="?controlador=login&accion=verificar">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Usuario</label>
                        <input type="text" name="usuario" class="form-control" placeholder="admin o jvela" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        Ingresar al Sistema
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-center">
                    <p class="text-muted small mb-1 fw-bold">Cuentas de prueba:</p>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge bg-light text-dark border">
                            <strong>Admin:</strong> admin / miclave123
                        </span>
                        <span class="badge bg-light text-dark border">
                            <strong>Docente:</strong> jvela / miclave123
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>