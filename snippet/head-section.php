<?php
/* 
Need data: 
    WP_Query: $headSectionQuery；
    Array<WP_Post>: $stickyPosts;
Output data:
    Array<Post_ID>: $headSectionPostIds;
    JS: Array<Post_ID>: headSectionPostIds;
*/
if(count($headSectionQuery->posts)>=8):?>    
<section class="container head-section"  style="display:none;">
<?php
    $stickyCount=count($stickyPosts);
    $selectedPosts=$headSectionQuery->posts;
    $stickyIDs=array();
    //remove repeat posts in $headSectionQuery and $stickyPosts
    if($stickyCount>0){
        for($i=0; $i<$stickyCount; $i++){
            array_splice($selectedPosts, 3, 0, array($stickyPosts[$i]['sticky_post']) ); 
        }
        for($i=0; $i<count($selectedPosts); $i++){
            for($j=$i+1; $j<count($selectedPosts); $j++){
                if($selectedPosts[$i]->ID==$selectedPosts[$j]->ID)
                    array_splice($selectedPosts, $j, 1 ); 
            }
        }
        for($i=0; $i<$stickyCount; $i++){
            $stickyIDs[$i]=$stickyPosts[$i]['sticky_post']->ID;
        }
    }
    $headSectionPostIds=array();
    for($i=0; $i<count($selectedPosts); $i++){
        array_push($headSectionPostIds, $selectedPosts[$i]->ID);
    }
?>
<script>
    <?php echo "var headSectionPostIds = ". json_encode($headSectionPostIds) . ";\n"; ?>
    //console.log(headSectionPostIds.toString());
</script>
<?php
    function echoBlock($post, $isStickyPost=false){
        echo get_the_post_thumbnail( $post->ID, 'thumbnail', ['class' => 'cover-img', 'title' => 'cover'] );
        echo '<div class="info-container">';
            echo '<h6>'.$post->post_title.'</h6>';
            echo '<span>'.timeElapsedString($post->post_date_gmt).'</span>';
        echo '</div>';
    }
    $loopCount=0;
?>
    <div class="center">
    <?php for($loopCount; $loopCount<3; $loopCount++){ ?>
        <div class="center-block <?php echo $loopCount==0?'center-block-top':''; ?>">
            <?php echoBlock($selectedPosts[$loopCount]); ?>
        </div>
    <?php } ?>
    </div>
    <div class="left">
    <?php for($loopCount; $loopCount<6; $loopCount++){ ?>
        <div class="left-block">
            <?php echoBlock($selectedPosts[$loopCount]); ?>
        </div>
    <?php } ?>
    </div>
    <div class="right">
    <?php for($loopCount; $loopCount<8; $loopCount++){ ?>
        <div class="right-block">
            <?php echoBlock($selectedPosts[$loopCount]); ?>
        </div>
    <?php } ?>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>