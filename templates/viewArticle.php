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
    <title>FLX Blog</title>
</head>
<body>
    <div class="blog-top position-sticky start-0 top-0 end-0">
    <div class="container-fluid d-flex align-items-center">
            <img src="/images/logo.png" alt="FLX Logo" class="blog-header-logo p-4">
            <div class="container w-100 mx-0">
                <header class="blog-header py-3">
                    <div class="row flex-nowrap justify-content-between align-items-center">
                        <div class="col-4"></div>
                        <div class="col-4 text-center">
                            <a class="blog-header-title" href="/home">
                                <img src="/images/favicon.ico" alt="FLX Blog" class="blog-header-title">
                            </a>
                        </div>
                        <div class="col-4 d-flex justify-content-end align-items-center">
                        <form class="d-flex" role="search">
                            <input class="search-input me-2 rounded" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </form>
                        </div>
                    </div>
                </header>
                <div class="nav-scroller py-1">
                    <nav class="nav d-flex justify-content-between my-2">
                        <?php foreach ($sections as $section):?>
                            <a class="p-2" href="/<?php echo 
                                isset($section['nom_categorie']) ? 
                                strtolower($section['nom_categorie']) : 'non_defini';
                                ?>">
                                <?php echo
                                isset($section['nom_categorie']) ? 
                                htmlspecialchars($section['nom_categorie']) : 'non_defini'; 
                                ?>
                            </a>
                        <?php endforeach ?>
                    </nav>
                </div>
            </div>   
        </div>
    </div>
    <main role="main">
        <div>
            <h1 class="article-category py-2 mb-2 ps-5 w-100">
                <?php
                $firstCategory = $categories[0] ?? [];
                echo $firstCategory['nom_categorie'] ?? 'non defini';
                ?>
            </h1>
            
            <div class="article-section m-2 px-3 rounded">
                <div class="row mx-2 border-bottom border-dark-subtle article-head">
                    <div class="col-2 py-3 article-date d-flex align-items-top "> 
                        <div class="row">
                            <small class="ps-2">Published on :</small>
                            <div class="ps-3">
                                <?php
                                    $dateArticle = $articles[0] ?? [];
                                    echo $dateArticle['date_article'] ?? 'Date';
                                ?>
                            </div>
                            <small class="ps-2">Modified on :</small>
                            <div class="ps-3">
                                <?php
                                    $dateArticle = $articles[0] ?? [];
                                    echo $dateArticle['date_modification_article'] ?? 'Date';
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 my-0 d-flex justify-content-center align-items-center article-title">
                        <h2 class="">
                            <?php echo $articles[0]['titre_article'] ?? 'Titre';?>
                        </h2>
                    </div>

                    <div class="col-2 pt-3 py-0 article-author">
                        <div class="row">
                            <small class="col-2 ps-1 pe-0 pt-1 ">by :</small>
                            <a class="col-10 px-0" href="#">
                                <?php $authorArticle = $articles[0] ?? [];
                                    echo $authorArticle['auteur_article'] ?? 'Auteur';
                                ?>
                            </a>  
                        </div>
                            
                    </div>           
                </div>
                <div class="row article-text">
                    <p class="col mx-5 my-3 pb-3 text-break">
                        <?php
                        $textArticle = $articles[0] ?? [];
                        echo $textArticle['texte_article'] ?? 'Texte';
                        ?>
                    </p>
                </div>
            </div>

            <div class="container-fluid article-commentaries">
                <?php foreach ($commentaires as $commentaire): ?>
                    <?php if ($commentaire['id_article'] == $articles[0]['id_article']): ?>
                        <div class="row px-2 mx-5 py-2 my-2 rounded article-commentary">
                            <h5 class="col-3 d-flex justify-content-center article-commentaries-author">
                                <a href="#">
                                    <?php
                                    $authorCommentary = $commentaire ?? [];
                                    echo $authorCommentary['auteur_commentaire'] ?? 'Auteur';
                                    ?>
                                </a>
                            </h5>
                            <p class="col-6 article-commentaries-text mt-2">
                                <?php
                                $textCommentary = $commentaire ?? [];
                                echo $textCommentary['texte_commentaire'] ?? 'Texte';
                                ?>
                            </p>
                            <small class="col-3 article-commentaries-date d-flex justify-content-end">
                                Published on
                                <?php
                                $dateCommentary = $commentaire ?? [];
                                echo $dateCommentary['date_modification_commentaire'] ?? 'Date';
                                ?>
                            </small>
                            
                        </div>
                    <?php endif?>
                <?php endforeach; ?>
            </div>
        </div>

        <nav class="d-flex justify-content-between mx-5 blog-pagination">
            <a class="btn btn-outline-secondary" href="/home">Home</a>
            <a class="btn btn-outline-secondary" href="/<?php echo strtolower($firstCategory['nom_categorie']) ?? 'non defini';?>">Back to 
                <?php
                    echo $firstCategory['nom_categorie'] ?? 'non defini';
                ?>
            </a>
        </nav>
    </main>

    <footer class="blog-footer container-fluid py-5 mt-2 position-static bottom-0 start-0">
        <p>Blog built by <a href="#">FLX</a>.</p>
        <p class="mb-0">
            <a href="#">Back to top</a>
        </p>
    </footer>

</body>
</html>
