   <div id="content">
	<div class="container">
				<div class="row">
				<br/>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h2>Course Assignment List</h2>
							</div>
							<div class="widget-content">
						 <?php
           
            $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');        
			    
			 $options_category = array('course_name'=>'Course Name'); 
		  
            echo form_open('admin_company/courses', $attributes);
			
			echo '<div class="form-group">';
			echo '<label class="col-md-1   control-label">Search:</label>';
			
			echo '<div class="col-md-3">';			  
			  $data_search = array(
              'name'        => 'search_string',
              'id'          => 'search_string',              
              'class'       => 'form-control',
			  'placeholder' => 'Enter Course name',
				);
			  echo form_input($data_search, $search_string_selected);
			echo '</div>';
			
			echo '<label class="col-md-2   control-label">Order by:</label>';			
            //echo form_input('search_string', $search_string_selected);
			echo '<div class="col-md-2" id="col-md-dp">';
            echo form_dropdown('order', $options_category, $order, 'class="form-control"');
			echo '</div>';
			echo '<div class="col-md-12">';
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
			echo '</div>';
			echo '<div class="col-md-1" id="col-md-dp">';
              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control"');
			echo '</div>';
              echo form_submit($data_submit);
			echo '</div>';
            echo form_close();
            ?>	
								
<!--				
<a onclick="javascript:checkAll('form3', true);" href="javascript:void();">check all</a>
<a onclick="javascript:checkAll('form3', false);" href="javascript:void();">uncheck all</a>-->

								
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->		
				</div> <!-- /.row -->		
				<!-- /Statboxes -->
				<!--=== Normal ===-->
			
						<p>&nbsp;</p>
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View All Course Assignment</h4>								
							</div>
							
								<form style="margin: 0px !important;" name="form3" action="<?php echo site_url("admin_company").'/'.'coursesassign'; ?>/assignall" method="POST">
	<?php
/*echo '<td class="crud-actions">
                  <a href="'.site_url("admin_company").'/coursesassign/assignall/" class="btn btn-info">Assign All Course</a></td>';  
                echo '</tr>'; */
				
				//echo form_submit($data_submit);
	?>
          <div class="res_table">
		<div class="res_table-head">
           <div class="column" data-label="Sr no">Sr no</div>
           <div class="column" data-label="Course name">Course name</div>
           <div class="column" data-label="Course subtitle">Course Sub Title</div>
           <div class="column" data-label="Course Validity">Validity</div>
           <div class="column" data-label="Course price">Price</div>
           <div class="column" data-label="action">Action</div>
       </div>            
            
              <?php
              foreach($courses as $row)
              {
    echo '<div class="res_row">';
//echo '<td><input type="checkbox" name="assign_course[]" value="'.$row['id'].'"></td>';  
//echo '<td><input type="checkbox" name="assign_course[]" value="'.$row['id'].'"></td>';  
echo '<div class="column" data-label="Sr no">'.$row['id'].'</div>';
echo '<div class="column" data-label="Course name">'.$row['course_name'].'</div>';
echo '<div class="column" data-label="Course subtitle">'.$row['course_subtitle'].'</div>';
echo '<div class="column" data-label="Course Validity">'.$row['course_validity'].'</div>';
echo '<div class="column" data-label="Course price">'.$row['course_price'].'</div>';	
echo '<div class="column" data-label="action">'.'<a href="'.site_url("admin_company").'/coursesassign/update/'.$row['id'].'" class="btn btn-info">Assign Course</a>'.'</div>';		echo '</div>';		

              }
              ?>   
    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
		  </div>
    
    </div>
	
<script type="text/javascript" language="javascript">// <![CDATA[
function checkAll(formname, checktoggle)
{
  var checkboxes = new Array(); 
  checkboxes = document[formname].getElementsByTagName('input');
 
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   {
      checkboxes[i].checked = checktoggle;
    }
  }
}
// ]]></script>
</form>
							</div>
						</div>
						
					</div>
				</div>
				<!-- /Normal -->
	</div>
				</div>
