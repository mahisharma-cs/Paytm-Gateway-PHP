<?php

//Read all comments carefully


	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

    session_start();
    require_once "config.php";
  
?>
<html>

//write values according to you..!!

<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $id; ?>">
<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $username; ?>">
<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
<input type="hidden" title="TXN_AMOUNT" tabindex="10" name="TXN_AMOUNT" value="<?php echo $price; ?>">
<input type="hidden" id="MSISDN" tabindex="4" maxlength="12" size="12" name="MSISDN" autocomplete="off" value="<?php echo $phone; ?>">
<input type="hidden" id="EMAIL" tabindex="4" maxlength="12" size="12" name="EMAIL" autocomplete="off" value="<?php echo $username; ?>">

<input type="submit" class="login100-form-btn" value="Pay-Online" onclick="">

</html>
