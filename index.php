<?php
/**
 * Index file to test the script
 */

require_once('src/PalindromSearch.php');
ini_set('error_reporting', E_NOTICE);

$palindromSearch = new PalindromSearch('sqrrqabccbatudefggfedvwhijkllkjihxy');
$result = $palindromSearch->getOutput();	
var_dump($result);
?>