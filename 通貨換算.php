<?php

include "convert.php";

$from       = isset($_POST['from']) ? $_POST['from'] : '';

$to         = isset($_POST['to']) ? $_POST['to'] : '';

$amount     = isset($_POST['amount']) ? $_POST['amount'] : '';

$content = "";

if($_POST){

    if(!is_numeric($amount)){

    $content .= "<br><span style='background-color:red;padding:5px;color:#fff;'>Invalid amount.</span>";

    }

    elseif($from == $to){

    $content .= "<br><span style='background-color:red;padding:5px;color:#fff;'>Please select distinct currencies.</span>";

    }

    else{

    $rawData = currencyConvert($from,$to,$amount);

    $regex  = '#\<span class=bld\>(.+?)\<\/span\>#s';

    preg_match($regex, $rawData, $converted);

    $result = $converted[0];

    if($result == ""){

        $content .= "<br><span style='background-color:red;padding:5px;color:#fff;'>Exchange Rate not available.</span>";

    }

    else{

        $content .= "<br><span style='background-color:lime;padding:5px;'>".$amount." ".$from." = ".$result."</span>";

    }

    }

}

$listFrom = '

<select name="to">

<option  value="JPY">Japanese Yen (¥)</option>

<option  value="EUR">Euro (€)</option>

<option  value="VND">Vietnamese Dong (₫)</option>

<option  value="INR">Indian Rupee (Rs.)</option>

<option  value="PKR">Pakistani Rupee (PKR)</option>

<option  value="SGD">Singapore Dollar (SGD)</option>

<option  value="USD">US Dollar ($)</option>

</select>

';



$listTo = '

<select name="to">

<option  value="JPY">Japanese Yen (¥)</option>

<option  value="EUR">Euro (€)</option>

<option  value="VND">Vietnamese Dong (₫)</option>

<option  value="INR">Indian Rupee (Rs.)</option>

<option  value="PKR">Pakistani Rupee (PKR)</option>

<option  value="SGD">Singapore Dollar (SGD)</option>

<option  value="USD">US Dollar ($)</option>

</select>

';

$listFrom  = str_replace("\"$from\"","\"$from\" selected",$listFrom); // Make dropdown selected

$listTo    = str_replace("\"$to\"","\"$to\" selected",$listTo); // Make dropdown selected



$content .='<form action="" method="post" name="f">

<input name="amount" maxlength="12" size="5" autocomplete="off" value="'.$amount.'"><br />

<div>

'.$listFrom.'

</div>

<div style="padding: 6px 8px">to</div>

<div>

'.$listTo.'

</div>

<input type=submit value="Convert">

</form>';

?>
