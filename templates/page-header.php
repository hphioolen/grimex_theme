<?php use Roots\Sage\Titles; ?>

<div class="page-header">
  
<?php if (is_home() || is_front_page()): ?>
	  <h1><?=  Titles\title(); ?></h1>
<?php  endif; ?>
  
</div>
<div class="header-intro">
<?php 
	
	if (is_archive()) {
     $obj = get_post_type_object( get_post_type() );
	 echo $obj->description;
  }
	
?>
</div>