<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Blog</title>
    </head>
    <body>
        <div class="container">
            <header class="blog-header py-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-4"></div>
                    <div class="col-4 text-center"><a class="blog-header-title text-dark" style="font-size: xx-large;" href="/home">Blog</a></div>
                    <div class="col-4 d-flex justify-content-end align-items-center"></div>
                </div>
            </header>
            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between my-2">
                    <a class="p-2 text-muted" href="/world">World</a>
                    <a class="p-2 text-muted" href="/technology">Technology</a>
                    <a class="p-2 text-muted" href="/design">Design</a>
                    <a class="p-2 text-muted" href="/culture">Culture</a>
                    <a class="p-2 text-muted" href="/business">Business</a>
                    <a class="p-2 text-muted" href="/politics">Politics</a>
                    <a class="p-2 text-muted" href="/science">Science</a>
                    <a class="p-2 text-muted" href="/health">Health</a>
                    <a class="p-2 text-muted" href="/style">Style</a>
                    <a class="p-2 text-muted" href="/travel">Travel</a>
                </nav>
            </div>
            <main role="main" class="container">
                <div class="row">
                    <h1 class="pb-3 mb-4 font-italic border-bottom ">
                        <?php
                        $firstCategory = $categorie[0] ?? [];
                        echo $firstCategory['nom_categorie'] ?? 'non defini';
                        ?>

                    </h1>
                    <div class="blog-post">
                        <h2 class="blog-post-title">Laravel-Homestead</h2>
                            <p class="blog-post-meta">September 19, 2023 by <a href="#">FLX</a></p>

                            <p>Ce post à pour but d'expliquer en quoi consiste <strong>Laravel-Homestead</strong></p>

                            <p>Il utilise <a href="#">Vagrant</a> qui configure <a href="#">Virtualbox</a> afin de créer une machine virtuelle qui nous servira d'<strong>environnement de travail</strong>.</p>
                            <blockquote>
                        <h2>Configuration de Homestead</h2>
                            <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                        <h3>Vagrant</h3>
                            <p>Permet de lancer la machine virtuelle et de s'y connecter avec :</p>
                            <pre><code>vagrant ssh</code></pre>
                        <h3>Slim Framework</h3>
                            <p>Le framework que j'ai utilisé pour coder ce site</p>
                        <hr>
                    </div>

                    <?php foreach ($article as $article): ?>
                    <div class="blog-section">
                        <div class="blog-post">
                            <h2 class="blog-post-title"><?= $article['titre_article']; ?></h2>
                            <p class="blog-post-meta"><?= $article['date_modification_article']; ?> by <a href="#"><?php echo $article['auteur_article']; ?></a></p>

                            <p><?= $article['texte_article']; ?></p>
                        </div>
                        <hr>
                        <div class="blog-commentaries d-flex justify-content-evenly">
                            <?php foreach ($commentaire as $commentaire): ?>
                            <div class="blog-commentary border-bottom">
                                <h5><?= $commentaire['auteur_commentaire']; ?></h5>
                                <p class="blog-commentaries-meta">Published on <?= $commentaire['date_commentaire'];?></p>
                                <p><?= $commentaire['texte_commentaire'];?></p>
                            </div>
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
            <footer></footer>
        </div>
    </body>
</html>