<?php
global $wpdb;

if (function_exists('wp_enqueue_media')) {
    wp_enqueue_media();
}

?>
<style>
    table img {
        width: 64px;
        height: 64px;
    }
    td{
        padding-top: 32px !important;   
    }

</style>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<h3>Категории товаров</h3>
<div id="add_cat_container">
    <form id="add_cat_f" class="form-horizontal" enctype="multipart/form-data">

        <table class="table">
            <tr>
                <th># п/п</th>
                <th>Название(осн)</th>
                <th>Название(втр)</th>
                <th>Родитель</th>
                <th><input type="button" class="btn btn-default" id="cat_thumb_b" name="cat_thumb"
                           value="Задать миниатюру"></th>
                <th><input type="button" class="btn btn-default" id="cat_img_b" name="cat_img" value="Задать картинку">
                </th>
                <th></th>
            </tr>
            <tr>
                <td><input type="text" class="form-control" id="cat_order" name="cat_order"></td>
                <td><input type="text" class="form-control" id="cat_name" name="cat_name"></td>
                <td><input type="text" class="form-control" id="cat_name" name="cat_second_name"></td>
                <td><select name="parent" id="">
                        <option value="0">Базовая</option>

                    <?php
                    $query = "SELECT categories.name AS name, categories.`id` AS id
                        FROM
                        " . $wpdb->prefix . "gc_categories AS categories
                        WHERE categories.parent = 0";

                    $parent_options = "";
                    $cat = $wpdb->get_results($query, OBJECT_K);

                    foreach ($cat as $row) {
                        $parent_options .="<option value=\"".$row->id."\">".$row->name."</option>";

                    }
                    echo($parent_options);
                    ?></select></td>
                <td><input type="text" id="cat_thumb_url" name="cat_thumb_url" hidden><img id="cat_thumb" src=" "></td>
                <td><input type="text" id="cat_img_url" name="cat_img_url" hidden><img id="cat_img" src=" "></td>
                <td><input type="button" class="btn btn-default" id="add_cat" value="Добавить"></td>
            </tr>
        </table>
        <textarea id="cat_desc" class='cat_desc' name="cat_desc" type="text"></textarea>
    </form>

</div>

<?php
/*TEST CODE START*/

function getCategory($wpdb) {
    $query = $wpdb->get_results("SELECT * FROM wp_gc_categories AS cat WHERE cat.parent >= '0' ORDER BY cat.`order` ASC", 'ARRAY_A' );
    $result = array();
    $i = 0;
    while ($row = $query[$i++]) {
        $result[$row["parent"]][] = $row;
    }
    return $result;
}
//В переменную $category_arr записываем все категории
$category_arr = getCategory($wpdb);
//var_dump($category_arr);

function showRow($value, $wpdb){
    $view_cat = "";
    $view_cat .= "<tr id='cat". $value['id'] ."'><td><input type='text' class=\"form-control\" name='upd_cat_order" . $value['id'] . "' value='" . $value['order'] . "' ></td><td><img class='upd_cat_img' id='img_upd_cat_img" . $value['id'] . "' src=\"http://" . $_SERVER['SERVER_NAME'] . $value['image'] . "\">
                                  <input id='inp_upd_cat_img" . $value['id'] . "' value='" . $value['image'] . "' hidden></td>

                              <td><img class='upd_cat_thumb' id='img_upd_cat_thumb" . $value['id'] . "' src=\"http://" . $_SERVER['SERVER_NAME'] . $value['thumbnail'] . "\">
                                  <input id='inp_upd_cat_thumb" . $value['id'] . "' value='" . $value['thumbnail'] . "' hidden></td>";

    $view_cat .= "<td><input type='text' class=\"form-control\" name='upd_cat_name" . $value['id'] . "' value='" . $value['name'] . "' ></td>";
    $view_cat .= "<td><input type='text' class=\"form-control\" name='upd_cat_second_name" . $value['id'] . "' value='" . $value['second_name'] . "' ></td>";


    $view_cat .= "<td><select id=\"upd_cat_parent" . $value['id'] . "\">
                        <option value=\"0\">Базовая</option>";

    $query = "SELECT categories.name AS name, categories.`id` AS id
                        FROM
                        " . $wpdb->prefix . "gc_categories AS categories
                        WHERE categories.parent = 0";

    $parent_options = "";
    $sub_cat = $wpdb->get_results($query, OBJECT_K);
    $active_p = "";
    foreach ($sub_cat as $sub_row) {
        $active_p = "";
        if($value['parent'] == $sub_row->id){
            $active_p = " selected ";
        }
        $parent_options .="<option value=\"".$sub_row->id."\" ".$active_p.">".$sub_row->name."</option>";

    }

    $view_cat .= $parent_options;

    $view_cat .="</select></td>";



    $query = "SELECT Count(categories.id) AS id_count
                        FROM
                          " . $wpdb->prefix . "gc_categories AS categories ,
                          " . $wpdb->prefix . "gc_products AS products
                        WHERE
                          products.cat_id = categories.id AND
                          categories.id = " . $value['id'];

    $child_exist = $wpdb->get_results($query);
    if ($child_exist[0]->id_count == 0 && $value['id'] > 0) {
        $view_cat .= "<td><input type=\"button\" value=\"Удалить\" class=\"del_cat btn btn-default\" id=\"del_cat" . $value['id'] . "\">";
    } else {
        $view_cat .= "<td><input type=\"button\" class='btn btn-default' value=\"Удалить\"  disabled></td>";
    }
    $view_cat .= "<td><input type='button' value='Обновить' class='upd_cat btn btn-default' id='upd_cat" . $value['id'] . "'></td></tr>";
    $view_cat .= "<tr><td colspan='7'><textarea class='cat_desc' id=\"cat_desc" . $value['id'] . "\" name=\"cat_desc\" type=\"text\">" . $value['description'] . "</textarea></td></tr>";
    return $view_cat;
}
/**
 * Вывод дерева
 * @param Integer $parent_id - id-родителя
 * @param Integer $level - уровень вложености
 */
