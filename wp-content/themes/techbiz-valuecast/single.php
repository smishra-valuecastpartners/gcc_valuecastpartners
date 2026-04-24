<?php
/**
 * Template Name: (auto) Single Blog Post – Valuecast
 *
 * This file is used as: single.php  (or name it single-post.php)
 * Drop it in the theme root — WordPress auto-uses it for all single posts.
 *
 * Dynamic features:
 *  - Post title, content, featured image
 *  - Prev / Next post navigation
 *  - Social share (Twitter + LinkedIn)
 *  - Comments (WP native)
 *  - Leave a Reply form (WP native comment_form())
 *  - Related posts sidebar
 */

if (!defined('ABSPATH')) exit;

get_header('valuecast');

// Single post data
$pid      = get_the_ID();
$title    = get_the_title();
$thumb    = get_the_post_thumbnail_url($pid, 'full');
$author   = get_the_author();
$date     = get_the_date('d M Y');
$cats     = get_the_category();
$cat_name = !empty($cats) ? $cats[0]->name : '';
$content  = get_the_content();

// Prev / next
$prev_post = get_previous_post();
$next_post = get_next_post();

// Share URLs
$post_url   = urlencode(get_permalink());
$post_title = urlencode($title);
// $twitter_url  = 'https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title;
$linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $post_url;

// Related posts (same category)
$related = array();
if (!empty($cats)) {
    $related = get_posts(array(
        'category'       => $cats[0]->term_id,
        'numberposts'    => 3,
        'post__not_in'   => array($pid),
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
}
?>

<div class="vc-blog-detail blog-detail">

  <!-- ══ BLOG HERO ══ -->
  <section class="frame" aria-labelledby="blog-title">
    <div class="div-wrapper">
     
      <h3 class="text-wrapper" id="blog-title"><?php echo esc_html($title); ?></h3>
      
    </div>
    <?php if ($thumb) : ?>
    <div class="rectangle-wrapper">
      <img class="rectangle" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($title); ?>" />
    </div>
    <?php endif; ?>
  </section>

  <!-- ══ POST CONTENT ══ -->
  <article class="vc-single-content">
    <?php
    // WP content with all filters (shortcodes, blocks, etc.)
    $post_content = apply_filters('the_content', $content);
    echo wp_kses_post($post_content);
    ?>
  </article>

  <div class="vc-single-content-clear" aria-hidden="true"></div>

  <div class="vc-single-meta">
        <span><?php echo esc_html($date); ?></span>
        <span class="vc-meta-sep">·</span>
        <span>By <?php echo esc_html($author); ?></span>
        <span class="vc-meta-sep">·</span>
        <span><?php echo get_comments_number(); ?> Comments</span>
      </div>

  <!-- ══ PREV / NEXT + SHARE ══ -->
  <nav class="group-7" aria-label="Blog post navigation">
    <div class="line-wrapper" aria-hidden="true"><hr class="vc-nav-line" /></div>

    <div class="vc-share-above-nav">
      <!-- <a class="twitter" href="<?php echo esc_url($twitter_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter">
        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/twitter.svg'); ?>" alt="Twitter" loading="lazy" />
      </a> -->
      <a class="linked-in" href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn">
        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/linkedin.svg'); ?>" alt="LinkedIn" loading="lazy" />
      </a>
    </div>

    <div class="vc-post-nav-row">
      <!-- Previous -->
      <?php if ($prev_post) : ?>
      <a class="frame-27 vc-nav-prev" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
        <div>
          <span class="text-wrapper-27">PREVIOUS</span>
          <span class="vc-nav-arrow">←</span>
          <p class="blockchain-and"><?php echo esc_html($prev_post->post_title); ?></p>
        </div>
      </a>
      <?php else : ?>
      <div class="frame-27 vc-nav-prev vc-nav-disabled">
        <span class="text-wrapper-27">PREVIOUS</span>
        <span class="vc-nav-arrow">←</span>
      </div>
      <?php endif; ?>

      <!-- Next -->
      <?php if ($next_post) : ?>
      <a class="frame-28 vc-nav-next" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
        <div>
          <span class="text-wrapper-28">NEXT</span>
          <p class="transforming"><?php echo esc_html($next_post->post_title); ?></p>
        </div>
        <span class="vc-nav-arrow">→</span>
      </a>
      <?php else : ?>
      <div class="frame-28 vc-nav-next vc-nav-disabled">
        <span class="text-wrapper-28">NEXT</span>
        <span class="vc-nav-arrow">→</span>
      </div>
      <?php endif; ?>
    </div>



    <div class="line-wrapper" aria-hidden="true"><hr class="vc-nav-line" /></div>
  </nav>

  <!-- ══ RELATED POSTS ══ -->
  <!-- <?php if (!empty($related)) : ?>
  <section class="vc-related-posts">
    <h3 class="vc-related-title">Related Articles</h3>
    <div class="vc-related-grid">
      <?php foreach ($related as $rp) :
        $rp_thumb = get_the_post_thumbnail_url($rp->ID, 'medium_large');
      ?>
      <a class="vc-related-card" href="<?php echo esc_url(get_permalink($rp->ID)); ?>">
        <?php if ($rp_thumb) : ?>
          <img src="<?php echo esc_url($rp_thumb); ?>" alt="<?php echo esc_attr($rp->post_title); ?>" loading="lazy" />
        <?php else : ?>
          <div class="vc-related-placeholder"></div>
        <?php endif; ?>
        <span><?php echo esc_html($rp->post_title); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?> -->

  <!-- ══ COMMENTS ══ -->
  <?php if (comments_open() || get_comments_number()) : ?>
  <section class="frame-8 vc-comments-section" aria-labelledby="comments-heading">
    <h2 class="text-wrapper-4" id="comments-heading">
      <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
    </h2>

    <?php
    // Display existing comments
    $comments = get_comments(array('post_id' => $pid, 'status' => 'approve', 'order' => 'ASC'));
    foreach ($comments as $comment) :
      $avatar = get_avatar_url($comment->comment_author_email, array('size' => 80));
      $comment_date = date('d/m/y. H:i', strtotime($comment->comment_date));
    ?>
    <article class="group vc-comment" aria-label="Comment by <?php echo esc_attr($comment->comment_author); ?>">
      <div class="img-wrapper">
        <img class="rectangle-2" src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($comment->comment_author); ?> avatar" />
      </div>
      <div class="frame-12">
        <span class="text-wrapper-8"><?php echo esc_html($comment->comment_author); ?></span>
        <time class="text-wrapper-9" datetime="<?php echo esc_attr($comment->comment_date); ?>">
          <?php echo esc_html($comment_date); ?>
        </time>
      </div>
      <div class="frame-13">
        <p class="text-wrapper-10"><?php echo wp_kses_post($comment->comment_content); ?></p>
      </div>
      <button class="text-wrapper-7 vc-reply-btn"
              onclick="document.getElementById('comment-reply-title').scrollIntoView({behavior:'smooth'});document.getElementById('author').focus();"
              type="button">Reply</button>
    </article>
    <?php endforeach; ?>

    <!-- Leave a Reply Form — WP native -->
    <section class="group-3 vc-reply-section" aria-labelledby="reply-heading">
      <?php
      comment_form(array(
        'title_reply'         => 'Leave a Reply',
        'title_reply_before'  => '<div class="frame-17"><h2 class="text-wrapper-4" id="reply-heading">',
        'title_reply_after'   => '</h2></div>',
        'comment_field'       => '
          <div class="frame-16">
            <label class="frame-18" for="comment"><span class="text-wrapper-12">MESSAGE</span></label>
            <textarea id="comment" name="comment" class="text-wrapper-15 reply-textarea" placeholder="Share your thoughts…" rows="5" required></textarea>
          </div>',
        'fields' => array(
          'author' => '<div class="vc-form-row">
            <label class="text-wrapper-13" for="author">FULL NAME</label>
            <input id="author" name="author" class="text-wrapper-16 reply-input reply-input--name" type="text" placeholder="First Last Name" required />',
          'email'  => '<label class="text-wrapper-14" for="email">EMAIL</label>
            <input id="email" name="email" class="text-wrapper-17 reply-input reply-input--email" type="email" placeholder="@email.com" required />
          </div>',
          'cookies' => '',
        ),
        'submit_button'       => '<div class="group-wrapper"><button class="group-5" type="%3$s" id="%2$s" name="%1$s"><span class="text-wrapper-23">%4$s</span></button></div>',
        'submit_field'        => '%1$s %2$s',
        'label_submit'        => 'Post Comment',
        'class_form'          => 'reply-form vc-comment-form',
      ));
      ?>
    </section>
  </section>
  <?php endif; ?>

</div><!-- /.vc-blog-detail -->

<?php get_footer('valuecast'); ?>


<style>
  body.single-post {
    padding-top: 72px;
  }

  body.single-post.admin-bar {
    padding-top: 104px;
  }

  body.single-post .vc-nav-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 72px;
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    background: #0e0d0d !important;
    z-index: 1000;
    border: none;
}
 /* Main Header Container */
body.single-post #vc-navbar {
    background-color: #00030b !important; /* Deep Navy/Black */
  position: fixed;
    top: 0;
  left: 0;
  right: 0;
  width: 100%;
    z-index: 1001;
    overflow: hidden;
    
}

