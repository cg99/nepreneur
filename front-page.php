<?php get_header(); ?>

<section id="hero" class="hero-split">
  <div class="hero-content">
    <h1>Igniting Nepal's <br>Entrepreneurial Spirit</h1>
    <p>Connect with founders, mentors & investors driving innovation across Nepal.</p>
    <a href="#cta" class="btn">Join the Community</a>
  </div>
  <div class="hero-image">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/hero.png" alt="Kathmandu skyline with Himalayan backdrop">
  </div>
</section>

<section id="about">
  <h2>About Nepreneur</h2>
  <p>Launched in 2025, Nepreneur is a catalyst for <strong>knowledge-sharing, funding, and networking</strong> among Nepal-based startups and SMEs. We believe every ambitious founder deserves world-class resources at home.</p>
</section>

<section id="services">
  <h2>What We Offer</h2>

  <div class="services-grid">
    <article class="card">
      <h3>Startup Bootcamps</h3>
      <p>Validate, build, and launch in 12 weeks through cohort-based mentoring.</p>
    </article>

    <article class="card">
      <h3>Investor Matchmaking</h3>
      <p>Pitch nights & curated intros connecting you with angels and seed-stage VCs.</p>
    </article>

    <article class="card">
      <h3>Founder Resources</h3>
      <p>Playbooks, legal templates, and a lively Slack community—totally free.</p>
    </article>
  </div>
</section>

<section id="cta">
  <h2>Ready to level-up?</h2>
  <p>Become a member and unlock exclusive workshops, events & perks.</p>
  <a href="<?php echo esc_url( site_url('/signup') ); ?>" class="btn">Sign Up Now</a>
</section>

<section id="contact">
  <h2>Contact</h2>
  <p>Email <a href="mailto:hello@nepreneur.com">hello@nepreneur.com</a> • 
     <a href="https://twitter.com/nepreneur" target="_blank" rel="noopener">Twitter</a></p>
</section>

<?php get_footer(); ?>