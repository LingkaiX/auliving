<div class="source-info">
<?php
//Used in loop, single.php -> footer section
$sourceInfo=get_field('source_info');
$article_sources=$sourceInfo['article_sources'];
if($sourceInfo){
    if($sourceInfo['is_original']==1){ ?>
        <p>本文由 <a href="<?php echo getBaseUrl(); ?>">澳洲生活网</a> 原创、编译或首发，并保留版权。转载必须保持文本完整，声明文章出自
            <a href="<?php echo getBaseUrl(); ?>">澳洲生活网</a>
            并包含原文标题及链接：《<a href="<?php echo get_the_permalink(); ?>"><?php echo $post->post_title; ?></a>》
        </p>
        <?php if(is_array($sourceInfo['article_sources'])&&sizeof($sourceInfo['article_sources'])){
            echo '<p>文章来源：';
            if($article_sources['title']!=null){
                echo '<a class="article-source" href="'.$article_sources['url'].'">'.$article_sources['title'].'</a>';
            }
            else{
                echo '<a class="article-source" href="'.$article_sources['url'].'">'.$article_sources['url'].'</a>';
            }
            echo '</p>';
        }?>
    <?php }if($sourceInfo['reproduced_article']==1){?>
        <p>本文由 <a href="<?php echo getBaseUrl(); ?>">澳洲生活网</a> 转载发布，仅代表原作者或原平台观点，不代表本网站立场。
            <a href="<?php echo getBaseUrl(); ?>">澳洲生活网</a>
            仅提供信息发布平台，文章或有适当删改。
        </p>
        <p>文章来源：
        <?php
            $ras=$sourceInfo['reproduced_article_sources'];
            if($ras['title']!=null){
                echo '<a class="article-source" href="'.$ras['url'].'">'.$ras['title'].'</a>';
            }
            else{
                echo '<a class="article-source" href="'.$ras['url'].'">'.$ras['url'].'</a>';
            }
        ?></p>
    <?php }if($sourceInfo['contribution_article']==1){?>
        <p>本文由<?php echo $sourceInfo['contributor']; ?>提供，仅代表原作者观点，不代表本网站立场。
            <a href="<?php echo getBaseUrl(); ?>">澳洲生活网</a>
            仅提供信息发布平台，文章或有适当删改。
        </p>
    <?php }if($sourceInfo['has_img_sources']==1){
        if(is_array($sourceInfo['img_sources'])&&sizeof($sourceInfo['img_sources'])){
            echo '<p>图片来源：';
            foreach($sourceInfo['img_sources'] as $s){
                echo '<a class="img-source" href="'.$s['url'].'">'.$s['title'].'</a>';
            }
            echo '</p>';
        }
    }
}
?>
</div>