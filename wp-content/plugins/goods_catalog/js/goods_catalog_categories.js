/*
из объекта формы делает массив
 */
function formToArray(data){
    var index = 0;
    var cur = {};
    cur[data[index]['name']] = data[index]['value'];
    for (index = 1; index < data.length-1; ++index) {
        cur[data[index]['value']] = data[++index]['value'];
    }

    return cur;
}

$(document).ready(function() {
    window.p_count = 0; //счетчик новых параметров для категорий


    $("#add_cat").click(function(event) {

        var a = $("#add_cat_f").serializeArray();
        var c = formToArray(a);
        var b = JSON.stringify(c);
        $.ajax({
                url: myAjax.ajaxurl,
                type: 'POST',
                data: {
                    event : 'add_cat',
                    data  : b
                },
            })
            .done(function(data) {
               // var c = data;
                alert(data);
            });
    });

    $("#add_cat_param").click(function(event) {
        p_count += 1;

        var p = "<tr class='p"+p_count+"'>";
        p += '<td><input type="text" name="param'+p_count+'"></td>';
        p += '<td><input type="text" name="unit'+p_count+'"></td>';
        p += '<td><input type="button" value="убрать" id="del_cat_param'+p_count+'" ></td>';
        p += '</tr>';

        $(".cat_parameters").append(p);

        $("#del_cat_param"+p_count+"").click(function(event){
            var a = event.target.id;
            a = a.replace("del_cat_param", '');
            $(".p"+a+"").detach();
        });


    });


});


