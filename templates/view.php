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
            <?php foreach ($articles as $article): ?>
                <div class="article-section m-2 px-3 rounded">
                    <div class="article-head row d-flex align-items-top">
                        <div class="article-head-title col-3 py-3">
                            <h2 class="row">
                                <a href=
                                    "/<?php $articleCategory = $categories[0] ?? [];
                                    echo strtolower(rtrim($articleCategory['nom_categorie'])) ?? 'non_defini';?>/<?php $titleArticle = $article ?? [];
                                    echo strtolower($titleArticle['titre_article']) ?? 'Titre'; ?>">
                                    <?php echo $titleArticle['titre_article'] ?? 'Titre';?>
                                </a>
                            </h2>
                            <div class="row">
                                <small class="col-1 ms-3 px-0">by :</small>
                                <a class="col-10 px-0" href="#">
                                    <?php $authorArticle = $article ?? [];
                                        echo $authorArticle['auteur_article'] ?? 'Auteur';
                                    ?>
                                </a>  
                            </div>
                        </div>
                        <p class="article-head-text col-7 my-3 pe-0 text-break">
                            <?php
                            $textArticle = $article ?? [];
                            echo $textArticle['texte_article'] ?? 'Texte';
                            ?>
                        </p>
                        <div class="article-head-date col-2 pt-3 py-0">
                            <div class="row">
                                <small class="ps-1">Published on :</small>
                                <div class="ps-2">
                                    <?php
                                        $dateArticle = $article ?? [];
                                        echo $dateArticle['date_article'] ?? 'Date';
                                    ?>
                                </div>
                            </div>
                        </div>           
                    </div>
                    
                    <div class="article-commentaries">
                        <?php foreach ($commentaires as $commentaire): ?>
                            <?php if ($commentaire['id_article'] == $article['id_article']): ?>
                                <div class="row article-commentary px-2 mx-5 py-2 my-2 ">
                                    <h5 class="article-commentary-author col-3 ">
                                        <?php
                                        $authorCommentary = $commentaire ?? [];
                                        echo $authorCommentary['auteur_commentaire'] ?? 'Auteur';
                                        ?>
                                    </h5>
                                    <p class="article-commentary-text col-6 mt-2">
                                        <?php
                                        $textCommentary = $commentaire ?? [];
                                        echo $textCommentary['texte_commentaire'] ?? 'Texte';
                                        ?>
                                    </p>
                                    <small class="article-commentary-date col-3 d-flex justify-content-end">
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
            <?php endforeach; ?>
        </div><!-- /.row -->

        <nav class="d-flex justify-content-between mx-5 blog-pagination">
            <a class="btn btn-outline-secondary" href="/home">Home</a>
            <a class="btn btn-outline-secondary" href="/<?php echo strtolower($firstCategory['nom_categorie']) ?? 'non defini';?>">Back to 
                <?php
                    echo $firstCategory['nom_categorie'] ?? 'non defini';
                ?>
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
