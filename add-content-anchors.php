function replace_ca($matches){
  return '<h'.$matches[1].$matches[2].' id="'.sanitize_title($matches[3]).'">'.$matches[3].'</h'.$matches[4].'>';
}

//Ajout d'un filtre sur le contenu  
add_filter('the_content', 'add_anchor_to_title', 12);
function add_anchor_to_title($content){   
  if(is_singular('post')){ // s'il s'agit d'un article
    global $post;
    $pattern = "/<h([2-4])(.*?)>(.*?)<\/h([2-4])>/i";
    
    $content = preg_replace_callback($pattern, 'replace_ca', $content);
    return $content;
  }else{
    return $content;
  }
}