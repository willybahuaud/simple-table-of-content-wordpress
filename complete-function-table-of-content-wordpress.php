/**
Génèse des ancres
*/
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

/**
Function automenu( $echo = false )
*/
function automenu(){
  global $post;
  $obj = '<nav id="sommaire-article">';
  $original_content = $post->post_content;

  $patt = "/<h([2-4])(.*?)>(.*?)<\/h([2-4])>/i";
  preg_match_all($patt, $original_content, $results);

  $lvl1 = 0;
  $lvl2 = 0;
  $lvl3 = 0;

  foreach ($results[3] as $k=> $r) {
    switch($results[1][$k]){
      case 2:
        $lvl1++;
        $niveau = '<span class="title_lvl">'.$lvl1.'/</span>';
        $lvl2 = 0;
        $lvl3 = 0;
        break;

      case 3:
        $lvl2++;
        $niveau = '<span class="title_lvl">'.base_convert(($lvl2+9),10,36).'.</span>';
        $lvl3 = 0;
        break;

      case 4:
        $lvl3++;
        $niveau = '<span class="title_lvl">'.$lvl3.')</span>';
        break;
    }

    $obj .= '<a href="#'.sanitize_title($r).'" class="title_lvl'.$results[1][$k].'">'.$niveau.$r.'</a>';
  }

  $obj .= '</nav>';
  if ( $echo )
    echo $obj;
  else
    return $obj;
}