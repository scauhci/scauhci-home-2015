$(function() {
    var phone = -1;
    var tHeight; //网页可见区域高
    var oBtn = $(".introduction_botton")[0];
    var oBtns = oBtn.getElementsByTagName("div");
    var oTab = $(".introduction_tab")[0];
    var oTabs = oTab.children;
    var currentNum = 0; //当前选项卡值
    var preNum = 0; //前一次选项卡值
    var close = 1; //页面第一次加载时阻止选项卡切换
    var timer; //轮播选项卡定时器
    var gap_num = -1; //相差的选项卡数
    var go_on = 0;
    var tops = 0;
    var checkTouch = 0; //检测是否滑动
    var tab_left1 = $(".tab1_left")[0]; //选项卡1中HCI
    var tab1_right1 = $(".tab1_right")[0]; //选项卡1中文字部分
    var top_word1 = $(".top_word1")[0]; //选项卡2中"娱"字
    var top_word2 = $(".top_word2")[0]; //选项卡2中"乐"字
    var tab2_word1 = $(".tab2_word1")[0]; //选项卡3中"工"字
    var tab2_word2 = $(".tab2_word2")[0]; //选项卡3中"作"字
    var event;
    //鼠标滚动
    function wheel(ev) {
        var ifTrue;
        event = ev || window.event;
        console.log('wheel');
        ifTrue = (event.wheelDelta > 0 || event.detail < 0);
        roll(ifTrue);
    }
    //手机触摸
    function tMove(ev) {
        event = ev || window.event;
        checkTouch = 1;
        ev.preventDefault();
        moveEndY = ev.changedTouches[0].clientY;
        Y = moveEndY - startY;
        //own
        var ifTrue = (Y > 0);
        roll(ifTrue);
    }

    function roll(ifTrue) {
        clearInterval(timer); //清除定时器
        if (ifTrue) {
            currentNum--;
            preNum = currentNum;
            if (currentNum < 0) {
                currentNum = 0;
            }
            gap_num = 1;
            tabChange(1); //1，滚轮向上
        } else {
            currentNum++;
            preNum = currentNum;
            if (currentNum >= 4) {
                currentNum = 3;
            }
            gap_num = -1;
            tabChange(2); //2，滚轮向下
        }
        rollPlay(); //开启定时器
    }
    //选项卡切换
    function tabChange(changeNum) {
        if (navigator.userAgent.indexOf("MSIE 8.0") > 0) {} else {
            for (var j = 0; j < oTabs.length; j++) {
                oBtns[j].style.backgroundColor = "rgba(250,250,250,0.5)";
            }
            oBtns[currentNum].style.backgroundColor = "rgba(250,250,250,1)";
        }
        if (changeNum == 1) {
            if (tops >= 0) {
                return;
            }
            tops += tHeight * gap_num;
            document.onmousewheel = null;
            changeTop(tops, null);
        }
        if (changeNum == 2) {
            if (tops <= (-tHeight * 3)) {
                if (go_on == 1) {
                    changeTop(0, function() {
                        preNum = currentNum;
                        tops = 0;
                    });
                }
                return;
            }
            tops += tHeight * gap_num;
            document.body.onmousewheel = null;
            changeTop(tops, null);
        }
    }
    //改变top
    function changeTop(beTop, fuc) {
        var wait = function() {　　　　
            var dtd = $.Deferred(); //在函数内部，新建一个Deferred对象
            　　　　　
            startMove(oTab, {
                top: beTop
            });　　　　　　
            dtd.resolve(); // 改变Deferred对象的执行状态
            　　　　　　
            return dtd.promise(); // 返回promise对象
        };　　
        $.when(wait()).done(function() {
            document.onmousewheel = wheel;
            if (fuc) {
                fuc();
            }
            setTimeout(function() {
                animate_late(currentNum);
            }, 600);
        }).fail(function() {
            alert("出错啦！");
        });
    }
    //选项卡切换时执行动画
    function animate_late(num) {
        if (num == 0) {
            if (navigator.userAgent.indexOf("MSIE 8.0") > 0) {
                // console.log("ie8");  
            } else {
                $(tab_left1).addClass("tab1_left1");
                $(tab1_right1).addClass("tab1_right1");
                setTimeout(function() { //清除动画添加的样式
                    $(tab_left1).removeClass("tab1_left1");
                    $(tab1_right1).removeClass("tab1_right1");
                    $(tab1_right1).addClass("tab1_right2");
                }, 1000);
            }
        } //num == 0
        if (navigator.userAgent.indexOf("MSIE 8.0") > 0) {} else {
            tab2_word1.style.transition = tab2_word2.style.transition = "";
        }
        $(".tab2_word1").css("left", "62%");
        $(".tab2_word2").css("left", "62%");
        if (num == 1) {
            if (phone == 1) {
                $(".tab2_word1").animate({
                    "left": "-20%"
                }, 600, function() {
                    $(".tab2_word1").animate({
                        "left": "6%"
                    }, 400);
                });
                $(".tab2_word2").animate({
                    "left": "140%"
                }, 600, function() {
                    $(".tab2_word2").animate({
                        "left": "70%"
                    }, 400);
                });
            } else {
                $(".tab2_word1").animate({
                    "left": "-20%"
                }, 600, function() {
                    $(".tab2_word1").animate({
                        "left": "15%"
                    }, 400);
                });
                $(".tab2_word2").animate({
                    "left": "120%"
                }, 600, function() {
                    $(".tab2_word2").animate({
                        "left": "75%"
                    }, 400);
                });
            }
            if (navigator.userAgent.indexOf("MSIE 8.0") > 0) {} else {
                setTimeout(function() {
                    tab2_word1.style.transition = tab2_word2.style.transition = "0.5s";
                }, 1200);
            }
        } //num == 1
        if (num == 2 || num == 3) {
            $(top_word1).addClass("top_word_1");
            $(top_word2).addClass("top_word_1");
            setTimeout(function() { //清除动画添加的样式
                $(top_word1).removeClass("top_word_1");
                $(top_word2).removeClass("top_word_1");
            }, 2000);
        } //num == 2||num==3
    } //animate_late end
    //选项卡轮播
    function rollPlay() {
        timer = setInterval(function() {
            currentNum++;
            preNum = currentNum;
            if (currentNum >= 4) {
                currentNum = 0;
                go_on = 1;
            }
            gap_num = -1;
            tabChange(2); //2，滚轮向下
            go_on = 0;
            // wheel();
        }, 7000);
    }
    //----------------------------------------------------------------------------------------
    //设置选项卡高度为网页可见区域高
    document.onmousewheel = wheel;
    window.onresize = function() {}
        //兼容火狐鼠标滚轮事件
    if (document.addEventListener) {
        document.addEventListener('DOMMouseScroll', wheel, false);
    } //end
    //手机滑动事件phone_touch
    $("body").on("touchstart", function(ev) {
        ev = ev || window.event;
        startX = ev.originalEvent.changedTouches[0].clientX;
        startY = ev.originalEvent.changedTouches[0].clientY;
        window.ontouchmove = function(ev) {
            ev = ev || window.event;
            ev.preventDefault();
            window.ontouchmove = null;
            tMove(ev);
        }
    });
    $("body").on("touchend", function() {
        window.ontouchmove = tMove;
    });
    tHeight = screen.availHeight;
    $(".introduction_box").css("height", tHeight + "px").addClass("background");
    if ((navigator.userAgent.toLocaleLowerCase().indexOf("android")) >= 0 || (navigator.userAgent.toLocaleLowerCase().indexOf("iphone")) >= 0) {
        phone = 1;
        tHeight = $(window).height();
        $(".introduction_box").css("height", tHeight + "px").removeClass("background");
    }
    //点击按钮切换选项卡
    for (var i = 0; i < oBtns.length; i++) {
        oBtns[i].index = i;
        oBtns[i].ontouchstart = oBtns[i].onclick = function() {
            clearInterval(timer); //清除定时器
            currentNum = this.index;
            if (currentNum > preNum) {
                gap_num = preNum - currentNum;
                tabChange(2);
            } else if (currentNum < preNum) {
                gap_num = preNum - currentNum;
                tabChange(1);
            } else {
                tabChange(0); //0,默认不处理changeNum值
            }
            preNum = this.index;
            rollPlay(); //开启定时器
            return false;
        };
    }
    animate_late(0);
    rollPlay();
}); //end