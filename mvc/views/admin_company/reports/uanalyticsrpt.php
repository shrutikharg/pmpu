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

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Name</th>				
				<th class="yellow header headerSortDown">Browser</th>
				<th class="yellow header headerSortDown">platform</th>
				<th class="yellow header headerSortDown">IP Address</th>
				<th class="yellow header headerSortDown">Location</th>
				<th class="yellow header headerSortDown">Postal Code</th>
				<th class="yellow header headerSortDown">Acess Date</th>
				<th class="yellow header headerSortDown">Course Name</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($users as $row)
              {
				$acessDate = date("d-M-Y", strtotime($row['clickcourse_date']));
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['created_by'].'</td>';
				echo '<td>'.$row['user_browser'].' '.$row['version_browser'].'</td>';
                echo '<td>'.$row['platform'].'</td>';
				echo '<td>'.$row['ip_addr'].'</td>';
                echo '<td>'.$row['city'].','.$row['region'].', '.$row['country'].'</td>';
				echo '<td>'.$row['postalcode'].'</td>';
				echo '<td>'.$acessDate.'</td>';
				echo '<td>'.$row['course_name'].'</td>';				
                echo '</tr>';
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