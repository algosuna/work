<?php 
    $fb_id = options::get_value( 'social' , 'facebook' );
    if( strlen( trim( $fb_id ) ) ){
        $fb['likes'] = social::pbd_get_transient($name = 'facebook',$user_id=$fb_id,$cacheTime = 120); /*cache - in minutes*/
        $fb['link'] = 'http://facebook.com/people/@/'  . $fb_id ;
    }
?>  
<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 oldie" lang="en"> <![endif]-->
<?php
    function is_facebook(){
        if(!(stristr($_SERVER["HTTP_USER_AGENT"],'facebook') === FALSE)) {
            return true;
        }
    }
?>
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> <?php if(is_facebook()){ echo ' xmlns:fb="http://ogp.me/ns/fb#" ';} ?> ><!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="robots"  content="index, follow" />
    
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>" /> 
    <?php if( is_single() && options::get_value( 'general' , 'enable_seo' ) == 'yes' || is_page() && options::get_value( 'general' , 'enable_seo' ) == 'yes' ){ ?>
        <meta property="og:title" content="<?php the_title() ?>" />
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <meta property="og:url" content="<?php the_permalink() ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
        <?php 
            if(options::get_value( 'social' , 'facebook_app_id' ) != ''){
                ?><meta property='fb:app_id' content='<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>'><?php
            }
            
            global $post;
            $src  = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'thumbnail' );
            
            if(strlen($src[0])){
                echo '<meta property="og:image" content="'.$src[0].'"/>'; 
                echo ' <link rel="image_src" href="'.$src[0].'" />';               
            }else{
                echo '<meta property="og:image" content="'.get_template_directory_uri().'/fb_screenshot.png"/>'; 
            }
            
            wp_reset_query();   
        }else if( options::get_value( 'general' , 'enable_seo' ) == 'yes'){ ?>
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
            <meta property="og:url" content="<?php echo home_url() ?>/"/>
            <meta property="og:type" content="blog"/>
            <meta property="og:locale" content="en_US"/>
            <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
            <meta property="og:image" content="<?php echo get_template_directory_uri()?>/fb_screenshot.png"/> 
    <?php
        }
    ?>

    <title><?php bloginfo('name'); ?> &raquo; <?php bloginfo('description'); ?><?php if ( is_single() ) { ?><?php } ?><?php wp_title(); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

    <?php
        if( strlen( options::get_value( 'styling' , 'favicon' ) ) ){
            $path_parts = pathinfo( options::get_value( 'styling' , 'favicon' ) );
            if( $path_parts['extension'] == 'ico' ){
    ?>
                <link rel="shortcut icon" href="<?php echo options::get_value( 'styling' , 'favicon' ); ?>" />
    <?php
            }else{
    ?>
                <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php
            }
        }else{
    ?>
            <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php
        }
    ?>

    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
   
    <?php wp_head(); ?>    
</head>
<?php
    $vertical_body_class = '';
    if( is_page_template('template-galleries.php') ){
        $vertical_body_class = ' vertical-view-type ';
    }
    if( is_page_template('template-galleries-vertical-slider.php') ){
        $vertical_body_class .= ' vertical-gallery-slider ';
    }
    if( is_page_template('template-galleries-horizontal-scroll.php') || is_page_template('template-galleries-horizontal-scroll-blog.php') ){
        $vertical_body_class .= ' horizontal-scroll-view ';
    }
    if( is_page_template('template-gallery-single.php') ){
        $vertical_body_class .= ' single single-gallery ';
    }
    $vertical_body_class .= ' fade-in ';
    if( wp_is_mobile() ){
        $vertical_body_class .= ' is-mobile ';
    }
    $vertical_body_class .= ' fade-in ';
?>

<?php
$position   = '';
$repeat     = '';
$bgatt      = '';
$background_img = '';
$background_color = '';

if( is_single() || is_page() ){
    $settings = meta::get_meta( $post -> ID , 'settings' );
    if( ( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ) || ( isset( $settings['color'] ) && !empty( $settings['color'] ) ) ){
        if( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ){ 
            $background_img = "background-image: url('" . $settings['post_bg'] . "');";
        }

        if( isset( $settings['color'] ) && !empty( $settings['color'] ) ){
            $background_color = "background-color: " . $settings['color'] . "; ";
        }

        if( isset( $settings['position'] ) && !empty( $settings['position'] ) ){
            $position = 'background-position: '. $settings['position'] . ';';
        }
        if( isset( $settings['repeat'] ) && !empty( $settings['repeat'] ) ){
            $repeat = 'background-repeat: '. $settings['repeat'] . ';';
        }
        if( isset( $settings['attachment'] ) && !empty( $settings['attachment'] ) ){
            $bgatt = 'background-attachment: '. $settings['attachment'] . ';';
        }
    }else{
        if(get_background_image() == ''){ 
            
            $background_img = '';
            
        }else{
            $background_img = get_background_image();
        }
        
    }
}else{
    if(get_background_image() == '' ){
        $background_img = '';
    }else{
        $background_img = get_background_image();
    }
    
}

