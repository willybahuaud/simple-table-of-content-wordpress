function automenu( $echo = false ){
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