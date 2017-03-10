<?php
define('SHORTINIT', true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

function get_price_group(){
    return "Категория Н";
}
function add_price_group($data, $db){
    $tmp = json_decode($data);
    if(isset($tmp->price_group_name)){
        if($tmp->price_group_name != ""){
            $query = "INSERT INTO ".$db->prefix."gc_prices_group VALUES ('', '".$tmp->price_group_name."')";
            $db->query($query);
            return "Группа создана";
        }else{
            return "Отправлена пустая строка";
        }
    }
    return "Отправлены неверные данные";
}

function upd_price_group($data, $db){
    if(isset($data)){
        $data = json_decode($data);
        $query = "UPDATE ".$db->prefix."gc_prices_group AS prices_group
                    SET
                    prices_group.`name` = '".$data[1]."'
                    WHERE
                    prices_group.id = ".$data[0];
        if($db->query($query)){
            return "Группа обновлена";
        }else{
            return "Неверные данные";
        }
    }
    return "Неверные данные";
}
function del_price_group($data, $db){
    if(isset($data)){
        $data *= 1;
        if($data < 0){
            return "Группа не существует";
        }elseif($data > 0){

            $query = "SELECT Count(prices_group.id) as id_count
                          FROM ".$db->prefix."gc_prices_group AS prices_group , ".$db->prefix."gc_prices AS prices
                          WHERE prices.prices_group_id = prices_group.id AND
                          prices_group.id = ".$data;

            $child_exist = $db->get_results($query);
            if($child_exist[0]->id_count == 0){
                $query = "DELETE FROM ".$db->prefix."gc_prices_group WHERE id = ".$data;
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
        case 'add_price_group':
            $result = add_price_group($_POST['data'], $wpdb);
            break;
        case 'del_price_group':
            $result = del_price_group($_POST['data'], $wpdb);
            break;
        case 'upd_price_group':
            $result = upd_price_group($_POST['data'], $wpdb);
            break;
        case 'get_price_group':
            $result = get_price_group();
            break;
    }
}

echo $result;
?>