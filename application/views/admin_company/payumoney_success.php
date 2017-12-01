
<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            body{
                background: #b3cccc;
            } 
            .success-box{
                max-width: 400px;
                padding: 10px 40px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 150px;
                display: block;
                float: none;
                background: #76d785;
                border-radius: 10px;
                -webkit-border-radius: 10px;
                border: 2px solid #999999;
                box-shadow: 0px 3px 4px rgba(0,0,0,0.6);
                -webkit-box-shadow: 0px 3px 4px rgba(0,0,0,0.6);
                -moz-box-shadow: 0px 3px 4px rgba(0,0,0,0.6);
            }
            .transaction-box{
                margin: 0px 5px;
                box-shadow: inset 2px 3px 4px rgba(0,0,0,0.6);
                -webkit-box-shadow: inset 2px 3px 4px rgba(0,0,0,0.6);
                -moz-box-shadow: inset 2px 3px 4px rgba(0,0,0,0.6);
                background: #ffffff;
                padding: 6px 8px;
                font-size: 16px!important;
                letter-spacing: 0.5px;
            }
            .redirect-link{
                margin-top: 25px;
                 max-width: 400px;
                padding: 10px 40px;
                margin-left: auto;
                margin-right: auto;

            }
        </style>
    </head>
    <body onload="startTimer();">
        <div class="success-box">
            <?php
            echo "<h1>Hello " . $payment_data['first_name'] . ",</h1> <h2>you have Subscribed Successfully</h2><br>"
                    . " <h2>Please check your mail for further details</h2>";
            if($subsciption_type=='Paid'){
            echo "<h3>We have received a payment of Rs. " . $payment_data['amount'] . ". </h3>";
            echo "<h4>Your Transaction ID  is <span class='transaction-box'> " . $payment_data['txn_id'] . "</span></h4>";

            
            }
            ?>	
        </div>
    <h4 class='redirect-link'> You will be directed to login link within <span id="count" style="color:red">10</span> seconds  </h4>

        <script type="text/javascript">
        
             function startTimer() {
             var counter = 10;
             setInterval(function() {
             counter--;
             if (counter >= 0) {
             span = document.getElementById("count");
             span.innerHTML = counter;
             }
             if (counter === 0) {
             window.location.href="<?php echo $user_login_link; ?>";
             clearInterval(counter);
             }
             }, 1000);
      
             }
    
        </script>
    </body>
</html>