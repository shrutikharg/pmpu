<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
    <script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_ui_1.9.1.js"></script> 
    <script>$( document ).ready(function() {
    $('#change_sequence_button').click(function(){
  var arr = [];
$("#sequence_table tr").each(function(){
    arr.push($(this).find("td:first").attr("id"));
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
table.primary tr.deactivate{
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
								<h2>Chapters List</h2>
							</div>
							<div class="widget-content">
								 <?php
           
            $attributes = array('class' => 'form-horizontal row-border', 'id' => 'myform');        
			    
			  $options_category = array('name'=>'Chapter Name'); 
		  
            echo form_open('admin_company/chapters', $attributes);
			
			echo '<div class="form-group">';
			echo '<label class="col-md-1   control-label">Search:</label>';
			
			echo '<div class="col-md-3">';			  
			  $data_search = array(
              'name'        => 'search_string',
              'id'          => 'search_string',              
              'class'       => 'form-control',
			  'placeholder' => 'Enter Chapter name',
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
	if($sessionuserdata[0]['available_disk_space'] !==0)
	{
?>	  
    <a  href="<?php echo site_url("admin_company").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary">Add a new</a> <?php
}
?> 

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
				
				<?php		     
			      if(isset($flash_message)){
			        if($flash_message == TRUE)
			        {
			          echo '<div class="alert alert-success">';
			            echo '<a class="close" data-dismiss="alert">�</a>';
			        echo '<strong>Well done!</strong>Your chapter Deleted with success.';
			          echo '</div>';       
			        }else{
			          echo '<div class="alert alert-danger">';
			            echo '<a class="close" data-dismiss="alert">�</a>';
			            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
			          echo '</div>';          
			        }
			      }			      
		    ?>  
						<p>&nbsp;</p>
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View All Chapters</h4>								
							</div>

	<div class="res_table">
		<div class="res_table-head">
           <div class="column" data-label="Sr no"> Sr no</div>
           <div class="column" data-label="Course name"> Course name</div>
           <div class="column" data-label="Course price"> Course Price</div>
           <div class="column" data-label="Chapter name"> Chapter name</div>
           <div class="column" data-label="Chapter thumbanil"> Chapter thumbanil</div>
		   <div class="column" data-label="Course status"> Course status</div>
           <div class="column" data-label="action">Action</div>
       </div>     
           
              <?php
			  //var_dump($chapters);
              foreach($chapters as $row)
              {
			    echo '<div class="res_row">';  
				$chapters[''][''];				
				if($row['chapterstatus'] == "N")
				{
					$clstr='deactivate';
				}
				else
				{
					$clstr='';
				}
					$chapid=$row['chapterid'];
				{
	           
	echo '<div class="column '.$clstr.'" data-label="Sr no">'.$row['chapterid'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Course name">'.$row['coursename'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Course price">'.$row['courseprice'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Chapter name">'.$row['chaptername'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Chapter thumbanil">'.$row['chaptervideo'].'</div>';					
echo '<div class="column '.$clstr.'" data-label="Course status">'.$row['chapterstatus'].'</div>';
echo '<div class="column '.$clstr.'" data-label="action">
	                  <a href="'.site_url("admin_company").'/chapters/update/'.$row['chapterid'].'" class="btn" onclick="return false;">view & edit</a>';  
						echo '<a href="'.site_url("admin_company").'/chapters/delete/'.$row['chapterid'].'" class="btn btn-primary">Delete chapter</a></div>'; 
					/*
					if($row['chapterstatus']== "N")
					{
						echo '<div class="column '.$clstr.'" data-label="action">
	                  <a href="'.site_url("admin_company").'/chapters/update/'.$row['chapterid'].'" class="btn" onclick="return false;">view & edit</a>';  
						echo '<a href="'.site_url("admin_company").'/chapters/activate/'.$row['chapterid'].'" class="btn btn-primary">Active chapter</a>'; 
						//echo '<a href="'.site_url("admin_company").'/chapters/activate/'.$row['chapterid'].'" class="btn btn-primary">Publish</a></div>';	
					}
					else
					{
						echo '<div class="column '.$clstr.'" data-label="action">
	                  <a href="'.site_url("admin_company").'/chapters/update/'.$row['chapterid'].'" class="btn btn-info" >view & edit</a>';  
						echo '<a href="'.site_url("admin_company").'/chapters/delete/'.$row['chapterid'].'" class="btn btn-warning">Delete chapter</a>';
						//echo '<a href="'.site_url("admin_company").'/chapters/activate/'.$row['chapterid'].'" class="btn btn-primary">Publish</a></div>';	
					} 	*/          
	                echo '</div>';
				}
				
              }
              ?>   
              </div> </div>     
        </div >    
           
       <div class="container text-center">
     
     <table id="sequence_table" class="table table-bordered pagin-table">
        <thead>
            <tr class="row_header">
                <th class="text-center">No</th>
                <th class="text-center">Chapter Name</th>
                <th class="text-center">Created by</th>
                <th class="text-center" width="220px">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td id="1"></td>
              <td>Principles of management</td>
               <td>demopaid@coolacharya.com</td>
              <td><a href="" ><img src="../assets/assets/img/View_Icon.png" width="25" /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Edit_Icon.png" width="25" /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/delete_Icon.png" width="25" /></a>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Financial Management</td>
               <td>demopaid@coolacharya.com</td>
             <td><a href="" ><img src="../assets/assets/img/View_Icon.png" width="25" /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Edit_Icon.png" width="25" /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/delete_Icon.png" width="25" /></a>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>sales training</td>
               <td>mangesh.d@mocelcamtechnologies.com</td>
             <td><a href="" ><img src="../assets/assets/img/View_Icon.png" width="25" /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Edit_Icon.png" width="25" /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/delete_Icon.png" width="25" /></a>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>hr training</td>
               <td>mangesh.d@mocelcamtechnologies.com</td>
             <td><a href="" ><img src="../assets/assets/img/View_Icon.png" width="25" /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Edit_Icon.png" width="25" /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/delete_Icon.png" width="25" /></a>
              </td>
            </tr>
            <tr>
              <td><img src="../assets/assets/img/Quiz.png" width="50"  /></td>
              <td>Wearing info quiz</td>
               <td>mangesh.d@mocelcamtechnologies.com</td>
             <td><a href="" ><img src="../assets/assets/img/View_Icon.png" width="25" /></a>
              	&nbsp;
              <a href="" ><img src="../assets/assets/img/Edit_Icon.png" width="25" /></a>	
              &nbsp;
              <a href="" ><img src="../assets/assets/img/delete_Icon.png" width="25" /></a>
              </td>
            </tr>
            
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