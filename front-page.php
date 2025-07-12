<?php get_header(); ?>

<section id="hero" class="hero-split">
  <div class="hero-content">
    <!-- Rocket SVG Icon -->
    <span class="icon-hero" aria-hidden="true">
      <svg width="36" height="36" viewBox="0 0 24 24" fill="none"><path d="M2 16l6 6m0 0l4-10 8-8-10 4-8 8zm0 0l4-4" stroke="#E4572E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </span>
    <h1>Igniting Nepal's <br>Entrepreneurial Spirit</h1>
    <p>Connect with founders, mentors & investors driving innovation across Nepal.</p>
    <a href="#cta" class="btn">Join the Community</a>
  </div>
  <div class="hero-image">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/hero.png" alt="Kathmandu skyline with Himalayan backdrop">
  </div>
</section>

<section id="about">
  <h2>
    <!-- Lightbulb SVG Icon -->
    <span class="icon-about" aria-hidden="true">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2a7 7 0 0 0-7 7c0 3.5 2.5 5.5 3.5 6.5v2a1.5 1.5 0 0 0 3 0v-2C16.5 14.5 19 12.5 19 9a7 7 0 0 0-7-7z" stroke="#F3A712" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21h6" stroke="#F3A712" stroke-width="2" stroke-linecap="round"/></svg>
    </span>
    About Nepreneur
  </h2>
  <p>Launched in 2025, Nepreneur is a catalyst for <strong>knowledge-sharing, funding, and networking</strong> among Nepal-based startups and SMEs. We believe every ambitious founder deserves world-class resources at home.</p>
</section>

<section id="services">
  <h2>What We Offer</h2>

  <div class="services-grid">
    <article class="card">
      <!-- Toolbox SVG Icon -->
      <span class="icon-service" aria-hidden="true">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="3" y="7" width="18" height="13" rx="2" stroke="#17BEBB" stroke-width="2"/><path d="M16 3v4M8 3v4" stroke="#17BEBB" stroke-width="2" stroke-linecap="round"/><path d="M3 12h18" stroke="#17BEBB" stroke-width="2"/></svg>
      </span>
      <h3>Startup Bootcamps</h3>
      <p>Validate, build, and launch in 12 weeks through cohort-based mentoring.</p>
    </article>

    <article class="card">
      <!-- Handshake SVG Icon -->
      <span class="icon-service" aria-hidden="true">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M17 11l4-4a2.828 2.828 0 0 0-4-4l-4 4" stroke="#17BEBB" stroke-width="2" stroke-linecap="round"/><path d="M7 13l-4 4a2.828 2.828 0 0 0 4 4l4-4" stroke="#17BEBB" stroke-width="2" stroke-linecap="round"/><path d="M8 12l8 0" stroke="#17BEBB" stroke-width="2" stroke-linecap="round"/></svg>
      </span>
      <h3>Investor Matchmaking</h3>
      <p>Pitch nights & curated intros connecting you with angels and seed-stage VCs.</p>
    </article>

    <article class="card">
      <!-- Book SVG Icon -->
      <span class="icon-service" aria-hidden="true">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" stroke="#17BEBB" stroke-width="2"/><path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5V4.5z" stroke="#17BEBB" stroke-width="2"/></svg>
      </span>
      <h3>Founder Resources</h3>
      <p>Playbooks, legal templates, and a lively Viber community—totally free.</p>
    </article>
  </div>
</section>

<section id="cta">
  <h2>
    <!-- Star SVG Icon -->
    <span class="icon-cta" aria-hidden="true">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><polygon points="12 2 15 8.5 22 9.3 17 14.1 18.2 21 12 17.8 5.8 21 7 14.1 2 9.3 9 8.5 12 2" stroke="#E4572E" stroke-width="2" stroke-linejoin="round"/></svg>
    </span>
    Ready to level-up?
  </h2>
  <p>Become a member and unlock exclusive workshops, events & perks.</p>
  <a href="<?php echo esc_url( site_url('/join') ); ?>" class="btn">Sign Up Now</a>
</section>

<section id="recent-posts">
  <h2>
    <!-- Newspaper SVG Icon -->
    <span class="icon-posts" aria-hidden="true">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="14" rx="2" stroke="#3A6EA5" stroke-width="2"/><path d="M7 9h10M7 13h6" stroke="#3A6EA5" stroke-width="2" stroke-linecap="round"/></svg>
    </span>
    Recent Posts
  </h2>
  <div class="blog-list">
    <?php
      $recent_posts = new WP_Query([
        'posts_per_page' => 3
      ]);
      if ( $recent_posts->have_posts() ) :
        while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
    ?>
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
    <?php endwhile; endif; wp_reset_postdata(); ?>
  </div>
</section>
<?php get_footer(); ?>