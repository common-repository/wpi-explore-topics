<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
     //Request identified as ajax request
require( $_SERVER['DOCUMENT_ROOT']. '/wp-load.php' );
$key=esc_attr($_POST['queryString']);
$tags = get_tags($args);

foreach($tags as $tag){
    $all_tags[$tag->term_id]=$tag->name;
}
$tags=preg_grep("#".$key."#i", $all_tags);

$tags_arr_keys=array_keys($tags);

$res  = array();
foreach ( $tags_arr_keys as $tag_key ) {
    $tag_link = get_tag_link( $tag_key );
    $tag_name=$tags[$tag_key];
    $currentletter = substr($tag_name,0,1);
    $res[$currentletter][]  = "<a href='{$tag_link}' title='{$tag_name} Tag' class='tag_{$tag_key}'>{$tag_name}</a>";
    
}


echo '<div class="holdleft">'; 
$k=0;
foreach($res as $key=>$val){
    if($k==7 or $k==14)
        echo '</div><div class="holdleft">';
     echo '<div class="tagindex">';
     echo "<h4>".$key."</h4>";
     echo "<ul class=\"links\">";
     foreach($val as $reqvals){
        echo "<li>".$reqvals."</li>";
     }
     echo "</ul></div>";
     $k++;
    }
echo '</div>';

}
?>
