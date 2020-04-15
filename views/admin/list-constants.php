
<a href="<?= ROOT ?>admin/constants/create"><i class="fa fa-plus-circle"></i></a>

<?php

/** @var $constants \app\models\crud\Constant[] */

foreach ($constants as $constant)
{
    echo "<div class='row'>";
    echo "<div class='col-md-2'>" . $constant->name . "</div>";
    echo "<div class='col-md-2'><i class='inline'><h3>[</h3>"
        . $constant->key . "<h3>]</h3></i></div>";
    echo "<div class='col-md-3'>" . $constant->value . "</div>";
    echo "<div class='col-md-3'>" . $constant->translate . "</div>";
    echo "<div class='col-md-1'><a href='" . ROOT . "admin/constants/"
        . $constant->id . "/modify'><i class='fa fa-pencil'></i></a></div>";
    echo "<form method='post' class='col-md-1'><button type='submit' name='id' value='"
        . $constant->id . "'><i class='fa fa-trash'></i></button></form>";
    echo "</div>";
}