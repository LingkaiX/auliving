<?php
//MUST used in query loop
?>
<div class="listed-post">
    <?php
    echo '<a href="'.get_permalink().'">';
        echo get_the_post_thumbnail( $post->ID, 'thumbnail',  array( 'class' => 'cover-img' ) );
    echo '</a>';
    echo '<div class="post-info">';
        echo the_title('<h4>','</h4>');
        echo '<h6  class="sub-title">'.strip_tags($post->post_excerpt),'</h6>';
        echo '<span>'.timeElapsedString($post->post_date_gmt).'</span>';
    echo '</div>';
    ?>
</div>