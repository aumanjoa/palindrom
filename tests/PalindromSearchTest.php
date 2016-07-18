<?php
/**
 * Test Class for PalindromSearch class 
 */

require_once('src/PalindromSearch.php');

class PalindromTest extends PHPUnit_Framework_TestCase {

    /**
    * Test function for given example 
    */
    public function testPalindromGetExpectedOutput()
    {
        $input = 'sqrrqabccbatudefggfedvwhijkllkjihxy';
        
         $expect = array(
                array(
                    'Text' => 'hijkllkjih',
                    'Index' => 23,
                    'Length' => 10
                ),
                array(
                    'Text' => 'defggfed',
                    'Index' => 13,
                    'Length' => 8                   
                ),
                array(
                    'Text' => 'abccba',
                    'Index' => 5,
                    'Length' => 6                   
                ),
                 array(
                    'Text' => 'qrrq',
                    'Index' => 1,
                    'Length' => 4                   
                )
        );

        $palindromSearch = new PalindromSearch('sqrrqabccbatudefggfedvwhijkllkjihxy');

    	$result = $palindromSearch->getOutput();	
    	$this->assertEquals($result, $expect);
    }

    /**
    * Test for PalindromSearch Class - findPalindromsInStringSortedByLeangth() 
    */
    public function testFindPalindromsInStringSortedByLeangth()
    {
        $expect = array('hijkllkjih',  'defggfed', 'abccba', 'qrrq');
        $palindromSearch = new PalindromSearch('sqrrqabccbatudefggfedvwhijkllkjihxy');

    	$result = $palindromSearch->findPalindromsInStringSortedByLeangth();	
    	$this->assertEquals($result, $expect);
    }

    /**
    * Negative Test for PalindromSearch Class - findPalindromsInStringSortedByLeangth() 
    */
    public function testFindPalindromsInStringSortedByLeangthWrontOrder()
    {
        $expect = array('hijkllkjih', 'abccba', 'qrrq', 'defggfed');
        $palindromSearch = new PalindromSearch('sqrrqabccbatudefggfedvwhijkllkjihxy');

    	$result = $palindromSearch->findPalindromsInStringSortedByLeangth();	
    	$this->assertNotEquals($result, $expect);
    }

    /**
    * Test for PalindromSearch Class - replaceGivenPalindromWithEmptyInString() 
    */
    public function testReplaceGivenPalindromWithEmptyInString()
    {
        $palindrom = 'sqrrqabccbatudefggfedvwhijkllkjihxy';
        $palindromSearch = new PalindromSearch($palindrom);
        $expect = 'sqrrqabccbatudefggfedvwxy';

    	$result = $palindromSearch->replaceGivenPalindromWithEmptyInString('hijkllkjih', $palindrom);	
    	$this->assertEquals($result, $expect);
    }

    /**
    * Test for PalindromSearch Class - _getStrLen() 
    */
    public function testPalindromExpectCorrectLength()
    {
        $expect = 10;
        $palindromSearch = new PalindromSearch('sqrrqabccbatudefggfedvwhijkllkjihxy');
    	$result = $palindromSearch->getOutput();

        $this->assertEquals($result[0]['Length'], $expect);
    }

    /**
    * Test for PalindromSearch Class - _getIndexOfPalindromInInputStr() 
    */
    public function testPalindromExpectCorrectIndex()
    {
        $expect = 23;
        $palindromSearch = new PalindromSearch('sqrrqabccbatudefggfedvwhijkllkjihxy');
    	$result = $palindromSearch->getOutput();

        $this->assertEquals($result[0]['Index'], $expect);
    }

    /**
     * Test for PalindromSearch Class - _checkValidInput()     
     * @expectedException InvalidArgumentException
     */
    public function testInputExpectException()
    {
        $palindromSearch = new PalindromSearch('sqrrqabccbatudefggf22123edvwhijkllkjihxy');
    }
}