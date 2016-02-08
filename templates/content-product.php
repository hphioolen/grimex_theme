<article <?php post_class('col-md-6'); ?>>
	
	<a href="<?php the_permalink(); ?>">
		<div class="product-description-content">
		  <div class="entry-thumbnail">
			  <?php if ( has_post_thumbnail() ) {
			  	
			  		the_post_thumbnail('product-image');
			  							
			  	} else {
			  		echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/assets/img/thumbnail-default.png" />';
			  	}
			  ?>
			  
		  </div>
		  <div class="content-text">
		    <header>
		    <h2 class="entry-title"><?php the_title(); ?></h2>
		    
		  </header>
		    <div class="entry-summary">
				<?php the_excerpt(); ?>
		    </div>
		  </div>
		</div>
	</a>
</article>
