<script type="text/javascript">
    $(document).ready(function (e) { });
</script>
<script type="text/javascript">
    function getchapters(course_id) {
        var form = $(document.createElement('form'));
        $(form).attr("action", "../employee_company/chapter_list");
        $(form).attr("method", "POST");
        $(form).attr("id", "form1");
        var input = $("<input>").attr("type", "hidden").attr("name", "course_id").val(course_id);
        $(form).append($(input));
        $(form).appendTo("body").submit();
    }
</script>   
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/emp_home.css">

<div id="content" style="background:#d7e4e9" >
    <div class="container">
        <div class="row">
            <ul class="breadcrumb">
                <li>   
                    <a href="#">
                        Courses
                    </a> 

                </li>
                <li class="active">
                    <a href=" <?php echo $this->uri->segment(2); ?>">
                        <?php echo $menu_name; ?>
                    </a>

                </li>
            </ul>                     

        </div>   
        <div class="page-header users-header" style="display:none">
            <h2>
                Assigned <?php echo ucfirst($this->uri->segment(2)); ?>    
            </h2>
        </div> 

        <!--============================ Course List Start  ==================================----->

        <div class="row">
            <div class="col-md-12" style="margin-bottom:35px;">
                <div class="widget-header" style="margin-bottom:30px;margin-top:25px ">

                </div><?php
                foreach ($courses as $row) {
                    ?>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="card"> 
                            <div class="hover-div animated zoomIn"> <a href="#" class="btn btn-success">
                                    <?php echo '<input type="button" id="id" onClick="getchapters(' . $row['id'] . ')" value="View Chapters" class="btn btn-success btn-block"></button>'; ?> </a> </div>
                                    <?php
                            if (!isset($row['image_path'])) {
                                ?>
                                <img class="img-fluid card-img" src="<?php echo base_url(); ?>uploads/chapter_documents/comp_1/default_image/default_course.jpg" >
                                <?php
                            } else {
                                ?>
                                <img  class="img-fluid card-img" src="<?php echo base_url() . $row['image_path']; ?>" >
                                <?php
                            }
                            ?>
                            <div class="card-img-overlay"> <span class="tag tag-pill tag-danger"><?php echo '&nbsp' . $row['name']; ?>
                                </span> 
                            </div>    
                            <div class="card-block">
                                <div class="news-title">
                                    <h2 class=" title-small"><a href="#"><?php echo '&nbsp' . substr($row['description'], 0, 30); ?></a></h2>
                                </div>
                                <p class="card-text">
                                    <small class="text-time">
                                        <em>3 mins ago</em>
                                    </small>
                                </p> 
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>   
            <br/>                     

            <!--====================================Course List End ==============================================----->
        </div>
    </div>
</div>
