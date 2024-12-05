<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Incluye CSS de Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <style>
    body {
        height: 100%;
        overflow: auto;
        background-image: url('img/fondo.jpeg'); /* Cambia la imagen si es necesario */
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Fija la imagen de fondo */
        color: #f8f9fa;
        position: relative; 
    }
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Capa oscura con 50% de opacidad */
        z-index: 1; /* Asegura que el overlay esté detrás del contenido */
    }
    .navbar {
        background-color: rgba(0, 0, 0, 0.7); /* Fondo oscuro semi-transparente */
        position: fixed;
        width: 100%;
        z-index: 3; /* Asegura que el menú esté sobre otros contenidos */
        top: 0;
        left: 0;
        padding: 25px 0;
    }
    .content {
        margin-top: 80px; /* Ajusta el valor según el alto del navbar */
        position: relative;
        z-index: 2;
    }
    .separado {
        /* Elimina el margen superior para que esté justo debajo de la navbar */
        margin-top: 0; 
        padding-top: 150px; /* Agrega un relleno superior para compensar la altura del navbar */
    }
    nav, .container-sm {
        position: relative;
        z-index: 2;
    }
    .nav-link {
        color: #f8f9fa !important; /* Color blanco para los enlaces */
    }
    .nav-link:hover {
        color: #adb5bd !important; /* Color gris claro al hacer hover */
    }
    .nav-link.active {
        color: #f8f9fa !important; /* Asegura que los enlaces activos también se vean en blanco */
    }
    .product-card {
        background-color: #171616; /* Fondo gris */
        color: #ffffff; /* Texto blanco */
        border: none; /* Quitar el borde */
        margin: 0; /* Eliminar el margen */
        width: 100%; /* Asegura que la tarjeta use el ancho completo */
    }
    .product-card img {
        height: 400px; /* Ajusta la altura de la imagen */
        width: 100%; /* Asegura que la imagen se ajuste al contenedor */
        object-fit: cover; /* Asegura que la imagen se ajuste bien */
    }
    .hero-section {
        background: url('/imagenes/fondo2.jpg') no-repeat center center;
        background-size: cover;
        color: #fff;
        text-align: center;
        padding: 400px 0;
        position: relative;
    }
    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
    .hero-section .container {
        position: relative;
        z-index: 2;
    }
    .hero-section h1 {
        font-size: 4rem;
        margin-bottom: 0.5rem;
    }
    .hero-section p {
        font-size: 1.25rem;
    }
    .section {
        padding: 60px 0;
        background-color: #000; /* Fondo negro para todas las secciones */
        color: #fff; /* Texto blanco en las secciones */
    }
    .section h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    .section img {
        max-width: 100%;
        height: auto;
    }
    .contact-form {
        background-color: #171616; /* Fondo gris para el formulario */
        color: #ffffff; /* Texto blanco dentro del formulario */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra ligera */
    }
</style>

</head>
<body>
    <nav class="navbar">
        <div class="container-sm">
        <h1>Store SLM</h1>
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a class="nav-link" href="#Productos">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Sobre">Mas Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Iniciar sesion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('registro')}}">Registrate</a>
                </li>
            </ul>
        </div>
    </nav>

    
    <div class="separado container-sm content" id="Productos">
        <h2 class="text-center">Algunos de nuestros productos</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="product-card">
                    <img src="img/smartwatch.jpg" class="card-img-top" alt="Producto 1">
                    <div class="card-body">
                        <h5 class="card-title">Smartwatch</h5>
                        <p class="card-text">Explora la última generación en tecnología de relojes inteligentes, 
                            con funciones avanzadas gestiona tus notificaciones y personaliza tu experiencia diaria.
                        </p>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="img/laptop.jpg" class="card-img-top" alt="Producto 2">
                    <div class="card-body">
                        <h5 class="card-title">Laptops</h5>
                        <p class="card-text">Potencia tu productividad con nuestra gama de laptops de alta gama. 
                            Diseño elegante, rendimiento superior y las mejores características al precio más competitivo.
                        </p>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="img/smartphone.jpg" class="card-img-top" alt="Producto 3">
                    <div class="card-body">
                        <h5 class="card-title">Telefonia</h5>
                        <p class="card-text">Descubre nuestra amplia selección de smartphones de las marcas más reconocidas, 
                            diseñados para brindarte la mejor experiencia en conectividad, rendimiento y estilo.
                        </p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <br>
    
    <section class="section">
        <div class="container" id="Sobre">
            <div class="owl-carousel owl-theme">
                <div class="item"><img src="/img/uno.webp" class="img-fluid rounded" alt="Carousel Image 1"></div>
                <div class="item"><img src="/img/dos.webp" class="img-fluid rounded" alt="Carousel Image 2"></div>
                <div class="item"><img src="/img/tres.webp" class="img-fluid rounded" alt="Carousel Image 3"></div>
            </div>
        </div>
    </section>

    <br>

    <div class="separado container-sm content">
        <h1>¿Quienes somos?</h1>
        <p>
            Somos un grupo de estudiantes de Universidad Tecnoogica del Valle de Toluca que estamos desarrollando un proyecto
            que sea un Sistema de Gestion de Ventas. El nombre de nuestra empresa es Store SLM, esta solo es una simulacion
            de ventas de productos tecnologicos por lo que es informacion ficticia y no veridica.
        </p>
    </div>

    <br>

    
    <div id="contacto">
        <div class="container-sm">
            <form class="contact-form text-center">
            <h2>Contáctanos</h2>
            <a href="{{ route('social-mediacontacto') }}" target="_blank" class="m-2">
                    <i class="bi bi-facebook" style="font-size: 40px;">  </i>
                </a>
            </form>
        </div>
    </div>

    
    <br><br>

    <!-- Incluye jQuery antes de Owl Carousel -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluye JS de Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 1
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