function outTree($parent_id, $level, $category_arr, $wpdb) {
    if (isset($category_arr[$parent_id])) { //Если категория с таким parent_id существует
        foreach ($category_arr[$parent_id] as $value) { //Обходим
            /**
             * Выводим категорию
             *  $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..)
             */
            echo "<div style='margin-left:" . ($level * 25) . "px;'><a href='#cat". $value['id'] ."'>" . $value["name"] . "</a></div>";
            echo showRow($value, $wpdb);

            $level = $level + 1; //Увеличиваем уровень вложености
            //Рекурсивно вызываем эту же функцию, но с новым $parent_id и $level
            outTree($value["id"], $level, $category_arr, $wpdb);
            $level = $level - 1; //Уменьшаем уровень вложености
        }
    }
}

//outTree(0, 0, $category_arr, $wpdb);

/*TEST CODE END*/
?>

<div id="cat_container">
    <h3>Существующие категории</h3>
    <table class="table">
        <tr>
            <th># п/п</th>
            <th>Изображение</th>
            <th>Миниатюра</th>
            <th>Название(осн)</th>
            <th>Название(втр)</th>
            <th>Родитель</th>
            <th class="text-center" colspan="2">Удалить(если пустая)/Изменить</th>
        </tr>
        <?php
        /*$cat = $wpdb->get_results("SELECT *  FROM " . $wpdb->prefix . "gc_categories AS categories WHERE categories.id <> 1 ORDER BY categories.`order` ASC, categories.`name` ASC", OBJECT_K);

        foreach ($cat as $row) {

            $view_cat .= "<tr><td><input type='text' class=\"form-control\" name='upd_cat_order" . $row->id . "' value='" . $row->order . "' ></td><td><img class='upd_cat_img' id='img_upd_cat_img" . $row->id . "' src=\"http://" . $_SERVER['SERVER_NAME'] . $row->image . "\">
                                  <input id='inp_upd_cat_img" . $row->id . "' value='" . $row->image . "' hidden></td>

                              <td><img class='upd_cat_thumb' id='img_upd_cat_thumb" . $row->id . "' src=\"http://" . $_SERVER['SERVER_NAME'] . $row->thumbnail . "\">
                                  <input id='inp_upd_cat_thumb" . $row->id . "' value='" . $row->thumbnail . "' hidden></td>";

            $view_cat .= "<td><input type='text' class=\"form-control\" name='upd_cat_name" . $row->id . "' value='" . $row->name . "' ></td>";


            $view_cat .= "<td><select id=\"upd_cat_parent" . $row->id . "\">
                        <option value=\"0\">Базовая</option>";

            $query = "SELECT categories.name AS name, categories.`id` AS id
                        FROM
                        " . $wpdb->prefix . "gc_categories AS categories
                        WHERE categories.parent = 0";

            $parent_options = "";
            $sub_cat = $wpdb->get_results($query, OBJECT_K);
            $active_p = "";
            foreach ($sub_cat as $sub_row) {
                $active_p = "";
                if($row->parent == $sub_row->id){
                    $active_p = " selected ";
                }
                $parent_options .="<option value=\"".$sub_row->id."\" ".$active_p.">".$sub_row->name."</option>";

            }

            $view_cat .= $parent_options;

            $view_cat .="</select></td>";



            $query = "SELECT Count(categories.id) AS id_count
                        FROM
                          " . $wpdb->prefix . "gc_categories AS categories ,
                          " . $wpdb->prefix . "gc_products AS products
                        WHERE
                          products.cat_id = categories.id AND
                          categories.id = " . $row->id;

            $child_exist = $wpdb->get_results($query);
            if ($child_exist[0]->id_count == 0 && $row->id > 0) {
                $view_cat .= "<td><input type=\"button\" value=\"Удалить\" class=\"del_cat btn btn-default\" id=\"del_cat" . $row->id . "\">";
            } else {
                $view_cat .= "<td><input type=\"button\" class='btn btn-default' value=\"Удалить\"  disabled></td>";
            }
            $view_cat .= "<td><input type='button' value='Обновить' class='upd_cat btn btn-default' id='upd_cat" . $row->id . "'></td></tr>";
            $view_cat .= "<tr><td colspan='7'><textarea class='cat_desc' id=\"cat_desc" . $row->id . "\" name=\"cat_desc\" type=\"text\">" . $row->description . "</textarea></td></tr>";

        }

        echo $view_cat;/**/
        outTree(0, 0, $category_arr, $wpdb);
        ?>

    </table>
</div>
