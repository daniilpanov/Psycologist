
<a href="<?=ROOT?>admin/short_codes/create"><i class="fa fa-plus-circle"></i></a>

<pre>
    <?php

    /** @var $short_codes \app\models\crud\short_codes\ShortCodeModelBase[] */


    foreach ($short_codes as $short_code)
    {
        $id = $short_code->id;

        echo "<div class='row text-center'>";
        echo "<div class='col-md-3'><a href='"
            . ROOT . "admin/short_codes/$id/modify'>[<i>" . $short_code->code . "</i>]</a></div>";
        echo "<div class='col-md-1'><b>" . $short_code->type . "</b></div>";
        echo "<div class='col-md-5'><small>"
            . ($short_code->comment ? $short_code->comment : " -- ") . "</small></div>";
        echo "<form class='col-md-2' method='post'><button type='submit' name='id' value='$id'>Удалить</button></form>";
        echo "</div>";
    }
    ?>
</pre>