<?php use Roots\Sage\Titles; ?>

<?php if (!(is_front_page()) && !(is_single()) && !(is_404()) ): ?>
	<section class="promo section">
		<div class="container text-center">                
		  	<h2 class="title"><?= Titles\title(); ?> </h2>
		  	<!--<p class="intro">Lorem ipsum dolor sit amet consectetuer adipiscing elit massa sociis natoque penatibus et magnis dis parturient montes</p>-->
		</div><!--//container-->
	</section><!--//promo-->
<?php endif; ?>
