<?php if (is_home() || is_front_page()): ?>

	<?php 	get_template_part('templates/includes/partner-flexslider'); ?>

<?php elseif (is_singular('product')): ?>

	<?php 	get_template_part('templates/includes/galery-product'); ?>

<?php elseif (is_page_template( 'template-landing.php' )): ?>


	<?php 	get_template_part('templates/includes/features-landing'); ?>

<?php endif; ?>