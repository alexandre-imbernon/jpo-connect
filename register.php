<?php
include 'includes/header.php';
include 'config/database.php';

$jpo_id = isset($_GET['jpo_id']) ? intval($_GET['jpo_id']) : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'register') {
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

    // Utiliser l'ID de la JPO reçu en paramètre
    if ($jpo_id) {
        // Ajouter l'inscription à la base de données
        $stmt = $pdo->prepare("INSERT INTO registrations (user_id, jpo_id, registered_at, status) VALUES (?, ?, NOW(), 'inscrit')");
        if ($stmt->execute([$user_id, $jpo_id])) {
            echo "<p>Inscription réussie !</p>";
        } else {
            echo "<p>Erreur lors de l'inscription. Veuillez réessayer.</p>";
        }
    } else {
        echo "<p>Erreur: JPO non trouvée.</p>";
    }
}
?>

<main>
    <section class="register-section" style="display: flex; justify-content: space-between; align-items: flex-start; padding: 20px;">
        <div class="register-info" style="flex: 1; margin-right: 20px;">
            <h2>Inscription aux Journées Portes Ouvertes</h2>
            <p>Nos écoles vous ouvrent leurs portes pour découvrir nos différents campus. Nos équipes et nos étudiants seront présents pour vous faire découvrir l’ensemble de nos cursus à travers des ateliers de découverte et des stands dédiés à nos différentes formations.</p>
            <p>Nous sommes présents à Marseille, Cannes, Toulon et Martigues. Venez nous rendre visite et découvrez pourquoi La Plateforme est le meilleur choix pour votre avenir.</p>
            <a href="unregister.php" class="btn">Se désinscrire</a>
        </div>
        <div class="register-form" style="flex: 1;">
            <form action="register.php?jpo_id=<?php echo $jpo_id; ?>" method="POST">
                <input type="hidden" name="action" value="register">
                <div style="margin-bottom: 10px;">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" required style="width: 100%;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required style="width: 100%;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label for="location">Lieu :</label>
                    <select id="location" name="location" required style="width: 100%;">
                        <option value="marseille">Marseille</option>
                        <option value="cannes">Cannes</option>
                        <option value="toulon">Toulon</option>
                        <option value="martigues">Martigues</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn" style="width: 100%;">S'inscrire</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
