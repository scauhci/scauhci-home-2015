$(function() {
    var classes = "分享",
        id = "";
    var module = document.getElementById('preview').cloneNode(true);
    module.id = '';
    var params, arr = [],
        keyvalue = [];

    function getParams() {
        params = window.location.search.split('?').pop();
        arr = params.split('&');
        for (var i = 0; i < arr.length; i++) {
            keyvalue[i] = arr[i].split('=');
        }
    }
    //获取分类列表
    function getPageType() {
        $.ajax({
            type: "get",
            data: {},
            url: "./list.php", //发送请求的地址
            dataType: "json", //预期服务器返回的数据类型
            success: function(data) {
                //加载文章
                $("#classify nav").html("");
                $.each(data.list, function(i, item) {
                    var str = '<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="javascript:;" id="' + item.id + '" count="' + item.count + '">' + item.name + "</a>";
                    $("#classify nav").append($(str));
                });
                //点击分类列表
                $("#classify a").on("click", function() {
                    classes = $(this).text();
                    getPageList();
                });
                if (keyvalue.length == 2) {
                    if (keyvalue[0][1] != null) {
                        classes = decodeURI(keyvalue[0][1]);
                        
                        getPageList();
                    }
                }
                delete keyvalue;
            },
            error: function() {
                console.log("数据获取失败");
            }
        });
    }
    //获取文章列表
    function getPageList() {
        $.ajax({
            type: "get",
            data: {
                "cl": classes
            },
            url: "./search.php", //发送请求的地址
            dataType: "json", //预期服务器返回的数据类型
            success: function(data) {
                var i;
                $("#articlelist").html("");
                $.each(data.article, function(i, item) {
                    if (i < 10) {
                        module.getElementsByTagName('h4')[0].innerHTML = item.title;
                        module.getElementsByTagName('span')[0].innerHTML = item.intro;
                        var a = module.getElementsByTagName('a');
                        $(a).attr({
                            'id': item.id,
                            'title': item.title,
                            'author': item.author,
                            'time': item.time
                        });
                        $("#articlelist").append(module);
                        module = module.cloneNode(true);
                    }
                    i++;
                });
                binda();
                $("#showarticle").fadeOut();
                $("#articlelist").fadeIn();
                if (keyvalue.length == 2) {
                    if (keyvalue[1][1] != null) {
                        var tmp_id = decodeURI(keyvalue[1][1]);
                        keyvalue[1][1] = null;
                        $('#' + tmp_id).click();
                    }
                }
                delete keyvalue;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.status);
                console.log(XMLHttpRequest.readyState);
                console.log(XMLHttpRequest.responseText);
            }
        });
    }
    //搜索文章列表
    function searchPageList(textC) {
        $.ajax({
            type: "get",
            data: {
                "wd": textC
            },
            url: "./search.php", //发送请求的地址
            dataType: "json", //预期服务器返回的数据类型
            success: function(data) {
                var i;
                $("#articlelist").html("");
                $.each(data.search, function(i, item) {
                    if (i < 10) {
                        module.getElementsByTagName('h4')[0].innerHTML = item.title;
                        module.getElementsByTagName('span')[0].innerHTML = item.intro;
                        var a = module.getElementsByTagName('a');
                        $(a).attr({
                            'id': item.id,
                            'title': item.title,
                            'author': item.author,
                            'time': item.time
                        });
                        $("#articlelist").append(module);
                        module = module.cloneNode(true);
                    }
                    i++;
                });
                binda();
                $("#showarticle").fadeOut();
                $("#articlelist").fadeIn();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.status);
                console.log(XMLHttpRequest.readyState);
                console.log(XMLHttpRequest.responseText);
            }
        });
    }

    function binda() {
        //点击文章列表
        $("#articlelist a").click(function() {
            var id = $(this).attr("id"),
                title = $(this).attr("title"),
                author = $(this).attr("author"),
                time = $(this).attr("time");
            //点击发送请求
            $.ajax({
                type: "get",
                data: {
                    "id": id
                },
                url: 'search.php', //发送请求的地址
                dataType: "json", //预期服务器返回的数据类型
                success: function(data) {
                    $('#content h3').html(title);
                    $('#content strong').html(author);
                    $('#content span').eq(0).html(time);
                    $('#context').html(data.content);
                    $('#articlelist').fadeOut(0, function() {
                        $('#showarticle').fadeIn(0);
                    });
                },
                error: function() {
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(XMLHttpRequest.responseText);
                }
            });
            //请求end
        });
    }
    //返回顶部
    $('#goToTop button').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
    });
    //点击搜索
    $("#waterfall-exp").keydown(function(ev) {
        ev = ev || window.event;
        if (ev.keyCode == 13) {
            var textC = $(this).val();
            //发送请求
            searchPageList(textC);
        }
    });
    $(window).scroll(function() {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        var mt = $('header')[0].offsetTop;
        if (t > mt) {
            $('#navlogo').fadeIn(500);
            $('#goToTop').fadeIn(500);
        } else {
            $('#goToTop').fadeOut(500);
            $('#navlogo').fadeOut(500);
        }
    });
    //返回文章列表按钮
    $('#returnbutton').click(function() {
        $('#showarticle').fadeOut(500, function() {
            $('#articlelist').fadeIn(500);
        });
    });
    getParams();
    getPageType();
    $('.articlecontainer img').addClass('imgLibrary');
    $('#navlogo').fadeIn(500);
}); //end