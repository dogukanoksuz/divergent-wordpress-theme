<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package divergent_Wordpress_theme
 */

function divergent_header_menu(string $menu_id): void
{
    foreach (wp_get_nav_menu_items($menu_id) as $item) {
        printf('<li itemprop="name" role="menuitem" class="d-lg-block d-none"><a itemprop="url" href="%2$s" title="%1$s">%1$s</a></li>', $item->title, $item->url);
    }
}

function divergent_mobile_menu(string $menu_id): void
{
    foreach (wp_get_nav_menu_items($menu_id) as $item) {
        printf('<li><a itemprop="url" href="%2$s" title="%1$s">%1$s</a></li>', $item->title, $item->url);
    }
}

