<?php

/** @var $review \app\models\crud\Review|null */
/** @var $pages \app\models\crud\Page[] */

$mod = $review && is_object($review);
?>

<form method="post">
    <?= $mod ? "<div class='row'><div class='col-md-3'>ID: </div>"
        . "<div class='col-md-7'><input type='text' name='id' value='{$review->id}' readonly></div></div>"
        : "" ?>

    <div class="row">
        <div class="col-md-3">
            <label for="title">Заголовок</label>
        </div>
        <div class="col-md-7">
            <input id="title" type="text" name="title" value="<?= $mod ? $review->title : "" ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            Рейтинг
        </div>
        <div class="col-md-7">
            <?php
            echo "<div class='rating-stars'>";

            for ($i = 1; $i <= 5; $i++)
            {
                echo "<label class='star"
                    . (($mod && $i == $review->rating) || $i > 4 ? " star-selected" : "")
                    . "'><input type='radio' name='rating' value='$i'"
                    . (($mod && $i == $review->rating) || $i > 4  ? " checked" : "")
                    . "></label>";
            }

            echo "</div>";
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label for="content">Отзыв</label>
        </div>
        <div class="col-md-7">
            <textarea id="content" name="content"><?= $mod ? $review->content : "" ?></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label>Привязка к странице: </label>
        </div>
        <div class="col-md-7">
            <select name="page_id">
                <option value="0"
                    <?= $mod
                    && ($review->page_id == null
                        || $review->page_id == '0'
                    ) ? " selected" : "" ?>>
                    Без привязки к странице
                </option>
                <?php
                foreach ($pages as $page)
                {
                    echo "<option value='" . $page->id . "'"
                        . ($mod && $page->id == $review->page_id ? " selected" : "")
                        . ">" . $page->name . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <?php
    if (!$mod || ($mod && \app\controllers\UsersController
                ::get()->getUser()->id == $review->user_id)
    )
    {
        ?>
        <div class="row">
            <div class="col-md-3">
                <label>Видимость данных пользователя</label>
            </div>
            <div class="col-md-7">
                <select name="user">
                    <option value="visible"
                        <?= $mod && $review->user == "visible"
                            ? " selected" : "" ?>>
                        Показать
                    </option>
                    <option value="hidden"
                        <?= $mod && $review->user == "hidden"
                            ? " selected" : "" ?>>
                        Скрыть
                    </option>
                </select>
            </div>
        </div>
        <?php
    }
    ?>

    <button type="submit" class="btn btn-primary">
        Сохранить
    </button>
</form>
