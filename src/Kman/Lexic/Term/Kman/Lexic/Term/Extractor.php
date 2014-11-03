<?php
namespace Kman\Lexic\Term;

class Term
{
    public static function extract($sentence)
    {
        $words = explode(' ', $sentence);
        return $words[rand(0, count($words) - 1)];
    }
}
