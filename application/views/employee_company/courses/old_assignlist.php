<div id="content">
	<div class="container">


      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("employee_company"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          Assigned <?php echo ucfirst($this->uri->segment(2));?>
    
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
            <?php
		      //flash messages
		      if($this->session->flashdata('flash_message')){
		        if($this->session->flashdata('flash_message') == 'Retired')
		        {
		          echo '<div class="alert alert-success">';
		            echo '<a class="close" data-dismiss="alert">×</a>';
		            echo '<strong>Well done!!</strong> Courses Retired with success now its not to assign anyone.';
		          echo '</div>';       
		        }else{
		          echo '<div class="alert alert-error">';
		            echo '<a class="close" data-dismiss="alert">×</a>';
		            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
		          echo '</div>';          
		        }
		      }
		    ?>  
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter       
/*	    
            $options_category = array();    
            foreach ($category as $array) {
              foreach ($array as $key => $value) {
                $options_category[$key] = $key;
              }
              break;
            }
	    */
		  $options_category = array('course_name'=>'Course Name'); 
		  
            echo form_open('employee_company/courses', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected);

              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_category, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

         
		  <div class="row">
 <?php
			  //var_dump($courses);
              foreach($courses as $row)
              {
?>
<div class="col-md-12">
<div class="widget box">
<div class="widget-header">
<h4><i class="icon-reorder"></i><?php echo $row['course_name']; ?></h4>
</div>
<div class="widget-content">

<div class="row">
<div class="col-md-6">
                                   	<img src="http://coolacharya.com/images/CourseImages/xsanskritforeveryone.jpg.pagespeed.ic.-bdXMq3z4E.jpg" pagespeed_url_hash="894689113"><br><br>
<div class="well">
<span class="show text-16 textb">Price</span> 
                                       <span class="sitedc text-40">Total courseprice  <?php echo '&nbsp'.$row['course_price']; ?> rs/-</span>
                                       <!--<span class="sitedc text-40">  / <span style="font-family:rupee;">R</span>12444.00</span>-->
                <?php
		echo '<a href="'.site_url("employee_company").'/courses/satartcourse/'.$row['courseid'].'" class="btn btn-success btn-block">Start Your Course Now </a>';  ?>
<!--<a href="../course?course=12" class="btn btn-success btn-block">Start Your Course Now</a>--><br>

<?php
	echo '<a href="'.site_url("employee_company").'/topiclist/'.$row['courseid'].'" class="btn btn-success btn-block">View All Topics </a>'; ?>
	
<!--<a href="course_topics?course=12" class="btn btn-success btn-block">View All Topics</a>--><br>
<!---<button class="btn btn-sm dropdown-toggle" data-toggle="dropdown" onclick="showStream('http://www.coolacharya.com/course?course=12','http://www.coolacharya.com/images/CourseImages/sanskritforeveryone.jpg','Course By: Minal Avachat','Sanskrit for Everyone');"><i class="icol-clipboard-text"></i> Share This Course</button>--->
</div> <!-- /.well -->	
</div> <!-- /.col-md-6 -->

</div> <!-- /.row -->
</div> <!-- /.widget-content -->
</div> <!-- /.widget .box -->

</div> <!-- /.col-md-12 -->
<?php
}
?>
</div>
	