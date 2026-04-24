<?php
/**
 * Front Page Template – Valuecast Homepage
 *
 * WordPress automatically uses this file when:
 *  Settings > Reading > "Your homepage displays" is set to a static page.
 *
 * The Techbiz parent theme header/footer are reused unchanged.
 * Only the page content area is replaced with Valuecast sections.
 */

// Pull customizer values (with fallbacks)
$eyebrow = get_theme_mod('vc_hero_eyebrow', 'We are Valuecast Partners');
$headline = get_theme_mod('vc_hero_headline', 'Building The Future');
$subheadline = get_theme_mod('vc_hero_subheadline', 'of the middle market.');
$subheadline_clean = rtrim($subheadline, ". \t\n\r\0\x0B");
$description = get_theme_mod('vc_hero_description', "We're not a private equity firm — we're builders of an ecosystem. Operators, founders, and data that work together to help companies grow profitably and purposefully.");
$cta1_text = get_theme_mod('vc_hero_cta1_text', 'Explore More');
$cta1_url = get_theme_mod('vc_hero_cta1_url', '#mission');
$cta2_text = get_theme_mod('vc_hero_cta2_text', 'Our Team');
$cta2_url = get_theme_mod('vc_hero_cta2_url', '#team');
$email = get_theme_mod('vc_contact_email', 'info@valuecast.com');
$phone = get_theme_mod('vc_contact_phone', '+1 (555) 123-4567');
$cta_hl = get_theme_mod('vc_cta_headline', 'Explore Your Options');
$cta_btn = get_theme_mod('vc_cta_btn_text', 'Schedule a Free Demo Call');
$cta_url = get_theme_mod('vc_cta_btn_url', '#contact');
$video_url = valuecast_video_url();

// Arrow SVG helper
$arrow = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M20.7806 12.5306L14.0306 19.2806C13.8899 19.4213 13.699 19.5004 13.5 19.5004C13.301 19.5004 13.1101 19.4213 12.9694 19.2806C12.8286 19.1399 12.7496 18.949 12.7496 18.75C12.7496 18.551 12.8286 18.3601 12.9694 18.2194L18.4397 12.75H3.75C3.55109 12.75 3.36032 12.671 3.21967 12.5303C3.07902 12.3897 3 12.1989 3 12C3 11.8011 3.07902 11.6103 3.21967 11.4697C3.36032 11.329 3.55109 11.25 3.75 11.25H18.4397L12.9694 5.78061C12.8286 5.63988 12.7496 5.44901 12.7496 5.24999C12.7496 5.05097 12.8286 4.8601 12.9694 4.71936C13.1101 4.57863 13.301 4.49957 13.5 4.49957C13.699 4.49957 13.8899 4.57863 14.0306 4.71936L20.7806 11.4694C20.8504 11.539 20.9057 11.6217 20.9434 11.7128C20.9812 11.8038 21.0006 11.9014 21.0006 12C21.0006 12.0986 20.9812 12.1961 20.9434 12.2872C20.9057 12.3782 20.8504 12.461 20.7806 12.5306Z" fill="white"/>
</svg>';
$arrow_b = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M20.7806 12.5306L14.0306 19.2806C13.8899 19.4213 13.699 19.5003 13.5 19.5003C13.301 19.5003 13.1101 19.4213 12.9694 19.2806C12.8286 19.1398 12.7496 18.949 12.7496 18.7499C12.7496 18.5509 12.8286 18.36 12.9694 18.2193L18.4397 12.7499H3.75C3.55109 12.7499 3.36032 12.6709 3.21967 12.5303C3.07902 12.3896 3 12.1988 3 11.9999C3 11.801 3.07902 11.6103 3.21967 11.4696C3.36032 11.3289 3.55109 11.2499 3.75 11.2499H18.4397L12.9694 5.78055C12.8286 5.63982 12.7496 5.44895 12.7496 5.24993C12.7496 5.05091 12.8286 4.86003 12.9694 4.7193C13.1101 4.57857 13.301 4.49951 13.5 4.49951C13.699 4.49951 13.8899 4.57857 14.0306 4.7193L20.7806 11.4693C20.8504 11.539 20.9057 11.6217 20.9434 11.7127C20.9812 11.8038 21.0006 11.9014 21.0006 11.9999C21.0006 12.0985 20.9812 12.1961 20.9434 12.2871C20.9057 12.3782 20.8504 12.4609 20.7806 12.5306Z" fill="white"/>
</svg>';

// Use custom Valuecast header (bypasses parent theme header/breadcrumb)
get_header('valuecast');
?>

