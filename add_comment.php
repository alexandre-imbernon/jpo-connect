<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $jpo_id = $_POST['jpo_id'];
    $comment = htmlspecialchars($_POST['comment']);

    $stmt = $pdo->prepare("INSERT INTO comments (username, jpo_id, comment) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $jpo_id, $comment])) {
        header("Location: pdo.php");
        exit;
    } else {
        echo "Erreur lors de l'ajout du commentaire.";
    }
}
?>
