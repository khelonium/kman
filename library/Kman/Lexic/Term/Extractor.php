<?php
class Kman_Lexic_Term_Extractor
{
    public static function extract($sentence)
    {
        $words = explode(' ', $sentence);
        return $words[rand(0,count($words)-1)];
    }
}
?>