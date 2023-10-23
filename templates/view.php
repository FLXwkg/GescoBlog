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

    <title>
        Blog
        <?php echo " - ";
            $category = $categories[0];
            echo $category->getNom();
        ?>
    </title>
</head>
<body>
    <div class="blog-top">
        <div class="row container-fluid mx-0 px-0">
            <div class="col-2">
                <img src="/images/logo.png" alt="FLX Logo" class="blog-header-logo p-4">
            </div>
            <div class="col-8 container mx-0">
                <header class="row blog-header py-3">
                    <div class="col-lg-0 col-xl-4 space-col"></div>
                    <div class="col-lg-4 col-xl-4 blog-header-title text-center">
                        <a href="/home">
                            <img src="/images/favicon.ico" alt="FLX Blog">
                        </a>
                    </div>
                    <div class="col-lg-8 col-xl-4 search">
                        <form class="row" role="search" id="search">
                            <input class="col-9 search-input rounded" type="search" placeholder="Search" aria-label="Search">
                            <button class="col-3 btn btn-outline-secondary" type="submit">Search</button>
                        </form>
                    </div>
                </header>
                <div class="row nav-scroller py-1">
                    <nav class="nav d-flex justify-content-between my-2">
                    <?php foreach ($sections as $section):?>
                            <a class="p-2" href="/<?php echo strtolower($section->getNom()) ?? 'Non défini';?>">
                                <?php echo $section->getNom() ?? 'Non Défini'; ?>
                            </a>
                        <?php endforeach ?>
                    </nav>
                </div>
            </div>
            <div class="col-2"></div>   
        </div>
    </div>
    <main role="main">
        <div>
            <h1 class="article-category py-2 mb-2 ps-5 w-100">
                <?php echo $category->getNom();?>
            </h1>
            <?php foreach ($articles as $article): ?>
                <div class="article-section m-2 px-3 rounded">
                    <div class="article-head row align-items-top">
                        <div class="article-head-title col-8 col-sm-8 col-md-3 order-2 order-sm-2 py-3">
                            <div class="row">
                                <h2 class="col-7 col-sm-7 col-md-12">
                                    <a href=
                                        "/<?php
                                        echo strtolower(($category->getNom())) ?? 'non_defini';?>/<?php 
                                        echo slugifyText($article->getTitre()) ?? 'Titre'; ?>">
                                        <?php echo $article->getTitre() ?? 'Titre';?>
                                    </a>
                                </h2>
                                <div class="article-head-author col-5 col-sm-5 col-md-12">
                                    <small class="col-1 ms-3 px-0">by :</small>
                                    <a class="col-10 px-0" href="#">
                                        <?php echo $article->getAuteur() ?? 'Auteur';?>
                                    </a>  
                                </div>
                            </div>
                        </div>
                        <p class="article-head-text col-11 col-sm-11 col-md-7 order-3 order-sm-3 order-md-2 my-3 pe-2 text-break">
                            <?php 
                            echo getArticleHtmlSection(140, $category, $article);?>
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

                    <div class="row article-commentaries collapse"  id="collapseCommentary<?php echo $article->getId(); ?>">
                        <?php 
                        $comment_count = 0;
                        foreach ($commentaires as $commentaire):
                            if ($commentaire->getIdArticle() == $article->getId() && $comment_count < 3):
                                ?>
                                <div class="row article-commentary px-0 mx-0 py-2">
                                    <h5 class="article-commentary-author col-3 ">
                                        <?php echo $commentaire->getAuteur() ?? 'Auteur'; ?>
                                    </h5>

                                    <p class="article-commentary-text col-7 mt-2">
                                        <?php  echo $commentaire->getTexte() ?? 'Texte';?>
                                    </p>

                                    <small class="article-commentary-date col-2 d-flex justify-content-end">
                                        Published on
                                        <?php echo $commentaire->getDateModif() ?? 'Date';?>
                                    </small>
                                </div>
                                <?php
                                $comment_count++;
                            endif;
                        endforeach;
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                        <button class="col-xs-12 col-sm-8 col-lg-4 mb-2 btn btn-outline-secondary" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseCommentary<?php echo $article->getId(); ?>
                                " aria-expanded="false" aria-controls="collapseCommentary<?php echo $article->getId(); ?>">
                            Afficher les commentaires
                        </button>
                        <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!-- /.row -->

        <nav class="d-flex justify-content-between mx-5 blog-pagination">
            <a class="btn btn-outline-secondary" href="/home">Home</a>
            <a class="btn btn-outline-secondary" href="/<?php echo strtolower($category->getNom()) ?? 'non defini';?>">Back to 
                <?php echo $category->getNom() ?? 'non defini';?>
            </a>
        </nav>
    </main>
    
    <footer class="blog-footer py-5 mt-2">
        <p>Blog built by <a href="#">FLX</a>.</p>
        <p class="mb-0">
            <a href="#">Back to top</a>
        </p>
    </footer>
</body>
</html>
