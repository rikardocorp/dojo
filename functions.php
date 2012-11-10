<?php
	/*------------------------------------------------------------*/
	/*   Cambiar logo wordpress del administrador
	/*------------------------------------------------------------*/
	function my_custom_login_logo() 
	{
	    echo '<style type="text/css">
	        h1 a { background-image:url('.get_bloginfo('template_url').'/images/logo-karate.png) !important; }
			input.button-primary { border-color: #666 !important; background: #FF0000 !important; }
			#login a, #login p { color: #FF0000 !important; }
	    </style>';
	}
	add_action('login_head', 'my_custom_login_logo');

	/*------------------------------------------------------------*/
	/*   Registrar Menus WP3.0+
	/*------------------------------------------------------------*/
	if ( function_exists( 'register_nav_menus' ) )
	{
		register_nav_menus(
	    	array('MenuPrincipal' => __( 'Menu Principal' ),'MenuCategorias' => __( 'Menu Categorias' ))
		);
	}

	/*-----------------------------------------------------------*/
	/*	Configurar Imágenes Thumbnails WP2.9+
	/*-----------------------------------------------------------*/
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );//Agrega soporte
		add_image_size( 'video-thumbnail', 66, 56, true ); // Videos list thumbnails
		add_image_size( 'index-thumbnail', 170, 160, true ); // Blog thumbnail
		add_image_size( 'slider-thumbnail', 400, 190, true ); // Slider thumbnail
	}

	function wd_load_script() {
	    wp_deregister_script( 'jquery' );
	    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
	    wp_register_script('slider', get_template_directory_uri() . '/js/slider.js', 'jquery');
		wp_register_script('assets', get_template_directory_uri() . '/js/assets.js', 'jquery');
	    if(is_home()){
		    wp_enqueue_script( 'jquery' );
		    wp_enqueue_script( 'slider' );  
		}
		else{
			wp_enqueue_script( 'jquery' );
		    wp_enqueue_script( 'assets' ); 
		}
		 
	}    
	add_action('wp_enqueue_scripts', 'wd_load_script');
	
	// Cargar scripts para comentarios solo en single.php y page.php
	function wd_single_scripts() {
		if(is_singular() || is_page()){
		wp_enqueue_script( 'comment-reply' ); // Carga el javascript necesario para los comentarios anidados
		}
	}
	add_action('wp_print_scripts', 'wd_single_scripts');
	
	// quitar el margin-top de la etiqueta html -o- usuarios / perfil / Muestra la barra de herramientas en el sitio
	//function my_function_admin_bar(){return false;}add_filter( 'show_admin_bar' , 'my_function_admin_bar');
	
	
	// para dar formato a fecha de publicacion 
	// '2010-02-22 18:42:00 to Hace 1 año 8 meses 27 dias 28 minutos 5 segundos
	class haceTanto extends DateTime {
	    protected $strings = array(
	        'y' => array('1 a&ntilde;o', '%d a&ntilde;os'),
	        'm' => array('1 mes', '%d meses'),
	        'd' => array('1 d&iacute;a', '%d dias'),
	        'h' => array('1 hora', '%d horas'),
	        'i' => array('1 min', '%d minutos'),
	        's' => array('segundos', '%d segundos'),
	    );
	    public $profundidad;
	    public function __construct( $fecha,$profundidad='i')
	    {
	        parent::__construct( $fecha );
	        $this->profundidad = $profundidad;
	    }
	    public function __toString() {
		     try 
		    {  
		     	$now = new DateTime('now');
		        $diff = $this->diff($now);
		        foreach($this->strings as $key => $value){
		            if( ($text .= ' '.$this->getDiffText($key, $diff)) ){ 
		            }
		            if($this->profundidad == $key) break;
		        }
		        return $text;   
		    } 
		    catch(Exception $e) 
		    {  
		        trigger_error($e->getMessage(), E_USER_ERROR);  
		        return '';  
		    }  	 	 
	    }
	 
	    protected function getDiffText($intervalKey, $diff){
	        $pluralKey = 1;
	        $value = $diff->$intervalKey;
	        if($value > 0){
	            if($value < 2){
	                $pluralKey = 0;
	            }
	            return sprintf($this->strings[$intervalKey][$pluralKey], $value);
	        }
	        return null;
	    }
	}
	// fin dar formato a fecha de publicacion
	
	function limpiar_cadena($String)
	{
		$String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
		$String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
		$String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
		$String = str_replace(array('í','ì','î','ï'),"i",$String);
		$String = str_replace(array('é','è','ê','ë'),"e",$String);
		$String = str_replace(array('É','È','Ê','Ë'),"E",$String);
		$String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
		$String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
		$String = str_replace(array('ú','ù','û','ü'),"u",$String);
		$String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
		$String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
		$String = str_replace("ç","c",$String);
		$String = str_replace("Ç","C",$String);
		$String = str_replace("ñ","n",$String);
		$String = str_replace("Ñ","N",$String);
		$String = str_replace("Ý","Y",$String);
		$String = str_replace("ý","y",$String);
		return $String;
	}
?>

<?php
function check_referrer() {
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == '') {
        wp_die( __('Por favor, activa referentes en su navegador, o, si usted es un spammer, sal de aquí!') );
    }
}
add_action('check_comment_flood', 'check_referrer');


 //this function will be called in the next section
function advanced_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
 
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div class="comment-author vcard">
     <?php echo get_avatar($comment,$size='70' ); ?>
       <div class="comment-meta"<a href="<?php the_author_meta( 'user_url'); ?>"><?php printf(__('%s'), get_comment_author_link()) ?></a></div>
       <small><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?></small>
     </div>
     <div class="clear"></div>
 
     <?php if ($comment->comment_approved == '0') : ?>
       <em><?php _e('Su comentario está pendiente de moderación.') ?></em>
       <br />
     <?php endif; ?>
 
     <div class="comment-text">	
         <?php comment_text() ?>
     </div>
 
   <div class="reply">
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      <?php delete_comment_link(get_comment_ID()); ?>
   </div>
   <div class="clear"></div>
<?php } ?>

<?php 
function close_comments( $posts ) {
	if ( !is_single() ) { return $posts; }
	if ( time() - strtotime( $posts[0]->post_date_gmt ) > ( 30 * 24 * 60 * 60 ) ) {
		$posts[0]->comment_status = 'closed';
		$posts[0]->ping_status    = 'closed';
	}
	return $posts;
}
add_filter( 'the_posts', 'close_comments' ); 
?>

<?php function delete_comment_link($id) {
  if (current_user_can('edit_post')) {
    echo '<a href="'.admin_url("comment.php?action=cdc&c=$id").'">Borrar</a> ';
    echo '<a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">Spam</a>';
  }
}
?>

