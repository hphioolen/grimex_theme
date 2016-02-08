<?php
/**
 * 		Partner Slider
 * // javascript in _main.js 
 */
	global $wp_query, $post, $panel_error_message;

	
	$featposts  = 5;
	
	
?>

<?php  
	$slides = get_posts(array('post_type' => 'partners', 'numberposts' => $featposts, 'suppress_filters' =>0)); 	
?>


<footer class="logos">
	<div class="container">
		
		<?php if (( count($slides) > 0 )) { ?>
		
			   <div class="flexslider carousel" id="partner">
			   <ul class="slides">
		           
		            <?php foreach($slides as $post) : setup_postdata($post);/*  $count++; */ ?>    
			            
			            <li>
			        		
		    	    		<?php 
								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
																
										the_post_thumbnail('partner-thumb');
									}
							?>
			            	            	
			            </li><!--/.slide-->
			            
					<?php endforeach; ?> 
					</ul>
			    </div>
		<?php }?>
	</div>
</footer>



<script type="text/javascript" charset="utf-8">
 
	(function($) {
		 		  
		  // store the slider in a local variable
		  var $window = $(window),
		      flexslider;
		 
		  // tiny helper function to add breakpoints
		  function getGridSize() {
		    return (window.innerWidth < 600) ? 1 :
		           (window.innerWidth < 900) ? 3 : 3;
		  }
		 
		 
		  $window.load(function() {
		    $('#partner').flexslider({
		      animation: "slide",
		      animationLoop: true,
		      itemWidth: 210,
		      itemMargin: 5,
		      controlNav: false,
		      minItems: getGridSize(), // use function to pull in initial value
		      maxItems: getGridSize(), // use function to pull in initial value
		      start: function(slider){
				flexslider = slider;
				}
		    });
		  });
		 
		  // check grid size on resize event
		  $window.resize(function() {
		    var gridSize = getGridSize();
		 
		    flexslider.vars.minItems = gridSize;
		    flexslider.vars.maxItems = gridSize;
		  });

		
	})(jQuery);  
	  
</script>
