<section class="top-post-list">
<h5 class="hot"><strong>本月关注 </strong></h5>
<?php 
    $mostViewQuery = new WP_Query(
        array( 'meta_key' => 'views',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => 10,
        //'nopaging' => true,
        'ignore_sticky_posts' => 1,
        'date_query' => array(
            array(
                'column' => 'post_modified_gmt',
                'before'  => '2 week ago',
                'after'  => '1 month ago',
            ),
        ),
    ));
    //print_r($mostViewQuery);
    while($mostViewQuery->have_posts()):$mostViewQuery->the_post();
        the_title('<h5><a href="'.get_the_permalink().'">', '</a></h5>');
        //echo get_post_meta(get_the_ID(), 'views', true );
?>
<?php endwhile; wp_reset_postdata();?>
<?php
    wp_nav_menu( array(
        'theme_location' => 'top-menu',
        'menu_class'     => 'top-menu',
        'container_class'=> 'top-menu-container',
        'depth'          => 1
        ) );
?>
</section>