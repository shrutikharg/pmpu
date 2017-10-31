<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
    <script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_ui_1.9.1.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/popupwindow.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/demo.js"></script>
	
<link href="<?php echo base_url(); ?>assets/themes/popupwindow.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/themes/preview_demo.css" rel="stylesheet" type="text/css" />
	
    <script>$( document ).ready(function() {
    $('#change_sequence_button').click(function(){
  var arr = [];
$("#sequence_table tr").each(function(){
    arr.push($(this).find("td:first").text());
});
for (i=1;i<arr.length;i++)
{
alert(arr[i]);
}
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
.pop-up-content
{
padding: 0px !important;	
}

.pop-up.large{
    margin-left: -270px !important;
    max-width: 620px !important;
    top: 100px !important;
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
								<h2>Question Bank List</h2>
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
    <a  href="<?php echo site_url("admin_company").'/'.$this->uri->segment(2); ?>/add" ><img src="../assets/assets/img/Add Quesion Bank_1.png" width="180px" id="open-pop-up-3"></a> <?php
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
								<h4><i class="icon-reorder"></i>View All Question Banks</h4>								
							</div>
							<div class="widget-content">
		
           
        </div >
                                                            <div class="container text-center">
     
     <table id="sequence_table" class="table table-bordered pagin-table">
        <thead>
            <tr class="row_header">
                <th class="text-center" width="50px">No</th>
                <th class="text-center">Question Bank name</th>
                
                <th class="text-center" width="400px">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>1</td>
              <td>HR departement</td>
               
              <td><a href="" ><img src="../assets/assets/img/Add List_1.png" id="open-pop-up-1"  /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Add question_1.png"  id="open-pop-up-2"  /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/Delete_1.png"    /></a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>php quesions</td>
               
            <td><a href="" ><img src="../assets/assets/img/Add List_1.png"  /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Add question_1.png"   /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/Delete_1.png"  /></a>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>Java questions</td>
               
            <td><a href="" ><img src="../assets/assets/img/Add List_1.png"  /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Add question_1.png"   /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/Delete_1.png"   /></a>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>Html5 questions</td>
               
            <td><a href="" ><img src="../assets/assets/img/Add List_1.png" /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Add question_1.png"   /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/Delete_1.png"  /></a>
              </td>
            </tr>
            <tr>
              <td>5</td>
              <td>Html5 questions</td>
               
              <td><a href="" ><img src="../assets/assets/img/Add List_1.png"  /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Add question_1.png"   /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/Delete_1.png"   /></a>
              </td>
            </tr>
        </tbody>
    </table>
                                                                <div id="pop-up-2" class="pop-up-display-content">
                                                                <div class="question_popup_container">
                                                                	
                                                                <div class="question_header">	
                                                                
                                                                	<h3>Add list</h3>	
                                                                
                                                                
                                                               
     <!-- <input type="button" id="change_sequence_button" value="change sequence"> -->
</div>
<div class="question_body">
	<br/>

<div class="form-group">	
<div class="col-md-4" ><select name="order" class="form-control">
<option value="departement">Departement</option>
</select></div>
<div class="col-md-4" ><select name="order" class="form-control" id="col-md-dp">
<option value="departement">Difficulty level</option>
</select></div>
</div>
</div>	
<br/>
<br/>

<div class="form-group question_container">
<br/>	
<div class="col-md-12">
			
<input type="checkbox" name="vehicle" value="Bike" class="col-md-1">
										<label class="col-md-8 control-label control_lbl">What is photoshop? where it is used?</label>
										<div class="col-md-3">

								<a href="" ><img src="../assets/assets/img/Edit_1.png"   /></a>
<br/>	
</div>									</div>
</div>	
<br/>	
<div class="form-group question_container">	
	<br/>		
<div class="col-md-12">
								
<input type="checkbox" name="" value="" class="col-md-1">									
									
										<label class="col-md-8 control-label control_lbl">What is photoshop? where it is used?</label>
										<div class="col-md-3"><a href="" ><img src="../assets/assets/img/Edit_1.png"   /></a>
								
										</div>
</div>
</div>	
<br/>	
<div class="form-group question_container">								
<br/>										
										<label class="col-md-3 control-label"></label>
										
</div>										
								
										

<div class="question_bottom">
							
									
										<label class="col-md-3"><img src="../assets/assets/img/Save_1.png"  /></label>
										<div class="col-md-4" style="float: right !important;">
								
								<img src="../assets/assets/img/Reset.png"  />
										</div>
	
	
</div>								
<script type="text/javascript">
  $('tbody').sortable();
</script>

      
		
<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

							</div>	
                                                                <div id="pop-up-1" class="pop-up-display-content">	
                                                                <div class="question_popup_container">
                                                                	
                                                                <div class="question_header">	
                                                                
                                                                	<h3>Question list</h3>	
                                                                
                                                                
                                                               
    
</div>
<div class="question_body">
<br/>
<div class="form-group">

										<label class="col-md-3 control-label control_lbl">Question</label>
										<div class="col-md-7"><input type="text" class="form-control txt_input" id="" name="name"  data-rule-required="true" >
								
										</div>
</div>	
<br/><br/>
<div class="form-group">									
									
									
										<label class="col-md-3 control-label control_lbl">Answers</label>
										<div class="col-md-7"><input type="text" class="form-control txt_input" id="" name="name"  data-rule-required="true" >
								
										</div>
</div>
<br/>	<br/>
<div class="form-group">								
									
										<label class="col-md-3 control-label"></label>
										<div class="col-md-7">
								<img src="../assets/assets/img/Add_1.png"  />
								<img src="../assets/assets/img/Remove_1.png"  />
										</div>
</div>										
								
										
</div>	
<div class="question_bottom">
							
									
										<label class="col-md-3"><img src="../assets/assets/img/Save_1.png"  /></label>
										<div class="col-md-4" style="float: right !important;">
								
								<img src="../assets/assets/img/Remove_1.png"  />
										</div>
	
	
</div>								
<script type="text/javascript">
  $('tbody').sortable();
</script>

      
		
<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

						</div>
						</div>
						
						
						<div id="pop-up-3" class="pop-up-display-content">	
                                                                <div class="question_popup_container">
                                                                	
                                                                <div class="question_header">	
                                                                
                                                                	<h3>Add Question Bank</h3>	
                                                                
                                                                
                                                               
    
</div>
<div class="question_body">
<br/>
<div class="form-group">

										<label class="col-md-3 control-label control_lbl">Question Name</label>
										<div class="col-md-7"><input type="text" class="form-control txt_input" id="" name="name"  data-rule-required="true" >
								
										</div>
</div>	
<br/><br/>
<div class="form-group">									
									
									
										<label class="col-md-3 control-label control_lbl">Category</label>
										<div class="col-md-7"><select name="Category" class="form-control">
<option value="departement">Departement</option>
</select>
								
										</div>
</div>
<br/><br/>
<div class="form-group">									
									
									
										<label class="col-md-3 control-label control_lbl">Difficulty level</label>
										<div class="col-md-7"><select name="Difficulty level" class="form-control">
<option value="beginner">Beginner</option>
</select>
								
										</div>
</div>
<br/>	<br/>
									
								
										
</div>	
<div class="question_bottom">
							
									
										<label class="col-md-3"><img src="../assets/assets/img/Save_1.png"  /></label>
										<div class="col-md-4" style="float: right !important;">
								
								<img src="../assets/assets/img/Remove_1.png"  />
										</div>
	
	
</div>								
<script type="text/javascript">
  $('tbody').sortable();
</script>

      
		
<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

						</div>
						</div>
							</div>
						
						</div>
						
					</div>
				</div>
				<!-- /Normal -->
	</div>
				</div>		