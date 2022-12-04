// 图片懒加载
$(document).ready(function () {
    $('img').lazyload({
        /*placeholder: '/loading.gif',*/
        effect: 'fadeIn'
    });
});

// 下拉菜单
$(document).ready(function () {
    $('.menu ul li').hover(function () {
        $(this).children('ul').show(); //mouseover
    }, function () {
        $(this).children('ul').hide(); //mouseout
    });
});

// 回到顶部按钮
$(document).ready(function () {
    var bt = $('#back-to-top');
    if ($(document).width() > 480) {
        $(window).scroll(function () {
            var st = $(window).scrollTop();
            bt.css('display', st > 400 ? 'block' : 'none');
        });
        bt.click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
        });
    }
});

// 鼠标点击特效
$(document).ready(function ($) {
    $('body').click(function (ev) {
        if (ev.target.tagName != 'A') {
            show(ev), play();
        }
    });
    // 显示音符
    var si = 0;
    function show(ev) {
        var x = ev.pageX, y = ev.pageY;
        var ss = '♪ ♩ ♫ ♬ ¶ ‖ ♭ ♯ § ∮'.split(' ');
        var $b = $('<b></b>').text(ss[si]);
        si = (si + 1) % ss.length;
        $b.css({
            'top': y - 20,
            'left': x,
            'z-index': 99999999,
            'position': 'absolute',
            'user-select': 'none',
            'font-size': 1 + 2 * Math.random() + 'rem',
            'color': 'rgb(' + ~~(255 * Math.random()) + ',' + ~~(255 * Math.random()) + ',' + ~~(255 * Math.random()) + ')'
        });
        $('body').append($b);
        $b.animate(
            { 'top': y - 120, 'opacity': 0 }, 600, function () { $b.remove(); }
        );
    }
    // 播放音乐
    var AudioContext = window.AudioContext || window.webkitAudioContext;
    var sheet = '880 987 1046 987 1046 1318 987 659 659 880 784 880 1046 784 659 659 698 659 698 1046 659 1046 1046 1046 987 698 698 987 987 880 987 1046 987 1046 1318 987 659 659 880 784 880 1046 784 659 698 1046 987 1046 1174 1174 1174 1046 1046 880 987 784 880 1046 1174 1318 1174 1318 1567 1046 987 1046 1318 1318 1174 784 784 880 1046 987 1174 1046 784 784 1396 1318 1174 659 1318 1046 1318 1760 1567 1567 1318 1174 1046 1046 1174 1046 1174 1567 1318 1318 1760 1567 1318 1174 1046 1046 1174 1046 1174 987 880 880 987 880'.split(' ');
    var ctx, i = 0, play = function () {
        if (!AudioContext) {
            return;
        }
        sheet[i] || (i = 0);
        ctx || (ctx = new AudioContext);
        var c = ctx.createOscillator(),
            l = ctx.createGain(),
            m = ctx.createGain();
        c.connect(l);
        l.connect(m);
        m.connect(ctx.destination);
        m.gain.setValueAtTime(1, ctx.currentTime);
        c.type = 'sine';
        c.frequency.value = sheet[i++];
        l.gain.setValueAtTime(0, ctx.currentTime);
        l.gain.linearRampToValueAtTime(1, ctx.currentTime + .01);
        c.start(ctx.currentTime);
        l.gain.exponentialRampToValueAtTime(.001, ctx.currentTime + 1);
        c.stop(ctx.currentTime + 1);
    };
});
