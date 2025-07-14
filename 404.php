<?php get_header(); ?>

<section id="not-found">
  <h1>Page Not Found</h1>
  <p>Sorry, the page you are looking for could not be found.</p>
  <?php get_search_form(); ?>
  <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">Back to Home</a></p>
</section>

<?php get_footer(); ?>

