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

    $("#add_att_group").click(function(event) {
        var a = $("#add_att_group_f").serializeArray();
        var c = serializedFormToArray(a);
        var b = JSON.stringify(c);
        $.ajax({
                url: att_groups_ajax.url,
                type: 'POST',
                data: {
                    event : 'add_att_group',
                    data  : b
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 1000);
            });

    });

    $(".del_att_group").click(function(event) {
        var a = event.target.id;
        a = a.replace("del_att_group", '');
        $.ajax({
                url: att_groups_ajax.url,
                type: 'POST',
                data: {
                    event : 'del_att_group',
                    data  : a
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 1000);
            });
    });

    $(".upd_att_group").click(function(event) {
        var a = event.target.id;
        a = a.replace("upd_att_group", '');
        var b = $("#new_name"+a).val();
        var c = new Array();
        c[0] = a;
        c[1] = b;
        var res = JSON.stringify(c);
        $.ajax({
                url: att_groups_ajax.url,
                type: 'POST',
                data: {
                    event : 'upd_att_group',
                    data  : res
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 100);
            });
    });




});


