<?php 
    include_once "../scripts/getArticleHtmlSection.php";
    include_once "../scripts/getCommentaryHtmlSection.php";
    $title = 'Home';
    if(isset($categories) && array_key_exists(0, $categories)){
        $category = $categories[0] ?? null;
        if($category instanceof \App\Entity\Categorie){
            $title = $category->getNom();
        }
    }
    
    $isHome = $title === 'Home';
    $helpers->title($title)
?>
<nav class="article-category ps-5 py-2" aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $isHome ? 'Accueil' : $category->getNom();?></li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-1 col-lg-2"></div>
        <div class="col-10 col-lg-8">
            <div class="article-container row align-items-center">
                <div class="align-items-center mt-2">
                    <button class="btn btn-outline-secondary col-12" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseForm"
                            aria-expanded="false" aria-controls="collapseForm">
                        Ajouter un article
                    </button>
                    <form action="/<?= $category->getSlug() ?>" method="POST" class="commentary-form collapse mx-3" id="collapseForm">
                        <fieldset>
                            <legend>Ajouter un article</legend>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <input class="form-control" type="text" name="titre_article" placeholder="Titre" required>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" type="text" name="auteur_article" placeholder="Votre nom" required>
                                </div>
                                <div class="col-12 mt-2">
                                    <textarea class="form-control" name="texte_article" placeholder="Contenu" required></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-secondary">Publier</button>
                        </fieldset>
                    </form>
                </div>
                <?php
                /** @var \App\Entity\Article[] $articles */
                foreach ($articles as $article):?> 
                    <div class="article-bloc col-12 col-xl-6">
                        <div class="article-section rounded my-2">
                            <div class="row container pt-2">
                                <div class="article-head-title col-7 pe-0">
                                    <a class="article-link" href="<?= $article->getUrlArticle(); ?>">
                                        <?= $article->getTitre(); ?>
                                    </a>
                                </div>
                                <div class="article-head-date col-3 px-0">
                                    <a class="article-link" href="<?= $article->getUrlArticle(); ?>">
                                        <?php $date = $article->getDate(); 
                                            echo ($date instanceof \DateTime) ? $date->format('d/m/Y') : 'Date';
                                        ?>
                                    </a>
                                </div>
                                <div class="article-head-nb-com col-2 px-1">
                                    <div class="row px-0">
                                        <a class="article-link col-4" href="<?= $article->getUrlArticle(); ?>">
                                            <span class="material-symbols-outlined">
                                                comment
                                            </span>
                                        </a>
                                        <p class="col-8">
                                            <?php echo $article->getNombreCommentaires() ?? '0';?>
                                        </p>
                                    </div>
                                </div>
                                </div>
                                <div class="article-body container row py-3">
                                    <div class="article-text col-8 ps-2">
                                        <?= getArticleHtmlSection($article);?>
                                    </div>
                                    <div class="col-4 px-0">
                                        <div class="article-picture row px-0">
                                            <a class="article-link" href="<?= $article->getUrlArticle(); ?>">
                                                <img class="picture rounded px-0" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1920/1080" alt="Article picture">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        
                            <div class="container article-commentaries collapse" id="collapseCommentary<?php echo $article->getId(); ?>">
                                <?php
                                $comment_count = 0;
                                $hasComments = false;

                                foreach ($commentaires as $commentaire):
                                    if ($commentaire->getIdArticle() == $article->getId() && $comment_count < 3):
                                        ?>
                                        <div class="row">
                                            <div class="article-commentary col mx-2 px-0">
                                                <div class="article-commentary-author row pt-2 pb-2">
                                                    <img class="author-commentary-picture col-2 px-0" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1000" alt="Profile picture">
                                                    <a class="article-link col-8" href="<?= $article->getUrlArticle(); ?>">
                                                        <h6 class="py-1"><?php echo $commentaire->getAuteur() ?? 'Auteur';?></h6>
                                                    </a>
                                                    <small class="col-2 px-0"> 
                                                        <?php $date = $commentaire->getDate(); 
                                                            echo ($date instanceof \DateTime) ? $date->format('d/m/Y') : 'Date';?>
                                                    </small>
                                                </div>

                                                <p class="article-commentary-text row mx-2">
                                                    <a class="article-link col-12" href="<?= $article->getUrlArticle(); ?>">
                                                        <?= getCommentaryHtmlSection($article, $commentaire) ?>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                        $comment_count++;
                                        $hasComments = true;
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        
                            <?php if ($hasComments):?>
                                <div class="row">
                                    <div class="col-2"></div>
                                    <button class="toggle-button col-8 mb-2 btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseCommentary<?php echo $article->getId(); ?>"
                                            data-article-id="<?php echo $article->getId(); ?>"
                                            aria-expanded="false" aria-controls="collapseCommentary<?php echo $article->getId(); ?>">
                                        Afficher les commentaires
                                    </button>
                                    <div class="col-2"></div>
                                </div>
                            <?php else :?>
                                <div class="row">   
                                    <div class="col-2"></div>
                                    <a class="col-8 mb-2 btn btn-outline-secondary" type="button" href="<?= $article->getUrlArticle();?>">
                                        Ajouter un commentaire
                                    </a>
                                    <div class="col-2"></div>
                                </div> 
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php 
                endforeach; ?>
                <div class="">
                    <button class="col-12 btn btn-outline-secondary" id="load-more">Afficher plus d'Articles</button>
                    <button class="col-12 btn btn-outline-secondary" id="reduce">Réduire</button>
                </div>
            </div>
        </div>
        <div class="col-1 col-lg-2"></div>
    </div>
</div> 