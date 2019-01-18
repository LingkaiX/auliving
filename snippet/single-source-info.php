<div class="source-info">
<?php
//Used in loop, single.php -> footer section
$sourceInfo=get_field('source_info');
if($sourceInfo){
    if($sourceInfo['is_original']==1){ ?>
        <p>本文由 <a href="<?php echo getBaseUrl(); ?>">澳洲生活网</a> 原创、编译或首发，并保留版权。转载必须保持文本完整，声明文章出自
            <a href="<?php echo getBaseUrl(); ?>">澳洲生活网</a>
            并包含原文标题及链接：《<a href="<?php echo get_the_permalink(); ?>"><?php echo $post->post_title; ?></a>》
        </p>
    <?php }else{
        if(is_array($sourceInfo['article_sources'])&&sizeof($sourceInfo['article_sources'])){
            echo '<p>文章来源：';
            foreach($sourceInfo['article_sources'] as $s){
                echo '<a class="article-source" href="'.$s['url'].'">'.$s['title'].'</a>';
            }
            echo '</p>';
        }
        if(is_array($sourceInfo['img_sources'])&&sizeof($sourceInfo['img_sources'])){
            echo '<p>图片来源：';
            foreach($sourceInfo['img_sources'] as $s){
                echo '<a class="img-source" href="'.$s['url'].'">'.$s['title'].'</a>';
            }
            echo '</p>';
    }
}
?>
</div>