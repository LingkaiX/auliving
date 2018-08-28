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

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
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

add_action( 'after_setup_theme', 'aulv_setup' );
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
    update_option( 'medium_size_h', 9999 );

    update_option( 'large_size_w', 640 );
    update_option( 'large_size_h', 9999 );

    // update_option( 'medium_large_size_w', 160 );
    // update_option( 'medium_large_size_h', 160 );
    // update_option( 'image_default_size', 1 );
}

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
function getBaseUrl(){
	$url=get_site_url();
	if (isTCN()){
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
//output:4 months ago
//full output: 4 months, 2 weeks, 3 days, 1 hour, 49 minutes, 15 seconds ago
function timeElapsedString($datetime, $full = false) {
    $now = new DateTime('now', new DateTimeZone('UTC') );
	$ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

	$longerThanOneMonth = false;
    $string = array(
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
			if($k=='m'||$k=='y'){
				$longerThanOneMonth = true;
			}
		    //$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			$v = $diff->$k . $v;
        } else {
            unset($string[$k]);
        }
    }

	if (!$full) $string = array_slice($string, 0, 1);
	if($longerThanOneMonth){
		return false;
	}
    return $string ? implode(', ', $string) . '前' : '刚刚';
}