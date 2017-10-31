<section id="main" class="clearfix">

    <div class="js-pjax-responses">
        <div class="big-space">
            <div class="row-fluid bot-space">    
                <div style="float: left;width: 100%;">  
                    <?php   $this->load->helper('url');?>
                    <div class="span5 wwell">
                        <h2>Course</h2>	

                        <div class="tabcontents">
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
                        <br><br>
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

                    <?php
                    /* $vurls = '';
                      $i = 0;
                      $itm = 0;
                      foreach ($videos->video as $video):

                      if($itm == 0)
                      {
                      $vurls = $video->url;
                      if (strpos($vurls, $vnum) !== FALSE)
                      {$itm = $i; }
                      }

                      $i = $i+ 1;
                      endforeach;

                      $str = $vurls;
                      $old = 'http:';
                      $new = 'https:';

                      $i = 1;

                      $tmpOldStrLength = strlen($old);

                      while (($offset = strpos($str, $old, $offset)) !== false) {
                      $str = substr_replace($str, $new, $offset, $tmpOldStrLength);
                      } */
                    ?>
                    <input type="hidden" id="vurls" name="vurls" value="<?php echo $vurls; ?>" />
                    <input type="hidden" id="item_num" name="item_num" value="<?php echo $itm; ?>" />


                    <script>  var chapter_user_slide_details_array = [];
                        var flag = false;
                        var current_time = 0;
                        var previous_slide_id, current_slide_id = 0;
                        var percentage_completed, course_progress_percentage;
                       // var chapter_slide_details =JSON.parse();
                     //  var chapter_slide_detail_data="<?php echo $chaptertake[0]['slide_details']; ?>";
                       
                      var chapter_slide_details = (new Function("return [" +"<?php echo $chaptertake[0]['slide_details']; ?>"+ "];")());
