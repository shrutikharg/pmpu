      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script> 
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css" /> 



<div id="content">
	<div class="container">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin_company"); ?>">
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
          <?php echo ucfirst($this->uri->segment(2));?> 
		</h2>
    </div>
	  
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
    <fieldset>
<div class="widget-content">
<?php
        
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();
	  echo form_open('admin_company/graphreports', $attributes);
			
		echo '<div class="form-group">';
			echo '<label class="col-md-2   control-label">Date Range:</label>';
			
			echo '<div class="col-md-2">';
			echo '<p id="dateOnlyExample">';	
			  $data_search = array(
              'name'        => 'frmdate',
              'id'          => 'frmdate',              
              'class'       => 'date start',
			  'placeholder' => 'Select Date',
				);
			  echo form_input($data_search, $search_string_selected);
			  echo '</p>';
			echo '</div>';

			echo '<label  class="col-md-date control-label">TO</label>';
			
			echo '<div class="col-md-2">';
			echo '<p id="dateOnlyExample">';			
			  $data_end = array(
              'name'        => 'todate',
              'id'          => 'todate',              
              'class'       => 'date end',
			  'placeholder' => 'Select Date',
				);
			  echo form_input($data_end, $search_string_selected1);
			  echo '</p>';
			echo '</div>';
		echo '</div>';
		
		echo '<div class="form-group">';
			echo '<label class="col-md-2 control-label">Courses:</label>';
			
		echo '<div class="col-md-3">';
		 echo form_dropdown('courses', $listcourse,'class="form-control"');
	//echo form_dropdown('courses',$listcourse,'style="height:34px !important"');			 
			echo '</div>';
			
		echo '</div>';
?>		
</div>			
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Submit</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

    <?php 
	echo form_close(); 
	//dispdata

	//var_dump($dispdata);
	$mo = strtotime($_POST['frmdate']);
	$mo1 = strtotime($_POST['todate']);
	if(($mo !== false) && ($mo !== false))
	{
	
		if(count($dispdata)>0)
		{	
	?>
	<div class="row">
        <div class="span12 columns">  
			<?php
			    echo $this->gcharts->ColumnChart('Inventory')->outputInto('inventory_div');
			    echo $this->gcharts->div(770,750);

			    if($this->gcharts->hasErrors())
			    {
			        echo $this->gcharts->getErrors();
			    }
				//var_dump($courses);	
				
			?>
			</div>
        </div>
			
	</div>
	
<div class="row">
        <div class="span12 columns">
          <div class="well">
	<table class="table table-striped table-bordered table-hover table-checkable datatable">
            <thead>
              <tr >
                <th class="header">Sr.No</th>                
				<th class="yellow header headerSortDown">Acess Date</th>
				<th class="yellow header headerSortDown">Count Of Hits</th>
              </tr>
            </thead>
            <tbody>
              <?php
				$i=0;
				foreach($listdtils as $row)
              {
                echo '<tr>';
					echo '<td>'.$i.'</td>';	                
					echo '<td>'.$row['clickcourse_date'].'</td>';
					echo '<td>'.$row['cnt'].'</td>';
                echo '</tr>';
				$i++;
              }
              ?>      
            </tbody>
          </table>

      <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
		  </div>
		</div>
	</div>
 </div>
</div>
<?php
	}
	else
	{
		echo '<div class="alert alert-danger">No Data for that Date Or Course Please Try With Other <a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>';
		
	}

}
	
?>	
            <script>
                $('#dateOnlyExample .date').datepicker({
                    'format': 'yyyy-m-d',
                    'autoclose': true
                });

                var dateOnlyExampleEl = document.getElementById('dateOnlyExample');
                var dateOnlyDatepair = new Datepair(dateOnlyExampleEl);
            </script>        

            <script>
                // initialize input widgets
                // ptTimeSelect doesn't trigger change event by default
                $('#alternateUiWidgetsExample .time').ptTimeSelect({
                    'onClose': function($self) {
                        $self.trigger('change');
                    }
                });

                
            </script>
		</div>
      </div>
	