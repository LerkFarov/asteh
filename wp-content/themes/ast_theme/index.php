<?php
/*
Template Name: Шаблон главной
*/
get_header(); ?>

<?php $categories = get_all_cats($wpdb); ?>

<div class="main-wrap">
    <div class="grey_fon">
        <div class="slogan_text">
            <div class="orenda">АРЕНДА</div>
            <div class="orenda2">СТРОИТЕЛЬНОЙ ТЕХНИКИ</div>
            <div class="orenda3">
                <ul class="oput" style="padding-left: 0px">
                    <li style="display: inline;">ОПЫТ</li>
                    <li style="display: inline;">СЕРВИС</li>
                    <li style="display: inline;">КАЧЕСТВО</li>
                </ul>
            </div>
        </div>
        <div class="work-text-container">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/golgov_foto.png">
            <div class="banner"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/banner.png"></div>
            <span>Звонить <?php print_r(get_option('theme_worktext')); ?></span>
        </div>
    </div>
    <div class="col-sm-12" style="padding: 0; display: none;">
        <?php
        foreach ($categories as $category) { ?>
            <div class="category-box-top" style="text-align: center">
                <a title="<?= $category->name; ?>" href="<?=get_home_url();?>/categories/?id=<?= $category->id; ?>">
                    <img src="<?=get_home_url();?><?= $category->thumbnail; ?>" alt="<?= $category->name; ?>" title="<?= $category->name; ?>" style="height: 78px;">
                    <div class="categ_name1"><?= $category->name; ?></div>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="col-sm-12"
         style="border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;padding-top: 10px;padding-bottom: 10px;margin-bottom: 10px;margin-top: -10px">
        <nav>
            <?php
            wp_nav_menu(array(
                'menu_class' => '',
                'theme_location' => 'main',
                'after' => ''
            ));
            ?>
        </nav>
    </div>
    <div style="height:100%; position: relative; margin-top: 75px;">
        <div class="col-sm-3" style="padding: 0;    position: absolute;    top: 0px;     width: 165px;   height: 100%;">
            <div class="row" style="height: 100%;">
                <div class="col-sm-12" style="width:201px;height: 100%;">
                    <div class="left_menu" style="height: 100%;">
                        <div class="left_menu_header">
                            <p class="left_menu_title">Аренда инструмента</p>
                        </div>
                        <div class="left_menu_body">

                            <?php
                            foreach ($categories as $category) {

                                ?>
                                <div class="left_menu_elem">
                                    <a title="<?= $category->second_name; ?>" href="<?=get_home_url();?>/categories/?id=<?= $category->id; ?>" class="left_menu_link"
                                       style="<?php if($category->id == $_GET['id']){
                                           echo "color:#ffe25a;";
                                       }?>"
                                    >
                                        <?= $category->second_name; ?>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-sm-9" style="padding: 0; float: right;">
            <div class="col-sm-12" style="padding: 0;">
                <?php
                foreach ($categories as $category) { ?>
                    <div class="category-box-top" style="text-align: center">
                        <a title="<?= $category->name; ?>" href="<?=get_home_url();?>/categories/?id=<?= $category->id; ?>">
                            <img src="<?=get_home_url();?><?= $category->thumbnail; ?>" alt="<?= $category->name; ?>" title="<?= $category->name; ?>" style="height: 78px;">
                            <div class="categ_name1"><?= $category->name; ?></div>
                        </a>
                    </div>
                <?php } ?>

            </div>
            <div class="col-sm-12 styleTextPages">
                <?php
                if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <h1><?php the_title(); ?></h1>
                    <?php the_content() ?>
                    <?php
                endwhile;
                else:
                    _e('Извините, такой страницы не найдено!');
                endif;
                ?>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>


    <div style="clear:both;"></div>
</div>
<?php get_footer(); ?>