<!-- ═══════════════════════════════════════════════════════════
     HERO SECTION
════════════════════════════════════════════════════════════════ -->
<section class="vc-hero" id="home">
  <div class="vc-hero-bg">
    <video autoplay muted loop playsinline preload="auto">
      <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
    </video>
  </div>
  <div class="vc-hero-overlay"></div>
  <div class="vc-hero-content vc-container">
    <div class="vc-hero-kicker">
      <span class="vc-hero-kicker-dot" aria-hidden="true"></span>
      <span class="vc-hero-eyebrow"><?php echo esc_html($eyebrow); ?></span>
    </div>
    <h1 class="building-the-future-container">
      <span class="vc-hero-title-main"><?php echo esc_html($headline); ?></span><br>
      <span class="vc-hero-title-sub"><?php echo esc_html($subheadline_clean); ?></span>
    </h1>
    <p class="vc-hero-sub"><?php echo esc_html($description); ?></p>
    <div class="vc-hero-actions">
      <a href="<?php echo esc_url($cta1_url); ?>" class="vc-btn-p">
        <?php echo esc_html($cta1_text); ?>
        <span class="vc-ico"><?php echo $arrow; ?></span>
      </a>
      <a href="<?php echo esc_url($cta2_url); ?>" class="vc-btn-s">
        <?php echo esc_html($cta2_text); ?>
        <span class="vc-ico"><?php echo $arrow; ?></span>
      </a>
    </div>
  </div>
  <div class="vc-hero-fade"></div>
    <!-- Figma: bottom-left decorative arrow -->
  <div class="vc-hero-arrow" aria-hidden="true">
    <svg xmlns="http://www.w3.org/2000/svg" width="429" height="125" viewBox="0 0 429 125" fill="none">
      <path d="M308.212 5.27982e-06L-224 2.85435e-05L-224 125L308.212 125L429 62.5L308.212 5.27982e-06Z" fill="white"/>
    </svg>
  </div>
</section>

<div class="vc-home-strip-image" aria-hidden="true">
  <img class="vc-home-strip-image__img" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/frame-2147227759.png' ) ); ?>" alt="" loading="lazy">
</div>


<!-- ═══════════════════════════════════════════════════════════
     MARQUEE 1
════════════════════════════════════════════════════════════════ -->
<div class="vc-mq1">
  <div class="vc-mq1-track">
    <?php for ($i = 0; $i < 8; $i++): ?>
      <span<?php echo $i % 2 === 1 ? ' class="on"' : ''; ?>>our mission is simple</span>
      <?php endfor; ?>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MISSION
════════════════════════════════════════════════════════════════ -->
<section class="vc-mission" id="mission">
  <div class="vc-container">
    <!-- <span class="vc-lbl">Our Mission</span> -->
    <!-- <h2>our mission is simple</h2> -->
    <p>
      <?php echo esc_html(get_theme_mod('vc_mission_text', 'To help mid-market businesses grow like Fortune 500s — with speed, precision, and resilience.')); ?>
    </p>
    <a href="#focus-areas" class="vc-btn-o">
      Explore More
      <span class="vc-ico-b"><?php echo $arrow; ?></span>
    </a>
  </div>
  
</section>

<!-- ═══════════════════════════════════════════════════════════
     FOCUS AREAS
