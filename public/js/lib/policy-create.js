$(document).ready(function(){
    $(".summernote").summernote({
        lang:"zh-CN",
        height:"200px",
        name:"summernote"
    })
    $(".autoPolicyValidator button[type='submit']").on('click',
        function (event) {
            $("input[name='msg_content']").val($(".summernote").code());
            event.preventDefault();
            var formObj = $(".autoPolicyValidator");
            if (formObj.valid(this) == false) {
                toastr.error('信息不完整');
                return false;
            }
            if (typeof formObj.data('ajax') != 'undefined') {
                AjaxSubmit(formObj.data('ajax'), formObj);
                return false;
            }
            return false;
        });
});

$.validator.setDefaults({
    highlight: function (e) {
        $(e).parent("div").removeClass("has-success").addClass("has-error")
    }, success: function (e) {
        e.parent("div").removeClass("has-error").addClass("has-success")
    }, errorElement: "span", errorPlacement: function (e, r) {
        e.appendTo(r.parent('div'))
    }, errorClass: "help-block m-b-none td-info", validClass: "help-block m-b-none"
})
$(".autoPolicyValidator").validate({
    ignore: '',
    rules: {
        'msg_title': {
            required: true,
        },
        'msg_url': {
            required: true,
        }
    },
})