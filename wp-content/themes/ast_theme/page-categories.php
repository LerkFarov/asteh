<?php
require_once("scripts/prod_get_scripts.php");
?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="<?php echo get_post_meta($post->ID, 'description', true); ?>"/>
        <meta name="keywords" content="<?php echo get_post_meta($post->ID, 'keywords', true); ?>"/>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/style.css" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=geometry'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
              crossorigin="anonymous">
        <title><?php $category = get_category_name($wpdb, $_GET['id']);
            echo $category[0]->name; ?></title>
        <?php wp_head() ?>
    </head>
<body>
<div class="containter" style="height: 136px;">
    <div class="header_fon">
        <div class="text-color_grey map-marker">
            <?php print_r(get_option('theme_address')); ?>
        </div>
        <div class="text-color_grey email-block">
            <?php print_r(get_option('theme_email')); ?>
        </div>
        <div class="call_back">
            <a data-toggle="modal" data-target="#myModal" class="btn btn-default pull-right call_back_button">Заказать
                звонок</a>
        </div>
        <div class="text-color_grey phone-block">
            <?php print_r(get_option('theme_telephone')); ?>
        </div>
    </div>
    <div class="ast_logo_block">
        <a title="на главную" href="/"><img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/images/ast_logo.png" alt="Аренда инструмента"></a>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="background-color: #f2f2f2;width:300px;margin-left: 150px">
            <div class="modal-header" style="text-align: center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style='padding:0px;margin-top:30px;margin-bottom: 30px' align='center'>ЗАКАЗАТЬ
                    ЗВОНОК</h3>
                <form>
                    <input type="hidden" name="type" value="call_back">
                    <input type="text" class="form-control" placeholder="Ваше имя:" name="name"
                           style="width:90%;margin:0 auto; margin-bottom:30px;" required>
                    <input type="text" class="form-control" placeholder="Ваш номер телефона:" name="telefon"
                           style="width:90%;margin:0 auto;margin-bottom:30px" required>
                    <input type="submit" class="btn btn-default call_back_button"
                           style="color:white;margin:0 auto;font-size: 16px" value="Заказать">
                </form>
            </div>
        </div>

    </div>
</div>

<?php $categories = get_all_cats($wpdb); ?>
<div class="col-sm-12 grey_fon" style="height:150px;margin-bottom: 0px">
    <div class="col-sm-12">
        <h1 class="headTitle">
            <b>
                <?php
                $category = get_category_name($wpdb, $_GET['id']);
                echo $category[0]->name;

                $q = "SELECT cats.parent, cats.`name`, cats.id FROM ".$wpdb->prefix."gc_categories AS cats WHERE cats.id = '".$_GET['id']."'";

                $res = $wpdb->get_results($q);
                ?>
            </b>
        </h1>
    </div>
</div>

<div class="col-sm-12 my_breadcrumbs">
    <?php
        if($res[0]->parent != '0'){
            $q_p = "SELECT cats.`name`, cats.id FROM ".$wpdb->prefix."gc_categories AS cats WHERE cats.id = '".$res[0]->parent."'";
            $res_p = $wpdb->get_results($q_p);
            $my_breadcrumbs = "<a href='http://".$_SERVER['SERVER_NAME']."/categories/?id=".$res_p[0]->id."'>".$res_p[0]->name."</a><span> > <span>".$res[0]->name."</span>";
        }else{
            $my_breadcrumbs = "<span>".$res[0]->name."</span>";
        }
    echo($my_breadcrumbs);
    ?>

</div>

<div class="col-sm-12"
     style="border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;padding-top: 10px;padding-bottom: 10px;margin-bottom: 10px;margin-top: 20px">
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

