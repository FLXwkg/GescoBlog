
<?php 
include "../scripts/slugifyText.php";
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/cssArticle.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/toggleCommentaryButton.js"></script>
    <title>
        Blog
        <?php echo " - ";
            $category = $categories[0];
            echo $category->getNom();
        ?>
        <?php echo " - ";
            $article = $articles[0];
            echo $article->getTitre();
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
                        <a href="/home">
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
                            if ($section->getNom() === $category->getNom()):?>
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
            <?php echo $category->getNom() . " - " . $article->getTitre();?>
        </h1>
        <div class="container">    
            <div class="article-section m-2 px-3 rounded">
                <div class="row mx-2 border-bottom border-dark-subtle article-head">
                    <div class="article-date col-12 col-sm-8 col-lg-2 order-3 order-sm-2 order-lg-1 py-3 align-items-top "> 
                        <div class="row">
                            <div class="col-6 col-sm-6 col-lg-12">
                                <small class="ps-2">Published on :</small>
                                <div class="ps-3">
                                    <?php echo $article->getDate() ?? 'Date';?>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-12">
                                <small class="ps-2">Modified on :</small>
                                <div class="ps-3">
                                    <?php echo $article->getDateModif() ?? 'Date';?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="article-title col-8 col-sm-12 col-lg-8 order-1 order-sm-1 order-lg-2 my-0 px-0">
                        <h2 class="">
                            <?php echo $article->getTitre() ?? 'Titre';?>
                        </h2>
                    </div>

                    <div class="article-author col-4 col-sm-4 col-lg-2 order-2 order-sm-3 order-lg-3 pt-3 pb-0 px-0">
                        <div class="row container-fluid mx-0 px-0">
                            <small class="col-12 col-lg-2 px-0">by :</small>
                            <a class="col-12 col-lg-10 px-0" href="#">
                                <img class="author-article-picture px-0" src="https://picsum.photos/id/<?php echo rand(1,1084)?>/1000" alt="Profile picture">
                                <?php echo $article->getAuteur() ?? 'Auteur';?>
                            </a>  
                        </div>
                    </div>           
                </div>
                <div class="row article-text">
                    <div class="col mx-5 my-3 pb-3 text-break">
                        <div class="row">
                            <img class="article-picture col-4 px-0" src="https://picsum.photos/id/<?php echo rand(1,1084). "/" . rand(500, 2000)?>" alt="Profile picture">
                            <p class="col-7"><?php echo $article->getTexte() ?? 'Texte';?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" row container-fluid article-commentaries collapse" id="collapseCommentary">
                <?php 
                $hasComments = false;
                foreach ($commentaires as $commentaire): ?>
                    <?php if ($commentaire->getIdArticle() == $article->getId()): ?>
                        <div class="row px-0 ms-2 py-2 my-2 rounded article-commentary">
                            <h5 class="article-commentaries-author col-3 justify-content-center">
                                <a class="row" href="#">
                                    <img class="author-commentary-picture col-3 ms-2 px-0" src="https://picsum.photos/id/<?php echo rand(1,300)?>/1000" alt="Profile picture">
                                    <p class="col-9"><?php echo $commentaire->getAuteur() ?? 'Auteur';?></p>
                                </a>
                            </h5>

                            <p class="article-commentaries-text col-7 mt-2">
                                <?php echo $commentaire->getTexte() ?? 'Texte';?>
                            </p>

                            <small class="article-commentaries-date col-2 d-flex justify-content-end">
                                Published on
                                <?php echo $commentaire->getDateModif() ?? 'Date';?>
                            </small>
                        </div>
                        <?php
                        $hasComments = true;
                    endif;
                endforeach; 
                ?>
            </div>
        </div>

        <?php if ($hasComments): // Vérifie si l'article a des commentaires avant d'afficher le bouton ?>
            <div class="row container-fluid">
                <div class="col-xs-0 col-sm-2 col-lg-4"></div>
                <button class="toggle-button col-xs-12 col-sm-8 col-lg-4 mb-2 btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCommentary"
                        data-article-id="<?php echo $article->getId(); ?>"
                        aria-expanded="false" aria-controls="collapseCommentary">
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

        <div class="container px-4">
            <nav class="blog-pagination d-flex justify-content-between">
                <a class="btn btn-outline-secondary w-25" href="/home">Home</a>
                <a class="btn btn-outline-secondary w-25" href="/<?php echo slugifyText($category->getNom()) ?? 'non defini';?>">Back to 
                    <?php echo $category->getNom() ?? 'non defini';?>
                </a>
            </nav>
        </div>
    </main>

    <footer class="blog-footer container-fluid py-5 mt-2 position-static bottom-0 start-0">
        <p>Blog built by <a href="https://github.com/FLXwkg" target="_blank">FLX</a>.</p>
        <p class="mb-0">
            <a href="#">Back to top</a>
        </p>
    </footer>

</body>
</html>
