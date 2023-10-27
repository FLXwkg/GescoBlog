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
    <link href="/assets/css/cssHome.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/loadMoreArticles.js"></script>

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
                    <nav class="nav d-flex justify-content-evenly my-2">
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
                                    <a class="article-link d-block" href="<?= $article->getUrlArticle(); ?>">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="article-head container row py-3">
                                                <div class="article-head-category col-5">
                                                    <?= $article->getNomCategorie(); ?>
                                                </div>
                                                <div class="article-head-date col-7 pe-0">
                                                    <?php echo $article->getDate() ?? 'Date';?>
                                                </div>
                                            </div>
                                            <div class="article-body container row py-3">
                                                <div class="article-title col-8">
                                                    <?= $article->getTitre() ?? 'Titre';?>
                                                </div>
                                                <div class="article-picture col-4">
                                                    <img class="picture px-0 rounded" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1920/1080" alt="Article picture">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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

    </main>
    
    <footer class="blog-footer py-5 mt-2">
        <p>Blog built by <a href="https://github.com/FLXwkg" target="_blank">FLX</a>.</p>
        <p class="mb-0">
            <a href="#">Back to top</a>
        </p>
    </footer>
</body>
</html>
