<?php
/*
 * Вывод ВСЕХ категорий товаров
 * $db - ссылка wp на базу данных
 * возвращает масив объектов
 * поля объекта
 * id - id категории
 * name - имя категории
 * image - картинка категории
 * thumbnail - миниатюра
 * p_count - кол-во товаров в категории
 */
function get_all_cats($db){
    $query = "SELECT * FROM ".$db->prefix."gc_categories AS cats WHERE cats.parent = 0 order by cats.order ASC";
    // $query = "SELECT * FROM ".$db->prefix."gc_categories AS categories WHERE categories.id <> 0";
    $items = $db->get_results($query);
    $index = 0;
    if(isset($items[0])){
        foreach($items as $cats) {
            $res[$index] = $cats;
            $query = "SELECT Count(products.id) AS p_count
                        FROM
                        ".$db->prefix."gc_products AS products
                        WHERE
                        products.cat_id IN (SELECT
categories.id
FROM
".$db->prefix."gc_categories AS categories
WHERE
categories.id = ".$cats->id." OR
categories.parent = ".$cats->id." )";
            /*$query = "SELECT Count(products.cat_id) AS p_count
                        FROM
                        ".$db->prefix."gc_products AS products
                        WHERE
                        products.cat_id = ".$cats->id;*/

            $tmp = $db->get_results($query);
            $res[$index]->p_count = $tmp[0]->p_count;
            $index++;
        }
        return $res;
    }

    return NULL;
}
function get_sub_cats($db, $id){
    $query = "SELECT * FROM ".$db->prefix."gc_categories AS cats
                WHERE cats.id > 1
                AND cats.parent = ".$id." order by cats.order ASC";
    // $query = "SELECT * FROM ".$db->prefix."gc_categories AS categories WHERE categories.id <> 0";
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

function get_category_name($db, $id){
    $query = "SELECT name FROM ".$db->prefix."gc_categories AS cats WHERE cats.id = ".$id;
    $item = $db->get_results($query);
    return $item;
}
function get_category_desc($db, $id){
    $query = "SELECT description FROM ".$db->prefix."gc_categories AS cats WHERE cats.id = ".$id;
    $item = $db->get_results($query);
    return $item;
}
function get_product_name($db, $id){
    $query = "SELECT name FROM ".$db->prefix."gc_products AS products WHERE products.id = ".$id;
    $item = $db->get_results($query);
    return $item;
}
/*
 * Вывод ВСЕЙ информации товара по заданному id
 * $id - id товара
 * $db - ссылка wp на базу данных
 */
function get_product_by_id($id, $db){
    $prod_id = $id;

    $query = "SELECT *
                FROM
               ".$db->prefix."gc_products AS products
                WHERE
                products.id = ".$prod_id." ORDER by products.name ASC";
    $prod = $db->get_results($query);
    if(isset($prod[0]->name)){
        $query = "SELECT attributes.`name`, attributes.unit, parameters.`value`
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
                    ORDER BY images.order ASC";

        $prod_img = $db->get_results($query);

        if(isset($prod_img[0])){
            $prod[0]->images = $prod_img;
        }
        return $prod[0];
    }

    return NULL;
}
/*
 * Вывод СОКРАЩЕННОЙ информации товара по заданному id
 * $id - id товара
 * $db - ссылка wp на базу данных
 */
function get_short_product_by_id($id, $db){
    $att_limit = 4; //Количество выводимых атрибутов
    $prod_id = $id;

    $query = "SELECT products.id, products.`name`, products.type
                FROM
               ".$db->prefix."gc_products AS products
                WHERE
                products.id = ".$prod_id." ORDER by products.name ASC";
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
/*
 * Вывод информации товара по заданной id категории
 * $prod_cat - id категории
 * $db - ссылка wp на базу данных
 */
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
/*
 * Вывод товара по заданной id категории по страницам
 * $prod_cat - id категории
 * $page - номер страницы (нумерация страниц от 1)
 * $prod_per_page - количество товаров на страницу
 * $db - ссылка wp на базу данных
 */
function get_product_by_cat_per_page($prod_cat, $page, $prod_per_page,  $db){
    $page--;
    $query = "SELECT products.id
                FROM
                ".$db->prefix."gc_products AS products
                WHERE
                products.cat_id = ".$prod_cat." ORDER by products.name ASC
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
/*
 * Вывод товара по заданному фильтру из id категории и части имени товара
 * $prod_cat - id категории
 * $prod_name - фрагмент имени товара
 * $db - ссылка wp на базу данных
 */
function get_product_by_cat_name_filter($prod_cat, $prod_name, $db){
    $query = "SELECT products.id
                FROM
                ".$db->prefix."gc_products AS products
                WHERE
                products.cat_id = ".$prod_cat." AND
                products.`name` LIKE \"%".$prod_name."%\""." ORDER by products.name ASC";


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

?>