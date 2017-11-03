<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/css/CourseTopic.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/libs/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/datepicker/jquery.datetimepicker.css"/>
<script>
    $(document).ready(function (e) {
    });
</script>
<script>
    function view_chapter(chapter_id,course_id) {
        var form = $(document.createElement('form'));
        $(form).attr("action", "../employee_company/courses/view_chapters");
        $(form).attr("method", "POST");
        $(form).attr("id", "form1");
        var input = $("<input>").attr("type", "hidden").attr("name", "chapter_id").val(chapter_id);
        $(form).append($(input));
        $(form).append($("<input>").attr("type", "hidden").attr("name", "course_id").val(course_id));
        $(form).appendTo("body").submit();
     }
</script> 
<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet"> 
<style type="text/css">
.hover-div {
        min-width:100%;
        min-height:100%;
        margin-bottom: 10px;
        background: rgba(0,0,0,0.6);
        position: absolute;
        z-index:1000;     
        display:block;   
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        text-align: center;
        padding:45px;
     } 
     .text-content  {
                        padding: 10px 10px;
                        background:#3fc8ef;
                        color:#ffffff!important;
                      }
      .chapter_title{
                       text-transform:capitalize;
                       font-family: 'Prompt', sans-serif;
                       font-size:22px;
                    }
            .chapter_start{    
                            background:none;
                            border:none;   
                            font-size:45px!important;
                            color:#f5f5f5!important;
                         }
   </style>
   <div id="content" style="background:#d7e4e9">
    <div class="container">
        <div class="row">
        <ul class="breadcrumb">            
                  <li>
                     <a href="#">   <?php echo $this->lang->line('nav_course');?>                  
                   </a> 
               
            </li>            
            <li class="active">
                <a href="#">   <?php echo $this->lang->line('nav_chapter');?>                  
                   </a> 
            </li>
        </ul>            
        </div>
        <div class="page-header users-header">
            <h2>
                <?php echo $this->lang->line('lbl_chapter_lst'); ?> for <ins><?php echo $course_data[0]['name']; ?></ins>
            </h2>
        </div>        
        <div class="row">
            <?php
            //flash messages
            if (isset($flash_message)) {
                if ($flash_message == TRUE) {
                            echo '<div class="alert alert-success">';
                            echo '<a class="close" data-dismiss="alert">�</a>';
                            echo '<strong>Well done!</strong> Chapter Scheduled with success.';
                            echo '</div>';
                } else {
                            echo '<div class="alert alert-error">';
                            echo '<a class="close" data-dismiss="alert">�</a>';
                            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                            echo '</div>';
                       }
                   }
            ?>
               <br/>
                <?php  if(!(empty($topiclist))) {               
                      foreach ($topiclist as $row) {                
                 ?>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="widget box" id="<?php echo $row['chapterid']; ?>">
                        <div class="chaptername" id="<?php echo $row['chaptername']; ?>">
                            <div class="courseid" id="<?php echo $row['courseid']; ?>">
                                <div class="chaptervideo" id="<?php echo $row['chaptervideo'] ?>">                                  
                                    <div class="widget-content no-padding">
                                        <div class="chapterimg">
                                            <div class="hover-div"> 
                                                <a href="#" > 
                                                     <?php
                                                          echo '<button type="button" id="couurse_id" class="chapter_start" onClick="view_chapter(' . $row['chapterid'] .",".$row['courseid']. ')"  > <span class="glyphicon glyphicon-play-circle"> </span></button>';
                                                      ?>                                                  
                                                </a>
                                              </div>                                            
                                                    <?php                                             
                                                            if (isset($row['chapterimage'])) {
                                                       ?>
                                                       <img src="<?php echo base_url().$row['chapterimage']; ?>" >
                                                       <?php
                                                       } else {
                                                        ?>
                                                       <img src="<?php echo base_url(); ?>assets/chapter_documents/course_image/default_course.jpg" >
                                                       <?php
                                                      }
                                                   ?>  
                                               </div>
                                                 </div>
                                                    <div class="text-content">
                                                       <h5 class="chapter_title">
                                                           <?php echo $row['chaptername']; ?></h5>                                                               
                                                       <h5><?php echo substr($row['chapterdescription'], 0,30); ?>...</h5>
                                                    </div>                                                              
                                          </div>
                                </div>
                            </div>
                        </div>
                    </div>                
               <?php
                   }
                }
                else{
                    echo "<h2 style='font-weight: bold; color: brown; text-align: center; text-shadow: 1px 1px 1px #fff, 3px 3px 5px #ff3f00'>No chapters Added Yet</h2>";
                }
              ?>
        </div> 
        <div class="all-comments">
              <div class="all-comments-info">
                  <a href="#">Comments</a>
                  <div class="box">
                      <form id="comment_form">													
                          <textarea placeholder="Post Comment" required=" " id ="comment_text" maxlength="250"></textarea>
                          <input type="submit" value="SEND">
                          <div class="clearfix"> </div>
                      </form>
                  </div>							
              </div>
              <div class="comment-nav">
                  <span class="pull-left">  <input type="button" id="prev_comment" value="&larr; Previous" ></span>  <span class="pull-right"> <input type="button" value="Next &rarr;" id="nxt_comment"></span>
              </div>
          <!--<input type="button" value="View all Comments" id="btn_all_comment"> -->
              <div class="media-grids">
                  <div class="media">
                        <div class="media-body">
                            <p>Test Comment</p>
                            <span class="pull-left"><b>Commented By:</b> shrutikharge@gmail.com </span>
                            <span class="pull-right">    2017-10-27</span>
                        </div>
                    </div>
                  <?php
                  $i = 1;
                  foreach (array_reverse(json_decode($chaptertake[0]['comments'])) as $row) {
                      if ($i <= 5) {
                          ?>
                          <div class="media">


                              <div class="media-body">
                                  <p><?php echo $row->comment_text ?></p>
                                  <span class="pull-left"><b>Commented By:</b> <?php echo $row->comment_by ?> </span>
                                  <span class="pull-right">    <?php echo $row->commented_at; ?></span>
                              </div>
                          </div>
                          <?php
                      }
                      $i++;
                  }
                  ?>
              </div>
          </div>
        </div>
       </div>   
        <script src="<?php echo base_url(); ?>assets/assets/datepicker/jquery.datetimepicker.full.js"></script>
        <script src="<?php echo base_url(); ?>assets/assets/datepicker/jquery.datetimepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/assets/datepicker/jquery.datetimepicker.js"></script>        
        <script>        
            $.datetimepicker.setLocale('en');
            $('#datetimepicker_format').datetimepicker({value: '2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
            $("#datetimepicker_format_change").on("click", function (e) {
                $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
            });
            $("#datetimepicker_format_locale").on("change", function (e) {
                $.datetimepicker.setLocale($(e.currentTarget).val());
            });
            $('#datetimepicker').datetimepicker({
                dayOfWeekStart: 1,
                lang: 'en',
                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
            });
            $('#default_datetimepicker').datetimepicker({
                formatTime: 'H:i',
                formatDate: 'd.m.Y',               
                defaultDate: '+03.01.1970', // it's my birthday
                defaultTime: '10:00',
                timepickerScrollbar: false
            });
            var logic = function (currentDateTime) {
                if (currentDateTime && currentDateTime.getDay() == 6) {
                    this.setOptions({
                        minTime: '11:00'
                     });
                } else
                    this.setOptions({
                          minTime: '8:00'
                      });
                };
            $('#datetimepicker_dark').datetimepicker({theme: 'dark'})
          // when .modal-wide opened, set content-body height based on browser height; 200 is appx height of modal padding, modal title and button bar
            $(document).ready(function () {
                $(".modal-wide").on("show.bs.modal", function () {
                    var height = $(window).height() - 200;
                    $(this).find(".modal-body").css("max-height", height);
                   });
                $(this).val();                
                $(".scheduledOn").click(function ()
                         {                
                            var bla = $('#scheduledid').val();
                            var div_id = $('.scheduledid').attr("id");
                            var idt = $(this).closest('.widget').attr("id");
                            var bla1 = $('#chaptername').val();
                            var div1 = $('.chaptername').attr("id");
                            var idt2 = $(this).closest('.chaptername').attr("id");SS
                            var blcsid = $('#courseid').val();
                            var csid1 = $('.courseid').attr("id");
                            var idt3 = $(this).closest('.courseid').attr("id");
                            var blvid = $('#chaptervideo').val();
                            var chvid = $('.chaptervideo').attr("id");
                            var idt4 = $(this).closest('.chaptervideo').attr("id");                  
                            $("#ChapterId").val(idt);
                            $("#ChapterName").val(idt2);
                            $("#CourseId").val(idt3);
                            $("#ChapterVideo").val(idt4);                     
                      });
                  });                  
        </script>