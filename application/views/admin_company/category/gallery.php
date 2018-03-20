<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
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
    $(document).ready(function(){
        //FANCYBOX
        //https://github.com/fancyapps/fancyBox
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
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
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://lorempixel.com/216/304/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/216/304/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://lorempixel.com/216/304/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/216/304/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://lorempixel.com/216/304/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/216/304/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://lorempixel.com/216/304/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/216/304/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://lorempixel.com/216/304/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/216/304/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://lorempixel.com/216/304/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/216/304/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://lorempixel.com/216/304/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/216/304/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://lorempixel.com/216/304/nature">
                                            <img class="img-responsive" alt="" src="http://lorempixel.com/216/304/nature" />
                                            <div class='text-right'>
                                                <small class='text-muted'>Image Title</small>
                                            </div> <!-- text-right / end -->
                                        </a>
                                    </div> <!-- col-6 / end -->
                                </div> <!-- list-group / end -->
                            </div> <!-- row / end -->
                        </div> <!-- container / end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Normal -->
</div>
</div>