document.getElementById('search-input').addEventListener('input', function() {
    var search = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'search_jpo.php?search=' + encodeURIComponent(search), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = xhr.responseText;
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
