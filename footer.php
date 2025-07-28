<footer class="np-footer">
<section>
	<!-- CTA ribbon -->
	<section class="np-footer__cta">
		<div class="np-cta__content">
			<h2>Get started today<br>for better future finance</h2>
			<p>Nepreneur is a compass for business leaders—scale with custom tools, investor access and more.</p>
		</div>

		<form class="np-cta__form" action="<?php echo esc_url( home_url('/subscribe') ); ?>" method="post">
			<input type="email" name="email" placeholder="Your email" required>
			<button type="submit">Get Started</button>
		</form>
	</section>

	<!-- Main footer -->
	<div class="np-footer__inner">
		<!-- Column: brand -->
		<div class="np-footer__brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?> Logo" style="height:100px;">
            </a>
		</div>

		<!-- Columns -->
		<div class="np-footer__columns">
			<div class="np-col">
				<h5>Platform</h5>
				<ul>
                                        <li><a href="<?php echo esc_url( site_url( '/about' ) ); ?>">Why Nepreneur?</a></li>
                                        <li><a href="<?php echo esc_url( site_url( '/pricing' ) ); ?>">Pricing</a></li>
                                        <li><a href="<?php echo esc_url( site_url( '/faq' ) ); ?>">FAQ</a></li>
				</ul>
			</div>
			<div class="np-col">
				<h5>Features</h5>
				<ul>
                                        <li><a href="<?php echo esc_url( site_url( '/payments' ) ); ?>">Payments</a></li>
                                        <li><a href="<?php echo esc_url( site_url( '/api' ) ); ?>">API</a></li>
                                        <li><a href="<?php echo esc_url( site_url( '/ecommerce' ) ); ?>">E-commerce</a></li>
                                        <li><a href="<?php echo esc_url( site_url( '/business' ) ); ?>">Business</a></li>
				</ul>
			</div>
			<div class="np-col">
				<h5>Company</h5>
				<ul>
                                        <li><a href="<?php echo esc_url( site_url( '/about' ) ); ?>">About Us</a></li>
                                        <li><a href="<?php echo esc_url( site_url( '/career' ) ); ?>">Career</a></li>
                                        <li><a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>">Blog</a></li>
				</ul>
			</div>
		</div>

        <!-- Social -->
        <div class="np-footer__social">
            <a href="https://facebook.com/nepreneur" target="_blank" rel="noopener" aria-label="Facebook">
                <!-- Facebook SVG -->
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 5 3.657 9.127 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.632.771-1.632 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.127 22 17 22 12z" fill="#1877F3"/>
                    <path d="M15.357 14.89l.443-2.89h-2.773v-1.875c0-.791.39-1.562 1.632-1.562h1.26v-2.46s-1.144-.195-2.238-.195c-2.285 0-3.777 1.384-3.777 3.89v2.016h-2.54v2.89h2.54v6.987a10.06 10.06 0 003.124 0v-6.987h2.33z" fill="#fff"/>
                </svg>
            </a>
            <a href="https://linkedin.com/company/nepreneur" target="_blank" rel="noopener" aria-label="LinkedIn">
                <!-- LinkedIn SVG -->
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 0h-14C2.239 0 0 2.239 0 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5V5c0-2.761-2.239-5-5-5z" fill="#0077B5"/>
                    <path d="M7.119 19H4.56V9h2.559v10zM5.84 7.75a1.48 1.48 0 110-2.96 1.48 1.48 0 010 2.96zM19 19h-2.56v-4.8c0-1.143-.021-2.613-1.594-2.613-1.594 0-1.838 1.246-1.838 2.532V19H10.45V9h2.46v1.364h.035c.343-.65 1.184-1.338 2.438-1.338 2.607 0 3.088 1.715 3.088 3.946V19z" fill="#fff"/>
                </svg>
            </a>
            <a href="https://twitter.com/nepreneur" target="_blank" rel="noopener" aria-label="Twitter">
                <!-- Twitter SVG -->
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M24 4.557a9.83 9.83 0 01-2.828.775 4.932 4.932 0 002.165-2.724c-.951.564-2.005.974-3.127 1.195A4.916 4.916 0 0016.616 3c-2.717 0-4.924 2.206-4.924 4.924 0 .386.044.763.127 1.124C7.728 8.807 4.1 6.884 1.671 3.965c-.423.724-.666 1.561-.666 2.475 0 1.708.87 3.216 2.188 4.099a4.904 4.904 0 01-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 01-2.224.084c.627 1.956 2.444 3.377 4.6 3.417A9.867 9.867 0 010 21.543a13.94 13.94 0 007.548 2.212c9.057 0 14.009-7.513 14.009-14.009 0-.213-.005-.425-.014-.636A10.025 10.025 0 0024 4.557z" fill="#1DA1F2"/>
                </svg>
            </a>
        </div>
	</div>

	<!-- Bottom bar -->
	<div class="np-footer__bar">
		<small>&copy; <?php echo date( 'Y' ); ?> Nepreneur. All rights reserved.</small>
	</div>
</section>
</footer>

<?php wp_footer(); ?>
</body>
</html>