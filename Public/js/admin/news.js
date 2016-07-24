$(function(){

    // 跳转到新闻添加页面
    $("#news_add_link").on('click', function(event){
        event.preventDefault();
        // console.log($(this).attr("data-url"));
        window.location.href=$(this).attr("data-url");
    });

    // 跳转到新闻编辑页面
    $(".news_edit_link").on('click', function(event){
        event.preventDefault();
        window.location.href=$(this).attr("data-url");
    });

    // 跳转到新闻删除页面
    $(".news_delete_link").on('click', function(event){
        event.preventDefault();
        window.location.href=$(this).attr("data-url");
    });

    // 跳转到新闻是否显示页面
    $(".news_show_link").on('click', function(event){
        event.preventDefault();
        
    });

    // add news
    $("#btn_add_news_submit").on('click', function(event) {
        event.preventDefault();
        editor.sync();
        var newsdata = {
            "newstitle" : $("#newstitle").val(),
            "newssubtitle" : $("#newssubtitle").val(),
            "thumb" : $("#upload_thumb_image").val(),
            "newstitlecolor" : $("#newstitlecolor").val(),
            "newsprogram" : $("#newsprogram").val(),
            "newscopyfrom" : $("#newscopyfrom").val(),
            "newsdescription" : $("#newsdescription").val(),
            "newskeywords" : $("#newskeywords").val(),
            "newscontent" : $("#news_editor_area").val()
        };
        $.ajax({
            url: $(this).attr('data-url'),
            type: 'POST',
            dataType: "json",
            data: newsdata,
        })
        .done(function(result) {
            if(result.status==0){
                hfaw_dialog.success("添加新闻成功", result.data.url);
            }else{
                hfaw_dialog.error("添加新闻失败,原因是"+result.msg, result.data.url);
            }
        })
        .fail(function() {
            hfaw_dialog.error("网络连接错误");
        });
    });

    $("#btn_edit_news_submit").on('click', function(event) {
        event.preventDefault();
        editor.sync();
        var newsId = $(this).attr("attr-id");
        var newsdata = {
            "newsId": newsId,
            "newstitle" : $("#newstitle").val(),
            "newssubtitle" : $("#newssubtitle").val(),
            "thumb" : $("#upload_thumb_image").val(),
            "newstitlecolor" : $("#newstitlecolor").val(),
            "newsprogram" : $("#newsprogram").val(),
            "newscopyfrom" : $("#newscopyfrom").val(),
            "newsdescription" : $("#newsdescription").val(),
            "newskeywords" : $("#newskeywords").val(),
            "newscontent" : $("#news_editor_area").val()
        };
        $.ajax({
            url: $(this).attr('data-url'),
            type: 'POST',
            dataType: "json",
            data: newsdata,
        })
        .done(function(result){
            if(result.status==0){
                hfaw_dialog.success("修改新闻成功", result.data.url);
            }else{
                hfaw_dialog.error("修改新闻失败,原因是"+result.msg, result.data.url);
            }
        })
        .fail(function(){
            hfaw_dialog.error("网络连接错误");
        });
    });
});