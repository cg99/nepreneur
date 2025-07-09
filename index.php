<?php get_header(); ?>

<section id="posts">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <article class="card">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <small><?php the_time('F j, Y'); ?> by <?php the_author(); ?></small>
        <p><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
      </article>
    <?php endwhile; ?>
  <?php else : ?>
    <p>No posts found.</p>
  <?php endif; ?>
</section>

<?php get_footer(); ?>
