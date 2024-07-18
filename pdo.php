<?php
session_start(); // Démarre la session

include 'includes/header.php';
include 'config/database.php';

// Récupérer toutes les JPO depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM jpo");
$stmt->execute();
$jpos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="padding: 30px">
    <h2>Envie de nous rejoindre ? Retrouvez nos prochaines #JPO:</h2>
    
    <form id="search-form" method="get" action="" style="margin-bottom: 20px;">
        <input type="text" id="search-input" name="search" placeholder="Rechercher par ville..." style="padding: 10px; width: 80%; border: 1px solid #ccc; border-radius: 5px;">
    </form>
    
    <div id="jpo-list" class="jpo-list" style="flex: 2;">
        <?php foreach ($jpos as $jpo): ?>
            <div class="jpo-item" style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                <h3><?php echo htmlspecialchars($jpo['name'] ?? ''); ?></h3>
                <p><strong>Lieu :</strong> <?php echo htmlspecialchars($jpo['location'] ?? ''); ?></p>
                <p><strong>Date :</strong> <?php echo htmlspecialchars($jpo['date'] ?? ''); ?></p>
                <p><?php echo htmlspecialchars($jpo['description'] ?? ''); ?></p>
                <a href="register.php?jpo_id=<?php echo $jpo['id']; ?>" class="btn" style="display: inline-block; padding: 10px 20px; background-color: #007BFF; color: #FFF; text-decoration: none; border-radius: 5px;">S'inscrire</a>

                <!-- Comment Section -->
                <?php
                // Récupérer les commentaires pour cette JPO
                $stmt_comments = $pdo->prepare("SELECT comments.*, COALESCE(users.username, comments.username) AS username FROM comments LEFT JOIN users ON comments.user_id = users.id WHERE jpo_id = ? ORDER BY created_at DESC");
                $stmt_comments->execute([$jpo['id']]);
                $comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);
                $comment_count = count($comments);
                ?>

                <div class="comments-toggle" style="margin-top: 20px;">
                    <button onclick="toggleComments(<?php echo $jpo['id']; ?>)" style="padding: 10px; background-color: #007BFF; color: #FFF; border: none; border-radius: 5px;">Voir les avis (<?php echo $comment_count; ?>)</button>
                </div>

                <div id="comments-<?php echo $jpo['id']; ?>" class="comments-section" style="display: none; margin-top: 20px;">
                    <h4>Commentaires :</h4>
                    <?php foreach ($comments as $comment): ?>
                    <div class="comment" style="margin-bottom: 15px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                        <p><strong><?php echo htmlspecialchars($comment['username'] ?? ''); ?></strong> <em><?php echo htmlspecialchars($comment['created_at'] ?? ''); ?></em></p>
                        <p><?php echo htmlspecialchars($comment['comment'] ?? ''); ?></p>

                        <!-- Moderator Responses -->
                        <?php
                        $stmt_responses = $pdo->prepare("SELECT moderator_responses.*, users.username FROM moderator_responses JOIN users ON moderator_responses.moderator_id = users.id WHERE comment_id = ? ORDER BY created_at DESC");
                        $stmt_responses->execute([$comment['id']]);
                        $responses = $stmt_responses->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($responses as $response):
                        ?>
                        <div class="response" style="margin-top: 10px; border-left: 2px solid #007BFF; padding-left: 10px;">
                            <p><strong><?php echo htmlspecialchars($response['username'] ?? ''); ?></strong> <em><?php echo htmlspecialchars($response['created_at'] ?? ''); ?></em></p>
                            <p><?php echo htmlspecialchars($response['response'] ?? ''); ?></p>
                        </div>
                        <?php endforeach; ?>

                        <!-- Response Form for Moderator -->
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'moderator'): ?>
                        <form method="post" action="add_response.php" style="margin-top: 10px;">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                            <textarea name="response" required placeholder="Répondre à ce commentaire" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
                            <button type="submit" class="btn" style="margin-top: 10px;">Répondre</button>
                        </form>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Add Comment Form -->
                <form method="post" action="add_comment.php" style="margin-top: 20px;">
                    <input type="hidden" name="jpo_id" value="<?php echo $jpo['id']; ?>">
                    <input type="text" name="username" required placeholder="Votre nom" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <textarea name="comment" required placeholder="Ajouter un commentaire" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
                    <button type="submit" class="btn" style="margin-top: 10px;">Commenter</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="assets/js/search.js"></script>
<script>
function toggleComments(jpoId) {
    const commentsSection = document.getElementById('comments-' + jpoId);
    if (commentsSection.style.display === 'none') {
        commentsSection.style.display = 'block';
    } else {
        commentsSection.style.display = 'none';
    }
}
</script>
