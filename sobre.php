<?php 
/* Template Name: sobre */
get_header(); 
$diretorio = get_template_directory_uri(); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<section>
					<h2>Sobre o Autor:</h2>
					<h3>Conheça minha historia</h3>
					<p><?php the_author_description ();?></p>

					<hr>
						<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<figure>
					<?php the_post_thumbnail( 'imagem-media' ); ?>
					<figcaption><h2><span>SP</span><span>nome da cidade</span></h2></figcaption>
				</figure>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-8"">
				<span><h3><?php the_title(); ?></h3></span>
				<p><?php the_content(); //echo get_post_meta( get_the_ID(), 'descricao_evento', true ); ?></p>
			</div>

<!-- 					<div class="row">
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img src="images/thumbnails.png" alt="...">
								<div class="caption">
									<h3>Thumbnail label</h3>
									<p>Lorem Ipsum</p>
									<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img src="images/thumbnails.png" alt="...">
								<div class="caption">
									<h3>Thumbnail label</h3>
									<p>Lorem ipsum</p>
									<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img src="images/thumbnails.png" alt="...">
								<div class="caption">
									<h3>Thumbnail label</h3>
									<p>Lorem Ipsum</p>
									<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
								</div>
							</div>
						</div> -->
					</div>
				</section>
		</div>
		<!-- conteudo principal -->

		<?php get_sidebar(); ?>
	</div><!-- /row -->
</div><!-- /container -->

<?php get_footer(); ?>