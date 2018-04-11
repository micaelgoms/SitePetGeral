<?php
/**
 * template de demostração de petianos
 * Template Name: noticia
 *
 * @package SiteGeralPETUFMA
 * @since SiteGeralPETUFMA 0.1
 *
 */
?>

<?php get_header(); ?>
<?php $pagename = get_query_var('pagename'); ?> 

<section>
	<!-- PARALAX SECTION -->
	<div class="header-container">
			<div class="section  no-pad-bot">
					<div class="container">
              <div class = "title-post nunito">
                <h3><?php echo $pagename ?></h3>
              </div>
							<div id="search-box-side">
									<div id="search-form-side">
											<input  id="search-text-side" type="text" placeholder=" Faça uma busca... ">
											<button type="submit" id="search-button-side" onclick="pesquisarNoticias()">Pesquisar</button>
									</div>
							</div>
					</div>
			</div>
			<div id="whole-content">
				<?php 
				// the query
				$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>
				
				<?php if ( $wpb_all_query->have_posts() ) : ?>
				
				<ul>
				
				<!-- the loop -->
				<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				<!-- end of the loop -->
				
				</ul>
				
				<?php wp_reset_postdata(); ?>
				
				<?php else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			</div>
				
			<div class="parallax bannerimg-side"></div>
	</div>
</section>
<section>
    <div class="background-section">

    </div>
</section>

<script>

    function pesquisarNoticias() {
        // Declara variáveis
        var input, filter, list, ul, title;
	// Recebe entrada a partir do elemento com id="search-text-side"
        input = document.getElementById("search-text-side");
	// Passa o filtro que ordena
        filter = input.value.toUpperCase();

	// Pega tudo que está dentro da tag com id="whole-content"
        list = document.getElementById("whole-content");
	// Pega o que estiver dentro da tag "ul" em "whole-content"
        ul = list.getElementsByTagName("ul");

        // Itera por todas as linhas da tabela e esconde as que nao baterem com a pesquisa
        for (i = 0; i < ul.length; i++) {
            title = ul[i].getElementsByTagName("a")[0];
            if (title) {
                if (title.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    ul[i].style.display = "";
                } else {
                    ul[i].style.display = "none";
                }
            }
        }
        
    }

</script>
  
<?php get_footer(); ?>