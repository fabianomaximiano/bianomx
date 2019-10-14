<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
require_once get_template_directory() . '/core/classes/class-post-type.php';
require_once get_template_directory() . '/core/classes/class-taxonomy.php';
require_once get_template_directory() . '/core/classes/class-metabox.php';
require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-shortcodes-menu.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
// require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
				)
			);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
			);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
			);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
				)
			);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
				)
			);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Odin 2.2.10
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
			) );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
			)
		);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Html5Shiv
	wp_enqueue_script( 'html5shiv', $template_url . '/assets/js/html5.js' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	}

	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}

// 
// 
// 

/*add_action('rest_api_init', function () {
  register_rest_route( 'frsSitefrsSite/v1', 'latest-posts/(?P<category_id>\d+)',array(
                'methods'  => 'GET',
                'callback' => 'get_latest_posts_by_category'
      ));
});
*/




/********************************************************************************************/
/*                               CADASTRO DE SLIDES: Banners                               */
/*******************************************************************************************/

function cadastrar_slider(){
	$labels = array(
		'name' => _x('Slider', 'post type general name'),
		'singular_name' => _x('Slider', 'post type singular name'),
		'add_new' => _x('Adicionar slider', 'slider'),
		'add_new_item' => __('Adicionar slider'),
		'edit_item' => __('Editar slider'),
		'new_item' => __('Novo slider'),
		'view_item' => __('Ver slider'),
		'search_items' => __('Procurar slider'),
		'not_found' =>  __('Nada encontrado'),
		'not_found_in_trash' => __('Nada encontrado no lixo'),
		'parent_item_colon' => ''
		);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-media-code',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 4,
		'supports' => array('title','author','excerpt', 'thumbnail'),
		);
	register_post_type('slider',$args);
	flush_rewrite_rules();
}

add_action('init', 'cadastrar_slider');


/********************************************************************************************/
/***					                CADASTRO DE PRODUTOS:                             ***/
/********************************************************************************************/

function Artigos_cad(){
    //configuraçoes do tipo de post: propagandas
	$labels = array(
		'name' => 'Artigos',
		'name_singular' => 'Artigo',
		'add_new' => _x('Adicionar artigo', 'artigo'),
		'add_new_item' => __('Adicionar artigo'),
		'edit_item' => __('Editar artigo'),
		'new_item' => __('Novo artigo'),
		'view_item' => __('Ver artigo'),
		'search_items' => __('Procurar artigo'),
		'not_found' =>  __('Nada encontrado'),
		'not_found_in_trash' => __('Nada encontrado no lixo'),
		'parent_item_colon' => ''

		);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'description' => 'Cadastro de artigos.',
		'menu_icon' => 'dashicons-products',
		'hierarchical' => false,
		'menu_position' => 5,
        'supports' => array('title','author','excerpt', 'thumbnail', 'comments'),

		);

	register_post_type('artigo', $args);
	flush_rewrite_rules();
//fim configuraçoes do tipo de post: propagandas (anunciantes)
} 
add_action('init', 'Artigos_cad');

/*********************************************************************************************/ 
/***     							  CATEGORIAS DOS PRODUTOS                              ***/ 
/*********************************************************************************************/


function odin_linguagem_taxonomy(){

	$artigo = new Odin_Taxonomy(
    'Linguagem', // Nome (Singular) da nova Taxonomia.
    'linguagem', // Slug do Taxonomia.
    'artigo' // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
    );

	$artigo->set_labels(
		array(
			'menu_name' => __( 'Linguagens', 'odin' )
			)
		);

	$artigo->set_arguments(
		array(
			'hierarchical' => true
			)
		);

}

add_action( 'init', 'odin_linguagem_taxonomy', 1 );

/**********************************************************************************************/ 
/***                               CADASTRO DE ARTIGOS - FORM                               ***/ 
/**********************************************************************************************/ 
function cad_artigos_metabox(){
	$cad_artigos_metabox = new Odin_Metabox(

		'Artigos', // Slug/ID do Metabox (obrigatório)
    	'Adicionar novo artigo', // Nome do Metabox  (obrigatório)
    	'artigo', // Slug do Post Type, sendo possível enviar apenas um valor ou um array com vários (opcional)
    	'normal', // Contexto (opções: normal, advanced, ou side) (opcional)
    	'high' // Prioridade (opções: high, core, default ou low) (opcional)

    	);

	$cad_artigos_metabox-> set_fields(
		array(
				array(
					'id'    	 => 'titulo_artigo',
					'label' 	 => __('Titutolo do artigo', 'odin'),
					'type'  	 => 'text',
					'attributes' => array(
						'placeholder' => __('Informe o titulo do artigo')	
					)
 
				),
				array(
					'id'		 => 'subTitulo_artigo',
					'label'		 => __('Sub Titulo do artigo', 'odin'),
					'type'		 => 'text',
					'attributes' => array(
						'placeholder' => __('Informe o sub titulo do artigo')
						)
				),
				array(
					'id'		 => 'conteudo_artigo',
					'label'      => __('Descrição do artigo', 'odin'),
					'type'		 => 'textarea',
					'attributes' => array(
						'rows' => '5',
						'cols' => '40'
					)
				)
			)
		);
}
add_action( 'init', 'cad_artigos_metabox', 1 );

