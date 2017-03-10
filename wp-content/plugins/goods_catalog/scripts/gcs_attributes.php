<?php
define('SHORTINIT', true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

function get_attributes($att_g_id, $db){

    $query ="SELECT attributes.id,            attributes.`name`,            attributes.unit
            FROM
              ".$db->prefix."gc_attributes AS attributes
            WHERE
              attributes.att_group_id = ".$att_g_id;

    $att_g = $db->get_results($query);
    $res = Array();
    $i = 0;
    foreach ($att_g as $item) {
        $query = "SELECT Count(params.id)
                    FROM
                    ".$db->prefix."gc_parameters AS params
                    WHERE
                    params.att_id = ".$item->id;

        $r = $db->get_var($query);

        $res[$i++] = Array('id' => $item->id, 'name' => $item->name, 'unit' => $item->unit, 'count' => $r);
    }
    $res = json_encode($res);
    return($res);
}
function add_attributes($data, $db){
    if(isset($data)){
        $att = json_decode($data);
        $query ="SELECT Count(attributes_group.id) AS g_count
                FROM
                  ".$db->prefix."gc_attributes_group AS attributes_group
                WHERE
                  attributes_group.id = ".$att->att_group;

        $att_g = $db->get_results($query);
        if($att_g[0]->g_count == "0"){
            return "Группа атрибутов не существует";
        }else{
            $query = "INSERT INTO ".$db->prefix."gc_attributes VALUES ('', '".$att->att_group."','".$att->att_name."','".$att->att_unit."')";

            $db->query($query);
            return "Атрибут добавлен";
        }
    }
    return "Отправлены неверные данные";
}
function upd_attributes($data, $db){
    if(isset($data)){
        $att = json_decode($data);
        $query = "UPDATE ".$db->prefix."gc_attributes AS atts
                    SET
                    atts.`name` = '".$att->name."',
                    atts.unit = '".$att->unit."'
                    WHERE
                    atts.id = ".$att->id;
        if($db->query($query)){
            return "Атрибут обновлен";
        }else{
            return "Ошибка обновления";
        }
    }
    return "Отправлены неверные данные";
}
function del_attributes($data, $db){
    if(isset($data)){
        $id = $data*1;
        $query = "SELECT Count(params.id)
                    FROM
                    ".$db->prefix."gc_parameters AS params
                    WHERE
                    params.att_id = ".$id;
        $count = $db->get_var($query);

        if($count > 0){
            return "Можно удалить только не привязанные атрибуты";
        }else{
            $query = "DELETE FROM ".$db->prefix."gc_attributes WHERE id = ".$id;
            if($db->query($query)){
                return "Атрибут удален";
            }else{
                return "Ошибка удаления";
            }
        }

    }
    return "Отправлены неверные данные";
}

if(isset($_POST['event'])){
    switch($_POST['event']){
        case 'get_att':
            $result = get_attributes($_POST['data'], $wpdb);
            break;
        case 'add_att':
            $result = add_attributes($_POST['data'], $wpdb);
            break;
        case 'upd_att':
            $result = upd_attributes($_POST['data'], $wpdb);
            break;
        case 'del_att':
            $result = del_attributes($_POST['data'], $wpdb);
            break;
    }
}


echo $result;
?>