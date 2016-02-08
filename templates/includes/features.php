<?php 

query_posts( array( 'post_type' => 'feature', 'posts_per_page' => 3, ) );
		
	if ( have_posts() ) : $count = 0; ?>    
	
	  
	  <div class="clearfix" id="features">
<!-- 		  <h2 class="text-center">Services</h2> -->
		  <div class="container">
		  	<div class="row">
	    	
				<?php while ( have_posts() ) : the_post(); $count++; ?>
					
					<?php $title = get_the_title(); 
					$key_1_value = get_post_meta( get_the_ID(), 'wpcf-url', true );
					$icon = get_post_meta( get_the_ID(), 'wpcf-icon', true ); ?>
					
					<section class="feature col-sm-4 text-center">
					
					<?php 
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							
							//the_permalink();
							if( ! empty( $key_1_value ) ) {
								echo "<a href='$key_1_value' title='$title'>";
								the_post_thumbnail('feature-size');
								echo "</a>";
							}else{
								the_post_thumbnail('feature-size');
							}
					} ?>
	
<!--
						<a class="icons" href="<?= $key_1_value ?>">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa <?= $icon ?> fa-stack-1x fa-inverse"></i>
						</span>
						</a>
-->
						
						<h3>
						<?php 
							if( ! empty( $key_1_value ) ) {
									echo "<a href='$key_1_value' title='$title'> $title</a>";
								}else{
									the_title();	
								} ?>
						</h3>
						
						<?php the_content(); ?>
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