════════════════════════════════════════════════════════════════ -->
<section class="vc-focus" id="focus-areas">
  <div class="vc-container">
    <span class="vc-lbl">Focus Areas</span>
    <div class="vc-focus-layout">
      <div class="vc-tabs">
        <?php
        $tabs = array(
          'digital'    => 'Digital Marketing',
          'ecommerce'  => 'Amazon & E-Commerce Growth',
          'influencer' => 'Influencer & Creator Management',
          'ai'         => 'AI-Powered Business Intelligence',
          'creative'   => 'Creative & Brand Studios',
        );
        $first = true;
        foreach ( $tabs as $key => $label ) :
        ?>
          <button class="vc-tab<?php echo $first ? ' active' : ''; ?>" data-tab="<?php echo esc_attr( $key ); ?>">
            <?php echo esc_html( $label ); ?>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </button>
        <?php $first = false; endforeach; ?>
      </div>

      <div class="vc-panes">

        <div class="vc-pane active" id="vc-tab-digital">
          <h3>Digital Marketing</h3>
          <p>We design and execute data-driven digital marketing strategies across channels — search, social, performance media, content, and automation — to attract the right audiences, increase engagement, and consistently convert demand into measurable growth.</p>
          <div class="vc-fvis">
            <img src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_digital', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/digital-marketing.png' ) ) ); ?>" alt="Digital Marketing" loading="lazy">
          </div>
        </div>

        <div class="vc-pane" id="vc-tab-ecommerce">
          <h3>Amazon & E-commerce Growth</h3>
          <p>We scale Amazon and e-commerce businesses end to end — from marketplace strategy and storefront optimization to performance advertising, conversion rate improvement, and lifecycle retention — driving sustainable revenue growth across platforms.</p>
          <div class="vc-fvis">
            <img src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_ecommerce', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/amazon-ecommerce-growth.png' ) ) ); ?>" alt="Amazon &amp; E-Commerce Growth" loading="lazy">
          </div>
        </div>

        <div class="vc-pane" id="vc-tab-influencer">
          <h3>Integrate Into the Valuecast Ecosystem</h3>
          <ul class="vc-inf-list" data-model-id="439:3641">
            <li class="vc-inf-item">
              <img class="vc-inf-icon" src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_influencer', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/megaphone.svg' ) ) ); ?>" alt="Megaphone icon" />
              <span class="vc-inf-text">Digital marketing specialists</span>
            </li>
            <li class="vc-inf-item">
              <img class="vc-inf-icon" src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_influencer', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/pennib.svg' ) ) ); ?>" alt="Pen nib icon" />
              <span class="vc-inf-text">Creative teams</span>
            </li>
            <li class="vc-inf-item">
              <img class="vc-inf-icon" src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_influencer', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/shoppingbag.svg' ) ) ); ?>" alt="Shopping bag icon" />
              <span class="vc-inf-text">Web and e-commerce experts</span>
            </li>
            <li class="vc-inf-item">
              <img class="vc-inf-icon" src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_influencer', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/usersthree.svg' ) ) ); ?>" alt="Three users icon" />
              <span class="vc-inf-text">India GCC talent resources</span>
            </li>
            <li class="vc-inf-item">
              <img class="vc-inf-icon" src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_influencer', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/headcircuit.svg' ) ) ); ?>" alt="Head circuit icon" />
              <span class="vc-inf-text">AI analysts</span>
            </li>
          </ul>
          <div class="vc-fvis">
            <img src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_influencer', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/integrate-into-valuecast.png' ) ) ); ?>" alt="Influencer &amp; Creator Management" loading="lazy">
          </div>
        </div>

        <div class="vc-pane" id="vc-tab-ai">
          <h3>AI-Powered Business Intelligence</h3>
          <p>We craft distinctive brand and creative systems — spanning identity, storytelling, design, and production — that translate strategy into memorable experiences and consistently elevate how brands show up everywhere.</p>

          <div class="vc-fvis">
            <img src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_ai', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/drive-ai-power.png' ) ) ); ?>" alt="AI-Powered Business Intelligence" loading="lazy">
          </div>
        </div>

        <div class="vc-pane" id="vc-tab-creative">
          <h3>Creative & Brand Studios</h3>
          <p>We turn data into decision-making advantage using AI-powered intelligence — unifying analytics, predictive insights, and real-time dashboards — to reveal opportunities, reduce risk, and accelerate smarter business outcomes.</p>
          <div class="vc-fvis">
            <img src="<?php echo esc_url( get_theme_mod( 'vc_focus_image_creative', home_url( '/wp-content/themes/techbiz-valuecast/assets/images/compound-long.png' ) ) ); ?>" alt="Creative &amp; Brand Studios" loading="lazy">
          </div>
        </div>

      </div><!-- .vc-panes -->
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     WHY IT MATTERS COPY
════════════════════════════════════════════════════════════════ -->
<section class="vc-why-copy-section" aria-labelledby="vc-why-copy-title">
  <div class="vc-container">
    <div class="vc-why-copy-intro">
      <span class="vc-why-copy-eyebrow">WHY IT MATTERS</span>
      <h2 class="vc-why-copy-title" id="vc-why-copy-title">The middle market is the core of global growth - but it's underserved</h2>
    </div>

    <div class="vc-why-copy-grid">
      <article class="vc-why-copy-card vc-why-copy-card-problem">
        <span class="vc-why-chip vc-why-chip-problem">PROBLEM</span>
        <p>Traditional private equity, legacy agency models, and siloed service providers often overlook mid-sized businesses.</p>
      </article>

      <div class="vc-why-copy-divider" aria-hidden="true">
        <span>WE CHANGE THAT</span>
        <img src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/vector-1-1.svg' ) ); ?>" alt="">
      </div>

      <article class="vc-why-copy-card vc-why-copy-card-solution">
  <span class="vc-why-chip vc-why-chip-solution">
    
    <span class="vc-chip-icon">
      <!-- Paste your SVG here -->
      <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M3.82457 0H12.1642V1.9075H1.93359L3.82457 0Z" fill="white"/>
  <path d="M10.2291 3.77408V11.9998H12.1641V1.90723L10.2291 3.77408Z" fill="white"/>
  <path d="M3.82457 2.96851H9.15511V4.87601H1.93359L3.82457 2.96851Z" fill="white"/>
  <path d="M7.22162 6.74143V12H9.15522V4.87598L7.22162 6.74143Z" fill="white"/>
  <path d="M0 6.74143V12H1.9336V4.87598L0 6.74143Z" fill="white"/>
