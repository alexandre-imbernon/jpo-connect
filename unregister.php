<?php
include 'includes/header.php';
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    
    // Vérifier si l'utilisateur est inscrit
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $user_id = $user['id'];
        
        // Supprimer l'inscription
        $stmt = $pdo->prepare("DELETE FROM registrations WHERE user_id = ?");
        if ($stmt->execute([$user_id])) {
            echo "<p>Désinscription réussie !</p>";
        } else {
            echo "<p>Erreur lors de la désinscription. Veuillez réessayer.</p>";
        }
    } else {
        echo "<p>Erreur: Utilisateur non trouvé pour cet email: $email.</p>";
    }
}
?>

<main>
    <section class="unregister">
        <form action="unregister.php" method="POST">
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required placeholder="Pour vous désinscrire, veuillez saisir votre mail ici">
            </div>
            <div>
                <button type="submit" class="btn">Me désinscrire</button>
            </div>
        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
