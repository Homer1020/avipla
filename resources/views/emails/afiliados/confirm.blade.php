<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVIPLA - Crea tu cuenta de afiliado</title>
</head>
<body>
    <h1>AVIPLA - Crea tu cuenta de afiliado</h1>

    <p>Hola {{ $afiliado->name }},</p>

    <p>Estamos emocionados de darle la bienvenida a nuestra comunidad!:</p>

    <p>Por favos clickear el enlace a continuación para crear tu cuenta:</p>

    <a href="{{ route('auth.registerForm', $afiliado->confirmation_code) }}">Crear cuenta</a>

    <p>Si tienes alguna duda, por favor no dudes en contactar con nosotros.</p>

    <p>Atentamente,</p>
    <p>El equipo AVIPLA</p>
</body>
</html>
