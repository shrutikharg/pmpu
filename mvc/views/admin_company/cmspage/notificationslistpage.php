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
								<h2>Notification List</h2>
							</div>
							</div> <!-- /.widget .box -->
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->		
				</div> <!-- /.row -->		
				<!-- /Statboxes -->
				
				
				<!--=== Page Content ===-->
				<!--=== Statboxes ===-->		
				
				<!--=== Normal ===-->
				<div class="row">
					<div class="col-md-12">	
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>View Notification list</h4>								
							</div>
							
			<div class="res_table">
		<div class="res_table-head">           
           <div class="column" data-label="Emailid">id</div>
		   <div class="column" data-label="contactno">Title</div>
		   <div class="column" data-label="cmspagelink1">Notification</div>		   
           <div class="column" data-label="cmspagelink2">Notification_On</div>
       </div> 
              <?php
			  //var_dump($cmspage);
              foreach($cmspage as $row)
              {
                echo '<div class="res_row primary">';
				if($row['IsRead']== "N")
				{
					$clstr='deactivate';
				}
				else
				{
					$clstr='';
				}	
				
    echo '<div class="column '.$clstr.'" data-label="Emailid">'.$row['Notification_Id'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="Emailid">'.$row['Notification_Title'].'</div>';
	echo '<div class="column '.$clstr.'" data-label="cmspagelink1">'.$row['Notification_Message'].'</div>';  
		echo '<div class="column '.$clstr.'" data-label="cmspagelink2">'.$row['Notification_On'].'</div>'; 	 
                echo '</div>';
              }
              ?> 
			</div>  
    <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

							</div>
						
						</div>
						
					</div>
				</div>
				<!-- /Normal -->
	</div>
				</div>		