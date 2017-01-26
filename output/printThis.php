<?php

/**
 * printThis - basic output of data, great for easily seeing what you inputs are doing or returning
 *
 * @author	Stephen Neate <noosalife@gmail.com>
 * @copyright	2017 Stephen Neate
 * @license	MIT License
 * @version	1.0
 * @param	$input - primary input from script
 * @param	$echo - dictates an echo or return value
 * @param	$title - outputs a title if present
 * @param	$pretags - on by default to save a few more seconds
 * @return	output as a string
 *
 */

function pt($input, $echo = 1, $title = '',$pretags = 1) {
    ob_start();
    if (strlen($title) > 0) {
      echo '<p><strong>' . $title . '</strong></p>';
    }
    if( $pretags == 1){
      echo '<pre>';
    }
    if (is_array($input)) {
      print_r($input);
    } elseif (json_decode($input) == true) {
      print_r(json_decode($input));
    } elseif (@simplexml_load_string($input) == true) {
      print_r(simplexml_load_string($input));
    } else {
      echo $input;
    }
    if( $pretags == 1){
      echo '</pre>';
    }
    $returnThis = ob_get_contents();
    ob_end_clean();

    if ($echo === 1) {
      print $returnThis;
    } else {
      return $returnThis;
    }
  }

// the below is just some examples of this function so that you can easily copy/paste to view
echo '<h1>Just the example data and output</h1>';
$a1 = array( "a" => 0, "b" => 1, "c" => 2 );
$a2 = array( "a" => 0, "b" => 1, "c" => array(1,2,3) );
$a3 = array( "a" => 0, "b" => 1, "c" => array(1,2,3=>array('i','ii'=>array('x','y','z'),'iii')) );
$textVal = 'it really is this simple';
$json = '[{"value01":10,"value02":"3"},{"value01":11,"value02":"4"}]';
pt($a1);
pt($a2);
pt($a3,1,'Multi Dimensional Array');
echo pt($textVal,0,'Used the return option here for fun');
pt($json,1,'Some JSON output');
$string = <<<XML
<?xml version='1.0'?>
<document>
 <title>Forty What?</title>
 <from>Joe</from>
 <to>Jane</to>
 <body>
  I know that's the answer -- but what's the question?
 </body>
</document>
XML;
pt($string,1,'Some XML output');
