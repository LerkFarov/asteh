<?php
define('SHORTINIT', true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
global $wpdb;

function get_prod_list($data, $db){
    if(isset($data)){
        $d = json_decode($data);

        $query = "SELECT products.id, products.`name`
                FROM
               ".$db->prefix."gc_products AS products
                WHERE 1 = 1";
        if($d->cat_id > 0){
            $query .= " AND products.cat_id = ".$d->cat_id;
        }
        $query .= " AND products.`name` LIKE '%".$d->name."%' ORDER BY products.`name` ASC";
        $prod = $db->get_results($query);

        return(json_encode($prod));
    }
}

function get_short_product_by_id($id, $db){
    $att_limit = 4; //Количество выводимых атрибутов
    $prod_id = $id;

    $query = "SELECT products.id, products.`name`
                FROM
               ".$db->prefix."gc_products AS products
                WHERE
                products.id = ".$prod_id;
    $prod = $db->get_results($query);

    if(isset($prod[0]->name)){
        $query = "SELECT attributes.`name`, attributes.unit, parameters.`value`
                FROM
                ".$db->prefix."gc_parameters AS parameters ,
                ".$db->prefix."gc_attributes AS attributes
                WHERE
                parameters.att_id = attributes.id AND
                parameters.product_id = ".$prod_id."
                ORDER BY parameters.order ASC
                LIMIT 0, ".$att_limit;

        $prod_parameters = $db->get_results($query);

        if(isset($prod_parameters[0])){
            $prod[0]->params = $prod_parameters;
        }

        $query = "SELECT prices.`name`, prices_all.`value`
                    FROM
                    ".$db->prefix."gc_prices_all AS prices_all ,
                    ".$db->prefix."gc_prices AS prices
                    WHERE
                    prices_all.price_id = prices.id AND
                    prices_all.prod_id = ".$prod_id."
                    ORDER BY prices_all.order ASC";

        $prod_prices = $db->get_results($query);

        if(isset($prod_prices[0])){
            $prod[0]->prices = $prod_prices;
        }

        $query = "SELECT images.url
                    FROM
                    ".$db->prefix."gc_p_images AS images
                    WHERE
                    images.prod_id = ".$prod_id."
                    ORDER BY images.order ASC
                    LIMIT 0,1";

        $prod_img = $db->get_results($query);

        if(isset($prod_img[0])){
            $prod[0]->images = $prod_img;
        }
        return $prod[0];
    }

    return NULL;
}

function get_product_by_id($id, $db){
    $prod_id = $id;

    $query = "SELECT *
                FROM
               ".$db->prefix."gc_products AS products
                WHERE
                products.id = ".$prod_id;
    $prod = $db->get_results($query);

    if(isset($prod[0]->name)){
        $query = "SELECT attributes.id, attributes.`name`, attributes.unit, parameters.`value`
                FROM
                ".$db->prefix."gc_parameters AS parameters ,
                ".$db->prefix."gc_attributes AS attributes
                WHERE
                parameters.att_id = attributes.id AND
                parameters.product_id = ".$prod_id."
                ORDER BY parameters.order ASC";

        $prod_parameters = $db->get_results($query);

        if(isset($prod_parameters[0])){
            $prod[0]->params = $prod_parameters;
        }

        $query = "SELECT prices.id, prices.`name`, prices_all.`value`
                    FROM
                    ".$db->prefix."gc_prices_all AS prices_all ,
                    ".$db->prefix."gc_prices AS prices
                    WHERE
                    prices_all.price_id = prices.id AND
                    prices_all.prod_id = ".$prod_id."
                    ORDER BY prices_all.order ASC";

        $prod_prices = $db->get_results($query);

        if(isset($prod_prices[0])){
            $prod[0]->prices = $prod_prices;
        }

        $query = "SELECT images.url
                    FROM
                    ".$db->prefix."gc_p_images AS images
                    WHERE
                    images.prod_id = ".$prod_id."
                    ORDER BY images.order ASC";

        $prod_img = $db->get_results($query);

        if(isset($prod_img[0])){
            $prod[0]->images = $prod_img;
        }
        return json_encode($prod[0]);
    }

    return NULL;
}
function get_product_by_cat($prod_cat, $db){

    $query = "SELECT products.id
                FROM
                ".$db->prefix."gc_products AS products
                WHERE
                products.cat_id = ".$prod_cat;

    $prod_in_cat = $db->get_results($query);
    $index = 0;
    if(isset($prod_in_cat[0])){
        foreach($prod_in_cat as $prod){
            $res[$index] = get_short_product_by_id($prod->id,$db);
            $index++;
        }
        return $res;
    }

    return NULL;
}
function get_product_by_cat_per_page($prod_cat, $page, $prod_per_page,  $db){
    $page--;
    $query = "SELECT products.id
                FROM
                ".$db->prefix."gc_products AS products
                WHERE
                products.cat_id = ".$prod_cat."
                LIMIT ".$page*$prod_per_page.", ".$prod_per_page;

    $prod_in_cat = $db->get_results($query);
    $index = 0;
    if(isset($prod_in_cat[0])){
        foreach($prod_in_cat as $prod){
            $res[$index] = get_short_product_by_id($prod->id,$db);
            $index++;
        }
        return $res;
    }

    return NULL;
}
function get_product_by_cat_name_filter($prod_cat, $prod_name, $db){
    $query = "SELECT products.id
                FROM
                ".$db->prefix."gc_products AS products
                WHERE
                products.cat_id = ".$prod_cat." AND
                products.`name` LIKE \"%".$prod_name."%\"";


    $prod_in_cat = $db->get_results($query);
    $index = 0;
    if(isset($prod_in_cat[0])){
        foreach($prod_in_cat as $prod){
            $res[$index] = get_short_product_by_id($prod->id,$db);
            $index++;
        }
        return $res;
    }

    return NULL;
}

function add_product($data, $db){
    $b = json_decode($data);
    $images     = Array();
    $images_order = 1;

    $attributes = Array();
    $attributes_order = 1;

    $prices     = Array();
    $prices_order = 1;

    foreach($b as $key => $val){
        /*start foreach*/
        if($key == "prod_name"){
            $prod_name = $val;
        }
        if($key == "prod_cat"){
            $prod_cat = $val;
        }
        if($key == "prod_desc"){
            $prod_desc = $val;
        }
        if($key == "prod_type"){
            $prod_type = $val;
        }
        if($key == "prod_inst_b"){
            $prod_inst_b = $val;
        }
        if($key == "prod_inst_url"){
            $prod_inst_url = $val;
        }
        if(preg_match("/^prod_main_img_url/", $key)){
            $images[0] = $val;

        }
        if(preg_match("/^prod_sec_img_url/", $key)){
            $images[$images_order] = $val;
            $images_order++;
        }
        if(preg_match("/^prod_price/", $key)){
            $pr_id = str_replace("prod_price","",  $key);
            $prices[$prices_order] = Array($pr_id, $val, $prices_order);
            $prices_order++;
        }
        if(preg_match("/^new_price_v/", $key)){
            $prices[$prices_order] = Array('-1', '', $val, $prices_order);
        }
        if(preg_match("/^new_price_n/", $key)){
            $prices[$prices_order][1] = $val;
            $prices_order++;
        }
        if(preg_match("/^prod_att/", $key)){
            $att_id = str_replace("prod_att","",  $key);
            $attributes[$attributes_order] = Array($att_id, $val, $attributes_order);
            $attributes_order++;
        }
        if(preg_match("/^new_att_v/", $key)){
            $attributes[$attributes_order] = Array('-1','', '', $val, $attributes_order);
        }
        if(preg_match("/^new_att_n/", $key)){
            $attributes[$attributes_order][1] = $val;
        }
        if(preg_match("/^new_att_u/", $key)){
            $attributes[$attributes_order][2] = $val;
            $attributes_order++;
        }
        /*end foreach*/
    }

    if(isset($prod_name)&&
        isset($prod_cat)&&
        isset($prod_desc)&&
        isset($prod_inst_url)&&
        isset($prod_inst_b)&&
        isset($prod_type)){
        $q = "INSERT INTO ".$db->prefix."gc_products
        VALUES ('',
        '".$prod_cat."',
        '".$prod_name."',
        '".$prod_desc."',
        '".$prod_inst_url."',
        '".$prod_inst_b."',
        '".$prod_type."')";

        $db->query($q);
    }else{
        return "Основные данные не введены";
    }

    $prod_id_q = "SELECT prod.id FROM ".$db->prefix."gc_products AS prod WHERE prod.`name` = '".$prod_name."' AND
                    prod.description = '".$prod_desc."' ORDER BY prod.id DESC LIMIT 1";

    $prod_id = $db->get_var($prod_id_q);



    if(isset($images)){
        foreach($images as $img_key => $img_val){
            $q = "INSERT INTO ".$db->prefix."gc_p_images VALUES ('', '".$prod_id."', '".$img_val."', '".$img_key."' )";
            $db->query($q);
        }
    }

    if(isset($attributes[1])){
        foreach($attributes as $att){
            if($att[0] != '-1'){
                $q = "INSERT INTO ".$db->prefix."gc_parameters VALUES ('', '".$att[0]."', '".$prod_id."', '".$att[1]."', '".$att[2]."')";
                $db->query($q);
            }else{
                $q = "INSERT INTO ".$db->prefix."gc_attributes VALUES ('', '0', '".$att[1]."', '".$att[2]."')";
                $db->query($q);
                $cat_id_q = "SELECT attributes.id FROM ".$db->prefix."gc_attributes AS attributes
                              WHERE attributes.`name` = '".$att[1]."' AND
                                    attributes.unit = '".$att[2]."' LIMIT 1";
                $att_cat = $db->get_var($cat_id_q);
                $q = "INSERT INTO ".$db->prefix."gc_parameters VALUES ('', '".$att_cat."', '".$prod_id."', '".$att[3]."', '".$att[4]."')";
                $db->query($q);
            }
        }
    }

    if(isset($prices[1])){
        foreach($prices as $price){
            if($price[0] != '-1'){
                $q = "INSERT INTO ".$db->prefix."gc_prices_all
                VALUES ('', '".$price[0]."', '".$prod_id."', '".$price[1]."', '".$price[2]."')";
                $db->query($q);
            }else{
                $q = "INSERT INTO ".$db->prefix."gc_prices
                VALUES ('', '0', '".$price[1]."')";

                $db->query($q);
                $price_id_q = "SELECT prices.id FROM wp_gc_prices AS prices
                              WHERE prices.`name` = '".$price[1]."' LIMIT 1";
                /*var_dump($price_id_q);
                exit;*/
                $price_cat = $db->get_var($price_id_q);
                $q = "INSERT INTO ".$db->prefix."gc_prices_all
                VALUES ('', '".$price_cat."', '".$prod_id."', '".$price[2]."', '".$price[3]."')";
                $db->query($q);
            }
        }
    }
    return "Товар добавлен";
}

function del_product($data, $db){
    if(isset($data)){
        $id = $data*1;
        $query = "DELETE FROM ".$db->prefix."gc_parameters WHERE product_id = ".$id;
        $db->query($query);
        $query = "DELETE FROM ".$db->prefix."gc_prices_all WHERE prod_id = ".$id;
        $db->query($query);
        $query = "DELETE FROM ".$db->prefix."gc_p_images WHERE prod_id = ".$id;
        $db->query($query);
        $query = "DELETE FROM ".$db->prefix."gc_products WHERE id = ".$id;
        $db->query($query);

        return "Товар удален";
    }
    return "Отправлены неверные данные";
}

function upd_product($id, $data, $db){
    $id*=1;
    $b = json_decode($data);
    $images     = Array();
    $images_order = 1;

    $attributes = Array();
    $attributes_order = 1;

    $prices     = Array();
    $prices_order = 1;

    foreach($b as $key => $val){
        /*start foreach*/
        if($key == "prod_name"){
            $prod_name = $val;
        }
        if($key == "prod_cat"){
            $prod_cat = $val;
        }
        if($key == "prod_desc"){
            $prod_desc = $val;
        }
        if($key == "prod_type"){
            $prod_type = $val;
        }
        if($key == "prod_inst_b"){
            $prod_inst_b = $val;
        }
        if($key == "prod_inst_url"){
            $prod_inst_url = $val;
        }
        if(preg_match("/^prod_main_img_url/", $key)){
            $images[0] = $val;

        }
        if(preg_match("/^prod_sec_img_url/", $key)){
            $images[$images_order] = $val;
            $images_order++;
        }
        if(preg_match("/^prod_price/", $key)){
            $pr_id = str_replace("prod_price","",  $key);
            $prices[$prices_order] = Array($pr_id, $val, $prices_order);
            $prices_order++;
        }
        if(preg_match("/^new_price_v/", $key)){
            $prices[$prices_order] = Array('-1', '', $val, $prices_order);
        }
        if(preg_match("/^new_price_n/", $key)){
            $prices[$prices_order][1] = $val;
            $prices_order++;
        }
        if(preg_match("/^prod_att/", $key)){
            $att_id = str_replace("prod_att","",  $key);
            $attributes[$attributes_order] = Array($att_id, $val, $attributes_order);
            $attributes_order++;
        }
        if(preg_match("/^new_att_v/", $key)){
            $attributes[$attributes_order] = Array('-1','', '', $val, $attributes_order);
        }
        if(preg_match("/^new_att_n/", $key)){
            $attributes[$attributes_order][1] = $val;
        }
        if(preg_match("/^new_att_u/", $key)){
            $attributes[$attributes_order][2] = $val;
            $attributes_order++;
        }
        /*end foreach*/
    }

    if(isset($prod_name)&&
        isset($prod_cat)&&
        isset($prod_desc)&&
        isset($prod_inst_url)&&
        isset($prod_inst_b)&&
        isset($prod_type)){
        $q = "UPDATE ".$db->prefix."gc_products AS prod
        SET
        prod.cat_id = '".$prod_cat."',
        prod.name = '".$prod_name."',
        prod.description = '".$prod_desc."',
        prod.instruction_url = '".$prod_inst_url."',
        prod.instruction_button = '".$prod_inst_b."',
        prod.type = '".$prod_type."'
        WHERE id = ".$id;

        $db->query($q);
    }else{
        return "Основные данные не введены";
    }

    if(isset($images)){
        $q = "DELETE FROM ".$db->prefix."gc_p_images WHERE prod_id = ".$id;
        $db->query($q);
        foreach($images as $img_key => $img_val){
            $q = "INSERT INTO ".$db->prefix."gc_p_images VALUES ('', '".$id."', '".$img_val."', '".$img_key."' )";
            $db->query($q);
        }
    }

    if(isset($attributes[1])){
        $q = "DELETE FROM ".$db->prefix."gc_parameters WHERE product_id = ".$id;
        $db->query($q);
        foreach($attributes as $att){
            if($att[0] != '-1'){
                $q = "INSERT INTO ".$db->prefix."gc_parameters VALUES ('', '".$att[0]."', '".$id."', '".$att[1]."', '".$att[2]."')";
                $db->query($q);
            }else{
                $q = "INSERT INTO ".$db->prefix."gc_attributes VALUES ('', '0', '".$att[1]."', '".$att[2]."')";
                $db->query($q);
                $cat_id_q = "SELECT attributes.id FROM ".$db->prefix."gc_attributes AS attributes
                              WHERE attributes.`name` = '".$att[1]."' AND
                                    attributes.unit = '".$att[2]."' LIMIT 1";
                $att_cat = $db->get_var($cat_id_q);
                $q = "INSERT INTO ".$db->prefix."gc_parameters VALUES ('', '".$att_cat."', '".$id."', '".$att[3]."', '".$att[4]."')";
                $db->query($q);
            }
        }
    }

    if(isset($prices[1])){
        $q = "DELETE FROM ".$db->prefix."gc_prices_all WHERE prod_id = ".$id;
        $db->query($q);
        foreach($prices as $price){
            if($price[0] != '-1'){
                $q = "INSERT INTO ".$db->prefix."gc_prices_all
                VALUES ('', '".$price[0]."', '".$id."', '".$price[1]."', '".$price[2]."')";
                $db->query($q);
            }else{
                $q = "INSERT INTO ".$db->prefix."gc_prices
                VALUES ('', '0', '".$price[1]."')";

                $db->query($q);
                $price_id_q = "SELECT prices.id FROM wp_gc_prices AS prices
                              WHERE prices.`name` = '".$price[1]."' LIMIT 1";
                $price_cat = $db->get_var($price_id_q);
                $q = "INSERT INTO ".$db->prefix."gc_prices_all
                VALUES ('', '".$price_cat."', '".$id."', '".$price[2]."', '".$price[3]."')";
                $db->query($q);
            }
        }
    }

    return "Товар обновлен";
}
/**/
if(isset($_POST['event'])){
    switch($_POST['event']){
        case 'get_product':
            $result = get_product_by_id($_POST['data'], $wpdb);
            break;
        case 'add_product':
            $result = add_product($_POST['data'], $wpdb);
            break;
       case 'upd_product':
            $result = upd_product($_POST['id'], $_POST['data'], $wpdb);
            break;
        case 'del_product':
            $result = del_product($_POST['data'], $wpdb);
            break;
        case 'get_prod_list':
            $result = get_prod_list($_POST['data'], $wpdb);
            break;
    }
}

echo $result;
?>