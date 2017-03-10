/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){

    $('.styleTextPages').children( ":header" ).each(function(){
        $(this).addClass();
        var textH = $(this).text();
        $(this).addClass('textPageHeader');
        $(this).html('');
        $(this).append('<div class="textPageHeaderBlock"><b>'+textH+'</b></div>');
    });

    $(".homeCategoryHover a").hover(function(){
        $(this).find('.categoryName').css('color','#ffd200');
        $(this).find('.countProductCategory').css('background-color','#ffd200');
        $(this).find('.viewIcon').show();
    },function(){
        $(this).find('.categoryName').css('color','white');
        $(this).find('.countProductCategory').css('background-color','#808080');
        $(this).find('.viewIcon').hide();
    });

            $( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                var form_data = $(this).serializeArray();
                $.ajax({
                    type: 'POST',
                    url: '/wp-content/themes/ast_theme/message.php',
                    data: {form_data:form_data},
                    success: function(response){
                        $("[id^='myModal']").modal('hide');
                        if(response == 1){
                            swal("Спасибо за обращение!", 'Мы свяжемся с вами в ближайшее время.', "success")
                        }else{
                            swal("Ошибка!", 'Возникла ошибка, повторите попытку.', "error")
                        }
                        console.log(response);
                    }
                });
            });
});