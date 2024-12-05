<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
    body {
        margin: 0;
        padding: 0;
        background: url(/img/fondo1.jpg) no-repeat center center fixed;
        background-size: cover;
    }

    section {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        min-height: 100vh;
    }

    .contenedor {
        position: relative;
        width: 500px;
        border: 2px solid rgba(255, 255, 255, 0.6);
        border-radius: 20px;
        backdrop-filter: blur(15px);
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.2); /* Fondo semitransparente */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2); /* Sombra */
    }

    .contenedor h2 {
        font-size: 2.5rem;
        color: #fff;
        text-align: center;
        margin-bottom: 25px;
        font-family: 'Arial', sans-serif;
        letter-spacing: 1px;
    }

    .input-contenedor {
        position: relative;
        margin-bottom: 20px;
        width: 100%;
    }

    .input-contenedor label {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        color: #fff;
        font-size: 1rem;
        pointer-events: none;
        transition: 0.3s;
        font-weight: bold;
    }

    .input-contenedor input:focus ~ label,
    .input-contenedor input:valid ~ label {
        top: -10px;
        font-size: 0.85rem;
        color: #00c5ff; /* Cambia el color al foco */
    }

    .input-contenedor input {
        width: 100%;
        height: 50px;
        background-color: transparent;
        border: 2px solid rgba(255, 255, 255, 0.6);
        border-radius: 30px;
        font-size: 1rem;
        padding: 10px;
        color: #fff;
        outline: none;
        transition: border-color 0.3s;
    }

    .input-contenedor input:focus {
        border-color: #00c5ff;
    }

    button {
        width: 100%;
        height: 50px;
        border-radius: 40px;
        background: #007bff; /* Color de fondo azul */
        border: none;
        font-weight: bold;
        color: #fff;
        font-size: 1.2rem;
        cursor: pointer;
        outline: none;
        transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
    }

    button:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        background-color: #0056b3; /* Azul más oscuro al pasar el mouse */
    }

    .registrar {
        font-size: 1rem;
        color: #fff;
        text-align: center;
        margin: 20px 0 10px;
    }

    .registrar a {
        text-decoration: none;
        color: #fff; /* Color blanco */
        font-weight: bold;
        transition: 0.3s;
        display: inline-block;
        padding: 12px 25px;
        border-radius: 40px;
        background: #007bff; /* Azul como el botón de acceder */
        font-size: 1rem;
    }

    .registrar a:hover {
        background: #0056b3; /* Azul más oscuro */
        text-decoration: underline;
    }

    .admin-login a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        transition: 0.3s;
        display: inline-block;
        padding: 12px 25px;
        border-radius: 40px;
        background: #007bff; /* Azul igual al de acceso */
        font-size: 1rem;
    }

    .admin-login a:hover {
        background: #0056b3; /* Azul más oscuro */
        text-decoration: underline;
    }
</style>

</head>
<body>
    <section>
        <div class="contenedor">
            <h2>Iniciar como Admin</h2>
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="input-contenedor mb-4">
                    <input type="email" id="email" name="email" required />
                    <label for="email">Correo Electrónico</label>
                </div>
                <div class="input-contenedor mb-4">
                    <input type="password" id="password" name="password" required />
                    <label for="password">Contraseña</label>
                </div>
                <button type="submit">Iniciar sesión</button>
            </form>

            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Enlace para iniciar sesión como administrador -->
            <div class="registrar">
                <p class="mb-0">¿No eres administrador?</p>
                <a href="{{ route('login') }}">Inicia sesión como usuario</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
