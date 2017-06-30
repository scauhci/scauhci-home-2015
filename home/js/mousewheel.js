var scrollFunc = function (e) {
    e = e || window.event;
    var li = $(".list li")[0];
    var i = 0;
    var top = 0;
    if (e.wheelDelta > 0 || e.detail < 0) {
        $(".list li")[i].animate({
            margin -top
    :
        "150px"
    }
    ,
    1000, function {
        $(".list li")[i].hide();
        i++;
    }
    )
    ;
}
}
/*注册事件*/
if (document.addEventListener) {
    document.addEventListener('DOMMouseScroll', scrollFunc, false);
} //W3C
window.onmousewheel = document.onmousewheel = scrollFunc; //IE/Opera/Chrome/Safari