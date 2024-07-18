<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $moderator_id = $_SESSION['user_id'];
    $comment_id = $_POST['comment_id'];
    $response = htmlspecialchars($_POST['response']);

    $stmt = $pdo->prepare("INSERT INTO moderator_responses (comment_id, moderator_id, response) VALUES (?, ?, ?)");
    if ($stmt->execute([$comment_id, $moderator_id, $response])) {
        header("Location: pdo.php");
        exit;
    } else {
        echo "Erreur lors de l'ajout de la réponse.";
    }
}
?>
