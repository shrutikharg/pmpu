/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('#maximize').click(function () {
        toggleWindow($(this));
    });
    function toggleWindow(element) {
        var e = element.children().attr('class');
        if (e == 'fa fa-expand') {
            element.children().parents().find('div.msgcontainer').css({'width': '85%', 'height': '71%'});
            element.children().parents().find('textarea').css('height', '490px');
            element.children().removeClass('fa-expand').addClass('fa-compress');
        } else {
            element.children().parents().find('div.msgcontainer').removeAttr('style');
            element.children().parents().find('textarea').removeAttr('style');
            element.children().removeClass('fa-compress').addClass('fa-expand');
        }
    }
    $('#hideData').click(function () {
        compressWindow($(this));
    });
    function compressWindow(element) {
        var e = element.children().attr('class');
        if (e == 'fa fa-minus') {
            $('.msgcontainer > div:not(div.msgstrip)').hide();
            $('.msgcontainer').css('height', 'auto');
            element.children().removeClass('fa-minus').addClass('fa-sort-up');
        } else {
            $('.msgcontainer > div:not(div.msgstrip)').show();
            $('.msgcontainer').removeAttr('style');
            element.children().removeClass('fa-sort-up').addClass('fa-minus');
        }
    }

    dragElement(document.getElementById(("msgcontainer")));

    function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

    $('.res_row:eq(0)').addClass('active');

    $('.replyDiv').click(function(){
	$(this).hide();
	$(this).parent().append($('#reply').show());
    });
    $('#discard').click(function(){
        $(this).parent().parent().prev().show();
        $(this).parent().parent().hide();
    });
});