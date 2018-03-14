<!DOCTYPE html>
<title> Coolacharya Learning Solution </title>
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
                    <nav class="nav nav-inline  pull-right">  <a href="employee/login" class="nav-link"><span class="fa fa-user" style="padding-right: 4px;"></span>Login </a> <a href="employee/register" class="nav-link"><span class="fa fa-plus" style="padding-right: 4px;"></span>Register </a> </nav>

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
                                            <a href="#"><?php echo $company_details->name;?></a>
                                        </h2>
                                    </div>
                                    <div class="news-des"> <?php echo $company_details->description;?>
                                    </div>

                                    <div>                    
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
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
<!--        <div class="row" style='margin-top:30px;'>
            <?php foreach ($course_list as $row) {
                ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="hover-div"> <a class="btn btn-success" id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal">Read more.... </a> </div>
                          <?php
                                                       if (!isset($row['image_path'])) {
                                                ?>
                                                <span style="background-image: url('<?php echo base_url(); ?>uploads/chapter_documents/comp_1/default_image/default_course.jpg');width: auto;height: 225px;background-repeat: no-repeat;background-size: cover;background-position: center;"></span>
                                                 <img class="img-responsive" src="<?php echo base_url(); ?>uploads/chapter_documents/comp_1/default_image/default_course.jpg" >
                                                    <?php
                                                        } else {
                                                     ?>
                                                    <img  class="img-responsive" src="<?php echo base_url().$row['image_path']; ?>" >
                                                    <span style="background-image: url('<?php echo base_url().$row['image_path']; ?>');width: auto;height: 225px;background-repeat: no-repeat;background-size: cover;background-position: center;"></span>
                                                    <?php
                                                       }
                                                    ?>
                        
                        <div class="card-img-overlay"> <span class="tag tag-pill tag-danger"><?php echo $row['name']; ?></span> </div>
                        <div class="card-block" style="border-top: 2px solid #f50f0f;">
                            <div class="news-title">
                                <h3 class=" title-small"><a href="#"><?php echo substr($row['description'], 0, 15); ?></a></h3>
                            </div>
                            <p class="card-text"><small class="text-time"><em><?php echo $row['created_at']; ?></em></small></p>
                            <p class="card-text"><small class="text-time">By_<em><?php echo $row['course_by']; ?></em></small></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>-->
        <div class="row dailyevnt text-center">
            <div class="col-md-4">
                <div class="inner-speakers">
                    <h2>Day 1</h2>
                    <h3>Friday, February 13, 2015</h3>
                    <h3>15:00 hrs - Inaugural Session</h3>
                    <ul>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Awaz Uthane Do, a musical feature by<br>Sharvari Jamenis</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                    </ul>
                </div>
                <button class="btn btn-warning showmore" style="margin-top: 10px;width: 100%;">Show More</button>
            </div>
            <div class="col-md-4">
                <div class="inner-speakers">
                    <h2>Day 2</h2>
                    <h3>Saturday, February 14, 2015 </h3>
                    <h3>09:00 hrs- Presentations by</h3>
                    <ul>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Awaz Uthane Do, a musical feature by<br>Sharvari Jamenis</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                    </ul>
                </div>
               <button class="btn btn-warning showmore" style="margin-top: 10px;width: 100%;">Show More</button> 
            </div>
            <div class="col-md-4">
                <div class="inner-speakers">
                    <h2>Day 3</h2>
                    <h3>Sunday, February 15, 2015</h3>
                    <h3>09:00 hrs- Musical presentation by Rotaract Club of Enlightened (Do not miss this mesmerizing show)</h3>
                    <ul>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Awaz Uthane Do, a musical feature by<br>Sharvari Jamenis</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                        <li>Chair, Convenor PRID Shekhar Mehta</li>
                        <li>National Anthems of Sri Lanka and India</li>
                    </ul>
                </div>
                <button class="btn btn-warning showmore" style="margin-top: 10px;width: 100%;">Show More</button>
            </div>
        </div>
        <div class="row clearfix" style="margin: 25px 0;">
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1info" data-toggle="tab">Day 1</a></li>
                            <li><a href="#tab2info" data-toggle="tab">Day 2</a></li>
                            <li><a href="#tab3info" data-toggle="tab">Day 3</a></li>
                            <!--li class="dropdown">
                                <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab4info" data-toggle="tab">Day 4</a></li>
                                    <li><a href="#tab5info" data-toggle="tab">Day 5</a></li>
                                </ul>
                            </li-->
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1info">
                            <h1>Day 1</h1>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2info">
                            <h1>Day 2</h1>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inner-content">
                                    <h4 class="text-center">Day Two Plenary 2&3</h4>
                                    <img src="uploads/chapter_documents/comp_1/default_image/default_course.jpg">
                                    <div class="inner-desc">
                                        <h3>Speaker 1</h3>
                                        <p>Description of each speaker's</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab3info">Day 3</div>
                        <!--div class="tab-pane fade" id="tab4info">Day 4</div>
                        <div class="tab-pane fade" id="tab5info">Day 5</div-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="span12">
                <div class="well">
                    <div id="ourCarousel" class="carousel fdi-Carousel slide">
                     <!-- Carousel items -->
                        <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                            <div class="carousel-inner onebyone-carosel">
                                     <?php foreach ($course_list as $key=>$row) { ?>
                                      <div class="item <?php if($key==1){ echo 'active';} ?>">
                                        <div class="col-md-4">
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
                                                <div class="card-block" style="border-top: 2px solid #f50f0f;">
                                                    <div class="news-title">
                                                        <h3 class=" title-small"><a href="#"><?php echo substr($row['description'], 0, 15); ?></a></h3>
                                                    </div>
                                                    <p class="card-text"><small class="text-time"><em><?php echo $row['created_at']; ?></em></small></p>
                                                    <p class="card-text"><small class="text-time">By_<em><?php echo $row['course_by']; ?></em></small></p>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    <?php } ?>
                                
<!--                                <div class="item active">
                                    <div class="col-md-4">
                                        <a href="#"><img src="http://placehold.it/250x250" class="img-responsive center-block"></a>
                                        <div class="text-center">1</div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-md-4">
                                        <a href="#"><img src="http://placehold.it/250x250" class="img-responsive center-block"></a>
                                        <div class="text-center">2</div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-md-4">
                                        <a href="#"><img src="http://placehold.it/250x250" class="img-responsive center-block"></a>
                                        <div class="text-center">3</div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-md-4">
                                        <a href="#"><img src="http://placehold.it/250x250" class="img-responsive center-block"></a>
                                        <div class="text-center">4</div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-md-4">
                                        <a href="#"><img src="http://placehold.it/250x250" class="img-responsive center-block"></a>
                                        <div class="text-center">5</div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-md-4">
                                        <a href="#"><img src="http://placehold.it/250x250" class="img-responsive center-block"></a>
                                        <div class="text-center">6</div>
                                    </div>
                                </div>-->
                            </div>
                            <a class="left carousel-control" href="#eventCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#eventCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--/carousel-inner-->
                    </div><!--/ourCarousel-->
                </div><!--/well-->
            </div>
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
    $('#ourCarousel').carousel({
        interval: 10000
    })
    $('.fdi-Carousel .item').each(function () {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        if (next.next().length > 0) {
            next.next().children(':first-child').clone().appendTo($(this));
        }
        else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });
</script>
<style type="text/css">
    .carousel-inner.onebyone-carosel { margin: auto; width: 90%; }
    .onebyone-carosel .active.left { left: -33.33%; }
    .onebyone-carosel .active.right { left: 33.33%; }
    .onebyone-carosel .next { left: 33.33%; }
    .onebyone-carosel .prev { left: -33.33%; }
    .right .glyphicon.glyphicon-chevron-right {
        right: 0%;
    }
    .left .glyphicon.glyphicon-chevron-left {
        left: 10%;
    }
    .well {
        background: transparent;
        border: transparent;
        border-radius: 0;
        box-shadow: none;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
       $('.showmore').click(function() {
            if($(this).parent().find('.inner-speakers').hasClass('mores')) {
                    $(this).parent().find('.inner-speakers').removeClass('mores');
                    $(this).text('Show More');
            }
            else {
                    $(this).parent().find('.inner-speakers').addClass('mores');
                    $(this).text('Show Less');
            }
        }); 
    });
</script>
</body>
</html>


