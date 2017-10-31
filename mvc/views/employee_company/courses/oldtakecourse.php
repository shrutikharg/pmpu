<section id="main" class="clearfix">
	
    <div class="js-pjax-responses">
      <div class="big-space">
      <div class="row-fluid bot-space">    
	  <div style="float: left;width: 100%;">  
      <?php //include('course_navigation.php');?>
      <div class="span5 wwell">
<h2>Course</h2>	
       
       <div class="tabcontents">
        
        
            <div id="view1">
            
            
														<div class="scrollbars">
							
							<ol id="viewul">
															
								
								
      
        
        
        
							  	<li><a id="137584304" href="#" onclick="return playvideo(0)" title="Product explaination" class="selectedA">Product explaination</a></li>
							
															
								
								
      
        
        
        
							  	<li><a id="137593217" href="#" onclick="return playvideo(1)" title="Correct way of wearing uniform">Correct way of wearing uniform</a></li>
							
															
								
								
      
        
        
        
							  	<li><a id="137594032" href="#" onclick="return playvideo(2)" title="Product display">Product display</a></li>
							
															
								
								
      
        
        
        
							  	<li><a id="137594793" href="#" onclick="return playvideo(3)" title="Visiting the shop">Visiting the shop</a></li>
							
															
								
								
      
        
        
        
							  	<li><a id="137596498" href="#" onclick="return playvideo(4)" title="Working norms of SO - 1">Working norms of SO - 1</a></li>
							
															
								
								
      
        
        
        
							  	<li><a id="137596984" href="#" onclick="return playvideo(5)" title="Working norms of SO - 2">Working norms of SO - 2</a></li>
							
															
								
								
      
        
        
        
							  	<li><a id="137669500" href="#" onclick="return playvideo(6)" title="Working norms for SR">Working norms for SR</a></li>
							
									</ol></div>	
		

            				
            </div>
            
            
        </div>
		<br><br>
    </div>
      <?php 
		foreach($chaptertake as $row)
		{
			echo $vnum=$row['chaptervideo'];
			echo $course_id=$row['courseid'];
		
		$vurls = '';
		$itm = 0;  $i = 0;
		foreach($listchapter as $row1)
		{
			//player.vimeo.com/video/118458220?title=0&byline=0&portrait=0&autoplay=1
			if($vurls == '')
				echo $vurls = '//player.vimeo.com/video/'.$row1['chapter_videoid'].'?title=0&byline=0&portrait=0&autoplay=1';
			else
				echo $vurls .= ',//player.vimeo.com/video/'.$row1['chapter_videoid'].'?title=0&byline=0&portrait=0&autoplay=1';				
				if ($row1['chapter_videoid'] == $vnum)
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
<div class="span18 browse-right" itemscope="" itemtype="http://schema.org/EducationalOrganization">
		<div class="wwell no-mar">		    

<div id="player" >
     <div id="player_display" style="float:left; width:100%; height: 500px; left: 0px; top: 0px; background: rgb(0, 0, 0);">
         <iframe id="player1" src="//player.vimeo.com/video/<?php echo $vnum; ?>?color=00adef&autoplay=1&api=1&player_id=player1" width="100%" height="500px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
     </div>
     
     <div style="float:right; width: 150px; height: 40px;margin-top: 0px;z-index: 1; padding-top:10px;">  
        <a href="#" onclick="return loadNextPage(-1)" style="color:White;"> << Previous </a> | 
        <a href="#" onclick="return loadNextPage(1)" style="color:White;"> Next >> </a> 
    </div>
   
</div>


		<div style="background: #ffffff;">	
		<div class="form-wraper row" id="register-form">
		<div class="control-group">
            <label style="padding-left: 14px;" for="inputError" class="control-label span7">Rating</label>
            <div class="controls span7">						
					      <input value="5" class="star star-5" id="star-5" type="radio" name="star">
					      <label class="star star-5" for="star-5"></label>
					      <input value="4" class="star star-4" id="star-4" type="radio" name="star">
					      <label class="star star-4" for="star-4"></label>
					      <input value="3" class="star star-3" id="star-3" type="radio" name="star">
					      <label class="star star-3" for="star-3"></label>
					      <input value="2" class="star star-2" id="star-2" type="radio" name="star">
					      <label class="star star-2" for="star-2"></label>
					      <input value="1" class="star star-1" id="star-1" type="radio" name="star">
					      <label class="star star-1" for="star-1"></label>					   
            </div>
        </div>	
     <p>&nbsp;</p>
	      <p>&nbsp;</p>   
<input type="hidden" name="courseid" value="4">
<input type="hidden" name="coursesubcat" value="3">
<input type="hidden" name="coursename" value="Product Display">
		<div class="control-group span23">
            <label for="inputError" class="control-label ">Comments</label>
            <p>&nbsp;</p>
	     
            <div class="controls">
	    <textarea rows="10" id="" class="form-control span23" name="comments"></textarea>
	     
	      
	       
              <!--<span class="help-inline">Woohoo!</span>-->
             
            </div>
        </div>	
		 
		 
          <div class="control-group span17">
          	
		 <p>&nbsp;</p>
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
		  
		</div>	
		</div>
			
   		</div><br>
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

