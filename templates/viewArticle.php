<?php
    $helpers->link("cssArticle.css");
    $helpers->script(["getCommentsByArticle.js","toggleCommentaryButton.js"]);
    $title = $category->getNom() .' - '. $article->getTitre();
    $helpers->title($title);
?>
<?= $helpers->breadcrumb(['/'. $category->getSlug() => $category->getNom()], $article->getTitre())?>

<div class="container">   
    <div class="articleUrl d-none"><?= $article->getUrlArticle()?></div>
    <div class="nbComments d-none"><?= $article->getNombreCommentaires()?></div> 
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
            <?php $hasComments = ($article->getNombreCommentaires() !== 0);?>
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
