
<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            body{
                background:  #b3cccc

            } 
            .success-box{
                max-width: 400px;
                padding: 10px 40px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 150px;
                display: block;
                float: none;
                background: #e77e7e;
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
            echo "<h1>Hello " . $failed_trans_data['first_name'] . ",</h1> <h2>Your Transaction has failed</h2>";
            echo "<h3>Reason is " . $failed_trans_data['unmappedstatus'] . ". </h3>";
            echo "<h4>For further details please contact us .</span></h4>";

            echo ""
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
             window.location.href="<?php echo base_url() . 'employee'; ?>";
             clearInterval(counter);
             }
             }, 1000);
      
             }
    
        </script>
    </body>
</html>