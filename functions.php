<?php
//search result: post
function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}	
	return $query;
}
add_filter('pre_get_posts','SearchFilter');
//Enqueue scripts and styles.
function add_styles_and_scripts() {
	wp_enqueue_style( 'default-style', get_stylesheet_uri(), array(), '0.0.1', 'all');	
	wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/theme.css', array(), '0.0.1', 'all' );

	wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/theme.js', array('jquery'), '0.0.1', true );

	if (is_singular()) wp_enqueue_script( 'comment-reply' );

    //Add Respond.js for IE
	if( !function_exists('ie_scripts')) {
		function ie_scripts() {
			echo '<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->';
			echo ' <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->';
			echo ' <!--[if lt IE 9]>';
			echo ' <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
			echo ' <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
			echo ' <![endif]-->';
		}
		add_action('wp_head', 'ie_scripts');
	}
}
add_action( 'wp_enqueue_scripts', 'add_styles_and_scripts' );

//remove version mark
remove_action('wp_head', 'wp_generator');

//Disable RSS feed
function aulv_disable_feed() {
    wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}
add_action('do_feed', 'aulv_disable_feed', 1);
add_action('do_feed_rdf', 'aulv_disable_feed', 1);
add_action('do_feed_rss', 'aulv_disable_feed', 1);
add_action('do_feed_rss2', 'aulv_disable_feed', 1);
add_action('do_feed_atom', 'aulv_disable_feed', 1);
add_action('do_feed_rss2_comments', 'aulv_disable_feed', 1);
add_action('do_feed_atom_comments', 'aulv_disable_feed', 1);
//Remove the header links to RSS feeds
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

function aulv_setup() {

    add_theme_support( 'post-thumbnails' ); 
    add_theme_support( 'title-tag' );
    add_theme_support( 'menus' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	register_nav_menus( array(
		'primary'	=> 'Header Navigation',
		'top-menu'	=> 'Top News List',

    ) );
    
    //Set image sizes (4:3, 16:9, 2:1)
    update_option( 'thumbnail_size_w', 320 );
    update_option( 'thumbnail_size_h', 180 );
    update_option( 'thumbnail_crop', 1 );

    update_option( 'medium_size_w', 480 );
    update_option( 'medium_size_h', 0 );

    update_option( 'large_size_w', 820 );
    update_option( 'large_size_h', 0 );

    update_option( 'medium_large_size_w', 640 );
    update_option( 'medium_large_size_h', 0 );
    update_option( 'image_default_size', 'medium_large' );
}
add_action( 'after_setup_theme', 'aulv_setup' );
function fresh_custom_sizes( $sizes ) {
   return array_merge( $sizes, array(
      'medium_large' => __( 'Medium Large' ),
   ) );
}
add_filter( 'image_size_names_choose', 'fresh_custom_sizes' );

//拆分url,返回下一（plus+1）个/后的值
//ex: parsePath($_SERVER['REQUEST_URI'],'category');
function parsePath($path, $name, $plus=0){
	$value='';
	if(strpos($path, "?")) $path = substr($path, 0, strpos($path, "?"));
	$array=explode('/', trim($path, "/"));
	if($plus<-1) return $value;
	if($plus==-1) return $array[0];
	if(!in_array($name, $array)) return $value;
	for($x=0; $x<(count($array)-1); $x++){
		if($array[$x]==$name&&((count($array))>($x+1+$plus))){
			return $array[$x+1+$plus];
		}
	}
	return $value;
}
//判断是否是繁体地址
function isTCN(){
	if (isset($_GET['variant'])) {
		if ($_GET["variant"]=='zh-tw') return true;
	}
	if (parsePath($_SERVER['REQUEST_URI'],'',-1)=='zh-tw') return true;
	return false;
}
function getBaseUrl($hasSlashEnd=false){
	$url=get_site_url();
	if (isTCN()){
		if($hasSlashEnd) return $url.'/zh-tw'.'/';
		return $url.'/zh-tw';
	}else{
		return $url;
	}
}
function switchCN(){
	if (isTCN()){
		return home_url().substr($_SERVER['REQUEST_URI'],6);
	}else{
		return home_url().'/zh-tw'.$_SERVER['REQUEST_URI'];
	}
}
//$datetime: PLEASE input GMT/UTC +0 TIME
function timeElapsedString($datetime, $isTraditionalChinese=false, $full = false) {
    $now = new DateTime('now', new DateTimeZone('GMT') );
	$ago = new DateTime($datetime);
    $diff = $now->diff($ago);
	// print_r($diff);

	//when more than 1 month ago, output: x年x月x日
	if(($diff->y+$diff->m)>0){
		$ago->setTimezone(new DateTimeZone('Australia/Melbourne'));
		return $ago->format('Y年m月d日');
	}
	//when less than 1 minute ago
	if(($diff->d+$diff->h+$diff->i)==0){
		return $isTraditionalChinese?'剛剛':'刚刚';
	}

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = $isTraditionalChinese?array(
        'y' => '年',
        'm' => '個月',
        'w' => '週',
        'd' => '天',
        'h' => '小時',
        'i' => '分鐘',
        's' => '秒',
    ):array(
        'y' => '年',
        'm' => '个月',
        'w' => '周',
        'd' => '天',
        'h' => '小时',
        'i' => '分钟',
        's' => '秒',
	);
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
		    //$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			$v = $diff->$k . $v;
        } else {
            unset($string[$k]);
        }
	}
	//output:4 months ago
	if (!$full) $string = array_slice($string, 0, 1);
	//full output: 4 months, 2 weeks, 3 days, 1 hour, 49 minutes, 15 seconds ago
    return $string ? implode(', ', $string) . '前' : '刚刚';
}

