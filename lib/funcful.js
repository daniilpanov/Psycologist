let current_el = null;

function ratingSetUp()
{
    $(".rating-stars").each(function ()
    {
        let stars = this;
        starsSetUp(stars);
        $(this).find(".star").click(function ()
        {
            current_el.removeClass("star-selected");
            current_el = $(this);
            current_el.addClass("star-selected");
            starsSetUp(stars);
        });
    });
}

function starsSetUp(el)
{
    let ok = true;

    $(el).find(".star").each(function ()
    {
        if (ok === true)
        {
            $(this).addClass("active-star");
            current_el = $(this);
        }
        else if ($(this).hasClass("active-star"))
            $(this).removeClass("active-star");

        if ($(this).hasClass("star-selected"))
            ok = false;
    });
}