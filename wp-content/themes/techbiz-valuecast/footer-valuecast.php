

<!-- ═══════════════════════════════════════════════════════════
     VALUECAST FOOTER
════════════════════════════════════════════════════════════════ -->
<footer class="site-footer">
  <div class="footer-container">

    <!-- Main: Logo Left | Nav + Contact Right -->
    <div class="footer-main">

      <!-- Left: Logo -->
      <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo">
        <img src="<?php echo esc_url( home_url('/wp-content/uploads/2026/04/valuecast-footer.png') ); ?>" alt="<?php bloginfo('name'); ?>" />
      </a>

      <!-- Right: Nav + Contact/Social -->
      <div class="footer-right">

        <!-- Navigation -->
        <nav class="footer-nav">
          <ul>
            <?php
            $footer_links = array(
              'Our Approach'  => '/our-approach',
              'Our Portfolio' => '/our-portfolio',
              'About us'      => '/about-us',
              'Blog'          => '/blog',
              'Contact us'    => '/contact-us',
            );
            foreach ( $footer_links as $label => $path ) : ?>
              <li><a href="<?php echo esc_url( home_url( $path ) ); ?>"><?php echo esc_html( $label ); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </nav>

        <!-- Contact + Social -->
        <div class="footer-info">
          <div class="footer-contact">
            <?php
            $email = 'info@valuecastpartners.com';
            $phone = get_theme_mod( 'vc_contact_phone', '123-456-7890' );
            $phone_clean = preg_replace( '/[^0-9+]/', '', $phone );
            ?>
            <div class="footer-contact-row">
              <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="16" x="2" y="4" rx="2"/>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                </svg>
                <span><?php echo esc_html( $email ); ?></span>
              </a>
              <div class="footer-social">
                <a href="https://www.linkedin.com/company/valuecast-partners/" target="_blank" rel="noopener noreferrer" class="social-item social-linkedin" aria-label="Valuecast Partners on LinkedIn">
                  <img src="<?php echo esc_url( home_url('/wp-content/uploads/2026/04/linkdin.svg') ); ?>" alt="LinkedIn" />
                  <span>Linkedin</span>
                </a>
                <!-- <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="social-item">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                  </svg>
                  <span>Facebook</span>
                </a> -->
              </div>
            </div>
            <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="contact-item">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
              <span><?php echo esc_html( $phone ); ?></span>
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- Divider -->
    <hr class="footer-divider" />

    <!-- Bottom: Copyright + Legal -->
    <div class="footer-bottom">
      <p class="copyright">Copyright &copy; <?php echo date('Y'); ?>, <?php bloginfo('name'); ?></p>
      <nav class="footer-legal">
        <a href="<?php echo esc_url( home_url('/terms-and-conditions') ); ?>">Terms and Conditions</a>
        <a href="<?php echo esc_url( home_url('/privacy-policy') ); ?>">Privacy Policy</a>
      </nav>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

