$(function() {
    // 时间轴动画变量
    var i = 0;
    var n = -1;
    var init = window.onmousewheel;
    var wheel = document.getElementById('his-content');
    // 时间轴动画事件开始
    function tchangeup() {
        n++;
        i -= $('.now')[0].clientHeight;
        $('.list li').eq(0).animate({
            'margin-top': i + 'px'
        }, 1000);
        $('.list-left').eq(n).animate({
            'left': '-190px'
        }, 'fast');
        $('.list-right').eq(n).animate({
            'right': '-420px'
        }, 'fast');
    }

    function tchangedown() {
        i += $('.now')[0].clientHeight;
        $('.list li').eq(0).animate({
            'margin-top': i + 'px'
        }, 700);
        $('.list-left').eq(n).animate({
            'left': '0'
        }, 600);
        $('.list-right').eq(n).animate({
            'right': '0'
        }, 600);
        n--;
    }

    function scrollFunc(e) {
        e = e || window.event; //ie8兼容
        if ((e.wheelDelta > 0 || e.detail < 0) && (($('.list li').length - n) >= 5)) {
            wheel.onmousewheel = null;
            wheel.ontouchstart = null;
            tchangeup();
            setTimeout(function() {
                wheel.onmousewheel = scrollFunc;
                wheel.ontouchstart = touchFunc;
            }, 1000);
        } else if ((e.wheelDelta < 0 || e.detail > 0) && n > -1) {
            wheel.onmousewheel = null;
            wheel.ontouchstart = null;
            tchangedown();
            setTimeout(function() {
                wheel.onmousewheel = scrollFunc;
                wheel.ontouchstart = touchFunc;
            }, 1000);
        }
    }
    // 手机触控动画
    function touchFunc(e) {
        e = e || window.event;
        wheel.ontouchstart = function(e) {
            e = e || window.event;
            startY = e.changedTouches[0].clientY;
            // e.preventDefault();
            wheel.ontouchmove = function(e) {
                e = e || window.event;
                e.preventDefault();
                wheel.ontouchmove = null;
                wheel.onmousewheel = null;
                moveEndY = e.changedTouches[0].clientY;
                Y = moveEndY - startY;
                if ((Y < 0) && (($('.list li').length - n) >= 5)) {
                    tchangeup();
                    setTimeout(function() {
                        wheel.onmousewheel = scrollFunc;
                        wheel.ontouchmove = touchFunc;
                    }, 1000);
                } else if (Y > 0 && n > -1) {         //↑
                    tchangedown();
                    setTimeout(function() {
                        wheel.onmousewheel = scrollFunc;
                        wheel.ontouchmove = touchFunc;
                    }, 1000);
                }
            }
        };
    }
    wheel.onmouseover = function() {
        window.onmousewheel = function(e) {
            e = e || window.event;
            if (e.preventDefault) e.preventDefault();
            else e.returnValue = false;
        };
    };
    wheel.onmouseout = function() {
        window.onmousewheel = function(e) {};
    };
    $.ajax({
        type: "GET",
        data: {
            "lm": 10
        },
        dataType: "json",
        url: "./blog/search.php",
        success: function(data) {
            $.each(data.article, function(i, item) {
                var node = $('.clone-item').eq(0).clone(true);
                node.attr('id', item.id);
                node.attr('cl', item.cl);
                node.attr('author', item.author);
                node.find('a').attr('href', './blog/?cl=' + item.cl + '&id=' + item.id);
                node.find('.badge').html(item.time.substring(0, 10));
                node.find('.Lname').html(item.title);
                node.removeClass("hide");
                $('.blogL').append(node);
            });
        }
    });
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "./model/member.php",
        success: function(data) {
            $.each(data.pep, function(i, item) {
                var node = $('.clone-item1').eq(0).clone(true);
                node.find('.badge').html(item.aspect);
                node.find('.Cname').html(item.name);
                node.removeClass("hide");
                $('.list-group').eq(1).append(node);
            });
        }
    });
    $.ajax({
        type: "GET",
        data: {
            "lm": 10
        },
        dataType: "json",
        url: "./act/search.php",
        success: function(data) {
            $.each(data.activity, function(i, item) {
                var node = $('.clone-item').eq(0).clone(true);
                node.attr('id', item.id);
                node.attr('cl', item.cl);
                node.attr('author', item.author);
                node.find('a').attr('href', './act/?cl=' + item.cl + '&id=' + item.id);
                node.find('.badge').html(item.time.substring(0, 10));
                node.find('.Lname').html(item.title);
                node.removeClass("hide");
                $('.activeL').append(node);
            });
        }
    });
    $('#up').click(function() {
        if (($('.list li').length - n) >= 5) {
            wheel.ontouchstart = null;
            wheel.onmousewheel = null;
            tchangeup();
            setTimeout(function() {
                wheel.ontouchstart = touchFunc;
                wheel.onmousewheel = scrollFunc;
            }, 1000);
        }
    });
    $('#down').click(function() {
        if (n > -1) {
            wheel.ontouchstart = null;
            wheel.onmousewheel = null;
            tchangedown();
            setTimeout(function() {
                wheel.ontouchstart = touchFunc;
                wheel.onmousewheel = scrollFunc;
            }, 1000);
        }
    });
    // 注册滚轮事件
    if (wheel.addEventListener) {
        wheel.addEventListener('DOMMouseScroll', scrollFunc, false);
    } // W3C，兼容Firefox
    wheel.onmousewheel = scrollFunc; //IE/Opera/Chrome/Safari
    // 手机触控事件
    wheel.ontouchstart = touchFunc;
    $('#up,#down').css('cursor', 'pointer');
    // 时间轴动画事件结束
    // 时间轴圆点
    $('.list li').mousemove(function() {
        $('.list li').removeClass('now');
        $(this).addClass('now');
    });
    $('#logo').click(function() {
        $('#main').fadeToggle(0);
        $('#time').fadeToggle(0);
    });
});