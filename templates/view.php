<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Blog</title>
</head>
<body>
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4"></div>
            <div class="col-4 text-center"><a class="blog-header-title text-dark" style="font-size: xx-large;"
                                              href="/home">Blog</a></div>
            <div class="col-4 d-flex justify-content-end align-items-center"></div>
        </div>
    </header>
    <div class="nav-scroller py-1 mb-2">
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
    
    <main role="main" class="container">
        <div class="row">
            <h1 class="pb-3 mb-4 font-italic border-bottom ">
                <?php
                $firstCategory = $categories[0] ?? [];
                echo $firstCategory['nom_categorie'] ?? 'non defini';
                ?>

            </h1>
            <?php foreach ($articles as $article): ?>
                <div class="blog-section">
                    <div class="blog-post">
                        <h2 class="blog-post-title">
                            <a href=
                                "/<?php $articleCategory = $categories[0] ?? [];
                                echo strtolower(rtrim($articleCategory['nom_categorie'])) ?? 'non_defini';?>/<?php $titleArticle = $article ?? [];
                                echo strtolower($titleArticle['titre_article']) ?? 'Titre'; ?>">
                                <?php echo $titleArticle['titre_article'] ?? 'Titre';?>
                            </a>

                        </h2>
                        <p class="blog-post-meta">
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
                        <p>
                            <?php
                            $textArticle = $article ?? [];
                            echo $textArticle['texte_article'] ?? 'Texte';
                            ?>
                        </p>
                    </div>
                    <hr>
                    <div class="blog-commentaries d-flex justify-content-evenly ">
                        <?php foreach ($commentaires as $commentaire): ?>
                            <?php if ($commentaire['id_article'] == $article['id_article']): ?>
                                <div class="blog-commentary border-bottom bg-body-tertiary px-2 py-1">
                                    <h5>
                                        <?php
                                        $authorCommentary = $commentaire ?? [];
                                        echo $authorCommentary['auteur_commentaire'] ?? 'Auteur';
                                        ?>
                                    </h5>
                                    <p class="blog-commentaries-meta">
                                        Published on
                                        <?php
                                        $dateCommentary = $commentaire ?? [];
                                        echo $dateCommentary['date_modification_commentaire'] ?? 'Date';
                                        ?>
                                    </p>
                                    <p>
                                        <?php
                                        $textCommentary = $commentaire ?? [];
                                        echo $textCommentary['texte_commentaire'] ?? 'Texte';
                                        ?>
                                    </p>
                                </div>
                            <?php endif?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>


            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Top</a>
                <a class="btn btn-outline-secondary disabled" href="#">Bottom</a>
            </nav>


        </div><!-- /.row -->

    </main>
    <footer class="py-5 text-center text-body-secondary ">
        <p>Blog built by <a href="#">FLX</a>.</p>
        <p class="mb-0">
            <a href="#">Back to top</a>
        </p>
    </footer>
</div>
</body>
</html>
