<?php 

use App\Article;
use App\Categorie;

function getArticleHtmlSection(Article $article, $maxLength = 140)
{
    $text = $article->getTexte();
    $href=$article->getUrlArticle();
    $title = slugifyText($article->getTitre()) ?? 'Titre';
    $content =  '<span class="truncated-text">' . substr($text, 0, $maxLength) . '</span>';
    if (strlen($text) > $maxLength){ 
        return <<<HTML
            $content<br>
            <a href="$href" >Voir plus</a>
            HTML;
    }else{
        return <<<HTML
            $content
            HTML;
    }
    
    

}
