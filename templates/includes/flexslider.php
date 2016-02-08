<?php /**
 * 		Homepage Slider
 * // javascript in _main.js 
 */
	global $wp_query, $post, $panel_error_message;
	
	//laad de slides in.
	$slides = get_posts(array('post_type' => 'slide', 'suppress_filters' =>0 )); 

if (( count($slides) == 1 )) { ?>

	  <?php foreach($slides as $post) : setup_postdata($post); ?> 
	 
	 <?php if ( has_post_thumbnail() ) {
		    		
		    		$thumbnail_id = get_post_thumbnail_id($post->ID);
					$thumbnail_object = get_post($thumbnail_id);					
					$background_image = $thumbnail_object->guid;
		    							
		    	}
		    ?>
			
		<?php endforeach; ?> 
	

		<div class="header-holder">
				
		    <div id="header" class="header" style="background-image: url(<?=$background_image?>); "></div>
		
		</div>

<?php } else if (( count($slides) > 1 )) { ?>
		
	
			<div class="flexslider" id="mainslider">
			  <ul class="slides">
			  
			  	
			  	<?php foreach($slides as $post) : setup_postdata($post); ?> 
	 
				 <?php if ( has_post_thumbnail() ) {
					    							    		    		
					    		$thumbnail_id = get_post_thumbnail_id($post->ID);
								$thumbnail_object = get_post($thumbnail_id);
								$background_image = $thumbnail_object->guid;
								
								$thumb = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail');
								$url = $thumb[0];
								
					}?>
					
					<li class="slide" style="background-image: url(<?=$background_image?>); " data-thumb="<?= $url; ?>" >
						<div class="imageOverlay"></div>
						<div class="container flex-caption">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</div>
					 </li>
						
					<?php endforeach; ?> 
	  
			  </ul><!-- Hard coded content -->
			  <div class="reclameLaag">
	  				
					<div class="content-holder">
						<div class="content">
							<a class="featuredHeaderTxt" href="http://www.solarlux-vouwwanden.nl/nieuws/het-zekere-voor-het-onzekere/">
								<h4 class="featuredHeaderTitle">ACTIE</h4>
								<p class="featuredHeaderSubtitle">Tot 31-01-2016 gratis anti- inbraakpakket!</p>
							</a>
						</div>
				    </div>								 
				</div
			</div>
			</div>
			
			


<script type="text/javascript" charset="utf-8">
 
	(function($) {
		 
		 $( document ).ready(function() {	
		     $("#mainslider").flexslider();
		});
		
	})(jQuery);  
	  
</script>

<?php }  // else { } default image ????, die zou dan in de image folder kunnen. ?>
	

