$(function(){
    'use strict';

    $('[placeholder]').focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
        
    }).blur(function () {

        $(this).attr('placeholder',$(this).attr('data-text'));
    });


    $('.confirm').click(function(){
        return confirm("Do You Rellay Want To Delete This ?");
    });


    $('.req').blur(function(){
        if($(this).val().length < 5 )
        {
            $(this).css("border","1px solid #F00");
            $(this).parent().find('.custom-alert').fadeIn(1000);
        }else{
            $(this).css("border","1px solid #080");
            $(this).parent().find('.custom-alert').fadeOut(1000);
        }
    });

    $('.passs').blur(function(){
        if($(this).val().length < 8 )
        {
            $(this).css("border","1px solid #F00");
            $(this).parent().find('.custom-alert').fadeIn(1000);
        }else{
            $(this).css("border","1px solid #080");
            $(this).parent().find('.custom-alert').fadeOut(1000);
        }
    });

    $('.show').hover(function(){
        $(this).parent().find('.inputForShow').attr('type','text');
    },function(){
        $(this).parent().find('.inputForShow').attr('type','password');
    });
    

});

