<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
  $logo_url       = home_url( '/wp-content/uploads/2026/02/logo.png' );
  $vc_phone       = get_theme_mod( 'vc_contact_phone', '' );
  $vc_btn_text    = get_theme_mod( 'vc_header_btn_text', 'Call Now' );
  $vc_phone_clean = preg_replace( '/[^0-9+]/', '', $vc_phone );
?>

<header class="vc-navbar" id="vc-navbar">
  <div class="vc-nav-inner">

<a href="<?php echo esc_url( home_url('/') ); ?>" class="vc-nav-logo">
  <img class="vc-logo-light" 
       src="<?php echo esc_url( home_url('/wp-content/uploads/2026/02/logo-light.svg') ); ?>" 
       alt="<?php bloginfo('name'); ?>">

  <img class="vc-logo-dark" 
       src="<?php echo esc_url( home_url('/wp-content/uploads/2026/02/logo-dark.svg') ); ?>" 
       alt="<?php bloginfo('name'); ?>">
</a>

    <div class="vc-nav-glass" id="vc-nav-glass">
      <ul class="vc-menu-list" id="vc-menu-list-inner">
        <?php
          $menu_rendered = false;
          if ( has_nav_menu( 'primary-menu' ) ) {
            wp_nav_menu( array(
              'theme_location' => 'primary-menu',
              'container'      => '',
              'menu_class'     => '',
              'items_wrap'     => '%3$s',
              'depth'          => 2,
              'fallback_cb'    => false,
            ) );
            $menu_rendered = true;
          }
          if ( ! $menu_rendered ) {
            $try = array( 'Primary Menu', 'primary-menu', 'VCP Menu', 'vcp-menu' );
            foreach ( $try as $name ) {
              if ( wp_get_nav_menu_object( $name ) ) {
                wp_nav_menu( array(
                  'menu'        => $name,
                  'container'   => '',
                  'menu_class'  => '',
                  'items_wrap'  => '%3$s',
                  'depth'       => 2,
                  'fallback_cb' => false,
                ) );
                $menu_rendered = true;
                break;
              }
            }
          }
          if ( ! $menu_rendered ) {
            echo '<li><a href="' . esc_url( home_url('/') ) . '">Home</a></li>';
            wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
          }
        ?>
      </ul>
    </div>

    <div class="vc-nav-actions">
      <a href="tel:<?php echo esc_attr( $vc_phone_clean ); ?>" class="vc-nav-cta">
    <span class="vc-cta-blue"><?php echo esc_html( $vc_btn_text ); ?></span>

    <span class="vc-cta-white">
        <img src="<?php echo wp_get_upload_dir()['baseurl'] . '/2026/02/phone_icon.png'; ?>" 
             alt="Call Icon"
             class="vc-phone-icon">
    </span>
</a>
      <button class="vc-hamburger" id="vc-hamburger" type="button" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>

  </div>
</header>

<!-- MOBILE OVERLAY — MUST be outside <header> because backdrop-filter
     on .vc-navbar creates a new containing block that breaks position:fixed
     on children. This is per CSS spec, not a bug. -->
<div class="vc-mobile-overlay" id="vc-mobile-overlay">
  <div class="vc-mobile-overlay-inner">
    <nav class="vc-mobile-nav">
      <?php
        $mob_rendered = false;
        if ( has_nav_menu( 'primary-menu' ) ) {
          wp_nav_menu( array(
            'theme_location' => 'primary-menu',
            'container'      => '',
            'menu_class'     => 'vc-mobile-menu-list',
            'depth'          => 2,
            'fallback_cb'    => false,
          ) );
          $mob_rendered = true;
        }
        if ( ! $mob_rendered ) {
          $try = array( 'Primary Menu', 'primary-menu', 'VCP Menu', 'vcp-menu' );
          foreach ( $try as $name ) {
            if ( wp_get_nav_menu_object( $name ) ) {
              wp_nav_menu( array(
                'menu'        => $name,
                'container'   => '',
                'menu_class'  => 'vc-mobile-menu-list',
                'depth'       => 2,
                'fallback_cb' => false,
              ) );
              $mob_rendered = true;
              break;
            }
          }
        }
        if ( ! $mob_rendered ) {
          echo '<ul class="vc-mobile-menu-list">';
          echo '<li><a href="' . esc_url( home_url('/') ) . '">Home</a></li>';
          wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
          echo '</ul>';
        }
      ?>
    </nav>
    <!-- <a href="tel:<?php echo esc_attr( $vc_phone_clean ); ?>" class="vc-mobile-cta">
      <span class="vc-mobile-cta-text"><?php echo esc_html( $vc_btn_text ); ?></span>
      <span class="vc-mobile-cta-icon">
        <svg width="21" height="29" viewBox="0 0 21 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.44 18.88L15.09 17.13C14.8243 17.0202 14.5338 16.9868 14.2505 17.0334C13.9672 17.08 13.7022 17.2047 13.485 17.3934L11.595 19.0584C9.20862 17.7998 7.26521 15.8564 6.00659 13.47L7.67159 11.58C7.86057 11.3629 7.98554 11.0979 8.03221 10.8145C8.07889 10.5312 8.04537 10.2406 7.93559 9.975L6.18559 5.625C6.0643 5.33167 5.85332 5.08506 5.58191 4.91954C5.31049 4.75402 4.99268 4.67785 4.67459 4.7025L1.70459 4.935C1.36687 4.96109 1.05398 5.11396 0.826469 5.36284C0.598961 5.61173 0.474694 5.9375 0.478588 6.2763C0.645 13.8921 6.48 20.2884 13.875 21.4875L14.28 21.5484C14.6155 21.5848 14.9538 21.4779 15.2146 21.2519C15.4753 21.0259 15.6372 20.7001 15.6624 20.3484L15.8949 17.3784C15.9195 17.0603 15.8433 16.7425 15.6778 16.4711C15.5123 16.1997 15.2657 15.9887 14.9724 15.8674L19.44 18.88Z" fill="#0446F2"/></svg>
      </span>
    </a> -->
  </div>
</div>