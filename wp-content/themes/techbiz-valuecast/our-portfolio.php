<?php
/**
 * Template Name: Our Portfolio – Valuecast
 * Template Post Type: page
 *
 * Dynamic: Industries from taxonomy, cards from CPT vc_portfolio,
 * modal content loaded via AJAX from post meta fields.
 */

if (!defined('ABSPATH')) exit;

/* ── Fetch all industry terms for the left sidebar ── */
$industries     = get_terms(array('taxonomy' => 'portfolio_industry', 'hide_empty' => false, 'orderby' => 'term_order', 'order' => 'ASC'));
$has_industries = !is_wp_error($industries) && !empty($industries);
$first_slug     = $has_industries ? $industries[0]->slug : '';

/* ── Fetch cards for the first industry tab on initial load ── */
$card_args = array('post_type' => 'vc_portfolio', 'post_status' => 'publish', 'posts_per_page' => 12, 'orderby' => 'menu_order date', 'order' => 'ASC');
if ($first_slug) {
    $card_args['tax_query'] = array(array('taxonomy' => 'portfolio_industry', 'field' => 'slug', 'terms' => $first_slug));
}
$cards_query = new WP_Query($card_args);

get_header('valuecast');
?>

<div class="element-our-portfolio">

  <!-- HERO -->
  <div class="hero" id="portfolio">
    <div class="frame"></div>
    <img class="image" src="<?php echo esc_url(get_theme_mod('vc_portfolio_hero_bg', 'https://c.animaapp.com/mneev3h6UBBWIw/img/image-5.png')); ?>" alt="Hero background" />
    <div class="frame-wrapper">
      <div class="div">
        <div class="frame-2">
          <div class="rectangle"></div>
          <div class="text-wrapper">OUR WORK</div>
        </div>
        <p class="p"><?php echo esc_html(get_theme_mod('vc_portfolio_hero_headline', 'A Growing Ecosystem of Ambitious Companies')); ?></p>
      </div>
    </div>
    <img class="vector" src="https://c.animaapp.com/mneev3h6UBBWIw/img/vector.svg" alt="" />
  </div>

  <!-- MARQUEE -->
  <div class="line">
    <div class="our-work marquee-track">
      <div class="WHO-WE-ARE">who we are</div><div class="WHO-WE-ARE-2">who we are</div>
      <div class="WHO-WE-ARE-3">who we are</div><div class="WHO-WE-ARE-4">who we are</div>
      <div class="WHO-WE-ARE-5">who we are</div><div class="WHO-WE-ARE-6">who we are</div>
      <div class="WHO-WE-ARE-7">who we are</div><div class="WHO-WE-ARE-8">who we are</div>
    </div>
  </div>

  <!-- MIDDLE -->
  <div class="middle">
    <div class="frame-3">

      <!-- ══ LEFT: Industry Tabs — pulled from WP taxonomy ══ -->
      <div class="group-wrapper">
        <div class="group">
          <div class="rectangle-2"></div>
          <div class="rectangle-3" id="industry-indicator"></div>
          <div class="rectangle-4" id="industry-highlight"></div>
          <div class="text-wrapper-2">INDUSTRIES</div>
          <div class="div-wrapper">
            <div class="frame-4">
              <?php if ($has_industries) : ?>
                <?php foreach ($industries as $i => $term) : ?>
                  <div class="<?php echo $i === 0 ? 'text-wrapper-3 industry-item industry-item--active' : 'text-wrapper-4 industry-item'; ?>"
                       data-index="<?php echo esc_attr($i); ?>"
                       data-slug="<?php echo esc_attr($term->slug); ?>"
                       role="button" tabindex="0">
                    <?php echo esc_html($term->name); ?>
                  </div>
                <?php endforeach; ?>
              <?php else : ?>
                <div class="text-wrapper-3 industry-item industry-item--active" data-index="0" data-slug="all" role="button" tabindex="0">All Portfolio</div>
                <p style="padding:16px 38px;font-size:13px;">
                  <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=portfolio_industry&post_type=vc_portfolio')); ?>">+ Add Industries →</a>
                </p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- ══ RIGHT: Portfolio Cards ══ -->
      <div class="frame-5">
        <div class="frame-6">
          <div class="frame-7">
            <p class="text-wrapper-5">
              <?php echo esc_html(get_theme_mod('vc_portfolio_intro', 'We partner with mid-sized companies and digital agencies that share one belief — that growth should be systematic, data-driven, and sustainable.')); ?>
            </p>
          </div>
        </div>

        <div class="pf-spinner-wrap" id="pf-spinner" style="display:none;"><div class="pf-spinner"></div></div>

        <div class="frame-8" id="portfolio-cards-wrap">
          <?php if ($cards_query->have_posts()) : ?>
            <?php $used_industry_descriptions = array(); ?>
            <?php while ($cards_query->have_posts()) : $cards_query->the_post();
              $pid      = get_the_ID();
              $thumb    = vc_portfolio_item_image_url($pid, 'large');
              $subtitle = get_post_meta($pid, 'vc_subtitle', true);
              $location = get_post_meta($pid, 'vc_location', true);
              $card_descriptor = trim((string) get_post_meta($pid, 'vc_case_study_value', true));
              if ($card_descriptor === '') {
                $industry_terms = get_the_terms($pid, 'portfolio_industry');
                $fallback_desc = '';
                if ($industry_terms && !is_wp_error($industry_terms)) {
                  foreach ($industry_terms as $term) {
                    $desc = trim(wp_strip_all_tags((string) $term->description));
                    if ($desc === '') {
                      continue;
                    }
                    if (!in_array($desc, $used_industry_descriptions, true)) {
                      $card_descriptor = $desc;
                      $used_industry_descriptions[] = $desc;
                      break;
                    }
                    if ($fallback_desc === '') {
                      $fallback_desc = $desc;
                    }
                  }
                }
                if ($card_descriptor === '' && $fallback_desc !== '') {
                  $card_descriptor = $fallback_desc;
                }
              }
            ?>
            <div class="portfolio-card-item portfolio-card" data-id="<?php echo esc_attr($pid); ?>">
              <?php $img_src = $thumb ?: vc_portfolio_placeholder_url(); ?>
              <img class="pc-image<?php echo $thumb ? '' : ' pc-image--placeholder'; ?>" src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
              <div class="pc-meta">
                 <?php if ($card_descriptor) : ?><p class="pc-industry-description"><?php echo esc_html($card_descriptor); ?></p><?php endif; ?>
                <span class="pc-title"><?php the_title(); ?></span>
                <?php if ($location) : ?><span class="pc-location"><?php echo esc_html($location); ?></span><?php endif; ?>
              </div>
              <?php if ($subtitle) : ?><p class="pc-subtitle"><?php echo esc_html($subtitle); ?></p><?php endif; ?>
              <button class="button-white pc-case-study-btn" data-id="<?php echo esc_attr($pid); ?>">
                <span class="view-case-study">VIEW CASE STUDY</span>
                <img class="img" src="https://c.animaapp.com/mneev3h6UBBWIw/img/frame-2147227740.svg" alt="" />
              </button>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php else : ?>
            <div class="pc-empty">
              <p>No portfolio items yet.<br>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div><!-- /.frame-3 -->

    <!-- Case Studies Section (static) -->
    <div class="frame-16" id="our-approach">
      <div class="frame-17">
        <div class="frame-18">
          <div class="frame-2"><div class="rectangle"></div><div class="text-wrapper-8">CASE STUDIES</div></div>
          <div class="label">
            <p class="text-wrapper">Focused problems | Structured execution | Measurable results</p>
          </div>
        </div>
        <div class="frame-19">
          <p class="cs-intro-text">Each case study begins with a clearly defined business problem — whether it's stalled growth, fragmented execution, or inefficient performance.</p>
          <p class="cs-intro-text">We apply a structured, data-led approach across creative, media, and operations, and measure success through tangible commercial outcomes, not vanity metrics.</p>
        </div>
        <div class="frame-20">
          <div class="frame-21">
            <div class="frame-22">
              <?php $problems_img = get_theme_mod('vc_cs_problems_image', home_url('/wp-content/uploads/2026/04/Screenshot-2026-04-08-010848.png')); ?>
              <?php if ($problems_img) : ?>
                <img class="cs-thumb-image" src="<?php echo esc_url($problems_img); ?>" alt="Problems Section" />
              <?php else : ?>
                <div class="cs-thumb-placeholder">Problems Thumbnail Image</div>
              <?php endif; ?>
            </div>
            <div class="frame-36"><div class="frame-37"><div class="cs-step-title">PROBLEMS</div><p class="cs-step-text">We isolate the core constraint limiting scale or efficiency.</p></div></div>
          </div>
          <div class="frame-21">
            <div class="frame-38">
              <?php $execution_img = get_theme_mod('vc_cs_execution_image', home_url('/wp-content/uploads/2026/04/execution-portfolio.png')); ?>
              <?php if ($execution_img) : ?>
                <img class="cs-thumb-image" src="<?php echo esc_url($execution_img); ?>" alt="Execution Section" />
              <?php else : ?>
                <div class="cs-thumb-placeholder">Execution Thumbnail Image</div>
              <?php endif; ?>
            </div>
            <div class="frame-36"><div class="frame-37"><div class="cs-step-title">EXECUTION</div><p class="cs-step-text">We deploy repeatable systems across creative, performance media, and analytics.</p></div></div>
          </div>
          <div class="frame-40">
            <?php $results_img = get_theme_mod('vc_cs_results_image', home_url('/wp-content/uploads/2026/04/result-portfolio.png')); ?>
            <?php if ($results_img && strpos($results_img, 'results-thumbnail.png') === false) : ?>
              <img class="frame-41 cs-thumb-image" src="<?php echo esc_url($results_img); ?>" alt="Results Section" />
            <?php else : ?>
              <div class="cs-thumb-placeholder">Results Thumbnail Image</div>
            <?php endif; ?>
            <div class="frame-42"><div class="frame-43"><div class="cs-step-title">RESULTS</div><p class="cs-step-text">Every engagement is evaluated through before-and-after performance benchmarks.</p></div></div>
          </div>
        </div>
        <button class="button-white-3" onclick="document.getElementById('contact').scrollIntoView({behavior:'smooth'})">
          <p class="explore-more">LET'S FIND OUT YOUR ROADBLOCKS</p>
          <div class="arrow-right-wrapper"><img class="arrow-right" src="https://c.animaapp.com/mneev3h6UBBWIw/img/arrowright.svg" alt="" /></div>
        </button>
      </div>
    </div>

  </div><!-- /.middle -->

  <!-- CTA -->
  <div class="vc-pf-cta" id="contact">
    <div class="frame-44">
      <div class="div">
        <div class="frame-2"><div class="rectangle-7"></div><div class="contact-us">CONTACT US</div></div>
        <div class="text-wrapper-13"><?php echo esc_html(get_theme_mod('vc_cta_headline', 'Explore Your Options')); ?></div>
      </div>
      <a href="<?php echo esc_url(get_theme_mod('vc_cta_btn_url', home_url('/contact-us'))); ?>" class="button-white-3 cta-btn">
        <div class="explore-more">EXPLORE PARTNERSHIP OPPORTUNITIES</div>
        <div class="arrow-right-wrapper"><img class="arrow-right" src="https://c.animaapp.com/mneev3h6UBBWIw/img/arrowright.svg" alt="" /></div>
      </a>
    </div>
    <img class="vector-6" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/black-corner.png')); ?>" alt="" />
    <img class="vector-7" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/white-corner.png')); ?>" alt="" />
  </div>

