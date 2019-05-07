<?php
    $specialColumn = get_category_by_slug( 'special-column' )->term_id;
    $cateInfo = get_queried_object();
    $cateParent = $cateInfo->parent;
    $fields=get_fields('category_'.$cateInfo->term_id);
    if($cateParent==$specialColumn):
?>
 <section class="cate-info">
    <div class="cover-img" style="background-image:url('<?php echo $fields['cover_img']['sizes']['thumbnail']?>');"></div>
    <h4 class="title"><?php echo $cateInfo->name; ?></h4>
    
    <div class="desc">
        <?php echo category_description($cateInfo->term_id); ?>
        <?php if($fields['contact']): ?>
            <div class="contact-info"><?php echo $fields['contact']; ?></div>
        <?php endif; ?>
    </div>
 </section>
<?php endif?>