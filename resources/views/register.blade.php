<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.2); /* Fondo semitransparente */
        }

        .contenedor h2 {
            font-size: 2.3rem;
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .input-contenedor {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .input-contenedor label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1rem;
            pointer-events: none;
            transition: 0.6s;
            font-weight: bold;
        }

        .input-contenedor input:focus ~ label,
        .input-contenedor input:valid ~ label {
            top: -5px;
            font-size: 0.75rem;
            color: #00c5ff; /* Cambia el color al foco */
        }

        .input-contenedor input {
            width: 100%;
            height: 50px; 
            background-color: transparent;
            border: none;
            font-size: 1rem;
            padding: 10px;
            color: #fff;
        }

        button {
            width: 100%;
            height: 45px;
            border-radius: 40px;
            background: #fff;
            border: none;
            font-weight: bold;
            cursor: pointer;
            outline: none;
            font-size: 1rem;
            padding: 0;
            transition: 0.4s;
        }

        button:hover {
            opacity: 0.9;
        }

        .registrar {
            font-size: 0.8rem;
            color: #fff; 
            text-align: center;
            margin: 20px 0 10px;
        }

        .registrar a {
            text-decoration: none;
            color: #00c5ff;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 40px;
            background: rgba(255, 255, 255, 0.3);
        }

        .registrar a:hover {
            background: rgba(255, 255, 255, 0.5);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section>
        <div class="contenedor">
            <h2>Registro</h2>
            <form method="POST" action="{{route('validar-registro')}}">
                @csrf
                <div class="input-contenedor mb-4">
                    <input input type="text" id="userInput" name="name" pattern="[A-Za-z\s]+" required />
                    <label for="userInput">Nombre</label>
                </div>
                <div class="input-contenedor mb-4">
                    <input type="email" id="emailInput" name="email" required />
                    <label for="emailInput">Email</label>
                </div>
                <div class="input-contenedor mb-4">
                    <input type="password" id="passwordInput" name="password" required />
                    <label for="passwordInput">Contraseña</label>
                </div>
                <button type="submit">Registrarse</button>
            </form>
            <div class="registrar">
                <p class="mb-0">¿Ya tienes cuenta?</p>
                <a href="{{ route('login') }}">Iniciar sesión</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
