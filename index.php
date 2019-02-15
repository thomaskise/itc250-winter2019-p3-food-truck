<?php 
include 'includes/header.php'; #provides configuration, pathing, error handling, db credentials
include 'includes/config.php'; #provides configuration, pathing, error handling, db credentials
include 'includes/biz_logic.php'; #provides business logic for subtotal, total calculation
include 'includes/items.php'; #provides business logic for subtotal, total calculation
/**
 * item-demo2.php, based on demo_postback_nohtml.php is a single page web application that allows us to request and view
 * a customer's name
 *
 * web applications.
 *
 * Any number of additional steps or processes can be added by adding keywords to the switch
 * statement and identifying a hidden form field in the previous step's form:
 *
 *<code>
 * <input type="hidden" name="act" value="next" />
 *</code>
 *
 * The above live of code shows the parameter "act" being loaded with the value "next" which would be the
 * unique identifier for the next step of a multi-step process
 *
 * @author Esteban Silva comsat61@gmail.com
 * @author Jeneva Scherr j3j3sherr@yahoo.com
 * @author Thom Harrrington thomas.harrington@seattlecentral.edu
 * @author Yonatan Gebreyesus yonatangebreyesus@gmail.com
 * @version 1.0 2019-02-14
 * @license https://www.apache.org/licenses/LICENSE-2.0
 *
 * @todo None
 *
 * END CONFIG AREA ----------------------------------------------------------
 /*

/**
 * Switch statement checks for user input and  directs to showForm() if no input received
 * and showdata() if input not recevied.
 */
if (isset($_REQUEST['act'])) {
    $myAction = (trim($_REQUEST['act']));
} else {
    $myAction = "";
}
switch ($myAction) {//check 'act' for type of process
    case "display": # 2)Display user's name!
        showData();
        break;
    default: # 1)Ask user to enter their name
        showForm();
}
/*
 * shows form so user can enter make their menu slections.
 */
function showForm()
{
    global $config;
    echo '
	<div class="container">
	<h3 style = "text-align: center;">Order great food here!</h3>
	<p style = "text-align: center;">Please select your items and submit your order</p>
    <BR />
    <BR />
    <BR />
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
             ';
    /*
 * the details of the table entailed here. Quantity, item, description, and price.
 */
    echo '
     <div class = "table-responsive">
        <table class = "table">
           <thead>
               <tr>
                  <th>Quantity</th>
                  <th>Item</th>
                  <th>Description</th>
                  <th>Price</th>
               </tr>
            </thead>
            <tbody>      
             ';
    /*
 * create form looping through each object property
 */
    foreach ($config->items as $item) {
        echo '         
               <tr>
                  <td>  
                     <div class="quantity">
                        <input type="number"  name="item_' .$item->ID . '" min="0" max="50" step="1" value="0">
                     </div>
                  </td>
                  <td>' . $item->SingularName . '</td>
                  <td>' .$item->Description . '</td>
                  <td>' . money_format('%n', $item->Price) . '</td>
              </tr>';
    }//END Foreach

    echo ' 
            </tbody>
         </table>     
      </div>  <!--DivTable Responsive-->  
          ';
    //
    echo '
       <p><input type="submit" value="Submit your order"></p>
       <input type="hidden" name="act" value="display" />
	</form>
</div><!--Div Container-->
	';

    include 'includes/footer.php';
}
/**
* form submits here we show the selected items
*/
function showData()
{
    echo '<div class="container">';
    echo '<h3 align="center">Here is your order!</h3>';
    echo'
            <div class = "table-responsive">
            <table class = "table">
                <thead>
                <tr>
                  <th>Item #</th>
                  <th>Quantity</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>';
    /*
 * loop the form elements
 */
    foreach ($_POST as $name => $value) {
        /*
 * if form name attribute starts with 'item_', process it
 */
        if (substr($name, 0, 5)=='item_') {
            /*
 * explode the string into an array on the "_" looks like this :
 * array(2) { [0]=> string(4) "item" [1]=> string(1) "9" }
 * id is the second element of the array
 * forcibly cast to an int in the process
 * getItem() finds the parent-level array for an index $id -1 of the object.
 */
            $name_array = explode('_', $name);
            $id = (int)$name_array[1];
            $ItemDetails = getItem($id);

            /*
 * Calculates items pre-tax subtotal using array child-level key and the $value variable from
 * the foreach() loop above.
 */
            $myItemSubtotal = getItemSubtotal($value, $ItemDetails->Price);
            /*
 * Calculates the order pre-tax subtotal adding $myItemSubtotal on each loop
 */
            $myOrderSubtotal = getOrderSubtotal($myItemSubtotal);
            if ($value > 0) {
                /*
 * Get either the $this->SingularName or the $this->PluralName from the Item class
 */
                $myItemName = getPluralName($value, $ItemDetails->SingularName, $ItemDetails->PluralName);

                /*
 * Item line details below.
 */
                echo "
                        <tr>
                          <td>$id</td>
                          <td>$value</td>
                          <td>$myItemName</td>
                          <td>$ItemDetails->Description</td>
                          <td>" . money_format('%n', $ItemDetails->Price) . "</td>
                          <td>" . money_format('%n', $myItemSubtotal) . "</td>
                        </tr>                  
                    ";
            } else {
                echo'';
            }//end if / else if ($value > 0)
        }//end if(substr($name,0,5)=='item_')
    }//end foreach

    echo'    </tbody>
            </table>
            </div>';
    /*
 * block below is the totals section
 * @todo: might want to add some styling to the totals.
 * echoes output from cumulative total via the getOrderSubtotal($myItemSubtotal);
 */
    if ($myOrderSubtotal > 0) { //show totals   echo "<b><p style=\"color:blue;\">Pre-tax subtotal: " . money_format('%n', $myOrderSubtotal) ."</p></b>";
     /*
 * print order tax amount
 */
     $myTaxAmount = getTaxAmount($myOrderSubtotal); // change tax rate in 'includes/config.php'
     echo "<b><p style=\"color:blue;\">Tax amount: " . money_format('%n', $myTaxAmount) ."</p></b>";

     //$percentTaxRate is defined in 'includes/config.php'
     $myTaxPercent = getPercentRate();
        echo "<b><p style=\"color:blue;\">Tax Rate: " . $myTaxPercent . "%</p></b>";
     //creates total with percentage added
     $myTotal = getOrderTotal($myOrderSubtotal);
        echo "<b><p style=\"color:blue;\">Order Total: " . money_format('%n', $myTotal) ."</p></b>";
    } else {
        //if form submitted with no items, propmt user to choose some items.
        echo 'Please add an item to your cart';
    }

    //Go BACK link
    echo '<p style = "text-align: center;"><a href="' . THIS_PAGE . '">ORDER AGAIN</a></p>';
    echo '</div>';

    include 'includes/footer.php'; #defaults to footer_inc.php
}//end showData()
?>
