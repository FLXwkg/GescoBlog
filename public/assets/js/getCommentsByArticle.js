document.addEventListener('DOMContentLoaded', function() {
    var commentsContainer = document.querySelector('.article-commentaries');
    var articleFullSlug = document.querySelector('.articleUrl').textContent;
    var host = document.location.host;
    var protocol = document.location.protocol;
    var url = protocol + '//' + host + '/' + articleFullSlug +'/commentaires';

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            
            commentsContainer.innerHTML = ''; // Clear existing content

            function formaterDateISO8601(ISO8601Date) {
                // Créer une instance de Date à partir de la chaîne ISO8601
                const date = new Date(ISO8601Date);

                // Obtenez les composants de la date
                const jour = date.getDate().toString().padStart(2, '0');
                const mois = (date.getMonth() + 1).toString().padStart(2, '0'); // Mois commence à 0, donc ajoutez 1
                const annee = date.getFullYear();

                // Concaténez les composants pour former la chaîne de date formatée
                const dateFormatee = `${jour}/${mois}/${annee}`;

                return dateFormatee;
            }

            data.forEach(comment => {
                var commentDiv = document.createElement('div');
                var date = comment.dateCommentaire;
                const dateFormatee = formaterDateISO8601(date);
                var dateModif = comment.dateModificationCommentaire;
                const dateModifFormatee = formaterDateISO8601(dateModif);
                commentDiv.innerHTML = '<div class="article-commentary row px-0 ms-2 pt-3 mt-2">' +
                    '<div class="article-commentaries-author col-4 d-flex flex-column">' +
                    '<a class="row container align-items-center" href="#">' +
                    '<img class="author-commentary-picture col-2 px-0" src="https://picsum.photos/id/' + 
                    Math.floor(Math.random() * 300) + '/1000" alt="Profile picture"></img>' +
                    '<h5 class="col-9">' + comment.auteurCommentaire + '</h5></a>' +
                    '<div class="article-commentary-date row container ms-4 pt-2">' +
                    '<small>Published on ' + (date >= dateModif ? dateFormatee : dateModifFormatee) + '</small>' +
                    '</div></div>' + '<p class="article-commentary-text col-8 mt-2">' + comment.texteCommentaire + '</p>' + 
                    '</div>';
                commentsContainer.appendChild(commentDiv);
            });
        })
        .catch(error => {
            console.error('Error fetching comments:', error);
        });
});