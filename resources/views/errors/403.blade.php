<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado - Error 403</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
        }

        .error-container {
            background: white;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            text-align: center;
            max-width: 480px;
            width: 90%;
            border: 1px solid #e2e8f0;
        }

        .error-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e91e63 0%, #9c27b0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: white;
        }

        .error-code {
            font-size: 2.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .error-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 1rem;
        }

        .error-message {
            font-size: 0.95rem;
            color: #64748b;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-back {
            background: linear-gradient(135deg, #e91e63 0%, #9c27b0 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-back:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(233, 30, 99, 0.25);
        }

        .btn-back:active {
            transform: translateY(0);
        }

        .arrow {
            font-size: 0.875rem;
        }

        @media (max-width: 480px) {
            .error-container {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            
            .error-code {
                font-size: 2rem;
            }
            
            .error-title {
                font-size: 1.125rem;
            }

            .error-message {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            🚫
        </div>
        <div class="error-code">403</div>
        <h1 class="error-title">Acceso Denegado</h1>
        <p class="error-message">
            No tienes los permisos necesarios para acceder a esta página. Contacta al administrador si crees que es un error.
        </p>
        <button class="btn-back" onclick="goBack()">
            <span class="arrow">←</span>
            Volver Atrás
        </button>
    </div>

    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                goBack();
            }
        });
    </script>
</body>
</html>