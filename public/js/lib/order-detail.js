$(function () {
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    $(".close_action").click(function(){
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    });
})