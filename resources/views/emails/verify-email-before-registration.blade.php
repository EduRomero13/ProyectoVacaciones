<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar Email - Sunny Class</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #4f46e5; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 8px 8px; }
        .button { display: inline-block; background: #10b981; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sunny Class</h1>
            <p>Verificación de Correo Electrónico</p>
        </div>
        
        <div class="content">
            <h2>¡Hola!</h2>
            
            <p><strong>Este es el mensaje para verificar la existencia del correo</strong></p>
            
            <p>Recibimos una solicitud para verificar este correo electrónico (<strong>{{ $verificationToken->email }}</strong>) para crear una cuenta en Sunny Class.</p>
            
            <p>Para confirmar que este correo te pertenece y continuar con tu registro, haz clic en el siguiente botón:</p>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('verify.email.token', $verificationToken->token) }}" class="button">
                    Verificar mi correo y continuar registro
                </a>
            </div>
            
            <p><strong>Importante:</strong></p>
            <ul>
                <li>Este enlace expira en 30 minutos</li>
                <li>Una vez verificado, podrás completar tu registro</li>
                <li>Si no solicitaste esto, puedes ignorar este correo</li>
            </ul>
            
            <p>Si el botón no funciona, copia y pega este enlace en tu navegador:</p>
            <p style="background: #e5e7eb; padding: 10px; border-radius: 4px; font-size: 12px; word-break: break-all;">
                {{ route('verify.email.token', $verificationToken->token) }}
            </p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Sunny Class. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>