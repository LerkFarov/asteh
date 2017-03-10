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

    tinymce.init({ selector:'textarea.cat_desc' });

    $('#cat_thumb_b').click(function(e) {
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
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_logo_uploader.on('select', function() {
            attachment = custom_logo_uploader.state().get('selection').first().toJSON();
            $('#cat_thumb').attr('width','32');
            $('#cat_thumb').attr('height','32');
            $('#cat_thumb').attr('src',attachment.url);
            var url = document.createElement('a');
            url.href = attachment.url;

            $('#cat_thumb_url').val(url.pathname);

        });
        //Open the uploader dialog
        custom_logo_uploader.open();
    });

    $('#cat_img_b').click(function(e) {
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
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_logo_uploader.on('select', function() {
            attachment = custom_logo_uploader.state().get('selection').first().toJSON();
            $('#cat_img').attr('width','32');
            $('#cat_img').attr('height','32');
            $('#cat_img').attr('src',attachment.url);
            //$('#ftrimg').attr('src',attachment.sizes.thumbnail.url);
            var url = document.createElement('a');
            url.href = attachment.url;

            $('#cat_img_url').val(url.pathname);

        });
        //Open the uploader dialog
        custom_logo_uploader.open();
    });

    $("#add_cat").click(function(event) {
        var a = $("#add_cat_f").serializeArray();
        var c = serializedFormToArray(a);
        c.cat_desc = tinyMCE.get('cat_desc').getBody().innerHTML;
        var b = JSON.stringify(c);
        $.ajax({
                url: categories_ajax.url,
                type: 'POST',
                data: {
                    event : 'add_cat',
                    data  : b
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 1000);
            });

    });

    $(".del_cat").click(function(event) {
        var a = event.target.id;
        a = a.replace("del_cat", '');
        $.ajax({
                url: categories_ajax.url,
                type: 'POST',
                data: {
                    event : 'del_cat',
                    data  : a
                },
            })
            .done(function(data) {
                alert(data);
                setTimeout(function() {window.location.reload();}, 1000);
            });
    });

    $(".upd_cat_img").click(function(e){
        var a = event.target.id;
        a = a.replace("img_upd_cat_img", '');

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
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_logo_uploader.on('select', function() {
            attachment = custom_logo_uploader.state().get('selection').first().toJSON();

            $("#img_upd_cat_img"+a).attr('src',attachment.url);
            var url = document.createElement('a');
            url.href = attachment.url;


            $("#inp_upd_cat_img"+a).val(url.pathname);

            //tmp = $("s").val();


        });
        //Open the uploader dialog
        custom_logo_uploader.open();
    });

    $(".upd_cat_thumb").click(function(e){
        var a = event.target.id;
        a = a.replace("img_upd_cat_thumb", '');

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
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_logo_uploader.on('select', function() {
            attachment = custom_logo_uploader.state().get('selection').first().toJSON();
           // $("img[id='upd_cat_img"+a+"']").attr('src',attachment.url);
            $("#img_upd_cat_thumb"+a).attr('src', attachment.url);
            var url = document.createElement('a');
            url.href = attachment.url;

            $("#inp_upd_cat_thumb"+a).val(url.pathname);

        });
        //Open the uploader dialog
        custom_logo_uploader.open();
    });

    $(".upd_cat").click(function(event){
        var a = event.target.id;
        a = a.replace("upd_cat", '');
        var d = new Object();
        d.id = a;
        d.name = $("input[name='upd_cat_name"+a+"']").val();
        d.second_name = $("input[name='upd_cat_second_name"+a+"']").val();

        d.cat_order = $("input[name='upd_cat_order"+a+"']").val();
        d.cat_parent = $("#upd_cat_parent"+a).val();

        var url = document.createElement('a');
        url.href = $("#img_upd_cat_img"+a).attr('src');
        d.img = url.pathname;

        url.href = $("#img_upd_cat_thumb"+a).attr('src');
        d.thumb = url.pathname;

        d.cat_desc = tinyMCE.get('cat_desc'+a).getBody().innerHTML;

        var res = JSON.stringify(d);

        $.ajax({
                url: categories_ajax.url,
                type: 'POST',
                data: {
                    event : 'upd_cat',
                    data  : res
                },
            })
            .done(function(data) {
                alert(data);
               // setTimeout(function() {window.location.reload();}, 100);
            });

    });



});


