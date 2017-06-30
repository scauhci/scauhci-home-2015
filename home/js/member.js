$(document).ready(function() {
    var module = $('.demo-card-square')[0].cloneNode(true);
    $('#pep').html('');

    function showsearch(name) {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
        for (var i = 0; i < $('.demo-card-square').length; i++) {
            $('.demo-card-square').eq(i).slideDown(500);
        }
        for (var i = 0; i < $('.demo-card-square').length; i++) {
            $('.demo-card-square').eq(i).slideUp(500);
        }
        $('#searchtext').html('<mark>' + name + '</mark>' + ' 搜索结果为');
        $('#returnbutton').show('500', function() {
            $('#searchtext').show('500', function() {
                for (var i = 0; i < $('.demo-card-square').length; i++) {
                    if (($('#pep h2').eq(i).text().toLowerCase().indexOf(name.toLowerCase()) != -1) || ($('#pep strong').eq(i).text().toLowerCase().indexOf(name.toLowerCase()) != -1) || ($('.mdl-card__supporting-text').eq(i).text().toLowerCase().indexOf(name.toLowerCase()) != -1)) {
                        $('.demo-card-square').eq(i).slideDown(500);
                    }
                }
            });
        });
    }

    function returnfunction() {
        for (var i = 0; i < $('.demo-card-square').length; i++) {
            $('.demo-card-square').eq(i).slideUp(500);
        }
        $('#searchtext').hide(500, function() {
            $('#returnbutton').hide(500, function() {
                for (var i = 0; i < $('.demo-card-square').length; i++) {
                    $('.demo-card-square').eq(i).slideDown(500);
                }
            });
        });
    }

    function getpep() {
        $.ajax({
            type: "get",
            data: {},
            url: "./model/member.php", //发送请求的地址
            dataType: "json", //预期服务器返回的数据类型
            success: function(data) {
                $.each(data.pep, function(i, item) {
                    $(module).find('.mdl-card__title').css('backgroundUrl', item.img);
                    $(module).find('h2')[0].innerHTML = item.name;
                    $(module).find('strong')[0].innerHTML = item.aspect;
                    $(module).find('.mdl-card__supporting-text')[0].innerHTML = '<strong>' + item.grade + ' ' + item.major + '</strong><br/>' + item.sign;
                    $('#pep').append(module);
                    module = module.cloneNode(true);
                });
            },
            error: function() {
                console.log("数据获取失败");
            }
        });
    }
    $(window).scroll(function() {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        if (t > 0) {
            $('#goToTop').fadeIn('slow');
        } else {
            $('#goToTop').fadeOut('slow');
        }
    });
    $('#goToTop button').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
    });
    $('#inputname').keypress(function(event) {
        if (event.keyCode == 13 && $('#inputname').val() != '') {
            showsearch($('#inputname').val());
        }
    });
    $('#returnbutton').click(function() {
        returnfunction();
    });
    $('#searchtext').fadeOut(0);
    $('#returnbutton').fadeOut(0);
    getpep();
});