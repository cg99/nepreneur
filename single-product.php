<?php
/*  Template: single-product.php  (for CPT slug: product)  */
get_header();

/* --------------------------------------------------------------------
 *  Main loop — one product per page
 * ------------------------------------------------------------------*/
if ( have_posts() ) :
	while ( have_posts() ) : the_post();

		// ACF fields
		$logo    = get_field( 'product_logo' );    // array
		$tagline = get_field( 'product_tagline' );
		$url     = get_field( 'product_website' );
		$stage   = ucfirst( get_field( 'product_stage' ) );
		$sector  = ucfirst( get_field( 'product_sector' ) );
		$votes   = do_shortcode( '[upvote]' );      // WP Upvote shortcode
?>
<article class="product-single">

	<!-- Hero -->
	<header class="product-hero">
		<?php if ( $logo ) : ?>
			<img src="<?php echo esc_url( $logo['sizes']['medium'] ); ?>"
			     alt="<?php the_title_attribute(); ?>"
			     class="product-logo" />
		<?php endif; ?>

		<div class="hero-text">
			<h1><?php the_title(); ?></h1>
			<?php if ( $tagline ) : ?>
				<p class="tagline"><?php echo esc_html( $tagline ); ?></p>
			<?php endif; ?>

			<!-- Meta chips -->
			<ul class="meta-chips">
				<li><span class="chip stage"><?php echo esc_html( $stage ); ?></span></li>
				<li><span class="chip sector"><?php echo esc_html( $sector ); ?></span></li>
				<?php if ( $url ) : ?>
					<li><a class="chip website" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">Visit site ↗</a></li>
				<?php endif; ?>
				<li class="chip votes"><?php echo $votes; ?></li>
			</ul>
		</div>
	</header>

	<!-- Body copy -->
	<section class="product-content">
		<?php the_content(); ?>
	</section>

</article>

<?php
	/* ----------------------------------------------------------------
	 *  Related products — same sector, exclude current post
	 * ---------------------------------------------------------------*/
	$related = new WP_Query( [
		'post_type'      => 'product',
		'posts_per_page' => 3,
		'post__not_in'   => [ get_the_ID() ],
		'meta_key'       => 'product_sector',
		'meta_value'     => get_field( 'product_sector' )
	] );

	if ( $related->have_posts() ) : ?>
		<section class="related-products">
			<h2>More in <?php echo esc_html( $sector ); ?></h2>

			<div class="related-grid">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<a href="<?php the_permalink(); ?>" class="rel-card">
						<?php the_post_thumbnail( 'thumbnail' ); ?>
						<h3><?php the_title(); ?></h3>
						<p><?php the_field( 'product_tagline' ); ?></p>
					</a>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- Comments -->
	<?php comments_template(); ?>

<?php
	endwhile;
endif;

get_footer();
