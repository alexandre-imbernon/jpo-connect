<?php
include 'includes/header.php';
include 'config/database.php';

// Récupérer les données des JPO depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM jpo");
$stmt->execute();
$jpos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <section class="jpo-section" style="display: flex; flex-wrap: wrap; padding: 20px;">
        <div class="jpo-info" style="flex: 1; margin-right: 20px;">
            <h2>Journées Portes Ouvertes</h2>
            <p>Nos écoles vous ouvrent leurs portes pour découvrir nos différents campus. Nos équipes et nos étudiants seront présents pour vous faire découvrir l’ensemble de nos cursus à travers des ateliers de découverte et des stands dédiés à nos différentes formations.</p>
            <p>Nous sommes présents à Marseille, Cannes, Toulon et Martigues. Venez nous rendre visite et découvrez pourquoi La Plateforme est le meilleur choix pour votre avenir.</p>
        </div>
        <div class="jpo-list" style="flex: 2;">
            <?php foreach ($jpos as $jpo): ?>
                <div class="jpo-item" style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                    <h3><?php echo htmlspecialchars($jpo['name']); ?></h3>
                    <p><strong>Lieu :</strong> <?php echo htmlspecialchars($jpo['location']); ?></p>
                    <p><strong>Date :</strong> <?php echo htmlspecialchars($jpo['date']); ?></p>
                    <p><?php echo htmlspecialchars($jpo['description']); ?></p>
                    <a href="register.php?jpo_id=<?php echo $jpo['id']; ?>" class="btn" style="display: inline-block; padding: 10px 20px; background-color: #007BFF; color: #FFF; text-decoration: none; border-radius: 5px;">S'inscrire</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
