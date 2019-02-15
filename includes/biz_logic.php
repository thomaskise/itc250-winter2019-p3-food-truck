<?php 
/**
 *	biz_logic.php
 *	Defines business logic functions
 *
 * @author Esteban Silva comsat61@gmail.com
 * @author Jeneva Scherr j3j3sherr@yahoo.com
 * @author Thom Harrrington thomas.harrington@seattlecentral.edu
 * @author Yonatan Gebreyesus yonatangebreyesus@gmail.com
 * @version 1.0 2019-02-14
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @todo none
 */

/**
 *  processes items on list into an array
 *
 * <code>
 *   ItemDetails = getItem($id);
 * </code>
 * * @param int $id is the item number
 * @return array $myArray of all the items and their paramters on the item list located at $config->items[$index]
 * @todo none 
 *
 */

function getItem($id)
{
    global $config;
    $index = $id -1;
    $myArray = $config->items[$index]; //Create an array with values of object indexed at $index
    return $myArray;
}

/**
 * Takes the quantity of items and item price as parameters. returns an item subtotal, pre-tax.
 *
 * <code>
 *   $myItemSubtotal = getItemSubtotal($value, $ItemDetails->Price);
 * </code>
 *
 * @param int $ItemQuantity the quantity ordered for an item
 * @param float $ItemPrice the price for one of the items ordered
 * @return float $itemSubTotal - the subtotal of the item ordered (pretax)
 * @todo none 
 *
 */

function getItemSubtotal($ItemQuantity, $ItemPrice)
{
    $itemSubTotal = $ItemQuantity * $ItemPrice;
    return $itemSubTotal;    // cast as currency
}

/**
 * getOrderSubtotal($lineSubtotal)
 * computes the total pretax value of the order
 *
 * adds line item subtotals $itemSubtotal and adds it on every iteration of the each loop.
 * declare variable used in getOrderSubtotal($itemSubtotal)
 *
 * <code>
 *   $myOrderSubtotal = getOrderSubtotal($myItemSubtotal);
 * </code>
 *
 * @param float $lineSubtotal is the line item subtotal
 * @return float $orderSubtotal : cast as currency
 * @todo none 
 *
 */

$orderSubtotal = 0;

function getOrderSubtotal($lineSubtotal)
{
    global $orderSubtotal;
    $orderSubtotal =  $orderSubtotal + $lineSubtotal;
    return $orderSubtotal;  
}

/**
 * converts tax rate to a percentage
 *
 * ENTER $percentTaxRate as the percentage number. Example: if the taxrate is 10%, enter 10.
 *
 * <code>
 *    $myTaxPercent = getPercentRate();
 * </code>
 *
 * @param none
 * @return float $taxPercent the tax percentage used to caluculate tax
 * @todo none 
 *
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
 * computes the tax amount 
 *
 * <code>
 *   $myTaxPercent = getPercentRate();
 * </code>
 *
 * @param float $preTaxAmount the total pretax sale value
 * @return float $taxAmount the total dollar amount of the tax
 * @todo none
 */

function getTaxAmount($preTaxAmount)
{
    global $decimalTaxRate;
    $taxAmount = $decimalTaxRate * $preTaxAmount;
    return $taxAmount;
}

/**
 * computes the sales tax using the $percentTaxRate
 * and adds it to the $preTaxAmount.
 *
 * <code>
 *   $myTotal = getOrderTotal($myOrderSubtotal);
 * </code>
 *
 * @param float $preTaxAmount the total pretax sale value
 * @return float $withTaxAmount the total dollar amount of the sale with tax included
 */

function getOrderTotal($preTaxAmount)
{
    global $decimalTaxRate;

    $decimalFactor = 1+ $decimalTaxRate;
    $withTaxAmount = $decimalFactor * $preTaxAmount;
    return $withTaxAmount;
}

/**
 * Gets the plural name if a value greater than 1 
 *
 * <code>
 *   $myItemName = getPluralName($value, $ItemDetails->SingularName, $ItemDetails->PluralName)
 * </code>
 *
 * @param int $quantity the quantity selected
 * @param string $singleName the singular name of the item (e.g. taco)
 * @param string $pluralName the plural name of the item (e.g. tacos)
 * @return
 * @todo none
 */

function getPluralName($quantity, $singleName, $pluralName)
{
    if ($quantity == 1) {
        $ItemName = $singleName;
        return $ItemName;
    } elseif ($quantity >1) {
        $ItemName = $pluralName;
        return $ItemName;
    } // END if/else
}

/**
 * class Item processes the menu item list in item.php into an array
 *
 *<code>
 * $myItem = new Item(1,"Taco", "Tacos","Our Tacos are awesome!",4.95);
 *</code>
 *
 * @todo none
 */

class Item
{
    public $ID = 0;
    public $SingularName = '';
    public $PluralName = '';
    public $Description = '';
    public $Price = 0;
    public $Extras = array();

    public function __construct($ID, $SingularName, $PluralName, $Description, $Price)
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
