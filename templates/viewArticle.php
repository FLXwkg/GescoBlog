<?php
    $helpers->link("cssArticle.css");
    $category = $categories[0];
    $article = $articles[0];
    $title = $category->getNom() .' - '. $article->getTitre();
    $helpers->title($title);
?>
<?= $helpers->breadcrumb(['/'. $category->getSlug() => $category->getNom()], $article->getTitre())?>

<div class="container">   
    <div class=" articleSlug d-none"><?= $article->getSlug()?></div> 
    <div class="article-section m-2 px-3 rounded">
        <div class="row mx-2 border-bottom border-dark-subtle article-head">
            <div class="article-date col-12 col-sm-8 col-lg-2 order-3 order-sm-2 order-lg-1 py-3 align-items-top "> 
                <div class="row">
                <?php if($article->getDate() >= $article->getDateModif()):?>
                    <div class="col-6 col-sm-6 col-lg-12">
                        <small class="ps-2">Published on :</small>
                        <div class="ps-3">
                            <?php $date = $article->getDate(); 
                                echo ($date instanceof \DateTime) ? $date->format('d/m/Y') : 'Date';?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-6 col-sm-6 col-lg-12">
                        <small class="ps-2">Published on :</small>
                        <div class="ps-3">
                            <?php $date = $article->getDate(); 
                                echo ($date instanceof \DateTime) ? $date->format('d/m/Y') : 'Date';?>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-12">
                        <small class="ps-2">Modified on :</small>
                        <div class="ps-3">
                        <?php $date = $article->getDateModif(); 
                                echo ($date instanceof \DateTime) ? $date->format('d/m/Y') : 'Date';?>
                        </div>
                    </div>
                <?php endif;?>
                </div>
            </div>

            <div class="article-title col-12 col-lg-8 order-1 order-sm-1 order-lg-2 my-0 px-0">
                <h2 class="mb-0 pt-2">
                    <?php echo $article->getTitre() ?? 'Titre';?>
                </h2>
            </div>

            <div class="article-author col-12 col-sm-4 col-lg-2 order-3 order-sm-3 order-lg-3 pt-3 pb-2 px-0">
                <div class="row container-fluid mx-0 px-0">
                    <a class="col-12 px-0" href="#">
                        <div class="container row d-flex justify-content-center">
                            <img class="author-article-picture col-4 col-md-12 px-0" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1000" alt="Article picture">
                            <p class="col-6 col-md-12 d-flex justify-content-center"><?php echo $article->getAuteur() ?? 'Auteur';?></p>
                        </div>
                    </a>  
                </div>
            </div>           
        </div>
        <div class="row article-text">
            <div class="col mx-5 my-3 pb-3 text-break">
                <div class="row">
                    <img class="article-picture col-12 col-md-4 px-0" src="https://picsum.photos/id/<?php echo rand(1,1084). "/" . rand(500, 2000)?>" alt="Profile picture">
                    <p class="col-12 col-md-8"><?php echo $article->getTexte() ?? 'Texte';?></p>
                </div>
            </div>
        </div>


        <div class="article-commentaries row container collapse" id="collapseCommentary">
            <?php if($article->getNombreCommentaires() === 0){
                $hasComments = false;
            }
            $hasComments = true;
            ?>
        </div>

        <?php if ($hasComments):?>
            <div class="row container-fluid">
                <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                <div class="d-flex flex-column align-items-center col-xs-12 col-sm-8 col-lg-4 mb-2">
                    <button class="toggle-button ajaxComments btn btn-outline-secondary mb-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseCommentary" data-article-id="<?php echo $article->getId(); ?>"
                            aria-expanded="false" aria-controls="collapseCommentary">
                        Afficher les commentaires
                    </button>
                    <button class="toggle-button btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseForm" data-article-id="<?php echo $article->getId(); ?>"
                            aria-expanded="false" aria-controls="collapseForm">
                        Ajouter un commentaire
                    </button>
                </div>
                <div class="col-xs-0 col-sm-2 col-lg-4"></div>
            </div>
        <?php else :?>
            <div class="row">   
                <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                <button class="toggle-button col-xs-12 col-sm-8 col-lg-4 mb-2 btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseForm"
                        data-article-id="<?php echo $article->getId(); ?>"
                        aria-expanded="false" aria-controls="collapseForm">
                    Ajouter un commentaire
                </button>
                <div class="col-xs-0 col-sm-2 col-lg-4"></div>
            </div> 
        <?php endif; ?>    
    </div>
    <form action="/<?= $article->getUrlArticle() ?>" method="POST" class="commentary-form collapse mx-3" id="collapseForm">
        <fieldset>
            <legend>Ajouter un commentaire</legend>
            <div class="row mb-2">
                <div class="col-5">
                    <input class="form-control" type="text" name="auteur_commentaire" placeholder="Nom" required>
                </div>
                <div class="col-7">
                    <textarea class="form-control" name="texte_commentaire" placeholder="Contenu" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary">Publier</button>
        </fieldset>
    </form>
</div>
<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var commentsContainer = document.querySelector('.article-commentaries');
        var articleSlug = document.querySelector('.articleSlug').textContent;
        
        fetch('http://blog.local/commentaire/' + articleSlug)
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
</script>