$(document).ready(function () {
$('#name').keyup(function(e) {
    var subcategory_name = $('#name').val(); // assuming this is a input text field
    if(subcategory_name.length>=2){
    $.post('../subcategory/search_by_name', {'name' : subcategory_name}, function(data) {
       if(Number(data)>0){
         alert('already availavble');  
       }
    });
    }
    else{
        exit;
    }
});    
});