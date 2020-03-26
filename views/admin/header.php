<?php
use app\UnderGround as UG;

$logo = UG::searchModel("constants.", ['name' => "big-logo"], true);

function link_tag($icon, $path = "")
{
    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\""
        . ROOT . "admin/$path\"><i class=\"fa fa-2x fa-$icon\"></i></a></li>";
}

//
if (is_object($logo) && is_file($home . $logo->value))
    echo "<img src=\"$home{$logo->value}\" id=\"big-logo\" alt=\"\">";
?>

<nav class="navbar navbar-expand-md navbar-light bg-light" id="admin-nav">
    <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation"
            data-toggle="collapse" data-target="#admin-nav-content" aria-controls="admin-nav-content">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="admin-nav-content">
        <ul class="navbar-nav mr-auto">
            <?php
            link_tag("home");
            link_tag("file-text", "pages");
            link_tag("list", "menus");
            //link_tag("th", "sections");
            link_tag("bullhorn", "blog");
            link_tag("code", "short_codes");
            link_tag("commenting", "reviews");
            link_tag("user", "users");
            link_tag("cog", "constants");
            ?>
        </ul>

        <div class="form-inline my-2 my-lg-0" id="form-sign-in-up">
            <a class="nav-item nav-link" href="<?=ROOT?>">
                <i class="fa fa-2x fa-reply"></i>
            </a>
            <form method="post" action="<?=ROOT?>admin">
                <button class="nav-item nav-link" type="submit" name="exit">
                    <i class="fa fa-2x fa-user-times"></i>
                </button>
            </form>
        </div>
    </div>
</nav>