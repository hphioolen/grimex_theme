<?php
/**
 * Template Name: Landings pagina
 */
?>

<?php while (have_posts()) : the_post(); ?>
 
  <?php get_template_part('templates/content', 'page-landing'); ?>
<?php endwhile; ?>
