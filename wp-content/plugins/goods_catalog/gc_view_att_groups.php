<?php
global $wpdb;

?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<h3>Группы атрибутов</h3>
<div id="add_att_group_container" style="width: 60%;">
    <p>Название группы атрибутов</p> <br>
    <form id="add_att_group_f">
        <input type="text"  class="form-control" id="att_group_name" name="att_group_name"> <br>
        <input type="button" class="btn btn-default" id="add_att_group" value="Добавить">
        </p>
    </form>

</div>

<div id="att_groups_container" style="width: 60%;">
    <p>Существующие группы</p>
    <table class="table table-striped table-condensed">
        <tr><th>Название</th><th>Удалить(если пустая)</th><th colspan="2" style="text-align:center;">Переименовать</th></tr>
        <?php
            $att_groups = $wpdb->get_results( "SELECT id, name  FROM ".$wpdb->prefix."gc_attributes_group ", OBJECT_K);

            $view_att_g = "";
            foreach ($att_groups as $row){
                $view_att_g .= "<tr>";

                $query = "SELECT Count(attributes_group.id) as id_count
                          FROM ".$wpdb->prefix."gc_attributes_group AS attributes_group , ".$wpdb->prefix."gc_attributes AS attributes
                          WHERE attributes.att_group_id = attributes_group.id AND
                          attributes_group.id = ".$row->id;
                $child_exist = $wpdb->get_results($query);
                if($child_exist[0]->id_count == 0 && $row->id > 0){
                    $view_att_g .= "<td>".$row->name."</td>";
                    $view_att_g .= "<td><input type=\"button\" value=\"Удалить\" class=\"del_att_group btn btn-default\" id=\"del_att_group".$row->id."\"></td>";
                }else{
                    $view_att_g .= "<td>".$row->name."</td>";
                    $view_att_g .= "<td><input type=\"button\" class='btn btn-default' value=\"Удалить\"  disabled></td>";
                }
                $view_att_g .= "<td><input type='text'  id=\"new_name".$row->id."\"></td><td><input type=\"button\" value=\"Переименовать\"  class=\"upd_att_group btn btn-default\" id=\"upd_att_group".$row->id."\"></td></tr>";
            }

            echo $view_att_g;
        ?>

    </table>
</div>
