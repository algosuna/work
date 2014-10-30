<?php
add_filter("the_content", "the_content_filter");
 
function the_content_filter($content) {
 
	// array of custom shortcodes requiring the fix 
	$block = join("|",array("h1","h2","h3","h4","h5","h6","columns","columns_inside","columns_inside2","fullwidth","header","heading","sec_color","section","emphasis","info","success","error","warning","highlight","quote","one_half","one_half_inside","one_half_inside2","one_third","one_third_inside","one_third_inside2","one_fourth","one_fourth_inside","one_fourth_inside2","two_third","two_third_inside","two_third_inside2","three_fourth","three_fourth_inside","three_fourth_inside2","services","singleServices","process","staffs","client","clients","carousel_slider","contact","progress","content","columns","map","icon50","icon80","icon190","tab","tab_content","new_section","intro_box","tab_content","tab","accordions","accordion","toggle","toggles","icon","pricing_tables","pricing_column","pricing_title","pricing_price","pricing_con","pricing_row","pricing_button","googlemap_api","google_map","ul","li","chart","animation","icon_box"));
 
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	return $rep;
}

/* =============================================================================
	 General Shortcodes
   ========================================================================== */
//Tags Shortcode
function tag_fn($atts, $content = null, $code){
	return '<'. $code . '>'. do_shortcode($content) .'</'.$code.'>';
}
add_shortcode('h1','tag_fn');
add_shortcode('h2','tag_fn');
add_shortcode('h3','tag_fn');
add_shortcode('h4','tag_fn');
add_shortcode('h5','tag_fn');
add_shortcode('h6','tag_fn');
add_shortcode('header','tag_fn');


function shortcode_home_link() {
   return '<a href="'.home_url().'">'. get_bloginfo('name') .'</a>';
}
add_shortcode('blog-link', 'shortcode_home_link');

// ColorBg
function colorbg($atts, $content = null, $code){
	extract(shortcode_atts(array(
		'bg_color' => '',
		'bg_img' => '',
		'bg_position' => 'Yes'
	), $atts));
	$style = '';
	$class = '';
	$style = ' style="';
	$style .= (isset($bg_color) && $bg_color != '') ? 'background-color:'. esc_attr($bg_color) .';' : ''; 
	$style .= (isset($bg_img) && $bg_img != '') ? 'background-image:url('. esc_url($bg_img).');' : '';
	$class = (!empty($bg_img) || !empty($bg_color)) ? 'txtWhite' : '';
	$style .= (isset($bg_position) && $bg_position == 'Yes') ? 'background-attachment:fixed;' : '';
	$style .= '"';
	
	return '<div class="colorBg '. $class .'"'. $style .'><div class="container">'. do_shortcode($content) .'</div></div>';
}

add_shortcode('fullwidth','colorbg');

// Wrap Section
function tag_fn_with_clear_class($atts, $content = null, $code){
	extract(shortcode_atts(array('class' => ''), $atts));
	return '<'. $code . ' class="clearfix columns '. $class .'">'. do_shortcode($content) .'</'.$code.'>';
}

add_shortcode('section','tag_fn_with_clear_class');

//Emphasis
function emphasis($atts, $content = null, $code){
	extract(shortcode_atts(array(
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}

	return '<div class="emphasis'. esc_attr($animate_class) .'"'. $slideTransition .' '. $slideDuration .' '. $slideDelay .'>'. do_shortcode($content) .'</div>';
}

add_shortcode('emphasis','emphasis');

//Heading Style
function title($atts, $content = null, $code){
	extract(shortcode_atts(array(
		'tag' => 'h2',
		'main_title' => 'No',
		'uppercase' => 'No',
		'align' => 'left',
		'line' => 'Yes',
		'margin_bottom' => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
	), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}

	//Uppercase Yes or No
	$class = ($uppercase == 'Yes') ? 'uppercase ' : '';

	//Checking Title Style
	$class .= ($main_title == 'Yes') ? 'mainTitle ' : '';

	//Checking Title Style
	$style = !empty($margin_bottom) ? 'style="margin-bottom: '. $margin_bottom .'"' : '';



	//Check Alignment
	if ($align == 'right'){
		$class .= 'alignRight ';
	}elseif ($align == 'center') {
		$class .= 'alignCenter ';
	}

	//Title Backround Line
	$class .= ($line == 'Yes') ? 'borderLine ' : '';


	$output  = '<'. $tag .' class="'.$class.''. esc_attr($animate_class) .'"'. $slideTransition .' '. $slideDuration .' '. $slideDelay .' '. $style .'>';
	$output .= ($line == 'Yes') ? '<span class="bg">' : '';
	$output .= trim($content);
	$output .= ($line == 'Yes') ? '</span>' : '';
	$output .= '</'. $tag .'>';
	return $output;
}
add_shortcode('heading','title');


//secondary_color
function sec_color ($atts, $content = null, $code){   
   $output = '<span class="orange">'.trim($content).'</span>';	
   return $output;
}
add_shortcode('sec_color','sec_color');

//Highlight color
function highlight($atts, $content = null, $code){   
   $output = '<span class="highlight">'.trim($content).'</span>';	
   return $output;
}
add_shortcode('highlight','highlight');

/* =============================================================================
	 Layout column Shortcodes
   ========================================================================== */
   
function columns($atts, $content = null){			
		return '<section class="columns row-fluid">' . do_shortcode(trim($content)) . '</section>';
			
	}
add_shortcode('columns', 'columns');
add_shortcode('columns_inside', 'columns');
add_shortcode('columns_inside2', 'columns');

function container($atts, $content = null){			
		return '<section class="container">' . do_shortcode(trim($content)) . '<div class="clearfix"></div></section>';
			
	}
add_shortcode('container', 'container');
	
function one_half($atts, $content = null, $code){
	return '<div class="span6">' . do_shortcode(trim($content)) .'</div>';
}
add_shortcode('one_half', 'one_half');
add_shortcode('one_half_inside', 'one_half');
add_shortcode('one_half_inside2', 'one_half');

function one_third($atts, $content = null, $code){
	return '<div class="span4">' . do_shortcode(trim($content)) .'</div>';
}
add_shortcode('one_third', 'one_third');
add_shortcode('one_third_inside', 'one_third');
add_shortcode('one_third_inside2', 'one_third');

function one_fourth($atts, $content = null, $code){
	extract(shortcode_atts(array('align' => ''), $atts));
	return '<div class="span3 '. esc_attr($align) .'">' . do_shortcode(trim($content)) .'</div>';
}
add_shortcode('one_fourth', 'one_fourth');
add_shortcode('one_fourth_inside', 'one_fourth');
add_shortcode('one_fourth_inside2', 'one_fourth');

function two_third($atts, $content = null, $code){
	return '<div class="span8">' . do_shortcode(trim($content)) .'</div>';
}
add_shortcode('two_third', 'two_third');
add_shortcode('two_third_inside', 'two_third');
add_shortcode('two_third_inside2', 'two_third');

function three_fourth($atts, $content = null, $code){
	return '<div class="span9">' . do_shortcode(trim($content)) .'</div>';
}
add_shortcode('three_fourth', 'three_fourth');
add_shortcode('three_fourth_inside', 'three_fourth');
add_shortcode('three_fourth_inside2', 'three_fourth');

/* =============================================================================
	 Info, Message and Alert Boxes
   ========================================================================== */
function message_box($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}

	$icon = "";
	if($code == "info")
		$icon = "info-circle";
	elseif ($code == "success")
		$icon = "check-circle";
	else
		$icon = "times-circle";
			
	if($code != "warning")
		return '<div class="alert alert-'.esc_attr($code).''. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'><button type="button" class="close" data-dismiss="alert">x</button><span class="icon fa fa-'.$icon.'"></span><div>' . do_shortcode($content) . '</div></div>';
	else
		return '<div class="alert alert-block'. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'><button type="button" class="close" data-dismiss="alert">x</button><span class="icon fa fa-warning"></span><div>' . do_shortcode($content) . '</div></div>';
}
add_shortcode('info','message_box');
add_shortcode('success','message_box');
add_shortcode('error','message_box');
add_shortcode('warning','message_box');

//Icons
function icon($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'icon_name' => '',
		'font_size' => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
	), $atts));

	$size = !empty($font_size) ? ' style="font-size:'.$font_size.';"' : '';
	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}

	return '<span class="fa '. $icon_name .''. esc_attr($animate_class) .'"'. $size .''. $slideTransition .''. $slideDuration .''. $slideDelay .'></span>';
}