//Add fields to posts and conmments rest api response
add_action( 'rest_api_init', function () {
    register_rest_field( 'post', 'date_info', array(
        'get_callback' => function( $obj ) {
            return (string)timeElapsedString($obj['date_gmt'], $full = false);
        }
	) );
	register_rest_field( 'post', 'cover_img', array(
        'get_callback' => function( $obj ) {
			if ($obj['featured_media']!=0){
				return  wp_get_attachment_image_src($obj['featured_media'],'thumbnail',false)[0];
			}
            return 0;
        }
    ) );
	register_rest_field( 'post', 'categories', array(
        'get_callback' => function( $obj ) {
			$args = array('fields' => 'all');
            return wp_get_post_categories($obj['id'], $args);
        }
	) );
	register_rest_field( 'post', 'tags', array(
        'get_callback' => function( $obj ) {
            return wp_get_post_tags($obj['id']);
        }
	) );
	register_rest_field( 'comment', 'children', array(
        'get_callback' => function( $obj ) {
            return array();
        }
	) );
	register_rest_field( 'comment', 'date_info', array(
        'get_callback' => function( $obj ) {
            return array();
        }
	) );
	register_rest_field( 'comment', 'meta', array(
        'update_callback' => function( $meta, $obj ) {
			//print_r($obj);
			if(is_array($meta)&&array_key_exists('refer_info_name',$meta)&&array_key_exists('refer_info_id',$meta))
				update_comment_meta( $obj->comment_ID, 'refer_info', array('author_name'=>$meta['refer_info_name'],'comment_id'=>$meta['refer_info_id']));
            return true;
        }
	) );
} );
function convertRestPostToTCN( $response, $post, $request ) {
	$response->data['excerpt']['rendered']=strip_tags($response->data['excerpt']['rendered']);
	unset($response->data['content']);
	if($request->get_param('variant')=="zh-tw"){
		wpcc_load_conversion_table();
		$response->data['title']['rendered']=zhconversion_tw($response->data['title']['rendered']);
		//$response->data['content']['rendered']=zhconversion_tw($response->data['content']['rendered']);
		$response->data['excerpt']['rendered']=zhconversion_tw($response->data['excerpt']['rendered']);
		$response->data['link']=str_replace(home_url(),home_url().'/zh-tw',$response->data['link']);
		if($response->data['categories']){
			foreach ($response->data['categories'] as $value){
				$value->name=zhconversion_tw($value->name);
			}
		}
		if($response->data['tags']){
			foreach ($response->data['tags'] as $value){
				$value->name=zhconversion_tw($value->name);
			}
		}
	}
	
		return $response;
  }
