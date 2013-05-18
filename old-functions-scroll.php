wp_register_script('scrollto',TEMPLATEPATH.'/js/scroolto.min.js',array('jquery'),'1.4.3.1',true);
wp_enqueue_script('scrollto');

//jQuery no-conflict
jQuery(document).ready(function($){
  //On ajoute un écouteur sur tous les éléments du menu
  $('#sommaire-article a').on('click',function(){
    var h = $(this).attr('href');
    $.scrollTo(h,500); // Se rend à l'ancre du lien en 500ms
  });
});