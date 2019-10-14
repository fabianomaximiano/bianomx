<?php 
get_header(); 
$diretorio = get_template_directory_uri(); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<?php 
			$args = array('post_type' => 'artigo', 'posts_per_page'=>2);
			$loop = new WP_Query($args);
			if ($loop->have_posts()) : ?>
			<?php 
			while ($loop->have_posts()) : $loop->the_post(); 
			?>
			<!-- conteudo 2 -->
			<section>
				<article>
					<figure class="foto-legenda">
						<a href="<?php echo the_permalink()?>"><?php the_post_thumbnail('capa-artigo', array('class' => 'img-responsive')); ?>
							<figcaption>
								<h2><?php the_title(); ?></h2>
							</figcaption>
						</a>
					</figure>
				</article>
				<div class="btn-noticias">
					<button type="button" class="btn btn-coments">comentarios</button><button type="button" class="btn btn-conta"><?php comments_popup_link('0 comentário','1 comentário','% Comentários'); ?></button>
				</div>
			</section>
		<?php endwhile; ?>
	<?php else: ?>
		<?php echo '<h3 class="bg-danger text-center">não há artigos para mostrar!</h3>' ?>
	<?php endif; ?>
</div>
<!-- conteudo principal -->

<?php get_sidebar(); ?>
</div><!-- /row -->
</div><!-- /container -->

<?php get_footer(); ?>