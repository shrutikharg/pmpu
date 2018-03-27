<style type="text/css">
    .gallery
    {
        display: inline-block;
        margin-top: 20px;
    }
    .thumbnail > img {
        width: 300px;
        height: 220px;
    }
</style>
<script type="text/javascript">

</script>
<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul class="breadcrumb">
                <li>
                    <a href="#">
                        <?php echo $this->lang->line('brd_organization'); ?>

                    </a> 

                </li>
                <li>
                    <a href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>">
                        <?php echo $this->lang->line('brd_department'); ?>
                    </a> 
                </li>>
            </ul>				      
        </div>
        <!-- /Breadcrumbs line -->
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h2><?php echo $this->lang->line('lbl_search') ?></h2>
                    </div>
                    <div class="widget-content">
                        <?php
                        $attributes = array('class' => 'form-horizontal row-border', 'id' => 'searchform');

                        $options_category = array('name' => 'Department Name');
                        echo form_open('#', $attributes);

                        echo '<div class="form-group">';
                        echo "<label class='col-md-3 col-sm-3  control-label'> Search Image</label>";
                        echo '<div class="col-md-4 col-sm-5">';
                        $data_search = array(
                            'name' => 'search_string',
                            'id' => 'search_string',
                            'class' => 'form-control',
                            'placeholder' => "Enter Image Name"
                        );
                        echo form_input($data_search);
                        echo '</div>';
                        $data_submit = array('type' => "button", 'name' => 'mysubmit', 'id' => 'search', 'class' => 'btn btn-primary', 'value' => $this->lang->line('btn_search'));
                        echo '<div class="col-md-2 col-sm-2 searchbtn" >';
                        echo form_input($data_submit);
                        echo '</div>';
                        echo '</div>';
                        echo form_close();
                        ?>
                    </div> <!-- /.widget-content -->
                </div> <!-- /.widget .box -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->		
        <div class="row">
            <div class="col-md-12">
                <?php
                ?>
                <a  href="<?php echo site_url("admin_company") . '/' . $this->uri->segment(2); ?>/add" class="btn btn-primary">Add New</a>
                </h2>
                <p>&nbsp;</p>
                <div class="widget box">
                    <div class="widget-header">
                        <h4> Nature Gallery </h4>
                    </div>
                    <div class="widget-content">
                        <div class="container">
                            <div class="row">
                                <div class='list-group gallery'>
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail" data-lightbox="roadtrip" href="http://lorempixel.com/300/220/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/300/220/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail" data-lightbox="roadtrip" href="http://lorempixel.com/300/220/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/300/220/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail" data-lightbox="roadtrip" href="http://lorempixel.com/300/220/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/300/220/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail" data-lightbox="roadtrip" href="http://lorempixel.com/300/220/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/300/220/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail" data-lightbox="roadtrip" href="http://lorempixel.com/300/220/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/300/220/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail" data-lightbox="roadtrip" href="http://lorempixel.com/300/220/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/300/220/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail" data-lightbox="roadtrip" href="http://lorempixel.com/300/220/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/300/220/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail" data-lightbox="roadtrip" href="http://lorempixel.com/300/220/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/300/220/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                </div> <!-- list-group / end -->
                            </div> <!-- row / end -->
                        </div> <!-- container / end -->
                        <div class="pagination"> 
                            <div class="pagination-widget">
                                <div class="col-md-3 col-sm-1 col-xs-2">
                                    <span id="reload" class="glyphicon glyphicon-refresh"> </span>
                                </div>
                                <div class="col-md-5 col-sm-6 col-xs-10">
                                    <span id="first_pager" class="glyphicon glyphicon-fast-backward" style="display: none;"> </span>
                                    <span id="previous_pager" class="glyphicon glyphicon-step-backward" style="display: none;">  </span>
                                    <span>Page </span>
                                    <span><input type="text" class="form-control pagination-input" id="page_no" name="PageNo"></span>
                                    <span>  of </span>
                                    <span><lable class="pagination-lable" id="pageOf">1</lable></span>

                                    <span id="next_pager" class="glyphicon glyphicon-step-forward" style="display: none;"> </span>

                                    <span id="last_pager" class="glyphicon glyphicon-fast-forward" style="display: none;">      </span>
                                    <span> 
                                        <select id="rows" style="margin-left: 10px">
                                            <option value="10">10 </option>
                                            <option value="20"> 20</option>
                                            <option value="25"> 25</option>
                                        </select>                                    
                                    </span>
                                </div>

                                <div class="col-md-4 col-sm-5 col-xs-12 pagination-right">   
                                    <div class="pagination-right">
                                        <span>view</span>
                                        <span><lable class="pagination-lable" id="rowFrm">1</lable></span>
                                        <span>-</span>
                                        <span><lable class="pagination-lable" id="rowTo">1</lable></span>
                                        <span>view</span>
                                        <span id="totalCount">1</span>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Normal -->
</div>
</div>