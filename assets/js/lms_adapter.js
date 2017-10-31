$(document).ready(function(){window.name="SHRUTI";alert();
                  $('#player1').attr('src',"http://localhost/companyadminapp1/assets/chapter_documents/61/39/51/course/index_lms.html");
       // var person = new Object();
        window.API=new Object();//Here API Adapter  object is created for his window
         window.API.LMSInitialize = function(){alert("LMSInitialize");
             return true;
         }
         window.API.LMSGetValue = function(stringVal){alert("LMSGetValue ------"+stringVal);
       $.ajax( 'Test.php/getParam', {
  type: 'POST',
  
  data:{stringVal1:stringVal,functionName:'getParam'},
  success: function( resp ) {
    
  },
  error: function( req, status, err ) {
    console.log( 'something went wrong', status, err );
  }
});        
         }
         window.API.LMSSetValue = function(data_model_element,value)
         {
             alert("LMSSetValue ------"+data_model_element+"--->"+value);
           return true;
           
             
         } 
         window.API.LMSCommit = function(){alert("lmscommit");
             return true;
         }
         window.API.LMSGetLastError=function(){alert("LMSGetLastError");
             return "NO_ERROR";
         }
        var api=SCORMRuntimeAPIInstance(window);//check whether API OBJECT IS AVILABLE FOR IFRAME
    // $('#player1').attr('src','course/index_lms.html');
     $("#button").click(function(){
     
     });