if( options::logic('general', 'disable_right_click') ){
    $vertical_body_class .= ' disable-right-click';
}
?>
<body <?php body_class($vertical_body_class); ?>  style="<?php echo $background_color ; ?> <?php echo $background_img ; ?>  <?php echo $position; ?> <?php echo $repeat; ?> <?php echo $bgatt; ?>">
   
    <div id="page">
        <div id="fb-root"></div>
        
        <?php
            if( options::logic( 'blog_post' , 'fb_comments' ) ){
                if(options::get_value( 'social' , 'facebook_app_id' ) != ''){
        ?>
                  
                <script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript"></script>
                  
        <?php
                }else{
        ?>
                    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript"></script>

        <?php   }
            }else{
        ?>  
                <script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript" id="fb_script"></script>  
        <?php   
            }
        ?> 
        <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"> </script> 
        <div class="row">
            <div class="twelve columns">
                <header id="header" <?php if( options::logic( 'styling' , 'header_style' ) == 'center' ){ echo 'class="header-centered"'; } elseif( options::logic( 'styling' , 'header_style' ) == 'oneline' ){ echo 'class="header-oneline"'; } ?>>
                    <div class="header-containe-wrapper">
                        <div id="dl-menu" class="dl-menuwrapper">
                            <button class="dl-trigger">Open Menu</button>
                            <?php echo menu( 'header_menu' , array( 'number-items' => options::get_value( 'menu' , 'header' )  , 'current-class' => 'active','type' => 'category', 'class' => ' dl-menu ', 'menu_id' => 'mobile_menu' ) ); ?>
                        </div>
                        <?php if( options::logic('general', 'show_header_stats') ): ?>
                            <div class="stats-info">
                                <div class="stats-trigger"><i class="icon-info"></i></div>
                                <ul>
                                    <li>
                                        <b><?php echo options::logic( 'stats' , 'block_title_1' ) ?></b>
                                        <em><?php echo options::logic( 'stats' , 'block_content_1' ) ?></em>
                                    </li>
                                    <li>
                                        <b><?php echo options::logic( 'stats' , 'block_title_2' ) ?></b>
                                        <em><?php echo options::logic( 'stats' , 'block_content_2' ) ?></em>
                                    </li>
                                    <li>
                                        <b><?php echo options::logic( 'stats' , 'block_title_3' ) ?></b>
                                        <em><?php echo options::logic( 'stats' , 'block_content_3' ) ?></em>
                                    </li>
                                    <li>
                                        <b><?php echo options::logic( 'stats' , 'block_title_4' ) ?></b>
                                        <em><?php echo options::logic( 'stats' , 'block_content_4' ) ?></em>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="relative">
                            <div class="row">
                                <?php if( options::logic( 'styling' , 'header_style' ) == 'center' ){?>
                                <div class="twelve columns tr">
                                    <?php 
                                        if( options::logic( 'general' , 'show_social_icons' ) ){
                                            echo post::get_social_icons();
                                        }
                                    ?>
                                    <?php 
                                        if( options::logic( 'general' , 'show_search_form' ) ){
                                    ?>
                                        <div class="search-trigger"><i class="icon-search"></i></div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <div class="<?php if( options::logic( 'styling' , 'header_style' ) != 'oneline' ){ ?>twelve columns <?php } else{ ?>four columns <?php } ?>">
                                    <div class="logo">
                                        <?php
                                            if( options::get_value( 'styling' , 'logo_type' ) == 'text' ) { 
                                                ob_start();
                                                ob_clean();
                                                bloginfo('name');
                                                $blog_name = ob_get_clean();

                                                $logo_content = '<a href="'.home_url().'" class="hover"><h3>' . $blog_name . '</h3></a>';
                                                    
                                            }elseif(options::get_value( 'styling' , 'logo_type' ) == 'image' && options::get_value( 'styling' , 'logo_url' ) == '' ){ 
                                            
                                                $logo_content = '
                                                    <a href="'.home_url().'" class="hover">
                                                        <img src="'.get_template_directory_uri().'/images/logo.png" alt="" />
                                                    </a>';
                                            }else{
                                                    $logo_content = '
                                                    <a href="'.home_url().'" class="hover">
                                                        <img src="'.options::get_value( 'styling' , 'logo_url' ).'" alt="" />
                                                    </a>';
                                            }
                                            echo $logo_content;
                                        ?>
                                    </div>
                                </div>
                                <div class="<?php if( options::logic( 'styling' , 'header_style' ) != 'oneline' ){ ?>twelve columns <?php } else{ ?>eight columns <?php } ?>">
                                    <div class="menu-separator">
                                        <div class="row">
                                            <div class="<?php if( options::logic( 'styling' , 'header_style' ) == 'center' ){?>twelve columns <?php } else{ ?>nine columns<?php } ?>">
                                                <div class="main-navigation">
                                                    <?php echo menu( 'header_menu' , array( 'number-items' => options::get_value( 'menu' , 'header' )  , 'current-class' => 'active','type' => 'category', 'class' => 'sf-menu ' , 'menu_id' => 'desktop_menu' ) ); ?>
                                                </div>
                                            </div>
                                            <?php if( options::logic( 'styling' , 'header_style' ) != 'center' ){?>
                                                <div class="three columns tr">
                                                    <?php 
                                                        if( options::logic( 'general' , 'show_social_icons' ) ){
                                                            echo post::get_social_icons();
                                                        }
                                                    ?>
                                                    <?php 
                                                        if( options::logic( 'general' , 'show_search_form' ) ){
                                                    ?>
                                                        <div class="search-trigger"><i class="icon-search"></i></div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                if( options::logic( 'general' , 'show_sticky_menu' ) ){
                            ?>
                                <nav id="main-mn" role="navigation" class="main-menu">
                                    <?php echo menu( 'header_menu' , array( 'number-items' => options::get_value( 'menu' , 'header' )  , 'current-class' => 'active','type' => 'category', 'class' => 'sf-menu ' , 'menu_id' => 'desktop_menu' ) ); ?>
                                </nav>
                            <?php 
                            }
                                if( options::logic( 'general' , 'show_search_form' ) ){
                                    get_template_part( 'searchform-header' ); 
                                }
                            ?>
                            
                        </div>
                    </div>
                </header>
                <div class="page-preloader">
                    <?php _e( 'Loading' , 'upcode' ); ?>
                </div>
        </div>
    </div>