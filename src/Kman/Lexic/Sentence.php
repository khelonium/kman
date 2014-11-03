<?php
class Sentence
{
    public static $WORD_CHARS = "^abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    
    /**
     * Breaks a sentence in an array of words
     *
     * @param string $sentence
     * @return array an array that contains all sentence's words and punctuation marks
     */
    public static function getParts($sentence)
    {
        
        $sentence = trim($sentence);
        $parts = array();
        $punctuation = false;
        $buffer = "";
        //FIXME rewrite with explde
        $last_char = null;
        $i = 0;
        while ($i < strlen($sentence)) {
            $ch = $sentence[$i];
            if (((strpos(Sentence::$WORD_CHARS,$ch) > 0)) == $punctuation) {
                $punctuation = !$punctuation;
                if (strlen($buffer) > 0) {
                    $parts[] = $buffer;
                }
                
                $buffer = "";
                //i++;
                continue;
            }
            $buffer = $buffer .$ch;
            $i++;
        }
        
        if(strlen($buffer) > 0) {
            $parts[] = $buffer;
        }
        
        return $parts;
    }
    
}
?>