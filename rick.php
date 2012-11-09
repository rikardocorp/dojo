<?php
/*
Template Name: rick
*/
?>

<?php get_header(); ?>

<div id="content" class="widecolumn">

 <?php if (have_posts()) : while (have_posts()) : the_post();?>
 <div class="post">
  <h2 id="post-<?php the_ID(); ?>"><?php the_title();?></h2>
  <div class="entrytext">
   <?php the_content(); ?>
  </div>
 </div>
 <?php endwhile; endif; ?>
 <?php edit_post_link('Editar esta entrada.', '<p>', '</p>'); ?>

</div>
<div id="main">

<?php //include (TEMPLATEPATH . '/searchform.php'); ?>

<h2>Archivos por Meses:</h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>

<h2>Archivos por Categorías:</h2>
  <ul>
     <?php wp_list_cats(); ?>
  </ul>

</div>
<?php get_footer(); ?>