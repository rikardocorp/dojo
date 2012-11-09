<div id="contenido">
    <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
 
    <div class="post" id="post-<?php the_ID(); ?>">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
 
        <div class="post-contenido">
            <?php the_content(); ?>
            <p class="post-metadata">
                <?php _e('Archivado en:'); ?> <?php the_category(', ') ?> <?php _e('Escrito por:'); ?> <?php  the_author(); ?><br />
                <?php comments_popup_link('Sin Comentarios', '1 Comentario', '% Comentario'); ?> <?php edit_post_link('Editar', ' &#124; ', ''); ?>
            </p>
        </div>
        <div class="post-comentarios">
            <?php comments_template(); ?>
        </div>
 
    </div>
    <?php endwhile; ?>
 
    <div class="paginador">
        <?php previous_post_link('< %link') ?> <?php next_post_link(' %link >') ?>
    </div>
 
    <?php endif; ?>
</div>