add_shortcode('icon','icon');


//Icon List
function icons_list($atts, $content = null, $code) {
	return '<ul class="listStyle fa-ul">' . do_shortcode($content) . '</ul>';
}

add_shortcode('ul','icons_list');
//list
function icon_list_item($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'icon_name' => ''
	),$atts));
	return '<li><span class="fa-li fa fa-'.esc_attr($icon_name).'"></span>' . do_shortcode($content) . '</li>';
}

add_shortcode('li','icon_list_item');

/* =============================================================================
	 Accordion and Tabs
   ========================================================================== */

//Accordion Container
function accordions($atts, $content = null, $code){
	extract(shortcode_atts(array('title' => 'title'), $atts));
	if ($code == 'accordions'){
		return '<div class="accordion">' . do_shortcode($content) . '</div>';
	}else{
		return '<h3>'. esc_html($title) .'</h3><div class="content">' . do_shortcode($content) . '</div>';	
	}
}
add_shortcode('accordions','accordions');
add_shortcode('accordion','accordions');

//Toggle
function toggles( $atts, $content = null, $code){
	wp_enqueue_script("myUi");
    extract(shortcode_atts(array('title' => 'Click To Open'),$atts));
	if ($code == 'toggles'){
		return '<div class="toggle">' . do_shortcode($content) . '</div>';
	}else{
		return '<h3><span></span>'. $title .'</h3><div class="ui-accordion-content">' . do_shortcode($content) . '</div>';
	}
}
add_shortcode('toggles', 'toggles');
add_shortcode('toggle','toggles');

//Tabbed Panel
function tab($atts, $content = null) {
       
               extract(shortcode_atts(array(), $atts));
               global $tabs_divs;
               $tabs_divs = '';
       
               $output = '<div class="tabbable theme-tabs"><ul class="nav nav-tabs myTab">';
               $output.= do_shortcode($content);
               $output.= '</ul><div class="tab-content clearfix">'.$tabs_divs.'</div></div>';
               
               return $output;
       }
       
       function tabpanel($atts, $content = null) {
               
               global $tabs_divs;

               extract(shortcode_atts(array(  
                       'id' => '',
                       'title' => '', 
                       'active' => '',
                       'icon_name' => ''
               ), $atts));  
       
               if(empty($id))
                       $id = 'side-tab'.rand(100,999);

               $icon = !empty($icon_name) ? '<i class="icon fa fa-'.$icon_name.'"></i>' : '';
       
               $output = '
                       <li class="'. $active .'">
                               <a href="#' . esc_attr($id) . '" data-toggle="tab">'. $icon .'' .esc_html($title). '</a>
                       </li>
               ';
       
               $tabs_divs.= '<div id="'.esc_attr($id).'" class="tab-pane '. esc_attr($active) .'">'.do_shortcode($content).'</div>';
       
               return $output;
       
       }
add_shortcode('tab','tab');
add_shortcode('tab_content','tabpanel');

/* =============================================================================
	 Blog Post Loop
   ========================================================================== */
