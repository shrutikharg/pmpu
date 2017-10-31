<script>
    
    var total_page_count;
    </script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/css/videolayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/css/CourseTopic.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pdf.js/node_modules/pdfjs-dist/web/pdf_viewer.css">

<script src="<?php echo base_url(); ?>assets/pdf.js/node_modules/pdfjs-dist/build/pdf.js"></script>
  <script src="<?php echo base_url(); ?>assets/pdf.js/node_modules/pdfjs-dist/web/pdf_viewer.js"></script>
   <script src="<?php echo base_url(); ?>assets/pdf.js/examples/node/getinfo.js"></script>
<section id="main" class="clearfix" style="background:#d7e4e9">
    <div id="content" style="background:#d7e4e9">    
        <div class="col-sm-12  col-md-12">
            <div class="show-top-grids">
                <div class="col-sm-9 Topic-left">
                    <div class="song">
                        <div class="song-info">
                            <h3>Topic 1</h3>	
                        </div>                                            
                        <!-----Data---->
                        <div id="view1">
                            <div class="scrollbars">
                                <ol id="viewul">
                                    <?php //var_dump($listchapter);?>	
                                    <?php
                                    foreach ($listchapter as $chaptlis) {
                                        // echo '<a href="'.site_url("employee_company").'/courses/takecourses/'.$row['chapterid'].'" class="btn btn-primary">Start</a>';
                                        echo '<li>';
                                        echo '<a href="' . site_url("employee_company") . '/courses/takecourses/' . $chaptlis['id'] . '" title="' . $chaptlis['name'] . '" >' . $chaptlis['name'] . '</a>';
                                        //echo '<img src="'.base_url().'assets/images/pdfimage.jpg" alt="logo" name="'.$chaptlis['chapter_document'].'" />';
                                        if (!empty($chaptlis['chapter_document'])) {
                                            echo '<a href="' . base_url() . '/assets/chapter_documents/' . $chaptlis['chapter_document'] . '"title="' . $chaptlis['name'] . '" target="_blank">';
                                            echo '&nbsp;&nbsp;<img src="' . base_url() . 'assets/images/pdfimage.jpg" alt="logo" name="' . $chaptlis['chapter_document'] . '" /></a>';
                                        }
                                        echo '</li>';
                                    }
                                    ?>							
                                </ol></div>	
                        </div> 
                    </div>

                    <?php
                    foreach ($chaptertake as $row) {
                        $vnum = $row['chaptervideo'];
                        $course_id = $row['courseid'];
                        $vurls = '';
                        $itm = 0;
                        $i = 0;
                        foreach ($listchapter as $row1) {
                            //player.vimeo.com/video/118458220?title=0&byline=0&portrait=0&autoplay=1
                            if ($vurls == '')
                                $vurls = $this->encryption->decrypt($ciphertext);
                            else
                                $vurls .= $this->encryption->decrypt($ciphertext);
                            if ($row1['chapter_videoid'] == $vnum) {
                                $itm = $i;
                            }
                            $i = $i + 1;
                        }
                    }
                    /* ,https://vimeo.com/118457672,https://vimeo.com/118890158 */
                    ?>

                    <input type="hidden" id="vurls" name="vurls" value="<?php echo $vurls; ?>" />
                    <input type="hidden" id="item_num" name="item_num" value="<?php echo $itm; ?>" />
                    <script src="https://player.vimeo.com/api/player.js"></script>

                    <script>  var previous_chapter_user_page_details_array = [], previous_chapter_user_page_details_array;
                        var flag = false;
                        var current_time = 0, user_slide_activity_details;
                        var previous_page_no, current_page_no = 0;
                        var percentage_completed, course_progress_percentage;                     
                        var chapter_id = "<?php echo $chaptertake[0]['chapterid']; ?>", previous_chappter_id;
                        var course_id = "<?php echo $chaptertake[0]['courseid']; ?>";          
                        $(document).ready(function () {
a="<?php echo base_url(); ?>assets/pdf.js/web/viewer.html?file="+"<?php echo base_url(); ?>"+"uploads/ngcourse2.pdf";
                              $('#player1').attr('src',a);
                          //  get_player_object(file_type);
						  $('#player1').on("load", function() {
    PDFJS.getDocument(url).then(function (pdfDoc_) {
    pdfDoc = pdfDoc_;
    alert( pdfDoc.numPages);
    // Initial/first page rendering
   
  });

});
 

                            //   window.open( "http://localhost/companyadminapp1/assets/chapter_documents/61/39/51/course/index_lms.html","_blank");
                            // var api = SCORMRuntimeAPIInstance(window);//check whether API OBJECT IS AVILABLE FOR IFRAME
                            // $('#player1').attr('src','course/index_lms.html');
                            var checkCloseX = 0;
                            $(document).mousemove(function (e) {//alert(e.pageY);
                                if (e.pageY <= 5) {
                                    checkCloseX = 1;
                                } else {
                                    checkCloseX = 0;
                                }
                            });

                            window.onbeforeunload = function (event) {

                                if (event) {
                                    previous_chappter_id = chapter_id;
                                    previous_chapter_user_page_details_array = chapter_user_page_details_array;
                                    save_user_slide_details(previous_chappter_id);


                                }
                            };
                         

                            $('.Topic-grid-right').find('a.title').click(function (e) {
                                previous_chappter_id = chapter_id;
                                previous_chapter_user_page_details_array = chapter_user_page_details_array;

                                user_slide_activity_details = null;
                                chapter_id = $(this).attr('chapter_id');




                                save_user_slide_details(previous_chappter_id);


                                var form = $(document.createElement('form'));
                                $(form).attr("action", "../courses/takecourses");
                                $(form).attr("method", "POST");
                                $(form).attr("id", "form1");
                                var input = $("<input>").attr("type", "hidden").attr("name", "chapter_id").val(chapter_id);
                                $(form).append($(input));
                                $(form).append($("<input>").attr("type", "hidden").attr("name", "course_id").val(course_id));
                                $(form).appendTo("body").submit();
                            });
                            $('#comment_form').submit(function (e) {
alert(chapter_id);
                                e.preventDefault();

                                $.ajax({
                                    type: "POST",
                                    url: "../../admin_company/set_user_chapter_comments",
                                    data: {'chapter_id': chapter_id, "comment": $("#comment_text").val()},
                                    dataType: "json",
                                    success: function (data) {

                                        var comment_details = JSON.parse(data.comments);
                                        $('#comment_text').val('');
                                        $('.media-grids').empty();
                                        $.each(comment_details, function (i, row) {
                                            var category_id = '"' + row['id'] + '"';
                                            $(".media-grids").append("<div class='media'>\n\
                 <h5>" + row['comment_by'] + "</h5>\n\
<div class='media-body'>\n\
</p>" + row['comment_text'] + "</p></div></div>");


                                        });



                                    },
                                    error: function () {
                                        alert('error handing here1');
                                    }
                                });


                            });
                            $('#btn_all_comment').click(function () {
                                $.ajax({
                                    type: "POST",
                                    url: "../../employee_company/get_user_chapter_comments",
                                    data: {'chapter_id': chapter_id},
                                    dataType: "json",
                                    success: function (data) {
                                        $("#comment_text").attr("value", "");
                                        var comment_details = JSON.parse(data.comments);
                                        //   alert(comment_details[1]['comment_text']);
                                        $('.media-grids').empty();
                                        $.each(comment_details, function (i, row) {
                                            var category_id = '"' + row['id'] + '"';
                                            $(".media-grids").append("<div class='media'>\n\
                 <h5>" + row['comment_by'] + "</h5>\n\
<div class='media-body'>\n\
</p>" + row['comment_text'] + "</p><span>Commented At:" + row['commented_at'] + "</span></div></div>");


                                        });



                                    },
                                    error: function () {
                                        alert('error handing here1');
                                    }
                                });


                            })

                        });

                        function get_value(cmi_parameter) {
                            var cmi_param_value;
                            var res = replaceall(cmi_parameter, '.', '_');
                            $.ajax({
                                type: "POST",
                                url: "../../course_details/get_cmi_values/" + chapter_id,
                                data: {'cmi_parameter': res},
                                async: false,
                                dataType: "text",
                                success: function (data) {
                                    cmi_param_value = data;
                                },
                                error: function () {
                                    alert('error handing here1');
                                }
                            });
                            return  cmi_param_value;
                        }
                        function set_value(cmi_parameter, cmi_value) {
                            if ((cmi_parameter == "cmi.suspend_data") && (cmi_value.includes('^'))) {
                                previous_page_no = current_page_no;
                                //  current_page_no = get_slide_id(cmi_value);
                                current_page_no = cmi_value;


                                last_acessed_time = current_time;
                                current_time = (new Date()).getTime();
                                last_acessed_time_seconds = Math.round((current_time - last_acessed_time) / 1000);



                                if (flag === true) {
                                    if (previous_page_no !== 0) {
                                        percentage_completed = add_object_to_user_details(previous_chapter_user_page_details_array, chapter_slide_details, previous_page_no);
                                    }
                                } else {
                                    if (previous_page_no !== 0) {
                                        alert('in else loop');
                                        percentage_completed = add_object_to_user_details(previous_chapter_user_page_details_array, chapter_slide_details, previous_page_no);
                                        alert(percentage_completed);
                                    }
                                }
                            }
                            var res = replaceall(cmi_parameter, '.', '_');

                            var cmi_data = {'cmi_parameter': res, 'cmi_value': cmi_value};

                            $.ajax({
                                type: "POST",
                                async: false,
                                url: "../../course_details/set_cmi_values/" + chapter_id,
                                data: cmi_data,
                                dataType: "text",
                                success: function (data) {
                                    return  data;

                                },
                                error: function (xhr, status, error) { //window.location.href="<?php echo base_url(); ?>"+"employee/login";
                                    var err = eval("(" + xhr.responseText + ")");

                                    // Display the specific error raised by the server (e.g. not a
                                    //   valid value for Int32, or attempted to divide by zero).
                                    alert(err.Message);
                                }
                            });
                            if (cmi_parameter === "cmi.suspend_data" && percentage_completed !== undefined && user_slide_activity_details !== null) {
                                var cmi_data = {'user_slide_activity_details': JSON.stringify(user_slide_activity_details)};
                                $.ajax({
                                    type: "POST",
                                    async: false,
                                    url: "../../course_details/set_user_slide_activity_details/" + chapter_id,
                                    data: cmi_data,
                                    dataType: "text",
                                    success: function (data) {
                                        return  data;

                                    },
                                    error: function (xhr, status, error) {
                                        var err = eval("(" + xhr.responseText + ")");

                                        // Display the specific error raised by the server (e.g. not a
                                        //   valid value for Int32, or attempted to divide by zero).
                                        alert(err.Message);
                                    }
                                });
                            }
                        }
                        function replaceall(str, replace, with_this)
                        {
                            var str_hasil = "";
                            var temp;

                            for (var i = 0; i < str.length; i++) // not need to be equal. it causes the last change: undefined..
                            {
                                if (str[i] == replace)
                                {
                                    temp = with_this;
                                } else
                                {
                                    temp = str[i];
                                }

                                str_hasil += temp;
                            }

                            return str_hasil;
                        }
                        function get_slide_id(cmi_value) {
                            var index_of_dot = cmi_value.indexOf(".");
                            var index_of_and = cmi_value.indexOf("^");
                            var slide_id = cmi_value.substring(index_of_dot + 1, index_of_and - 1);
                            return slide_id;
                        }
                        function add_object_to_user_details(previous_chapter_user_page_details_array, chapter_slide_details, slide_id) {

                            for (i = 0; i <= chapter_slide_details.length - 1; i++) {

                                // if (slide_id === chapter_slide_details[i].id) {
                                if (slide_id.includes(chapter_slide_details[i].id)) {

                                    var chapter_user_slide_obj = previous_chapter_user_page_details_array.filter(function (obj) {
                                        return obj.id === chapter_slide_details[i].id;
                                    })[0];
                                    if (chapter_user_slide_obj === undefined) {
                                        var slide_detail_object = {'id': chapter_slide_details[i].id, 'name': chapter_slide_details[i].name, 'last_accessed_time': last_acessed_time_seconds, 'total_accessed_time': last_acessed_time_seconds};
                                        previous_chapter_user_page_details_array.push(slide_detail_object);

                                    } else {
                                        chapter_user_slide_obj.last_accessed_time = last_acessed_time_seconds;
                                        chapter_user_slide_obj.total_accessed_time = parseInt(chapter_user_slide_obj.total_accessed_time) + last_acessed_time_seconds;
                                        var slide_detail_object = chapter_user_slide_obj;

                                    }

                                    flag = true;
                                    percentage_completed = Math.round(((i + 1) * 100) / chapter_slide_details.length);



                                    user_slide_activity_details = {'percentage_completed': percentage_completed, 'user_slide_details_array': previous_chapter_user_page_details_array};
//console.log(user_slide_activity_details);
                                    return user_slide_activity_details;
                                }

                            }

                        }
                        function save_user_slide_details(previous_chappter_id) {

                            if (!(jQuery.isEmptyObject(previous_chapter_user_page_details_array))) {
                                previous_chapter_user_page_details_array = JSON.stringify(previous_chapter_user_page_details_array);
                                $.ajax({
                                    type: "post",
                                    url: "../../course_details/store_user_slide_details_array/" + previous_chappter_id,
                                    async: false,
                                    dataType: "text",
                                    data: {'user_slide_details_array': previous_chapter_user_page_details_array},
                                    success: function (result) {
                                        alert('details saved');
                                        if (result != null) {
                                        }
                                    }
                                });
                            } else {

                            }
                            //previous_chapter_user_page_details_array=null;

                            flag = false;
                        }
                        function get_player_object(file_type) {
                            if (file_type == 'e_course') {
                                window.API = new Object();//Here API Adapter  object is created for his window
                                window.API.LMSInitialize = function () {//alert("LMSInitialize");
                                    return true;
                                }
                                window.API.LMSGetValue = function (stringVal) {
                                    var cmi_param_val = get_value(stringVal);
                                    return  cmi_param_val;
                                }
                                window.API.LMSSetValue = function (data_model_element, value)
                                {
                                    set_value(data_model_element, value);
                                    return true;


                                }
                                window.API.LMSCommit = function (stringval) {
                                    return true;
                                }
                                window.API.LMSFinish = function () {
                                    // alert("lmscommit");
                                    return true;
                                }
                                window.API.LMSGetLastError = function () {
                                    //alert("LMSGetLastError");
                                    return "No error";
                                }
                                window.API.LMSGetErrorString = function () {
                                    //alert("LMSGetLastError");
                                    return "Element is read only";
                                }
                                window.API.LMSGetDiagnostic = function (strval) {
                                    //alert("LMSGetLastError");
                                    return "Element is read only";
                                }

                            } else if (file_type == 'video') {
                                var video_duration;
                                var player = new Vimeo.Player('player1');//203969762
                                var total_time = 0, previous_time = 0, previous_event, current_event;
                                player.on('play', function () {
                                    alert('in plat');

                                    setInterval(function () {
                                        total_time = total_time + 1;
                                        
                                    }, 1000);

                                });
                                player.on('pause', function () {
                                    player.getDuration().then(function (duration) {
                                        video_duration = duration;
                                    }).catch(function (error) {
                                        // an error occurred
                                    });
                                    player.getCurrentTime().then(function (seconds) {
                                        current_time = seconds;
                                        add_video_object_to_user_details(video_duration, current_time);
                                    }).catch(function (error) {
                                        // an error occurred
                                    });
                                    ///
                                });
                                player.on('seeked', function () {


                                });


                                player.on('ended', function (data) {

                                    player.getDuration().then(function (duration) {
                                        video_duration = duration;
                                    }).catch(function (error) {
                                        // an error occurred
                                    });
                                    player.getCurrentTime().then(function (seconds) {
                                        current_time=seconds;
                                        if (Math.ceil(seconds) ==Math.ceil(video_duration)) {
                                             add_video_object_to_user_details(Math.ceil(video_duration), Math.ceil(current_time));
                                            var cmi_data = {'cmi_parameter': 'cmi_core_lesson_status', 'cmi_value': 'completed'};

                                            $.ajax({
                                                type: "POST",
                                               
                                                url: "../../course_details/set_cmi_values/" + chapter_id,
                                                data: cmi_data,
                                                dataType: "text",
                                                success: function (data) {
                                                    return  data;

                                                },
                                                error: function (xhr, status, error) { //window.location.href="<?php echo base_url(); ?>"+"employee/login";
                                                    var err = eval("(" + xhr.responseText + ")");

                                                    // Display the specific error raised by the server (e.g. not a
                                                    //   valid value for Int32, or attempted to divide by zero).
                                                    alert(err.Message);
                                                }
                                            });

                                        }
                                    }).catch(function (error) {
                                        // an error occurred
                                    });
                                });

                                player.on('timeupdate', function (data) {
                                    //current_time=data.seconds;
                                    console.log('peso' + current_time)
                                });


                            } else {



                                
                            }



                        }
                        function add_video_object_to_user_details(video_duration, current_time) {
                            var chapter_user_slide_obj;
                            if (flag == false) {
                                chapter_user_slide_obj = {'last_accessed_time': current_time, 'total_accessed_time': /*parseInt(chapter_user_slide_obj.total_accessed_time) + */current_time};
                                previous_chapter_user_page_details_array.push(chapter_user_slide_obj);
                            } else {
                                previous_chapter_user_page_details_array[0].last_accessed_time = Math.round(current_time);
                                previous_chapter_user_page_details_array[0].total_accessed_time = Math.round(parseInt(previous_chapter_user_page_details_array[0].total_accessed_time) + current_time);

                            }


                            
                            flag = true;

                            percentage_completed = Math.round((current_time * 100) / video_duration);



                            user_slide_activity_details = {'percentage_completed': percentage_completed, 'user_slide_details_array': previous_chapter_user_page_details_array};
                            var cmi_data = {'user_slide_activity_details': JSON.stringify(user_slide_activity_details)};
                            $.ajax({
                                type: "POST",
                                async: false,
                                url: "../../course_details/set_user_slide_activity_details/" + chapter_id,
                                data: cmi_data,
                                cache: false,
                                dataType: "text",
                                success: function (data) {
                                    // return  data;

                                },
                                error: function (xhr, status, error) {
                                    var err = eval("(" + xhr.responseText + ")");

                                    // Display the specific error raised by the server (e.g. not a
                                    //   valid value for Int32, or attempted to divide by zero).
                                    alert(err.Message);
                                }
                            });




                        }
                        var v = document.getElementById('vurls').value;
                        var res = v.split(",");
                        var webpageArray = res;
                        var cnt = parseInt(document.getElementById('item_num').value);

                        function loadNextPage(dir) {
                            cnt += dir;

                            if (cnt < 0)
                                cnt = webpageArray.length - 1; // wrap
                            else if (cnt >= webpageArray.length)
                                cnt = 0; // wrap
                            var iframe = document.getElementById("player1");
                            iframe.src = webpageArray[cnt];
                            return false; // mandatory!
                        }
                        function get_pdfObject(pdfobj){
                            console.log(pdfobj);
                            
    }


                    </script>                 <!---- Data End --->
                    <div class="video-grid">
                        <div id="playerss" Style="background:rgba(0,0,0,0)!important;" >
                            <div id="player_display" style="float:left; width:100%; height: 650px; left: 0px; top: 0px; background: rgba(0, 0, 0, 0);">
                                <iframe id="player1" name="player1" src="javascript:;" width="100%" height="500px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            </div>               
                        </div>
                    </div>					
                    <div class="clearfix"> </div>
                    <div class="published">
                       
                        <script>
                        $(document).ready(function () {
                            size_li = $("#myList li").size();
                            x = 1;
                            $('#myList li:lt(' + x + ')').show();
                            $('#loadMore').click(function () {
                                x = (x + 1 <= size_li) ? x + 1 : size_li;
                                $('#myList li:lt(' + x + ')').show();
                            });
                            $('#showLess').click(function () {
                                x = (x - 1 < 0) ? 1 : x - 1;
                                $('#myList li').not(':lt(' + x + ')').hide();
                            });
                        });
                        </script>
                        <div class="load_more">	
                            <ul id="myList">
                                <li>
                                    <h4>Description</h4>
                                    <p><?php echo $chaptertake[0]['chapterdescription']; ?></p>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="all-comments">
                        <div class="all-comments-info">
                            <a href="#">Comment</a>
                            <div class="box">
                                <form id="comment_form">																	
                                    <textarea placeholder="Message" required=" " id ="comment_text"></textarea>
                                    <input type="submit" value="SEND">
                                    <div class="clearfix"> </div>
                                </form>
                            </div>							
                        </div><input type="button" value="View all Comments" id="btn_all_comment">
                        <div class="media-grids">
                            <?php
                            foreach (json_decode($chaptertake[0]['comments']) as $row) {
                                ?>
                                <div class="media">
                                    <h5><?php echo $row->comment_by ?></h5>

                                    <div class="media-body">
                                        <p><?php echo $row->comment_text ?></p>
                                        <span>View all posts by :<?php echo $row->commented_at; ?></span>
                                    </div>
                                </div>
    <?php
}
?>

                        </div>
                    </div>

                </div>
                <div class="col-md-3 Topic-right">
                    <h3>Related Topics</h3>
                    <div class="Topic-grid-right">
<?php foreach ($chapter_list as $row) {
    ?>
                            <div class="Topic-right-grids">
                                <div class="col-md-4 Topic-right-grid-left">
    <?php
    if (isset($row['chapterimage'])) {
        ?>
                                        <img src="<?php echo base_url() . $row['chapterimage']; ?>" >
                                        <?php
                                    } else {
                                        ?>
                                        <img src="<?php echo base_url(); ?>assets/chapter_documents/course_image/default_course.jpg" >
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-8 Topic-right-grid-right">
                                    <a  target="player1" chapter_id=<?php echo $row['chapterid'] ?> class="title"> <?php echo $row['chaptername'] ?></a>
                                    <p class="views">Date</p>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
    <?php
}
?>


                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>		
        </div>        
        <div class="clearfix"> </div>	
    </div>
</div>
<!-- Modal -->
<div class="container-modal">
    <div class="modal hide fade" id="js-ajax-modal">
        <div class="modal-header hide">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-header hide">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
        </div>
    </div>
</div>
</div>
</section>