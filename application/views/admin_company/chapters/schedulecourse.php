<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/simplecalendar.js"></script>

<link href="<?php echo base_url(); ?>assets/assets/css/style-personal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">jQuery.noConflict();</script>
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
          Course Schedules     
        </h2>
      </div>
	
<div class="row">

						<!--=== Inline Tabs ===-->
				<div class="container">
   
    <div class="row" style="float:left;">
      <div class="col-md-12" style="float:left;">
        <div class="calendar hidden-print">
          <header>
            <h2 class="month"></h2>
            <a class="btn-prev icon2-angle-left" href="#"></a>
            <a class="btn-next icon2-angle-right" href="#"></a>
          </header>
		  <br/><br/>
          <table>
            <thead class="event-days">
              <tr></tr>
            </thead>
            <tbody class="event-calendar">			             
			  <tr class="1"></tr>
              <tr class="2"></tr>
              <tr class="3"></tr>
              <tr class="4"></tr>
              <tr class="5"></tr>
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <div class="col-md-6" style="float:left;">
      	<div class="list">
            <?php 
			//var_dump($listschedule);
			foreach($listschedule as $list)
			{
			$scheduledate=$list['scheduledate'];
			$pieces = explode(" ", $scheduledate);			
			$unix = strtotime($pieces[0]);
			$dateval=date('j.n.Y', $unix);
			$dayofsch = explode('.', $dateval);		
			
			echo '<div class="day-event" date-day="'.$dayofsch['0'].'" date-month="'.$dayofsch['1'].'" date-year="'.$dayofsch['2'].'"  data-number="1">';			
			?>
			<a href="#" class="close fontawesome-remove"></a>
              <h2 class="title"><?php echo $list['chaptername']; ?></h2>
              <p class="date"><?php echo $pieces[0]; ?></p>
              <p><?php echo $list['chapterdescription']; ?></p>
              <p>Scheduled By<?php echo $list['Emp_name']; ?></p>
              <!--<label class="check-btn">
              <input type="checkbox" class="save" id="save" name="" value=""/>
              <span>Save to personal list!</span>
              </label>--->
              </div>
			<?php
			}
			?>
			</div>
       
        </div>
    </div>
      </div>
    </div>
				<!-- /Inline Tabs -->
				</div> <!-- /.row -->