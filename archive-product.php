<?php get_header(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/product.css">

<section id="products">
  <h2 style="text-align:center;">Products</h2>
  <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = [
      'post_type'      => 'product',
      'posts_per_page' => 12,
      'paged'          => $paged,
      'post_status'    => 'publish'
    ];
    $products = new WP_Query($args);
  ?>
  <div class="product-list">
    <?php if ( $products->have_posts() ) : $i = 1; while ( $products->have_posts() ) : $products->the_post(); ?>
      <div class="prod-row">
        <div class="prod-logo">
          <?php
            $logo = get_field('product_logo');
            if ( $logo ) :
          ?>
            <a href="<?php the_permalink(); ?>">
              <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
            </a>
          <?php endif; ?>
        </div>
        <div class="prod-info">
          <div class="prod-title">
            <span><?php echo $i; ?>.</span>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </div>
          <div class="prod-tagline">
            <?php if ( get_field('product_tagline') ) : ?>
              <?php the_field('product_tagline'); ?>
            <?php else : ?>
              <?php echo wp_trim_words( get_the_content(), 15 ); ?>
            <?php endif; ?>
          </div>
          <div class="prod-tags">
            <?php
              $terms = get_the_terms(get_the_ID(), 'product_tag');
              if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                  echo esc_html($term->name) . ' &middot; ';
                }
              }
            ?>
          </div>
        </div>
        <div class="prod-actions">
          <div class="prod-action">
            <!-- Comment icon SVG -->
            <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <?php echo get_comments_number(); ?>
          </div>
          <div class="prod-action">
            <!-- Upvote icon SVG -->
            <!-- <svg viewBox="0 0 24 24"><path d="M12 4l6 12H6z"/></svg> -->
            <?php
            $user_id = get_current_user_id();
            $voters = get_post_meta(get_the_ID(), 'upvote_users', true);
            $voters = $voters ? (array) $voters : [];
            $already_voted = in_array($user_id, $voters);
            ?>
            <?php if ( is_user_logged_in() ) : ?>
              <button class="np-upvote-btn" data-post="<?php echo get_the_ID(); ?>"
                aria-label="Upvote"
                <?php if ($already_voted) echo 'disabled title="Already upvoted" style="cursor:not-allowed;opacity:0.5;"'; ?>
                style="background:none;border:none;cursor:pointer;">▲</button>
            <?php else : ?>
              <button class="np-upvote-btn" disabled title="Login to upvote" style="background:none;border:none;cursor:not-allowed;opacity:0.5;">▲</button>
            <?php endif; ?>
            <span class="np-upvote-count"><?php echo get_post_meta(get_the_ID(), 'upvotes', true) ?: '0'; ?></span>
          </div>
        </div>
      </div>
    <?php $i++; endwhile; else: ?>
      <p>No products found.</p>
    <?php endif; wp_reset_postdata(); ?>
  </div>
  <nav class="pagination">
    <?php
      echo paginate_links([
        'total'   => $products->max_num_pages,
        'current' => $paged
      ]);
    ?>
  </nav>
</section>

<?php get_footer(); ?>
