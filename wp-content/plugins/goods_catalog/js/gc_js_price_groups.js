/*
 из сериализованого объекта формы делает ассоциативный массив
 */
function serializedFormToArray(data){
    var index = 0;
    var res = {};
    res[data[index]['name']] = data[index]['value'];
    for (index = 1; index < data.length; ++index) {
        res[data[index]['name']] = data[index]['value'];
    }

    return res;
}

$(document).ready(function() {

    $("#add_price_group").click(function(event) {
        var a = $("#add_price_group_f").serializeArray();
        var c = serializedFormToArray(a);
        var b = JSON.stringify(c);
        $.ajax({
                url: price_groups_ajax.url,
                type: 'POST',
                data: {
                    event : 'add_price_group',
                    data  : b
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 1000);
            });

    });

    $(".del_price_group").click(function(event) {
        var a = event.target.id;
        a = a.replace("del_price_group", '');
        $.ajax({
                url: price_groups_ajax.url,
                type: 'POST',
                data: {
                    event : 'del_price_group',
                    data  : a
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 1000);
            });
    });

    $(".upd_price_group").click(function(event) {
        var a = event.target.id;
        a = a.replace("upd_price_group", '');
        var b = $("#new_name"+a).val();
        var c = new Array();
        c[0] = a;
        c[1] = b;
        var res = JSON.stringify(c);
        $.ajax({
                url: price_groups_ajax.url,
                type: 'POST',
                data: {
                    event : 'upd_price_group',
                    data  : res
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 100);
            });
    });



});


