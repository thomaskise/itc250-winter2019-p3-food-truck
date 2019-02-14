<?php 
/**
 *	biz_logic.php
 *	Defines business logic functions
 *
 *  @author itc250 winter2019 group project 3
 *  @version 1.0 2019-02-14
 *  @license https://www.apache.org/licenses/LICENSE-2.0
 *
 */


/**
 * getItem($id) returns the array $myArray located at $config->items[$index] 
 */
function getItem($id)
{	
	global $config;
	$index = $id -1 ;
		
	//var_dump($config->items[$index]); // loads all arrays inside an array	
	#Parent level of object
	$myArray = $config->items[$index]; //Create an array with values of object indexed at $index	
	return $myArray;
}

/**
 *  getItemSubtotal($ItemQuantity, $ItemPrice)
 * Takes the quantity of items and item price as parameters. returns an item subtotal, pre-tax.
 */

function getItemSubtotal($ItemQuantity, $ItemPrice)
{
	$itemSubTotal = $ItemQuantity * $ItemPrice;
	return $itemSubTotal;	// cast as currency
}

/**
 * getOrderSubtotal($lineSubtotal)
 * takes $itemSubtotal and adds it on every iteration of the each loop.
 * declare variable used in getOrderSubtotal($itemSubtotal)
 */

$orderSubtotal = 0;

function getOrderSubtotal($lineSubtotal)
{
	global $orderSubtotal;
	$orderSubtotal =  $orderSubtotal + $lineSubtotal;
	return $orderSubtotal;	// cast as currency
}

/**
 * getPercentRate() converts tax rate to a percentage
 * ENTER tax rate as the percentage number. Example: if the taxrate is 10%, enter 10.
 */

$percentTaxRate = 9.3; //Seattle restaurant tax is 9.3%	
$decimalTaxRate = $percentTaxRate / 100;

function getPercentRate()
{
    global $percentTaxRate;
    $taxPercent = round((float)$percentTaxRate, 2);
    return $taxPercent;
}

/**
 * getTaxAmount($preTaxAmount) computes the taxrate using and getTot';al($preTaxAmount) use the following variables: $percentTaxRate & $decimalTaxRate.
 */
function getTaxAmount($preTaxAmount)
{
	global $decimalTaxRate;
	$taxAmount = $decimalTaxRate * $preTaxAmount;
	return $taxAmount;
}

/**
 * getOrderTotal($preTaxAmount) computes the sales tax using the $percentTaxRate
 * and adds it to the $preTaxAmount.
 */

function getOrderTotal($preTaxAmount)
{
	global $decimalTaxRate;	
	
	$decimalFactor = 1+ $decimalTaxRate;		
	$withTaxAmount = $decimalFactor * $preTaxAmount;
	return $withTaxAmount;		
}

/**
 * getPluralName($quantity, $singleName, $pluralName) gets either the $this->SingularName or 
 * the $this->PluralName from the Item class
 */

function getPluralName($quantity, $singleName, $pluralName)
{    
    if ($quantity == 1)
    {
        $ItemName = $singleName;
        return $ItemName;
    }
    elseif ($quantity >1){
        $ItemName = $pluralName;
        return $ItemName;
    } // END if/else
}

/**
 * class Item processes the menu item list in item.php into an array
 */

class Item
{
    public $ID = 0;
    public $SingularName = '';
    public $PluralName = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array();
    
    public function __construct($ID,$SingularName,$PluralName,$Description,$Price)
    {
        $this->ID = $ID;
        $this->SingularName = $SingularName;
        $this->PluralName = $PluralName;
        $this->Description = $Description;
        $this->Price = $Price;
        
    }#end Item constructor
    // future for adding extras to menu items
    public function addExtra($extra)
    {
        $this->Extras[] = $extra;
        
    }#end addExtra()
}#end Item class