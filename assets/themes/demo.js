jQuery(document).ready(function ($) {
    //basic pop-up
   $.noConflict(true);
    
   $('#theme_logo').change( function(event) {
   	//alert("change");
    $("#logo").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
    $("#new_logo").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
}); 
    
    $('#open-pop-up-1').click(function(e) {
    	//alert($('input:radio[name=color]:checked').val()); 
if(parseInt($('input:radio[name=color]:checked').val())=="4")
   {
   	$('#navbar2').addClass('navbar2_red');
   	$('#navbar2').removeClass('navbar2_orange');
$('#navbar2').removeClass('navbar2');
$('#navbar2').removeClass('navbar2_blue');
$('#navbar2').removeClass('navbar2_green');
$('#footer2').addClass('footer2_red');
$('#footer2').removeClass('footer2');
$('#footer2').removeClass('footer2_green');
$('#footer2').removeClass('footer2_blue');
$('#footer2').removeClass('footer2_orange');
$('#sidebar2').addClass('sidebar2_red');

$('#sidebar2').removeClass('sidebar2');
$('#sidebar2').removeClass('sidebar2_orange');
$('#sidebar2').removeClass('sidebar2_blue');
$('#sidebar2').removeClass('sidebar2_green');
$('#btn-primary2').addClass('btn-primary2_red');
$('#btn-primary2').removeClass('btn-primary2');
$('#btn-primary2').removeClass('btn-primary2_orange');
$('#btn-primary2').removeClass('btn-primary2_blue');
$('#btn-primary2').removeClass('btn-primary2_green');
$('#btn').addClass('btn_red');
$('#btn').removeClass('btn');
$('#btn').removeClass('btn_orange');
$('#btn').removeClass('btn_blue');
$('#btn').removeClass('btn_green');
$('input:radio[name=color_preview][value=red]').attr('checked', true);
 var l1=$('#link1').text();

$('#preview_link1').text(l1);

var l2=$('#link2').text();

$('#preview_link2').text(l2);

var l3=$('#link3').text();

$('#preview_link3').text(l3);

var contact_no=$('#contact_no').text();

$('#preview_contact_no').text(contact_no);

var username=$('#username').text();

$('#preview_username').text(username);

var contactemail=$('#contact_email').text();

$('#preview_contact_email').text(contactemail);
   	  	
   }
       	 
   else if(parseInt($('input:radio[name=color]:checked').val())=="1")
   {
   	$('#navbar2').addClass('navbar2_orange');
$('#navbar2').removeClass('navbar2');
$('#navbar2').removeClass('navbar2_red');
$('#navbar2').removeClass('navbar2_blue');
$('#navbar2').removeClass('navbar2_green');
$('#footer2').addClass('footer2_orange');
$('#footer2').removeClass('footer2');
$('#footer2').removeClass('footer2_red');
$('#footer2').removeClass('footer2_green');
$('#footer2').removeClass('footer2_blue');
$('#sidebar2').addClass('sidebar2_orange');
$('#sidebar2').removeClass('sidebar2');
$('#sidebar2').removeClass('sidebar2_green');
$('#sidebar2').removeClass('sidebar2_blue');
$('#btn-primary2').addClass('btn-primary2_orange');
$('#btn-primary2').removeClass('btn-primary2');
$('#btn-primary2').removeClass('btn-primary2_red');
$('#btn-primary2').removeClass('btn-primary2_blue');
$('#btn-primary2').removeClass('btn-primary2_green');
$('#btn').addClass('btn_orange');
$('#btn').removeClass('btn');
$('#btn').removeClass('btn_red');
$('#btn').removeClass('btn_blue');
$('#btn').removeClass('btn_green');
$('input:radio[name=color_preview][value=orange]').attr('checked', true);
 var l1=$('#link1').text();
//alert(l1);
$('#preview_link1').text(l1);

var l2=$('#link2').text();

$('#preview_link2').text(l2);

var l3=$('#link3').text();

$('#preview_link3').text(l3);

var contact_no=$('#contact_no').text();

$('#preview_contact_no').text(contact_no);

var username=$('#username').text();

$('#preview_username').text(username);

 var contactemail=$('#contact_email').text();

$('#preview_contact_email').text(contactemail);  	  	
   } 	 
   else if(parseInt($('input:radio[name=color]:checked').val())=="2")
   {
   	$('#navbar2').addClass('navbar2_blue');
$('#navbar2').removeClass('navbar2');
$('#navbar2').removeClass('navbar2_red');
$('#navbar2').removeClass('navbar2_orange');
$('#navbar2').removeClass('navbar2_green');
$('#footer2').addClass('footer2_blue');
$('#footer2').removeClass('footer2');
$('#footer2').removeClass('footer2_red');
$('#footer2').removeClass('footer2_orange');
$('#footer2').removeClass('footer2_green');
$('#sidebar2').addClass('sidebar2_blue');
$('#sidebar2').removeClass('sidebar2');
$('#sidebar2').removeClass('sidebar2_red');
$('#sidebar2').removeClass('sidebar2_orange');
$('#sidebar2').removeClass('sidebar2_green');
$('#btn-primary2').addClass('btn-primary2_blue');
$('#btn-primary2').removeClass('btn-primary2_red');
$('#btn-primary2').removeClass('btn-primary2_orange');
$('#btn-primary2').removeClass('btn-primary2');
$('#btn-primary2').removeClass('btn-primary2_green');

$('#btn').addClass('btn_blue');
$('#btn').removeClass('btn');
$('#btn').removeClass('btn_red');
$('#btn').removeClass('btn_green');
$('input:radio[name=color_preview][value=blue]').attr('checked', true);
 var l1=$('#link1').text();

$('#preview_link1').text(l1);

var l2=$('#link2').text();

$('#preview_link2').text(l2);

var l3=$('#link3').text();

$('#preview_link3').text(l3);

var contact_no=$('#contact_no').text();

$('#preview_contact_no').text(contact_no);

var username=$('#username').text();

$('#preview_username').text(username);
 
var contactemail=$('#contact_email').text();

$('#preview_contact_email').text(contactemail); 
   }
  else if(parseInt($('input:radio[name=color]:checked').val())=="3")
  {
  	$('#navbar2').addClass('navbar2_green');
$('#navbar2').removeClass('navbar2');
$('#navbar2').removeClass('navbar2_red');
$('#navbar2').removeClass('navbar2_orange');
$('#navbar2').removeClass('navbar2_blue');
$('#footer2').addClass('footer2_green');
$('#footer2').removeClass('footer2_blue');
$('#footer2').removeClass('footer2');
$('#sidebar2').addClass('sidebar2_green');
$('#sidebar2').removeClass('sidebar2');
$('#sidebar2').removeClass('sidebar2_red');
$('#sidebar2').removeClass('sidebar2_orange');
$('#sidebar2').removeClass('sidebar_blue');

$('#btn-primary2').addClass('btn-primary2_green');

$('#btn-primary2').removeClass('btn-primary2');
$('#btn-primary2').removeClass('btn-primary2_red');
$('#btn-primary2').removeClass('btn-primary2_blue');

$('#btn').addClass('btn_green');
$('#btn').removeClass('btn');
$('#btn').removeClass('btn_red');
$('#btn').removeClass('btn_orange');
$('#btn').removeClass('btn_blue');
$('input:radio[name=color_preview][value=green]').attr('checked', true);
  var l1=$('#link1').text();

$('#preview_link1').text(l1);

var l2=$('#link2').text();

$('#preview_link2').text(l2);

var l3=$('#link3').text();

$('#preview_link3').text(l3);

var contact_no=$('#contact_no').text();

$('#preview_contact_no').text(contact_no);

var username=$('#username').text();

$('#preview_username').text(username);

var contactemail=$('#contact_email').text();

$('#preview_contact_email').text(contactemail);
   		
  } 
        e.preventDefault();
        $('#pop-up-1').popUpWindow({action: "open"});
        //alert($('#pop-up-1').val());
        
        
        //alert("click");
    });

    //Buttons pop-up


    //Custom buttons popup
    $('#open-pop-up-3').click(function (e) {
        e.preventDefault();
        $('#pop-up-3').popUpWindow({
            action: "open",
            buttons: [{
                text: "Yes",
                cssClass: "btn-yes",
                click: function () {
                    this.close();
                }
            }, {
                text: "No",
                cssClass: "btn-no",
                click: function () {
                    this.close();
                }
            }]
        });
    });

    //On close callback
    $('#open-pop-up-4').click(function (e) {
        e.preventDefault();
        $('#pop-up-4').popUpWindow({
            action: "open",
            onClose: function(){
                alert('Window Closed');
            }
        });
    });

    //advanced modal popup
    $('#open-pop-up-5').click(function (e) {
        e.preventDefault();
        $('#pop-up-5').popUpWindow({
            action: "open",
            modal: true,
            onClose: function () {
                alert('Window Closed');
            },
            buttons: [{
                text: "Yes",
                click: function () {
                    alert('Yes clicked');
                    this.close();
                }
            }]
        });
    });

    //small size popup
    $('#open-pop-up-6').click(function (e) {
        e.preventDefault();
        $('#pop-up-6').popUpWindow({
            action: "open",
            size: "small"
        });
    });

    //medium size popup
    $('#open-pop-up-7').click(function (e) {
        e.preventDefault();
        $('#pop-up-7').popUpWindow({
            action: "open",
            size: "medium"
        });
    });
});
function get_popup2(){
    	
        
        $('#pop-up-2').popUpWindow({
            action: "open",
            buttons: [{
                text: "Yes",
                click: function () {
                    this.close();
                }
            }, {
                text: "No",
                click: function () {
                    this.close();
                }
            }]
        });
    }