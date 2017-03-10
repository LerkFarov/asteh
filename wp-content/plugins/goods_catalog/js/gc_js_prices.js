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
    $("#add_price").click(function(event) {
        var a = $("#add_price_f").serializeArray();
        var c = serializedFormToArray(a);
        var b = JSON.stringify(c);
        $.ajax({
                url: prices_ajax.url,
                type: 'POST',
                data: {
                    event : 'add_prices',
                    data  : b
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 100);
            });

    });

    $("#upd_sel").change(function(event) {
        var a = $("#upd_sel").val();
        $.ajax({
                url: prices_ajax.url,
                type: 'POST',
                data: {
                    event : 'get_prices',
                    data  : a
                },
            })
            .done(function(data) {

                if(data != "[]"){
                    var res = JSON.parse(data);
                    var r = "";

                    res.forEach(function(item){
                        r += "<tr>";
                        r += "<td><input class='form-control' name='price_n"+item.id+"' value='"+item.name+"'></td>";
                        r += "<td><span class='upd_b btn btn-default' id='"+item.id+"'>Обновить</span></td>";
                        if(item.count > 0){
                            r += "<td></td>";
                        }else{
                            r += "<td><span class='del_b btn btn-default' id='"+item.id+"'>Удалить</span></td>";
                        }
                        r += "</tr>";
                    });
                    $("#price_table").html(r);
                }else{
                    $("#price_table").html("<div class='alert alert-warning'>Группа пуста</div>");

                }

                $(".upd_b").click(function(event){
                    var a = {};
                    a.id     = event.target.id;
                    a.name   = $("[name = price_n"+ a.id+"]").val();
                    var d = JSON.stringify(a);
                    $.ajax({
                            url: prices_ajax.url,
                            type: 'POST',
                            data: {
                                event : 'upd_prices',
                                data  : d
                            },
                        })
                        .done(function(data) {
                            alert(data);
                        });

                });

                $(".del_b").click(function(event){

                    var a     = event.target.id;
                    $.ajax({
                            url: prices_ajax.url,
                            type: 'POST',
                            data: {
                                event : 'del_prices',
                                data  : a
                            },
                        })
                        .done(function(data) {
                            alert(data);
                            setTimeout(function() {window.location.reload();}, 100);
                        });

                });

            });

    });


});