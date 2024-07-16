<?php
include 'includes/header.php';
include 'config/database.php';

// Récupérer les données des JPO depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM jpo");
$stmt->execute();
$jpos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="padding: 30px">
        <h2>Envie de nous rejoindre ? Nos prochaines portes ouvertes:</h2>
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
