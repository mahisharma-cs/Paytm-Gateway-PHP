<?php

//Read all the comments crefully
//Read README file also..!!

    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    // following files need to be included
    require_once("./lib/config_paytm.php");
    require_once("./lib/encdec_paytm.php");

    $paytmChecksum = "";
    $paramList = array();
    $isValidChecksum = "FALSE";

    $paramList = $_POST;
    $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

    //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, 
    //TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
    $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

	//your file of database...
    require_once "config.php";
    $id = $_POST['ORDERID'];



    if($isValidChecksum == "TRUE") {
        echo "<b>Checksum matched and following are the transaction details:</b><br/>";

        if ($_POST["STATUS"] == "TXN_SUCCESS") {
            
            session_start();
            date_default_timezone_set('Asia/Kolkata');
            $current_timestamp = strtotime(date("Y-m-d H:i:s"));
            $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
            $sql = "UPDATE order_table SET ordered = 1, ordered_at=?, payment='Paytm Gateway' WHERE (id =? OR bundle_id=?)";
            $stmt = mysqli_prepare($conn,$sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt,"sii",$param_time,$param_id,$param_id);
                $param_time = $current_timestamp;
                $param_id = $_POST['ORDERID'];
                if(mysqli_stmt_execute($stmt)){
					
					//here write when your transaction get succeed...@@
					//what do you want when your transction get succeed write here..!!

					//here I am going to vieworder page...!
                    header("location: vieworder.php");
					

                    echo "1. Transation Amount : ₹".$price;

                    echo "<br> Name : $name <br> Username : $username <br> Address : $address1 $address2 $district $state $pin <br> $current_timestamp";


                }
            }
            //Process your transaction here as success transaction.
        }
        else {
            echo "<b align-'center'>Transaction status is failure</b>" . "<br/>"."<a align='center' href='delete.php?id=".$_POST['ORDERID']."'>Your transaction is failed... Please retry here...<br>When you click here your cart item is automatically deleted and the new cart is created by you... Sorry for the inconvenience</a>";

        }
        
    }
    else {
        echo "<b>Checksum mismatched.</b>";
        //Process transaction as suspicious.
    }

    echo "<br><br>2. Transation Amount : ₹".$price;

    echo "<br> Name : $name <br> Username : $username <br> Address : $address1 $address2 $district $state $pin <br> $current_timestamp";
?>