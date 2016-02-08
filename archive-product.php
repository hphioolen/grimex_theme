<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php // get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>


<?php 	$post_type = get_post_type( get_the_ID() ); 
		$taxonomy = 'product-categorie';
?>

<div class="row">

	<?php
	
	//Functie om alleen posts op te halen die een categorie hebben of geen categorie hebben, maar NIET een child categorie zijn
	//eventueel is deze uit te bereiden door alle categorieen eerst op te halen en alle posts daar juist weer IN te stoppen. 
	
	
	$myterms = get_terms( $taxonomy, array( 'parent' => 0 ) );
	
	$unwanted_post_ids = "";
	
	foreach($myterms as $term){
		
		$taxonomy_term_id = $term->term_taxonomy_id;
		
		$unwanted_children = get_term_children($taxonomy_term_id, $taxonomy);
		$unwanted_post_ids_object = get_objects_in_term($unwanted_children, $taxonomy);
		foreach($unwanted_post_ids_object as $unwanted_post_id){	
			$unwanted_post_ids[] = $unwanted_post_id;
		}
	}
	
		$args = array( 	'post_type' => $post_type,
						'posts_per_page' => -1,
						'post__not_in' => $unwanted_post_ids
						
					 );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
		  
		 get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
		  	  
		  
		endwhile;
	?>
</div>
