<?php get_header(); ?>

<section id="single-post">
  <?php nep_breadcrumbs(); ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article>
      <h1><?php the_title(); ?></h1>
      <small><?php the_time('F j, Y'); ?> by <?php the_author(); ?></small>
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="featured-image">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>
      <div><?php the_content(); ?></div>

      <?php if ( comments_open() || get_comments_number() ) : ?>
        <section class="comments-area">
          <?php comments_template(); ?>
        </section>
      <?php endif; ?>

    </article>
  <?php endwhile; endif; ?>
  <p><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn">Back to Blog</a></p>
</section>
<?php get_footer(); ?>
