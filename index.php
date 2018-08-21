<?php get_header(); ?>
    <main class="container" style="display:none;">
        <div class="left">
            <div class="b1" style="margin-bottom:10px;">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展</div>
            <div class="b1" style="margin-bottom:10px;">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展1</div>
            <div class="b1" style="height:120px;">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展</div>
        </div>
        <div class="center">
            <img src="https://xenforo.com/community/media/kingfish.2125/full" alt="" width="640" height="360" class="pic">
        </div>
        <div class="right">
            <div class="b2" style="margin-bottom:10px;">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展</div>
            <div class="b2">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展</div>
        </div>
    </main>

    <?php 

$count=0;
    while (have_posts()) : the_post();
    $count++;
    if($count==25){
        $query_top = new WP_Query( array( 'category_name' => 'top','posts_per_page' => 8 )  );

        while ( $query_top->have_posts() ) {
            $query_top->the_post();
            echo '<li>' . get_the_title() . '</li>';
        }
        wp_reset_postdata();
    }
            the_title('<p>', '</p>');
            endwhile;
    ?>
<?php get_footer(); ?>

