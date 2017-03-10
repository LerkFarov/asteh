<?php
global $wpdb;

if (function_exists('wp_enqueue_media')) {
    wp_enqueue_media();
}

?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<script>
    window.server = "<? echo("http://".$_SERVER['SERVER_NAME']);?>";
</script>
<h3>Редактировать продукт</h3>
<div style="margin-bottom: 15px;">
    <table  class="table">
        <tr><th>Категория</th><th>Название</th></tr>
        <tr><td>                    <select style="width:100%;" id="search_product_cat" name="prod_cat">
                    <option value="-1">Весь товар</option>
                    <?php
                    $cat = $wpdb->get_results( "SELECT id, name  FROM ".$wpdb->prefix."gc_categories", OBJECT_K);

                    $view_cat = "";
                    foreach ($cat as $row){
                        $view_cat .= "<option value='".$row->id."'>".$row->name."</option>";
                    }
                    echo $view_cat;
                    ?>
                </select>

            </td>

            <td><input type="text" style="width: 100%;" class="control-form" id="search_prod" placeholder="Название товара"></td>
        </tr>

    </table>

</div>
<div id="product_container">

</div>



<div hidden id="product_edit_container" style="margin-top: 15px;">
    <div class="row ">
        <form id="upd_product_f" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-3">
                                <div id="product_cat_list">
                                    <select id="product_cat" name="prod_cat" style="width: 100%;" class="control-form">
                                        <?php
                                        $cat = $wpdb->get_results("SELECT id, name  FROM " . $wpdb->prefix . "gc_categories", OBJECT_K);

                                        $view_cat = "";
                                        foreach ($cat as $row) {
                                            $view_cat .= "<option value='" . $row->id . "'>" . $row->name . "</option>";
                                        }
                                        echo $view_cat;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="prod_type" id="" style="width:100%;">
                                    <option value="Аренда">Аренда</option>
                                    <option value="Продажа">Продажа</option>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="control-form" style="width: 100%" id="prod_name" name="prod_name"
                                       placeholder="Название товара">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="button" class="btn btn-default" id="upd_prod" value="Обновить продукт">
                    </div>
                </div>
            </div>
            <div  class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div  style="margin-top: 10px;" class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="button" class="btn btn-default" style="width:100%;" id="prod_inst"
                                               value="Задать инструкцию">
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="control-form" style="width:100%;" name="prod_inst_b"
                                               value="Инструкция по эксплуатации" placeholder="Название инструкции по эксплуатации">
                                        <input type="text" id="prod_inst_url" name="prod_inst_url" value="" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  style="margin-top: 10px;" class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="button" class="btn btn-default" id="prod_main_img"
                                               value="Задать рисунок"></span><br>
                                        <span id="prod_main_img_c"></span>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="button" class="btn btn-default" id="prod_sec_img"
                                               value="Задать галерею"></span><br>
                                        <span id="prod_sec_img_c"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px;" class="row">
                            <div class="col-md-12">

                                <textarea id="prod_desc" name="prod_desc" type="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="product_attributes_select">
                                    <p>Задать группу атрибутов</p>
                                    <select class="control-form" id="prod_att_g_list">
                                        <option value="-1" selected>Без атрибутов</option>
                                        <?php
                                        $att = $wpdb->get_results("SELECT id, name  FROM " . $wpdb->prefix . "gc_attributes_group", OBJECT_K);
                                        $view_att = "";
                                        foreach ($att as $row) {
                                            $view_att .= "<option value='" . $row->id . "'>" . $row->name . "</option>";
                                        }
                                        echo $view_att;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div  class='table-responsive' id="product_attributes">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="new_product_attributes">
                                    <p>Создать новый атрибут</p>
                                    <table class="table">
                                        <tr>
                                            <th>Название</th>
                                            <th>Ед Измерения</th>
                                            <th>&nbsp</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="control-form" id="new_att_name"></td>
                                            <td><input type="text" class="control-form" id="new_att_unit"></td>
                                            <td><span class="glyphicon glyphicon-plus" class="btn btn-default" id="new_att" aria-hidden="true"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col">
                            <div class="col-md-12">
                                <div id="product_prices_select">
                                    <p>Задать группу цен</p>
                                    <select class="control-form" id="prod_price_g_list">
                                        <option value="-1" selected>Без цен</option>
                                        <?php
                                        $att = $wpdb->get_results("SELECT id, name  FROM " . $wpdb->prefix . "gc_prices_group", OBJECT_K);
                                        $view_att = "";
                                        foreach ($att as $row) {
                                            $view_att .= "<option value='" . $row->id . "'>" . $row->name . "</option>";
                                        }
                                        echo $view_att;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class='table-responsive' id="product_prices">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="new_product_prices">
                                    <p>Создать новую цену</p>
                                    <table class="table">
                                        <tr>
                                            <th>Название</th>
                                            <th>&nbsp</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="control-form" id="new_price_name"></td>
                                            <td><span class="glyphicon glyphicon-plus" class="btn btn-default" id="new_price" aria-hidden="true"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>