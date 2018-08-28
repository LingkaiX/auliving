<?php 
    $hotPostQuery = new WP_Query(
        array( 'meta_key' => 'views',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => 12,
        'date_query' => array(
            array(
                'column' => 'post_modified_gmt',
                'after'  => '1 month ago',
            ),
        ),
    ));
?>