<?php

namespace Kman\Megahal;

class Quad
{

    protected $tokens = array();
    protected $canStart = false;
    protected $canEnd = false;

    private $_signature = null;
    private $_friendlyDisplay = null;

    public function __construct($s1, $s2, $s3, $s4)
    {
        $this->tokens = array($s1, $s2, $s3, $s4);
    }

    /**
     * Returns a token
     *
     * @param int $index
     * @return string selected token
     */
    public function getToken($index)
    {
        return $this->tokens[$index];
    }


    /**
     * Set can start state
     *
     * @param boolean $flag
     */
    public function setCanStart($flag)
    {
        $this->canStart = $flag;
    }

    /**
     * Set can end
     *
     * @param boolean $flag
     */
    public function setCanEnd($flag)
    {
        $this->canEnd = $flag;
    }

    /**
     * Tells if can start
     *
     * @return boolean
     */
    public function canStart()
    {
        return $this->canStart;
    }

    /**
     * Can End
     *
     * @return boolean
     */
    public function canEnd()
    {
        return $this->canEnd;
    }

    /**
     * Returns md5 signature of the quad
     * @throws Exception
     * @return string
     */
    public function getSignature()
    {
//        if(count($this->tokens) == 0 ) {
//            throw new Exception("Quad is empty");
//        }

        return $this->__toString();
    }

    /**
     * Returns string representation of the object
     * @return string
     */
    public function __toString()
    {
        if (null == $this->_signature) {
            $this->_signature = md5($this->friendly());
        }
        return $this->_signature;
    }

    public function friendly()
    {
        if (null == $this->_friendlyDisplay) {
            $description = '';

            for ($i = 0; $i < 4; $i++) {
                $description .= $this->tokens[$i];
            }
            $this->_friendlyDisplay = $description;
        }

        return $this->_friendlyDisplay;
    }

    public function dump()
    {
        return serialize($this);
    }

}
