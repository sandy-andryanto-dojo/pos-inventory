$(document).ready(function () {

    CKEDITOR.replace('header-invoice');
    CKEDITOR.replace('footer-invoice');

    var selected = $("#theme-section").attr("data-selected");

    var skins_list = $("<ul />", {
        "class": 'list-unstyled clearfix'
    });

    //Dark sidebar skins
    var skin_blue =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-primary' data-skin='skin-blue' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin'>Blue<span class='icon-skin icon-skin-blue'></span></p>");
    skins_list.append(skin_blue);
    var skin_black =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-black' data-skin='skin-black' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'></span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin'>Black<span class='icon-skin icon-skin-black'></span></p>");
    skins_list.append(skin_black);
    var skin_purple =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-purple' data-skin='skin-purple' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'></span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin'>Purple<span class='icon-skin icon-skin-purple'></span></p>");
    skins_list.append(skin_purple);
    var skin_green =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-success' data-skin='skin-green' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'></span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin'>Green<span class='icon-skin icon-skin-green'></span></p>");
    skins_list.append(skin_green);
    var skin_red =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-danger' data-skin='skin-red' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'></span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin'>Red<span class='icon-skin icon-skin-red'></span></p>");
    skins_list.append(skin_red);
    var skin_yellow =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-warning' data-skin='skin-yellow' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'></span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin'>Yellow<span class='icon-skin icon-skin-yellow'></span></p>");
    skins_list.append(skin_yellow);

    //Light sidebar skins
    var skin_blue_light =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-priamry' data-skin='skin-blue-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin' style='font-size: 12px'>Blue Light<span class='icon-skin icon-skin-blue-light'></span></p>");
    skins_list.append(skin_blue_light);
    var skin_black_light =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-black' data-skin='skin-black-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'></span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin' style='font-size: 12px'>Black Light<span class='icon-skin icon-skin-black-light'></span></p>");
    skins_list.append(skin_black_light);
    var skin_purple_light =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-purple' data-skin='skin-purple-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'></span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin' style='font-size: 12px'>Purple Light<span class='icon-skin icon-skin-purple-light'></span></p>");
    skins_list.append(skin_purple_light);
    var skin_green_light =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-success' data-skin='skin-green-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'></span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin' style='font-size: 12px'>Green Light<span class='icon-skin icon-skin-green-light'></span></p>");
    skins_list.append(skin_green_light);
    var skin_red_light =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-danger' data-skin='skin-red-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'></span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin' style='font-size: 12px'>Red Light<span class='icon-skin icon-skin-red-light'></span></p>");
    skins_list.append(skin_red_light);
    var skin_yellow_light =
        $("<li />", {
            style: "float:left; width: 33.33333%; padding: 5px;"
        })
        .append("<a href='javascript:void(0);' data-box='box-warning' data-skin='skin-yellow-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>" +
            "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'></span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'></span></div>" +
            "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>" +
            "</a>" +
            "<p class='text-center no-margin' style='font-size: 12px;'>Yellow Light <span class='icon-skin icon-skin-yellow-light'></span></p>");
    skins_list.append(skin_yellow_light);

    $("#theme-section").append(skins_list);
    $(".icon-"+selected).html("&nbsp;<i class='fa fa-check'></i>");

    $("body").on("click", "#theme-section a", function(e){
        e.preventDefault();
        let skin = $(this).attr("data-skin");
        let box = $(this).attr("data-box");
        $("body").attr("class", "hold-transition sidebar-mini sidebar-collapse "+skin);
        $(".box").attr("class", "box "+box);

        let data = {
            "theme": skin,
            "box": box
        }

        $(".icon-skin").empty();
        $(".icon-"+skin).html("&nbsp;<i class='fa fa-check'></i>");
        
        headerRequest();
        $.post(BASE_URL + "/api/skin/change", data, function(result) {
            if(result){
                toastShow({
                    "title": "Theme Changed",
                    "message": "Success: You application theme have been modified!.",
                    "mode": "success"
                });
            }
        });

        return false;
    });

});