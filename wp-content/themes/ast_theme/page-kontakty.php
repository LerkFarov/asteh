<?php
/*
Template Name: Контакти
*/

get_header(); ?>

<div class="col-sm-12 grey_fon" style="height:150px;margin-bottom: 0px">
    <div class="col-sm-12">
        <h1 class="headTitle">
            <b><?php the_title(); ?></b>
        </h1>
    </div>
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

<div class="col-sm-12">
    <div class="col-sm-6" style="margin-bottom: 30px">
        <div class="col-sm-12" style="padding-bottom: 15px">
            <h2 class="contactInfoHeader">
                <div class="contactInfoHeaderBlock">
                    <b>Адрес:</b>
                </div>
            </h2>
            <h3  class="contactInfoText">
                <div class="contactInfoTextBlock">
                    <?php print_r(get_option('theme_address')); ?>
                </div>
            </h3>
            <input type="hidden" id="address" value="<?php print_r(get_option('theme_address')); ?>">
        </div>

        <div class="col-sm-12">
            <h2 class="contactInfoHeader">
                <div class="contactInfoHeaderBlock">
                    <b>График работы:</b>
                </div>
            </h2>
            <h3  class="contactInfoText">
                <div class="contactInfoTextBlock">
                    <?php print_r(get_option('theme_worktext')); ?>
                </div>
            </h3>
        </div>

        <div class="col-sm-12">
            <h2 class="contactInfoHeader">
                <div class="contactInfoHeaderBlock">
                    Телефон:
                </div>
            </h2>
            <h3  class="contactInfoText">
                <div class="contactInfoTextBlock">
                    <?php print_r(get_option('theme_telephone')); ?>
                </div>
            </h3>
        </div>

        <div class="col-sm-12">
            <h2 class="contactInfoHeader">
                <div class="contactInfoHeaderBlock">
                    Email:
                </div>
            </h2>
            <h3  class="contactInfoText">
                <div class="contactInfoTextBlock">
                    <?php print_r(get_option('theme_email')); ?>
                </div>
            </h3>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="modal-content" style="position:absolute;z-index:100;background-color: #f2f2f2;width:294px;margin-left: 60px">
            <div class="modal-header" style="text-align: center">
              <h3 class="modal-title" style='padding:0px;margin-top:30px;margin-bottom: 30px' align='center'>ОБРАТНАЯ СВЯЗЬ</h3>
              <form>
                  <input type="hidden" name="type" value="contact">
                  <input type="text" class="form-control" placeholder="Ваше имя:" name="name" style="border-radius:0px !important;width:90%;margin:0 auto; margin-bottom:20px;" required>
                  <input type="text" class="form-control"  placeholder="Ваш номер телефона:"  name="telefon"  style="border-radius:0px;width:90%;margin:0 auto;margin-bottom:20px" required>
                  <input type="email" class="form-control"  placeholder="Ваша электронная почта:"  name="email"  style="border-radius:0px;width:90%;margin:0 auto;margin-bottom:20px" required>
                  <textarea class="form-control"  placeholder="Ваше сообщение:" rows="8" name="your_message"  style="border-radius:0px;width:90%;margin:0 auto;margin-bottom:20px" required></textarea>
                  <input type="submit" class="btn btn-default" style="margin:0 auto;font-size: 20px" value="Отправить">
              </form>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12" id="map" style="height:500px;border-top:5px solid #ffd200;background-color:white;margin-bottom: -52px; padding: 0;">

</div>
<div style="clear:both;"></div>
<?php get_footer(); ?>