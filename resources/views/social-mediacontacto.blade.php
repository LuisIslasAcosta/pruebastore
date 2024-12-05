<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redes Sociales</title>
    <!-- Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap for styles (optional, puedes usar solo CSS si lo prefieres) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        /* Estilos para la página de redes sociales */
        body {
            background-color: #2c3e50;
            color: #ecf0f1;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            position: relative; /* Para que el posicionamiento absoluto funcione correctamente */
        }

        .container {
            margin-top: 50px;
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #ecf0f1;
        }

        .social-media-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .social-media-item {
            width: 250px;
            background-color: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .social-media-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
        }

        .social-media-item h4 {
            margin-top: 10px;
            font-size: 1.2rem;
            color: #333;
        }

        .social-media-item p {
            font-size: 1rem;
            color: #777;
        }

        .social-media-item a {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #3b5998;
            color: white;
            border-radius: 5px;
            margin-top: 15px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .social-media-item a:hover {
            background-color: #2d4373;
        }

        /* Estilo mejorado para el botón */
        .custom-btn {
            position: absolute;  
            top: 10px;           
            left: 10px;          
            padding: 12px 25px;  /* Tamaño del botón */
            background: linear-gradient(145deg, #6a8bfc, #3b5998); /* Gradiente de color */
            color: white;        
            border-radius: 50px;  /* Bordes redondeados */
            text-decoration: none; /* Eliminar subrayado */
            font-size: 1.2rem;     /* Tamaño de la fuente */
            font-weight: bold;     /* Hacer el texto en negrita */
            text-transform: uppercase; /* Texto en mayúsculas */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);  /* Sombra sutil */
            transition: all 0.3s ease; /* Efecto suave para todos los cambios */
            z-index: 10;         /* Asegura que el botón esté sobre otros elementos */
        }

        /* Efecto hover: cambio de color y desplazamiento */
        .custom-btn:hover {
            background: linear-gradient(145deg, #3b5998, #6a8bfc); /* Cambio de gradiente */
            transform: translateY(-4px);  /* Desplazamiento sutil hacia arriba */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Sombra más grande */
        }

        /* Efecto focus (cuando el botón está enfocado) */
        .custom-btn:focus {
            outline: none; /* Elimina el borde por defecto */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5); /* Resaltado con foco */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #34495e;
            color: #ecf0f1;
            padding: 10px;
            text-align: center;
        }
        
    </style>
</head>
<body>

    <!-- Enlace al panel de administración en la parte superior izquierda -->
    <div class="mb-3">
    <a href="{{ url('/') }}" class="custom-btn">Volver a pantalla de inicio</a>
    </div>

    <div class="container">
        <h2>¡Síguenos en nuestra página de Facebook!</h2>

        <div class="social-media-buttons">
            <!-- Facebook -->
            <div class="social-media-item">
                <img src="/img/Luis.jpeg" alt="Sofi">
                <h4>Luis Enrique Islas Acosta</h4>
                <a href="https://www.facebook.com/Darkar511?mibextid=ZbWKwL" target="_blank">
                    <i class="fab fa-facebook-f"></i> Ir a Facebook
                </a>
            </div>
            <div class="social-media-item">
                <img src="/img/Sofi.jpeg" alt="Sofi">
                <h4>Sofia Sanchez Duran</h4>
                <a href="https://www.facebook.com/sofia.nxlogix?mibextid=ZbWKwL" target="_blank">
                    <i class="fab fa-facebook-f"></i> Ir a Facebook
                </a>
            </div>
            <div class="social-media-item">
                <img src="/img/Mon.jpeg" alt="Sofi">
                <h4>Nancy Montserrat Colin Hernandez</h4>
                <a href="https://www.facebook.com/profile.php?id=100070859655483&mibextid=ZbWKwL" target="_blank">
                    <i class="fab fa-facebook-f"></i> Ir a Facebook
                </a>
            </div>
        </div>
        
        <p>Conéctate con nosotros en Facebook y mantente al día con nuestras últimas actualizaciones.</p>
    </div>

    <div class="footer">
        <p>&copy; 2024 Tu Empresa. Todos los derechos reservados.</p>
    </div>

</body>
</html>
