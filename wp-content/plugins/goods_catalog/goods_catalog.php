<?php
/*
Plugin Name: goods_catalog
Plugin URI: http://example.com/
Description: Плагин для управления каталогом товаров
Version: 1.0
Author: example
Author URI: http://example.com
*/
global $wpdb;

define( 'DIV__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'DIV__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once(DIV__PLUGIN_DIR.'functions.php');

add_action( 'admin_init', 'gc_admin_init_style' );
add_action('admin_menu', 'gc_add_pages');

function gc_add_pages() {
    /*
     * Страница Главная
     */
    $menu_item = add_menu_page('Товарный каталог', 'Товарный каталог', 'manage_options', 'goods_catalog', 'gc_plugin_page_main', 'dashicons-cart', 1000);
    add_action( 'admin_print_scripts-'.$menu_item ,  'gc_plugin_main_add_items_scripts' );
    /*
     * Страница Категории атрибутов
     */
    $menu_item2 = add_submenu_page('goods_catalog', 'Группы атрибутов', 'Группы атрибутов', 1, 'gc_att_groups', 'gc_plugin_page_att_groups');
    add_action( 'admin_print_scripts-'.$menu_item2 ,  'gc_plugin_att_groups_add_items_scripts' );
    /*
     * Страница Атрибуты  товара
     */
    $menu_item3 = add_submenu_page('goods_catalog', 'Атрибуты товара', 'Атрибуты товара', 1, 'gc_attributes', 'gc_plugin_page_attributes');
    add_action( 'admin_print_scripts-'.$menu_item3 ,  'gc_plugin_attributes_add_items_scripts' );
    /*
 * Страница Категории цен
 */
    $menu_item2 = add_submenu_page('goods_catalog', 'Группы цен', 'Группы цен', 1, 'gc_price_groups', 'gc_plugin_page_price_groups');
    add_action( 'admin_print_scripts-'.$menu_item2 ,  'gc_plugin_price_groups_add_items_scripts' );
    /*
     * Страница Цен
     */
    $menu_item3 = add_submenu_page('goods_catalog', 'Цены', 'Цены', 1, 'gc_prices', 'gc_plugin_page_prices');
    add_action( 'admin_print_scripts-'.$menu_item3 ,  'gc_plugin_prices_add_items_scripts' );
    /*
     * Страница Категории товара
     */
    $menu_item4 = add_submenu_page('goods_catalog', 'Категории товара', 'Категории товара', 1, 'gc_categories', 'gc_plugin_page_categories');
    add_action( 'admin_print_scripts-'.$menu_item4 ,  'gc_plugin_categories_add_items_scripts' );
    /*
     * Страница Добавить товар
     */
    $menu_item5 = add_submenu_page('goods_catalog', 'Добавить Товар', 'Добавить Товар', 1, 'gc_products', 'gc_plugin_page_products');
    add_action( 'admin_print_scripts-'.$menu_item5 ,  'gc_plugin_products_add_items_scripts' );
    /*
     * Страница Добавить товар
     */
    $menu_item6 = add_submenu_page('goods_catalog', 'Редактировать Товар', 'Редактировать Товар', 1, 'gc_edit_products', 'gc_plugin_page_edit_products');
    add_action( 'admin_print_scripts-'.$menu_item6 ,  'gc_plugin_edit_products_add_items_scripts' );


}

function gc_admin_init_style() {
    wp_enqueue_style('style');


    wp_register_script('jquery.js',        DIV__PLUGIN_URL . '/js/jquery-2.1.3.min.js', $ver = false, $in_footer = false);
    wp_register_script('jquery-ui.min.js', DIV__PLUGIN_URL . '/js/jquery-ui.min.js',   $ver = false, $in_footer = false);
    wp_register_script('tinyMCE.js',       "//cdn.tinymce.com/4/tinymce.min.js", $ver = false, $in_footer = false);


    wp_register_script('gc_js_main.js',         DIV__PLUGIN_URL . '/js/gc_js_main.js', $ver = false, $in_footer = false);
    wp_register_script('gc_js_att_groups.js',   DIV__PLUGIN_URL . '/js/gc_js_att_groups.js', $ver = false, $in_footer = false);
    wp_register_script('gc_js_price_groups.js', DIV__PLUGIN_URL . '/js/gc_js_price_groups.js', $ver = false, $in_footer = false);
    wp_register_script('gc_js_attributes.js',   DIV__PLUGIN_URL . '/js/gc_js_attributes.js', $ver = false, $in_footer = false);
    wp_register_script('gc_js_prices.js',       DIV__PLUGIN_URL . '/js/gc_js_prices.js', $ver = false, $in_footer = false);
    wp_register_script('gc_js_categories.js',   DIV__PLUGIN_URL . '/js/gc_js_categories.js', $ver = false, $in_footer = false);
    wp_register_script('gc_js_products.js',     DIV__PLUGIN_URL . '/js/gc_js_products.js',   $ver = false, $in_footer = false);
    wp_register_script('gc_js_edit_products.js',     DIV__PLUGIN_URL . '/js/gc_js_edit_products.js',   $ver = false, $in_footer = false);

    wp_localize_script( 'gc_js_main.js',         'main_ajax',         array( 'url' => DIV__PLUGIN_URL.'scripts/gcs_main.php' ));
    wp_localize_script( 'gc_js_att_groups.js',   'att_groups_ajax',   array( 'url' => DIV__PLUGIN_URL.'scripts/gcs_att_groups.php' ));
    wp_localize_script( 'gc_js_price_groups.js', 'price_groups_ajax', array( 'url' => DIV__PLUGIN_URL.'scripts/gcs_price_groups.php' ));
    wp_localize_script( 'gc_js_attributes.js',   'attributes_ajax',   array( 'url' => DIV__PLUGIN_URL.'scripts/gcs_attributes.php' ));
    wp_localize_script( 'gc_js_prices.js',       'prices_ajax',       array( 'url' => DIV__PLUGIN_URL.'scripts/gcs_prices.php' ));
    wp_localize_script( 'gc_js_categories.js',   'categories_ajax',   array( 'url' => DIV__PLUGIN_URL.'scripts/gcs_categories.php' ));
    wp_localize_script( 'gc_js_products.js',     'products_ajax',     array( 'prod_url'  => DIV__PLUGIN_URL.'scripts/gcs_products.php',
                                                                             'att_url'   => DIV__PLUGIN_URL.'scripts/gcs_attributes.php',
                                                                             'price_url' => DIV__PLUGIN_URL.'scripts/gcs_prices.php'));

    wp_localize_script( 'gc_js_edit_products.js',     'products_ajax',     array( 'prod_url'  => DIV__PLUGIN_URL.'scripts/gcs_products.php',
                                                                             'att_url'   => DIV__PLUGIN_URL.'scripts/gcs_attributes.php',
                                                                             'price_url' => DIV__PLUGIN_URL.'scripts/gcs_prices.php'));
}

/*
 * Страница Главная
 */
function gc_plugin_main_add_items_scripts() {
    wp_enqueue_script( 'jquery.js' );
    wp_enqueue_script( 'gc_js_main.js' );
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');

}
function gc_plugin_page_main() {
    load_template(DIV__PLUGIN_DIR.'gc_view_main.php', true);
}

/*
 * Страница Категории атрибутов
 */
function gc_plugin_att_groups_add_items_scripts() {
    wp_enqueue_script( 'jquery.js' );
    wp_enqueue_script( 'gc_js_att_groups.js' );

}
function gc_plugin_page_att_groups() {
    load_template(DIV__PLUGIN_DIR.'gc_view_att_groups.php', true);
}

/*
 * Страница Атрибуты
 */
function gc_plugin_attributes_add_items_scripts() {
    wp_enqueue_script( 'jquery.js' );
    wp_enqueue_script( 'gc_js_attributes.js' );
}
function gc_plugin_page_attributes() {
    load_template(DIV__PLUGIN_DIR.'gc_view_attributes.php', true);
}
/*
 * Страница Категории цен
 */
function gc_plugin_price_groups_add_items_scripts() {
    wp_enqueue_script( 'jquery.js' );
    wp_enqueue_script( 'gc_js_price_groups.js' );

}
function gc_plugin_page_price_groups() {
    load_template(DIV__PLUGIN_DIR.'gc_view_prices_groups.php', true);
}

/*
 * Страница цен
 */
function gc_plugin_prices_add_items_scripts() {
    wp_enqueue_script( 'jquery.js' );
    wp_enqueue_script( 'gc_js_prices.js' );
}
function gc_plugin_page_prices() {
    load_template(DIV__PLUGIN_DIR.'gc_view_prices.php', true);
}
/*
 * Страница Категории товара
 */
function gc_plugin_categories_add_items_scripts() {
    wp_enqueue_script( 'tinyMCE.js' );
    wp_enqueue_script( 'jquery.js' );
    wp_enqueue_script( 'jquery-ui.min.js' );

    wp_enqueue_script( 'gc_js_categories.js' );
}
function gc_plugin_page_categories() {
    load_template(DIV__PLUGIN_DIR.'gc_view_categories.php', true);
}

/*
 * Страница Товар
 */
function gc_plugin_products_add_items_scripts() {
    wp_enqueue_script( 'tinyMCE.js' );
    wp_enqueue_script( 'jquery.js' );
    wp_enqueue_script( 'jquery-ui.min.js' );

    wp_enqueue_script( 'gc_js_products.js' );

}
function gc_plugin_page_products() {
    load_template(DIV__PLUGIN_DIR.'gc_view_products.php', true);
}
/*
 * Страница Редактировать Товар
 */
function gc_plugin_edit_products_add_items_scripts() {
    wp_enqueue_script( 'tinyMCE.js' );
    wp_enqueue_script( 'jquery.js' );
    wp_enqueue_script( 'jquery-ui.min.js' );

    wp_enqueue_script( 'gc_js_edit_products.js' );

}
function gc_plugin_page_edit_products() {
    load_template(DIV__PLUGIN_DIR.'gc_view_edit_products.php', true);
}