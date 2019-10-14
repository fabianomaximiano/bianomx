<?php 
/* Template Name: Example Template */
get_header(); 
$diretorio = get_template_directory_uri(); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>    
					<section>
						<h2><?php echo the_title(); ?></h2>
						<p><?php echo the_content(); ?></p>
						<hr>

					</section>
					
				<?php endwhile; ?>
			<?php endif; ?>

			<?php echo odin_contact_form()->render(); ?>

		</div>
		<!-- conteudo principal -->

		<?php get_sidebar(); ?>
	</div><!-- /row -->
</div><!-- /container -->

<?php get_footer(); ?>