
<section id="main" class="clearfix">
    <div class="js-pjax-responses">
      <div class="big-space">
      <div class="row-fluid bot-space">    
	  <div style="float: left;width: 100%;">  
      <?php //include('course_navigation.php');?>
      <?php 
		var_dump($coursetake);
		//if(isset($_GET['vnum'])) 
		{ //$vnum= $_GET['vnum']; }
		//else {  }
		}
		foreach($coursetake as $row)
		{
			$videoid=$row[];
		}
		$vnum=147838390;
		$course_id=8;
		
		//if ($_GET['course']) { $course_id = $_GET['course']; } 

		$sql_CourseVideo = "SELECT Video_Id,Course_Id,Video_Title,Video_Time,Video_Description,Video_Number,For_Preview,Video_Image,
							Uploaded_Date,Created_Date,Created_By,Modify_Date,Modify_By,IsActive
							  FROM course_video
							  WHERE For_Preview= 'Y' and IsActive = 'Y' and Course_Id=".$course_id;
		if($session->Get('log_id') != ''){
			$sql_LC = "SELECT LC_Id,Course_Id,Learner_Id,Purchase_Date,Purchase_Price,Validity,Created_Date,Created_By,Modify_Date,Modify_By,IsActive
							FROM learner_course
							WHERE IsActive = 'Y' and Course_Id =".$course." and Learner_Id =".$session->Get('log_id');
			$res_LC = mysql_query($sql_LC);
			if(mysql_num_rows($res_LC) > 0)
			{
				//$row_LC = mysql_fetch_array($res_LC);
				$sql_CourseVideo = "SELECT Video_Id,Course_Id,Video_Title,Video_Time,Video_Description,Video_Number,For_Preview,Video_Image,
							Uploaded_Date,Created_Date,Created_By,Modify_Date,Modify_By,IsActive
						  FROM course_video
						  WHERE IsActive = 'Y' and Course_Id=".$course_id;
			}
		}
		//echo $sql_CourseVideo;
		$res_CourseVideo = mysql_query($sql_CourseVideo);
		$vurls = '';
		$itm = 0;  $i = 0;
		if(mysql_num_rows($res_CourseVideo) > 0)
		{
			while($row_CourseVideo = mysql_fetch_object($res_CourseVideo))
			{
				//player.vimeo.com/video/118458220?title=0&byline=0&portrait=0&autoplay=1
				if($vurls == '')
					$vurls = '//player.vimeo.com/video/'.$row_CourseVideo->Video_Number.'?title=0&byline=0&portrait=0&autoplay=1';
				else
					$vurls .= ',//player.vimeo.com/video/'.$row_CourseVideo->Video_Number.'?title=0&byline=0&portrait=0&autoplay=1';
				
				if ($row_CourseVideo->Video_Number == $vnum)
					{$itm = $i; }
				$i = $i+ 1;
			}
		}
		/*,https://vimeo.com/118457672,https://vimeo.com/118890158 */
		?>
	
	<?php 
	/* $vurls = '';
	 $i = 0;
	 $itm = 0;
	foreach ($videos->video as $video):  
	
	  if($itm == 0) 
	  { 
	  	$vurls = $video->url; 
		if (strpos($vurls, $vnum) !== FALSE)
			{$itm = $i; }
	  }
	 
	  $i = $i+ 1;
	endforeach;
	 
	 	$str = $vurls;
		$old = 'http:';
		$new = 'https:';
		
		$i = 1;
		
		$tmpOldStrLength = strlen($old);
		
		while (($offset = strpos($str, $old, $offset)) !== false) {
		  $str = substr_replace($str, $new, $offset, $tmpOldStrLength);
		} */
	?>
	<input type="hidden" id="vurls" name="vurls" value="<?php echo $vurls; ?>" />
	<input type="hidden" id="item_num" name="item_num" value="<?php echo $itm; ?>" />
	
	
	<script>
	var v = document.getElementById('vurls').value;
	var res = v.split(",");
    var webpageArray = res;
	var cnt= parseInt(document.getElementById('item_num').value);

    function loadNextPage(dir) {
        cnt += dir;
		//alert(cnt);
        if (cnt < 0) cnt = webpageArray.length - 1; // wrap
        else if (cnt >= webpageArray.length) cnt = 0; // wrap
        var iframe = document.getElementById("player1");
        iframe.src = webpageArray[cnt];
        return false; // mandatory!
    }
   
    </script>
    

<div id="player" style="float: left; position: relative; width: 1090px; height: 550px; background: rgb(0, 0, 0);">
     <div id="player_display" style="float:left; width:100%; height: 500px; left: 0px; top: 0px; background: rgb(0, 0, 0);">
         <iframe id="player1" src="//player.vimeo.com/video/<?php echo $vnum; ?>?color=00adef&autoplay=1&api=1&player_id=player1" width="100%" height="500px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
     </div>
     
     <div style="float:right; width: 150px; height: 40px;margin-top: 0px;z-index: 1; padding-top:10px;">  
        <a href="#" onclick="return loadNextPage(-1)" style="color:White;"> << Previous </a> | 
        <a href="#" onclick="return loadNextPage(1)" style="color:White;"> Next >> </a> 
    </div>
   
</div>



  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script>

      $(function() {
          var player = $('iframe');
          var url = window.location.protocol + player.attr('src').split('?')[0];
          var status = $('.status');

          // Listen for messages from the player
          if (window.addEventListener) {
              window.addEventListener('message', onMessageReceived, false);
          }
          else {
              window.attachEvent('onmessage', onMessageReceived, false);
          }

          // Handle messages received from the player
          function onMessageReceived(e) {
              var data = JSON.parse(e.data);

              switch (data.event) {
                  case 'ready':
                      onReady();
                      break;

                  case 'playProgress':
                      onPlayProgress(data.data);
                      break;

                  case 'pause':
                      onPause();
                      break;

                  case 'finish':
                      onFinish();
                      break;
              }
          }

          // Call the API when a button is pressed
          $('button').on('click', function() {
              post($(this).text().toLowerCase());
          });

          // Helper function for sending a message to the player
          function post(action, value) {
              var data = {
                  method: action
              };

              if (value) {
                  data.value = value;
              }

              var message = JSON.stringify(data);
              player[0].contentWindow.postMessage(data, url);
          }

          function onReady() {
              status.text('ready');

              post('addEventListener', 'pause');
              post('addEventListener', 'finish');
              post('addEventListener', 'playProgress');
          }

          function onPause() {
              status.text('paused');
          }

          function onFinish() {
              status.text('finished');
              loadNextPage(1);
          }

          function onPlayProgress(data) {
              status.text(data.seconds + 's played');
          }
      });
    </script>
</div>


</div>	
  
</div>
<!-- Modal -->
	<div class="container-modal">
		<div class="modal hide fade" id="js-ajax-modal">
			<div class="modal-header hide">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
			  <a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>
  </section>
  
