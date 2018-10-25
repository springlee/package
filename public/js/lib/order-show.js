function operateFormatter(value) {
    return '<a href="javascript:;" onclick="javascript:showDetail(\''+value+'\');">'+value+'</a>';
}
$("#table").bootstrapTable({
    stickyHeader: true,
    stickyHeaderOffsetY: 0 + 'px',
    pageNumber:1
})
$(function () {
    $('#btn_search').on('click',function(){  // 点击查询
        $("#table").bootstrapTable('refresh',{query: {offset: 0}});
    });
    $('#advance').on('click',function () {
        var btn=$(this).text();
        $("#order_sns").val('');
        if (btn=="高级查询"){
            $("#advance_tr").show();
            $(this).text('关闭')
        } else {
            $("#advance_tr").hide();
            $(this).text('高级查询')
        }
    });
    laydate.render({
        elem: '#laydate'
        ,range: true
    });
})