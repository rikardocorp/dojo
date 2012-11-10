<?php
/*
Template Name Posts: rick-post
*/
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); //cambiamos <meta charset="utf-8"> por su   ?>" />
	<title><?php
        global $page, $paged; 
        wp_title( '|', true, 'right' ); 
        // Agrega el nombre del blog.
        bloginfo( 'name' ); 
        // Agrega la descripción del blog, en la página principal.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
        ?>
   </title>
	
	<link href='<?= get_template_directory_uri().'/css/blog.css' ?>' rel="stylesheet" />
	<link href='<?php bloginfo( 'stylesheet_url' ); ?>' rel="stylesheet" />
	<link href='<?= get_template_directory_uri().'/css/post.css' ?>' rel="stylesheet" />
	<!--[if IE]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php	wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<section id="wrapper">
		<header>
			<div class="content">
				<img src="<?= get_template_directory_uri()?>/images/dojo.png"/>	
				<h1>WORLD KARATE ORGANIZATION <br><span>SHINKYOKUSHINKAI</span> <br>Per&uacute;</h1>
			</div>
		</header>
		<nav>
			<div class="content">
				<?php wp_nav_menu(array('theme_location'=>'MenuPrincipal','container'=>'false')); ?>
			</div>
		</nav>
		<section id="entradas">
			<div class="content">
				<div class="posts">							
			<?php  	if(have_posts()):
				  		//print_r(query_posts($consulta));
			      		while ( have_posts() ) : the_post(); ?>
				  		<article class="post">
				  			<div class="datos">
				  				<a href="#" class="tipo video"></a>
				  				<span class="n-coment"><?php comments_number( '0', '1', '%' ); ?></span>
				  			</div>
				  			<div class="entrada">
				  				<h2 class="titulo"><?php the_title(); ?></h2>
				  				<h3 class="date"><?php the_time('l j F Y') ?> | <?php the_time('g:i a'); ?> <?php the_author() ?> <?php $key="estado"; echo get_post_meta($post->ID, $key, true); ?></h3>
				  				<hr>
				  				<div class="post-contenido">
						            <?php the_content(); ?>
						            <p class="post-metadata">
						                <?php _e('Archivado en:'); ?> <?php the_category(', ') ?> <?php _e('Escrito por:'); ?> <?php  the_author(); ?><br />
						                <?php comments_popup_link('Sin Comentarios', '1 Comentario', '% Comentario'); ?> <?php edit_post_link('Editar', ' &#124; ', ''); ?>
						            </p>
						        </div>
						        
				  			</div>
				  		</article>
				  		
			<?php 		endwhile; ?>
						<div class="post-comentarios">
							<?php comments_template(); ?>
						</div>
						<div class="paginador">
					        <?php previous_post_link('< %link') ?> <?php next_post_link(' %link >') ?>
					    </div>
						<!-- Reset Post Data-->
			<?php		wp_reset_postdata();
				  	endif;?>
				</div>				
			<?php get_sidebar(); ?>	
			</div>	
		</section>
		<footer>
			<div class="content">
				<p>World Karate Organitation</p>
				<p>Shinkyyoushinkai Per&uacute;</p>
			</div>
		</footer>
	</section>
</body>
</html>