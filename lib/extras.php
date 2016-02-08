<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


// Gallery speciaal voor de product pagina. Die maakt een gallery aan in het extra tekst veld hier heb je dan een flexslider met fancybox beschikbaar


add_filter( 'post_gallery', __NAMESPACE__ . '\\my_post_gallery', 10, 2 );

function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;
    
	if (is_singular('product')):

	    static $instance = 0;
	    $instance++; 
	
	    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	    if ( isset( $attr['orderby'] ) ) {
	        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	        if ( !$attr['orderby'] )
	            unset( $attr['orderby'] );
	    }
		
		$posts_per_page = 3;
	
	    extract(shortcode_atts(array(
	        'order'      => 'ASC',
	        'orderby'    => 'menu_order ID',
	        'id'         => $post->ID,
	        
	        'itemtag'    => 'li',
	        'icontag'    => 'dt',
	        'captiontag' => 'dd',
	        'columns'    => 5,
	        
	        'size'       => 'partner-thumb',
	        'include'    => '',
	        'exclude'    => ''
	    ), $attr));
	
	    $id = intval($id);
	    if ( 'RAND' == $order )
	        $orderby = 'none';
	        

			
	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'posts_per_page' => $posts_per_page, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'posts_per_page' => $posts_per_page, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'posts_per_page' => $posts_per_page, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
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
	    $captiontag = tag_escape($captiontag);
	    $columns = intval($columns);
	    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	    $float = is_rtl() ? 'right' : 'left';
	
	    $selector = "gallery-{$instance}";
	
	    $output = apply_filters('gallery_style', "
	        <style type='text/css'>
	            #{$selector} {
	                margin: auto;
	            }
	            #{$selector} .gallery-item {
	                float: {$float};
	                margin-top: 10px;
	                text-align: center;
	                width: {$itemwidth}%;           }
	           
	            #{$selector} .gallery-caption {
	                margin-left: 0;
	            }
	        </style>
	        
	        <!-- see gallery_shortcode() in wp-includes/media.php -->
	        
	       
	        <div class='flexslider carousel' id='partner'> <ul class='slides'>");
	
	    $i = 0;
	    foreach ( $attachments as $id => $attachment ) {
	        $link_thumb =  wp_get_attachment_image_src($id, $size, false);
	       
			$link_full = wp_get_attachment_image_src($id,'full');
	        
	        $link = "<a href='$link_full[0]' class='fancybox' rel='gallery1'><img src='$link_thumb[0]' /></a>";
	        
	
	        $output .= "<{$itemtag} class='gallery-item'>";
	        $output .= "$link";
	        if ( $captiontag && trim($attachment->post_excerpt) ) {
	            $output .= "
	                <{$captiontag} class='gallery-caption'>
	                " . wptexturize($attachment->post_excerpt) . "
	                </{$captiontag}>";
	        }
	        $output .= "</{$itemtag}>";
	        //if ( $columns > 0 && ++$i % $columns == 0 )
	            //$output .= '<br style="clear: both" />';
	    }
	
	    $output .= "
	            
	        </ul</div>\n";	        
	
	else: 
	
	static $instance = 0;
	    $instance++; 
	
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
	        'itemtag'    => 'dl',
	        'icontag'    => 'dt',
	        'captiontag' => 'dd',
	        'columns'    => 3,
	        'size'       => 'thumbnail',
	        'include'    => '',
	        'exclude'    => ''
	    ), $attr));
	
	    $id = intval($id);
	    if ( 'RAND' == $order )
	        $orderby = 'none';
	
	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
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
	    $captiontag = tag_escape($captiontag);
	    $columns = intval($columns);
	    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	    $float = is_rtl() ? 'right' : 'left';
	
	    $selector = "gallery-{$instance}";
	
	    $output = apply_filters('gallery_style', "
	        <style type='text/css'>
	            #{$selector} {
	                margin: auto;
	            }
	            #{$selector} .gallery-item {
	                float: {$float};
	                margin-top: 10px;
	                text-align: center;
	                width: {$itemwidth}%;           }
	            #{$selector} img {
	                border: 2px solid #cfcfcf;
	            }
	            #{$selector} .gallery-caption {
	                margin-left: 0;
	            }
	        </style>
	        <!-- see gallery_shortcode() in wp-includes/media.php -->
	        <div id='$selector' class='gallery galleryid-{$id}'>");
	
	    $i = 0;
	    foreach ( $attachments as $id => $attachment ) {
	        $link =  wp_get_attachment_link($id, $size, false, false);
	
	        $output .= "<{$itemtag} class='gallery-item'>";
	        $output .= "
	            <{$icontag} class='gallery-icon'>
	                $link
	            </{$icontag}>";
	        if ( $captiontag && trim($attachment->post_excerpt) ) {
	            $output .= "
	                <{$captiontag} class='gallery-caption'>
	                " . wptexturize($attachment->post_excerpt) . "
	                </{$captiontag}>";
	        }
	        $output .= "</{$itemtag}>";
	        if ( $columns > 0 && ++$i % $columns == 0 )
	            $output .= '<br style="clear: both" />';
	    }
	
	    $output .= "
	            <br style='clear: both;' />
	        </div>\n";

	    
	endif;
	
	
	return $output;
}


add_filter( 'get_the_archive_title', function ( $title ) {

    if( is_category() ) {

        $title = single_cat_title( '', false );

    }
    
    elseif( is_archive() ) {

     	$title = post_type_archive_title( '', false );

    }

    return $title;

});
