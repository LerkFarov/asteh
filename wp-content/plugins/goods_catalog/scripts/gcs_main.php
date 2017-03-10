<?php
global $wpdb;

function get_categories(){
    return "Категория Н";
}
function add_categories($data){
    return "Категория добавлена";
}
function upd_categories(){
    return "Категория обновлена";
}
function del_categories(){
    return "Категория удалена";
}

if(isset($_POST['event'])){
    switch($_POST['event']){
        case 'get_cat':
            $result = get_categories();
            break;
        case 'add_cat':
            $result = get_categories();
            break;
        case 'upd_cat':
            $result = upd_categories();
            break;
        case 'del_cat':
            $result = del_categories();
            break;
    }
}

print_r($_POST);
echo $result;
?>