/*********************************************************************************************/ 
/***     							  CADASTRO DE MIDIAS SOCIAIS                           ***/ 
/*********************************************************************************************/

function cad_redesSociais(){
	$rsociais = new Odin_Post_Type(
        'redes', // Nome (Singular) do Post Type.
        'redes' // Slug do Post Type.
        );

	$rsociais->set_labels(
		array(
			'menu_name' 	=> __( 'Redes Sociais', 'odin' ),
			'add_new'		=> __( 'Nova rede social', 'odin'),
			'add_new_item'	=> __( 'Adicionar nova rede social', 'odin'),
			'edit_item' 	=> __( 'Editar rede social', 'odin'), //Default Edit Post/Edit Page.
			'new_item'  	=> __( 'Nova rede social', 'odin'),//Default is New Post/New Page.
			'all_items' 	=> __( 'Todas as Redes', 'odin' )
			)
		);

	$rsociais->set_arguments(
		array(
			'menu_icon' => 'dashicons-id-alt',
			'hierarchical' => false,
			'menu_position' => 6,
			'supports' => array('title', 'author', 'thumbnail'),
			'support' => false
			)
		);

}
add_action('init', 'cad_redesSociais', 1);

/**********************************************************************************************/ 
/***                       REGISTRAR POST TYPE: / 
/*********************************************************************************************/ 




// 
// 
// 




// 
// 
// 




/*********************************************************************************************/ 
/***                              FORMULARIO DE CADASTRO REDES SOCIAIS                     ***/ 
/*********************************************************************************************/ 

function metabox_redesSociais(){
	$metabox_redesSociais = new Odin_Metabox(

		'redes', // Slug/ID do Metabox (obrigatório)
    	'redes', // Nome do Metabox  (obrigatório)
    	'redes', // Slug do Post Type, sendo possível enviar apenas um valor ou um array com vários (opcional)
    	'normal', // Contexto (opções: normal, advanced, ou side) (opcional)
    	'high' // Prioridade (opções: high, core, default ou low) (opcional)

    	);

	$metabox_redesSociais -> set_fields(

		array(
					//url facebook 
			array(


				'id'          => 'facebook', // Obrigatório
			    'label'       => __( 'Facebook:', 'odin' ), // Obrigatório
			    'type'        => 'input', // Obrigatório
			    'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
			    	'placeholder' => __( 'Informe a url da pagina!' )
			    	//'required'    => 'required',
			    	),
			    'description' => __( 'Exemplo: https://www.facebook.com/seu_perfil')

			    ),
						//separador
			array(

				'id'   => 'separator1', // Obrigatório
    			'type' => 'separator' // Obrigatório

    			),

			    //url instagram
			array(


				'id'          => 'twitter', // Obrigatório
			    'label'       => __( 'Twitter:', 'odin' ), // Obrigatório
			    'type'        => 'input', // Obrigatório
			    'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
			    	'placeholder' => __( 'Informe a url da pagina!' )
			    	//'required'    => 'required',
			    	),
			    'description' => __( 'Exemplo: https://twitter.com/seu_nome')


				),
						//separador
			array(

				'id'   => 'separator1', // Obrigatório
    			'type' => 'separator' // Obrigatório

    			),

			    //url twiiter
			array(


				'id'          => 'instagram', // Obrigatório
			    'label'       => __( 'Instagram:', 'odin' ), // Obrigatório
			    'type'        => 'input', // Obrigatório
			    'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
			    	'placeholder' => __( 'Informe a url da pagina!' )
			    	//'required'    => 'required',
			    	),
			    'description' => __( 'Exemplo: https://www.instagram.com/seu_perfil')


				),
						//separador
			array(

				'id'   => 'separator1', // Obrigatório
    			'type' => 'separator' // Obrigatório

    			),

				//url youtube
			array(


				'id'          => 'youtube', // Obrigatório
			    'label'       => __( 'Youtube:', 'odin' ), // Obrigatório
			    'type'        => 'input', // Obrigatório
			    'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
			    	'placeholder' => __( 'Informe a url da pagina!' )
			    	//'required'    => 'required',
			    	),
			    'description' => __( 'Exemplo: https://www.youtube.com/channel')


				),

			)

		);
}

