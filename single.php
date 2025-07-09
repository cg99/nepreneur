<?php get_header(); ?>

<section id="single-post">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article>
      <h1><?php the_title(); ?></h1>
      <small><?php the_time('F j, Y'); ?> by <?php the_author(); ?></small>
      <div><?php the_content(); ?></div>
    </article>
  <?php endwhile; endif; ?>
  <p><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn">Back to Blog</a></p>
</section>

<?php get_footer(); ?>