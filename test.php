<?php include 'header.php'?>
<!--
https://stackoverflow.com/questions/45396280/customizing-increment-arrows-on-input-of-type-number-using-css
https://www.w3schools.com/jsref/met_number_stepup.asp
-->

<link media="all" rel="stylesheet" href="./css/form.css">

    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">

<div>
  <button type="button" onclick="this.parentNode.querySelector('[type=number]').stepDown();">
    -
  </button>

  <input type="number" name="number" min="0" max="100" value="0">

  <button  class="pure-button pure-button-primary" type="button" onclick="this.parentNode.querySelector('[type=number]').stepUp();">
    +
  </button>
</div>



<button class="pure-button pure-button-primary">A Primary Button</button>


<table class="pure-table pure-table-horizontal">
    <tbody>
        <tr>
            <td>Pre-tax subtotal: </td>
            <td>" . money_format('%n', $myOrderSubtotal) . "</td>

        </tr>

        <tr>
            <td>Tax amount:</td>
            <td>" . money_format('%n', $myTaxAmount) ."</td>

        </tr>

        <tr>
            <td>Tax Rate:</td>
            <td>" . $myTaxPercent . "%</td>

        </tr>       
        
        <tr>
            <td>Order Total:</td>
            <td>" . money_format('%n', $myTotal) ."</td>

        </tr>
    </tbody>
</table>