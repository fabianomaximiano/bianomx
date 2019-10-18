<?php 
/* Template Name: sobre */
get_header(); 
$diretorio = get_template_directory_uri(); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<?php 
			$args = array(
				'post_type' => 'artigo',
					//'posts_per_page'=>3,
				'tax_query' => $taxQuery
				);

			$loop = new WP_Query($args);
			if ($loop->have_posts()) : ?>
			<?php while ($loop->have_posts()) : $loop->the_post(); ?>
				<section>
					<article>
						<figure class="foto-legenda">
							<?php the_post_thumbnail( 'imagem-slide' ); ?>
							<figcaption>
								<h2><?php echo get_post_meta( get_the_ID(),'titulo_artigo', true ); ?></h2>
							</figcaption>
						</a>
					</figure>
				</article>
			</section>
			<section>
				<h3><?php echo get_post_meta( get_the_ID(),'subtitulo_artigo', true ); ?></h3>

				<p><?php echo get_post_meta( get_the_ID(),'conteudo_artigo', true ); ?></p>
			</section>
		<?php endwhile; ?>
	<?php endif; ?>
	<hr>
	<?php comment_form($comment_args_bootstrap); ?>
	<hr>
	<div>
	<ol class="commentlist">
	<?php
		//Gather comments for a specific page/post 
		$comments = get_comments(array(
			'post_id' => XXX,
			'status' => 'approve' //Change this to the type of comments to be displayed
		));

		//Display the list of comments
		wp_list_comments(array(
			'per_page' => 10, //Allow comment pagination
			'reverse_top_level' => false //Show the oldest comments at the top of the list
		), $comments);
	?>
</ol>
</div>
</div>
<!-- conteudo principal -->

<?php get_sidebar(); ?>
</div><!-- /row -->
</div><!-- /container -->

<?php get_footer(); ?>