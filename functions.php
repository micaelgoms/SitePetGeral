<?php
/**
 * Arquivo de controle de funções para inicialização de aspectos de design do Tema.
 *
 * @package SiteGeralPETUFMA
 * @since SiteGeralPETUFMA 0.1
 *
 */

if ( ! function_exists( 'materialize_css_setup' ) ) :
/**
 * Configura os padrões do tema e registra o suporte para vários recursos do WordPress.
 *
 * Note que esta função está conectada ao hook after_setup_theme, que
 * é executado antes do gancho init. O gancho init é muito tarde para alguns recursos, como
 * como indicação de suporte para pós-miniaturas.
 */

function materialize_css_setup() {
	/*
	 * Disponibilizar tema para tradução.
	 * Traduções podem ser arquivadas no diretório / languages /.
	 * Se você está construindo um tema baseado em materialize css, use um localizar e substituir
	 * para alterar 'materialize-css' para o nome do seu tema em todos os arquivos de modelo.
	 */

	load_theme_textdomain( 'materialize-css', get_template_directory() . '/languages' );

	// Adicione postagens e comentários padrão de links de feed RSS no cabeçalho.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Deixe o WordPress gerenciar o título do documento.
	 * Adicionando suporte ao tema, declaramos que este tema não usa
	 * codificação <title> codificada no cabeçalho do documento e espera que o WordPress
	 * fornecer para nós.
	 */

	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
			'height'      => 64,
			'width'       => 400,
			'flex-width' => true)
	);

   /*
	* Ative o suporte para Post Thumbnails em posts e páginas.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/

	add_theme_support( 'post-thumbnails' );

	// Este tema usa wp_nav_menu () em um local.
	register_nav_menus(
		array(
			'primary' => esc_html('Primary'),
			'secondary' => esc_html('Secondary')
		)
	);

	/*
	 * Mudar a marcação principal padrão para formulário de pesquisa, formulário de comentário e comentários
	 * para saída de HTML5 válido.
	 */

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Configure o recurso de plano de fundo personalizado do núcleo do WordPress.
	/*
	add_theme_support( 'custom-footer', apply_filters( 'materialize_css_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	*/

	// Adicionar suporte ao tema para atualização seletiva para widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;

add_action( 'after_setup_theme', 'materialize_css_setup' );

 /**
  * Defina a largura do conteúdo em pixels, com base no design e na folha de estilo do tema.
  *
  * Prioridade 0 para disponibilizá-lo para callbacks de menor prioridade.
  *
  * @global int $content_width
  */

function materialize_css_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'materialize_css_content_width', 640 );
}

add_action( 'after_setup_theme', 'materialize_css_content_width', 0 );

/**
 * Registre a área do widget.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function materialize_css_widgets_init() {
	register_sidebar(array(
		'name' => 'header',
		'id' =>'header_widgets'
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'materialize-css' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'materialize-css' ),
		'before_widget' => '<div class="sidebar-area"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="divider"></div><h5 class="sidebar-text center">',
		'after_title'   => '</h5>',
	));
	register_sidebar(array(
		'name' => 'Footer Left',
		'id' => 'footerleft_widgets',
		'before_widget' => '<div class="footer-area">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-text">',
		'after_title' => '</p>',
	));
	register_sidebar(array(
		'name' => 'Footer Right',
		'id' => 'footerright_widgets',
		'before_widget' => '<div class="footer-area">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-text">',
		'after_title' => '</p>',
	));
}
//add_action( 'widgets_init', 'materialize_css_widgets_init' );

/**
 * Enfileirar scripts e estilos.
 */
function materialize_css_scripts() {
	if( !is_admin()){
	 	wp_deregister_script('jquery');
	 	wp_enqueue_script( 'materialize-css-jquery', 'https://code.jquery.com/jquery-2.1.1.min.js', '', null, true );
	}

	//wp_enqueue_style('materialize_css-style', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css', '', null, false);

	wp_enqueue_style('materialize_css-style', 'https://pet.ufma.br/wp-content/themes/SitePetGeral/css/materialize.min.css', '', null, false);

	//wp_enqueue_style('style', get_stylesheet_uri() );

	wp_enqueue_style('style', 'http://localhost/petufma/wp-content/themes/SitePetGeral/style.css' );

	//wp_enqueue_script('materialize_css_scripts', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js', '', null, true);

	wp_enqueue_script('materialize_css_scripts', 'https://pet.ufma.br/wp-content/themes/SitePetGeral/js/materialize.min.js', '', null, true);

	wp_enqueue_script('materialize_css-scripts', get_template_directory_uri() . '/js/custom.js', array(), '1.0', true);

	wp_enqueue_script('materialize_css-scripts', get_template_directory_uri() . '/css/custom.js', array(), '1.0', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'materialize_css_scripts' );

/* Colunistas */
function colunista()
{
    global $wpdb;
    $colunista_list = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
    return $colunista_list;
}

/*Customizar cores*/
/* Função que opera as funcionalidades da 'personalizar' */
function materialize_controls($wp_customize)
{
	$wp_customize->add_section( 'imagem_footer',
	array(
		'title'      => __('Imagem Footer','materialized'),
		'description' => 'Escolha a imagem do Footer',
		'priority'   => 30,
	));

	// Add setting
	$wp_customize->add_setting(
		'materialize_colors',
		array('default' => 'http://localhost/wordpress/wp-content/uploads/2018/03/logofooter.png')
	);

	// Add control
	$wp_customize->add_control('materialize_color_selector',
	array(
		'label' => 'URL image ?',
		'section' => 'imagem_footer',
		'settings' => 'materialize_colors',
		'type' => 'url'
	));
}


/*Busca na tabela wp_post, noticias do tipo post e com status publicado que corresponde a busca do usuário, ordenado por data*/
function my_query_posts($busca){
	global $wpdb;
	$itens = $wpdb->get_results("SELECT post_title, ID, post_content FROM `wp_posts` WHERE `post_status` ='publish' AND `post_type`='post' AND `post_title` LIKE '%$busca%' ORDER BY post_date");

	/*Se não foi encontrado, retorna falso*/
	if (empty($itens))
		return false;
	//Retorna o vetor de resultados, caso seja encontrado
	return $itens;

}

//Busca as categorias do post
function my_query_categories($id){
	global $wpdb;
	$itens = $wpdb->get_results("SELECT wp_terms.name FROM wp_terms, wp_term_relationships,wp_term_taxonomy WHERE wp_term_relationships.object_id ='$id' AND wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id AND wp_terms.term_id = wp_term_taxonomy.term_id");

	/*Se não foi encontrado, retorna falso*/
	if (empty($itens))
		return false;
	//Retorna o vetor de resultados, caso seja encontrado
	return $itens;

}

//Consulta as informações do grupo pet
function query_pet_home_theme(){
	global $wpdb;
	$itens = $wpdb->get_results("SELECT * FROM `wp_custom_equipe` WHERE `grupo_pet`= 1");
	if (empty($itens)){
		return array(array());
	}

	return $itens;
}

//=========================================================
//consulta todos os petianos
function query_petianos_theme(){
	global $wpdb;
	$itens = $wpdb->get_results("SELECT * FROM `wp_custom_equipe` WHERE `grupo_pet`= 0 AND `classificacao` = 'Petianos'");
	if (empty($itens)){
		return array(array());
	}

	return $itens;
}
add_action('customize_register', 'materialize_controls');
