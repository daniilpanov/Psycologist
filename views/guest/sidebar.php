<?php

use app\UnderGround as UG;

function print_pages_at_menu($menu)
{
    if ($pages = UG::searchModel("menu.Page", ['menu_id' => $menu->id, 'visible_in' => ["s", "ts"]]))
    {
        foreach ($pages as $page)
        {
            echo "<li><a href='" . ROOT . "page/id" . $page->id . "'>" . $page->name . "</a></li>";
            print_pages_at_page($page);
        }
    }
}

function print_pages_at_page($page)
{
    if ($pages = UG::searchModel("menu.Page", ['parent_id' => $page->id, 'visible_in' => ["s", "ts"]]))
    {
        echo "<ul class='pages-list'>";
        foreach ($pages as $page)
        {
            echo "<li><a href='" . ROOT . "page/id" . $page->id . "'>" . $page->name . "</a></li>";
            print_pages_at_page($page);
        }
        echo "</ul>";
    }
}

$menus = UG::searchModel("menu.Menu");

if ($menus)
{
    foreach ($menus as $menu)
    {
        echo "<h3>" . $menu->name . "</h3>";
        echo "<ul class='menu-list'>";
        print_pages_at_menu($menu);
        echo "</ul>";
    }
}