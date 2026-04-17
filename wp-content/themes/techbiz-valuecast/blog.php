<?php
/**
 * Template Name: Blog – Knowledge Hub
 * Template Post Type: page
 *
 * Dynamic blog listing page for Valuecast theme.
 * Categories = WP post categories (AJAX filtered)
 * Articles = WP posts
 */

if (!defined('ABSPATH')) exit;

/* ── Pagination ── */
$paged    = get_query_var('paged') ? get_query_var('paged') : 1;
$per_page = 6;

/* ── Active category ── */
$active_cat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

/* ── Main query ── */
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $per_page,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
);
if ($active_cat) {
    $args['cat'] = $active_cat;
}
$blog_query = new WP_Query($args);

/* ── Categories ── */
$categories = get_categories(array('hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC'));

/* ── Active category details (left panel on filter) ── */
$active_category = null;
$active_cat_image = '';
$active_cat_description = '';
$show_all_panel = !$active_cat;

if (!function_exists('vc_post_dynamic_image_url')) {
  function vc_post_dynamic_image_url($post_id, $size = 'large')
  {
    $featured = get_the_post_thumbnail_url($post_id, $size);
    if ($featured) {
      return $featured;
    }

    $attachment = get_posts(array(
      'post_type' => 'attachment',
      'post_mime_type' => 'image',
      'posts_per_page' => 1,
      'post_parent' => $post_id,
      'orderby' => 'menu_order ID',
      'order' => 'ASC',
      'fields' => 'ids',
    ));
    if (!empty($attachment[0])) {
      $src = wp_get_attachment_image_url((int) $attachment[0], $size);
      if ($src) {
        return $src;
      }
    }

    $content = get_post_field('post_content', $post_id);
    if ($content && preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $matches)) {
      return $matches[1];
    }

    return '';
  }
}

if ($active_cat) {
  $active_category = get_term($active_cat, 'category');

  if ($active_category && !is_wp_error($active_category)) {
    $active_cat_description = term_description($active_cat, 'category');

    $thumb_id = (int) get_term_meta($active_cat, 'thumbnail_id', true);
    if ($thumb_id) {
      $active_cat_image = wp_get_attachment_image_url($thumb_id, 'large');
    }

    if (!$active_cat_image) {
      $meta_image = get_term_meta($active_cat, 'category_image', true);
      if (is_numeric($meta_image)) {
        $active_cat_image = wp_get_attachment_image_url((int) $meta_image, 'large');
      } elseif (!empty($meta_image) && filter_var($meta_image, FILTER_VALIDATE_URL)) {
        $active_cat_image = $meta_image;
      }
    }

    if (!$active_cat_image) {
      $alt_meta_image = get_term_meta($active_cat, 'image', true);
      if (is_numeric($alt_meta_image)) {
        $active_cat_image = wp_get_attachment_image_url((int) $alt_meta_image, 'large');
      } elseif (!empty($alt_meta_image) && filter_var($alt_meta_image, FILTER_VALIDATE_URL)) {
        $active_cat_image = $alt_meta_image;
      }
    }

    if (!$active_cat_image) {
      $cat_posts = get_posts(array(
        'numberposts' => 1,
        'cat' => $active_cat,
        'orderby' => 'date',
        'order' => 'DESC',
      ));
      if (!empty($cat_posts)) {
        $active_cat_image = vc_post_dynamic_image_url($cat_posts[0]->ID, 'large');
      }
    }
  } else {
    $active_category = null;
  }
}

if ($show_all_panel) {
  $active_cat_image = get_stylesheet_directory_uri() . '/assets/images/All-ai-resolution.png';
}

/* ── Recent posts (sidebar / bottom grid) ── */
$recent_posts = get_posts(array('numberposts' => 9, 'orderby' => 'date', 'order' => 'DESC'));

/* ── Featured post (first/latest) ── */
$featured = get_posts(array('numberposts' => 1, 'orderby' => 'date', 'order' => 'DESC'));
$featured_post = !empty($featured) ? $featured[0] : null;

