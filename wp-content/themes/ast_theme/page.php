<?php get_header(); ?>
<div class="col-sm-12 grey_fon" style="height:150px;margin-bottom: 0px">
    <div class="col-sm-12">
        <h1 class="headTitle">
            <b><?php the_title(); ?></b>
        </h1>
    </div>
</div>
<div class="col-sm-12 menuBlock">
    <nav>
        <?php
        wp_nav_menu( array(
            'menu_class'=>'',
            'theme_location'=>'main',
            'after'=>''
        ) );
        ?>
    </nav>
</div>

<div class="col-sm-12">
    <section class="main-content">
        <div class="col-sm-12 styleTextPages ">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php
                the_content();
            endwhile; else:
                _e('Извините такой страницы не найдено!');
            endif;
            ?>
        </div>
    </section>
</div>

<div style="clear:both;"></div>
<?php get_footer(); ?>