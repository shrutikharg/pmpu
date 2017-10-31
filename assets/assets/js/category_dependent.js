       $.ajax({
            type: "POST",
            url: "../category/dropdown_list",
            dataType: "json",
            success: function (data) {
                var result = "<option value=''>Select</option>";
                $.each(data.rows, function () {
                    result += "<option value=" + this.id + ">" + this.name + "</option>";

                });
                $("#department").append(result);
            }
        });
        $("#department").change(function () {

            $.ajax({
                type: "POST",
                url: "../subcategory/dropdown_list",
                data: {'category': $("#department").val()},
                dataType: "json",
                success: function (data) {

                    $("#sub_department").empty();
                    var result = "<option value=''>Select</option>";
                    $.each(data.rows, function () {
                        result += "<option value=" + this.id + ">" + this.name + "</option>";
                    });
                  
                    $("#sub_department").append(result);
                }
            });
        });
        $("#sub_department").change(function () {

            $.ajax({
                type: "POST",
                url: "../courses/dropdown_list",
                data: {'sub_category': $("#sub_department").val()},
                dataType: "json",
                success: function (data) {
                    $("#course").empty();
                    var result = "<option value=''>Select</option>";
                    $.each(data.rows, function () {
                        result += "<option value=" + this.id + ">" + this.name + "</option>";

                    });
                    $("#course").append(result);
                }
            });
        });
        $("#course").change(function () {

            $.ajax({
                type: "POST",
                url: "../chapters/dropdown_list",
                data: {'course': $("#course").val()},
                dataType: "json",
                success: function (data) {
                    $("#chapter").empty();
                    var result = "<option value=''>Select</option>";
                    $.each(data.rows, function () {

                        result += "<option value=" + this.id + ">" + this.name + "</option>";
                    });
                    $("#chapter").append(result);
                 
                }
            });
        });


