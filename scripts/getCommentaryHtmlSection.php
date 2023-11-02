<?php 

use App\Entity\Article;
use App\Entity\Commentaire;

function getCommentaryHtmlSection(Article $article, Commentaire $commentaire, $maxLength = 140)
{
    $text = $commentaire->getTexte();
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