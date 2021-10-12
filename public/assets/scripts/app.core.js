var BASE_URL = $('meta[name="base-url"]').attr('content');
var API_TOKEN = $('meta[name="api-token"]').attr('content');
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

moment.locale($("html").attr("lang"));

jQuery.browser = {};
(function() {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

function toggleFullscreen(elem) {
    elem = elem || document.documentElement;
    if (!document.fullscreenElement && !document.mozFullScreenElement &&
        !document.webkitFullscreenElement && !document.msFullscreenElement) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
        $(".icon-resize").removeClass("glyphicon-resize-full").addClass("glyphicon-resize-small");
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
        $(".icon-resize").removeClass("glyphicon-resize-small").addClass("glyphicon-resize-full");
    }
}

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

var browser = function() {
    var ua = navigator.userAgent,
        tem, M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if (/trident/i.test(M[1])) {
        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
        return {
            name: 'IE',
            version: (tem[1] || '')
        };
    }
    if (M[1] === 'Chrome') {
        tem = ua.match(/\bOPR|Edge\/(\d+)/)
        if (tem != null) {
            return {
                name: 'Opera',
                version: tem[1]
            };
        }
    }
    M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
    if ((tem = ua.match(/version\/(\d+)/i)) != null) {
        M.splice(1, 1, tem[1]);
    }
    return {
        name: M[0],
        version: M[1]
    };
}

var jsonToString = function(data) {
    var encoded = JSON.stringify(data);
    encoded = encoded.replace(/\\"/g, '"')
        .replace(/([\{|:|,])(?:[\s]*)(")/g, "$1'")
        .replace(/(?:[\s]*)(?:")([\}|,|:])/g, "'$1")
        .replace(/([^\{|:|,])(?:')([^\}|,|:])/g, "$1\\'$2");
    return encoded;
};

var stringToJson = function(input) {
    var result = [];

    //replace leading and trailing [], if present
    input = input.replace(/^\[/, '');
    input = input.replace(/\]$/, '');

    //change the delimiter to 
    input = input.replace(/},{/g, '};;;{');

    // preserve newlines, etc - use valid JSON
    //https://stackoverflow.com/questions/14432165/uncaught-syntaxerror-unexpected-token-with-json-parse
    input = input.replace(/\\n/g, "\\n")
        .replace(/\\'/g, "\\'")
        .replace(/\\"/g, '\\"')
        .replace(/\\&/g, "\\&")
        .replace(/\\r/g, "\\r")
        .replace(/\\t/g, "\\t")
        .replace(/\\b/g, "\\b")
        .replace(/\\f/g, "\\f");
    // remove non-printable and other non-valid JSON chars
    input = input.replace(/[\u0000-\u0019]+/g, "");

    input = input.split(';;;');

    input.forEach(function(element) {
        // console.log(JSON.stringify(element));

        result.push(JSON.parse(element));
    }, this);

    return result;
}

var getRandomInt = function(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

var arrayDistinct = function(arr) {
    let unique_array = []
    for (let i = 0; i < arr.length; i++) {
        if (unique_array.indexOf(arr[i]) == -1) {
            unique_array.push(arr[i])
        }
    }
    return unique_array
}

var timeStamp = function() {
    var timeStampInMs = window.performance && window.performance.now && window.performance.timing && window.performance.timing.navigationStart ? window.performance.now() + window.performance.timing.navigationStart : Date.now();
    return Math.floor(timeStampInMs);
}

var fileSizeInfo = function(bytes, si) {
    var thresh = si ? 1000 : 1024;
    if (Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }
    var units = si ? ['kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'] : ['KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
    var u = -1;
    do {
        bytes /= thresh;
        ++u;
    } while (Math.abs(bytes) >= thresh && u < units.length - 1);
    return bytes.toFixed(1) + ' ' + units[u];
}

var numberFormat = function(number, decimals, dec_point, thousands_sep) {
    // http://kevin.vanzonneveld.net
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://getsprink.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +     bugfix by: Howard Yeend
    // +    revised by: Luke Smith (http://lucassmith.name)
    // +     bugfix by: Diogo Resende
    // +     bugfix by: Rival
    // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
    // +   improved by: davook
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Jay Klehr
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Amir Habibi (http://www.residence-mixte.com/)
    // +     bugfix by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // +   improved by: Drew Noakes
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');
    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *    example 10: number_format('1.20', 2);
    // *    returns 10: '1.20'
    // *    example 11: number_format('1.20', 4);
    // *    returns 11: '1.2000'
    // *    example 12: number_format('1.2000', 3);
    // *    returns 12: '1.200'
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        toFixedFix = function(n, prec) {
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            var k = Math.pow(10, prec);
            return Math.round(n * k) / k;
        },
        s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

var toastShow = function(option) {
    $.toast({
        heading: option.title,
        text: option.message,
        icon: option.mode,
        position: "top-right"
    });
}

var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}

var ucFirst = function(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

var headerRequest = function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + API_TOKEN,
        }
    });
}


var dataTableRenderButton = function(data, route_crud, data_model, permissions) {
    let _permissions = atob(permissions);
    let permission = JSON.parse(_permissions);
    let detail = route_crud+"/"+data.key_id;
    let edit =route_crud+"/"+data.key_id+"/edit";
    let buttons = new Array();
    if(permission.can_view){
        buttons.push("<a href='"+detail+"' class='btn btn-sm btn-info btn-detail' data-toggle='tooltip' data-placement='top'  data-original-title='Show Record'><i class='fa fa-search'></i></a>");
    }
    if(permission.can_edit){
        buttons.push("<a href='"+edit+"' class='btn btn-sm btn-warning btn-edit' data-toggle='tooltip' data-placement='top'  data-original-title='Edit Record'><i class='fa fa-edit'></i></a>");
    }
    if(permission.can_delete){
        buttons.push("<a href='javascript:void(0);' data-id='"+data.key_id+"' data-route="+detail+" data-model='"+data_model+"' class='btn btn-sm btn-danger btn-delete' data-toggle='tooltip' data-placement='top'  data-original-title='Delete Record'><i class='fa fa-trash'></i></a>");
    }
    return buttons.join("&nbsp;");
}

var dataTableRender = function(option) {

    var defaultUrl = BASE_URL + "/api/datatable/get/"+option.model;

    if(option.customUrl){
        defaultUrl = option.customUrl;
    }

    var oTable = $(option.container).DataTable({
        'autoWidth': false,
        'processing': true,
        'serverSide': true,
        'ajax': {
            'url': defaultUrl,
            'type': 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + API_TOKEN,
            }
        },
        'columns': option.columns,
        "order": [
            [option.columns.length - 1, 'desc']
        ],
        "language": {
            "sProcessing": "<i class='fa fa-refresh fa-spin'></i>&nbsp;&nbsp;Load Data...",
        },
        "initComplete": function(settings, json) {
            $(option.container+'_length select').select2();
            $(option.container+'_filter input').attr("placeholder", "Press Enter").addClass("form-control");
            $(option.container+'_filter input').unbind();
            $(option.container+'_filter input').bind('keyup', function(e) {
                if(e.keyCode == 13) {
                    oTable.search( this.value ).draw();
                }
            }); 
        }
    });

    $("body").on("click", ".btn-delete", function(e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let model = $(this).attr("data-model");
        let route = $(this).attr("data-route");
        swal({
            title: "Are you sure ?",
            text: "You will not be able to recover this data !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f8b32d",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false
        }, function(isConfirm) {
            if(isConfirm){
                let data = {
                    "id" : id,
                    "model":model
                }
                headerRequest();
                $.post(BASE_URL + "/api/datatable/delete", data, function(result) {
                    if(result){
                        swal.close();
                        toastShow({
                            "title": "Record Deleted",
                            "message": "Success: You have deleted record!.",
                            "mode": "success"
                        });
                        $(option.container).DataTable().ajax.reload();
                    }
                });
            }
        });
        return false;
    });

}



$(document).ready(function(){

    $("#btn-delete").click(function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure ?",
            text: "You will not be able to recover this data !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f8b32d",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false
        }, function(isConfirm) {
             if (isConfirm) {
                $("#delete-form").submit();
            }
        });
        return false;
    });

    if ($(".select2").length > 0) {
        $(".select2").select2();
    }

    if ($(".input-datepicker").length) {
        $(".input-datepicker").datepicker({
            autoclose: true,
            clearBtn: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
		    todayHighlight: true,
        });
    }

    if ($(".datetime-picker").length) {
        $('.datetime-picker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    }

    if ($(".time-picker").length) {
        $('.time-picker').datetimepicker({
            format: 'HH:mm'
        });
    }

    if($(".file-input").length){
       $(".file-input").fileinput({
            showPreview: false,
            showRemove: true,
            showUpload: false,
            showUploadStats: true,
       });
    }

    if ($(".file-input-image").length) {
        if ($(".file-input-image-preview").length) {
            var imageUrl = $(".file-input-image-preview").val();
            $(".file-input-image").fileinput({
                initialPreview: [imageUrl],
                initialPreviewAsData: true,
                showUpload: false,
                allowedFileExtensions: ["jpg", "png", "gif"],
                showRemove: false,
                maxFileCount: 1,
                removeLabel: '',
            });
        } else {
            $(".file-input-image").fileinput({
                showUpload: false,
                showRemove: false,
                allowedFileExtensions: ["jpg", "png", "gif"],
                maxFileCount: 1,
            });
        }
    }


    if ($(".input-slug").length && $(".output-slug").length) {
        $('.input-slug').keyup(function() {
            let input_slug = $('.input-slug').val();
            let word_slug = slug(input_slug);
            $(".output-slug").val(word_slug);
        });
    }


    if ($("#form-submit,.form-submit").length) {
        $("#form-submit,.form-submit").submit(function(e) {
            e.preventDefault();
            let form = this;
            swal({
                title: "Confirmation",
                text: "Are you sure want to submit this form ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f8b32d",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false
            }, function() {
                $(form).unbind('submit').submit();
            });
            return false;
        });
    }

    if ($("#btn-form-profile").length) {
        $("#btn-form-profile").click(function(e) {
            e.preventDefault();
            let form = $("#form-profile");
            swal({
                title: "Confirmation",
                text: "Are you sure want to submit this form ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f8b32d",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false
            }, function() {
                $(form).unbind('submit').submit();
            });
            return false;
        });
    }

    if ($(".select-multiple").length) {
        $(".select-multiple").select2({
            theme: "bootstrap",
        });
    }

    /** add active class and stay opened when selected */

    /** add active class and stay opened when selected */
    var pageUrl = window.location.href.split(/[?#]/)[0];
    var breadCumb = $(".breadcrumb li").length;

    if(breadCumb > 3){
        $(".breadcrumb li a").each(function(){
            let url = $(this).attr("href");
            if(url != BASE_URL && url != 'javascript:void(0);'){
                pageUrl = url;
            }
       });
    }

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        return this.href == pageUrl;
    }).parent().addClass('active');

    // // for treeview
    $('ul.treeview-menu a').filter(function() {
        return this.href == pageUrl;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

    $("li.hidden").remove();

    $("ul.treeview-menu").each(function(){
        if (!$(this).children('li').length) {
            $(this).parent().remove();
        }   
    });

    

    $("#menu-utama").removeClass("hidden");
    $("html, body, .wrapper, .main-sidebar, .sidebar").removeClass("active");

    if ($(".icheck").length) {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    }
  

   
});