body.single-post.admin-bar #vc-navbar {
  top: 32px;
}

/* Subtle Blue Glow on the right */
body.single-post #vc-navbar::after {
    content: '';
    position: absolute;
    right: 0;
    top: 0;
    width: 300px;
    height: 100%;
    background: radial-gradient(circle at right, rgba(26, 79, 255, 0.15) 0%, rgba(0, 3, 11, 0) 70%);
    pointer-events: none;

}

/* Standard Menu Links */
body.single-post .vc-nav-inner a {
    color: #ffffff !important;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

/* The "Blog" Highlighted Button */
/* Replace '.menu-item-xxxx' with your actual Blog menu ID or a custom class */
body.single-post .vc-nav-inner ul li.menu-item-12822 a { 
    background-color: #0056ff;
    border-radius: 50px;
    padding: 8px 25px !important;
}

body.single-post .vc-nav-inner ul li.menu-item-12822 a:hover {
    background-color: #0044cc;
    box-shadow: 0 0 15px rgba(0, 86, 255, 0.4);
}

/* Main Call Now Button */
body.single-post .vc-nav-inner .elementor-button {
    background-color: #1a4fff !important;
    border-radius: 50px !important;
    padding: 14px 30px !important;
    height: 41px !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 8px; /* Space for the phone icon */
    box-shadow: 0 4px 15px rgba(26, 79, 255, 0.3);
}

body.single-post .vc-nav-inner .elementor-button:hover {
    background-color: #003cc2 !important;
    transform: translateY(-1px);
}

/* Responsive heights matching menu button */
@media (max-width: 1024px) {
    body.single-post .vc-nav-inner .elementor-button {
        height: 37px !important;
        padding: 12px 24px !important;
    }
}

@media (max-width: 991px) {
    body.single-post .vc-nav-inner .elementor-button {
        height: 35px !important;
        padding: 11px 22px !important;
    }
}

</style>

