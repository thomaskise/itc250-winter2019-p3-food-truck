<?php 
/*
*	biz_logic.php
*	Defines business logic functions
*	
*
*/


// getItem($id) returns the array $myArray located at $config->items[$index] 
function getItem($id)
{	
	global $config;
	$index = $id -1 ;
		
	//var_dump($config->items[$index]); // loads all arrays inside an array	
	#Parent level of object
	$myArray = $config->items[$index]; //Create an array with values of object indexed at $index	
	return $myArray;
}

