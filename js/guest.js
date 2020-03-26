//
$(document).ready(function ()
{
    //
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    //
    var sidebar = $("#sidebar");
    var content = $("#content");

    var sidebar_open = $("#sidebar-open").click(function ()
    {
        sidebar_close.show();
        $(this).hide();
        content.addClass("col-md-6");
        sidebar.show();
    });
    var sidebar_close = $("#sidebar-close").click(function ()
    {
        sidebar_open.show();
        $(this).hide();
        content.removeClass("col-md-6");
        sidebar.hide();
    });
    sidebar_open.hide();

    var news = $("#news");
    var news_open = $("#news-open").click(function ()
    {
        news_close.show();
        $(this).hide();
        news.show();
    });
    var news_close = $("#news-close").click(function ()
    {
        news_open.show();
        $(this).hide();
        news.hide();
    });
    news_open.hide();

    //
    var h = (typeof $("#big-logo").height() == "undefined" ? 10 : $("#big-logo").height() + 10);

    window.onscroll = (function ()
    {
        if (pageYOffset > h)
            $("#top-menu").css("position", "fixed").css("top", 0);
        else
            $("#top-menu").css("position", "relative");
    });

    //
    $("#log-in").click(function (ev)
    {
        ev.preventDefault();
        $("#sign-in-up").toggleClass("show").css("left", $("#form-sign-in-up").offset().left);
    });

    $(window).click(function (ev)
    {
        if (!$(ev.target).hasClass("dt") && !$(ev.target).hasClass("dropdown-toggle"))
            $(".dropdown-menu.show").removeClass("show");
    });
});