<?php $base_url = get_template_directory_uri(); ?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); //cambiamos <meta charset="utf-8"> por su   ?>" />
	<? //evitar algo de contenido duplicado al decirle a los spiders que no indexen todo el contenido.?>
	<?php if((is_home() && ($paged < 2 )) || is_single() || is_page() || is_category()){
	    echo '<meta name="robots" content="index,follow" />';
	} else {
	    echo '<meta name="robots" content="noindex,follow" />';
	} 
	?>
	
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

        ?>
   </title>
    <link rel="shortcut icon" href="<?php echo $base_url; ?>/images/favicon.ico" />
	<link href='<?php echo $base_url.'/css/slider.css' ?>' rel="stylesheet" />
	<link href='<?php bloginfo( 'stylesheet_url' ); ?>' rel="stylesheet" />
	
	<!--[if IE]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php	wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<section id="wrapper">
		<nav>
			<div class="content">
				<?php wp_nav_menu(array('theme_location'=>'MenuPrincipal','container'=>'false')); ?>
			</div>	
		</nav>
		<header>
			<div class="content">
				<section id="slider" class="slider">
					<div class="figures cycler cf">
						<figure class="active"><img src="<?= $base_url.'/images/slide5.jpg' ?>" alt="" /></figure>
						<figure><img src="<?= $base_url.'/images/slide6.jpg' ?>" alt="" /></figure>
						<figure><img src="<?= $base_url.'/images/slide1.jpg' ?>" alt="" /></figure>
						<figure><img src="<?= $base_url.'/images/slide2.jpg' ?>" alt="" /></figure>
						<figure><img src="<?= $base_url.'/images/slide3.jpg' ?>" alt="" /></figure>
						<figure><img src="<?= $base_url.'/images/slide4.jpg' ?>" alt="" /></figure>
					</div>
				</section>
				<div id="logo">
					<img src="<?= $base_url.'/images/logo.png' ?>"/>
					<h1>ORGANIZACION DE KARATE <br><span>SHINKYOKUSHINKAI</span> <br>Per&uacute;<img class="peru" src="<?= $base_url.'/images/peru.png' ?>" /></h1>
				</div>
				<div id="tabs">
					<?php $classCat = array('white','gray','red'); $i=0; ?>
					<?php query_posts('category_name=servicios&posts_per_page=3&order=ASC' );
					while ( have_posts() ) : the_post(); ?>  
						<div class="<?= $classCat[$i]?>">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); $i++;?>
						</div><!-- end of item" --> 
					<?php endwhile; wp_reset_query(); ?>
				</div><!-- end of featured -->
				
			</div>
		</header>
