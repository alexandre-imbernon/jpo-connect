<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journées Portes Ouvertes</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">

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
            <a href="pdo.php">Nos portes ouvertes</a>
        </nav>
    </header>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>
