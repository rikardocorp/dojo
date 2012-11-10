<?php
/*
Template Name: rick-blog
*/
?>

<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); //cambiamos <meta charset="utf-8"> por su   ?>" />
	<title><?php
        /*Con este código agregamos a wordpress un titulo que cambia dependiendo 
        * del lugar donde te encuentres en el blog. También puede utilizar <?php bloginfo('name'); ?>
        * Muestra en la etiqueta <title> el nombre de lo que esta viendo, la forma en la que lo estamos creando
        * es mucho más amigable para los navegadores ya que muestra información de cada lugar que estés.
        */
        global $page, $paged;
 
        wp_title( '|', true, 'right' );
 
        // Agrega el nombre del blog.
        bloginfo( 'name' );
 
        // Agrega la descripción del blog, en la página principal.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
 
        // Agrega el número de página si es necesario:
        //if ( $paged >= 2 || $page >= 2 )
        //echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
        ?>
   </title>
	
	<!--<link href='<?= get_template_directory_uri().'/css/slider.css' ?>' rel="stylesheet" />-->
	<link href='<?php bloginfo( 'stylesheet_url' ); ?>' rel="stylesheet" />
	<link href='<?= get_template_directory_uri().'/css/blog.css' ?>' rel="stylesheet" />
	<!--[if IE]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php	wp_head(); ?>

	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/slider.js"></script>-->
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
				<!--<ul>
					<li><a href="index.html">Principal</a></li>
					<li><a href="#">Historia</a></li>
					<li><a href="#">Actividades</a></li>
					<li><a href="#">Fotos</a></li>
					<li><a href="#">Contáctenos</a></li>
					<li><a href="blog.html">Blog</a></li>
				</ul>-->
			</div>
			
		</nav>
		<section id="entradas">
			<div class="content">
				<div class="posts">	
				<?php // para buscar por fechas -- $today = getdate();$query = new WP_Query( 'year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"] );?>
				<?php $cen = 1;?>
				<?php if ( is_page('fotos')) : $consulta ='category_name=fotos';	?>				
				<?php elseif( is_page('videos')) : $consulta ='category_name=videos'; ?>
				<?php elseif( is_page('eventos')) : $consulta ='category_name=eventos'; ?>
				<?php elseif( is_page('informacion')) : $consulta ='category_name=informacion'; ?>
				<?php elseif( is_page('blog')) : 
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$consulta ="category_name=fotos,videos,eventos,informacion&posts_per_page=8&paged=$paged"; ?>
				<?php else: $cen = 0; ?>
				<?php endif;?>
					
			<?php if ( $cen == 1) : 
				  	query_posts($consulta);
				  	if(query_posts($consulta)!=NULL):
				  		//print_r(query_posts($consulta));
			      		while ( have_posts() ) : the_post(); 
				      		$categoria = get_the_category($post->ID);
							$cate = $categoria[0]->cat_name;?>
				  		<article class="post">
				  			<div class="datos">
				  				<a href="#" class="tipo video"><?php echo $cate;?></a>
				  				<span class="n-coment"><?php comments_number( '0', '1', '%' ); ?></span>
				  			</div>
				  			<div class="entrada">
				  				<h2 class="titulo"><?php the_title(); ?></h2>
				  				<h3 class="date"><?php the_time('l j F Y') ?> | <?php the_time('g:i a'); ?> <?php the_author() ?> <?php $key="estado"; echo get_post_meta($post->ID, $key, true); ?></h3>
				  				<hr>
				  				<?php the_content(); $timestamp  = get_post_time('U', true); echo $timestamp;?>
				  				
				  				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="mas-info">Seguir leyendo</a>
				  			</div>
				  		</article>
			<?php 		endwhile; 
						// Reset Post Data
						wp_reset_postdata();
				  	else: $cen = 0; 
				  	endif;
				  endif;?>
			
			<?php if ( $cen == 0) : ?>
					<article class="post">
						<div class="datos">
							<a href="#" class="tipo video"></a>
							<span class="n-coment">67</span>
						</div>
						<div class="entrada">
							<h2 class="titulo">Lo sentimos, no se han encontrado entrada</h2>				
						</div>
					</article>
			<?php endif; $hace = new haceTanto('2012-02-22 18:42:00','i'); echo 'Hace'.$hace;?>
			<center>
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
			</center>
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