<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVIPLA - Recordatorio para crear cuenta de afiliado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #323567;
            text-align: center;
        }

        p {
            color: #555555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #323567;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #323567;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #999999;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mb-4">
          <img src="{{ asset('assets/img/logo.png') }}" alt="Logo AVIPLA" width="100px">
        </div>
        <h1>AVIPLA - Recordatorio para crear cuenta de afiliado</h1>

        <p>Hola {{ $solicitud->razon_social }},</p>

        <p>Estamos emocionados de darle la bienvenida a nuestra comunidad:</p>

        <p>Por favor, haz clic en el enlace a continuación para crear tu cuenta:</p>

        <p><a href="{{ route('auth.registerForm', $solicitud->confirmation_code) }}">Crear cuenta</a></p>

        <p>Si tienes alguna duda, por favor no dudes en contactar con nosotros.</p>

        <p>Atentamente,</p>
        <p>El equipo AVIPLA</p>
        
        <div class="footer">
            <p>Este es un mensaje automático. Por favor no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>