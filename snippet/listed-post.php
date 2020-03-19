<?php
//MUST used in query loop
?>
<div class="listed-post<?php echo isEditorsChoice(get_the_category())?' listed-post-special':''; ?>">
    <?php
    echo '<a class="cover-img" target="_blank" href="'.get_permalink().'" style="background-image:url('."'".getThumbnailUrl( $post->ID, isEditorsChoice(get_the_category())?'medium_large':'thumbnail' )."'".');"></a>';
    echo '<div class="post-info">';
        echo the_title('<a target="_blank" href="'.get_permalink().'"><h4 class="title">','</h4></a>');
        echo '<h6 class="sub-title">'.strip_tags($post->post_excerpt),'</h6>';
        echo '<span class="date-info">'.timeElapsedString($post->post_date_gmt).'</span>';
    echo '</div>';
    ?>
</div>