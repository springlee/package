$(function () {
    $("#refresh").on('click',function () {
        var data_id = $('.active.J_menuTab').data("id");
        var t = $('.J_iframe[data-id="' + data_id + '"]');
        t[0].contentWindow.location.reload(true);
    })
    //全屏事件
    $("#screen").on('click', function () {
        var doc = document.documentElement;
        if ($(document.body).hasClass("full-screen")) {
            $(document.body).removeClass("full-screen");
            document.exitFullscreen ? document.exitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen && document.webkitExitFullscreen();
        } else {
            $(document.body).addClass("full-screen");
            doc.requestFullscreen ? doc.requestFullscreen() : doc.mozRequestFullScreen ? doc.mozRequestFullScreen() : doc.webkitRequestFullscreen ? doc.webkitRequestFullscreen() : doc.msRequestFullscreen && doc.msRequestFullscreen();
        }
    });
})