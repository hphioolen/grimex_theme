<?php

/*

* Features landing
* pagina onderdeel, boven de footer, custom post onderdelen (herhaling van de features)
* Daarboven een extra onderdeel van de pagina voor het weergeven van pagina onderdelen die specifiek voor de landingspagina gelden.



	
*/
	
?>

<?php //alle metadaata
			$postId = get_the_ID ();
			$meta = get_post_custom( $postId ); 
	
	//in de footer extra enfotmatie over de rest van de onderneming
	  		$extra_title    					= (isset($meta['wpcf-extra-titel'][0])? $meta['wpcf-extra-titel'][0] : "");
	  		$extra_content  					= (isset($meta['wpcf-intro-tekst-landing'][0])? $meta['wpcf-intro-tekst-landing'][0] : "");

	  		$extra_afbeelding  					= (isset($meta['wpcf-extra-afbeelding'][0])? $meta['wpcf-extra-afbeelding'][0] : "");
	  		 			  		 
	  		
	  	  		 	  		 
?>

<div class="clearfix" id="extra_landing">

		  <div class="container">		  
			  
		  	<div class="row">
		  		
		  		<section class="feature col-sm-8">
			  	
			  	<?php if ($extra_afbeelding != ""): ?>
			  	
			  		<?php $image_id = newfish_get_image_id($extra_afbeelding) ?>
			  		<?php $image_thumb = wp_get_attachment_image_src($image_id, 'landing-image'); ?>
			  		<img src="<?= $image_thumb[0]; ?>" />
			  		
			  	<?php endif; ?>
		  		</section>
		  		
		  		<section class="feature col-sm-4">
			  		<h2><?= $extra_title ?></h2>
			  		<?php
				  						  		
				  		$content = apply_filters('the_content', $extra_content);
				  		$content = str_replace(']]>', ']]&gt;', $content);
				  		
			  		?>
			  		<?= $content; ?>
			  		
			  		<a class="btn btn-primary various" href="#inline">Informatiemagazine</a>
		  		</section>
		  		
		  	</div>

		  </div>
</div>
<?php 

query_posts( array( 'post_type' => 'feature', 'posts_per_page' => 3, ) );
		
	if ( have_posts() ) : $count = 0; ?>    
	
	  
	  <div class="clearfix" id="features">
<!-- 		  <h2 class="text-center">Services</h2> -->
		  <div class="container">		  
				  
			  	<h2>Onze Expertise</h2>
			  
		  	<div class="row">
	    	
				<?php while ( have_posts() ) : the_post(); $count++; ?>
					
					<?php $title = get_the_title(); 
					$key_1_value = get_post_meta( get_the_ID(), 'wpcf-url', true );
					$icon = get_post_meta( get_the_ID(), 'wpcf-icon', true ); ?>
					
					<section class="feature col-sm-4">

						
						<h3>
						<?php 
							if( ! empty( $key_1_value ) ) {
									echo "<a href='$key_1_value' title='$title'> $title</a>";
								}else{
									the_title();	
								} ?>
						</h3>
						
						<?php the_excerpt(); ?>
						<?php 
						
						if( ! empty( $key_1_value ) ) {
						  
						 // echo "<a class='read-more btn btn-danger' href='$key_1_value' title='$title'>Lees verder</a>";
						  
						} 
						?>
						
						
					</section>
					<?php if ($count==4){
						echo '</div><div class="row">';
					}
					?>
				<?php endwhile; ?>
		  	</div>	
		  </div>
	  </div>

<?php endif; ?>			    		
<?php wp_reset_query(); ?>