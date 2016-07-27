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
        // 弹窗进行确认
        var url=$(this).attr("data-url");
        var data={id: $(this).attr("attr-id")};
        hfaw_dialog.confirm("是否删除", doDeleteNews);
        function doDeleteNews(){
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: data,
            })
            .done(function(result){
                if(result.status==0){
                    hfaw_dialog.success("删除菜单成功", result.data.url);
                }else{
                    hfaw_dialog.error("删除菜单失败,原因是"+result.msg, result.data.url);
                }
            })
            .fail(function(){
                hfaw_dialog.error("网络连接错误");
            });
        }
    });

    // 设置新闻可见性
    $(".news_show_link").on('click', function(event){
        event.preventDefault();
        var url=$(this).attr('data-url');
        var postData={
            id: $(this).attr('attr-id'),
        };
        hfaw_dialog.confirm("是否更改新闻状态", updateNewsStatus);
        function updateNewsStatus(){
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: postData,
            })
            .done(function(result){
                if(result.status==0){
                    hfaw_dialog.success("设置新闻状态成功", result.data.url);
                }else{
                    hfaw_dialog.error("设置新闻状态失败,原因是"+result.msg, result.data.url);
                }
            })
            .fail(function(){
              hfaw_dialog.error("网络连接错误");  
            });
        }
        
    });

    /**
     * 新闻添加
     */
    $("#btn_add_news_submit").on('click', function(event){
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
        .done(function(result){
            if(result.status==0){
                hfaw_dialog.success("添加新闻成功", result.data.url);
            }else{
                hfaw_dialog.error("添加新闻失败,原因是"+result.msg, result.data.url);
            }
        })
        .fail(function(){
            hfaw_dialog.error("网络连接错误");
        });
    });

    /**
     * 新闻编辑
     */
    $("#btn_edit_news_submit").on('click', function(event){
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
        var url=$(this).attr('data-url');
        $.ajax({
            url: url,
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

    /**
     * 新闻排序
     */
    $("#btn_change_news_order").on('click', function(event){
        event.preventDefault();
        var data = $("#news_controller_form").serializeArray();
        var postData ={};
        $.each(data, function(index,val){
            postData[val.name]=val.value;
        });
        var url=$(this).attr('data-url');
        var rurl = $(this).attr("data-redirect-url");
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: postData,
        })
        .done(function(result) {
            if(result.status==0){
                hfaw_dialog.success("新闻重新排序成功", result.data.url);
            }else{
                hfaw_dialog.error("新闻重新排序失败,原因是"+result.msg, result.data.url);
            }
        })
        .fail(function(){
            hfaw_dialog.error("新闻重新排序产生异常", rurl);//,原因是"+result.msg, result.data.url);
        });
    });

    /**
     * 新闻推送
     */
    $("#btn_push_news").on('click', function(event){
        event.preventDefault();
        //获取选中的区域名称及新闻ID号集合
        var areaId=$("#select_push_area").val();
        if(areaId==-1){
            hfaw_dialog.msg("请选择区域");
            return;
        }
        var postData={};
        var newsIds={};
        $("input[name='pushcheck']:checked").each(function(index, el) {
            newsIds[index]=$(this).val();
        });

        postData["newsIds"]=newsIds;
        postData["areaId"]=areaId;

        var url=$(this).attr('data-url');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: postData,
        })
        .done(function(result){
            if(result.status==0){
                hfaw_dialog.success("推送区域内容成功", result.data.url);
            }else{
                hfaw_dialog.error("推送区域内容失败,原因是"+result.msg, result.data.url);
            }
        })
        .fail(function(){
            hfaw_dialog.error("推送区域内容产生异常", rurl);
        });
        
    });

});