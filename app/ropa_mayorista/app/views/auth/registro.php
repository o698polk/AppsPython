<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Registro') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center py-4" style="min-height: 100vh;">
    <main class="form-signin w-100 m-auto" style="max-width: 500px;">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="text-center mb-4 text-primary">Crear Cuenta</h2>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="registro/post">
                    <div class="row">
                        <div class="col-md-6 mb-3 form-floating">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                            <label for="nombre" class="ms-2">Nombre</label>
                        </div>
                        <div class="col-md-6 mb-3 form-floating">
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                            <label for="apellido" class="ms-2">Apellido</label>
                        </div>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="name@example.com" required>
                        <label for="correo">Correo Electrónico</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                        <label for="telefono">Teléfono (Opcional)</label>
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required minlength="8">
                        <label for="password">Contraseña (Mínimo 8 caracteres)</label>
                    </div>
                    
                    <button class="w-100 btn btn-lg btn-success" type="submit">Registrarse</button>
                </form>
                <div class="text-center mt-3">
                    <p>¿Ya tienes cuenta? <a href="login">Inicia Sesión</a></p>
                    <a href="/">← Volver al Catálogo</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
