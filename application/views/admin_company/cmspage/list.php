<div id="content">
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                    <div class="widget box">
                        <div class="widget-header">
                            <h2>CMS List</h2>
                        </div>
                    </div> <!-- /.widget .box -->
                </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->		
        <!-- /Statboxes -->


        <!--=== Page Content ===-->
        <!--=== Statboxes ===-->		

        <!--=== Normal ===-->
        <div class="row" style="margin-left: auto;margin-right: auto;">
            <div class="col-md-12">												
                <?php
                //var_dump($count_cmslimit);		
                $planid_currentuser = $this->session->userdata['userplan_id'];
                if ($planid_currentuser !== '1') {

                    if ($count_cmslimit <= 0) {
                        ?>
                        <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary">Add a new</a>
                        </h2>
        <?php
    }
}
?>
                <p>&nbsp;</p>
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>View CMS Settings</h4>								
                    </div>

                    <div class="res_table">
                        <div class="res_table-head">           
                            <div class="column" data-label="Emailid">Emailid</div>
                            <div class="column" data-label="contactno">Contact no</div>
                            <div class="column" data-label="cmspagelink1">Cms pagelink</div>		   
                            <div class="column" data-label="action">Action</div>
                        </div> 
<?php
foreach ($cmspage as $row) {
    echo '<div class="res_row">';
    echo '<div class="column" data-label="Emailid">' . $row['emailid'] . '</div>';
    echo '<div class="column" data-label="Emailid">' . $row['contactno'] . '</div>';
    echo '<div class="column" data-label="cmspagelink1">' . $row['cmspagelink1'] . '</div>';
 
        echo '<div class="column" data-label="action">
                  <a href="' . site_url("admin_company") . '/cmspage/update/' . $row['id'] . '" class="btn btn-info" >view & edit</a></div>';
    
    echo '</div>';
}
?> 
                    </div>  
                        <?php echo '<div class="pagination">' . $this->pagination->create_links() . '</div>'; ?>
                </div>						
            </div>						
        </div>
    </div>
    <!-- /Normal -->
</div>
</div>		