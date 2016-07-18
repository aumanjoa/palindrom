<?php
/**
 * PalindromSearch class to return all Palindroms in a given string sorted by Length
 */
require_once('lib/ManachersAlgorithm.php');

class PalindromSearch
{
    private $input = '';
    
    /**
    * @param string $input given string to use for finding Palindroms
    * @throws InvalidArgumentException if the provided input is not matching ^[aA-zZ]+$
    */    
    public function __construct( $input)
    {
        $this->input = $input;
        if (!$this->_checkValidInput())
        {
            throw new InvalidArgumentException('String is not matching ^[aA-zZ]+$');
        }
    }

    /**
    * @return array with list of Palindroms including 
    * Text => Palindrom
    * Index => Index of the palindrom in given string,
    * Length => length of the palindrom 
    */    
    public function getOutput()
    {
        $output = array();   
        
        foreach ($this->findPalindromsInStringSortedByLeangth() as $palindrom) {

            $palindromInString = array(
                    'Text' => $palindrom,
                    'Index' =>  $this->_getIndexOfPalindromInInputStr($palindrom),
                    'Length' => $this->_getStrLen($palindrom)
                );
            array_push($output, $palindromInString);
        }

        return $output;
    }

    /**
    * Calling the ManachersAlgorithm and returning a list of the 5 longest Palindroms ( considers palindrom with more than 3 characers)
    * @return array
    */   
    public function findPalindromsInStringSortedByLeangth()
    {
        $manachersAlgorithm = new ManachersAlgorithm;
        $temp = $this->input;
        $return = array();
        
        for ($i=0; $i < 5; $i++) { 
            $palindrom = $manachersAlgorithm->findLongestPalindrome($temp);
            if (strlen($palindrom) > 3)
            {
                $temp = $this->replaceGivenPalindromWithEmptyInString($palindrom, $temp);
                array_push($return, $palindrom);
            }
        }

        return $return;
    }

    /**
     * replaces the given palindrom in a given string
     * @param string $palindromReplace
     * @param string $string
     *      
     * @return string replaces string
    */   
    public function replaceGivenPalindromWithEmptyInString($palindromReplace, $string)
    {
        return str_replace($palindromReplace, '', $string);
    }

    /**
     * return the string length for a given string $input
     * @param string $input
     *      
     * @return int length
    */   
    private function _getStrLen ($input)
    {
        return strlen($input);
    }

    /**
     * return the index of the Palindrom in the given class input string
     * @param string $palindrom
     *      
     * @return int position 
    */   
    private function _getIndexOfPalindromInInputStr ($palindrom)
    {
        return strpos($this->input, $palindrom);
    }

  /**
     * checks if given string is matching the given regex pattern
     *      
     * @return boolean
    */   
    private function _checkValidInput()
    {
        return preg_match('/^[aA-zZ]+$/', $this->input);
    }
}