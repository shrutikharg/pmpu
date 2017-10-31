<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/thumbnail/css/jquery-smartvimeoembed.css" type="text/css" />
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
	
<script>
	jQuery(document).ready(function(){
	
	//$(".analytics").hover( function () { $(this).hide(); $(".view_analytics").show(); }  );
	
	//$(".analytics").mouseleave( function () { $(".view_analytics").hide(); $(".analytics").show(); }  );
	//alert('mouse hoeber');
	jQuery('.analytics_wrapper').on({
    'mouseenter':function(){
    	//alert("hover");
        jQuery(this).children('.analytics').hide();
        jQuery(this).children(".view_analytics").show();
         //$(".view_analytics").show();
    },'mouseleave':function(){
        jQuery(this).children(".view_analytics").hide();
        jQuery(this).children(".analytics").show();
    }
});
	});
	
	</script>
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
      
      <div class="row">
        <div class="span12 columns">
          
		<?php
		$j=0;
		//echo count($courses);
		//for($j=0;$j<count($courses);($j+4))
		$cnt=1;
        {
		?>		
			
         <div class="row">
		 <div class="col-md-12">
			<?php
				for($i=0;$i<count($courses);$i++)
				{				
					
					if($courses[$i-1]['courseid']==$courses[$i]['courseid'])		
					{					
						++$cnt;						
					}
					else
					{
						//echo 'Count here'.$cnt;
						if(($cnt%2)!=0)
						{
					echo '</div></div><div class="col-md-6"><p> &nbsp; </p></div>';
							echo '<br/>';							
							echo '<h2 style="text-align:center;">'.$courses[$i]['coursename'].'</h2>';
							echo '<hr></hr>';
							echo '<br/><br/>';						
						}
						else
						{							
						echo '<br/>';		
				echo '<h2 style="text-align:center;">'.$courses[$i]['coursename'].'</h2>';
							echo '<hr></hr>';
							echo '<br/><br/>';	
						}
						$cnt=1;
					}
				
			?>
					<div class="col-md-6">
					<?php
						//echo $courses[$i]['courseid'];					
					?>
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i><?php echo $courses[$i]['chaptername'] ; ?></h4>								
							</div>
							<div class="widget-content">
							<?php
							$videoid = $courses[$i]['chaptervideo'];
							$id = $courses[$i]['chapterid'];
							/*$dirc=getVimeoThumb($videoid,100);
							var_dump($dirc);*/
							?>							
							
							<img width="340px"  src="http://placehold.it/640x360" class="video-thumb" data-vimeo-id="<?php echo $videoid; ?>" />
							
							<br><br>
                             <table width="100%" border="0" cellspacing="2" cellpadding="2">
								  <tbody>
								  <tr>
									<td>
										                                        	
                                    
               <div class="analytics_wrapper" style="cursor:pointer;">	
                                    <div class="analytics" style="font-size:14px;" >	
                                    <span style="margin-right:4px;"><i class="icon-eye-open">&nbsp;</i>&nbsp;50</span>	
                                    <span style="margin-right:4px;" ><i class="icon-heart">&nbsp;</i>&nbsp;10</span>	
                                    <span style="margin-right:4px;" ><i class="icon-comments" >&nbsp;</i>&nbsp;2</span>
                                    </div>
                               
        <?php		
			echo '<a href="'.site_url("admin_company").'/chapters/viewchapter/'.$id.'"  class="view_analytics btn btn-success btn-block" style="display: none;">view Analytics</a>';              
				?>
                                   
                                    </div>	
                                    </div>										
									</td>
								  </tr>
								</tbody></table>								
							</div>
						</div>
					</div>
    <?php
				}
			}		
	?>   
			</div>
			</div>
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
		</div>
      </div>
<script type="text/javascript">	  
/*
var getVimeoThumbnail = function(id) {
    $.ajax({
        type:'GET',
        url: 'http://vimeo.com/api/v2/video/' + id + '.json',
        jsonp: 'callback',
        dataType: 'jsonp',
        success: function(data){
            var thumbnail_src = data[0].thumbnail_small;
            $('[data-vimeo-id='+id+']').attr('src', thumbnail_src);
        }
    });
};


var drawVimeoImages = function() {
    var vimeoImgDataAttr = 'data-vimeo-id',
        vimeoThumbnails = $('[' + vimeoImgDataAttr + ']'),
        vimeoThumbnailsLength = vimeoThumbnails.length;
    
    if(vimeoThumbnailsLength) {
        for(var i=0, l = vimeoThumbnailsLength; i < l; i++) {
            var vimeoImg = $(vimeoThumbnails).get(i),
                vimeoImgId = $(vimeoImg).attr(vimeoImgDataAttr);
            
            getVimeoThumbnail(vimeoImgId);
        }
    }
};

drawVimeoImages();

var getVimeoThumbnail = function(id) {
    $.ajax({
        type:'GET',
        url: 'http://vimeo.com/api/v2/video/' + id + '.json',
        jsonp: 'callback',
        dataType: 'jsonp',
        success: function(data){
            var thumbnail_src = data[0].thumbnail_small;
            $('[data-vimeo-id='+id+']').attr('src', thumbnail_src);
        }
    });
};

//getVimeoThumbnail(120767266);
getVimeoThumbnail(27246366);
*/
</script>	



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/thumbnail/jquery-smartvimeoembed.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/thumbnail/local.js"></script>

