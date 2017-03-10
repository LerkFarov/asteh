<?php
global $wpdb;

?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<h3>Группы цен</h3>
<div id="add_price_group_container" style="width: 60%;">
    <form id="add_price_group_f">
        <p>Название группы цен</p> <br>
        <input type="text" class="form-control" id="price_group_name" name="price_group_name"> <br>
        <input type="button" class="btn btn-default" id="add_price_group" value="Добавить">
        </p>
    </form>

</div>
<div id="price_groups_container" style="width: 60%;">
    <p>Существующие группы</p>
    <table class="table table-striped table-condensed">
        <tr><th>Название</th><th>Удалить(если пустая)</th><th colspan="2" class="text-center">Переименовать</th></tr>
        <?php
        $price_groups = $wpdb->get_results( "SELECT id, name  FROM ".$wpdb->prefix."gc_prices_group", OBJECT_K);
        $view_price_g = "";
        foreach ($price_groups as $row){
            $view_price_g .= "<tr>";

            $query = "SELECT Count(prices_group.id) as id_count
                          FROM ".$wpdb->prefix."gc_prices_group AS prices_group , ".$wpdb->prefix."gc_prices AS prices
                          WHERE prices.prices_group_id = prices_group.id AND
                          prices_group.id = ".$row->id;
            $child_exist = $wpdb->get_results($query);
            if($child_exist[0]->id_count == 0 && $row->id > 0){
                $view_price_g .= "<td>".$row->name."</td>";
                $view_price_g .= "<td><input type=\"button\" value=\"Удалить\" class=\"del_price_group btn btn-default\" id=\"del_price_group".$row->id."\"</td>";
            }else{
                $view_price_g .= "<td>".$row->name."</td>";
                $view_price_g .= "<td><input type=\"button\" class=\"btn btn-default\" value=\"Удалить\"  disabled></td>";
            }
            $view_price_g .= "<td><input type='text' class='form-control' id=\"new_name".$row->id."\"></td><td><input type=\"button\" value=\"Переименовать\"  class=\"upd_price_group btn btn-default\" id=\"upd_price_group".$row->id."\"></td></tr>";
        }

        echo $view_price_g;
        ?>

    </table>
</div>
