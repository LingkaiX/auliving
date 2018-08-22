<?php get_header(); ?>
<main>    

<?php 
    //echo get_query_var( 'category_name' );
    //echo "cat:" . get_query_var( 'cat' );

    $stickyPosts = get_field( 'sticky_posts', 'category_'.get_category_by_slug( 'top' )->term_id );
    $headSectionQuery = new WP_Query( array( 'category_name' => 'top','posts_per_page' => 8 )  );
    if($stickyPosts){print_r($stickyPosts[0]['sticky_post']->ID);}
    print_r($headSectionQuery->posts);
    $count=0;
    while (have_posts()) : the_post();
    $count++;
    if($count==25){
        $query_top = new WP_Query( array( 'category_name' => 'c7','posts_per_page' => 8 )  );

        while ( $query_top->have_posts() ) {
            $query_top->the_post();
            echo '<li>' . get_the_title() . '</li>';
        }
        wp_reset_postdata();
    }
            the_title('<p>', '</p>');
            endwhile;
    ?>
</main>
<?php get_footer(); ?>