</svg>
    </span>

    VALUECAST SOLUTION
  </span>

  <p>Valuecast brings enterprise-grade tools, global talent, and hands-on operator experience directly to the middle market.</p>
</article>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     WHY IT MATTERS GLOBE
════════════════════════════════════════════════════════════════ -->
<section class="vc-why" id="why" style="position: relative; overflow: hidden;">
  <div id="vc-globe-container"></div>
  <div class="vc-why-figma-overlay" aria-hidden="true">
    <div class="frame-46">
      <div class="frame-47">
        <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/warningcircle.svg' ) ); ?>" alt="">
      </div>
      <div class="text-wrapper-25">Mid-Market Underserved</div>
    </div>

    <div class="frame-48">
      <div class="frame-49">
        <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/warningcircle.svg' ) ); ?>" alt="">
      </div>
      <div class="text-wrapper-25">Capital Access Gap</div>
    </div>

    <div class="frame-53">
            <div class="frame-49">
              <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/warningcircle.svg' ) ); ?>" />
            </div>
            <div class="text-wrapper-25">Fragmented Advisory Services</div>
          </div>

    <div class="frame-50">
      <div class="frame-49">
        <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/warningcircle.svg' ) ); ?>" alt="">
      </div>
      <div class="text-wrapper-25">Legacy Financial Models</div>
    </div>

    <div class="frame-51">
      <div class="frame-49">
        <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/warningcircle.svg' ) ); ?>" alt="">
      </div>
      <div class="text-wrapper-25">Inefficient Capital Deployment</div>
    </div>

    <img class="frame-52" src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/valueast-partners-svg-logo.svg' ) ); ?>" alt="ValueCast Partners">

    <img class="vector-11" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-26.svg' ) ); ?>" alt="">
    <img class="vector-12" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-32.svg' ) ); ?>" alt="">
    <img class="vector-13" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-35.svg' ) ); ?>" alt="">
    <img class="vector-14" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-29.svg' ) ); ?>" alt="">
    <img class="vector-15" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-36.svg' ) ); ?>" alt="">

    <div class="group-12">
      <div class="frame-56">
        <div class="frame-55">
          <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/chartlineup.svg' ) ); ?>" alt="">
        </div>
        <div class="text-wrapper-26">Integrated Growth Platform</div>
      </div>
      <div class="frame-54">
        <div class="frame-55">
          <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/headcircuit-1.svg' ) ); ?>" alt="">
        </div>
        <div class="text-wrapper-26">AI-Driven Scale</div>
      </div>
      <div class="frame-57">
        <div class="frame-55">
          <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/usersthree.svg' ) ); ?>" alt="">
        </div>
        <div class="text-wrapper-26">Enterprise Tools Access</div>
      </div>
      <div class="frame-60">
        <div class="frame-55">
          <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/shoppingcartsimple.svg' ) ); ?>" alt="">
        </div>
        <div class="text-wrapper-26">Sustainable Mid-Market Growth</div>
      </div>
      <div class="frame-58">
        <div class="frame-55">
          <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/gearsix-1.svg' ) ); ?>" alt="">
        </div>
        <div class="text-wrapper-26">Operator-Led Execution</div>
      </div>
      <div class="frame-59">
        <div class="frame-55">
          <img class="img-5" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/piggybank.svg' ) ); ?>" alt="">
        </div>
        <div class="text-wrapper-26">Unified Capital &amp; Capability</div>
      </div>
    </div>

    <img class="vector-16" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-40.svg' ) ); ?>" alt="">
    <img class="vector-17" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-40.svg' ) ); ?>" alt="">
    <img class="vector-18" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-40.svg' ) ); ?>" alt="">
    <img class="vector-19" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-40.svg' ) ); ?>" alt="">
    <img class="vector-20" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-41.svg' ) ); ?>" alt="">
    <img class="vector-21" src="<?php echo esc_url( home_url( '/wp-content/themes/techbiz-valuecast/assets/images/home-page/vector-43.svg' ) ); ?>" alt="">
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     MARQUEE 2
════════════════════════════════════════════════════════════════ -->
<div class="vc-mq2">
  <div class="vc-mq2-track">
    <?php for ($i = 0; $i < 6; $i++): ?>
      <span<?php echo $i % 2 === 1 ? ' class="on"' : ''; ?>>the valuecast advantage</span>
      <?php endfor; ?>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     DIFFERENTIATORS
