<?php
//var_dump($footerdata);
?>   

<div style="margin-left: 0px !important; margin-right: 0px !important; z-index: 8000; position: relative; clear: both; display: block;" class="row">	
    <footer>
        <div class="footer">
            <div class="footer_inner">	
                <div class="form-group"	>
                    <div class="col-md-2">	
                        &nbsp;	

                    </div>	
                </div>
                <div class="form-group"	>
                    <div class="col-md-2" id="col-md-2" style="margin-top: 20px;">	

                        <?php
                        if (!empty($footerdata[0]['cmspagelink1'])) {
                            ?>    
                            <a  id="link1" href="<?php echo $footerdata[0]['cmspagelink1']; ?>" target="_blank" ><?php echo $footerdata[0]['cmspagelink1_name']; ?></a> 
                            <?php
                        }
                        ?>
                        <br/>
                        <?php
                        if (!empty($footerdata[0]['cmspagelink2'])) {
                            ?>    
                            <a id="link2" href="<?php echo $footerdata[0]['cmspagelink2']; ?>" target="_blank" ><?php echo $footerdata[0]['cmspagelink2_name']; ?></a> 
                            <?php
                        }
                        ?>
                        <br/>
                        <?php
                        if (!empty($footerdata[0]['cmspagelink3'])) {
                            ?>    
                            <!-- <a id="link3" href="<?php echo $footerdata[0]['cmspagelink3']; ?>" target="_blank" ><?php echo $footerdata[0]['cmspagelink3_name']; ?></a> --> 
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="form-group"	>
                    <div class="col-md-4" style="text-align: center; margin-top: 20px; ">	
                        <div class="social_icons">

<?php
if (!empty($footerdata[0]['facebook_link'])) {
    ?>    
                                <span> <a href="<?php echo $footerdata[0]['facebook_link']; ?>" class="facebook" target="_blank" ></a></span> 
                                <?php
                            }
                            ?>

                            <?php
                            if (!empty($footerdata[0]['twitter_link'])) {
                                ?>    
                                <span> <a href="<?php echo $footerdata[0]['twitter_link']; ?>" class="twitter" target="_blank" ></a></span> 
                                <?php
                            }
                            ?>

                            <?php
                            if (!empty($footerdata[0]['google_link'])) {
                                ?>    
                                <span> <a href="<?php echo $footerdata[0]['google_link']; ?>" class="linked_in" target="_blank"></a></span> 
                                <?php
                            }
                            ?>
                        </div>			
                    </div>
                </div>
                <div class="form-group"	>
                    <div class="col-md-3" style="text-align: center; ">	
                        <h4><b>Contact:</b> <span id="contact_no"> +91-<?php
                            if (!empty($footerdata[0]['contactno'])) {
                                echo $footerdata[0]['contactno'];
                            }
                            ?></span></h4>
                        <h4><b>Email:</b> <a id="contact_email" href="#"><?php if (!empty($footerdata[0]['emailid'])) {
                                echo $footerdata[0]['emailid'];
                            }
                            ?></a></h4>

                    </div>
                </div>
            </div>
        </div>
        <div class="footer_2">

            <dt>&copy; 2015 Cool Acharya, All rights reserved | Terms of Service | Privacy policy</dt>    
        </div>
    </footer>	
</div>


<script src="<?php echo base_url(); ?>assets/assets/js/demo/jquery_1.9.1.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/pagination.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>	
</body>
</html>