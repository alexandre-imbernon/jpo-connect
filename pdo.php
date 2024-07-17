<?php
include 'includes/header.php';
include 'config/database.php';

// Récupérer toutes les JPO depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM jpo");
$stmt->execute();
$jpos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="padding: 30px">
    <h2>Envie de nous rejoindre ? Nos prochaines portes ouvertes:</h2>
    
    <form id="search-form" method="get" action="" style="margin-bottom: 20px;">
        <input type="text" id="search-input" name="search" placeholder="Rechercher par ville..." style="padding: 10px; width: 80%; border: 1px solid #ccc; border-radius: 5px;">
    </form>
    
    <div id="jpo-list" class="jpo-list" style="flex: 2;">
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
</main>

<?php include 'includes/footer.php'; ?>

<script>
document.getElementById('search-input').addEventListener('input', function() {
    var search = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'search_jpo.php?search=' + encodeURIComponent(search), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = xhr.responseText;
            console.log(response); // Ajoutez ceci pour vérifier la réponse
            var jpos = JSON.parse(response);
            var jpoList = document.getElementById('jpo-list');
            jpoList.innerHTML = '';
            if (jpos.length > 0) {
                jpos.forEach(function(jpo) {
                    var jpoItem = document.createElement('div');
                    jpoItem.className = 'jpo-item';
                    jpoItem.style.marginBottom = '20px';
                    jpoItem.style.border = '1px solid #ccc';
                    jpoItem.style.padding = '10px';
                    jpoItem.style.borderRadius = '5px';
                    
                    jpoItem.innerHTML = `
                        <h3>${jpo.name}</h3>
                        <p><strong>Lieu :</strong> ${jpo.location}</p>
                        <p><strong>Date :</strong> ${jpo.date}</p>
                        <p>${jpo.description}</p>
                        <a href="register.php?jpo_id=${jpo.id}" class="btn" style="display: inline-block; padding: 10px 20px; background-color: #007BFF; color: #FFF; text-decoration: none; border-radius: 5px;">S'inscrire</a>
                    `;
                    
                    jpoList.appendChild(jpoItem);
                });
            } else {
                jpoList.innerHTML = '<p>Aucune JPO trouvée pour cette ville.</p>';
            }
        } else {
            console.error('Erreur de la requête AJAX', xhr.status, xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Erreur de la requête AJAX');
    };
    xhr.send();
});
</script>
