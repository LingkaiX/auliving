<?php
    //Used in loop, single.php -> header section
    $videoInfo=get_field('video_info');
    if (is_array($videoInfo)&&array_key_exists('youtube_id',$videoInfo)):
        //?enablejsapi=1&origin=home_url: https://developers.google.com/youtube/iframe_api_reference#Getting_Started
?>
    <div class="header-play">
        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $videoInfo['youtube_id'];?>" 
            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
<?php
    endif;
?>