function blog_post_shortcode($atts) {
   // Defaults
   extract(shortcode_atts(array(
	  "no_of_post" => '',
	  "order" => 'desc',
	  "order_by" => 'rand',
	  "excerpt_length" => '80',
	  "link_text" => 'Continue Reading'
   ), $atts));
   $paged = (get_query_var('paged')); 
   $the_query = '';
   // de-funkify query
   $the_query = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $the_query);
   $the_query = preg_replace('~&#0*([0-9]+);~e', 'chr(\\1)', $the_query);
   
   
	$the_query = array(
		"posts_per_page" => $no_of_post,
		"order" => $order,
		"orderby" => $order_by,
		"paged" => $paged
	);
   // query is made               
   query_posts($the_query);

   // Reset and setup variables
   $output = '';
   $temp_title = '';
   $temp_link = '';
   $temp_ex = '';
   $temp_content = '';
   $temp_thumb = '';
   $temp_id = '';

   // the loop
   $output = '';
   if (have_posts()) : while (have_posts()) : the_post();
   global $post;
   	  $temp_id = get_the_ID();
      $temp_title = get_the_title($temp_id);
      $temp_link = get_permalink($temp_id);
      $temp_content = ShortenText(strip_shortcodes(strip_tags(get_the_content($temp_id))), $excerpt_length) ;
	  
	  $meta = '<p>Posted by <span class="author">';
	  $meta .= '<a href=" '. get_author_posts_url($post -> author). '">'; 
	  $meta .= get_the_author_meta('display_name');
	  $meta .= '</a></span>';
	  
	  
	  $meta  .= ' On '.get_the_time('F j, Y');
	  $meta .= '</p>';
	  $category = get_the_category_list(', ');
	  
	  
	  
      $output .= '<article id="post-'.$temp_id.'" class="post clearfix" role="article">
            	<header>
            		<h2 class="blogTitle"><a href="'.$temp_link.'" rel="bookmark">'.$temp_title.'</a></h2>
                  	<div class="meta clearfix">
                            <div class="post-format-icon"></div>
						 '.$meta.'
                      <p>Categories: '.$category.'</p>                          
                  </div>
                </header>
                
                <div class="blogContent">';
                
                    $meta = get_post_meta($post->ID, 'drive_post_options', false);
					
                    if( !empty($meta) )
                        extract($meta[0]);

                    $fcs_video = isset($fcs_video) ? $fcs_video : '';
                    $fcs_audio = isset($fcs_audio) ? esc_url($fcs_audio) : '';

                    if ( has_post_format( 'audio' ) ){
                        if(!empty($fcs_audio)){
                            $output .= '<div class="fcs-post-audio">'.do_shortcode('[audio src="'. $fcs_audio .'"]').'</div>';
                        }
                    }
                    elseif ( has_post_format( 'video' ) ){
                        if (!empty($fcs_video)) {
                            $output .= '<div class="fcs-post-video">'.$fcs_video.'</div>';
                        }
                    }
                    else{
                        if( has_post_thumbnail() && function_exists('dfi_get_featured_images') ) {
                
                	$output .= '<div class="post-thumbnail">
                    <div class="flexslider">
                        <ul class="slides">';          
							
                            $img = '';
                            // Checks if post has a feature image, grabs the feature-image and outputs that along with thumbnail SRC as a REL attribute 
                            if (has_post_thumbnail()) { // checks if post has a featured image and then outputs it.     
                                $image_id = get_post_thumbnail_id ($post->ID );  
                                $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');   
                                if(!empty($image_thumb_url))
                                    $img = aq_resize($image_thumb_url[0], 1100, 300, true, true); 

                                if($img){
                                    $output .= '<li><img src="' . $img . '" alt=""></li>';
                                }else{
                                    $output .= '<li><img src="' .  $image_thumb_url[0] . '" alt=""></li>';                                           
                                }
                            }

                            
                            if( function_exists('dfi_get_featured_images') ) {
                                $featuredImages = dfi_get_featured_images();

                                if(!empty($featuredImages)){

                                    foreach ($featuredImages as $featuredImage) {
                                        $img = aq_resize($featuredImage['full'], 817, 300, true, true);
                                        
                                        if($img){
                                            $output .= '<li><img src="' . $img . '" alt=""></li>';
                                        }else{
                                            $output .= '<li><img src="' .  $featuredImage['full'] . '" alt=""></li>';                                           
                                        }
                                    }
                                }
                            }
                                
                            
                            $output .= '</ul>
                        </div><!-- end #slider -->
                    </div>';   
                    
                            }
                        }
					
				
						

                        $output .= '<p>'.$temp_content.'</p>';
						
						
                    
                    $output .= '<a href="'.$temp_link.'" class="permalink" rel="bookmark">'.$link_text.'</a>
                </div>
            </article>';
		
		
			
    endwhile; 
    $output .= shortcode_nav( '<div class="sep"></div><div class="pagination theme-style">','</div><div class="sep"></div>');
    else:
      $output .= "Post not found.";
   endif;
   wp_reset_query();
   return  $output;
}
add_shortcode("blog_post", "blog_post_shortcode");


/* =============================================================================
	Theme Related Shortcodes
   ========================================================================== */		