════════════════════════════════════════════════════════════════ -->
<section class="vc-diff" id="differentiators">
  <div class="vc-container">

    <div class="vc-diff-hdr">
      <div>
        <!-- <span class="vc-lbl">The Valuecast Advantage</span> -->
        <h2 class="we-dont-just">We don't just invest<br>We integrate</h2>
      </div>
      <p class="each-portfolio-company">
        Each portfolio company becomes part of a shared ecosystem where data, creativity, and expertise circulate seamlessly.
      </p>
    </div>

    <!-- ✅ MOVED INSIDE vc-cards -->
    <div class="vc-cards">

      <!-- CENTER PILL -->
      <div class="vc-diff-btn-row">
        <div class="vc-diff-center-pill">
          <span class="vc-diff-logo">
            <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/Group-9.svg')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
          </span>
          <span class="vc-diff-center-text">OUR DIFFERENTIATORS</span>
        </div>
      </div>

      
      <div class="vc-diff-grid">
        <div class="vc-diff-card vc-diff-card--talent vc-r" style="background-image: url('<?php echo esc_url(home_url('/wp-content/uploads/2026/03/box-4.png')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
          <div class="vc-diff-card-inner">
            <div class="vc-diff-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                <circle cx="8" cy="8" r="3"></circle>
                <circle cx="17" cy="7" r="3"></circle>
                <path d="M4 20v-1a4 4 0 0 1 4-4h0a4 4 0 0 1 4 4v1"></path>
                <path d="M14 19a4 4 0 0 1 4-4h0a4 4 0 0 1 4 4v1"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="vc-diff-card vc-diff-card--eco vc-r" style="background-image: url('<?php echo esc_url(home_url('/wp-content/uploads/2026/03/box-1.png')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
          <div class="vc-diff-card-inner">
            <div class="vc-diff-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                <circle cx="8" cy="9" r="3"></circle>
                <circle cx="16" cy="6" r="3"></circle>
                <circle cx="17" cy="17" r="3"></circle>
                <path d="M10.5 10.5l3-1.5M9 12l6 3"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="vc-diff-card vc-diff-card--op vc-r" style="background-image: url('<?php echo esc_url(home_url('/wp-content/uploads/2026/03/box-5.png')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
          <div class="vc-diff-card-inner">
            <div class="vc-diff-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                <path d="M4 15c1.5 1 3.5 1.5 5.5 1.5S13.5 16 15 15"></path>
                <path d="M4 11V7l4-2 4 2 4-2 4 2v4"></path>
                <circle cx="8" cy="7" r="1"></circle>
                <circle cx="12" cy="9" r="1"></circle>
                <circle cx="16" cy="7" r="1"></circle>
              </svg>
            </div>
          </div>
        </div>

        <div class="vc-diff-card vc-diff-card--ai vc-r" style="background-image: url('<?php echo esc_url(home_url('/wp-content/uploads/2026/03/box-2.png')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
          <div class="vc-diff-card-inner">
            <div class="vc-diff-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                <rect x="9" y="4" width="6" height="16" rx="3"></rect>
                <path d="M9 9H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h4"></path>
                <path d="M15 9h4a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4"></path>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     CTA BANNER
════════════════════════════════════════════════════════════════ -->
<section class="vc-cta" id="contact">
  <img class="vector-icon top-right" alt=""
    src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/white-corner.png')); ?>">
  <img class="vector-icon bottom-left" alt=""
    src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/black-corner.png')); ?>">
  <div class="vc-cta-inner">
    <span class="vc-lbl" style="color:rgba(255,255,255,0.5); font-weight: 600;">Contact Us</span>
    <h2><?php echo esc_html($cta_hl); ?></h2>
    <a href="<?php echo esc_url($cta_url); ?>" class="buttonwhite">
      <span class="explore-more"><?php echo esc_html($cta_btn); ?></span>
      <div class="arrowright-wrapper">
        <div class="arrowright">
          <svg class="vector-icon-btn" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </div>
      </div>
    </a>
  </div>
</section>

<?php get_footer('valuecast'); ?>
