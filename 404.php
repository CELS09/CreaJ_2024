<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página No Encontrada</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-50">

    <div class="text-center p-8 rounded-lg shadow-2xl max-w-md w-full fade-in">
        <h1 class="text-8xl font-extrabold text-gray-800 mb-4">404</h1>
        <br>
        <p class="text-3xl font-bold text-gray-500">¡Oops!</p>
        <p class="text-2xl text-gray-600 mb-4 font-semibold">Página no encontrada</p>
        <p class="text-gray-500 mb-6 font-semibold">La página que buscas no existe o ha sido movida.</p>
        <a href="index.php" class="inline-block bg-blue-500 text-white font-medium py-2 px-4 rounded hover:bg-blue-600 transition-colors">
            Regresar al inicio
        </a>
    </div>

</body>
</html>
