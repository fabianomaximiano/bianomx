<div class="col-sm-4 blog-sidebar">
				<div class="box">
					<h3 class="title">newsletters</h3>

					<h2>Deseja ficar por dentro das novidades</h2>
					<p>Cadastre seu email na nossa lista de novidades e receba informações e dicas!! </p>
					<form>
						<div class="form-group">
							<label>Nome Completo:</label>
							<input type="text" class="form-control" id="nome-completo" name="nome-completo" placeholder="Informe seu nome completo!"/>
						</div>
						<div class="form-group">
							<label>Email:</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Informe seu email!"/>
						</div>

						<button type="button" class="btn btn-info">cadastrar</button>
					</form>
				</div><!-- form news -->

				<div class="box">
					<h3 class="title">redes sociais</h3>
					<div class="spacing">

						<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fpg%2FBiano-825817044135855&tabs=timeline&width=355px&height=130px&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=189731748132666" width="355px" height="130px" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
					</div>
				</div><!-- redes sociais -->


 <div class="box">
 <h3 class="title">mais lidas</h3>
 <?php 
					// WP_Query arguments
  $args = array(
    'post_type'   				=> array( 'post' ),
    'post_status' 				=> array( 'publish' ),
    'orderby'     				=> 'meta_value_num',
    'meta_key'    				=> 'post_views_count',
    'order'       	 			=> 'DESC',
    'ignore_sticky_posts' => 1,
    'posts_per_page' 			=> '4',
  );
  // The Query
  $query_trending = new WP_Query( $args );
  $count = 0;
  // The Loop
  if ( $query_trending->have_posts() ) { ?>
			
			<ul>
				<?php while ( $query_trending->have_posts() ) { $query_trending->the_post(); $count ++; ?>
			    	<li>	
						<a href="<?php get_permalink(); ?>" title="<?php get_the_title(); ?>" class="boxl"><p> <?php get_the_title(); (chr_setPostViews( get_the_ID()));?></p>
							<h2><?php wp_trim_words( get_the_title(), 6, '...' );?></h2></a>
					</li>
				</ul>
				<?php  }
				  } else { ?>

				      <?php echo '<ul><li class"alert-danger">Não há  posts publicados no momento!</li></ul>';?>

				 <?php }?>
				</div><!-- box -->
</div>
				