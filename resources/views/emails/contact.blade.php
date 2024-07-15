<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVIPLA - Contacto</title>
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

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #333333;
        }

        h1 {
            margin: 0.5rem 0;
            font-size: 24px;
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
            color: #999999;
            font-size: 14px;
        }

        .img-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="img-container">
            <img src="{{ $message->embed(asset('assets/img/logo.png')) }}" alt="Logo Avipla" width="100">
        </div>
        <h1>{{ $data['asunto'] }}</h1>

        <p>Hola! Tienes un nuevo correo de contacto desde el sitio web de AVIPLA.</p>

        <p><b>Asunto:</b> {{ $data['asunto'] }}</p>
        <p><b>correo:</b> {{ $data['correo'] }}</p>
        <p><b>Nombre y apellido:</b> {{ $data['nombre'] . ' ' . $data['apellido'] }}</p>
        <h4>Mensaje: </h4>
        <p>{{ $data['mensaje'] }}</p>

        <hr>

        <p>Atentamente,</p>
        <p>El equipo AVIPLA</p>
        
        <div class="footer">
            <p>Este es un mensaje automático. Por favor no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>