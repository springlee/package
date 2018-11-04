$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function initDateRange() {
    if (_locale === 'en') {
        var date_locale = {
            "format": 'YYYY-MM-DD',
            "separator": " - ",
            "firstDay": 1,
        };
        var ranges = {
            'Today': [moment(), moment().add(1, 'days')],
            'Yesterday': [moment().subtract(1, 'days'), moment()],
            'Last 7 Days': [moment().subtract(6, 'days'), moment().add(1, 'days')],
            'Last 30 Days': [moment().subtract(29, 'days'), moment().add(1, 'days')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    } else {
        var date_locale = {
            "format": 'YYYY-MM-DD',
            "separator": " - ",
            "applyLabel": "确定",
            "cancelLabel": "取消",
            "fromLabel": "起始时间",
            "toLabel": "结束时间'",
            "customRangeLabel": "自定义",
            "weekLabel": "W",
            "daysOfWeek": ["日", "一", "二", "三", "四", "五", "六"],
            "monthNames": ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            "firstDay": 1
        };
        var ranges = {
            '今日': [moment(), moment().add(1, 'days')],
            '昨日': [moment().subtract(1, 'days'), moment()],
            '最近7日': [moment().subtract(6, 'days'), moment().add(1, 'days')],
            '最近30日': [moment().subtract(29, 'days'), moment().add(1, 'days')],
            '本月': [moment().startOf('month'), moment().endOf('month')],
            '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }
    $('.date-range').daterangepicker({
            opens: "center",
            showDropdowns: false,
            locale: date_locale,
            autoUpdateInput: false,
            ranges: ranges
        },
        function (start, end) {
            $('.date-range').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        }
    );
}


function AjaxRequestForm(data, statusText, xhr, jqForm) {
    if (data.success) {
        if (typeof(data.view) !== 'undefined') {
            layer.open({
                type: 1,
                shadeClose: true,
                shade: 0.5,
                maxmin: true, //开启最大化最小化按钮
                area: ['90%', '90%'],
                title: data.title,
                content: data.view,
            });
            return;
        }
        if (typeof(data.url) !== 'undefined') {
            toastr.success(data.message);
            layer.closeAll();
            if (typeof parent.refreshTableData === "function") {
                parent.refreshTableData()
            } else {
                refreshTableData()
            }
            window.location.href = data.url;
        } else {
            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
            parent.toastr.success(data.message);
            if (typeof saveCallBack === "function") {
                saveCallBack.call(null, data)
            } else {
                if (typeof parent.refreshTableData === "function") {
                    parent.refreshTableData()
                } else {
                    refreshTableData()
                }
            }
            layer.closeAll();
            parent.layer.close(index);
        }
    } else {
        layer.closeAll();
        toastr.error(data.message);
    }
    jqForm.find('button[type="submit"]').button('reset');
    $(".checkbox-all-action").button('reset');
}

function AjaxRequest(data, statusText, xhr, jqForm) {
    if (data.success) {
        toastr.success(data.message);
        refreshTableData();
        layer.closeAll();
    } else {
        toastr.error(data.message);
    }
}

function AjaxError(data) {
    if (data.status === 422) {
        var errors = data.responseJSON;
        var error_show = '';
        $.each(errors.errors, function (i, val) {
            error_show += val + '<br/>';
        });
        toastr.error(error_show);
    }
    if (data.status === 500) {
        var errors = data.responseJSON;
        toastr.error(errors.message);
    }
    $("button[type='submit']:disabled").button('reset');
    $(".checkbox-all-action").button('reset');
    layer.closeAll();
}


function beforeSubmit(formData, jqForm, options) {
    layer.load(0, {shade: false});
    jqForm.find('button[type="submit"]').button('loading');
    return true;
}

function AjaxSubmit(url, formObj) {
    if (!formObj || formObj === '') {
        formObj = $('#formData');
    }
    $(formObj).ajaxSubmit({
        url: url,
        type: "POST",
        beforeSubmit: beforeSubmit,
        success: AjaxRequestForm,
        error: AjaxError
    });
}


var tableOperate = {};

function loadTableData(params) {
    var table_search_form = $(".table-search-form");
    var url = table_search_form.data('ajax');
    $.extend(params.data, table_search_form.serializeObject());
    $.post(url, params.data, function (result) {
        if (typeof result.success !== 'undefined' && !result.success) {
            toastr.error(result.message);
        } else {
            params.success(result);
            if (typeof(tableOperate.updateActionButtons) === 'function') {
                $(".bs-checkbox input").change(function (event) {
                    tableOperate.updateActionButtons();
                });
                tableOperate.updateActionButtons();
            }
        }
    });
}

function refreshTableData() {
    $("#table").bootstrapTable('selectPage', 1);
    if (typeof(tableOperate.updateActionButtons) === 'function') {
        $(".bs-checkbox input").change(function (event) {
            tableOperate.updateActionButtons();
        });
        tableOperate.updateActionButtons();
    }
}

function operateFormatter(value, row, index) {
    var buttons = [];
    if (tableOperate.extend.buttons && tableOperate.extend.buttons !== undefined) {
        $.each(tableOperate.extend.buttons, function (i, j) {
            buttons.push({
                name: j.name,
                icon: j.icon,
                title: j.title,
                class_name: j.class_name,
                url: j.url + '/' + row.id,
                text: j.text
            })
        })
    }
    if (tableOperate.edit_url !== '' && tableOperate.edit_url !== undefined) {
        buttons.push({
            name: 'edit',
            icon: 'fa fa-pencil',
            title: language.edit,
            class_name: 'btn btn-xs btn-success btn-edit-one',
            url: tableOperate.edit_url + '/' + row.id
        });
    }

    if (tableOperate.del_url !== '' && tableOperate.del_url !== undefined) {
        buttons.push({
            name: 'del',
            icon: 'fa fa-trash',
            title: language.delete,
            class_name: 'btn btn-xs btn-danger btn-del-one',
            url: tableOperate.del_url + '/' + row.id
        });
    }
    return button_html(buttons);
}

function detailFormatter(value, row, index) {
    if (tableOperate.detail_url !== '' && tableOperate.detail_url !== undefined) {
        return '<a href="' + tableOperate.detail_url + '/' + row.id + '" class="btn-edit-one">' + value + '</a>'
    } else {
        return value;
    }
}

function statusFormatter(value, row, index) {
    if (typeof value === 'undefined') {
        return '';
    } else {
        var color = typeof tableOperate.status[row.status] !== 'undefined' ? tableOperate.status[row.status] : 'primary';
        return '<span id="status-' + row.id + '"  data-status="' + row.status + '" class="status text-' + color + '"><i class="fa fa-circle"></i>' + value + '</span>';
    }

}
function typeFormatter(value, row, index) {
    if (typeof value === 'undefined') {
        return '';
    } else {
        var color = typeof tableOperate.type[row.type] !== 'undefined' ? tableOperate.type[row.type] : 'primary';
        return '<span id="type-' + row.id + '"  data-type="' + row.type + '" class="type text-' + color + '"><i class="fa fa-circle"></i>' + value + '</span>';
    }

}


function activeFormatter(value, row, index) {
    var active_url='';
    if (tableOperate.active_url !== '' && tableOperate.active_url !== undefined) {
        active_url=tableOperate.active_url+'/' + row.id
    }
    var checked = '';
    if(value==='enable'){
        checked ='checked';
    }
    return '<input type="checkbox" class="js-check-change" '+checked+' data-ajax="'+active_url+'"/>';

}

function button_html(buttons) {
    var html = [];
    var url, class_name, icon, text, title;
    $.each(buttons, function (i, j) {
        class_name = j.class_name ? j.class_name : 'btn-primary btn-' + name + 'one';
        url = j.url ? j.url : '';
        icon = j.icon ? j.icon : '';
        text = j.text ? j.text : '';
        title = j.title ? j.title : text;
        html.push('<a href="' + url + '" class="' + class_name + '" title="' + title + '"><i class="' + icon + '"></i>' + (text ? ' ' + text : '') + '</a>');
    })
    return html.join(' ')
}

$(document).ready(function () {
    initDateRange();
    //提示框的样式
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",});
    $(".select2").select2({theme: "bootstrap"});

    $(document).on('click', ".autoJqValidator button[type='submit']",
        function (event) {
            event.preventDefault();
            var formObj = $(".autoJqValidator");
            if (formObj.valid(this) === false) {
                toastr.error(language.input_valid);
                return false;
            }
            if (typeof formObj.data('ajax') !== 'undefined') {
                AjaxSubmit(formObj.data('ajax'), formObj);
                return false;
            }
            return false;
        });

    $("#table").bootstrapTable({
        stickyHeader: true,
        stickyHeaderOffsetY: 0 + 'px',
        pageNumber: 1
    }).on('load-success.bs.table', function () {
        $('#table .js-check-change').each(function (index,value) {
            new Switchery(value,{size: 'small'});
        })
    });

    $('.table-search-btn').on('click', function (event) {  // 点击查询
        event.preventDefault();
        refreshTableData();
    });
    var checkAll = $('.check-all');
    var checkboxes = checkAll.parents('form').find('input[type="checkbox"]');
    checkAll.on('ifChecked ifUnchecked', function (event) {
        if (event.type === 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });
    checkboxes.on('ifChanged', function () {
        if (checkboxes.filter(':checked').length === checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

    $(document).on('click', '.checkbox-all-action', function () {
        var obj = $(this);
        var url = obj.data('ajax');
        var info = obj.data('info');
        var from = obj.parents('form');
        var target = obj.data('target');
        var $this = $(this);
        $this.button('loading');
        layer.confirm(info, {
            btn: ['确定', '取消'],
        }, function (index) {
            if (!target) {
                AjaxSubmit(url, from);
            } else {
                from.attr('action', url);
                from.submit();
            }
            layer.close(index);
        }, function () {
            $this.button('reset');
        });
        return false;
    });

    $(document).on('click', '.btn-add-one , .btn-edit-one', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var width = $(this).data('width') ? $(this).data('width') : '90%';
        var height = $(this).data('width') ? $(this).data('height') : '90%';
        layer.open({
            type: 2,
            title: $(this).attr('title'),
            shadeClose: true,
            shade: 0.5,
            maxmin: true, //开启最大化最小化按钮
            area: [width, height],
            content: url
        });
        return false;
    });
    $(document).on('click', '.btn-del-one', function () {
        var url = $(this).attr('href');
        layer.confirm(language.make_sure_delete, {
            btn: [language.submit, language.cancel],
        }, function (index) {
            $.get(url, {}, AjaxRequest, 'json');
            layer.close(index);
        }, function () {

        });
        return false;
    });

    $('.collapse-link').on('click', function () {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.find('div.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function () {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });

    $('.close-link').on('click', function () {
        var content = $(this).closest('div.ibox');
        content.remove();
    });

    $('#myTab a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $(".close_action").on('click', function () {
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    });
    $(document).on('click', '.layer-date', function () {
        var id = $(this).attr('id');
        var format = $(this).data('format');
        var istime = $(this).data('istime');
        format = (typeof(format) === 'undefined') ? "YYYY-MM-DD hh:mm:ss" : format;
        istime = (typeof(istime) === 'undefined') ? true : istime;
        var callback = function (datas) {
            var obj = $("#" + id);
            var cb = $(obj).attr('data-choose');
            if (typeof(cb) == 'undefined' || cb.trim() == '') return;
            var func = (new Function('return ' + cb))();
            var parameters = [datas, id];
            func.apply(null, parameters);
        }
        var options = {elem: "#" + id, event: "focus", format: format, istime: istime, choose: callback};
        laydate(options);
    });
    $('.refresh-link').bind('click', function () {
        window.location.reload();
    });

    $(document).on('change','.js-check-change', function () {
        var checked = $(this).prop('checked');
        $.ajax({
            type: 'POST',
            url: $(this).data('ajax'),
            data: {checked: checked},
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            },
        });
    });

})