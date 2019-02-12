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
 * @package ITC281
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 1.1 2011/10/11
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @todo finish instruction sheet
 * @todo add more complicated checkbox & radio button examples
 */

//END CONFIG AREA ----------------------------------------------------------
# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}
switch ($myAction) 
{//check 'act' for type of process
	case "display": # 2)Display user's name!
	 	showData();
	 	break;
	default: # 1)Ask user to enter their name 
	 	showForm();
}
function showForm()
{# shows form so user can enter their name.  Initial scenario
	global $config;

	echo 
	'<script type="text/javascript" src="include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.YourName,"Please Enter Your Name")){return false;}
			return true;//if all is passed, submit!
		}
	</script>
	<div = "container">
	<h3 align="center">Order great food here!</h3>
	<p align="center">Please select your items and submit your order</p>
    <BR />
    <BR />
    <BR />
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
             ';
      echo '
      <div class = "table-responsive">
        <table class = "table">
            <tr>
                <th>Quantity</th>
                <th>Item</th>
                <th>Description</th>
                <th>Price</th>
            </tr>';
    
		foreach($config->items as $item)
          {
            //echo "<p>ID:$item->ID  Name:$item->Name</p>"; 
            //echo '<p>Taco <input type="text" name="item_1" /></p>';
            echo '
            <tr>
              <td>  
                <input type="number"  name="item_' .$item->ID . '" min="0" max="50">
              </td>
              <td>' . $item->Name . '</td>
              <td>' .$item->Description . '</td>
              <td>' . money_format('%n', $item->Price) . '</td>
            </tr>';
            
            
            
            /*OLD FORM HTML
            echo '
            <tr>
              <td>  <select name="item_' .$item->ID . '">
                        <option value=0>0</option>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                        <option value=7>7</option>
                        <option value=8>8</option>
                        <option value=9>9</option>
                        <option value=10>10</option>
                  </select>
              </td>
              <td>' . $item->Name . '</td>
              <td>' .$item->Description . '</td>
              <td>' . money_format('%n', $item->Price) . '</td>
            </tr>';
            END OLD FORM HTML*/
              //echo '<p>' . $item->Name . ' <input type="text" name="item_' . $item->ID . '" /></p>';
              
          }  
          echo '</table></div>';
 
          echo '
				<p>
					<input type="submit" value="Submit your order"><em>(<font color="red"><b>*</b> required field</font>)</em>
				</p>
		<input type="hidden" name="act" value="display" />
	</form>
	';
	include 'includes/footer.php';
}
function showData()
{#form submits here we show entered name
	
    //dumpDie($_POST);
	
	
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
    
	foreach($_POST as $name => $value)
    {//loop the form elements
        
        //if form name attribute starts with 'item_', process it
        if(substr($name,0,5)=='item_')
        {
            //explode the string into an array on the "_" looks like this : array(2) { [0]=> string(4) "item" [1]=> string(1) "9" }
            $name_array = explode('_',$name);
            //id is the second element of the array
			//forcibly cast to an int in the process
            $id = (int)$name_array[1];
			/*
				Here is where you'll do most of your work
				Use $id to loop your array of items and return 
				item data such as price.
				
				Consider creating a function to return a specific item 
				from your items array, for example:
				
				$thisItem = getItem($id);
				
				Use $value to determine the number of items ordered 
				and create subtotals, etc.
			
	 		*/
			//getItem() finds the parent-level array for an index $id -1 of the object.
			$ItemDetails = getItem($id); 					
			
			#child level of object
			//echo $ItemDetails->Price;
			//var_dump($ItemDetails->Price);
						
			//Calculates items pre-tax subtotal using array child-level key and the $value variable from 
			//the foreach() loop above.
			$myItemSubtotal = getItemSubtotal($value, $ItemDetails->Price);						
						
			// Calculates the order pre-tax subtotal adding $myItemSubtotal on each loop
			$myOrderSubtotal = getOrderSubtotal($myItemSubtotal);	
			if ($value > 0)
			{
                //Function gets either the $this->SingularName or the $this->PluralName from the Item class
                $myItemName = getPluralName($value, $ItemDetails->SingularName, $ItemDetails->PluralName);
                    
				echo '</pre>';

				//Item line details below.
				//@todo: each line item could be a column in a table, receipt-like.
                    
				/*echo "
				<div class = \"container\">
					<b><p>Item number: $id. </p>
                    <p>Quantity Ordered: $value. </p>
                    <p>Item Name: $myItemName. </p>
                    <p>Item Description: $ItemDetails->Description. </p>
					<p>Item Price: " . money_format('%n', $ItemDetails->Price) . ". </p>
					<p>Item Order Subtotal: <span style=\"color:red;\"> " . money_format('%n', $myItemSubtotal) . "</span></p>
					</b>
				</div> <!--container-->

				";*/
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
                
			}else{			       

				echo'';
			}//end if / else if ($value > 0)
								
        }//end if(substr($name,0,5)=='item_')
        
        
    }//end foreach
    
    echo'    </tbody>
            </table>
            </div>';
	
	if ($myOrderSubtotal > 0) //show totals
	{
		//block below is the totals section
		//@todo: might want to add some styling to the totals. 

		//echoes output from cumulative total via the getOrderSubtotal($myItemSubtotal); function in the foreach loop
        echo '<div class="container">';
        
		echo "<b><p style=\"color:blue;\">Pre-tax subtotal: " . money_format('%n', $myOrderSubtotal) ."</p></b>";

		//print order tax amount
		$myTaxAmount = getTaxAmount($myOrderSubtotal); // change tax rate in 'includes/config.php'
		echo "<b><p style=\"color:blue;\">Tax amount: " . money_format('%n', $myTaxAmount) ."</p></b>";
        
        //$percentTaxRate is defined in 'includes/config.php' 
		echo "<b><p style=\"color:blue;\">Tax Rate: " . money_format('%n', $percentTaxRate) ."</p></b>";      

		//creates total with percentage added
		$myTotal = getOrderTotal($myOrderSubtotal);
		echo "<b><p style=\"color:blue;\">Order Total: " . money_format('%n', $myTotal) ."</p></b>";
        
        echo '</div>';
	}else{// redirect		       

		echo '<script type="text/javascript">
           window.location = "' . THIS_PAGE . '"
      </script>';
	}//end else


	
	//Go BACK link
	echo '<p align="center"><a href="' . THIS_PAGE . '">RESET</a></p>';	
	
	include 'includes/footer.php'; #defaults to footer_inc.php
}//end showData()
?>