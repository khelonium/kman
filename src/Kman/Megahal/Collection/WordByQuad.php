<?php
namespace Kman\Megahal\Collection;


/**
 * A collection of words that are identified by a quad.
 * @author khelo
 */
class WordByQuad
{
    private $quads;

    /**
     * Associates a word with a quad
     *
     * @param \Quad $quad
     * @param string $word
     */
    public function add($quad, $word)
    {
        $signature = $quad->getSignature();
        $this->checkKey($signature);
        $this->quads[$signature]->add($word);
    }

    /**
     * Checks if the collection knows about a key.
     *
     * @param string $signature
     */
    private function checkKey($signature)
    {
        if (!isset($this->quads[$signature])) {
            $this->quads[$signature] = new WordCollection();
        }
    }

    /**
     * Returns a list of words associated with a quad.
     *
     * @param \Quad $quad
     * @return WordCollection
     */
    public function getWordsFor($quad)
    {
        $signature = $quad->getSignature();
        if (isset($this->quads[$signature])) {
            return $this->quads[$signature];
        }
        //NULL pattern
        return new WordCollection();
    }

    /**
     * Checks if the collection knows about a quad.
     *
     * @param \Quad $quad
     */
    public function has($quad)
    {
        $signature = (string)$quad;
        return $this->hasSignature($signature);
    }

    /**
     * Checks if a specified signature exists within current keys.
     *
     * @param string $signature
     * @return boolean
     */
    private function hasSignature($signature)
    {
        if (isset($this->words[$signature])) {
            return true;
        }
        return false;
    }

    public function dump()
    {
        $content = array();

        foreach ($this->quads as $signature => $words) {
            $line = $signature . ' ' . $words->dump();
            $content[] = $line;
        }
        return implode("\n", $content);
    }

    public function import($file)
    {
        $fp = fopen($file, 'r');
        while (!feof($fp)) {
            $line = fgets($fp);
            $matches = array();
            preg_match("/^(\S+) (.*)/", $line, $matches);
            list($line, $signature, $serialized_words) = $matches;
            $this->checkKey($signature);
            $words = unserialize($serialized_words);
            foreach ($words as $word) {
                $this->quads[$signature]->add($word);
            }
        }
    }
}