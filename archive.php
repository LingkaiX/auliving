<?php get_header(); ?>

<?php 
// echo get_query_var( 'category_name' );
// echo "cat:" . get_query_var( 'cat' );
// echo isTCN()?'ture':'false';
//print_r(parse_url(home_url()));
echo $_SERVER['REQUEST_URI'];
while (have_posts()) : the_post();

        the_title('<p>', '</p>');
endwhile;