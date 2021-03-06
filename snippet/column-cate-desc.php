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
        <?php if($fields['contact']): $contact= $fields['contact']; ?>
            <div  class="contact-info">
                <?php if(is_array($contact['phone'])&&sizeof($contact['phone'])){
                    echo'<p>电话:';
                    foreach ($contact['phone'] as $phone) {
                        echo '<a href="tel:'.$phone['phone_no'].'">'.$phone['phone_no'].'</a>, ';
                    }
                    echo'</p>';
                }
                 if(is_array($contact['emails'])&&sizeof($contact['emails'])){
                    echo'<p>邮箱:';
                    foreach ($contact['emails'] as $email) {
                        echo '<a href="mailto:'.$email['email'].'">'.$email['email'].'</a>, ';
                    }
                    echo'</p>';
                }
                 if($contact['web']){
                        echo '<p style="white-space: nowrap; overflow:hidden; text-overflow:ellipsis;">网站: <a href="'.$contact['web'].'">'.$contact['web'].'</a> </p>';
                }
                 if(is_array($contact['addresses'])&&sizeof($contact['addresses'])){
                    $i=1;
                    echo'<p>地址: ';
                    foreach ($contact['addresses'] as $address) {
                        if($i>1)echo '地址'.$i.': ';
                        echo $address['address'].', ';
                        $i++;
                        echo'<br>';
                    }
                    echo'</p>';
                }?>
            </div>
        <?php endif; ?>
    </div>
 </section>
<?php endif?>