<?php get_header(); ?>
	<div class="hero-inner">
		<h1>Ignitiondeck Product Page</h1>
	</div>
	</div>
<div class="infobox">
	<p>This is an Ignitiondeck Product Page, which is part of Ignitiondeck. When a user chooses to contribute to a Boomerang crowdfunding, this is where they will be redirected for payment processing.</p>
	<p>For a full explanation of what this page does, please head to the Ignitiondeck <a href="https://www.ignitiondeck.com/">website</a>.</p>
</div>
	<div id="container">
		<article id="content" class="ignition_project">
			<?php
			global $post;
			$id = $post->ID;
			$content = get_post($id);
			$project_id = get_post_meta($id, 'ign_project_id', true);
			?>
			<div class="entry-content">
				<?php echo apply_filters( 'the_content', do_shortcode( '[project_purchase_form]' ) ); ?>
			</div>
		</article>
		<div class="clear"></div>
	</div>
<?php get_footer(); ?>