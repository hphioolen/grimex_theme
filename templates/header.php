<!--
<header class="contact-info">
  <div class="container">
	  Kernweg 18, 1627 LH, HoornInfo@akuflex.nl0229-217913
  </div>
</header>
-->
<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      	<?php 
	      	$logo = get_template_directory_uri() . '/dist/images/logo.png';
			$mobilelogo = get_template_directory_uri() . '/dist/images/logo.png';
		?>
      <a id="logo" href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'description' ); ?>">		    	
	    	<img class="hidden-xs" src="<?= $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
	    	<img class="visible-xs" src="<?= $mobilelogo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
	    			    	
	    </a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
      endif;
      ?>
    </nav>
  </div>
</header>

<?php if (is_home() || is_front_page()):
	
	get_template_part('templates/includes/flexslider'); ?>
	
		<div class="breadcrumbHolder">
		
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						
					</div>
					<div class="col-sm-4 text-right">
						<a class="btn btn-primary various" href="#inline">Informatiemagazine</a>
					</div>
				</div>
			</div>
		
		</div>	
		
			
		<?php	get_template_part('templates/includes/features');?>
		
<?php else: ?>	
		<?php get_template_part('templates/includes/featured-image'); ?>

		<div class="breadcrumbHolder">
		
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<?php if ( function_exists('yoast_breadcrumb') ) {
						  yoast_breadcrumb('<p id="breadcrumbs">','</p>');			
						} ?>
					</div>
					<div class="col-sm-4 text-right">
						<a class="btn btn-primary various" href="#inline">Informatiemagazine</a>
						
					</div>
				</div>
			</div>
		
		</div>	

<?php endif; ?>

<!-- inline Gravity form voor call-to-action -->
<div id="inline" style="width: 500px; display: none;">
		<?php gravity_form( 2, true, true, false, '', true ); ?>	
</div>