<div class="row">

        <div class="col-sm-12" style="padding: 0;">
            <div class="col-sm-3">
                <div class="left_menu">
                    <div class="left_menu_header">
                        <p class="left_menu_title">Виды техники</p>
                    </div>
                    <div class="left_menu_body">

                        <?php
                        foreach ($categories as $category) {

                            ?>
                            <p class="left_menu_elem">
                                <a title="<?= $category->second_name; ?>" href="<?=get_home_url();?>/categories/?id=<?= $category->id; ?>" class="left_menu_link"
                                   style="<?php if($category->id == $_GET['id']){
                                       echo "color:#ffe25a;";
                                   }?>"
                                >
                                    <?= $category->second_name; ?>
                                </a>
                            </p>
                        <?php } ?>

                    </div>
                </div>

            </div>
            <div class="col-sm-9" style="padding: 0;">
                <?php

                $subcats = get_sub_cats($wpdb, $_GET['id']);

                if (isset($subcats) && !empty($subcats)) {
                    ?>
                    <div class="col-sm-12" style="margin-bottom: 25px; padding:0;">
                        <?php

                        foreach ($subcats as $category) {
                            /* if ($i == 3) {
                                 break;
                             }*/
                            ?>
                            <div class="col-sm-4 homeCategoryHover"
                                 style="position:relative;padding-left:2px;padding-right: 2px; margin-top:4px;">
                                <a title="<?= $category->name; ?>" href="/categories/?id=<?= $category->id; ?>">
                                    <img src="<?= get_home_url(); ?><?= $category->image; ?>" alt="<?= $category->name; ?>"
                                         style="width:100%;height:194px;">
                                    <div class="col-sm-12" style="padding:0px;position:relative;">
                                        <div class="absolute_fon" style="padding-left:15px; height: 82px;">
                                            <div class="categoryName"><?= $category->name; ?> <img
                                                        src="<?php echo esc_url(get_template_directory_uri()); ?>/images/viewIcon.png"
                                                        class="viewIcon"></div>
                                            <span class="category-after-name">Всего</span>
                                            <span
                                                    class="countProductCategory"><?= $category->p_count ? $category->p_count : 0; ?></span>
                                            <span class="category-after-name">моделей</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }

                ?>

                <?php

                $products = get_product_by_cat($_GET['id'], $wpdb);
                foreach ($products as $product) { ?>
                    <div class="col-sm-12" style="padding: 0;">

                        <div class="col-sm-12" style="padding: 0;">
                            <div class="col-sm-12" style="padding: 0;">
                                <div class="categ-product-head">
                                    <div class="text-head"><a title="<?= $product->name; ?>"
                                                              href="<?= get_home_url(); ?>/product/?id=<?= $product->id; ?>&cat_id=<?=$_GET['id']?>"><?= $product->name; ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <?php
                                if (isset($product->images)) {
                                    foreach ($product->images as $image) { ?>
                                        <a href="<?= get_home_url(); ?>/product/?id=<?= $product->id; ?>&cat_id=<?=$_GET['id']?>">
                                            <img src="<?= get_home_url(); ?>/<?= $image->url; ?>" alt="<?= $product->name; ?>"
                                                 style="width:100%;border:1px solid #d9d9d9;">
                                        </a>
                                    <?php }

                                } ?>
                            </div>
                            <div class="col-sm-9" style="padding: 0;">
                                <div class="col-sm-8">
                                    <?php if (isset($product->params)) { ?>
                                        <table class="table table-bordered product_options">
                                            <tr>
                                                <th style="background-color: #f2f2f2" colspan="3">Основные технические характеристики
                                                </th>
                                            </tr>
                                            <?php foreach ($product->params as $param) { ?>
                                                <tr>
                                                    <td><?= $param->name; ?></td>
                                                    <td><?= $param->unit; ?></td>
                                                    <td><?= $param->value; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    <?php } ?>

                                </div>
                                <?php if (isset($product->prices)) { ?>
                                    <div class="col-sm-4" style="padding: 0;">
                                        <table class="table tableOrenda table-bordered">
                                            <tr>

                                                <th style="background-color: #b3b3b3;color:white;"><?php echo $product->type; ?></th>
                                                <th style="background-color: #b3b3b3;color:white;">Руб.</th>
                                            </tr>
                                            <?php foreach ($product->prices as $price) { ?>
                                                <tr>
                                                    <td style="background-color: #f2f2f2;color:#808080;"><?= $price->name; ?></td>
                                                    <td style="background-color: #f2f2f2;color:#95b001;"><?= $price->value; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>

                                    </div>
                                <?php } ?>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <a title="Подробнее" href="<?= get_home_url(); ?>/product/?id=<?= $product->id; ?>">
                                            <button class="btn btn-default pull-right more-button"><b>Подробнее</b></button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0;">
                                    <div class="row">
                                        <button style="width:80%" data-toggle="modal" data-target="#myModal<?= $product->id; ?>"
                                                class="btn btn-default pull-right rent-button" data-name="<?= $product->name; ?>">
                                            <b><?php
                                                switch ($product->type) {
                                                    case "Аренда":
                                                        echo "Арендовать";
                                                        break;
                                                    case "Продажа":
                                                        echo "Купить";
                                                        break;

                                                }
                                                ?></b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="myModal<?= $product->id; ?>" role="dialog" style="margin-top: 200px;">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content" style="background-color: #f2f2f2;width:300px;margin-left: 150px">
                                <div class="modal-header" style="text-align: center">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title" style='padding:0px;margin-top:30px;margin-bottom: 20px' align='center'>
                                        ЗАПОЛНИТЬ ФОРМУ</h3>
                                    <div style="padding-left: 20px">
                        <span style="float:left;"><?php
                            switch ($product->type) {
                                case "Аренда":
                                    echo "Арендовать";
                                    break;
                                case "Продажа":
                                    echo "Купить";
                                    break;

                            }
                            ?>:</span><br>
                                        <h4 style="color:#ffd200;text-align:left"><?= $product->name; ?></h4>
                                    </div>
                                    <form>
                                        <input type="hidden" name="type" value="orenda">
                                        <input type="hidden" name="tovar" value="<?= $product->name; ?>">
                                        <input type="text" class="form-control" placeholder="Ваше имя:" name="name"
                                               style="width:90%;margin:0 auto; margin-bottom:30px;" required>
                                        <input type="text" class="form-control" placeholder="Ваш номер телефона:" name="telefon"
                                               style="width:90%;margin:0 auto;margin-bottom:30px" required>
                                        <textarea class="form-control" placeholder="Примечания" name="description"
                                                  style="width:90%;margin:0 auto;margin-bottom:30px"></textarea>
                                        <input type="submit" class="btn btn-default"
                                               style="background-color: #95b001;color:white;margin:0 auto;font-size: 20px"
                                               value="Заказать">
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
</div>

<!--
<div class="col-sm-12" style="padding: 20px 10px; display: none">
    <?php
    foreach ($categories as $category) { ?>
        <div class="category-box-top" style="text-align: center">
            <a href="<?= get_home_url(); ?>/categories/?id=<?= $category->id; ?>">
                <img src="<?= get_home_url(); ?><?= $category->thumbnail; ?>" alt="" style="height:78px;">
                <div class="categ_name1"><?= $category->name; ?></div>
            </a>
        </div>
    <?php } ?>
</div>
-->
<div class="main-wrap">
    <section class="main-content">
        <div class="col-sm-12 styleTextPages ">

            <h2><?php $category = get_category_name($wpdb, $_GET['id']);
                echo $category[0]->name; ?></h2>
            <div class="col-sm-12 textContent">
                <?php $desc = get_category_desc($wpdb, $_GET['id']);
                echo $desc[0]->description;
                ?>
            </div>
        </div>
    </section>
</div>
<div style="clear: both"></div>
<?php get_footer(); ?>