    <section class="white-wrapper">
        <div class="container">
           
            <div class="contact_form">
                <div id="message"></div>
                <form id="contactform" action="contact" name="contactform" method="post" onsubmit="return checkform(this);">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name"> 
                        <input type="text" name="name" id="email" class="form-control" placeholder="Email Address"> 
                        <h3 style="margin-left:15px;"><font color="#DD0000"></font> 
			<span id="txtCaptchaDiv" style="background-color: #f58220;color:#FFF;padding:5px"></span>
			<input type="hidden" id="txtCaptcha" />
			<input type="text" name="txtInput" id="txtInput" class="form-control" size="15" placeholder="Enter Security Code" />
</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="name" id="subject" class="form-control" placeholder="Subject"> 
                        <textarea class="form-control" name="comments" id="comments" rows="6" placeholder="Message"></textarea>
                        <input type="submit" class="btn btn-warning" value="Submit"/>
			<!--<button type="button" class="btn btn-warning">Sign in</button>-->
                    </div>
                </form>    
            </div><!-- end contact-form -->
        </div><!-- end container -->
	</section><!-- end map wrapper -->

        <div class="clearfix"></div>
    
        <div class="clearfix"></div>

	<section id="one-parallax" class="parallax" style="background-image: url('<?php echo base_url(); ?>websitecontent/images/contact-back-img.jpg');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">
		<div class="overlay">
            <div class="container">
                <div class="row padding-top margin-top">
                    <div class="contact_details">
                        <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
                            <div class="text-center">
                                <div class="wow swing">
                                    <div class="contact-icon">
                                        <a href="#" class=""> <i class="fa fa-map-marker fa-3x fa-color"></i> </a>
                                    </div><!-- end dm-icon-effect-1 -->
                                     <p class="center">121 King Street, Melbourne Victoria 3000<br>
                                    United States of America, CA 90017</p>
                                </div><!-- end service-icon -->
                            </div><!-- end miniboxes -->
                        </div><!-- end col-lg-4 -->
                        
                        <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
                            <div class="text-center">
                                <div class="wow swing">
                                    <div class="contact-icon">
                                        <a href="#" class=""> <i class="fa fa-phone fa-3x fa-color"></i> </a>
                                    </div><!-- end dm-icon-effect-1 -->
                                     <p class="center"><strong>Mobile : </strong> (1005) 5999 4446<br>
                                    <strong>Phone : </strong> (0422) 5999 4446</p>
                                </div><!-- end service-icon -->
                            </div><!-- end miniboxes -->
                        </div><!-- end col-lg-4 -->  
        
                        <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
                            <div class="text-center">
                                <div class="wow swing">
                                    <div class="contact-icon">
                                        <a href="#" class=""> <i class="fa fa-envelope-o fa-3x fa-color"></i> </a>
                                    </div><!-- end dm-icon-effect-1 -->
                                     <p class="center"><strong>Email : </strong>info@kalyanimedicals.com<br>
                                    <strong>Skype : </strong> kalyanimedicals</p>
                                </div><!-- end service-icon -->
                            </div><!-- end miniboxes -->
                        </div><!-- end col-lg-4 -->                  
                    </div><!-- end contact_details -->
                </div><!-- end margin-top --><br><br>
            </div><!-- end container -->
        </div><!-- end overlay -->
    </section><!-- end map wrapper -->
  
<script type="text/javascript">
function checkform(theform){
var why = "";

if(theform.txtInput.value == ""){
why += "- Security code should not be empty.\n";
}
if(theform.txtInput.value != ""){
if(ValidCaptcha(theform.txtInput.value) == false){
why += "- Security code did not match.\n";
}
}
if(why != ""){
alert(why);
return false;
}
}

//Generates the captcha function
var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';

var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("txtCaptchaDiv").innerHTML = code;

// Validate the Entered input aganist the generated security code function
function ValidCaptcha(){
var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
var str2 = removeSpaces(document.getElementById('txtInput').value);
if (str1 == str2){
return true;
}else{
return false;
}
}

// Remove the spaces from the entered and generated code
function removeSpaces(string){
return string.split(' ').join('');
}
</script>
	