<?php
include 'includes/header.php';
include 'config/database.php';

$jpo_id = isset($_GET['jpo_id']) ? intval($_GET['jpo_id']) : null;

// Récupérer les données de la JPO sélectionnée
$jpo = null;
if ($jpo_id) {
    $stmt = $pdo->prepare("SELECT * FROM jpo WHERE id = ?");
    $stmt->execute([$jpo_id]);
    $jpo = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'register') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($jpo ? $jpo['location'] : $_POST['location']); // Get location from JPO or POST

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

    // Ajouter l'inscription à la base de données
    if ($jpo_id) {
        $stmt = $pdo->prepare("INSERT INTO registrations (user_id, jpo_id, registered_at, status) VALUES (?, ?, NOW(), 'inscrit')");
        if ($stmt->execute([$user_id, $jpo_id])) {
            echo "<p>Inscription réussie !</p>";
        } else {
            echo "<p>Erreur lors de l'inscription. Veuillez réessayer.</p>";
        }
    } else {
        $stmt = $pdo->prepare("INSERT INTO registrations (user_id, jpo_id, registered_at, status) VALUES (?, NULL, NOW(), 'inscrit')");
        if ($stmt->execute([$user_id])) {
            echo "<p>Inscription réussie sans JPO spécifique !</p>";
        } else {
            echo "<p>Erreur lors de l'inscription. Veuillez réessayer.</p>";
        }
    }
}
?>

<main>
<h2 style="text-align: center;">Inscription aux Journées Portes Ouvertes</h2>
    <section class="register-section" style="display: flex; justify-content: space-between; align-items: flex-start; padding: 20px;">
        <div class="register-info" style="flex: 1; margin-right: 20px;">
            <p>Les métiers du numérique vous attirent ? 👨‍💻 Ça tombe bien, c’est un secteur en plein essor !</p>
            <p>Pour vous former, rejoignez La Plateforme, le campus méditerranéen du numérique ! 🙌</p>
            <p>Nos équipes et étudiants seront présents pour vous faire découvrir l'ensemble de nos cursus à travers des ateliers et des stands dédiés à nos différentes formations :</p>
            <p>✔️ Bachelor / Bac +3 (5 spécialités : Web & Web Mobile, Logiciel, IA, Cybersécurité, Systèmes Immersifs)</p>
            <p>✔️ Master of Science (MSc) / Bac +5 (2 spécialités : Web & Web Mobile, IA)</p>
            <p>✔️ Post-graduate / Bac +6 : sur l’intelligence artificielle avec l’École Centrale de Marseille, et sur le management d'innovation.</p>
            <p>Au programme :</p>
            <p>Accueil</p>
            <p>Présentation de l'école et des formations</p>
            <p>Visite de l'école, ateliers & stands</p>
            <p>La Plateforme, c’est :</p>
            <p>👉 4 écoles à Marseille, Cannes, Toulon et Martigues !</p>
            <p>👉 Des formations en informatique ouvertes à tous, reconnues par l’État, en alternance et sans frais de formation !</p>
            <p>Vous avez envie de devenir développeur, expert en cyber-sécurité, spécialiste de l’intelligence artificielle, ou ingénieur 3D ?</p>
            <p>Retrouvez-nous à nos différentes portes ouvertes !</p>
        </div>

        <div class="register-form" style="flex: 1; display: flex; flex-direction: column; justify-content: center; margin-top: 20%;">
            <form action="register.php?jpo_id=<?php echo $jpo_id; ?>" method="POST" style="display: flex; flex-direction: column;">
                <input type="hidden" name="action" value="register">
                <div style="margin-bottom: 10px;">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" required style="width: 100%">
                </div>
                <div style="margin-bottom: 10px;">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required style="width: 100%">
                </div>
                <div style="margin-bottom: 10px;">
                    <label for="location">Lieu :</label>
                    <?php if ($jpo): ?>
                        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($jpo['location']); ?>" readonly style="width: 100%; height: 40px;">
                    <?php else: ?>
                        <select id="location" name="location" required style="width: 100%; height: 40px;">
                            <option value="marseille">Marseille</option>
                            <option value="cannes">Cannes</option>
                            <option value="toulon">Toulon</option>
                            <option value="martigues">Martigues</option>
                        </select>
                    <?php endif; ?>
                </div>
                <div>
                    <button type="submit" class="btn" style="width: 100%; height: 40px;">S'inscrire</button>
                    <p style="margin-top: 10px;">Un empêchement ? Cliquez <a href="unregister.php" class="link">ici</a> pour vous désinscrire</p>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>