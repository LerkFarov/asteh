<?php
global $wpdb;
require_once("scripts/prod_get_scripts.php");
function ast_scripts() {
    wp_deregister_script( 'jquery' );
    if(get_the_ID() == 27){
            wp_enqueue_script('map_js', get_template_directory_uri() .'/scripts/map.js', array(), $ver = false, $in_footer = false);
        }
    wp_enqueue_script('jquery', get_template_directory_uri() .'/source/jquery-2.1.3.min.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('mousewheel.min.js', 'http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.0.6/jquery.mousewheel.min.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('fancybox.pack.js', 'http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.pack.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('fancybox-buttons.js', 'http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-buttons.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('fancybox-media.js', 'http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-media.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('fancybox-thumbs.js', 'http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-thumbs.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('common.js', get_template_directory_uri() .'/source/common.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('botstrap.min.js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('main.js', get_template_directory_uri() .'/scripts/main.js', array(), $ver = false, $in_footer = false);
    wp_enqueue_script('swet.js', get_template_directory_uri() .'/scripts/sweetalert.min.js', array(), $ver = false, $in_footer = false);

    wp_enqueue_style( 'swetalert.css', get_template_directory_uri() .'/css/sweetalert.css');
    wp_enqueue_style( 'fancybox.css', 'http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.css');
    wp_enqueue_style( 'fancybox-buttons.css', 'http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-buttons.css');
    wp_enqueue_style( 'fancybox-thumbs.css', 'http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/helpers/jquery.fancybox-thumbs.css');
    wp_enqueue_style( 'exo-2', 'https://fonts.googleapis.com/css?family=Exo+2:400,100,200,300,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic');
}

add_action( 'wp_enqueue_scripts', 'ast_scripts' );

register_nav_menus(array(
    'main'    => 'Главное меню'
));

function mytheme_customize_register($wp_customize)
{
    $wp_customize->add_section(
// ID
        'data_site_section',
        // Arguments array
        array(
            'title' => 'Данные Темы AST',
            'capability' => 'edit_theme_options',
            'description' => "Тут можно указать данные сайта"
        )
    );

    $wp_customize->add_setting(
// ID
        'theme_worktext',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
// ID
        'theme_worktext_control',
        // Arguments array
        array(
            'type' => 'text',
            'label' => "График работы",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'theme_worktext'
        )
    );

    $wp_customize->add_setting(
// ID
        'theme_address',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
// ID
        'theme_address_control',
        // Arguments array
        array(
            'type' => 'text',
            'label' => "Адрес",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'theme_address'
        )
    );

    $wp_customize->add_setting(
// ID
        'theme_email',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
// ID
        'theme_email_control',
        // Arguments array
        array(
            'type' => 'text',
            'label' => "Email",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'theme_email'
        )
    );

    $wp_customize->add_setting(
// ID
        'theme_telephone',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
// ID
        'theme_telephone_control1',
        // Arguments array
        array(
            'type' => 'text',
            'label' => "Текст с телефоном",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'theme_telephone'
        )
    );

    $wp_customize->add_section(
    // ID
        'data_social_section',
        // Arguments array
        array(
            'title' => 'Социальные сети',
            'capability' => 'edit_theme_options',
            'description' => "Тут можно указать ссылки на соц. сети"
        )
    );

    $wp_customize->add_setting(
        'theme_soc_vk',
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
        'theme_vk_control',
        array(
            'type' => 'text',
            'label' => "Ссылка на ВК",
            'section' => 'data_social_section',
            // This last one must match setting ID from above
            'settings' => 'theme_soc_vk'
        )
    );

    $wp_customize->add_setting(
        'theme_soc_t',
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
        'theme_t_control',
        array(
            'type' => 'text',
            'label' => "Ссылка на Twitter",
            'section' => 'data_social_section',
            // This last one must match setting ID from above
            'settings' => 'theme_soc_t'
        )
    );

    $wp_customize->add_setting(
        'theme_soc_m',
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
        'theme_m_control',
        array(
            'type' => 'text',
            'label' => "Ссылка на Mail",
            'section' => 'data_social_section',
            // This last one must match setting ID from above
            'settings' => 'theme_soc_m'
        )
    );

    $wp_customize->add_setting(
        'theme_soc_f',
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
        'theme_f_control',
        array(
            'type' => 'text',
            'label' => "Ссылка на Facebook",
            'section' => 'data_social_section',
            // This last one must match setting ID from above
            'settings' => 'theme_soc_f'
        )
    );
    $wp_customize->add_setting(
        'theme_soc_ok',
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
        'theme_ok_control',
        array(
            'type' => 'text',
            'label' => "Ссылка на Однокласники",
            'section' => 'data_social_section',
            // This last one must match setting ID from above
            'settings' => 'theme_soc_ok'
        )
    );


}

add_action('customize_register', 'mytheme_customize_register');

remove_action('wp_head', 'rel_canonical');

add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');