<?php get_header(); ?>

<section id="blog">
  <h2>Latest Posts</h2>
  <div class="blog-list">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="card">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <small><?php the_time('F j, Y'); ?></small>
        <p><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
      </article>
    <?php endwhile; else: ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>