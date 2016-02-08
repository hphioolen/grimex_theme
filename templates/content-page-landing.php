<?php //alle metadaata
	
			global $postId;
			global $metal;
			$postId = get_the_ID ();
			$meta = get_post_custom( $postId ); 
				  	  		  			  		 
	  		
	  		//aanbieder Meta	  		 
	  		//in de top afbeelding 2 regels tekst
	  		$featured_title  					= (isset($meta['wpcf-featured-titel'][0])? $meta['wpcf-featured-titel'][0] : "");
	  		$featured_content 					= (isset($meta['wpcf-features-extra-regel-tekst'][0])? $meta['wpcf-features-extra-regel-tekst'][0] : "");
	  		
	  		// van voor prijs in de intro 
			$van_prijs  					= (isset($meta['wpcf-van-voor-prijs'][0])? $meta['wpcf-van-voor-prijs'][0] : "");
			$voor_prijs   					= (isset($meta['wpcf-prijs'][0])? $meta['wpcf-prijs'][0] : "");	  		

	  		//in de content een extra afbeelding?
	  		$featured_afbeelding   					= (isset($meta['wpcf-aanbiedingsafbeelding'][0])? $meta['wpcf-aanbiedingsafbeelding'][0] : "");
	  		 
	  		 // retrieves the attachment ID from the file URL
			function newfish_get_image_id($image_url) {
				global $wpdb;
				$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
			        return $attachment[0]; 
			}

	  			  		 	  		 
?>


<div class="row">

<?php if (	$featured_afbeelding != ""): ?>
	<div class="col-sm-7">
		 <?php get_template_part('templates/page', 'header'); ?>
		  <?php the_content(); ?>
		  
		  <?php if ($van_prijs!='') echo "<span class='van_prijs'>€ $van_prijs </span>";?> 

		 <?php if ($voor_prijs!='') echo "<span class='voor_prijs'>€ $voor_prijs </span>";?>
		
		 <a class="btn btn-warning various" href="#inline">Koop nu</a>
	</div>
		<div class="col-sm-4 col-sm-offset-1">
  	
			  	
			  		<?php $image_id = newfish_get_image_id($featured_afbeelding) ?>
			  		<?php $image_thumb = wp_get_attachment_image_src($image_id, 'landing-image-right'); ?>
			  		<img src="<?= $image_thumb[0]; ?>" />
			  				
		  
	</div>
	<?php else: ?>
	<div class="col-sm-12">
		 <?php get_template_part('templates/page', 'header'); ?>
		  <?php the_content(); ?>
		  
	</div>
	<?php endif; ?>
</div>



<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>