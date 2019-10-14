<?php $diretorio = get_template_directory_uri(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.typekit.net/cep6jpv.css">
	<?php if ( ! get_option( 'site_icon' ) ) : ?>
		<link href="<?= $diretorio; ?>/images/favicon.ico" rel="shortcut icon" />
	<?php endif; ?>
	<?php wp_head(); ?>
	
	<title>
		<!-- FRS EQUIPAMENTOS - PAGINA -->

		<?php if (is_home()){
			bloginfo('name');
		}elseif (is_category()){
			single_cat_title(); echo ' -  ' ; bloginfo('name');
		}elseif (is_single()){
			single_post_title();
		}elseif (is_page()){
			bloginfo('name'); echo ': '; single_post_title();
		}else {
			wp_title('',true);
		} ?>
	</title>
	

	<!-- <link rel="stylesheet" type="text/css" href="<?= $diretorio; ?>/assets/css/font-awesome/css/font-awesome.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?= $diretorio; ?>/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= $diretorio; ?>/assets/css/style.css">
</head>
<body>
	<header>
		<div class="topo-sociais">
			<div class="container">
				<ul>
					<li><span><a href="mailto:contato@bianomx.com.br">contato@bianomx.com.br</a></span></li>
					<li><a href="https://www.facebook.com/fabiano.programador" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a></li>
					<li><a href="https://twitter.com/fabianomaximian" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a></li>
					<li><a href="https://www.instagram.com/bianomx/" target="_blank"><i class="fa fa-instagram  fa-2x"></i></a></li>
				</ul>
			</div>
		</div>
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo get_settings('home'); ?>"><h1 id="logo"></h1></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'depth'          => 2,
							'container'      => false,
							'menu_class'     => 'nav navbar-nav',
							'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
							'walker'         => new Odin_Bootstrap_Nav_Walker()
							)
						);
				?>

				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>