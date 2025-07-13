<?php get_header(); ?>

<section id="blog">
  <?php nep_breadcrumbs(); ?>
  <h2>Latest Posts</h2>
  <div class="blog-list">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="card">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium'); ?>
          </a>
        <?php endif; ?>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <small><?php the_time('F j, Y'); ?></small>
        <p><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
      </article>
    <?php endwhile; else: ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </div>
  <nav class="pagination">
    <?php the_posts_pagination(); ?>
  </nav>
</section>

<?php get_footer(); ?>