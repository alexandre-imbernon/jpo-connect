<?php
include 'includes/header.php';
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);

    // Vérifier si l'utilisateur existe déjà dans la table `users`
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        // Insérer le nouvel utilisateur dans la table `users`
        $stmt = $pdo->prepare("INSERT INTO users (username, email, role) VALUES (?, ?, 'salarié')");
        $stmt->execute([$name, $email]);
        $user_id = $pdo->lastInsertId();
    } else {
        $user_id = $user['id'];
    }

    // Obtenir l'ID de la JPO en fonction de la localisation
    $stmt = $pdo->prepare("SELECT id FROM jpo WHERE location = ?");
    $stmt->execute([$location]);
    $jpo = $stmt->fetch();

    if ($jpo) {
        $jpo_id = $jpo['id'];

        // Ajouter l'inscription à la base de données
        $stmt = $pdo->prepare("INSERT INTO registrations (user_id, jpo_id, registered_at, status) VALUES (?, ?, NOW(), 'inscrit')");
        if ($stmt->execute([$user_id, $jpo_id])) {
            echo "<p>Inscription réussie !</p>";
        } else {
            echo "<p>Erreur lors de l'inscription. Veuillez réessayer.</p>";
        }
    } else {
        echo "<p>Erreur: JPO non trouvée pour cette localisation: $location.</p>";
    }
}
?>

<main>
    <section class="register">
        <h2>Inscription aux Journées Portes Ouvertes</h2>
        <form action="register.php" method="POST">
            <div>
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="location">Lieu :</label>
                <select id="location" name="location" required>
                    <option value="marseille">Marseille</option>
                    <option value="cannes">Cannes</option>
                    <option value="toulon">Toulon</option>
                    <option value="martigues">Martigues</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn">S'inscrire</button>
            </div>
        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
