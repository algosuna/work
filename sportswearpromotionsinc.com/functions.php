<?php
/*
Author: Shahul Hameed (Pixel8es)

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/
require_once('framework/theme-init.php'); //if you remove this, Drive Theme will break
/************* INCLUDE NEEDED FILES ***************/


require_once( 'library/translation/translation.php' ); //adding support for other languages
/*
1. library/drive.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/drive.php' ); // if you remove this, Drive will break
/*

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'drive-thumb-600', 600, 150, true );
add_image_size( 'drive-thumb-300', 300, 100, true );

// Thumbnail sizes

add_image_size( 'staff_admin', 100, 100, true );

//Default Image Size for Retina

add_image_size( 'fcs-slider', 345, 250, true );

add_image_size( 'portfolio-three', 346, 250, true );
add_image_size( 'portfolio-four', 251, 182, true );
add_image_size( 'portfolio-two', 534, 375, true );

add_image_size( 'blog', 817, 300, true );



/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function drive_register_sidebars() {
    register_sidebar(array(
    	'id' => 'primary-sidebar',
    	'name' => __('Blog Sidebar', 'drivetheme'),
    	'description' => __('The first (primary) sidebar.', 'drivetheme'),
    	'before_widget' => '<div id="%1$s" class="widgets %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgetTitle">',
    	'after_title' => '</h3>',
    ));

    register_sidebar(array(
    	'id' => 'right-sidebar',
    	'name' => __('Right Sidebar', 'drivetheme'),
    	'description' => __('The right sidebar.', 'drivetheme'),
    	'before_widget' => '<div id="%1$s" class="widgets %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgetTitle">',
    	'after_title' => '</h3>',
    ));
    

    register_sidebar(array(
    	'id' => 'left-sidebar',
    	'name' => __('Left Sidebar', 'drivetheme'),
    	'description' => __('The left sidebar.', 'drivetheme'),
    	'before_widget' => '<div id="%1$s" class="widgets %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgetTitle">',
    	'after_title' => '</h3>',
    ));

    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:*/
    
    register_sidebar(array(
    	'id' => 'footer-widgets',
    	'name' => __('Footer Widgets', 'drivetheme'),
    	'description' => __('Add Widgets to display in footer.', 'drivetheme'),
    	'before_widget' => '<div id="%1$s" class="col3 %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgetTitle">',
    	'after_title' => '</h3>',
    ));
    /*
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
 
// Comment Layout
function drive_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="commentSection clearfix">
			 <div class="comment-body">
			    <?php 
			    /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ 
			    ?>
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
                <div class="pull-left">
			    	<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=60" class="load-gravatar avatar avatar-48 photo" height="60" width="60" src="<?php echo get_template_directory_uri(); ?>/library/img/nothing.gif" />
                </div>
			    <!-- end custom gravatar call -->
                <div class="comments">
					<p class="comment-user"><?php printf(__('<cite class="fn">%s</cite>', 'drivetheme'), get_comment_author_link()) ?> <small>said
                    <?php edit_comment_link(__('(Edit)', 'drivetheme'),'  ','') ?></small>
				<time class="date" datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'drivetheme')); ?> </a></time></p>
					
			
					<?php if ($comment->comment_approved == '0') : ?>
                    <div class="alert info">
                        <p><?php _e('Your comment is awaiting moderation.', 'drivetheme') ?></p>
                    </div>
                	<?php endif; ?>
            
                    <div class="clearfix">
                        <?php comment_text() ?>
                    </div>
                </div>
            </div>
			<p class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function drive_wpsearch($form) {
    $form = '<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
    <input type="text" value="' . get_search_query() . '" name="s" id="s" class="textfield" placeholder="'.esc_attr__('Search the Site...','drivetheme').'" />
    <button type="submit" class="searchsubmit searchBtn"><span class="search-icon fa fa-search"></span></button>
    </form>';
    return $form;
} // don't remove this bracket!


?>