<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
    <script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_ui_1.9.1.js"></script> 
    <script>$( document ).ready(function() {
    $('#change_sequence_button').click(function(){
  var arr = [];var i=0;
$("#sequence_table tr").each(function(){i++;
    var b= {'sequence_no':i,'course_id':$(this).find("td:first").next().text()};
           
    arr.push(b);
});
for (i=1;i<arr.length;i++)
{
console.log(arr[i]);
}
   $.ajax({
                            type: "POST",
                            url: "../../admin_company/create_member",
                            data: datastring,
                            dataType: "text",
                            success: function (data) {
                                $('#register_form')[0].reset();
                                $("#status").show();
                            },
                            error: function () {
                                alert('error handing here');
                            }
                        });
});
});</script>
<style>
table.primary th
{
    border-bottom-width: 2px;
	border: 1px solid #ddd;
	padding: 5px;
	vertical-align: bottom;
    border-bottom: 2px solid #ddd;
	text-align: left;
	font-weight: bold;
	display: table-cell;
	border-spacing: 2px;
    border-color: grey;
	background-color: #ffffff;
}

table.primary td
{
	border: 1px solid #ddd;   
    border-top: 1px solid #ddd;
}

table.primary tr:nth-child(odd) {
    background-color: #fafafa;
	
	
}
table.primary tr:nth-child(even) {
    background-color: #ffffff;

}
.deactivate{
    background-color: #ffc;
}

</style>

   <div id="content">
	<div class="container">
				<div class="row">
				<br/>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h2>Course List</h2>
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
			
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
			
			echo '<div class="col-md-1" id="col-md-dp">';
              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control"');
			echo '</div>';
              echo form_submit($data_submit);
			echo '</div>';
            echo form_close();
            ?>	
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->		
				</div> <!-- /.row -->		
				<!-- /Statboxes -->
				<!--=== Normal ===-->
				<div class="row">
					<div class="col-md-12">												
		<?php	
	//echo ($sessionuserdata[0]['space_filled']);
	$planid_currentuser=$this->session->userdata['userplan_id'];
		
	//if($planid_currentuser!=='1')
	{

		if($sessionuserdata[0]['available_disk_space'] !==0)
		{
?>	  
    <a  href="<?php echo site_url("admin_company").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary">Add New</a> <?php
		}
	}
?> 
<?php
		      //flash messages
		      if($this->session->flashdata('flash_message'))
			  {
		        if($this->session->flashdata('flash_message') == 'Activate')
		        {
		          echo '<div class="alert alert-success">';
		            echo '<a class="close" data-dismiss="alert">�</a>';
		            echo '<strong>Well done!!</strong> Courses Activate with success now its not to assign anyone.';
		          echo '</div>';       
		        }
				elseif($this->session->flashdata('flash_message') == 'Retired')
		        {
		          echo '<div class="alert alert-success">';
		            echo '<a class="close" data-dismiss="alert">�</a>';
		            echo '<strong>Well done!!</strong> Courses Retired with success now its not to assign anyone.';
		          echo '</div>';       
		        }
				else{
		          echo '<div class="alert alert-danger">';
		            echo '<a class="close" data-dismiss="alert">�</a>';
		            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
		          echo '</div>';          
		        }				
		      }
		    ?>  
			<br/>
