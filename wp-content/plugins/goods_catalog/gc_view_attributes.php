<?php
global $wpdb;
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<div style="width:50%;">
<h3>Атрибуты</h3>
<div>
    <div>
        <form id="add_att_f" >
            <table class="table" >
                <tr>
                    <td>Группа атрибута</td>
                    <td>
                        <select name="att_group" class="form-control">
                    <?php
                    $att = $wpdb->get_results( "SELECT id, name  FROM ".$wpdb->prefix."gc_attributes_group", OBJECT_K);
                    $view_att = "";
                    foreach ($att as $row){
                        $view_att .= "<option value='".$row->id."'>".$row->name."</option>";
                    }
                    echo $view_att;
                    ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td><input type="text" class="form-control" id="att_name" name="att_name" value=""></td>
                </tr>
                <tr>
                    <td>Ед измерения</td>
                    <td><input type="text" class="form-control" id="att_unit" name="att_unit" value=""></td>
                </tr>

            </table>
        </form>
        <input type="button" class="btn btn-default" id="add_att" value="Добавить">
    </div>

</div>
<div>
    <h3>Существующие атрибуты по группам</h3>
        <select name="att_group" class="form-control"  id="upd_sel">
            <option>Выберите группу для правки</option>
            <?php
            echo $view_att;
            ?>
        </select>
        <table id="att_table" class="table">

        </table>
</div>
</div>