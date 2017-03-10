function serializedFormToArray(data) {
    var index = 0;
    var res = {};
    res[data[index]['name']] = data[index]['value'];
    for (index = 1; index < data.length; ++index) {
        res[data[index]['name']] = data[index]['value'];
    }

    return res;
}

window.tr_iterator = 0;
window.att_count = 0;
window.price_count = 0;
window.prod_id = 0;


$(document).ready(function () {

    tinymce.init({selector: 'textarea#prod_desc'});

    function del_prod(event) {
        var a = event.target.id;
        a = a.replace("del_prod", '');

        $.ajax({
                url: products_ajax.prod_url,
                type: 'POST',
                data: {
                    event: 'del_product',
                    data: a
                },
            })
            .done(function (res) {
                $("#ltr" + a).detach();

                //var data = JSON.parse(res);

                alert(res);
            });


    }

    function get_prod_info(event) {
        var a = event.target.id;
        a = a.replace("upd_prod", '');

        $.ajax({
                url: products_ajax.prod_url,
                type: 'POST',
                data: {
                    event: 'get_product',
                    data: a
                },
            })
            .done(function (res) {
                $("#product_container").html("");
                $("[name='prod_inst_b']").val("");
                $("#prod_inst_url").val("");
                $("#prod_name").val("");
                tinyMCE.activeEditor.setContent("");
                $("#product_attributes").html("");
                $("#product_prices").html("");

                var data = JSON.parse(res);

                prod_id = data.id;

                $("#product_edit_container").attr('hidden', false);
                $("#cat_opt" + data.cat_id).attr('selected', true);
                $("[name='prod_inst_b']").val(data.instruction_button);
                $("#prod_inst_url").val(data.instruction_url);
                $("#prod_name").val(data.name);

                $("#prod_main_img_c").html("");
                $("#prod_sec_img_c").html("");

                var index = 0;

                if (data.images !== undefined) {
                    data.images.forEach(function (item) {

                        var img_o = document.createElement('img');
                        img_o.src = server + item.url;

                        img_o.style.width = "128px";
                        img_o.style.height = "128px";

                        var input_o = document.createElement('input');
                        input_o.hidden = "true";
                        input_o.name = "prod_sec_img_url" + index;
                        input_o.value = item.url;
                        if (index > 0) {
                            input_o.name = "prod_sec_img_url" + index;
                            $("#prod_sec_img_c").append(img_o);
                            $("#prod_sec_img_c").append(input_o);
                        } else {
                            input_o.name = "prod_main_img_url" + index;
                            $("#prod_main_img_c").append(img_o);
                            $("#prod_main_img_c").append(input_o);
                        }
                        index++;


                    });
                }


                $("#prod_inst_b").val(data.instruction_button);
                $("#prod_inst_url").val(data.instruction_url);

                tinyMCE.activeEditor.setContent(data.description);

                var opt = "";
                if (data.params !== undefined) {
                    opt += "<table class='table' id=\"sortable_att\"><tr><th>Название</th><th>Ед Измерения</th><th colspan='2' class='text-center'>Значение</th></tr><tbody id=\"sortable_att_c\">";
                    data.params.forEach(function (data) {

                        opt += "<tr id=\"tr" + tr_iterator + "\"><td>" + data.name + "</td><td>" + data.unit + "</td>" +
                            "<td><input class='control-form' type=\"text\" name=\"prod_att" + data.id + "\" id=\"prod_att" + data.id + "\" value='" + data.value + "'>" +
                            "</td><td><span class='glyphicon glyphicon-remove del_att' id='" + tr_iterator + "'></span></td></tr>";

                        tr_iterator++;
                        att_count++;
                    });
                    opt += "</tbody></table>";
                }

                $("#product_attributes").html(opt);

                var fixHelper = function (e, ui) {
                    ui.children().each(function () {
                        $(this).width($(this).width());
                    });
                    return ui;
                };

                $("#sortable_att tbody").sortable({
                    helper: fixHelper
                }).disableSelection();

                $(".del_att").click(function (event) {
                    var a = event.target.id;
                    $("#tr" + a).detach();
                    att_count--;
                    if ($("#sortable_att > tbody").children('tr').length == 1) {
                        $("#product_attributes").html("");

                    }
                });
                opt = '';
                if (data.prices !== undefined) {
                    opt = "<table class='table' id=\"sortable_prices\"><tr><th>Название</th><th colspan='2' class='text-center'>Значение</th></tr><tbody id=\"sortable_price_c\">";

                    data.prices.forEach(function (data) {
                        opt += "<tr id=\"tr" + tr_iterator + "\"><td>" + data.name + "</td>" +
                            "<td><input class='control-form' type=\"text\" name=\"prod_price" + data.id + "\" id=\"prod_price" + data.id + "\" value='" + data.value + "'>" +
                            "</td><td><span class='glyphicon glyphicon-remove del_pr' id='" + tr_iterator + "'></span></td></td></tr>";

                        tr_iterator++;
                        price_count++;

                    });

                    opt += "</tbody></table>";
                }

                $("#product_prices").html(opt);

                $("#sortable_prices tbody").sortable({
                    helper: fixHelper
                }).disableSelection();

                $(".del_pr").click(function (event) {
                    var a = event.target.id;
                    $("#tr" + a).detach();
                    price_count--;
                    if ($("#sortable_prices > tbody").children('tr').length == 1) {
                        $("#product_prices").html("");
                    }
                });


            });
    }

    function search_prod() {
        $("#product_edit_container").attr('hidden', true);
        var d = new Object();
        d.cat_id = $("#search_product_cat").val();
        d.name = $("#search_prod").val();

        var data = JSON.stringify(d);

        $.ajax({
                url: products_ajax.prod_url,
                type: 'POST',
                data: {
                    event: 'get_prod_list',
                    data: data
                },
            })
            .done(function (res) {

                var data = JSON.parse(res);
                var t = "<table class='table' style='width: 50%;'>";
                t += "<tr><th>Название</th><th colspan='2'>Действие</th></tr>";
                data.forEach(function (item) {
                    t += "<tr id='ltr" + item.id + "'><td>" + item.name + "</td><td><input type='button' class='upd_prod btn btn-default' id='upd_prod" + item.id + "' value='Изменить'>" +
                        "</td><td><input type='button' class='del_prod  btn btn-default' id='del_prod" + item.id + "' value='Удалить'></td></tr>";
                });
                t += "</table>";
                $("#product_container").html(t);
                $(".del_prod").click(del_prod);
                $(".upd_prod").click(get_prod_info);

            });

    }


    $("#search_prod").keyup(search_prod);
    $("#search_product_cat").change(search_prod);

    /*
     выводит список групп аттрибутов
     */
    $("#prod_att_g_list").change(function (event) {
        var b = $("#prod_att_g_list").val();
        $.ajax({
                url: products_ajax.att_url,
                type: 'POST',
                data: {
                    event: 'get_att',
                    data: b
                },
            })
            .done(function (res) {
                var data = JSON.parse(res);
                att_count = 0;
                var opt = "";
                if (data.length > 0) {
                    opt += "<table class='table' id=\"sortable_att\"><tr><th>Название</th><th>Ед Измерения</th><th colspan='2' class='text-center'>Значение</th></tr><tbody id=\"sortable_att_c\">";
                    var index;
                    for (index = 0; index < data.length; ++index) {
                        opt += "<tr id=\"tr" + tr_iterator + "\"><td>" + data[index].name + "</td><td>" + data[index].unit + "</td>" +
                            "<td><input type=\"text\" class=\"control-form\" name=\"prod_att" + data[index].id + "\" id=\"prod_att" + data[index].id + "\"></td>" +
                            "<td><span class='glyphicon glyphicon-remove del_att' id='" + tr_iterator + "'></span></td></tr>";

                        tr_iterator++;
                        att_count++;
                    }
                    opt += "</tbody></table>";
                }

                $("#product_attributes").html(opt);

                var fixHelper = function (e, ui) {
                    ui.children().each(function () {
                        $(this).width($(this).width());
                    });
                    return ui;
                };

                $("#sortable_att tbody").sortable({
                    helper: fixHelper
                }).disableSelection();


                $(".del_att").click(function (event) {
                    var a = event.target.id;
                    $("#tr" + a).detach();
                    att_count--;
                    if ($("#sortable_att > tbody").children('tr').length == 1) {
                        $("#product_attributes").html("");

                    }
                });
            });

    });
    /*
     выводит список групп цен
     */
    $("#prod_price_g_list").change(function (event) {
        var b = $("#prod_price_g_list").val();
        $.ajax({
                url: products_ajax.price_url,
                type: 'POST',
                data: {
                    event: 'get_prices',
                    data: b
                },
            })
            .done(function (res) {
                var data = JSON.parse(res);
                price_count = 0;
                var opt = "";
                if (data.length > 0) {
                    opt += "<table class='table' id=\"sortable_prices\"><tr><th>Название</th><th colspan='2' class='text-center'>Значение</th></tr><tbody id=\"sortable_price_c\">";
                    var index;
                    for (index = 0; index < data.length; ++index) {
                        opt += "<tr id=\"tr" + tr_iterator + "\"><td>" + data[index].name + "</td>" +
                            "<td><input type=\"text\" class=\"control-form\" name=\"prod_price" + data[index].id + "\" id=\"prod_price" + data[index].id + "\">" +
                            "</td><td><span class='glyphicon glyphicon-remove del_pr' id='" + tr_iterator + "'></span></td></td></tr>";

                        tr_iterator++;
                        price_count++;
                    }
                    opt += "</tbody></table>";
                }

                $("#product_prices").html(opt);

                var fixHelper = function (e, ui) {
                    ui.children().each(function () {
                        $(this).width($(this).width());
                    });
                    return ui;
                };

                $("#sortable_prices tbody").sortable({
                    helper: fixHelper
                }).disableSelection();

                $(".del_pr").click(function (event) {
                    var a = event.target.id;
                    $("#tr" + a).detach();
                    price_count--;
                    if ($("#sortable_prices > tbody").children('tr').length == 1) {
                        $("#product_prices").html("");
                    }
                });
            });
    });
    /*
     добавляет новый пользовательский параметр
     */
    $("#new_att").click(function () {
        var att_name = $("#new_att_name").val();
        var att_unit = $("#new_att_unit").val();
        var new_att = "";
        if (att_count < 1) {
            new_att += "<table class='table' id=\"sortable_att\"><tr><th>Название</th><th>Ед Измерения</th><th colspan='2' class='text-center'>Значение</th></tr><tbody id=\"sortable_att_c\">";
        }
        new_att += "<tr id=\"tr" + tr_iterator + "\"><td>" + att_name + "</td><td>" + att_unit + "</td>" +
            "<td><input type=\"text\" name=\"new_att_v" + tr_iterator + "\" id=\"new_att" + tr_iterator + "\">" +
            "<input type=\"text\" name=\"new_att_n" + tr_iterator + "\" id=\"new_att_n" + tr_iterator + "\" value='" + att_name + "' hidden>" +
            "<input type=\"text\" name=\"new_att_u" + tr_iterator + "\" id=\"new_att_u" + tr_iterator + "\" value='" + att_unit + "' hidden>" +
            "</td><td><span class='glyphicon glyphicon-remove del_att' id='" + tr_iterator + "'></span></td></tr>";

        if (att_count < 1) {
            new_att += "</tbody></table>";
        }

        if (att_count < 1) {
            $("#product_attributes").html(new_att);
        } else {
            $("#sortable_att_c").append(new_att);
        }

        var fixHelper = function (e, ui) {
            ui.children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        };

        $("#sortable_att_c").sortable({
            helper: fixHelper
        }).disableSelection();


        $(".del_att").click(function (event) {
            var a = event.target.id;
            $("#tr" + a).detach();
            att_count--;
            if ($("#sortable_att > tbody").children('tr').length == 1) {
                $("#product_attributes").html("");

            }

        });
        tr_iterator++;
        att_count++;
    });
    /*
     добавляет новую пользовательскую цену
     */
    $("#new_price").click(function () {
        var price_name = $("#new_price_name").val();

        var new_price = "";
        if (price_count < 1) {
            new_price += "<table class='table' id=\"sortable_price\"><tr><th>Название</th><th>Ед Измерения</th><th colspan='2' class='text-center'>Значение</th></tr><tbody id=\"sortable_price_c\">";
        }
        new_price += "<tr id=\"tr" + tr_iterator + "\"><td>" + price_name + "</td>" +
            "<td><input type=\"text\" name=\"new_price_v" + tr_iterator + "\" id=\"prod_price" + tr_iterator + "\">" +
            "<input type=\"text\" name=\"new_price_n" + tr_iterator + "\" id=\"prod_price" + tr_iterator + "\" value='" + price_name + "' hidden>" +
            "</td><td><span class='glyphicon glyphicon-remove del_pr' id='" + tr_iterator + "'></span></td></td></tr>";

        if (price_count < 1) {
            new_price += "</tbody></table>";
        }

        if (price_count < 1) {
            $("#product_prices").html(new_price);
        } else {
            $("#sortable_price_c").append(new_price);
        }

        var fixHelper = function (e, ui) {
            ui.children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        };

        $("#sortable_price_c").sortable({
            helper: fixHelper
        }).disableSelection();


        $(".del_pr").click(function (event) {
            var a = event.target.id;
            $("#tr" + a).detach();
            price_count--;
            if ($("#sortable_prices > tbody").children('tr').length == 1) {
                $("#product_prices").html("");

            }

        });
        tr_iterator++;
        price_count++;
    });
    /*
     задает основную картинку товара
     */
    $("#prod_main_img").click(function (e) {
        var custom_logo_uploader;
        e.preventDefault();
        if (custom_logo_uploader) {
            custom_logo_uploader.open();
            return;
        }
        custom_logo_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Выберите изображения',
            button: {
                text: 'Выбрать'
            },
            multiple: false
        });
        custom_logo_uploader.on('select', function () {
            attachment = custom_logo_uploader.state().get('selection').first().toJSON();

            $("#prod_main_img_c").html("");

            var img_o = document.createElement('img');
            img_o.src = attachment.url;

            img_o.style.width = "128px";
            img_o.style.height = "128px";

            var url = document.createElement('a');
            url.href = attachment.url;

            var input_o = document.createElement('input');
            input_o.hidden = "true";
            input_o.name = "prod_main_img_url";
            input_o.value = url.pathname;
            $("#prod_main_img_c").append(img_o);
            $("#prod_main_img_c").append(input_o);

        });
        custom_logo_uploader.open();

    });
    /*
     задает второстепенные картинки товара
     */
    $("#prod_sec_img").click(function (e) {
        var custom_logo_uploader;
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_logo_uploader) {
            custom_logo_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_logo_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Выберите изображения',
            button: {
                text: 'Выбрать'
            },
            multiple: true
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_logo_uploader.on('select', function () {
            attachment = custom_logo_uploader.state().get('selection').toJSON();
            $("#prod_sec_img_c").html("");
            var index = 2;
            var count = 0;

            attachment.forEach(function (entry) {

                count++;
                if (count > 4) {
                    return;
                }

                var img_o = document.createElement('img');
                img_o.src = entry.url;

                img_o.style.width = "128px";
                img_o.style.height = "128px";

                var url = document.createElement('a');
                url.href = entry.url;

                var input_o = document.createElement('input');
                input_o.hidden = "true";
                input_o.name = "prod_sec_img_url" + index++;
                input_o.value = url.pathname;
                $("#prod_sec_img_c").append(img_o);
                $("#prod_sec_img_c").append(input_o);


            });


        });
        //Open the uploader dialog
        custom_logo_uploader.open();

    });
    /*
     задает инструкцию товара
     */
    $("#prod_inst").click(function (e) {
        var custom_logo_uploader;
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_logo_uploader) {
            custom_logo_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_logo_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Выберите инструкцию',
            button: {
                text: 'Выбрать'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_logo_uploader.on('select', function () {
            attachment = custom_logo_uploader.state().get('selection').first().toJSON();
            var url = document.createElement('a');
            url.href = attachment.url;
            $("#prod_inst_url").val(url.pathname);

        });
        //Open the uploader dialog
        custom_logo_uploader.open();

    });

    $("#upd_prod").click(function () {

        var a = $("#upd_product_f").serializeArray();
        var c = serializedFormToArray(a);
        c.prod_desc = tinyMCE.get('prod_desc').getBody().innerHTML;
        var b = JSON.stringify(c);

        $.ajax({
                url: products_ajax.prod_url,
                type: 'POST',
                data: {
                    event: 'upd_product',
                    id: prod_id,
                    data: b
                },
            })
            .done(function (data) {
                alert(data);
                setTimeout(function () {
                    window.location.reload();
                }, 100);
            });
    });
});