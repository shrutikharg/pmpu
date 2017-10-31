<div style="margin-left: 0px !important; margin-right: 0px !important;" class="row"> 

<?php
//var_dump($footerdata);
?>   
<footer>
<div class="footer">
<div class="footer_inner">    
<div class="col-md-3">    
&nbsp;    
    
</div>    
<div class="col-md-2">
<?php 
if(!empty($footerdata[0]['cmspagelink1']))
{
?>    
<a  id="link1" href="<?php echo $footerdata[0]['cmspagelink1'];?>" target="_blank" ><?php echo $footerdata[0]['cmspagelink1_name'];  ?></a> 
<?php
}
?>
<br/>
<?php 
if(!empty($footerdata[0]['cmspagelink2']))
{
?>    
<a id="link2" href="<?php echo $footerdata[0]['cmspagelink2'];?>" target="_blank" ><?php echo $footerdata[0]['cmspagelink2_name'];  ?></a> 
<?php
}
?>
<br/>
<?php 
if(!empty($footerdata[0]['cmspagelink3']))
{
?>    
<a id="link3" href="<?php echo $footerdata[0]['cmspagelink3'];?>" target="_blank" ><?php echo $footerdata[0]['cmspagelink3_name'];  ?></a> 
<?php
}
?>
   
</div>
<div class="col-md-4">    
<ul>
<li>
<?php 
if(!empty($footerdata[0]['facebook_link']))
{
?>    
<a href="<?php echo $footerdata[0]['facebook_link'];?>" target="_blank" ><img src="<?php echo base_url(); ?>assets/footerimages/fb_share.png" width="50" /></a> 
<?php
}
?>
</li>    
<li>
<?php 
if(!empty($footerdata[0]['linkedin_link']))
{
?>    
<a href="<?php echo $footerdata[0]['linkedin_link'];?>" target="_blank" ><img src="<?php echo base_url(); ?>assets/footerimages/linkedin_share.png" width="50" /></a> 
<?php
}
?>
</li>
<li>
<?php 
if(!empty($footerdata[0]['twitter_link']))
{
?>    
<a href="<?php echo $footerdata[0]['twitter_link'];?>" target="_blank" ><img src="<?php echo base_url(); ?>assets/footerimages/twitter_share.png" width="50" /></a> 
<?php
}
?>
</li>
<li>
<?php 
if(!empty($footerdata[0]['google_link']))
{
?>    
<a href="<?php echo $footerdata[0]['google_link'];?>" target="_blank"><img src="<?php echo base_url(); ?>assets/footerimages/Google_plus_share.png" width="50" /></a> 
<?php
}
?>
</li>
</ul>            
</div>
<div class="col-md-3" style="text-align: center; ">    


<h4><b>Contact:</b> <span id="contact_no"> +91-<?php 
if(!empty($footerdata[0]['contactno']))
{ echo $footerdata[0]['contactno'] ;}?></span></h4>
<h4><b>Email:</b> <a id="contact_email" href="#"><?php if(!empty($footerdata[0]['emailid']))
{ echo $footerdata[0]['emailid'] ;} ?></a></h4>
        
</div>
</div>
</div>
<div class="footer_2">
<dt>&copy; 2015 Cool Acharya, All rights reserved | Terms of Service | Privacy policy</dt>    
</div>
</footer>    
</div>

	<script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.min.js"></script>
</body>
</html>