<?php get_header(); ?>
		<section id="encuentranos">
			<h3 class="titu">
				<span class="content">Encuentranos</span>
			</h3>
			<div class="content">
				<img id="map" src="http://maps.googleapis.com/maps/api/staticmap?size=465x319&amp;maptype=roadmap&amp;markers=color:red%7Ccolor:red%7C-18.002966,-70.240314&amp;zoom=17&amp;sensor=false">
			</div>					
		</section>
		<section id="content" role="main">		

<?php if ( have_posts() && !is_home() ) : while ( have_posts() ) : the_post(); ?>
<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
<?php the_title(); ?></a></h2>
<?php the_content(); ?>
<?php the_time('F jS, Y') ?>
<?php the_author() ?>
<?php endwhile; elseif(!is_home()): ?>Lo sentimos, no se han encontrado entradas.
<?php endif; ?>


		</section>
<?php get_footer(); ?>