<?php if (is_null($user_slide_details)) { ?>


                            flag = false;
<?php } else {
    ?>

                            flag = true;
                            chapter_user_slide_details_array =<?php echo $user_slide_details; ?>;

                            //alert(chapter_user_slide_details_array[1].name)
                            //var newJson = chapter_user_slide_details_array.replace(/([a-zA-Z0-9]+?):/g, '"$1":');
                            //var chapter_user_slide_details_array = JSON.parse(newJson);
                            //alert(typeof (chapter_user_slide_details_array));
<?php } ?>


                        $(document).ready(function () {
                            window.name = "SHRUTI";
var a="../../../<?php echo $chaptertake[0]['file_name']; ?>"; 
                           
                            $('#player1').attr('src',a);
                             
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



                                    if (!(jQuery.isEmptyObject(chapter_user_slide_details_array))) {console.log(chapter_user_slide_details_array);
                                        chapter_user_slide_details_array = JSON.stringify(chapter_user_slide_details_array);
                                        $.ajax({
                                            type: "post",
                                            url: "../../../course_details/store_user_slide_details_array/"+<?php echo $this->uri->segment(4);?>,
                                            dataType: "text",
                                            data: {'user_slide_details_array': chapter_user_slide_details_array},
                                            success: function (result) {
                                                if (result != null) {
                                                }
                                            }
                                        });
                                    }
                                }
                            };
                            $("#check").click(function(){
                          console.log('sdsds'+chapter_user_slide_details_array);
                            });
                          
                        });

                        function get_value(cmi_parameter) {
                            var cmi_param_value;
                            var res = replaceall(cmi_parameter, '.', '_');
                            $.ajax({
                                type: "POST",
                                url: "../../../course_details/get_cmi_values/"+<?php echo $this->uri->segment(4);?>,
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
                                previous_slide_id = current_slide_id;
                                current_slide_id = get_slide_id(cmi_value);
                                last_acessed_time = current_time;
                                current_time = (new Date()).getTime();
                                last_acessed_time_seconds = Math.round((current_time - last_acessed_time) / 1000);



                                if (flag === true) {
                                    if (previous_slide_id !== 0) {
                                        percentage_completed = add_object_to_user_details(chapter_user_slide_details_array, chapter_slide_details, previous_slide_id);
                                    }
                                } else {
                                    if (previous_slide_id !== 0) {
                                        percentage_completed = add_object_to_user_details(chapter_user_slide_details_array, chapter_slide_details, previous_slide_id);
                                    }
                                }
                            }
                            var res = replaceall(cmi_parameter, '.', '_');

                            var cmi_data = {'cmi_parameter': res, 'cmi_value': cmi_value};

                            $.ajax({
                                type: "POST",
                                async: false,
                                url: "../../../course_details/set_cmi_values/"+<?php echo $this->uri->segment(4);?>,
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
                            if (cmi_parameter === "cmi.suspend_data" && percentage_completed!==undefined) {
                           var cmi_data = {'cmi_parameter':'course_attempt_details', 'cmi_value':percentage_completed};
                                $.ajax({
                                    type: "POST",
                                    async: false,
                                    url: "../../../course_details/set_cmi_values/"+<?php echo $this->uri->segment(4);?>,
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
                        function get_slide_id(cmi_value) {//alert();
                            var index_of_dot = cmi_value.indexOf(".");
                            var index_of_and = cmi_value.indexOf("^");
                            var slide_id = cmi_value.substring(index_of_dot + 1, index_of_and - 1);
                            return slide_id;
                        }
                        function add_object_to_user_details(chapter_user_slide_details_array, chapter_slide_details, slide_id) {


                            for (i = 0; i <= chapter_slide_details.length-1 ; i++) {
                
                                if (slide_id === chapter_slide_details[i].id) {

                                    var chapter_user_slide_obj = chapter_user_slide_details_array.filter(function (obj) {alert(slide_id+"--"+obj.id)
                                        return obj.id === slide_id;
                                    })[0];
                                   
                                      if (chapter_user_slide_obj === undefined) {
                                        var slide_detail_object = {'id': slide_id, 'name': chapter_slide_details[i].name, 'last_accessed_time': last_acessed_time_seconds, 'total_accessed_time': last_acessed_time_seconds};
                                        chapter_user_slide_details_array.push(slide_detail_object);
                                    } else {
                                        chapter_user_slide_obj.last_accessed_time = last_acessed_time_seconds;
                                        chapter_user_slide_obj.total_accessed_time = parseInt(chapter_user_slide_obj.total_accessed_time) + last_acessed_time_seconds;
                                        var slide_detail_object = chapter_user_slide_obj;
                                        //console.log(chapter_user_slide_details_array);
                                    }

                                    flag = true;
                                  percentage_completed =Math.round (((i+1) * 100) / chapter_slide_details.length);
                                 // alert( percentage_completed);

                                }

                               
                            }
 return percentage_completed;

                        }
                        var v = document.getElementById('vurls').value;
                        var res = v.split(",");
                        var webpageArray = res;
                        var cnt = parseInt(document.getElementById('item_num').value);

                        function loadNextPage(dir) {
                            cnt += dir;
                            //alert(cnt);
                            if (cnt < 0)
                                cnt = webpageArray.length - 1; // wrap
                            else if (cnt >= webpageArray.length)
                                cnt = 0; // wrap
                            var iframe = document.getElementById("player1");
                            iframe.src = webpageArray[cnt];
                            return false; // mandatory!
                        }


                    </script>
                    <div class="span18 browse-right" itemscope="" itemtype="http://schema.org/EducationalOrganization">
                        <div class="wwell no-mar">		    

                            <div id="playerss" >
                                <div id="player_display" style="float:left; width:100%; height: 500px; left: 0px; top: 0px; background: rgb(0, 0, 0);">
                                    <iframe id="player1" src="javascript:;" width="100%" height="500px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                </div>
                                <!--- 
                                 <div style="float:right; width: 150px; height: 40px;margin-top: 0px;z-index: 1; padding-top:10px;">  
                                    <a href="#" onclick="return loadNextPage(-1)" style="color:White;"> << Previous </a> | 
                                    <a href="#" onclick="return loadNextPage(1)" style="color:White;"> Next >> </a> 
                                </div>
                                    --->
                            </div>
                            <input type="button" id="check"/>

                            <?php
//form data
                            $attributes = array('class' => 'form-horizontal', 'id' => '');

//form validation
                            echo validation_errors();

                            echo form_open('employee_company/courses/empcomments', $attributes);
//var_dump($chaptertake);
                            ?>
                            <div style="background: #ffffff;">	
                                <div class="form-wraper row" id="register-form">
                                    <div class="control-group">
                                        <label style="padding-left: 14px;" for="inputError" class="control-label span7">Rating</label>
                                        <div class="controls span10">						
                                            <input value="5" class="star star-5" id="star-5" type="radio" name="star">
                                            <label class="star star-5" for="star-5"></label>
                                            <input value="4" class="star star-4" id="star-4" type="radio" name="star">
                                            <label class="star star-4" for="star-4"></label>
                                            <input value="3" class="star star-3" id="star-3" type="radio" name="star">
                                            <label class="star star-3" for="star-3"></label>
                                            <input value="2" class="star star-2" id="star-2" type="radio" name="star">
                                            <label class="star star-2" for="star-2"></label>
                                            <input value="1" class="star star-1" id="star-1" type="radio" name="star">
                                            <label class="star star-1" for="star-1"></label>					   
                                        </div>
                                    </div>	
                                    <p>&nbsp;</p>	
                                    <input type="hidden" name="courseid" value="<?php echo $chaptertake[0]['chapterid']; ?>" >
                                    <input type="hidden" name="coursesubcat" value="<?php echo $chaptertake[0]['subcatid']; ?>" >
                                    <input type="hidden" name="coursename" value="<?php echo $chaptertake[0]['chaptername']; ?>" >

                                    <div class="control-group span23">

                                        <label for="inputError" class="control-label ">Comments</label>
                                        <p>&nbsp;</p>
                                        <br/> <br/> 
                                        <div class="controls">
                                            <textarea id="" rows="10" required="required" class="form-control  span23" name="comments"><?php echo set_value('comments'); ?></textarea>	      

<!--<span class="help-inline">Woohoo!</span>-->

                                        </div>
                                    </div>	


                                    <div class="control-group span17">

                                        <p>&nbsp;</p>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>

                                </div>	
                            </div>
                            <?php echo form_close(); ?>
                            <h4>All Comments</h4><br/>
                            <?php
                            foreach ($listcomments as $row) {
                                ?>
                                <div class="widget-content">

                                    <blockquote>
                                        <p><?php echo $row['comments']; ?></p>
                                        <p>Ratings -&nbsp;<?php echo $row['rating_star']; ?></p><br/>
                                        <h6>Posted By -<?php echo $row['created_by']; ?><cite title="Source Title">&nbsp;&nbsp;&nbsp;On Date -<?php echo date("d/m/Y", strtotime($row['created_date'])); ?></cite></h6><br>

                                    </blockquote>
                                    <br/>
                                    <?php
                                }
                                ?>
                                <br/>
                            </div>		 
                        </div><br/>
                    </div>
                </div>

             <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


            </div>


        </div>	

    </div>
    <!-- Modal -->
    <div class="container-modal">
        <div class="modal hide fade" id="js-ajax-modal">
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