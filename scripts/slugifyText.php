<?php
function slugifyText($string) {
    // Remove special characters and spaces
    $string = preg_replace('/[\'"\[\]]/', '-', $string);
    // Convert spaces to hyphens
    $string = preg_replace('/\s+/', '-', $string);
    
    // Remove consecutive hyphens
    $string = preg_replace('/-+/', '-', $string);
    
    // Convert to lowercase
    $string = mb_strtolower($string, 'UTF-8');
    
    // Remove leading and trailing hyphens
    $string = trim($string, '-');
    
    return $string;
}