add_filter( 'rest_prepare_post', 'convertRestPostToTCN', 10, 3 );
function nestedComment($response, $post, $request){
	//print_r($request);
	if(is_array($request->get_param('parent'))&&array_key_exists(0,$request->get_param('parent'))&&$request->get_param('parent')[0]==0){
		$childComments = get_comments(array(
			'post_id'   => $response->data['post'],
			'status'    => 'approve',
			'order'     => 'ASC',
			'parent'    => $response->data['id'],
		));
		foreach($childComments as $comment){
			$comment->meta= array(
				'thumb_ups'=>get_comment_meta($comment->comment_ID,'thumb_ups',true),
				'thumb_downs'=>get_comment_meta($comment->comment_ID,'thumb_downs',true),
				'refer_info'=>get_comment_meta($comment->comment_ID,'refer_info',true));
			$comment->date_info= timeElapsedString($comment->comment_date_gmt,($request->get_param('variant')=="zh-tw"));
		}
		$response->data['children']=$childComments;
		$response->data['date_info']=timeElapsedString($response->data['date_gmt'],($request->get_param('variant')=="zh-tw"));
		$response->data['meta']=array(
			'thumb_ups'=>get_comment_meta($response->data['id'],'thumb_ups',true),
			'thumb_downs'=>get_comment_meta($response->data['id'],'thumb_downs',true),
			'refer_info'=>get_comment_meta($response->data['id'],'refer_info',true));
	}
	return $response;
}
add_filter( 'rest_prepare_comment', 'nestedComment', 10, 3 );
function allowAnonymousComments() {
    return true;
}
add_filter('rest_allow_anonymous_comments','allowAnonymousComments');

 //api: thumb up or thumb down a comment
function thumbupComment( $request ) {
	$id=(int)$request['id'];
	if(wp_get_comment_status($id) == "approved" ){
		$thumbups=get_comment_meta( $id, 'thumbups', true );
		if(empty($thumbups)){
			$thumbups=1;
		}else{
			$thumbups=(int)$thumbups + 1;
		}
	}else{
		return new WP_Error( 'valid request', 'no such comment', array( 'status' => 400 ));
	}
	if(update_comment_meta($id, 'thumbups', $thumbups)==false)
		return new WP_Error( 'server error', 'Woa! I even dont know what just happened :(', array( 'status' => 500 ));
	return  $thumbups;
}
add_action( 'rest_api_init', function () {
	register_rest_route( 'aulv/v1', '/comments/(?P<id>\d+)/thumbup', array(
		'methods' => 'GET',
		'callback' => 'thumbupComment',
	) );
} );
function thumbdownComment( $request ) {
	$id=(int)$request['id'];
	if(wp_get_comment_status($id) == "approved" ){
		$thumbdowns=get_comment_meta( $id, 'thumbdowns', true );
		if(empty($thumbdowns)){
			$thumbdowns=1;
		}else{
			$thumbdowns=(int)$thumbdowns + 1;
		}
	}else{
		return new WP_Error( 'valid request', 'no such comment', array( 'status' => 400 ));
	}
	if(update_comment_meta($id, 'thumbdowns', $thumbdowns)==false)
		return new WP_Error( 'server error', 'Woa! I even dont know what just happened :(', array( 'status' => 500 ));
	return  $thumbdowns;
}
add_action( 'rest_api_init', function () {
	register_rest_route( 'aulv/v1', '/comments/(?P<id>\d+)/thumbdown', array(
		'methods' => 'GET',
		'callback' => 'thumbdownComment',
	) );
} );