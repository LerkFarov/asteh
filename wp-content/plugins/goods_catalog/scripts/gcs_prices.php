<?php
define('SHORTINIT', true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

function get_prices($att_g_id, $db){

    $query ="SELECT prices.id,            prices.`name`
            FROM
              ".$db->prefix."gc_prices AS prices
            WHERE
              prices.prices_group_id = ".$att_g_id;

    $att_g = $db->get_results($query);
    $res = Array();
    $i = 0;
    foreach ($att_g as $item) {
        $query = "SELECT Count(prices_all.id)
                    FROM
                    ".$db->prefix."gc_prices_all AS prices_all
                    WHERE
                    prices_all.price_id = ".$item->id;

        $r = $db->get_var($query);

        $res[$i++] = Array('id' => $item->id, 'name' => $item->name, 'count' => $r);
    }
    $res = json_encode($res);
    return($res);
}

function add_prices($data, $db){
    if(isset($data)){
        $price = json_decode($data);
        $query ="SELECT Count(prices_group.id) AS g_count
                FROM
                  ".$db->prefix."gc_prices_group AS prices_group
                WHERE
                  prices_group.id = ".$price->price_group;

        $price_g = $db->get_results($query);
        if($price_g[0]->g_count == "0"){
            return "Группа цен не существует";
        }else{

            $query = "INSERT INTO ".$db->prefix."gc_prices VALUES ('',".$price->price_group.", '".$price->price_name."')";

            $db->query($query);

            return "Цена добавлена";
        }
    }
    return "Отправлены неверные данные";
}

function upd_prices($data, $db){
    if(isset($data)){
        $att = json_decode($data);
        $query = "UPDATE ".$db->prefix."gc_prices AS prices
                    SET
                    prices.`name` = '".$att->name."'
                    WHERE
                    prices.id = ".$att->id;
        if($db->query($query)){
            return "Атрибут обновлен";
        }else{
            return "Ошибка обновления";
        }
    }
    return "Отправлены неверные данные";
}

function del_prices($data, $db){
    if(isset($data)){
        $id = $data*1;
        $query = "SELECT Count(prices_all.id)
                    FROM
                    ".$db->prefix."gc_prices_all AS prices_all
                    WHERE
                    prices_all.price_id = ".$id;
        $count = $db->get_var($query);

        if($count > 0){
            return "Можно удалить только не привязанные атрибуты";
        }else{
            $query = "DELETE FROM ".$db->prefix."gc_prices WHERE id = ".$id;
            if($db->query($query)){
                return "Атрибут удален";
            }else{
                return "Ошибка удаления";
            }
        }

    }
    return "Отправлены неверные данные";
}
if(isset($_POST['event'])) {
    switch ($_POST['event']) {
        case 'get_prices':
            $result = get_prices($_POST['data'], $wpdb);
            break;
        case 'add_prices':
            $result = add_prices($_POST['data'], $wpdb);
            break;
        case 'upd_prices':
            $result = upd_prices($_POST['data'], $wpdb);
            break;
        case 'del_prices':
            $result = del_prices($_POST['data'], $wpdb);
            break;
    }
}



echo $result;
?>