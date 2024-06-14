<?php get_header(); ?>
	<div class="hero-inner">
		<?php the_title( '<h2>', '</h2>' ); ?>
	</div>
</div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php do_action( 'biw_page_top', get_the_ID() ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content" itemprop="mainContentOfPage">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); } ?>
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</div>
</article>
<?php if ( comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>