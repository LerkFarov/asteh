<?php
define('SHORTINIT', true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

function get_all_cats($db){
    $query = "SELECT * FROM ".$db->prefix."gc_categories AS categories ORDER BY categories.`order` ASC, categories.`name` ASC";
    $items = $db->get_results($query);
    $index = 0;
    if(isset($items[0])){
        foreach($items as $cats) {
            $res[$index] = $cats;
            $query = "SELECT Count(products.cat_id) AS p_count
                        FROM
                        ".$db->prefix."gc_products AS products
                        WHERE
                        products.cat_id = ".$cats->id;

            $tmp = $db->get_results($query);
            $res[$index]->p_count = $tmp[0]->p_count;
            $index++;
        }
        return $res;
    }

    return NULL;
}
function add_cat($data, $db){
    $tmp = json_decode($data);
    if(isset($tmp->cat_name)){
        if($tmp->cat_name != ""){
            $query = "INSERT INTO ".$db->prefix."gc_categories VALUES ('', '".$tmp->cat_name."', '".$tmp->cat_second_name."', '".$tmp->cat_img_url."', '".$tmp->cat_thumb_url."', '".$tmp->cat_desc."', '".$tmp->cat_order."', '".$tmp->parent."')";
            $db->query($query);
            return "Категория создана";
        }else{
            return "Отправлена пустая строка";
        }
    }
    return "Отправлены неверные данные";
}

function upd_cat($data, $db){

    if(isset($data)){
        $cat = json_decode($data);
        $query = "UPDATE ".$db->prefix."gc_categories AS categories
                    SET
                    categories.`name` = '".$cat->name."',
                    categories.second_name = '".$cat->second_name."',
                    categories.image = '".$cat->img."',
                    categories.thumbnail = '".$cat->thumb."',
                    categories.description = '".$cat->cat_desc."',
                    categories.order = '".$cat->cat_order."',
                    categories.parent = '".$cat->cat_parent."'
                    WHERE
                    categories.id = ".$cat->id;

        if($db->query($query)){
            return "Категория обновлена";
        }else{
            return "Категория обновлена";
        }
    }
    return "Отправлены неверные данные";

}
function del_cat($data, $db){
    if(isset($data)){
        $data *= 1;
        if($data < 0){
            return "Категория не существует";
        }elseif($data > 0){

            $query = "SELECT Count(categories.id) AS id_count
                        FROM
                          ".$db->prefix."gc_categories AS categories ,
                          ".$db->prefix."gc_products AS products
                        WHERE
                          products.cat_id = categories.id AND
                          categories.id = ".$data;
            $child_exist = $db->get_results($query);
            if($child_exist[0]->id_count == 0){
                $query = "DELETE FROM ".$db->prefix."gc_categories WHERE id = ".$data;
                $db->query($query);
                return "Категория удалена";
            }else{
                return "Категория не пуста";
            }
        }else{
            return "Нельзя удалить базовую категорию";
        }

    }
    return "Отправлены неверные данные";
}

if(isset($_POST['event'])){
    switch($_POST['event']){
        case 'add_cat':
            $result = add_cat($_POST['data'], $wpdb);
            break;
        case 'del_cat':
            $result = del_cat($_POST['data'], $wpdb);
            break;
        case 'upd_cat':
            $result = upd_cat($_POST['data'], $wpdb);
            break;
        case 'get_cat':
            $result = get_cat();
            break;
    }
}
echo $result;
?>