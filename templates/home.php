<nav class="article-category ps-5 py-2" aria-label="breadcrumb">
    <ol class="breadcrumb my-0">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-1 col-lg-2"></div>
        <div class="col-10 col-lg-8">
            <div class="article-container row align-items-center">
                <?php
                /** @var \App\Article[] $articles */
                foreach ($articles as $article): ?>
                    <div class="article-bloc col-sm-6 col-md-6 col-lg-4">
                        <div class="article-section rounded my-2">
                            <div class="container align-items-center px-0">
                                <div class="article-head container row pt-2 px-0 mx-0">
                                    <a class="article-title article-link" href="<?= $article->getUrlArticle(); ?>">
                                        <?= $article->getTitre() ?? 'Titre';?>
                                    </a>
                                </div>
                                <div class="article-body container row pt-2 pb-3 ps-2 mx-0">
                                    <div class="col-5">
                                        <div class="article-body-category row">
                                            <a class="article-link px-0" href="/<?= $article->getSlugCategorie(); ?>">
                                                <?= $article->getNomCategorie(); ?>
                                            </a>
                                        </div>
                                        
                                        <div class="article-head-date row">
                                            <?php $date = $article->getDate(); 
                                                echo ($date instanceof \DateTime) ? $date->format('d/m/Y') : 'Date';?>
                                        </div>
                                        <div class="article-head-nb-com row">
                                            <div class="row px-0">
                                                <a class="article-link col-4" href="<?= $article->getUrlArticle(); ?>">
                                                    <span class="material-symbols-outlined">
                                                        comment
                                                    </span>
                                                </a>
                                                <div class="col-8"><?php echo $article->getNombreCommentaires() ?? '0';?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7 px-0">
                                        <div class="article-picture row">
                                            <a class="article-link" href="<?= $article->getUrlArticle(); ?>">
                                                <img class="picture px-0 rounded" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1920/1080" alt="Article picture">
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <button class="btn btn-outline-secondary" id="load-more">Afficher plus d'Articles</button>
                <button class="btn btn-outline-secondary" id="reduce">Réduire</button>
            </div>
        </div>
        <div class="col-1 col-lg-2"></div>
    </div>
</div>