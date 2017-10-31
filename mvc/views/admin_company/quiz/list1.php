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
.tabbable-custom.tabbable-full-width > .tab-content {
    border-left: none;
    border-right: none;
    border-bottom: none;
    padding: 20px !important;
    background: #00bfff;
    
    border-radius: 5px;
    color: #ffffff;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus
{
	
	color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #00bfff;
    border-bottom-color: transparent;
}
button {
  display: inline-block;
    margin: 0 10px 0 0;
    padding: 7px 23px;
    font-size: 20px;
    line-height: 1.4;
    vertical-align: bottom;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    font-weight: normal !important;
}
button:focus {
  outline: none
}
section.gradient button {
 color: #000000;
    text-shadow: -2px 2px #fffff;
   background:#ffffff;
   border: solid 1px #000000;
    
    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 8px;
}
section.gradient button:hover,
section.gradient button.hover {
  -webkit-box-shadow: inset 0 0 0 1px #27496d,0 5px 15px #193047;
  -moz-box-shadow: inset 0 0 0 1px #27496d,0 5px 15px #193047;
  box-shadow: inset 0 0 0 1px #27496d,0 5px 15px #193047;
  border: solid 2px #ffffff;
}
section.gradient button:active,
section.gradient button.active {
  -webkit-box-shadow: inset 0 0 0 1px #27496d,inset 0 5px 30px #193047;
  -moz-box-shadow: inset 0 0 0 1px #27496d,inset 0 5px 30px #193047;
  box-shadow: inset 0 0 0 1px #27496d,inset 0 5px 30px #193047;
   border: solid 2px #ffffff;
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

		if($sessionuserdata[0]['space_filled'] =='N')
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
						<div class="widget box2">
							
							<div class="widget-content">
		
           
        </div >
                                                            <div class="container text-center quiz_tab">
     
     <div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_elearning" data-toggle="tab">General</a></li>
								<li class=""><a href="#tab_overview" data-toggle="tab">Time</a></li>
								<li class=""><a href="#tab_ppt_pdf" data-toggle="tab">Question</a></li>
								
							</ul>
							<div class="tab-content row">
								<div class="tab-pane active" id="tab_elearning">
								
	<form action="" method="post" accept-charset="utf-8" class="form-horizontal" id="" enctype="multipart/form-data">							
										
	<div class="form-group">
										<label class="col-md-2 control-label">Name of the quiz</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
								
										</div>
	</div>
									
  
   								
   <div class="form-group">
										<label class="col-md-2 control-label">Description</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
								
										</div>
									</div>		
									
   
	<div class="form-group">
										<label class="col-md-2 control-label">Start Date</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
								
										</div>
	</div>	
	
									
									
									<div class="form-group">
										<label class="col-md-2 control-label">End Date</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name"  data-rule-required="true"  data-msg-required="Please enter course name." />
								
										</div>
									</div>
									
   
									<div class="form-group">
										<label class="col-md-2 control-label">Number of attempts</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
								
										</div>
									</div>

  </form>
  								
		
	
										</div> <!-- /.col-md-12 -->
								<!--=== Overview ===-->
								<div class="tab-pane " id="tab_overview">
								
									
										<form action="" method="post" accept-charset="utf-8" class="form-horizontal" id="" enctype="multipart/form-data">							
										
	<div class="form-group">
										<label class="col-md-2 control-label">Time allowed</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
								
										</div>
	</div>
									
  
   								
   <div class="form-group">
										<label class="col-md-2 control-label">Alarm</label>
										<div class="col-md-10"><input type="text" class="form-control" id="" name="name"   data-rule-required="true"  data-msg-required="Please enter course name." />
								
										</div>
									</div>		
									
   
		
	
									
									
								
									
   
									

  </form>
									
								</div>
								<!-- /Overview -->

								<!--=== Edit Account ===-->
								<div class="tab-pane" id="tab_ppt_pdf">
								
							
										
		
		<div class="col-md-2">
		<section class="gradient">
            
            <button>Add<br/> Question Bank</button>
           
        </section>		
		</div>
		<div class="col-md-2">
		<section class="gradient">
            
            <button>Add <br/>From List</button>
           
        </section>		
		</div>
		<div class="col-md-2">
		<section class="gradient">
            
            <button>Add <br/>Question</button>
           
        </section>		
		</div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	
										</div> <!-- /.col-md-12 -->
										
										
										</form>	

										
								<!-- /Edit Account -->
							</div> <!-- /.tab-content -->
						</div>
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
							


      
		
<?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

						</div>
						</div>
						
						
						<div id="pop-up-3" class="pop-up-display-content">	
                                                                <div class="question_popup_container">
                                                                	
                                                                <div class="question_header">	
                                                                
                                                                	<h3>Add Question Bank</h3>	
                                                                
                                                                
                                                               
    
</div>

							


      
		
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