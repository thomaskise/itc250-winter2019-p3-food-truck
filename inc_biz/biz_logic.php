<?php 
/*
*	biz_logic.php
*	Defines business logic functions
*
*
*/


// getItem($id) loads array from $config->items[$id] into $ItemDetails
function getItem($id)
{	
	global $config;
	$index = $id -1 ;
		
	//var_dump($config->items[$index]); // loads all arrays inside an array	
	#Parent level of object
	$myArray = $config->items[$index]; //Create an array with values of object indexed at $num	
	return $myArray;
}