add_action( 'init', 'metabox_redesSociais', 1 );
 
/*********************************************************************************************/ 
/***************                 FORMULARIO DE CONTATO                           *************/ 
/*********************************************************************************************/ 

function odin_contact_form() {

    $form = new Odin_Contact_Form(
        'contact_form',
        'biano@live.com'
    );

    $form->set_fields(
        array(
            array(
                'fields' => array(
                    array(
                        'id'          => 'campo_nome', // Required
                        'label'       => array(
                            'text'      => __( 'Nome Completo', 'odin' ), // Required
                        ),
                        'type'        => 'text', // Required
                        'required'    => true, // Optional (bool)
                        'attributes'  => array( // Optional (html input elements)
                            'placeholder' => __( 'Digite o seu nome' )
                        )
                    ),
                )
            ),
            array(
                'fields' => array(
                    array(
                        'id'          => 'campo_email', // Required
                        'label'       => array(
                            'text'      => __( 'E-mail', 'odin' ), // Required
                        ),
                        'type'        => 'email', // Required
                        'required'    => true, // Optional (bool)
                        'attributes'  => array( // Optional (html input elements)
                            'placeholder' => __( 'Digite o seu e-mail!' )
                        ),
                        //'description' => __( 'Precisa ser um endereço de e-mail válido;lido', 'odin' ) // Optional
                    ),
                    array(
                    	'id'            => 'campo_fone',
                    	'label'         => array(
                    		'text'        => __('Telefone', 'odin'),

                    	),
                    	'type'         => 'number',
                    	'required'     =>  bool,
                    	'attributes'   => array(

                    		'placeholder' => __('Digite o numero do seu telefone!'),
                    		'max'     => '10', //11 3033-6181
                    	),


                    ),
                    array(
                    	'id'           => 'campo_celular',
                    	'label'        => array(
                    		'text'       => __('Celular', 'odin'),

                    		),
                    	'type'         => 'number',
                    	'required'     =>  bool,
                    	'attributes'   => array(

                    		 'placeholder' => __('Digite o número do seu celular!'),
                    		 'max'     => '11', //19 99682-0526
                    		),

                    	),
                    array(
                        'id'          => 'campo_message', // Required
                        'label'       => array(
                            'text'      => __( 'Mensagem', 'odin' ), // Required
                        ),
                        'type'        => 'textarea', // Required
                        'required'    => true, // Optional (bool)
                        'attributes'  => array( // Optional (html input elements)
                            'placeholder' => __( 'Digite a sua mensagem' )
                        ),
                    ),
                )
            )
        )
    );

    $form->set_subject( __( 'Email enviado por [sender_name] <[sender_email]>', 'odin' ) );

    $form->set_content_type( 'html' );

    $form->set_reply_to( 'sender_email' );

    return $form;

}

add_action( 'init', array( odin_contact_form(), 'init' ), 1 );



/*****************************************************************************************/ 
/***               FUNÇOES PARA CADASTRO DE IMAGENS: Miniaturas, Media e grande        ***/ 
/*****************************************************************************************/ 

//imagens 
$maior = odin_thumbnail( 400, 300, 'Meu texto alternativo', true, 'minha-classe' );

$testeimagem = odin_get_image_url( $id, 800, 300, true, true );

//imagens thumbnail
add_theme_support( 'post-thumbnails' );

//imagens com tamanhos personalizados
add_image_size( $name, $width, $height, $crop );

// Vai cortar a imagem para exatamente 600 px de largura por 400 px de altura.
add_image_size( 'imagem-slide', 1339, 586, true );

// Vai gerar uma imagem com 300 px de largura e altura proporcional sem distorcer nada.
add_image_size( 'capa-artigo', 600, 250);
add_image_size( 'imagem-empresa', 358, 227);
add_image_size( 'imagem-empresa-media', 542, 227);
add_image_size(	'imagem-produto', 320, 320);

/******************************************************************************************/ 
/***                          REMOVER ITENS DO MENU                                     ***/ 
/******************************************************************************************/ 

function remove_menus(){
	remove_menu_page('edit.php'); // Paginas); //posts originais
}
add_action('admin_menu','remove_menus');

