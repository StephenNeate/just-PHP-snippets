<?php

/**
 * is_identical - time saver for when checking identical data sets and for selected options on a dynamic select or just in a general loop
 *
 * @author	Stephen Neate <noosalife@gmail.com>
 * @copyright	2017 Stephen Neate
 * @license	MIT License
 * @version	1.0
 * @param	$vars - input is an array of data including the following... (function is case/type sensitive)
 * @param	$vars['key'] - key value to check does exist
 * @param	$vars['values'] - the value to check the key against
 * @param	$vars['ret'] - return value required, defaults to selected (for selects)
 * @param	$vars['ignore'] - ignore value to overide some matches
 * @return true or selected depending on input
 *
 */

 function is_identical($vars) {
    if (isset($vars['key']) && isset($vars['values'])) {
      $returnTrue = 0;
      if (!isset($vars['ret'])) {
        $vars['ret'] = 'selected';
      }
      if (!isset($vars['ignore'])) {
        $vars['ignore'] = '';
      }

      if (is_array($vars['values']) && in_array($vars['key'], $vars['values']) && $vars['key'] != $vars['ignore'] ) {
        $returnTrue = 1;
      }
      if (!is_array($vars['values']) && $vars['key'] === $vars['values']) {
        $returnTrue = 1;
      }

      // return selected values
      if ($vars['ret'] == 'selected' && $returnTrue == 1) {
        return 'selected="selected"';
      }elseif ($returnTrue == 1){
        return $vars['ret'];
      }
    }
  }

// the below is just some examples of this function so that you can easily copy/paste to view
echo '<h1>Just the example data and output</h1>';

// used in a drop down
echo '<p>Select box with a selected var, default use</p>';
$formData = '<select>';
$formArray = array(''=>'',0=>'zero',1=>'one',2=>'two',3=>'three',4=>'four');
$selectedVar = 2;
       foreach ($formArray as $key => $value) {
         $formData .= '<option value="' . $key . '" ' . is_identical(array('key' => $key, 'values' => $selectedVar)) . '>' . $value . '</option>';
       }
$formData .= '</select>';
echo $formData;

echo '<p>General check 1</p>';
$genArray = array(0=>'zero',1=>'one',2=>'two',3=>'three',4=>'four');
$selectedVar = 4;
   foreach ($genArray as $key => $value) {
     if(is_identical(array('key' => $key, 'values' => $selectedVar,'ret'=>1)) == 1){
       echo 'this is identical: '.$value;
     }
   }

 echo '<p>General check 2</p>';
 $genArray = array('zero','one','two','three','four');
 $selectedVar = 'three';
    foreach ($genArray as $value) {
      if(is_identical(array('key' => $value, 'values' => $selectedVar,'ret'=>1)) == 1){
        echo 'this is identical: '.$value;
      }
    }