//Call Out
function callout_box($atts, $content = null){
	extract(shortcode_atts(array(
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}
	
	$output  = '<section class="callOut newSection'. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'>';
	$output .= $content;
	$output .= '</section>';
	return $output;
}
add_shortcode('callout_box','callout_box');

//Intro Box
function intro_box ($atts, $content = null, $code){
	extract(shortcode_atts(array(
	  "display_button" => 'Yes',
	  "title" => 'Title Goes Here',
	  "button_text" => 'Button text',
	  "button_url" => '#',
	  "button_title" => '',
	  "button_style" => '',
	  "icon_name" => ''
   ), $atts));
    if($display_button == 'No'){
	   $output = '<div class="introBox"><div class="center clearfix"><div class="content"><h2>'. esc_html($title) .'</h2>' . do_shortcode(trim($content)) . '</div></div></div>'; 
   }else{
	   $output = '<div class="introBox"><div class="container clearfix"><div class="content"><h2>'. esc_html($title) .'</h2>' . do_shortcode(trim($content)) . '</div><p class="introMB"><a href="'. esc_url($button_url) .'" class="btn btn-'. esc_attr($button_style) .'" title="'. esc_attr($button_title) .'"><span class="fa '. esc_attr($icon_name) .'"></span>'. esc_html($button_text) .'</a></p></div></div>';
   }
	   
   return $output;
}
add_shortcode('intro_box','intro_box');

//Dividers
function divider($atts, $content = null, $code){
	
	return '<span class="'. esc_attr($code) .'">'. do_shortcode($content) .'</span>';
}
add_shortcode('seperator','divider');
add_shortcode('clearBoth','divider');

//dropcaps
function dropcaps($atts, $content = null, $code){
    extract(shortcode_atts(array(
	"style" => 'default',
	), $atts)); 
	return '<span class="dropcaps '. esc_attr($style) . '">' . esc_html($content) . '</span>';
}
add_shortcode('dropcaps', 'dropcaps');

//Button
function button($atts, $content = null){	
	extract(shortcode_atts(array(
		'link'  => '#',
		'title' => '',
		'button_style' => '',
		'button_size' => '',
		'button_text' => 'Button Text',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'target' => '_self',
		'delay' => ''
	), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}
	
	$output  = '<a href="'. esc_url($link) .'" title="'. esc_attr($title) .'" target="'. esc_attr($target) .'" class="btn btn-'. esc_attr($button_style) .' btn-'. esc_attr($button_size) .''. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'>'. esc_html($button_text) .'</a>';
	return $output;
}
add_shortcode('button','button');


//Button
function button_icon($atts, $content = null){	
	extract(shortcode_atts(array(
		'icon' => '',
		'link'  => '#',
		'title' => '',
		'button_style' => '',
		'button_size' => '',
		'button_text' => 'Read more',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'target' => '_self',
		'delay' => ''
	), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}
	$output  = '<a href="'. esc_url($link) .'" title="'. esc_attr($title) .'" target="'. esc_attr($target) .'" class="btn btn-'. esc_attr($button_style) .' btn-'. esc_attr($button_size) .''. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'><span class="fa '. $icon .'"></span>'. $button_text .'</a>';
	return $output;
}
add_shortcode('button_icon','button_icon');

//Tool-tip
function tooltip($atts, $content = null){	
	extract(shortcode_atts(array(
		'link'  => '#',
		'tooltip_title' => 'title',
		'tooltip_content' => 'content goes here',
		'align' => ''
	), $atts));
	
	$output  = '<a href="'. esc_url($link) .'" rel="tooltip" data-placement="'. esc_attr($align) .'" class="tool-tip" data-original-title="'. esc_attr($tooltip_content) .'">'. esc_html($tooltip_title) .'</a>';
	return $output;
}
add_shortcode('tooltip','tooltip');

//Pop-over
function pop_over($atts, $content = null){	
	extract(shortcode_atts(array(
		'button_text' => 'popover',
		'link'  => '#',
		'align' => 'top',
		'button_style' => 'primary',
		'mouse_over' => 'hover',
		'title' => 'Title'		
	), $atts));
	$pop_contents = strip_tags(stripslashes($content));
	$output  = '<a href="'. esc_url($link) .'" id="pop-over" rel="tooltip" data-placement="'. esc_attr($align) .'" class="pop-over btn btn-'. esc_attr($button_style) .'" data-trigger="'. esc_attr($mouse_over) .'" data-original-title="'. esc_attr($title) .'" data-content="'. esc_attr($pop_contents) .'">'. esc_html($button_text) .'</a>';
	return $output;
}
add_shortcode('pop_over','pop_over');


//Google map 
function google_map($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '100%',
      "height" => '300'
   ), $atts));
   return '<div class="map"><iframe width="'.$width.'" height="'.$height.'px" src="'.trim(strip_tags(stripslashes($content))).'&output=embed" ></iframe></div>';
}
add_shortcode("google_map", "google_map");



//Google Map API v3
function googlemap_shortcode( $atts ) {
   extract(shortcode_atts(array(
       'width' => '98%',
       'height' => '300',
		'lat' => '',
		'lng' =>'',
		'zoom' => '13',
		'pancontrol' => 'Yes',
		'zoomcontrol'=> 'Yes',
		'maptypecontrol'=> 'Yes',
		'scalecontrol'=> 'Yes',
		'streetviewcontrol'=> 'Yes',
		'overviewmapcontrol'=> 'Yes'
   ), $atts));

   $pancontrol = ($pancontrol == 'Yes') ? 'true' : '';
   $zoomcontrol = ($zoomcontrol == 'Yes') ? 'true' : '';
   $maptypecontrol = ($maptypecontrol == 'Yes') ? 'true' : '';
   $scalecontrol = ($scalecontrol == 'Yes') ? 'true' : '';
   $streetviewcontrol = ($streetviewcontrol == 'Yes') ? 'true' : '';
   $overviewmapcontrol = ($overviewmapcontrol == 'Yes') ? 'true' : '';

   $rand = rand(1,100) * rand(1,100);

   return '<script src="http://maps.googleapis.com/maps/api/js?key=&sensor=false" type="text/javascript"></script>
        
           
               <div class="map_api" id="map_canvas_'.esc_attr($rand).'" style="width:'. $width .'; height:'. $height .'px"></div>
               <script type="text/javascript">
                 function initialize() {
                       var myLatlng = new google.maps.LatLng('.$lat.','. $lng .');  
                       var mapOptions = {
                         center: myLatlng,
                         zoom: '. $zoom .',
                         panControl: '. $pancontrol .',
                         zoomControl: '. $zoomcontrol .',
                         mapTypeControl: '. $maptypecontrol .',
                         scaleControl: '. $scalecontrol .',
                         streetViewControl: '. $streetviewcontrol .',
                         overviewMapControl: '. $overviewmapcontrol .',
                         mapTypeId: google.maps.MapTypeId.ROADMAP
                       };
                       var map = new google.maps.Map(document.getElementById("map_canvas_'.$rand.'"),
                               mapOptions);
                       var marker = new google.maps.Marker({
                               position: myLatlng
                       });
               
                       marker.setMap(map);        
                 }initialize();
           </script>
           ';

}
add_shortcode('googlemap_api', 'googlemap_shortcode');


//Charts

function chart_function( $atts ) {
   extract(shortcode_atts(array(
       'data' => '',
       'chart_type' => 'pie3d',
       'title' => 'Chart',
       'labels' => '',
       'size' => '640x480',
       'background_color' => 'FFFFFF',
       'colors' => '',
   ), $atts));

   switch ($chart_type) {
            case 'line' :
			 $chart_type = 'lc';
			 break;
           case 'pie3d' :
			 $chart_type = 'p3';
			 break;
	  case 'xyline' :
			$chart_type = 'lxy'; 
			break;
	  case 'sparkline' :
			$chart_type = 'ls'; 
			break;
	  case 'meter' :
			$chart_type = 'gom'; 
			break;
	  case 'scatter' :
			$chart_type = 's'; 
			break;
	  case 'venn' :
			$chart_type = 'v';
			break;
	  case 'pie2d' :
			$chart_type = 'p';
			break;
      default :
         break;
   }

   $attributes = '';
   $attributes .= '&chd=t:'.$data.'';
   $attributes .= '&chtt='.$title.'';
   $attributes .= '&chl='.$labels.'';
   $attributes .= '&chs='.$size.'';
   $attributes .= '&chf='.$background_color.'';
   $attributes .= '&chco='.$colors.'';

   return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$chart_type.''.$attributes.'" alt="'.$title.'" class="chart" />';
}
add_shortcode('chart', 'chart_function');

//PDF EMBEDDING
function pdf_function($attr, $content) {
   extract(shortcode_atts(array(
       'width' => '640',
       'height' => '480'
   ), $attr));
   return '<iframe src="http://docs.google.com/viewer?url=' . esc_url($content) . '&embedded=true" style="width:' .esc_attr($width). '; height:' .esc_attr($height). ';">Your browser does not support iframes</iframe>';
}
add_shortcode('pdf', 'pdf_function');


//icon190
function icon190($atts, $content= null){
	extract(shortcode_atts(array(
		'style' => '',
		'rotate' => 'rotate1',
		'icon_name' => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}

	$output = '<div class="sepCenter '. esc_attr($style) .'"><div class="outerCircle '. esc_attr($rotate) .'"><p class="icon190"><span class="fa '. esc_attr($icon_name) .''. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'></span></p></div></div>';
	return $output;
}
add_shortcode('icon190','icon190');

function content($atts, $content= null){
	extract(shortcode_atts(array(
		'title_tag' => 'h3',
		'title' => 'Section Title',
		'link' => '',
		'button_style' => 'theme-sec',
		'button_size' => '',
		'button_text' => ''
	), $atts));
	$button = '';
	if(!empty($link) && !empty($button_text)){
		$button = '<p class="sepCenter"><a href="'. esc_attr($link).'" class="btn btn-'. esc_attr($button_style) .' btn-'. esc_attr($button_size) .'">'. esc_html($button_text) .'</a></p>';
	}
	$output = '<div class="animateIcon"><'. $title_tag .' class="title">'. esc_html($title) .'</'. $title_tag .'><p class="content">'. do_shortcode($content) .'</p>'. $button .'</div>';
	return $output;
}
add_shortcode('content','content');

function animation($atts, $content= null){
	extract(shortcode_atts(array(
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";


	$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

	$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

	$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';


	$output = '<div class="pix-animate-cre"'. $slideTransition .''. $slideDuration .''. $slideDelay .'>'. do_shortcode(trim($content)) .'</div>';

	return $output;
}
add_shortcode('animation', 'animation');

function singleServices($atts, $content= null){
	extract(shortcode_atts(array(
		'column' => 'col3',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}
	if($column == "col4"){
		$output = '<div class="singleService span3'. esc_attr($animate_class) .'"'. $slideTransition .' '. $slideDuration .' '. $slideDelay .'>'. do_shortcode(trim($content)) .'</div>';
	}else{
		$output = '<div class="singleService span4'. esc_attr($animate_class) .'"'. $slideTransition .' '. $slideDuration .' '. $slideDelay .'>'. do_shortcode(trim($content)) .'</div>';
	}

	return $output;
}
add_shortcode('singleServices', 'singleServices');

function tagline($atts, $content= null){
	extract(shortcode_atts(array(
		'tagline' => ""
	), $atts));

	$output = $check . '<p class="tagline">'. $tagline .'</p>';

	return $output;
}
add_shortcode('tagline', 'tagline');

function hgroup($atts, $content= null){

	$output = '<hgroup>'. do_shortcode(trim($content)) .'<div class="clear"></div></hgroup>';

	return $output;
}
add_shortcode('hgroup', 'hgroup');

function service_box($atts, $content= null){
	extract(shortcode_atts(array(
		'align' => 'center'
	), $atts));

	$output = '<div class="singleService singleService2 align-'. $align .'">'. do_shortcode(trim($content)) .'</div>';

	return $output;
}
add_shortcode('service_box', 'service_box');

function icon_box($atts, $content= null){
	extract(shortcode_atts(array(
		'align' => 'center',
		'icon_align' => 'center',
		'color' => '',
		'icon_name' => '',
		'animate' => 'No',
		'transition' => '',
		'duration' => '',
		'delay' => '',
		'title' => 'Section Title',
		'title_tag' => 'h2',
		'display_button' => 'Yes',
		'button_link'  => '#',
		'button_title_attr' => '',
		'button_style' => 'theme-sec',
		'button_size' => 'medium',
		'button_text' => 'Read more',
		'icon_size' => 'small',
		'tagline' => ''
	), $atts));
	$title_tag = !empty($title_tag) ? $title_tag : 'h2';
	if($icon_size == 'medium'){
		$icon_size = 'icon80';
	}else{
		$icon_size = 'icon50';
	}
	$tagline = !empty($tagline) ? '[tagline tagline="'.$tagline.'"]' : '';
	$button = "";
	if($display_button == 'Yes'){
		$button = "<p class='sepCenter'>[button button_url='$button_link' button_text='$button_text' button_title='$button_title_attr' button_style='$button_style' button_size='$button_size']</p>";
	}
	$output = do_shortcode("[service_box align='$align'][hgroup]
	[$icon_size icon='$icon_align' align='$align' color='$color' icon_name='$icon_name' animate='$animate' transition='$transition' duration='$duration' delay='$delay']
<$title_tag class='title'>$title </$title_tag>$tagline [/hgroup]
<p>$content</p>$button [/service_box]");

	return $output;
}
add_shortcode('icon_box', 'icon_box');

function services($atts, $content= null){
	extract(shortcode_atts(array(
	), $atts));
	$output = '<section class="newSection row-fluid mainServices2">'. do_shortcode(trim($content)) .'</section>';
	return $output;
}
add_shortcode('services', 'services');

//Icon50
function icon50($atts, $content= null){
	extract(shortcode_atts(array(
		'align' => '',
		'color' => '',
		'icon_name' => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}
	
	if($color == "Yes"){
		$output = '<div class="icon50 '. esc_attr($align) .' orange'. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'><span class="fa '. esc_attr($icon_name) .'"></span></div>';
	}else{
		$output = '<div class="icon50 '. esc_attr($align) .''. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'><span class="fa '. esc_attr($icon_name) .'"></span></div>';
	}
	return $output;
}
add_shortcode('icon50','icon50');

//Icon80
function icon80($atts, $content= null){
	extract(shortcode_atts(array(
		'align' => '',
		'color' => '',
		'icon_name' => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}

	if($color == "Yes"){
		$output = '<div class="icon80 '. esc_attr($align) .' orange'. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'><span class="fa '. esc_attr($icon_name) .'"></span></div>';
	}else{
		$output = '<div class="icon80 '. esc_attr($align) .''. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'><span class="fa '. esc_attr($icon_name) .'"></span></div>';
	}
	return $output;
}
add_shortcode('icon80','icon80');

//Blockquote
function quote($atts, $content = null){
	extract(shortcode_atts(array(
		'align' => 'left',
		'author_name' => ''
	),$atts));
	$output = '<blockquote class="pull-'. $align .'"><p>'. do_shortcode($content);
	if(!empty($author_name)) {
	$output .='<small class="">'. esc_html($author_name) .'</small>';
	}
	$output .='</p></blockquote><div class="clear"></div>';
	return $output;
}
add_shortcode('quote','quote');

//Contact

function contact($atts, $content = null, $code){
   	extract(shortcode_atts(array(
   		'mailto' => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
	), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}
	
	global $smof_data;

	$contact_button_text = isset($smof_data['contact_button_text']) ? $smof_data['contact_button_text'] : __('SEND MAIL','drivetheme');
	
	if(empty($contact_button_text)){
		$contact_button_text = __('Send Mail','drivetheme');
	}

	
   	$output = '';
   	if(isset($_POST['contactname'])){
   		$output .= $_POST['contactname'];
   	}

   	$cname = isset($_POST['contactname']) ? $_POST['contactname'] : '';
   	$email = isset($_POST['email']) ? $_POST['email'] : '';
   	$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
   	$message = isset($_POST['message'])? $_POST['message'] : '';

   	$nonce = wp_create_nonce("drive_ajax_form_nonce");
   	$actionUrl = admin_url('admin-ajax.php?action=drive_submit_form&nonce='. $nonce);

   	if (isset($_POST['submit'])){
   		$actionUrl = admin_url('admin-ajax.php?action=drive_submit_form&contactname='. $cname .'&email='. $email .'&subject='.$subject .'&message='. $message .'&nonce='. $nonce);
   	}

   	wp_localize_script( 'drive-scripts', 'driveAjax', 
   		array( 
   			'ajaxurl' => admin_url( 'admin-ajax.php' ), 
   			'templateurl' => get_template_directory_uri(), 
   			'email' => $mailto,
   			'nonce' => $nonce
		)
	);
			
   $output .= '<div class="contactForm new-section'. esc_attr($animate_class) .'"'.$slideTransition.''.$slideDuration.''.$slideDelay.'>	           
       			
               <form method="post" action="'.$actionUrl.'" id="contactform" class="contactform">
               <div class="response"></div>
               <div class="row-fluid">
                   <p class="span4">
                       <label for="contactname">'. __('Name:','drivetheme').' <span>*</span></label>
                       <input type="text" name="contactname" id="contactname" value="" class="contactname required textfield" role="input" aria-required="true">
                   </p>
       
                   <p class="span4">
                       <label for="email">'.__('Email:','drivetheme').' <span>*</span></label>
                       <input type="text" name="email" id="email" value="" class="required email textfield" role="input" aria-required="true">
                   </p>
       
                   <p class="span4">
                       <label for="subject">'.__('Phone:','drivetheme').'  <span>*</span></label>
                       <input type="text" name="subject" id="subject" value="" class="required textfield subject" role="input" aria-required="true">
                   </p>
       
                   <p class="textArea clear">
                       <label for="message">'.__('Message:','drivetheme').'  <span>*</span></label>
                       <textarea rows="8" name="message" id="message" class="required textarea message" role="textbox" aria-required="true"></textarea>
                   </p>      
                   
                   <button type="submit" name="submit" id="submitButton" title="Click here to submit your message!" class="btn btn-theme-pri"><span class="fa fa-envelope"></span>'.esc_html($contact_button_text).'</button>
					</div>
               </form>
       </div>';
   		
    
    return $output;
   }
   add_shortcode('contact', 'contact'); 



//How We Works
function how_we_works($atts, $content = null){
	extract(shortcode_atts(array(
	  	'display_arrow' => 'yes',
		'rotate' => 'rotate1',
		'step' => '00',
		'title' => 'title',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
	), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}
	
	$output = '<div class="span2 alignCenter process">
				<div class="singleService">
					<div class="sepCenter'. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'>
						<div class="outerCircle fullBg '. esc_attr($rotate) .'">
							<p class="icon100 noMarginBottom">'. esc_html($step) .'</p>
						</div>
					</div>';
	if($display_arrow == 'yes')
		$output .= '<div class="arrow">&nbsp;</div>';
	$output .= '<h3 class="uppercase">'. esc_html($title) .'</h3> 
				</div>   
			</div>';
			return $output;
	
}
add_shortcode('process', 'how_we_works');

//Pricing Tables
function pricing_tables($atts, $content = null){
	extract(shortcode_atts(array(),$atts));
	$output = '<div class="row-fluid priceTableCon newSection">'. do_shortcode($content) .'</div>';
	return $output;
}
add_shortcode('pricing_tables', 'pricing_tables');

//Single Pricing Table
function pricing_column($atts, $content = null){
	extract(shortcode_atts(array(
	  	'columns' => 'col3',
		'highlight' => 'no',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
	), $atts));

	$animate_class = "";
	$slideTransition = "";
	$slideDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$slideDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}

	
	if($columns == 'col3'){
		$columns = 'span4';
	}elseif ($columns == 'col2') {
		$columns = 'span6';
	}elseif ($columns == 'col4') {
		$columns = 'span3';
	}
	if($highlight == 'yes'){
		$output = '<div class="'. esc_attr($columns) .' priceTable bestPlan'. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'>'. do_shortcode($content) .'</div>';
	}else{
		$output = '<div class="'. esc_attr($columns) .' priceTable'. esc_attr($animate_class) .'"'. $slideTransition .''. $slideDuration .''. $slideDelay .'>'. do_shortcode($content) .'</div>';	
	}
	return $output;
}
add_shortcode('pricing_column', 'pricing_column');

//Pricing Title
function pricing_title($atts, $content = null){
	extract(shortcode_atts(array(
	  	'title_tag' => ''
	),$atts));
	$output = '<'. $title_tag .' class="planTitle">'. esc_html($content) .'</h3>';
	return $output;
}
add_shortcode('pricing_title', 'pricing_title');

//Pricing Pricing
function pricing_price($atts, $content = null){
	extract(shortcode_atts(array(
	  	'currency' => '$',
		'price' => '',
		'period' => ''
	),$atts));
	$output = '<p class="value"><span class="vAlign">'.esc_html($currency).'</span> '. esc_html($price) .' <small>/'. esc_html($period) .'</small></p>';
	return $output;
}
add_shortcode('pricing_price', 'pricing_price');

//Pricing Row Container
function pricing_con($atts, $content = null){
	extract(shortcode_atts(array(),$atts));
	$output = '<ul>'. do_shortcode($content) .'</ul>';
	return $output;
}
add_shortcode('pricing_con', 'pricing_con');

//Single Row
function pricing_row($atts, $content = null){
	extract(shortcode_atts(array(),$atts));
	$output = '<li>'. esc_html($content) .'</li>';
	return $output;
}
add_shortcode('pricing_row', 'pricing_row');

//Pricing Button
function pricing_button($atts, $content = null){
	extract(shortcode_atts(array(
		'button_style' => '',
		'url' => ''
	),$atts));
	$output = '<p><a href="'. $url .'" class="btn btn-'.esc_attr($button_style).'">'. esc_html($content) .'</a></p>';
	return $output;
}
add_shortcode('pricing_button', 'pricing_button');

//Progress Bar
function progress_bar($atts, $content = null) {
	extract(shortcode_atts(array(
		'percentage' => ''
	),$atts));
	$output = '<p class="progress-text">'. do_shortcode($content) .'</p><div class="progress-con"><div class="progress"><div class="bar theme" style="width: '. esc_attr($percentage) .';"></div></div></div>';

	return $output;
}
add_shortcode('progress', 'progress_bar');

/*** Staffs Custom Posts Lists ***/

//Carousel Container
function carousel_slider($atts, $content = null){
	extract(shortcode_atts(array(
		"enable_slider" => 'yes',
		"hover_effect" => 'hover-effect2',
		"columns" => 'col3',
		"title_tag" => 'h2',
		"title" => 'Our Team',
		"type" => '',
		"auto_play" => 'false',
		"slide_duration" => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
		), $atts));

	$animate_class = "";
	$slideTransition = "";
	$animateDuration = "";
	$slideDelay = "";

	if($animate == "Yes"){

		$animate_class = ' pix-animate-cre';

		$slideTransition = isset($transition) ? ' data-trans="'. esc_attr($transition) .'"' : '';

		$animateDuration = isset($duration) ? ' data-duration="'. $duration .'"' : '';

		$slideDelay = isset($delay) ? ' data-delay="'. $delay .'"' : '';

	}

	$sliderClassName = '';
	$slider = ($enable_slider == 'yes') ? 'fcsCarousel' : '';

	$autoPlay = ($auto_play == 'true') ? 'data-autoplay="'. esc_attr($auto_play) .'"' : '';
	$slideDuration = isset($slide_duration) ? 'data-duration="'. esc_attr($slide_duration) .'"' : '';

	$slider = ($enable_slider == 'yes') ? 'fcsCarousel' : '';

	if ($type == 'clients')
		$sliderClassName = 'ourClients';
	else if ($type == 'staffs')
		$sliderClassName = 'member';	
	
	$output  =  '<section class="newSection container popup-gallery ' . $slider . ' '.$columns.' '. $sliderClassName .'" '. $autoPlay .' '. $slideDuration .'>';
    $output .=  '<'.$title_tag.' class="mainTitle'. esc_attr($animate_class) .'"'. $slideTransition .' '. $animateDuration .' '. $slideDelay .'>'.esc_html($title).'</'.$title_tag.'>';
    $output .=  '<div class="carousel-items-con '. $hover_effect .' featuredWorks">';
    $output .=  '<ul class="carousel-items">';
	
	$output .= do_shortcode($content);
	
	$output .= '</ul>';
	if($enable_slider == 'yes'){
		$output .= '<div class="slider-nav">';
		$output .= '<a href="#" data-dir="prev" class="slider-btn prevSlide">&lsaquo;</a>';
		$output .= '<a href="#" data-dir="next" class="slider-btn nextSlide">&rsaquo;</a>';
		$output .= '</div> ';
	}
	$output .= '</div>';
	$output .= '</section>';
	return $output;
}
add_shortcode('carousel_slider', 'carousel_slider');


//Portfolio Loop
function portfolio($atts, $content = null){
	global $smof_data;
	extract(shortcode_atts(array(
	"no_of_portfolio" => -1,
	'columns' => 'col3',
	"portfolio_id" => '',
	"order_by" => 'menu_order', //date, title, rand, menu_order
	"order" => 'asc', //desc
	"button_text" => 'click here for more details'
	), $atts)); 
	
	   // the loop
	   if($portfolio_id != ""){
		$portfolio_id= explode(',', $portfolio_id);
		}
		
		if($portfolio_id == ""){
	   	  $args = array(
			'post_type' => 'fcs_portfolio',
			'orderby' => $order_by,
			'order' => $order,
			'posts_per_page' => $no_of_portfolio
			);
	   }
	   else{
			$args = array(
				'post_type' => 'fcs_portfolio',
				'order' => $order,
				'orderby' => $orderby,
				'post__in' => $portfolio_id
			);   
	   }
	   
	  $output ='';
	  $the_query = new WP_Query( $args );
	  //$the_query = new WP_Query( array( 'posts_per_page' => 2, 'post_type' => 'fcs_staffs' ) );
 	  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();   
   	  $temp_title = get_the_title($the_query->post->ID);
	  $temp_link = get_permalink( $the_query->post->ID ); 
	  
      //$temp_ex = get_the_excerpt();
        if ( has_post_thumbnail() ) {
			$temp_thumb = get_the_post_thumbnail($the_query->post->ID, 'fcs-slider');
			$temp_full_img = wp_get_attachment_url( get_post_thumbnail_id( $the_query->post->ID));
        } else {
        	$temp_thumb = '<img src="'.get_template_directory_uri() .'/library/img/portfolio-'. $columns .'-fallback.gif" alt="'. get_the_title() . '">';
        	$temp_full_img = get_template_directory_uri() .'/library/img/portfolio-'. $columns .'-fallback.gif';
        }
		
		$categories = get_the_term_list($the_query->post->ID , 'fcs_categories','',', ');
		$categories = !empty($categories) ? '<small>on</small> ' . strip_tags( $categories ) : '';

		$portfolio_lightbox = isset($smof_data['portfolio_slider_lightbox']) ? $smof_data['portfolio_slider_lightbox'] : '1';
		//$portfolio_link = isset($smof_data['portfolio_slider_link']) ? $smof_data['portfolio_slider_link'] : '1';

		$lightbox = '';
		//$single_link = '';

		if($portfolio_lightbox == '1'){
			$lightbox = '<a href="'. esc_url($temp_full_img) .'" class="detail-icon lightbox"><i class="fa fa-search"></i></a>';
		}

		//if($portfolio_link == '1'){
			//$single_link = '<a href="'. esc_url($temp_link) .'" class="detail-icon"><i class="fa fa-link"></i></a>';
		//}

		$output .= '<li class="carousel-item featuredWork">
                <div class="bg">
                    <div class="content">
                    	<div class="front">
                    		'.$temp_thumb.'
                   		</div>
						<div class="backCon">
                            <div class="back">
							<div class="hover-con">
                                <div class="hover-center">
                                <div class="header">
									<h3 class="title">'.esc_html($temp_title).'</h3>
									<div class="sep"></div>
                                </div>
                                <div class="describtion">
									<p class="category">'. $categories .'</p>
									<p class="yoxview">
										'. $lightbox .'
										'. $single_link .'
									</p>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>';
    
	endwhile; 
	
	else:
      $output = "No Portfolio Items Found.";
   	endif;
   
   wp_reset_query();
   return  $output;
}
add_shortcode('portfolio', 'portfolio');

//Portfolio Slider
function portfolio_slider($atts, $content = null){
	extract(shortcode_atts(array(
		"no_of_portfolio" => -1,
		"order_by" => 'menu_order', //date, title, rand, menu_order
		"portfolio_id" => '',
		"order" => 'asc', //desc
		"hover_effect" => 'hover-effect2',
		"columns" => 'col3',
		"title_tag" => 'h2',
		"title" => 'Featured Works',
		"auto_play" => 'false',
		"slide_duration" => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
	), $atts));

	$output = do_shortcode("[carousel_slider title='$title' animate='$animate' transition='$transition' duration='$duration' delay='$delay' title_tag='$title_tag' hover_effect='$hover_effect' columns='$columns' auto_play='$auto_play' slide_duration='$slide_duration'][portfolio no_of_portfolio='$no_of_portfolio' portfolio_id='$portfolio_id' order_by='$order_by' order='$order' columns='$columns'][/carousel_slider]");
	return $output;
}
add_shortcode('portfolio_slider', 'portfolio_slider');

//Staffs Loop
function staffs($atts, $content = null){
	extract(shortcode_atts(array(
	"no_of_staff" => -1,
	"order_by" => 'date', //date, title, rand
	"order" => 'asc', //desc
	"staff_id" => '',
	"columns" => 'col3',
	'order_by' => 'menu_order'
	), $atts)); 
	
		if($staff_id != ""){
		$staff_id= explode(',', $staff_id);
		}
		
		if($staff_id == ""){
	   	  $args = array(
			'post_type' => 'fcs_staffs',
			'orderby' => $order_by,
			'order' => $order,
			'posts_per_page' => $no_of_staff
			);
	   }
	   else{
			$args = array(
				'post_type' => 'fcs_staffs',
				'order' => $order,
				'orderby' => $orderby,
				'post__in' => $staff_id
			);   
	   }
	   
	   if($columns == 'col4')
	   		$shorten_length = 50;
	   else
	   		$shorten_length = 120;

	  $output ='';
	  $the_query = new WP_Query( $args );

 	  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();   
   	  $temp_title = get_the_title($the_query->post->ID);
      $temp_content = ShortenText(get_the_content($the_query->post->ID),$shorten_length); 
	  $temp_link = get_permalink($the_query->post->ID); 
	  
      //$temp_ex = get_the_excerpt();
        if ( has_post_thumbnail() ) {
			$temp_thumb = get_the_post_thumbnail($the_query->post->ID, 'fcs-slider');
        } else {
        	$temp_thumb = '<img src="'.get_template_directory_uri() .'/library/img/portfolio-'. esc_attr($columns) .'-fallback.gif" alt="'. the_title() . '">';
        }

		$meta = get_post_meta(get_the_id(),'staff_socail_links');
		if( !empty($meta))
		extract($meta[0]);
		$social_icons 	 = !empty($facebook)? '<a href="'. esc_url($facebook) .'" class="facebook"  title="Facebook"><i class="fa fa-facebook"></i></a> ' : '';
		$social_icons 	.= !empty($twitter) ? '<a href="'. esc_url($twitter)  .'" class="twitter" title="Twitter"><i class="fa fa-twitter"></i></a> ' : '';
		$social_icons	.= !empty($gplus) 	? '<a href="'. esc_url($gplus) 	 .'" class="gplus" title="Gplus"><i class="fa fa-google-plus"></i></a> ' : '';
		$social_icons	.= !empty($linkedin)? '<a href="'. esc_url($linkedin) .'" class="linkedin" title="LinkedIn"><i class="fa fa-linkedin"></i></a> ' : '';
		$social_icons 	.= !empty($dribble) ? '<a href="'. esc_url($dribble)  .'" class="dribble" title="Dribble"><i class="fa fa-dribbble"></i></a> ' : '';
		$social_icons	.= !empty($flickr) 	? '<a href="'. esc_url($flickr)   .'" class="flickr" title="Flickr"><i class="fa fa-flickr"></i></a> ' : '';
		
		$social_icons	.= !empty($single_staff) 	? '<a href="'. esc_url($single_staff)   .'" class="'.$temp_title.'" title="'.$temp_title.'"><i class="fa fa-link"></i></a> ' : '';
		
		$jobs = get_the_term_list($the_query->post->ID , 'fcs_jobs','',', ');
		$jobs = !empty($jobs) ? strip_tags( $jobs ) : '';
		$output .= '<li class="carousel-item featuredWork">
                <div class="bg">
                    <div class="content">
                    <div class="front">
                    		'.$temp_thumb.'
                   		</div>
						<div class="backCon">
                            <div class="back">
                            <div class="hover-con">
                                <div class="hover-center">
                                <div class="header">
                                <h3 class="title"><a href="'.$temp_link.'" >'.esc_html($temp_title).'</a></h3>
                                <small>'. $jobs .'</small>
                                <div class="sep"></div>
                                </div>
                                <div class="description">
                                    <p class="hidden-phone">'.esc_html($temp_content).'</p>
                                    <p class="socialIcons">
                                     '. $social_icons .'   
                                    </p>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>';
    
	endwhile; 
	
	else:
      $output = "No Staffs Details Found.";
   	endif;
   
   wp_reset_query();
   return  $output;
}
add_shortcode('staffs', 'staffs');

//Staff Slider
function staffs_slider($atts, $content = null){
	extract(shortcode_atts(array(
		"no_of_staff" => -1,
		"order_by" => 'menu_order', //date, title, rand, menu_order
		"order" => 'asc', //desc
		"staff_id" => '',
		"hover_effect" => 'hover-effect2',
		"columns" => 'col3',
		"title_tag" => 'h2',
		"title" => 'Our Team',
		"type"	=> 'staffs',
		"auto_play" => 'false',
		"slide_duration" => '',
		'animate' => '',
		'transition' => '',
		'duration' => '',
		'delay' => ''
	), $atts));

	$output = do_shortcode("[carousel_slider title='$title' animate='$animate' transition='$transition' duration='$duration' delay='$delay' title_tag='$title_tag' hover_effect='$hover_effect' columns='$columns' type='$type' auto_play='$auto_play' slide_duration='$slide_duration'][staffs no_of_staff='$no_of_staff' staff_id='$staff_id' order_by='$order_by' order='$order' columns='$columns'][/carousel_slider]");
	return $output;
}
add_shortcode('staffs_slider', 'staffs_slider');

function client($atts, $content = null){
	extract(shortcode_atts(array(
	'link' => '',
	'image_url' => '',
	'target' => '_blank'
	), $atts)); 

     $url_open = (!empty($link))  ? '<a href="'. esc_url($link) .'" target = "'.$target.'" >' : '';
     $url_close = (!empty($link))  ? '</a>' : '';

     if(!empty($image_url)){
     	$img = aq_resize($image_url, 153, null, true, true);

     	if($img){
     	    $img_url = $img;
     	}else{
     		$img_url = $image_url;
     	}
     	$output = '<li class="carousel-item">'. $url_open .'<img src="'. esc_attr($img_url) .'" alt="">'. $url_close .'</li>';
     }
     else{
     	$output = '<li class="carousel-item">'. $url_open .'<img src="'. get_template_directory_uri() .'/library/img/clients-fallback.gif" alt="">'. $url_close .'</li>';
     }
	
	return $output;
}
add_shortcode('client', 'client');

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function theme_gallery_shortcode($attr) {
	
	wp_enqueue_style('flexslider');
    wp_enqueue_script( 'flexslider-js' );
    wp_enqueue_script( 'gallery-script' );
	
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'li',
		'columns'    => 3,
		'size'       => 'large',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
		
	$size_class = sanitize_html_class( $size );
	$gallery_div = '<section class="gallery-container"><div id="'. $selector .'" class="flexslider gallery-slider"><ul class="slides">';
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {		
		add_filter('wp_get_attachment_image_attributes', 'unset', 10, 2);	
	
		$url = wp_get_attachment_url( $attachment->ID );
		$text = '';
		if ( trim( $text ) == '' )
			$text = $attachment->post_title;
		
		$crop = true; //resize but retain proportions
        $single = true; //return array
       		
        if(!empty($url)){
            $url_resize = aq_resize($url, 817, 400, $crop, $single);
            if(!$url_resize){
            	$url_resize = $url;
            }
		}
		$link = "$url_resize";

		$output .= "<{$itemtag}>";
		$output .= '<img src="'. $link .'">';
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '';
	}
	$output .= '</ul></div>';
	$output .= '<div class="carousel flexslider"><ul class="slides">';
	foreach ( $attachments as $id => $attachment ) {
		add_filter('wp_get_attachment_image_attributes', 'unsets', 10, 2);	
	
		$url = wp_get_attachment_url( $attachment->ID );
		if ( trim( $text ) == '' )
			$text = $attachment->post_title;
		
		$crop = true; //resize but retain proportions
        $single = true; //return array
       		
        if(!empty($url)){
            $url_resize = aq_resize($url, 140, 100, $crop, $single);
            if(!$url_resize){
            	$url_resize = $url;
            }
		}
		$link = "$url_resize";

		$output .= "<{$itemtag}>";
		$output .= '<img src="'. $link .'">';
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '';
	}

	$output .= '</ul></div><div class="sep"></div></section>';

	return $output;
}
add_shortcode('gallery', 'theme_gallery_shortcode');
function unsets ($attr, $attachment){
	unset($attr['alt']); // Just deleting the alt attr
	return $attr;
}