<ul class="page-stats">
						<li>
							<div class="summary">
								<span>Total Disk SPace</span>
								<h3 class="numbers"><?php echo $totaldiskspace; ?></h3>
							</div>
							
							<!-- Use instead of sparkline e.g. this:
							<div class="graph circular-chart" data-percent="73">73%</div>
							-->
						</li>
						<li>
							<div class="summary">
								<span>Available Disk SPace</span>
								<h3 class="numbers"><?php echo $remainspace; ?></h3>
							</div>
							
						</li>
					</ul>
					<!-- /Page Stats -->
				</div>
				<br/><br/><br/>
				  
						<p>&nbsp;</p>
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View All Courses</h4>								
							</div>
							<div class="widget-content">
		
        <div class="res_table">
            <div class="res_table-head" >
           <div class="column" data-label="Sr no">Sr no</div>
           <div class="column" data-label="Course name">Course name</div>
           <div class="column" data-label="Course subtitle">Course Sub Title</div>
           <div class="column" data-label="Course Validity">Validity</div>
           <div class="column" data-label="Course price">Price</div>
           <div class="column" data-label="action">Action</div>
            </div>
            <div id="tbody">
            	
              <?php
              foreach($courses as $row)
              {
				echo '<div class="res_row primary">';
				if($row['IsActive']== "N")
				{
					$clstr='deactivate';
				}
				else
				{
					$clstr='';
				}
				
				{
	                
	                echo '<div class="column '.$clstr.'" data-label="Sr no">'.$row['id'].'</div>';
	                echo '<div class="column '.$clstr.'" data-label="Course name">'.$row['course_name'].'</div>';
					echo '<div class="column '.$clstr.'" data-label="Course subtitle">'.$row['course_subtitle'].'</div>';
					echo '<div class="column '.$clstr.'" data-label="Course Validity">'.$row['course_validity'].'</div>';				
					echo '<div class="column '.$clstr.'" data-label="Course price">'.$row['course_price'].'</div>';					

					if($row['IsActive']== "N")
					{
						echo '<div class="column '.$clstr.'" data-label="action">
	                  <a href="'.site_url("admin_company").'/courses/update/'.$row['id'].'" class="btn" onclick="return false;">view & edit</a> &nbsp;&nbsp;';  
						echo '<a href="'.site_url("admin_company").'/courses/activate/'.$row['id'].'" class="btn btn-primary">Active Course</a></div>'; 						
					}
					else
					{
						echo '<div class="column '.$clstr.'" data-label="action">
	                  <a href="'.site_url("admin_company").'/courses/update/'.$row['id'].'" class="btn btn-info" >view & edit</a> &nbsp;&nbsp;';  
						echo '<a href="'.site_url("admin_company").'/courses/delete/'.$row['id'].'" class="btn btn-warning">Retire Course</a></div>';  
					} 	               
	                echo '</div>';
				}
				
              }
              ?> </div> </div>     
        </div >
                                                            <div class="container text-center">
     
     <table id="sequence_table" class="table table-bordered pagin-table">
        <thead>  
            <tr class="row_header">
                <th class="text-center" width="50px">No</th>
                <th class="text-center">Course Id</th>
                <th class="text-center">Course Name</th>
                 <th class="text-center">SubCategory</th>
                <th class="text-center">Course by</th>
                <th class="text-center">Start Date</th>
                <th class="text-center">End Date</th>
                <th class="text-center" width="220px">Action</th>
            </tr>
        </thead>
        <tbody><?php $i=0; foreach($courses as $row){
          echo  '<tr>';$i++;
            echo   '<td>'.$i.'</td>';  echo   '<td>'.$row['id'].'</td>';
         echo'   <td>'.$row['course_name'].'</td>';
         echo'   <td>'.$row['subcategory_name'].'</td>';
            echo'  <td>'.$row['course _by'].'</td>';
            $start_date = new DateTime($row['start_date']);
            
            echo'  <td>'.$start_date->format('d-m-Y').'</td>';
            $end_date = new DateTime($row['end_date']);
            echo'  <td>'.$end_date->format('d-m-Y').'</td>';
          echo ' <td><a href="'.site_url("admin_company").'/courses/activate/'.$row['id'].'" ><img src="../assets/assets/img/View_Icon.png" width="25" /></a>	&nbsp
              
           <a href="'.site_url("admin_company").'/courses/update/'.$row['id'].'" ><img src="../assets/assets/img/Edit_Icon.png" width="25" /></a>	&nbsp
          <a href="'.site_url("admin_company").'/courses/delete/'.$row['id'].'" ><img src="../assets/assets/img/delete_Icon.png" width="25" /></a>	&nbsp</tr>';
        }  ?>
            
        </tbody>
    </table>
     <input type="button" id="change_sequence_button" value="change sequence">
</div>	<script type="text/javascript">
  $('tbody').sortable();
</script>

      
		
<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

							</div>
						
						</div>
						
					</div>
				</div>
				<!-- /Normal -->
	</div>
				</div>		