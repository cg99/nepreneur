<?php get_header(); ?>

<section id="products">
  <h2>Products</h2>
  <div class="product-grid">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="prod-card">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium'); ?>
          </a>
        <?php endif; ?>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php if ( get_field('product_tagline') ) : ?>
          <p><?php the_field('product_tagline'); ?></p>
        <?php else : ?>
          <p><?php echo wp_trim_words( get_the_content(), 15 ); ?></p>
        <?php endif; ?>
      </article>
    <?php endwhile; else: ?>
      <p>No products found.</p>
    <?php endif; ?>
  </div>
  <nav class="pagination">
    <?php the_posts_pagination(); ?>
  </nav>
</section>

<?php get_footer(); ?>
