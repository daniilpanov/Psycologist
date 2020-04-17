//
$(document).ready(function ()
{
    // Additionally for Bootstrap 4 Dropdown Menus
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    // Элементы, для которых реализованы разные эффекты
    var sidebar = $("#sidebar");
    var content = $("#content");
    var news = $("#news");

    // Возможность скрывать боковое меню
    // Открытие
    var sidebar_open = $("#sidebar-open").click(function ()
    {
        sidebar_close.show();
        $(this).hide();
        content.addClass("col-md-6");
        sidebar.show();
    });
    // Закрытие
    var sidebar_close = $("#sidebar-close").click(function ()
    {
        sidebar_open.show();
        $(this).hide();
        content.removeClass("col-md-6");
        sidebar.hide();
    });
    sidebar_open.hide();

    // Возможность скрывать блог
    // Открытие
    var news_open = $("#news-open").click(function ()
    {
        blog_toggle();
    });
    // Закрытие
    var news_close = $("#news-close").click(function ()
    {
        blog_toggle();
    });
    news_open.hide();

    // Если страница пролистана до определённой точки (переменная 'h')
    var h = (typeof $("#big-logo").height() == "undefined" ? 10 : $("#big-logo").height() + 10);
    // то закрепляем (или открепляем) верхнее меню
    window.onscroll = (function ()
    {
        if (pageYOffset > h)
        {
            $("#top-menu").css("position", "fixed").css("top", 0);
            news.css("margin-top", "60px");
        }
        else
        {
            $("#top-menu").css("position", "relative");
            news.css("margin-top", "0");
        }
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

    function sidebar_toggle()
    {

    }

    // Скрытие / открытие блога
    function blog_toggle()
    {
        if (news.hasClass("nhide"))
        {
            news_close.show();
            news_open.hide();
        }
        else
        {
            news_open.show();
            news_close.hide();
        }

        news.toggleClass("nshow");
        news.toggleClass("nhide");
    }
});