


<!DOCTYPE html>
<html>
    <head><script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js">
        </script>
        <script>var status = "check";
            $(document).ready(function () {
                $("#reset_password_form").submit(function () {

                    var datastring = {'email_id': $("#email_id").val(), 'status': status};
                    event.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "../admin_company/request_password_reset",
                        data: datastring,
                        dataType: 'text',
                        success: function (data) {
                                 if(data==='Success'){
                                //   location.href = "admin/startpageapp";
                              }
                              else if(data==="User Fail"){
                                  alert("user id not available with given email");
                              }
                              else if(data==="System Error"){
                                  alert("System Error,Please contacrt adminstrator");
                              }
                              else{
                                  alert(data);
                              }
                        },
                        error: function () {
                            alert('error handing here');
                        }
                    });


                });
                $("#reset_password_button").click(function(){
                    var datastring = {'email_id': $("#email_id").val(), 'code': $("#reset_password_code").val()};
                    alert(); 
                            $.ajax({
                        type: "POST",
                        url: "../admin_company/verify_reset_password_code",
                        data: datastring,
                        dataType: 'text',
                        success: function (data) {
                                 if(data==='Success'){
                                //   location.href = "admin/startpageapp";
                              }
                              else if(data==="User Fail"){
                                  alert("user id not available with given email");
                              }
                              else if(data==="System Error"){
                                  alert("System Error,Please contacrt adminstrator");
                              }
                              else{
                                  alert(data);
                              }
                        },
                        error: function () {
                            alert('error handing here');
                        }
                    });   
                });
                  $("#payuForm").submit(function () {

                     var datastring = $("#payuForm").serialize();
                    event.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "../admin_company/get_hash",
                        data: datastring,
                        dataType: 'text',
                        success: function (data) {
                          alert(data);
                        },
                        error: function () {
                            alert('error handing here');
                        }
                    });


                });
            });
        </script> 
    </head>
    <body>

        <form action="" id="reset_password_form">
            Email:<br>
            <input type="text" name="email_id" id="email_id" >

            <input type="submit" value="Submit">
        </form> 
        <input type="text" name="reset_password_code" id="reset_password_code"/><input type="button" name="reset_password_button" id="reset_password_button" value="Continu...."/>          <form action="" method="post" id="payuForm">
      <input type="hidden" name="key" value="xa6Hhr" />
      
      
      <table style="width: 100%;">
       
        <tr>
          <td><b>Amount in Rupees:</b> </td>
          <td><input type="text" name="amount" class="text_style" readonly value="1.00" /></td>
         </tr> 
          <tr>
          <td><b>First Name:</b> </td>
          <td><input type="text" name="firstname" id="firstname" /></td>
        
        <tr>
          <td><b>Email:</b> </td>
          <td><input type="text" name="email" id="email"  /></td>
         </tr>
         <tr>
          <td><b>Phone:</b> </td>
          <td><input type="text" name="phone"  /></td>
        </tr>
        <tr>
          <td><b>Product Info:</b> </td>
          <td colspan="3"><input type="text" class="text_style" name="productinfo" id="productinfo" readonly value="Sanskrit for Everyone"></td>
        </tr>
    
         
          <td colspan="3"><input type="hidden" name="surl" value="http://coolacharya.com/payumoney/success.php" size="64" /></td>
       

          <td colspan="3"><input type="hidden" name="furl" value="http://coolacharya.com/payumoney/failure.php" size="64" /></td>
    
          <td><input type="hidden" name="service_provider" value="payu_paisa"  /></td>
        

        
        <tr>
         
            <td align="center" colspan="4"><br/><input style="text-align: center; color: #ffffff;" class="btn btn-success" type="submit" value="Submit" /></td>
         
        </tr>
      </table>
    </form>

    </body>
</html>
