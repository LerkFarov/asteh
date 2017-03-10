<?php
global $wpdb;
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<div style="width:50%;">
<h3>Цены</h3>
<div>
    <div>
        <form id="add_price_f" class="form-group">
            <table class="table" >
                <tr>
                    <td>Группа цен</td>
                    <td>
                        <select class="form-control" name="price_group">
                    <?php
                    $price = $wpdb->get_results( "SELECT id, name  FROM ".$wpdb->prefix."gc_prices_group", OBJECT_K);
                    $view_price = "";
                    foreach ($price as $row){
                        $view_price .= "<option value='".$row->id."'>".$row->name."</option>";
                    }
                    echo $view_price;
                    ?>
                    </select>
                </tr>
                <tr>
                    <td>Название</td>
                    <td><input type="text" class="form-control" id="price_name" name="price_name" value=""></td>
                </tr>
            </table>
        </form>
        <input type="button" class="btn btn-default" id="add_price" value="Добавить">
    </div>

</div>
<div>
    <h3>Существующие цены по группам</h3>
        <select class="form-control" name="price_group" id="upd_sel">
            <option>Выберите группу для правки</option>
            <?php
            echo $view_price;
            ?>
        </select>
        <table id="price_table" class="table">

        </table>
</div>
</div>