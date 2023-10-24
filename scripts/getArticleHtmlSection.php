<?php 

use App\Article;
use App\Categorie;

function getArticleHtmlSection(Article $article, $maxLength = 140)
{
    $text = $article->getTexte();
    $href='/foo/bar'; // FIXME: on doit recupeer les infos de la categorie .. ou tout simplement l'url de l'article complete
//    $href = strtolower(rtrim($category->getNom())) ?? 'non_defini';
    $title = slugifyText($article->getTitre()) ?? 'Titre';
    $content =  '<span class="truncated-text">' . substr($text, 0, $maxLength) . '</span>';
    if (strlen($text) > $maxLength){ 
        return <<<HTML
            $content<br>
            <a href='/$href/$title' target="_blank" >Voir plus</a>
            HTML;
    }else{
        return <<<HTML
            $content
            HTML;
    }
    
    

}
