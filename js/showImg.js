(function(){
    addZoom(".content .post img");
    function getTop(){
        var scrollTop = 0;
        if (document.documentElement && document.documentElement.scrollTop) {
            scrollTop = document.documentElement.scrollTop;
        } else if (document.body) {
            scrollTop = document.body.scrollTop;
        }
        return scrollTop;
    }

    function _reachBottom() {
        var scrollTop = 0, clientHeight = 0, scrollHeight = 0;
        scrollTop = getTop();

        if (document.body.clientHeight && document.documentElement.clientHeight) {
            clientHeight = (document.body.clientHeight < document.documentElement.clientHeight) ? document.body.clientHeight
    : document.documentElement.clientHeight;
        } else {
            clientHeight = (document.body.clientHeight > document.documentElement.clientHeight) ? document.body.clientHeight
                : document.documentElement.clientHeight;
        }
        scrollHeight = Math.max(document.body.scrollHeight,
                document.documentElement.scrollHeight);
        return (scrollHeight - scrollTop - clientHeight);
    }
    // 双击滚屏
    var currentpos, timer;
    var step = 1;
    function initialize() {
        timer = setInterval(scrollwindow, 20);
    }
    function sc() {
        clearInterval(timer);
        step = 1;
    }
    function scrollwindow() {
        window.scrollBy(0, step);

        if (step == 1 && _reachBottom() < 10) {
            step = -1;
        }else if(step == -1 && getTop() < 10){
            step = 1;
        }
    }
    document.onmousedown = sc;
    document.ondblclick = initialize;

})(); 
