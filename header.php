<!DOCTYPE html>
<html lang=<?php echo isTCN()? 'cmn-hant':'cmn-hans'; ?>>
<head>
<?php include "snippet/google-tags.php"; ?>
<!-- <link rel="manifest" href="<?php echo get_template_directory_uri();?>/manifest.json"> -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="theme-color" content=#003366" />
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#003366">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">
<?php wp_head(); ?>
<?php include "snippet/google-ads.php"; ?>
</head>
<body <?php body_class(); ?>>
<div class="body-header">
    <div class="container">
        <div id="menu-button-open" class="menu-button">
            <i class="fas fa-bars" style="padding: 15px;cursor: pointer;"></i>
        </div>
        <div class="header-logo">
            <a style="" href="<?php echo get_site_url(); ?>">
                <img src="<?php echo get_template_directory_uri();?>/img/logo.svg" alt="logo" style="height:32px; margin-top:8px;">
            </a>
        </div>
        <div id="menu-and-search" class="menu-and-search">
            <div class="container submenu-header">
                <div id="menu-button-close" class="menu-button">
                    <i class="fas fa-times" style="padding: 15px;cursor: pointer;"></i>
                </div>
                <div class="header-logo">
                    <a style="" href="<?php echo get_site_url(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/img/logo.svg" alt="logo" style="height:32px; margin-top:8px;">
                    </a>
                </div>
               <div class="cn-switch"><!--WPCC_NC_START--><a href="<?php echo switchCN();?>">
                    <span><?php echo isTCN()?'简体':'繁體';?></span>
                </a><!--WPCC_NC_END--></div>
            </div>
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'header-menu',
                    'container_class'=> 'header-menu-container',
                    'depth'          => 1
                    ) );
            ?>
            <div class="search-container" id="search-container">
                <form role="search" method="get" id="search-form" class="search-form" action=<?php echo getBaseUrl();?>>
                    <i class="fas fa-search" style="padding: 15px;"></i>   
                    <div class="input-group">
                        <input type="text" id="search-item" name="s" placeholder="搜索文章" autocomplete="off">
                    </div>
                </form>
                <div class="search-button-close" id="search-button-close">
                    <i class="fas fa-times" style="padding: 15px;font-size:18px;cursor: pointer;"></i>
                </div>           
            </div>
            <div class="search-button-open" id="search-button-open">
                <i class="fas fa-search" style="padding: 15px;font-size:18px;cursor: pointer;"></i>        
            </div>
        </div>
        <div class="cn-switch"><!--WPCC_NC_START--><a href="<?php echo switchCN();?>">
            <span><?php echo isTCN()?'简体':'繁體';?></span>
        </a><!--WPCC_NC_END--></div>
    </div>
    <script>
        jQuery(document).ready(function($){
            $('#menu-button-open').click(function(){
                $('#menu-and-search').addClass('menu-and-search-open');
                $('main').addClass('hide-main-content');
            });
            $('#menu-button-close').click(function(){
                $('#menu-and-search').removeClass('menu-and-search-open');
                $('main').removeClass('hide-main-content');
            });
            $('#search-button-open').click(function(){
                $('#search-container').addClass('search-container-open');
            });
            $('#search-button-close').click(function(){
                $('#search-container').removeClass('search-container-open');
            });
        });
        var IsTCN=<?php echo isTCN()?'true':'false'; ?>;
    </script>
</div>
<div class="for-header"></div>
