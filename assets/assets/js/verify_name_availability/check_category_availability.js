$(document).ready(function () {
$('#name').keyup(function(e) {
    var category_name = $('#name').val(); // assuming this is a input text field
    if(category_name.length>=2){
    $.post('../category/search_by_name', {'name' : category_name}, function(data) {
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