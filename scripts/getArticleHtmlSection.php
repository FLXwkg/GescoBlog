<?php 

use App\Article;


function getArticleHtmlSection(Article $article, $maxLength = 140)
{
    $text = $article->getTexte();
    $href=$article->getUrlArticle();
    $content =  '<span class="truncated-text">' . substr($text, 0, $maxLength) . '...</span>';
    if (strlen($text) > $maxLength){
        return <<<HTML
            $content
            <a class="article-link" href="$href" >Voir plus</a>
            HTML;
    }else{
        return <<<HTML
            <span class="non-truncated-text">
                $text
            </span>
            HTML;
    }

}
