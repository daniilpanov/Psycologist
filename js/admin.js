$(document).ready(function ()
{
    //
    ratingSetUp();

    var replace = true;

    function content_view_short_codes_inspect(view)
    {
        console.log(view.children(".short_code_replacement").find("*").blur(function ()
        {
            replace = true;
        }).click(function ()
        {
            return false;
        }).on("keyup keydown change focus", function ()
        {
            replace = false;
            $(this).blur();
            return false;
        }));
    }

    function short_codes_init()
    {
        $.ajax({
            url: $("meta[name='root-path']").prop("content") + "realtime-php/short_codes_replace.php",
            data: {content: content_base.prop("value")},
            method: "post",
            dataType: "text",

            success: (function (text)
            {
                content_view.html(text);
                content_view_short_codes_inspect(content_view);
            }),

            error: (function ()
            {
                alert("ERROR!!!");
            })
        });
    }

    var content_base = $("#content-base").on("keyup change", function ()
    {
        setTimeout(short_codes_init);
    });
    var content_view = $("#content-view").on("keyup change", function ()
    {
        if (replace)
        {
            content_base.prop("value", content_view.html());
            content_view_short_codes_inspect(content_view);
        }
    });
    var b = $("#save").click(function ()
    {
        content_view.html("");
        return true;
    });

    content_view_short_codes_inspect(content_view);
    //
    b.appendTo($("#content").children("form[method='post']"));
});