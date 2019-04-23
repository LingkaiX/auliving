<?php get_header(); ?>
<?php
/*
Need data: 
    Array<Category_ID>: $stickyColumns
*/
//print_r($stickyColumns);
    $stickyColumns = get_field( 'sticky_columns', 'category_'.get_category_by_slug( 'top' )->term_id );
    $stickyColumnsCate = get_field( 'sticky_columns', 'category_'.get_category_by_slug( 'classification' )->term_id );
    //print_r($stickyColumnsCate);
?>
<main>
<?php include 'snippet/side-ads.php';?>
    <section class="special-column">
        <div class="container">
            <div class="classi">
            <span id="justASpan">专栏分类</span>
                <?php foreach($stickyColumnsCate as $cateId){?> 
                    <a  onclick="classi_display(<?php echo $cateId; ?>)"><?php echo get_cat_name($cateId); ?></a>
                <?php } ?>
            </div>
            <div class="sticky-columns">
                <?php
                    foreach($stickyColumns as $columnId){
                        $fields=get_fields('category_'.$columnId );
                        if(!isset($fields['cover_img']['sizes']['thumbnail'])) continue;
                        //if(!isset($fields['thumbnail_img']['sizes']['thumbnail'])) continue;
                        //$scQuery=new WP_Query( array( 'cat' => $columnId, 'posts_per_page' => 3, 'ignore_sticky_posts' => 1));
                        //if(count($scQuery->posts)!=3) continue;
                ?>
                    <div  class="column <?php echo $fields['sticky_columns_cate']; ?>"><a href="<?php echo get_category_link($columnId); ?>">
                        <?php if(isset($fields['thumbnail_img']['sizes']['thumbnail'])){?>
                            <div class="thumbnail_img" style="background-image:url('<?php echo $fields['thumbnail_img']['sizes']['thumbnail']?>');"></div>
                        <?php }else ?>
                            <div class="thumbnail_img" style="background-image:url('<?php echo $fields['cover_img']['sizes']['thumbnail']?>');"></div>
                        <?php } ?>
                        <div class="cover-img" style="background-image:url('<?php echo $fields['cover_img']['sizes']['thumbnail']?>');"></div>
                        <h4 class="title"><a href="<?php echo get_category_link($columnId); ?>"><?php echo get_cat_name($columnId); ?></a></h4>
                        
                        <div class="desc"><?php echo category_description($columnId); ?></div>
                         
                    </a></div>
                <?php } ?>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        function classi_display(id){
            $('.column').slideUp(1);
            $('.'+id).slideDown();
        }
        $(document).ready(function(){
            $("#justASpan").click(function(){
                $('.column').slideDown();
            });
        });
    </script>
</main>

<?php get_footer(); ?>