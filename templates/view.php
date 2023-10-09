<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Blog</title>
</head>
<body>
    <div class="position-sticky  border-bottom start-0 top-0 end-0 bg-body-secondary">
        <div class="container w-100">
            <header class="blog-header border-bottom py-3 ">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-4"></div>
                    <div class="col-4 text-center"><a class="blog-header-title text-dark" style="font-size: xx-large;"
                                                    href="/home">Blog</a></div>
                    <div class="col-4 d-flex justify-content-end align-items-center">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    </div>
                </div>
            </header>
            <div class="nav-scroller py-1">
                <nav class="nav d-flex justify-content-between my-2">
                    <?php foreach ($sections as $section):?>
                        <a class="p-2 text-muted" href="/<?php echo 
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
    <main role="main">
        <div>
            <h1 class="bg-light py-2 mb-2 ps-5 border-bottom w-100">
                <?php
                $firstCategory = $categories[0] ?? [];
                echo $firstCategory['nom_categorie'] ?? 'non defini';
                ?>
            </h1>
            <?php foreach ($articles as $article): ?>
                <div class="blog-section m-2 px-2 border border-dark-subtle bg-body-tertiary rounded">
                    <div class="row blog-post d-flex align-items-center">
                        <h2 class="col-3 blog-post-title">
                            <a href=
                                "/<?php $articleCategory = $categories[0] ?? [];
                                echo strtolower(rtrim($articleCategory['nom_categorie'])) ?? 'non_defini';?>/<?php $titleArticle = $article ?? [];
                                echo strtolower($titleArticle['titre_article']) ?? 'Titre'; ?>">
                                <?php echo $titleArticle['titre_article'] ?? 'Titre';?>
                            </a>
                        </h2>
                        <p class="col-6 blog-post-text">
                            <?php
                            $textArticle = $article ?? [];
                            echo $textArticle['texte_article'] ?? 'Texte';
                            ?>
                        </p>
                        <p class="col-3 blog-post-date">
                            <?php
                            $dateArticle = $article ?? [];
                            echo $dateArticle['date_article'] ?? 'Date';
                            ?>
                            by
                            <a href="#">
                                <?php
                                $authorArticle = $article ?? [];
                                echo $authorArticle['auteur_article'] ?? 'Auteur';
                                ?>
                            </a>
                        </p>           
                    </div>
                    
                    <div class="blog-commentaries ">
                        <?php foreach ($commentaires as $commentaire): ?>
                            <?php if ($commentaire['id_article'] == $article['id_article']): ?>
                                <div class="row blog-commentary border-top bg-body-tertiary px-2 mx-5 py-2 my-2 ">
                                    <h5 class="col-3 blog-commentaries-author">
                                        <?php
                                        $authorCommentary = $commentaire ?? [];
                                        echo $authorCommentary['auteur_commentaire'] ?? 'Auteur';
                                        ?>
                                    </h5>
                                    <p class="col-6 blog-commentaries-text">
                                        <?php
                                        $textCommentary = $commentaire ?? [];
                                        echo $textCommentary['texte_commentaire'] ?? 'Texte';
                                        ?>
                                    </p>
                                    <p class="col-3 blog-commentaries-date">
                                        Published on
                                        <?php
                                        $dateCommentary = $commentaire ?? [];
                                        echo $dateCommentary['date_modification_commentaire'] ?? 'Date';
                                        ?>
                                    </p>
                                    
                                </div>
                            <?php endif?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!-- /.row -->

        <nav class="blog-pagination mx-2">
            <a class="btn btn-outline-primary" href="#">Top</a>
            <a class="btn btn-outline-secondary disabled" href="#">More</a>
        </nav>


        

    </main>
    <footer class="py-5 mt-2 border-top border-dark-subtle text-center text-body-secondary bg-body-tertiary">
        <p>Blog built by <a href="#">FLX</a>.</p>
        <p class="mb-0">
            <a href="#">Back to top</a>
        </p>
    </footer>

</body>
</html>
