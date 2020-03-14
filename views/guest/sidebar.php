<?php

use app\UnderGround as UG;

function print_pages_at_menu($menu)
{
    if ($pages = UG::searchModel("menu.Page", ['menu_id' => $menu->id, 'visible_in' => ["s", "ts"]]))
    {
        foreach ($pages as $page)
        {
            echo "<a href='page/id" . $page->id . "'>" . $page->name . "</a>";
            print_pages_at_page($page);
        }
    }
}

function print_pages_at_page($page)
{
    if ($pages = UG::searchModel("menu.Page", ['parent_id' => $page->id, 'visible_in' => ["s", "ts"]]))
    {
        foreach ($pages as $page)
        {
            echo "<a href='page/id" . $page->id . "'>" . $page->name . "</a>";
            //print_pages_at_page($page);
        }
    }
}

$menus = \app\UnderGround::searchModel("menu.Menu", ['visible_in' => ["s", "ts"]]);

if ($menus)
{
    foreach ($menus as $menu)
    {
        echo "<h3>" . $menu->name . "</h3>";
        print_pages_at_menu($menu);
    }
}