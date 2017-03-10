<?php
define('SHORTINIT', true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

function get_att_group(){
    return "Категория Н";
}
function add_att_group($data, $db){
    $tmp = json_decode($data);
    if(isset($tmp->att_group_name)){
        if($tmp->att_group_name != ""){
            $query = "INSERT INTO ".$db->prefix."gc_attributes_group VALUES ('', '".$tmp->att_group_name."')";
            $db->query($query);
            return "Группа создана";
        }else{
            return "Отправлена пустая строка";
        }
    }
    return "Отправлены неверные данные";
}

function upd_att_group($data, $db){
    if(isset($data)){
        $data = json_decode($data);
        $query = "UPDATE ".$db->prefix."gc_attributes_group AS att_group
                    SET
                    att_group.`name` = '".$data[1]."'
                    WHERE
                    att_group.id = ".$data[0];
        if($db->query($query)){
            return "Группа обновлена";
        }else{
            return "Неверные данные";
        }
    }
    return "Неверные данные";

}
function del_att_group($data, $db){
    if(isset($data)){
        $data *= 1;
        if($data < 0){
            return "Группа не существует";
        }elseif($data > 0){

            $query = "SELECT Count(attributes_group.id) as id_count
                          FROM ".$db->prefix."gc_attributes_group AS attributes_group , ".$db->prefix."gc_attributes AS attributes
                          WHERE attributes.att_group_id = attributes_group.id AND
                          attributes_group.id = ".$data;
            $child_exist = $db->get_results($query);
            if($child_exist[0]->id_count == 0){
                $query = "DELETE FROM ".$db->prefix."gc_attributes_group WHERE id = ".$data;
                $db->query($query);
                return "Группа удалена";
            }else{
                return "Группа не пуста";
            }
        }else{
            return "Нельзя удалить базовую группу";
        }

    }
    return "Отправлены неверные данные";
}

if(isset($_POST['event'])){
    switch($_POST['event']){
        case 'add_att_group':
            $result = add_att_group($_POST['data'], $wpdb);
            break;
        case 'del_att_group':
            $result = del_att_group($_POST['data'], $wpdb);
            break;
        case 'upd_att_group':
            $result = upd_att_group($_POST['data'], $wpdb);
            break;
        case 'get_att_group':
            $result = get_att_group();
            break;
    }
}

echo $result;
?>