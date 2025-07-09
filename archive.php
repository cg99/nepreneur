<?php get_header(); ?>

<section id="archive">
  <h1><?php the_archive_title(); ?></h1>
  <div class="blog-list">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="card">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <small><?php the_time('F j, Y'); ?></small>
        <p><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
      </article>
    <?php endwhile; else : ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
