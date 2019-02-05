<?php
/*
Need data: 
    Array<Category_ID>: $stickyColumns
*/
//print_r($stickyColumns);
if(countSafely($stickyColumns)>=3){
    //echo count($stickyColumns);
?>
<style>
    section.sticky-columns .column .post-list h5{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        max-height: 17px;
    }
    section.sticky-columns .column.read-more{
        border: 1px;
        border-radius: 3px;
        padding: 2px 4px;
        margin-bottom: 50px;
    }
    .zhuanlan{
    width: 100%;
    padding-top:5px;
    }
    .zhuanlan h4{
      margin:0 0 5px;
      height: 2rem;
    }
    .zhuanlan h4 span{
      padding: 0 6px ;
      color:white;
      background-color: #003366;
    }
  }
</style>
<section class="sticky-columns">
<div class="container">
    <div class="zhuanlan"><h4><span>专栏</span></h4><div>
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
                <p class="title"><a class="read-more" href="<?php echo get_category_link($columnId); ?>">阅读更多</a></p>
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
        setInterval(function(){ 
            owlStickyColumns.trigger('next.owl.carousel');
        }, 5000);
    });
</script>
<?php } ?>