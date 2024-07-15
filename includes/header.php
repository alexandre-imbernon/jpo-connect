<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journées Portes Ouvertes</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #FFFFFF;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header img {
            width: 400px; /* Ajuste la taille selon tes besoins */
            height: auto;
        }

        .burger {
            cursor: pointer;
            padding: 15px;
            position: relative;
            z-index: 1001;
        }

        .burger div {
            width: 30px;
            height: 3px;
            background-color: #0062FF;
            margin: 5px;
            transition: all 0.3s;
        }
        
        .englobe {
            padding: 20px;
        }
        .menu {
            display: none;
            flex-direction: column;
            position: absolute;
            right: 20px;
            top: 60px;
            background-color: #FFFFFF;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            z-index: 1000;
        }

        .menu a {
            padding: 10px 20px;
            text-decoration: none;
            color: #0062FF;
        }

        .menu a:hover {
            background-color: #f0f0f0;
        }

        .active {
            display: flex;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php">
            <img src="https://laplateforme.io/wp-content/uploads/2024/02/logo-laplateforme-2024.png" alt="Logo La Plateforme">
        </a>
        <div class="burger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <nav class="menu" id="menu">
            <a href="index.php">Accueil</a>
            <a href="register.php">S'inscrire</a>
        </nav>
    </header>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('active');
        }
    </script>
