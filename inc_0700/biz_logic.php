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


// getItemSubtotal($ItemQuantity, $ItemPrice) Takes the quantity of items and item price as parameters. returns an item subtotal, pre-tax.

function getItemSubtotal($ItemQuantity, $ItemPrice)
{
	$itemSubTotal = $ItemQuantity * $ItemPrice;
	return $itemSubTotal;	// cast as currency
}


//takes $itemSubtotal and adds it on every iteration of the each loop.

//declare variable used in getOrderSubtotal($itemSubtotal)
$orderSubtotal = 0;

function getOrderSubtotal($lineSubtotal)
{
	global $orderSubtotal;
	$orderSubtotal =  $orderSubtotal + $lineSubtotal;
	return $orderSubtotal;	// cast as currency
}


//  getTaxAmount($preTaxAmount) and getTotal($preTaxAmount) use the following variables: $percentTaxRate & $decimalTaxRate.

//ENTER tax rate as the percentage number. Example: if the taxrate is 10%, enter 10.
$percentTaxRate = 9.3; //Seattle restaurant tax is 9.3%	
$decimalTaxRate = $percentTaxRate / 100;

function getTaxAmount($preTaxAmount)
{
	global $decimalTaxRate;
	$taxAmount = $decimalTaxRate * $preTaxAmount;
	return $taxAmount;
}


function getOrderTotal($preTaxAmount)
{
	global $decimalTaxRate;	
	
	$decimalFactor = 1+ $decimalTaxRate;		
	$withTaxAmount = $decimalFactor * $preTaxAmount;
	return $withTaxAmount;		
}

