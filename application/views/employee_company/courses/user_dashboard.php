
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    var course_status_count = [
        ['Status', 'Count'],
        ['Completed Courses',<?php echo $course_status_data->complete; ?>],
        ['Not Attempted Courses',<?php echo $course_status_data->not_attempted ?>],
        ['Courses in Progress',<?php echo $course_status_data->incomplete; ?>]

    ];
    google.charts.setOnLoadCallback(function () {
        var data = google.visualization.arrayToDataTable(course_status_count);
        var options = {
            title: 'Course Stats'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    });
    /* $(document).ready(function () {
      
     $.ajax({
     type: "POST",
     url: "../employee_company/get_user_courses_status",
      
     dataType: "json",
     success: function (data) {
     var user_course_status=JSON.parse(data[0].out_param);
      
      
      
     },
     error: function () {
     alert('error handing here1');
     }
     });
      
     });*/


    function drawChart(course_status_count) {

    }
</script>    
<style type="text/css">     
    .dash-box{
        width: 25%;      
        float:left;
        padding:10px!important
    }    
    .dash-content{
        background: #ffffff;
        text-align: center;
        padding:25px 0px;
    }
    .dash-box a {
        width:100%;                     
    }   
    .glyphicon-orange{
        color:#FF8040!important;
    }
    .glyphicon {
        font-size: 56px;                  
    }                  
    .glyphicon {
        font-size: 56px;                  
    }
</style>
<div id="content" Style="padding-top:30px; background:#e5ebf2;">            
    <div class="container">  
        <div class="col-xs-12 col-md-12 col-lg-12">
           
            <div class="dash-box col-md-4">
                <div class="dash-content">
                    <!--<span class="glyphicon glyphicon-bookmark"></span><br/>-->        
                    <span class="glyphicon" style="background-image: url('../assets/images/icons/task_completed.png');width: 72px; height: 72px;"></span><br/>
                </div>
                <a href="completed_course" class="btn btn-success btn-lg" role="button"> <?php echo $course_status_data->complete;?>-Courses Completed </a>
            </div>
            <div class="dash-box col-md-4">
                <div class="dash-content">
<!--                    <span class="glyphicon glyphicon-user glyphicon-orange "></span><br/>-->
                    <span class="glyphicon" style="background-image: url('../assets/images/icons/grouped_tasks.png');width: 72px; height: 72px;"></span><br/>
                </div>
                <a href="notattempted_course" class="btn btn-danger btn-lg" role="button"> <?php echo $course_status_data->not_attempted;?>-Courses Not Attempted </a>                                
            </div>
            <div class="dash-box col-md-4">
                <div class="dash-content">
                    <!--<span class="glyphicon glyphicon-signal glyphicon-info"></span><br/>-->                                                   <span class="glyphicon" style="background-image: url('../assets/images/icons/progress_bar.png');width: 72px; height: 72px;"></span><br/>   
                </div>
                <a href="incomplete_course" class="btn btn-warning btn-lg"  role="button"><?php echo $course_status_data->incomplete;?>-Courses In Progress</a>
            </div>

        </div> 
    </div>     
    <div class="container">             
        <div id="piechart" style="width: 100%; height: 500px;margin-top:50px; "></div>              
    </div>
</div>