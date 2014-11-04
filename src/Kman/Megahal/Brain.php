<?php

namespace Kman\Megahal;

use BrainInterface;
use Kman\Lexic\Sentence;
use Kman\Megahal\Collection\QuadCollection;
use Kman\Megahal\Collection\QuadByWord;
use Kman\Megahal\Collection\WordByQuad;
use Kman\Megahal\Quad;

class Brain implements BrainInterface
{

    private $debug = false;


    /**
     * Holds a collection that helps to identify the next states.
     *
     * @var Kman_Collection_Word_Quad
     */
    private $next = null;

    /**
     * Holds a collection that helps to identify the previous states.
     *
     * @var Kman_Collection_Word_Quad
     */
    private $previous = null;

    /**
     * Holds quad list
     *
     * @var Kman_Collection_Quad
     */
    private $quads = null;

    /**
     * Holds word collection
     *
     * @var Kman_Collection_Quad_Word
     */
    private $words = null;


    private $_dataDir = null;
    private $_hasDataDir = false;

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        $this->quads = new QuadCollection();
        $this->words = new QuadByWord();
        $this->next = new WordByQuad();
        $this->previous = new WordByQuad();
    }

    private function debug($text, $priority = 7)
    {


    }


    /**
     * Adds a new sentence to the 'brain'
     * @param string $sentence add a sentence to the brain
     */
    public function add($sentence)
    {

        $this->debug("Adding sentence $sentence");

        $parts = Sentence::getParts($sentence);

        $parts_size = count($parts);

        $this->debug("Got $parts_size parts");


        if ($parts_size < 4) {
            return false;
        }

        for ($i = 0; $i < $parts_size - 3; $i++) {

            $quad = new Quad($parts[$i], $parts[$i + 1], $parts[$i + 2], $parts[$i + 3]);

            if ($this->quads->hasQuad($quad)) {
                $quad = $this->quads->getQuad($quad->getSignature());
            } else {
                $this->quads->add($quad);
            }

            if ($i == 0) {
                $quad->setCanStart(true);
            }

            if ($i == $parts_size - 4) {
                $quad->setCanEnd(true);
            }

            for ($n = 0; $n < 4; $n++) {
                $token = $parts[$i + $n];
                $this->words->add($token, $quad);


            }

            if ($i > 0) {
                $previousToken = $parts[$i - 1];

                $this->previous->add($quad, $previousToken);
            }

            if ($i < $parts_size - 4) {
                $next_token = $parts[$i + 4];
                $this->next->add($quad, $next_token);

            }
        }

        return true;
    }

    /**
     * Generate a sentence that includes (if possible) the specified word.
     * @param string $word
     */
    public function getSentence($word = null)
    {
        $word = trim($word);
        $this->debug("Generating a sentence about $word");
        $quads = array();
        $parts = array();

        if (isset($this->words->$word)) {
            $this->debug('Kman knows about this word');
            $quads = $this->words->$word;
        } else {
            //wtf
            $this->debug("Word not found , using random word");
            $quads = $this->quads;
        }

        if (count($quads) == 0) {
            return "";

        }

        $quad = $quads->getRandomQuad();

        for ($i = 0; $i < 4; $i++) {
            $retrieved_token = $quad->getToken($i);
            $parts[] = $retrieved_token;
        }

        $parts[] = ' ';
        while (false === $quad->canEnd()) {
            $next_tokens = $this->next->getWordsFor($quad);
            $next_token = $next_tokens->randomWord();
            $temp_quad = new Quad($quad->getToken(1), $quad->getToken(2), $quad->getToken(3), $next_token);
            $quad = $this->quads->getQuad($temp_quad->getSignature());
            //FIXME NOT SURE THIS IS OK
            $parts[] = $next_token;
        }


        $parts = array_reverse($parts);
        $parts[] = ' ';
        while ($quad->canStart() === false) {
            $previous_tokens = $this->previous->getWordsFor($quad);
            $previous_token = $previous_tokens->randomWord();

            $temp_quad = new Quad($previous_token, $quad->getToken(0), $quad->getToken(1), $quad->getToken(2));
            $quad = $this->quads->getQuad($temp_quad->getSignature());
            $parts[] = $previous_token;
        }

        $parts = array_reverse($parts);
        $result = implode('', $parts);
        return $result;
    }

    public function enableDebug()
    {
        $this->debug = true;
    }

    public function disableDebug()
    {
        $this->debug = false;
    }

    public function save()
    {
        $quad_count = $this->quads->count();
        if ($quad_count < 1) {
            return false;
        }
        if (false == $this->hasDataDir()) {
            return false;
        }
        $this->debug("Saving ", $quad_count, " quads \n");
        $dir = $this->getDataDir();
        if (!is_writable($dir)) {
            return false;
        }
        $quad_data = $dir . DIRECTORY_SEPARATOR . 'quads.dat';
        file_put_contents($quad_data, $this->quads->dump());

        $next_data = $dir . DIRECTORY_SEPARATOR . 'next.dat';
        file_put_contents($next_data, $this->next->dump());
        $prev_data = $dir . DIRECTORY_SEPARATOR . 'prev.dat';
        file_put_contents($prev_data, $this->previous->dump());
    }

    public function load()
    {
        if (false == $this->hasDataDir()) {
            return true;
        }

        $file = $this->getQaudsFile();
        if (!is_file($file)) {
            return false;
        }
        $fp = fopen($file, "r");
        $quad_count = 0;
        while (!feof($fp)) {
            $serialized_quad = fgets($fp);
            $quad = unserialize($serialized_quad);
            $this->quads->add($quad);
            $quad_count++;
            for ($i = 0; $i < 4; $i++) {
                $this->words->add($quad->getToken($i), $quad);
            }

        }
        fclose($fp);
        $this->debug("Loaded $quad_count quads");


        $this->next->import($this->getNextFile());

        $this->previous->import($this->getPrevFile());

        return true;
    }

    private function getQaudsFile()
    {
        $dir = $this->getDataDir();
        return $dir . DIRECTORY_SEPARATOR . 'quads.dat';
    }

    private function getNextFile()
    {
        $dir = $this->getDataDir();
        return $dir . DIRECTORY_SEPARATOR . 'next.dat';
    }

    private function getPrevFile()
    {
        $dir = $this->getDataDir();
        return $dir . DIRECTORY_SEPARATOR . 'prev.dat';
    }

    private function getDataDir()
    {
        return $this->_dataDir;
    }

    public function setDataDir($dir)
    {
        if (!is_dir($dir)) {
            $this->raise("No such directory $dir or not readable");
        }
        $this->_dataDir = $dir;
        $this->_hasDataDir = true;
    }

    private function hasDataDir()
    {
        return $this->_hasDataDir;
    }

    private function raise($message)
    {
        throw new Exception($message);
    }
}
