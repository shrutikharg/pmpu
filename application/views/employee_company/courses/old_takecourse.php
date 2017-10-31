 <div id="content">
	<div class="container">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("employee_company"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("employee_company").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Take Course</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Take Course <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Category updated with success.';
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
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
	  //var_dump($coursetake);
	
      //form validation
      echo validation_errors();

      echo form_open_multipart('employee_company/category/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
        <?php		
		 $coursevideoid=$coursetake[0]['course_videoid'];
		?>
		  
		<iframe src="//player.vimeo.com/video/<?php echo $coursevideoid; ?>?api=1&player_id=vimeo-player-1" id="vimeo-player-1" width="640" height="390" frameborder="0" data-progress="true" data-seek="true" data-bounce="true" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>

        </fieldset>

      <?php echo form_close(); ?>

 </div>
 
 <script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
<iframe id="player1" src="https://player.vimeo.com/video/<?php echo $coursevideoid; ?>?api=1&player_id=player1" width="630" height="354" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

<div>
  <!--<button>Play</button>
  <button>Pause</button>-->
  <p>Status: <span class="status">&hellip;</span></p>
</div>

<script>
$(function() {
    var iframe = $('#player1')[0];
    var player = $f(iframe);
    var status = $('.status');

    // When the player is ready, add listeners for pause, finish, and playProgress
    player.addEvent('ready', function() {
        status.text('ready');
        
        player.addEvent('pause', onPause);
        player.addEvent('finish', onFinish);
        player.addEvent('playProgress', onPlayProgress);
    });

    // Call the API when a button is pressed
    $('button').bind('click', function() {
        player.api($(this).text().toLowerCase());
    });

    function onPause(id) {
        status.text('paused');
    }

    function onFinish(id) {
        status.text('finished');
    }

    function onPlayProgress(data, id) {
        status.text(data.seconds + 's played');
    }
});
</script>
