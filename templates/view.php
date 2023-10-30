<?php 
include "../scripts/getArticleHtmlSection.php";
include "../scripts/getCommentaryHtmlSection.php";
include "../scripts/slugifyText.php";
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/cssCategorie.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/toggleCommentaryButton.js"></script>
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
                <a href="/">
                    <img src="/images/logo.png" alt="FLX Logo" class="logo">
                </a>
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
                <div class="nav row">
                    <nav class="navbar navbar-expand-lg py-1">
                        <div class="container-fluid d-flex justify-content-evenly">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" 
                                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-evenly"  id="navbarTogglerDemo01">
                                <?php 
                                foreach ($sections as $section):
                                    if ($section->getNom() === $category->getNom()):?>
                                        <a class="actual-page-link nav-link p-2" href="/<?php echo strtolower($section->getNom()) ?? 'Non défini';?>">
                                            <?php echo $section->getNom() ?? 'Non Défini'; ?>
                                        </a>
                                    <?php else : ?>
                                        <a class="nav-link p-2" href="/<?php echo strtolower($section->getNom()) ?? 'Non défini';?>">
                                            <?php echo $section->getNom() ?? 'Non Défini'; ?>
                                        </a>
                                    <?php
                                    endif;
                                endforeach ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-2"></div>   
        </div>
    </div>
    <main role="main">
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
                        <?php
                        /** @var \App\Article[] $articles */
                        foreach ($articles as $article):?> 
                            <div class="article-bloc col-12 col-md-6">
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
                                                        <img class="picture px-0" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1920/1080" alt="Article picture">
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
                                                        <h6 class="article-commentary-author row pt-2">
                                                            <img class="author-commentary-picture col-2 px-0" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1000" alt="Profile picture">
                                                            <a class="article-link col-10" href="<?= $article->getUrlArticle(); ?>">
                                                                <p class="py-1"><?php echo $commentaire->getAuteur() ?? 'Auteur';?></p>
                                                            </a>
                                                        </h6>

                                                        <p class="article-commentary-text row mx-2">
                                                            <?= getCommentaryHtmlSection($article, $commentaire) ?>
                                                        </p>

                                                        <small>Published on 
                                                            <?php $date = $commentaire->getDate(); 
                                                                echo ($date instanceof \DateTime) ? $date->format('d/m/Y') : 'Date';?>
                                                        </small>
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
                                            <button class="col-8 mb-2 btn btn-outline-secondary" type="button">
                                                Ajouter un commentaire
                                            </button>
                                            <div class="col-2"></div>
                                        </div> 
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php 
                        endforeach; ?>
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