get_header('valuecast');

$blog_hero_image = get_option('blog_hero_image') ?: site_url('/wp-content/uploads/2026/04/blog-hero-banner.png');
//$blog_hero_image = get_option('blog_hero_image') ?: 'http://vcp.local/wp-content/uploads/2026/04/blog-hero-banner.png';
?>

<div class="vc-blog-page blogs<?php echo ($active_category || $show_all_panel) ? ' has-active-category' : ''; ?>" style="--hero-bg-image: url('<?php echo esc_url($blog_hero_image); ?>')">

  <!-- ══ HERO ══ -->
  <section class="hero" aria-label="Knowledge Hub Hero">
    <div class="frame">
      <div class="div">
        <div class="frame-2">
          <div class="rectangle"></div>
          <span class="knowledge-hub">KNOWLEDGE HUB</span>
        </div>
        <p class="text-wrapper">
          <?php echo esc_html(get_theme_mod('vc_blog_hero_headline', 'Insights for Forward Thinking Leaders')); ?>
        </p>
      </div>
    </div>
    <img class="vector" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/blog-vector.svg'); ?>" alt="" aria-hidden="true" />
  </section>

  <!-- ══ MAIN CONTENT ══ -->
  <main class="middle">

    <!-- Marquee -->
    <div class="line" aria-hidden="true">
      <div class="div-2 marquee-track-blog">
        <span class="clarity-control">clarity. control. growth.</span>
        <span class="clarity-control-2">clarity. control. growth.</span>
        <span class="clarity-control">clarity. control. growth.</span>
        <span class="clarity-control-2">clarity. control. growth.</span>
        <span class="clarity-control">clarity. control. growth.</span>
        <span class="clarity-control-2">clarity. control. growth.</span>
      </div>
    </div>

    <!-- Intro header -->
    <div class="frame-3">
      <div class="div">
        <div class="frame-2">
          <div class="rectangle"></div>
          <span class="expert-insights">EXPERT INSIGHTS</span>
        </div>
        <p class="p">Actionable analysis backed by real-world execution</p>
      </div>
      <p class="explore-perspectives">
        <?php echo esc_html(get_theme_mod('vc_blog_intro', 'Explore perspectives on AI, marketing, commerce, ecosystem strategy, and the future of middle-market growth. Our blogs are written by operators, analysts, and strategists across the Valuecast ecosystem.')); ?>
      </p>
    </div>

    <!-- Categories + Article Grid -->
    <div class="frame-4" id="blog-content-wrap">

      <!-- Category nav -->
      <nav class="categories" aria-label="Blog categories">
        <!-- All -->
        <div class="<?php echo !$active_cat ? 'heading-eco-wrapper' : 'div-wrapper'; ?>">
          <a href="<?php echo esc_url(get_permalink()); ?>"
             class="<?php echo !$active_cat ? 'heading-eco' : 'heading-eco-2'; ?>">
            ALL
          </a>
        </div>
        <?php foreach ($categories as $cat) : ?>
          <div class="<?php echo ($active_cat === $cat->term_id) ? 'heading-eco-wrapper' : 'div-wrapper'; ?>">
            <a href="<?php echo esc_url(add_query_arg('cat', $cat->term_id, get_permalink())); ?>"
               class="<?php echo ($active_cat === $cat->term_id) ? 'heading-eco' : 'heading-eco-2'; ?>">
              <?php echo esc_html(strtoupper($cat->name)); ?>
            </a>
          </div>
        <?php endforeach; ?>
      </nav>

      <div class="vc-blog-content-row<?php echo ($active_category || $show_all_panel) ? ' has-active-category' : ''; ?>">

        <?php if ($active_category || $show_all_panel) : ?>
        <aside class="vc-active-category-panel" aria-label="Selected category details">
          <?php if ($active_cat_image) : ?>
            <img class="vc-active-category-image" src="<?php echo esc_url($active_cat_image); ?>" alt="<?php echo esc_attr($active_category ? $active_category->name : 'All Insights'); ?>" loading="lazy" />
          <?php endif; ?>

          <div class="vc-active-category-content">
            <span class="vc-active-category-eyebrow">Selected Category</span>
            <h3 class="vc-active-category-title"><?php echo esc_html($active_category ? $active_category->name : 'All Insights'); ?></h3>
            <div class="vc-active-category-description">
              <?php
              if ($active_category && !empty(trim(wp_strip_all_tags($active_cat_description)))) {
                  echo wp_kses_post(wpautop($active_cat_description));
              } else {
                  echo '<p>' . esc_html__('Latest insights and updates across all categories.', 'techbiz-valuecast') . '</p>';
              }
              ?>
            </div>
          </div>
        </aside>
        <?php endif; ?>

        <div class="vc-blog-posts-col">
      <!-- Article cards list -->
      <div class="article" role="list" id="blog-articles">
        <?php
        $card_index = 0;
        if ($blog_query->have_posts()) :
          while ($blog_query->have_posts()) :
            $blog_query->the_post();
            $pid        = get_the_ID();
            $thumb      = get_the_post_thumbnail_url($pid, 'large');
            $cats       = get_the_category();
            $cat_name   = !empty($cats) ? $cats[0]->name : '';
            $date       = get_the_date('M d. Y');
            $author     = get_the_author();
            $comments   = get_comments_number();
            $permalink  = get_permalink();
            $title      = get_the_title();
            $excerpt    = get_the_excerpt();
        ?>

        <?php if ($card_index === 0 && $thumb) : /* Featured large card */ ?>
          <article class="frame-11 vc-blog-card vc-blog-card--featured" role="listitem">
            <div class="frame-12">
              <?php if ($thumb) : ?>
                <img class="mask-group" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" />
              <?php endif; ?>
              <?php if ($cat_name) : ?>
                <div class="head-circuit vc-cat-badge">
                  <span><?php echo esc_html($cat_name); ?></span>
                </div>
              <?php endif; ?>
              <div class="frame-13">
                <div class="group-8">
                  <span class="text-wrapper-7"><?php echo esc_html($date); ?></span>
                </div>
                <div class="group-9">
                  <span class="text-4">BY <?php echo esc_html(strtoupper($author)); ?></span>
                </div>
                <div class="group-10">
                  <span class="text-wrapper-7"><?php echo esc_html($comments); ?> COMMENTS</span>
                </div>
              </div>
              <p class="how-AI-is"><?php echo esc_html($title); ?></p>
              <div class="group-11">
                <div class="group-12">
                  <a class="text-wrapper-8" href="<?php echo esc_url($permalink); ?>">Read more</a>
                  <img class="vector-4" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/blog-arrow.svg" alt="" aria-hidden="true" />
                </div>
              </div>
            </div>
          </article>

        <?php elseif ($card_index === 1) : /* Top-right text card */ ?>
          <article class="group-wrapper vc-blog-card" role="listitem">
            <div class="group">
              <div class="frame-6">
                <div class="frame-7">
                  <div class="group-2"><span class="NOV"><?php echo esc_html($date); ?></span></div>
                  <div class="group-3"><span class="text-wrapper-2">BY <?php echo esc_html(strtoupper($author)); ?></span></div>
                  <div class="group-4"><span class="text-wrapper-3"><?php echo esc_html($comments); ?> COMMENTS</span></div>
                </div>
                <p class="text-wrapper-4"><?php echo esc_html($title); ?></p>
                <div class="group-5">
                  <a class="read-more" href="<?php echo esc_url($permalink); ?>" aria-label="<?php echo esc_attr('Read more about ' . $title); ?>">Read more</a>
                  <img class="img" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/blog-arrow-sm.svg" alt="" aria-hidden="true" />
                </div>
              </div>
            </div>
          </article>

        <?php elseif ($card_index === 2) : /* Mid-right compact */ ?>
          <article class="frame-9 vc-blog-card" role="listitem">
            <div class="group-6">
              <p class="text-wrapper-6"><?php echo esc_html($title); ?></p>
              <div class="group-7">
                <a class="read-more-2" href="<?php echo esc_url($permalink); ?>">Read more</a>
                <img class="vector-2" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/blog-arrow-sm.svg" alt="" aria-hidden="true" />
              </div>
              <div class="frame-10">
                <div class="group-2"><span class="NOV"><?php echo esc_html($date); ?></span></div>
                <div class="group-3"><span class="text-wrapper-2">BY <?php echo esc_html(strtoupper($author)); ?></span></div>
                <div class="group-4"><span class="text-wrapper-3"><?php echo esc_html($comments); ?> COMMENTS</span></div>
              </div>
            </div>
          </article>

        <?php else : /* Bottom-right text card */ ?>
          <article class="frame-wrapper vc-blog-card" role="listitem">
            <div class="frame-8">
              <div class="frame-7">
                <div class="group-2"><span class="NOV"><?php echo esc_html($date); ?></span></div>
                <div class="group-3"><span class="text-wrapper-2">BY <?php echo esc_html(strtoupper($author)); ?></span></div>
                <div class="group-4"><span class="text-wrapper-3"><?php echo esc_html($comments); ?> COMMENTS</span></div>
              </div>
              <p class="text-wrapper-5"><?php echo esc_html($title); ?></p>
              <div class="group-5">
                <a class="read-more" href="<?php echo esc_url($permalink); ?>">Read more</a>
                <img class="img" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/blog-arrow-sm.svg" alt="" aria-hidden="true" />
              </div>
            </div>
          </article>
        <?php endif; ?>

        <?php
            $card_index++;
          endwhile;
          wp_reset_postdata();
        else : ?>
          <div class="vc-blog-empty">
            <p>No posts found. <a href="<?php echo esc_url(admin_url('post-new.php')); ?>">Write your first post →</a></p>
          </div>
        <?php endif; ?>
      </div><!-- /#blog-articles -->
      </div><!-- /.vc-blog-posts-col -->
      </div><!-- /.vc-blog-content-row -->

      <!-- Newsletter / CTA banner -->
      <div class="frame-14">
        <div class="frame-15">
          <div class="frame-16">
            <p class="text-wrapper-9">Join 3,000+ Leaders</p>
            <p class="text-wrapper-10">Get weekly insights on growth, AI, and marketing strategy.</p>
          </div>
          <?php //echo do_shortcode('[mc4wp_form]'); ?>
          <?php /* Fallback inline subscribe form if no shortcode active */ ?>
          <div class="vc-subscribe-fallback">
            <form class="vc-subscribe-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
              <?php wp_nonce_field('vc_subscribe', 'vc_subscribe_nonce'); ?>
              <input type="hidden" name="action" value="vc_subscribe" />
              <div class="group-13">
                <div class="frame-17">
                  <input class="text-wrapper-11" type="email" name="email" placeholder="Enter your email address" required />
                </div>
                <div class="frame-18">
                  <button type="submit" class="text-wrapper-12">Subscribe</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <p class="text-wrapper-13">Stay Ahead of the Curve</p>
      </div>

      <!-- Recent posts grid -->
      <div class="frame-19">
        <div class="frame-20">
          <?php
          // Split recent posts into 3 columns of 3
          $cols = array_chunk($recent_posts, 3);
          foreach ($cols as $col_posts) :
          ?>
          <div class="frame-21">
            <?php foreach ($col_posts as $rp) :
              $rp_thumb   = get_the_post_thumbnail_url($rp->ID, 'medium');
              $rp_cats    = get_the_category($rp->ID);
              $rp_author  = get_the_author_meta('display_name', $rp->post_author);
              $rp_date    = get_the_date('M d/Y', $rp);
              $rp_comments = get_comments_number($rp->ID);

              if (!$rp_thumb) {
                $rp_thumb = vc_post_dynamic_image_url($rp->ID, 'medium');
              }
            ?>
            <article class="frame-22">
              <?php if ($rp_thumb) : ?>
                <img class="rectangle-2 vc-rp-thumb" src="<?php echo esc_url($rp_thumb); ?>" alt="<?php echo esc_attr($rp->post_title); ?>" loading="lazy" />
              <?php else : ?>
                <div class="rectangle-2 vc-rp-placeholder"></div>
              <?php endif; ?>
              <div class="frame-23">
                <p class="text-wrapper-14">
                  <?php echo esc_html($rp_date . ' | By ' . $rp_author . ' | ' . $rp_comments . ' Comments'); ?>
                </p>
                <a href="<?php echo esc_url(get_permalink($rp->ID)); ?>" class="AI-automation-from vc-rp-title">
                  <?php echo esc_html($rp->post_title); ?>
                </a>
              </div>
            </article>
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Pagination -->
      <?php if ($blog_query->max_num_pages > 1) : ?>
      <nav class="page" aria-label="Article pagination">
        <?php
        $total_pages  = $blog_query->max_num_pages;
        $current_page = $paged;
        $page_url     = get_permalink();

        for ($i = 1; $i <= min($total_pages, 10); $i++) :
          $page_href = add_query_arg(array('paged' => $i, 'cat' => $active_cat ?: null), $page_url);
          if ($i === $current_page) :
        ?>
          <div class="page-2" aria-current="page"><span class="text-wrapper-15"><?php echo $i; ?></span></div>
        <?php else : ?>
          <a class="text-wrapper-16" href="<?php echo esc_url($page_href); ?>" aria-label="Page <?php echo $i; ?>"><?php echo $i; ?></a>
        <?php
          endif;
        endfor;

        if ($total_pages > 10) :
        ?>
          <span class="text-wrapper-16" aria-hidden="true">…</span>
          <a class="text-wrapper-16" href="<?php echo esc_url(add_query_arg('paged', $total_pages, $page_url)); ?>"><?php echo $total_pages; ?></a>
        <?php endif; ?>
      </nav>
      <?php endif; ?>

    </div><!-- /.frame-4 -->
  </main>

  <!-- ══ CTA ══ -->
  <section class="cta" aria-label="Contact call to action">
    <div class="frame-24">
      <div class="div">
        <div class="frame-2">
          <div class="rectangle-3"></div>
          <span class="contact-us">CONTACT US</span>
        </div>
        <h2 class="text-wrapper-17"><?php echo esc_html(get_theme_mod('vc_cta_headline', 'Explore Your Options')); ?></h2>
      </div>
      <a class="button-white" href="<?php echo esc_url(get_theme_mod('vc_cta_btn_url', home_url('/contact-us'))); ?>" role="button">
        <p class="explore-more"><?php echo esc_html(get_theme_mod('vc_cta_btn_text', 'SCHEDULE A FREE DEMO CALL')); ?></p>
        <div class="arrow-right-wrapper" aria-hidden="true">
          <img class="arrow-right" src="<?php echo esc_url(home_url('/wp-content/uploads/2026/04/blog-arrowright.png')); ?>" alt="" />
        </div>
      </a>
    </div>
    <img class="vector-5" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/blog-vector2.svg" alt="" aria-hidden="true" />
    <img class="vector-6" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/blog-vector3.svg" alt="" aria-hidden="true" />
  </section>

</div><!-- /.vc-blog-page -->

<?php get_footer('valuecast'); ?>

<style>
  .vc-nav-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 72px;
    /* position: absolute; */
    top: 0;
    left: 0;
    width: 100%;
    background: transparent !important;
    z-index: 1000;
    border: none;
    background: black !important;
    background: red;
}

.vc-nav-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 72px;
    /* position: absolute; */
    top: 0;
    left: 0;
    width: 100%;
    background: transparent !important;
    z-index: 1000;
    border: none;
}
</style>
