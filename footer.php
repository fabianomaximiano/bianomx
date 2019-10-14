	<?php 
		
		$diretorio = get_template_directory_uri();
		 
	?>
	<footer>
		<figure>
			<a href="<?php echo get_settings('home'); ?>"><img src="<?= $diretorio ?>/assets/images/logo-footer.png" alt="Compartilhando conhecimento e informação!"></a>
		</figure>
		<p>compartilhando conhecimento e informação!</p>
	</footer>

	
	<script src="<?= $diretorio ?>/assets/js/bootstrap.min.js"></script><!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
</body>
</html>