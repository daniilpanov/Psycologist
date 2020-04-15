
<a href="<?= ROOT ?>admin/users/create"><i class="fa fa-plus-circle"></i></a>

<?php

/** @var $users \app\models\crud\User[] */

foreach ($users as $user)
{
    echo "<div class='row'>";
    echo "<div class='col-md-5'>" . $user->name . "</div>";
    echo "<div class='col-md-3'>" . $user->login . "</div>";
    echo "<div class='col-md-2'><a href='" . ROOT . "admin/users/"
        . $user->id . "/modify'><i class='fa fa-pencil' title='Редактировать'></i></a></div>";
    echo "<form method='post' class='col-md-2'><button type='submit' name='id' value='"
        . $user->id . "'><i class='fa fa-trash' title='Удалить'></i></button></form>";
    echo "</div>";
}