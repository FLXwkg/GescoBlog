<?php 

use App\Article;
use App\Categorie;

function getArticleHtmlSection($maxLength, Categorie $category,Article $article)
{
    $text = $article->getTexte();
    $href = strtolower(rtrim($category->getNom())) ?? 'non_defini';
    $title = strtolower($article->getTitre()) ?? 'Titre';
    $content =  '<span class="truncated-text">' . substr($text, 0, $maxLength) . '</span>';
    if (strlen($text) > $maxLength){ 
        return <<<HTML
            $content<br>
            <a href='/$href/$title'>Voir plus</a>
            HTML;
    }else{
        return <<<HTML
            $content
            HTML;
    }
    
    

}
