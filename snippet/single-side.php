<?php
/* Need data: 
    $tags;
    $categories;
    $postId;
    $author
*/
?>
<section class="relatedPost">
    <?php
        $args = array(
            'post__not_in' => array($postId),
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order'   => 'DESC',
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $categories,
                    'include_children' => true 
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'slug',
                    'terms' => $tags,
                )
            )
        );
        $relatedPost = new WP_Query( $args);
        if($relatedPost->post_count<6){
            $count=6-$relatedPost->post_count;
            $query2 = new WP_Query( array('posts_per_page' => $count, 'author' => $author, 'post__not_in' => array_merge(wp_list_pluck($relatedPost->posts, 'ID' ), array($postId))));
            $relatedPost->posts = array_merge($relatedPost->posts, $query2->posts );
            $relatedPost->post_count = $relatedPost->post_count + $query2->post_count;
        }
    ?>
    <div class="text"><span><strong>
        相关推荐
    </strong><span></div>
    <div style=" margin: 5px 0; width 100%; border: 1px solid #cc0033;"></div>
    <?php while ($relatedPost->have_posts()) : $relatedPost->the_post();?>
        <div class="rPostBox">
            <a href="<?php echo get_permalink() ?>">
                <?php if(get_the_post_thumbnail()):?>
                    <div class="rPostImg">
                        <?php echo get_the_post_thumbnail();?>
                    </div>
                <?php endif;?>
                <div>
                    <?php the_title('<p>', '</p>');?>
                    <?php foreach(get_the_category() as $cate){
                        echo '<a style="color:#888; font-size: 14px; margin-right: 10px;" href="'.get_category_link($cate->term_id).'">'.$cate->name.'</a>';
                    }?>
                </div>
            </a>
        </div>
    <?php endwhile; ?>
</section>