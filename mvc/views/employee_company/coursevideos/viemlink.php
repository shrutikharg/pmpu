<?php  
 require_once('vimeo.php');  
 try  
 {  
      $consumer_key = 'CONSUMER KEY HERE';  
      $consumer_secret = 'CONSUMER SECRETE HERE';  
      $oauth_access_token = 'AUTH ACCESS TOKEN HERE';  
      $oauth_request_token_secret = 'AUTH TOKEN SECRETE HERE';  
      $vimeo = new phpVimeo($consumer_key, $consumer_secret, $oauth_access_token, $oauth_request_token_secret);  
      $video_id = $vimeo->upload('VIDEO NAME HERE');  
      $videotitle = 'VIDEO TITLE HERE !';  
      $videodesc = 'VIDEO DESCRIPTION HERE !';  
      if ($video_id) {  
       $sUploadResult = 'Your video has been uploaded and available <a href="http://vimeo.com/'.$video_id.'">here</a> !';  
       $vimeo->call('vimeo.videos.setTitle', array('title' => $videotitle, 'video_id' => $video_id));  
       $vimeo->call('vimeo.videos.setDescription', array('description' => $videodesc, 'video_id' => $video_id));  
                $videourl = 'http://vimeo.com/'.$video_id;  
                     $arry['data']['flag'] = true;  
                     $arry['data']['url'] = $videourl;  
                     $arry['data']['msg'] = "Video Uploaded Successfully.";  
                 }   
                 else   
                 {  
                      $arry['data']['flag'] = false;  
                      $arry['data']['msg'] = "Not able to retrieve the video status information yet. " ."Please try again later.\n";  
                 }  
 }  
 catch(Exception $e)  
 {  
      $arry['data']['flag'] = false;  
      $arry['data']['msg'] = $e->getMessage();  
 }       
      if($video_id)  
      {  
                $arry['data']['flag'] = true;  
                $arry['data']['url'] = $videourl;  
                $arry['data']['msg'] = 'Video Uploaded Successfully.';  
      }  
      else  
      {  
           $arry['data']['flag'] = false;  
      }  
      if($arry['data']['msg'] == 'Invalid signature')  
      {  
           $arry['data']['msg'] = 'Invalid Secret or oauth_request_token_secret';  
      }  
      if($arry['data']['msg'] == 'Permission Denied')  
      {  
           $arry['data']['msg'] = 'Invalid oauth_access_token';  
      }  
      echo "<pre>";  
      print_r($arry); 


// http://easyscript4u.blogspot.in/2014/02/how-to-upload-video-on-vimeo-using-php.html	  
 ?>  