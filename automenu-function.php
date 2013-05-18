function automenu( $echo = false ){
  global $post;
  $obj = '<nav id="sommaire-article">';
  $original_content = $post->post_content;

  //on récupère les titres
  $patt = "/<h([2-4])(.*?)>(.*?)<\/h([2-4])>/i";
  preg_match_all($patt, $original_content, $results);
        
  //on génère les liens
  foreach ($results[3] as $k=> $r) {
    $obj .= '<a class="title_lvl'.$results[1][$k].' " href="#'.sanitize_title($r).'">'.$r.'</a>';
  }

  $obj .= '</nav>';
  if ( $echo )
    echo $obj;
  else
    return $obj;
}