</div><!-- /.element-our-portfolio -->

<!-- ══ CASE STUDY MODAL — content injected by AJAX ══ -->
<div class="cs-modal" id="cs-modal" aria-modal="true" role="dialog" aria-hidden="true">
  <div class="cs-modal__backdrop" id="cs-backdrop"></div>
  <div class="cs-modal__box">
    <button class="cs-modal__close" id="cs-close" aria-label="Close">&times;</button>
    <!-- <img class="cs-modal__thumb" id="cs-thumb" src="" alt="" style="display:none;" /> -->
    <div class="cs-modal__loading" id="cs-loading"><div class="cs-spinner"></div><p>Loading…</p></div>
    <div class="cs-modal__content" id="cs-content" style="display:none;">
      <div class="cs-modal__eyebrow"><div class="cs-modal__dot"></div><span>CASE STUDY</span></div>
      <div class="cs-modal__header">
        <div class="cs-modal__header-text">
          <h2 class="cs-modal__title" id="cs-title"></h2>
          <p class="cs-modal__location" id="cs-location"></p>
          <p class="cs-modal__industry-tag" id="cs-industry"></p>
        </div>
      </div>
      <div class="cs-modal__stats" id="cs-stats"></div>
      <div class="cs-modal__body" id="cs-body"></div>
      <a class="cs-modal__cta" id="cs-cta" href="<?php echo esc_url(home_url('/contact-us')); ?>">GET IN TOUCH</a>
    </div>
  </div>
</div>

<?php get_footer('valuecast'); ?>
