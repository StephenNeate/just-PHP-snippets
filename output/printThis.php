<?php

// printThis - basic output of data, great for easily seeing what you inputs are
// $input is primary input, $echo dictates an echo or return value, $title outputs a title if present
function pt($input,$echo=1,$title=''){
  ob_start();
		if( strlen($title) ){
			print '<p><strong>'.$title.'</strong></p>';
		}
		echo '<pre>';
		if(is_array($input)){ 
			print_r($input);
		}elseif( json_decode($input) == true ){
			print_r(json_decode($input));
		}else{
			echo $input;
		}
		echo '</pre>';
	$returnThis = ob_get_contents();
	ob_end_clean();
	
	if( $echo == 1 ){
		print $returnThis;
	}else{
		return $returnThis;
	}
}

echo '<h1>Just the example data and output</h1>';

$a1 = array( "a" => 0, "b" => 1, "c" => 2 ); 
$a2 = array( "a" => 0, "b" => 1, "c" => array(1,2,3) ); 
$a3 = array( "a" => 0, "b" => 1, "c" => array(1,2,3=>array('i','ii'=>array('x','y','z'),'iii')) ); 
$textVal = 'it really is this simple';
$json = '[{"value01":10,"value02":"3"},{"value01":11,"value02":"4"}]';

pt($a1);
pt($a2);
pt($a3);
pt($textVal);
pt($json);
