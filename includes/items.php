<?php
/**
 * items.php just a list of menu items
 * this list is a feed, not programmatic perse.
 To add items, copy an item block to the bottom of the list, increment the item number so not to duplicate
 * the menu items are processed into the Class Item array  in biz_logic.php
 * @author Esteban Silva comsat61@gmail.com
 * @author Jeneva Scherr j3j3sherr@yahoo.com
 * @author Thom Harrrington thomas.harrington@seattlecentral.edu
 * @author Yonatan Gebreyesus yonatangebreyesus@gmail.com
 * @version 1.0 2019-02-14
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @todo none
 */

/*
*
* Class structure for reference only
*
* see class Item in biz_logic.php
* 
* public $ID = 0;
* public $SingularName = '';
* public $PluralName = '';
* public $Description = '';
* public $Price = 0;
* public $Extras = array();
*
*/

$myItem = new Item(1,"Taco", "Tacos","Our Tacos are awesome!",4.95);
$myItem->addExtra("Sour Cream");
$myItem->addExtra("Cheese");
$myItem->addExtra("Guacamole");
$config->items[] = $myItem;

$myItem = new Item(2,"Sundae","Sundaes","Our Sundaes are awesome!",3.95);
$myItem->addExtra("Sprinkles");
$myItem->addExtra("Chocolate Sauce");
$myItem->addExtra("Nuts");
$config->items[] = $myItem;

$myItem = new Item(3,"Salad","Salads","Our Salads are awesome!",5.95);
$myItem->addExtra("Croutons");
$myItem->addExtra("Bacon");
$myItem->addExtra("Lemon Wedges");
$myItem->addExtra("Avacado");
$config->items[] = $myItem;

$myItem = new Item(4,"Hot Tamale","Hot Tamales","Our Tamales are awesome!",7.95);
$myItem->addExtra("Salsa");
$myItem->addExtra("Guacamole");
$myItem->addExtra("Habenaro Peppers");
$myItem->addExtra("Sour Cream");
$config->items[] = $myItem;

$myItem = new Item(5,"Chile Relleno","Chiles Rellenos","Chile Relleno are awesome!",6.95);
$myItem->addExtra("Salsa");
$myItem->addExtra("Guacamole");
$myItem->addExtra("Habenaro Peppers");
$myItem->addExtra("Sour Cream");
$config->items[] = $myItem;
?>