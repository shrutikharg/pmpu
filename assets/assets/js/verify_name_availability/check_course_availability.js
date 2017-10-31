$(document).ready(function () {
$('#name').keyup(function(e) {
    var course_name = $('#name').val(); // assuming this is a input text field
    if(course_name.length>=2){
    $.post('../courses/search_by_name', {'name' : course_name}, function(data) {
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