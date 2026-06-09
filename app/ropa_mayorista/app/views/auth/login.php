<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Login') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center py-4" style="height: 100vh;">
    <main class="form-signin w-100 m-auto" style="max-width: 400px;">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="text-center mb-4 text-primary">Iniciar Sesión</h2>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                
                <?php if (isset($success)): ?>
                    <div class="alert alert-success" role="alert"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>

                <form method="POST" action="login/post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="name@example.com" required>
                        <label for="correo">Correo Electrónico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                        <label for="password">Contraseña</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
                </form>
                <div class="text-center mt-3">
                    <p>¿No tienes cuenta? <a href="registro">Regístrate aquí</a></p>
                    <a href="/">← Volver al Catálogo</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
