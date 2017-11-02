<!DOCTYPE html>
<title> </title>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/emp_home.css">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />  
</head>
<body>
    <header class="top-head left">
        <div class="container">
            <div class="row" style="max-width: 1170px;">
                <div class="col-md-6 col-lg-4 pull-left">
                    <img class="img-fluid logo " src="<?php echo base_url() . $company_details->logo_path; ?>">
                </div>
                <div class="col-md-6 col-lg-6  admin-bar hidden-sm-down pull-right">
                    <nav class="nav nav-inline  pull-right">  <a href="employee/login" class="nav-link">Login </a> <a href="employee/register" class="nav-link">Register </a> </nav>

                </div>
            </div>
        </div>

    </header>
<section class="banner-sec">
    <div class="container">
            <div class="row">
                <div class="col-md-4 top-slider">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="news-block">

                                    <div class="news-title">
                                        <h2 class=" title-large">
                                            <a href="#">Conference at PMI</a>
                                        </h2>
                                    </div>
                                    <div class="news-des">  Rotary International Youth Exchange studentsYou simply give us your VIDEOS and AGENDA and leave the rest to us. We will create Beautiful Webpage with your unique URL. Integrate it with your social networking sites and website. Awesome User Interface and User Experience will make your event a HERO.       
                                    </div>

                                    <div>                    
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="500">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="assets/images/banner/1.jpg" alt="Los Angeles" style="width:100%;">
                            </div>

                            <div class="item">
                                <img src="assets/images/banner/2.jpg" alt="Chicago" style="width:100%;">
                            </div>

                            <div class="item">
                                <img src="assets/images/banner/3.jpg" alt="New york" style="width:100%;">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        <div class="row" style='margin-top:30px;'>
            <?php foreach ($course_list as $row) {
                ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="hover-div"> <a class="btn btn-success" id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal">Read more.... </a> </div>
                          <?php
                                                       if (!isset($row['image_path'])) {
                                                ?>
                                                <span style="background-image: url('<?php echo base_url(); ?>uploads/chapter_documents/comp_1/default_image/default_course.jpg');width: auto;height: 225px;background-repeat: no-repeat;background-size: cover;background-position: center;"></span>
                                                 <!--<img class="img-responsive" src="<?php echo base_url(); ?>uploads/chapter_documents/comp_1/default_image/default_course.jpg" >-->
                                                    <?php
                                                        } else {
                                                     ?>
                                                    <!--<img  class="img-responsive" src="<?php echo base_url().$row['image_path']; ?>" >-->
                                                    <span style="background-image: url('<?php echo base_url().$row['image_path']; ?>');width: auto;height: 225px;background-repeat: no-repeat;background-size: cover;background-position: center;"></span>
                                                    <?php
                                                       }
                                                    ?>
                        
                        <div class="card-img-overlay"> <span class="tag tag-pill tag-danger"><?php echo $row['name']; ?></span> </div>
                        <div class="card-block">
                            <div class="news-title">
                                <h2 class=" title-small"><a href="#"><?php echo substr($row['description'], 0, 15); ?></a></h2>
                            </div>
                            <p class="card-text"><small class="text-time"><em><?php echo $row['created_at']; ?></em></small></p>
                            <p class="card-text"><small class="text-time">By_<em><?php echo $row['course_by']; ?></em></small></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
      
    </div>
</section>

<footer class="action-sec">
   <div style="margin-left: 0px !important; margin-right: 0px !important;" class="row"> 

<?php
//var_dump($footerdata);
?>   
<footer>
<div class="footer" style="background-color:#99d9ea !important">
<div class="footer_inner">
    <div class="container"><div class="row">
<div class="col-md-12">     
<div class="col-md-4">
<?php 
if(!empty($footerdata->cmspagelink1))
{
?>    
<a  id="link1" href="<?php echo $footerdata->cmspagelink1;?>" target="_blank" ><?php echo $footerdata->cmspagelink1_name;  ?></a> 
<?php
}
?>
<br/>
<?php 
if(!empty($footerdata->cmspagelink2))
{
?>    
<a id="link2" href="<?php echo $footerdata->cmspagelink2;?>" target="_blank" ><?php echo $footerdata->cmspagelink2_name;  ?></a> 
<?php
}
?>
<br/>
<?php 
if(!empty($footerdata->cmspagelink3))
{
?>    
<a id="link3" href="<?php echo $footerdata->cmspagelink3;?>" target="_blank" ><?php echo $footerdata->cmspagelink3_name;  ?></a> 
<?php
}
?>
   
</div>
<div class="col-md-4">    
<ul>
<li>
<?php 
if(!empty($footerdata->facebook_link))
{
?>    
<a href="<?php echo $footerdata->facebook_link;?>" target="_blank" ><img src="<?php echo base_url(); ?>assets/footerimages/fb_share.png" width="50" /></a> 
<?php
}
?>
</li>    
<li>
<?php 
if(!empty($footerdata->linkedin_link))
{
?>    
<a href="<?php echo $footerdata->linkedin_link;?>" target="_blank" ><img src="<?php echo base_url(); ?>assets/footerimages/linkedin_share.png" width="50" /></a> 
<?php
}
?>
</li>
<li>
<?php 
if(!empty($footerdata->twitter_link))
{
?>    
<a href="<?php echo $footerdata->twitter_link;?>" target="_blank" ><img src="<?php echo base_url(); ?>assets/footerimages/twitter_share.png" width="50" /></a> 
<?php
}
?>
</li>
<li>
<?php 
if(!empty($footerdata->google_link))
{
?>    
<a href="<?php echo $footerdata->google_link;?>" target="_blank"><img src="<?php echo base_url(); ?>assets/footerimages/Google_plus_share.png" width="50" /></a> 
<?php
}
?>
</li>
</ul>            
</div>
<div class="col-md-4" style="text-align: center; "> 


<h4><b>Contact:</b> <span id="contact_no"> +91-<?php 
if(!empty($footerdata->contactno))
{ echo $footerdata->contactno ;}?></span></h4>
<h4><b>Email:</b> <a id="contact_email" href="#"><?php if(!empty($footerdata->emailid))
{ echo $footerdata->emailid ;} ?></a></h4>
        
</div>
</div>
</div>
    </div></div></div>
<div class="footer_2">
<dt>&copy; 2015 Cool Acharya, All rights reserved | Terms of Service | Privacy policy</dt>    
</div>
</footer>    
</div>
</footer>
<div class="modal " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p style="word-wrap: break-word;">Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>
<!--<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript" ></script>-->  
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    $('.hover-div > a').click(function(){
                    $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>employee/get_coursedetails",
                    data: {'course_id':$(this).attr('id')},
                    dataType: 'json',
                    success: function (data) {
                         $('#myModal').find('.modal-title').text(data.details.name);
                       $('#myModal').find('.modal-body > p').text(data.details.description);
                            
                    },
                    error: function () {
                        $("#wrongcreadential").css("display", "block");
                            $("#wrongcreadential").text('technical error please contact to system admin');
                        
                    }
                });
    });
    </script>
</body>
</html>


