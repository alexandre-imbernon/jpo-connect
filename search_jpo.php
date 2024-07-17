<?php
include 'config/database.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Récupérer les données des JPO depuis la base de données avec recherche par lieu uniquement
try {
    $stmt = $pdo->prepare("SELECT * FROM jpo WHERE location LIKE ?");
    $searchTerm = "%" . $search . "%";
    $stmt->execute([$searchTerm]);
    $jpos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($jpos);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
