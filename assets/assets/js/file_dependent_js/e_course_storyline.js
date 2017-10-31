$('#btnSubmit').click(function (e) {
     $('.myprogress').css('width', '0');
                    $('.msg').text('');
   uploaded_file_name=$('#userImage').attr('title'); 
 
                               if(uploaded_file_name!==undefined  )
                               {
                                 alert("already file ");  
                               }
                                var data = new FormData();                               
                                var file = $('#userImage')[0].files[0];
                              if(file!==undefined){
                                var fileName = file.name;
                                var fileExt = '.' + fileName.split('.').pop();
                                if (fileExt === '.zip') {
                                    data.append('SelectedFile', $('#userImage')[0].files[0]);
                                    data.append('course_id', $("[name='courseid']").val());
                                    $.ajax({                                        
                                        
                                        url: '../../admin_company/chapters/upload/',
                                        type: 'POST',
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        dataType: 'json',                                      
     
                   xhr: function () {           
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $('.myprogress').text(percentComplete + '%');
                                    $('.myprogress').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
        
                                        success: function (res) { $("#file_type").val('e_course');
                                            if (res.status === 'Success') {
                                              
                                                //$("#userImage").disabled=true;
                                                $("#userImage").prop("disabled", true);
                                                $("#btnSubmit").prop("disabled", true);
                                                $("#btnSubmit").disabled = true;
                                                $("#file_path").val(res.data);
                                            }
                                        },
                                        error: function (e) {
                                            alert(e.status + " error occurred to upload image!");
                                            // window.location.href=window.location.href;
                                        }
                                    });
                                } else
                                {
                                    return false;
                                }
                            }
                            });
                            /*$(".file_type").click(function(e){
                               var file_type=$(this).attr("id");
                               $("#file_type").val(file_type);
                            });*/