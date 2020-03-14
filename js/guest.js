$(document).ready(function ()
{
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    var sidebar = $("#sidebar");
    var content = $("#content");

    var sidebar_open = $("#sidebar-open").click(function ()
    {
        sidebar_close.show();
        $(this).hide();
        content.addClass("col-md-7");
        sidebar.show();
    });
    var sidebar_close = $("#sidebar-close").click(function ()
    {
        sidebar_open.show();
        $(this).hide();
        content.removeClass("col-md-7");
        sidebar.hide();
    });

    sidebar_open.hide();
});