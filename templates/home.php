<?php 
include "../scripts/getArticleHtmlSection.php";
include "../scripts/slugifyText.php";
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/cssMenu.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/toggleCommentaryButton.js"></script>

    <title>
        Blog
        <?php echo " - ";
            $title = 'Home';
            if(isset($categories) && array_key_exists(0, $categories)){
                $category = $categories[0] ?? null;
                if($category instanceof \App\Categorie){
                    $title = $category->getNom();
                }
            }
            echo $title;
            $isHome = $title === 'Home';
        ?>
    </title>
</head>
<body>
    <div class="blog-top">
        <div class="row container-fluid mx-0 px-0">
        <div class="blog-header-logo col-2 pt-4 px-4 pb-2">
                <img src="/images/logo.png" alt="FLX Logo" class="logo">
            </div>
            <div class="col-8 container mx-0">
                <header class="row blog-header py-3">
                    <div class="col-lg-0 col-xl-4 space-col"></div>
                    <div class="col-lg-4 col-xl-4 blog-header-title text-center">
                        <a href="/">
                            <img src="/images/favicon.ico" alt="FLX Blog">
                        </a>
                    </div>
                    <div class="col-lg-8 col-xl-4 search">
                        <form class="row" role="search">
                            <input class="col-9 search-input rounded" type="search" placeholder="Search" id="Search" aria-label="Search">
                            <button class="col-3 btn btn-outline-secondary" type="submit">Search</button>
                        </form>
                    </div>
                </header>
                <div class="row nav-scroller py-1">
                    <nav class="nav d-flex justify-content-between my-2">
                        <?php

                        foreach ($sections as $section):
                            if (!$isHome && $section->getNom() === $category->getNom()):?>
                                <a class="actual-page-link p-2" href="/<?php echo strtolower($section->getNom()) ?? 'Non défini';?>">
                                    <?php echo $section->getNom() ?? 'Non Défini'; ?>
                                </a>
                            <?php else : ?>
                                <a class="p-2" href="/<?php echo strtolower($section->getNom()) ?? 'Non défini';?>">
                                    <?php echo $section->getNom() ?? 'Non Défini'; ?>
                                </a>
                            <?php
                            endif;
                        endforeach ?>
                    </nav>
                </div>
            </div>
            <div class="col-2"></div>   
        </div>
    </div>
    <main role="main">
        <h1 class="article-category py-2 mb-2 ps-5 w-100">
            <?= $isHome ? 'Accueil' : $category->getNom();?>
        </h1>
        <div class="container">
            <?php
            /** @var \App\Article[] $articles */
            foreach ($articles as $article): ?>
                <div class="article-section m-2 px-3 rounded">
                    <div class="article-head row align-items-top">
                        <div class="article-head-title col-8 col-sm-8 col-md-3 order-2 order-sm-2 py-3">
                            <div class="row">
                                <h2 class="col-7 col-sm-7 col-md-12">
                                    <a href="<?=$article->getUrlArticle(); ?>">
                                        <?php echo $article->getTitre() ?? 'Titre';?>
                                    </a>
                                </h2>
                                <div class="article-head-author col-5 col-sm-5 col-md-12">
                                    <div class="row container-fluid px-0">
                                        <small class="small-by-article col-sm-12 col-md-2 ps-0 pe-1">by :</small>
                                        <div class="col-sm-12 col-md-10 px-0">
                                            <a class="row container pe-0" href="#">
                                                <img class="author-article-picture col-3 px-0" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1000" alt="Profile picture">
                                                <p class="col-9 pe-0"><?php echo $article->getAuteur() ?? 'Auteur';?></p>
                                            </a>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <p class="article-head-text col-11 col-sm-11 col-md-7 order-3 order-sm-3 order-md-2 my-3 pe-2 text-break">
                            <?= getArticleHtmlSection($article, 140); ?>
                        </p>
                        <div class="article-head-date col-4 col-sm-4 col-md-2 order-1 order-sm-1 order-md-3 pt-3 py-0">
                            <div class="row">
                                <small class="ps-1">Published on :</small>
                                <div class="ps-2">
                                    <?php echo $article->getDate() ?? 'Date';?>
                                </div>
                            </div>
                        </div>           
                    </div>

                    <div class="row article-commentaries collapse" id="collapseCommentary<?php echo $article->getId(); ?>">
                        <?php
                        $comment_count = 0;
                        $hasComments = false; // Une variable pour suivre si l'article a des commentaires

                        foreach ($commentaires as $commentaire):
                            if ($commentaire->getIdArticle() == $article->getId() && $comment_count < 3):
                                ?>
                                <div class="row article-commentary px-0 mx-0 py-2">
                                    <h5 class="article-commentary-author col-3">
                                        <a class="row" href="#">
                                            <img class="author-commentary-picture col-3 ms-2 px-0" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1000" alt="Profile picture">
                                            <p class="col-9"><?php echo $commentaire->getAuteur() ?? 'Auteur';?></p>
                                        </a>
                                    </h5>

                                    <p class="article-commentary-text col-7 mt-2">
                                        <?php echo $commentaire->getTexte() ?? 'Texte'; ?>
                                    </p>

                                    <small class="article-commentary-date col-2 d-flex justify-content-end">
                                        Published on
                                        <?php echo $commentaire->getDateModif() ?? 'Date'; ?>
                                    </small>
                                </div>
                                <?php
                                $comment_count++;
                                $hasComments = true; // Mettez la variable à true s'il y a des commentaires.
                            endif;
                        endforeach;
                        ?>
                    </div>

                    <?php if ($hasComments): // Vérifiez si l'article a des commentaires avant d'afficher le bouton ?>
                        <div class="row">
                            <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                            <button class="toggle-button col-xs-12 col-sm-8 col-lg-4 mb-2 btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCommentary<?php echo $article->getId(); ?>"
                                    data-article-id="<?php echo $article->getId(); ?>"
                                    aria-expanded="false" aria-controls="collapseCommentary<?php echo $article->getId(); ?>">
                                Afficher les commentaires
                            </button>
                            <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                        </div>
                    <?php else :?>
                        <div class="row">   
                            <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                            <button class="col-xs-12 col-sm-8 col-lg-4 mb-2 btn btn-outline-secondary" type="button">
                                Ajouter un commentaire
                            </button>
                            <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                        </div> 
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div><!-- /.row -->

        <div class="container px-4">
            <nav class="blog-pagination d-flex justify-content-between">
                <a class="btn btn-outline-secondary" href="/home">Home</a>
                <?php if($isHome):?>
                    <a href="/">Accueil</a>
                <?php else: ?>
                    <a class="btn btn-outline-secondary" href="/<?php echo strtolower($category->getNom()) ?? 'non defini';?>">Back to
                        <?php echo $category->getNom() ?? 'non defini';?>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </main>
    
    <footer class="blog-footer py-5 mt-2">
        <p>Blog built by <a href="https://github.com/FLXwkg" target="_blank">FLX</a>.</p>
        <p class="mb-0">
            <a href="#">Back to top</a>
        </p>
    </footer>
</body>
</html>