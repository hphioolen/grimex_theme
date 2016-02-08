<?php
/**
 * 		Gallerij voor producten pagina
 *		beschrijving van de producten gallerij
 *		laag met sub categorieen
 * // javascript in _main.js 
 */
	global $wp_query, $post, $panel_error_message;

	
	$featposts  = 10;
	
	
?>

<?php  
	$slides = get_posts(array('post_type' => 'partners', 'numberposts' => $featposts, 'suppress_filters' =>0)); 	
?>
<!-- laag met slider items zoals op de voorpagina met logo's -->
<footer class="logos">
	<?php 
				$titelSlider = types_render_field("product-slider-titel", array("output"=>"raw"));
			 
				//Output the trainer email
				
				if ($titelSlider != ""){echo "<h2>$titelSlider</h2>";} 	

	
	 // deze render field wordt door een functie in Functions.php aangepast om een lijst te maken ipv een WP gallerij. beneden staat wel javascript call	 
	 $trainer_email_address = types_render_field("product-slider", array("output"=>"raw"));
 
	//Output the trainer email
	 
	echo $trainer_email_address;
	?>

		
</footer>

<footer class="beschrijving">
		
	<div class="container">
		<?php
			$titelBeschrijving = types_render_field("product-slider-beschrijving-titel", array("output"=>"raw"));
			 
			//Output the trainer email
				
			if ($titelBeschrijving != ""){echo "<h2>$titelBeschrijving</h2>";} 
		?>
		<div class="row">
			<div class="col-sm-6 beschrijving-links">
				<?php 
				
				
			 	 
				 $descriptionLinks = types_render_field("product-slider-beschrijving-links", array("output"=>"raw"));
			 
				//Output the beschrijving
				 
				echo $descriptionLinks;				
				
			?>
				<a class="formulierButton" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				 <!-- hard coded niet in CMS: gallery-product.php -->
				  Ook ge&iuml;nteresseerd in onze producten? <i class="fa fa-arrow-circle-o-right"></i>

				</a>
				
				<div class="collapse" id="collapseExample">
				  <div class="well">
				    <?php gravity_form( 1, false, false, false, '', false ); ?>
				  </div>
				</div>
			</div>
			<div class="col-sm-6">
			<?php  	 
				 $descriptionRechts = types_render_field("product-slider-beschrijving-rechts", array("output"=>"raw"));
			 
				//Output the beschrijving
				 
				echo $descriptionRechts;
				
			?>
			</div>
		</div>
		
	</div>	

</footer>

<section class="kiezen-ook">
	<div class="container">
			<?php
				 // Haal de termen op voor BS Selectie om te gebruiken voor soortgelijke projecten
				 // mag verbeterd worden omdat nu alle kinderen worden opgehaald en niet alleen maar 1 laag...
								 
								   
				 $terms = get_the_terms( $post->ID, 'product-categorie' );
				
					if ( $terms && ! is_wp_error( $terms ) ) : 
		
					$terms_tax = array();
				
					foreach ( $terms as $term ) {
						$terms_tax[] = $term->name;
						$termID[] = $term->term_id;
					}
	
					endif;
				   				    
				   if (isset($termID)){
					   $termchildren = get_term_children( $termID[0], 'product-categorie' );
					   if (!empty($termchildren)) {
						   // echo '$var is either 0, empty, or not set at all';
							
					   ?>
					   <div class='row'>
					   <h3 class='overige-producten-titel text-center'>Gerealiseerde <?php the_title(); ?> projecten</h3>
					   <?php
				   
				   
					$taxargs =array(
					    'showposts' => -1,
					    'post_type' => 'product',
					    'tax_query' => array(
					        array(
					        'taxonomy' => 'product-categorie',
					        'field' => 'id',
					        'terms' => $termchildren
					    ),
					    'orderby' => 'title',
					    'order' => 'ASC')
					);
									
					$blauweschuittax = get_posts(  $taxargs );
				        foreach ( $blauweschuittax as $post ) : setup_postdata( $post ); ?>
				            <div class="col-md-4"><a href="<?php the_permalink(); ?>">
				            		<?php 
			           		if ( has_post_thumbnail() ) {
								the_post_thumbnail('product-image');
							
							} else {
							
								echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/assets/img/thumbnail-default.png" />';
			            	}?>
				            	<br>
				            	<?php the_title()?>
				            	
				            	</a>
				            </div>
				            
				        <?php endforeach; 
					    echo "</div>"; 
					    }
					   }     
					wp_reset_postdata();
					?>
	</div>
</section>
