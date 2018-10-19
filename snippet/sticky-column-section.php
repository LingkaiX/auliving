<?php
/*
Need data: 
    Array<Category_ID>: $stickyColumns
*/
//print_r($stickyColumns);
if(count($stickyColumns)>=3){
    //echo count($stickyColumns);
?>
<section class="sticky-columns">
<div class="container">
    <div id="sticky-columns" class="owl-carousel owl-theme">
        <?php
            foreach($stickyColumns as $columnId){
                $fields=get_fields('category_'.$columnId );
                if(!isset($fields['cover_img']['sizes']['thumbnail'])) continue;
                $scQuery=new WP_Query( array( 'cat' => $columnId, 'posts_per_page' => 3, 'ignore_sticky_posts' => 1));
                if(count($scQuery->posts)!=3) continue;
        ?>
            <div class="column">
                <div class="cover-img" style="background-image:url('<?php echo $fields['cover_img']['sizes']['thumbnail']?>');"></div>
                <h4 class="title"><a href="<?php echo get_category_link($columnId); ?>"><?php echo get_cat_name($columnId); ?></a></h4>
                <div class="desc"><?php echo category_description($columnId); ?></div>
                <div class="post-list">
                    <?php
                        while($scQuery->have_posts()):$scQuery->the_post();
                            the_title('<h5><a href="'.get_the_permalink().'">', '</a></h5>');
                        endwhile;
                        wp_reset_postdata();
                    ?>
                </div>  
            </div>
        <?php } ?>
    </div>
</div>
</section>
<script>
    var owlStickyColumns
    jQuery(document).ready(function($){
        owlStickyColumns=jQuery('#sticky-columns');
        owlStickyColumns.owlCarousel({
            loop:true,
            margin:40,
            center:false,
            dots:true,
            responsive:{
                0:{
                    items:1
                },
                480:{
                    items:2
                },
                992:{
                    items:3
                }
            }
        })
        // setInterval(function(){ 
        //     owlStickyColumns.trigger('next.owl.carousel');
        // }, 5000);
    });
</script>
<?php } ?>