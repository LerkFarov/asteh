<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo get_post_meta($post->ID, 'description', true); ?>" />
    <meta name="keywords" content="<?php echo get_post_meta($post->ID, 'keywords', true); ?>" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css" type="text/css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src='//api-maps.yandex.ru/2.1/?lang=ru_RU'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <title><?php echo get_post_meta($post->ID, 'title', true); ?></title>
    <?php wp_head() ?>
</head>
<body>
    <div class="row">
    <div class="containter" style="height: 136px;">
        <div class="header_fon">
            <div class="text-color_grey map-marker">
                <?php print_r(get_option('theme_address')); ?>
            </div>
            <div class="text-color_grey email-block">
                <?php print_r(get_option('theme_email')); ?>
            </div>
            <div class="call_back">
                <a data-toggle="modal" data-target="#myModal" class="btn btn-default pull-right call_back_button">Заказать звонок</a>
            </div>
            <div class="text-color_grey phone-block">
               <?php print_r(get_option('theme_telephone')); ?>
            </div>
        </div>
        <div class="ast_logo_block">
			<?php if (is_front_page()) :?>
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/ast_logo.png" alt="Аренда инструмента">
			<?php else: ?>
            <a title= "на главную" href="/"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/ast_logo.png" alt="Аренда инструмента"></a>
			<?php endif; ?>
        </div>
    </div>

<div class="modal fade" id="myModal" role="dialog" style="margin-top: 200px;" >
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="background-color: #f2f2f2;width:300px;margin-left: 150px">
        <div class="modal-header" style="text-align: center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style='padding:0px;margin-top:30px;margin-bottom: 30px' align='center'>ЗАКАЗАТЬ ЗВОНОК</h3>
          <form>
              <input type="hidden" name="type" value="call_back">
              <input type="text" class="form-control" placeholder="Ваше имя:" name="name" style="width:90%;margin:0 auto; margin-bottom:30px;"  required>
              <input type="text" class="form-control"  placeholder="Ваш номер телефона:"  name="telefon"  style="width:90%;margin:0 auto;margin-bottom:30px"  required>
              <input type="submit" class="btn btn-default call_back_button" style="color:white;margin:0 auto;font-size: 16px" value="Заказать">
          </form>
        </div>
      </div>

    </div>
  </div>