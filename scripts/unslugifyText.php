<?php
function unslugifyText($slug) {
    // Replace hyphens with spaces
    $text = str_replace('-', ' ', $slug);
    return $text;
}