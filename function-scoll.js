jQuery(document).ready(function($){
    $(document).on('click','#sommaire-article a',function(){
        var h = $(this).attr('href');

        $('body,html').animate({  
            scrollTop:$(h).offset().top  
        }, 500); 
        return false;
    });
});