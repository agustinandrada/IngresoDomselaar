<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reestablecer Contraseña</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
        }

        /* Contenedor principal */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
        }

        /* Encabezado */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 200px;
        }

        /* Contenido principal */
        .content {
            padding: 20px;
            text-align: center;
        }

        /* Botón */
        .button {
            display: inline-block;
            background-color: #ff5722;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Pie de página */
        .footer {
            text-align: center;
            color: #999999;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<body style="margin: 0; padding: 0; font-family: 'Montserrat', Arial, sans-serif;">
    <div style="max-width: 600px; margin: 20px auto;">
        <div style="text-align: center;">
            <h1 style="font-family: 'Montserrat', Arial, sans-serif;">Restablecer contraseña</h1>
            <h3 style="font-family: 'Montserrat', Arial, sans-serif;">{{ $email }}</h3>
        </div>
        <div style="text-align: start;">
            <p style="font-family: 'Montserrat', Arial, sans-serif;">Estimado/a,</p>
            <p style="font-family: 'Montserrat', Arial, sans-serif;">Recibió este correo electrónico porque hemos
                recibido una solicitud para restablecer la contraseña de su cuenta. Para continuar con el proceso de
                restablecimiento, haga clic en el siguiente enlace:</p>
            <p style="font-family: 'Montserrat', Arial, sans-serif;"><a
                    href="{{ url('password/' . $encryptedEmail) }}">Restablecer contraseña</a></p>
            <p style="font-family: 'Montserrat', Arial, sans-serif;">Si no solicitó restablecer su contraseña, puede
                ignorar este mensaje. Su contraseña no será cambiada.</p>
            <p style="font-family: 'Montserrat', Arial, sans-serif;">Si tiene alguna pregunta o necesita asistencia
                adicional, no dude en comunicarse con nosotros.</p>
            <p style="font-family: 'Montserrat', Arial, sans-serif;">¡Gracias y que tenga un excelente día!</p>
        </div>
    </div>
    @include('layouts.bodyScripts')
</body>


</html>
