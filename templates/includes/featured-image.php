<?php use Roots\Sage\Titles; ?>
<?php
/**
 * 		Homepage Slider
 * // javascript in _main.js 
 */
	global $wp_query, $post, $panel_error_message;
	global $meta;
	
?>

<?php 
	
			$postId = get_the_ID ();
			$meta = get_post_custom( $postId ); 
	
	//in de footer extra enfotmatie over de rest van de onderneming
	  		$extra_title    					= (isset($meta['wpcf-extra-titel'][0])? $meta['wpcf-extra-titel'][0] : Titles\title());
	  		$extra_content  					= (isset($meta['wpcf-features-extra-regel-tekst'][0])? $meta['wpcf-features-extra-regel-tekst'][0] : "");



	if ( has_post_thumbnail() ) {
		
	  	$HeaderImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

	} else {
		 $HeaderImage = get_template_directory_uri() . '/dist/images/default_header.jpg';                                               
	}
?>

<div class="header-holder">
			
	<div id="imageHeader" class="imageHeader" style="background-image: url(<?=$HeaderImage?>); ">
		<div class="container"> 
			<section class="content">
				<h1><?= $extra_title; ?></h1>
				<p><?= $extra_content; ?></p>
			</section>
		</div>
		  
	</div>
</div>		    