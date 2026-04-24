<?php
/**
 * Template Name: Contact Us – Valuecast
 * Template Post Type: page
 *
 * Uses the exact same header (header-valuecast.php), CTA section,
 * and footer (footer-valuecast.php) as front-page.php.
 *
 * @package Techbiz Child / Valuecast
 * @version 2.1
 */

if (!defined('ABSPATH'))
  exit;

// ── Customizer values (same keys as front-page.php) ──────────────
$email = get_theme_mod('vc_contact_email', 'sales@valuecast.com');
$phone = get_theme_mod('vc_contact_phone', '123-456-7890');
$cta_hl = get_theme_mod('vc_cta_headline', 'Explore Your Options');
$cta_btn = get_theme_mod('vc_cta_btn_text', 'Schedule a Free Demo Call');
$cta_url = get_theme_mod('vc_cta_btn_url', '#contact');
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);

// ── Exact same custom header as front-page.php ───────────────────
get_header('valuecast');
?>

<!-- ════════════════════════════════════════════════════════════
     CONTACT PAGE  — body already has .vc-page class added by
     valuecast_body_class() filter extended below for this page.
     All footer/CTA CSS already in valuecast.css under .vc-page.
═════════════════════════════════════════════════════════════════ -->

<!-- ── HERO ─────────────────────────────────────────────────── -->
<section class="vcc-hero">
  <!-- <div class="vcc-hero-circles" aria-hidden="true">
    <span class="vcc-circle vcc-circle-1"></span>
    <span class="vcc-circle vcc-circle-2"></span>
    <span class="vcc-circle vcc-circle-3"></span>
    <span class="vcc-node vcc-nd-1"></span>
    <span class="vcc-node vcc-nd-2"></span>
    <span class="vcc-node vcc-nd-3"></span>
    <span class="vcc-node vcc-nd-4"></span>
    <span class="vcc-node vcc-nd-5"></span>
    <span class="vcc-node vcc-nd-6"></span>
    <span class="vcc-node vcc-nd-7"></span>
  </div> -->
  <!-- <div class="vcc-hero-content">
    <div class="vcc-badge">
      <span class="vcc-badge-dot"></span>
      <span class="vcc-badge-label">Contact Us</span>
    </div>
    <h1 class="vcc-hero-title">Let's Build Value — Together</h1>
    <p class="vcc-hero-sub">Whether you're a founder, investor, or talent looking for growth, we'd love to connect.</p>
  </div> -->
  <div class="vcc-hero-wave" aria-hidden="true"></div>
</section>

<!-- ── TICKER ────────────────────────────────────────────────── -->
<div class="vcc-ticker-wrap">
  <div class="vcc-ticker-track" aria-hidden="true">
    <?php for ($i = 0; $i < 8; $i++): ?>
      <span class="vcc-t-gray">Explore. Align. Grow.</span>
      <span class="vcc-t-blue">Explore. Align. Grow.</span>
    <?php endfor; ?>
  </div>
</div>

<!-- ── EXPERT INSIGHTS ───────────────────────────────────────── -->
<section class="vcc-insights">
  <div class="vcc-badge">
    <span class="vcc-badge-dot"></span>
    <span class="vcc-badge-label">Expert Insights</span>
  </div>
  <h2 class="vcc-insights-title">Actionable analysis backed by real-world execution</h2>
  <p class="vcc-insights-sub">
    Explore perspectives on AI, marketing, commerce, ecosystem strategy, and the future of middle-market growth.<br>
    Our blogs are written by operators, analysts, and strategists across the Valuecast ecosystem.
  </p>
</section>

<!-- ── CONTACT FORM ───────────────────────────────────────────── -->
<div class="vcc-form-section">
  <div class="vcc-form-inner">

    <!-- Tabs -->
    <div class="vcc-tabs" role="tablist" aria-label="Contact categories">
      <button class="vcc-tab vcc-tab--active" role="tab" aria-selected="true" data-tab="partnerships" id="tab-p"
        aria-controls="vcc-form">
        For Partnerships &amp; Investments
      </button>
      <button class="vcc-tab" role="tab" aria-selected="false" data-tab="talent" id="tab-t" aria-controls="vcc-form">
        For Talent &amp; Hiring
      </button>
      <button class="vcc-tab" role="tab" aria-selected="false" data-tab="general" id="tab-g" aria-controls="vcc-form">
        General Enquiries
      </button>
    </div>

    <!-- Form card -->
    <div class="vcc-form-card" id="vcc-form">
      <p class="vcc-form-subtitle">Work with Valuecast to scale your company sustainably.</p>

      <?php
      // ── Form handling ─────────────────────────────────────────
      $sent = false;
      $error = '';

      if (isset($_POST['vcc_submit'])) {
        if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['vcc_nonce'] ?? '')), 'vcc_contact')) {
          $error = 'Security check failed. Please refresh and try again.';
        } else {
          $vcc_strlen = static function ($value) {
            return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
          };

          $f_name = sanitize_text_field(wp_unslash($_POST['vcc_name'] ?? ''));
          $f_mail = sanitize_email(wp_unslash($_POST['vcc_email'] ?? ''));
          $f_phone = sanitize_text_field(wp_unslash($_POST['vcc_phone'] ?? ''));
          $f_company = sanitize_text_field(wp_unslash($_POST['vcc_company'] ?? ''));
          $f_looking = sanitize_text_field(wp_unslash($_POST['vcc_looking'] ?? ''));
          $f_tab = sanitize_text_field(wp_unslash($_POST['vcc_tab'] ?? ''));
          $f_msg = sanitize_textarea_field(wp_unslash($_POST['vcc_message'] ?? ''));
          $allowed_tabs = array('partnerships', 'talent', 'general');

          if (
            $vcc_strlen($f_name) > 255 ||
            $vcc_strlen($f_mail) > 255 ||
            $vcc_strlen($f_company) > 255 ||
            $vcc_strlen($f_looking) > 255 ||
            $vcc_strlen($f_msg) > 255
          ) {
            $error = 'Please keep each field within 255 characters.';
          }

          if (!$error && !in_array($f_tab, $allowed_tabs, true)) {
            $error = 'Please select a valid enquiry type.';
          }

          if (!$error && in_array($f_tab, array('talent', 'general'), true)) {
            $digits_only = preg_replace('/\D+/', '', $f_phone);
            $is_phone_format_valid = (bool) preg_match('/^\+?[0-9\s().-]{7,20}$/', $f_phone);

            if ($f_phone === '' || !$is_phone_format_valid || strlen($digits_only) < 7 || strlen($digits_only) > 15) {
              $error = 'Please enter a valid phone number.';
            }
          }

          if (!$error && !$f_mail) {
            $error = 'Please enter a valid email address.';
          }

          if (!$error) {
            // Handle file upload if present
            $resume_url = '';
            if (isset($_FILES['vcc_resume']) && $_FILES['vcc_resume']['error'] !== UPLOAD_ERR_NO_FILE) {
              if (!function_exists('wp_handle_upload')) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
              }
              $uploadedfile = $_FILES['vcc_resume'];
              $upload_overrides = array('test_form' => false);
              $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

              if ($movefile && !isset($movefile['error'])) {
                $resume_url = $movefile['url'];
              } else {
                $error = 'Failed to upload resume: ' . ($movefile['error'] ?? 'Unknown error');
              }
            }

            if (!$error) {
              // Save to Custom Post Type
              $post_title = sprintf('%s - %s', $f_name, ucfirst($f_tab));
              $post_content = "Name: {$f_name}\nEmail: {$f_mail}\nPhone: {$f_phone}\nCompany: {$f_company}\nCategory: {$f_tab}\nLooking For: {$f_looking}\n\nMessage:\n{$f_msg}";

              $post_id = wp_insert_post(array(
                'post_title' => $post_title,
                'post_content' => $post_content,
                'post_type' => 'vcc_contact_entry',
                'post_status' => 'publish',
              ));

              if (!is_wp_error($post_id)) {
                update_post_meta($post_id, '_vcc_tab', $f_tab);
                update_post_meta($post_id, '_vcc_email', $f_mail);
                update_post_meta($post_id, '_vcc_phone', $f_phone);
                if ($resume_url) {
                  update_post_meta($post_id, '_vcc_resume', $resume_url);
                  $post_content .= "\n\nResume URL: " . $resume_url;
                }

                // Send Email Notification
                if ($f_tab === 'general') {
                  $to = 'smishra@valucastpartners.com'; // Static for General Enquiries
                } else {
                  $to = $email; // Dynamic for Partnerships/Talent
                }

                $subject = sprintf('[Valuecast] New contact: %s – %s', $f_name, $f_tab);
                $headers = array('Content-Type: text/plain; charset=UTF-8', "Reply-To: {$f_mail}");
                wp_mail($to, $subject, $post_content, $headers);

                $sent = true;
              } else {
                $error = 'Sorry, there was a problem saving your submission. Please try again.';
              }
            }
          }
        }
      }
      ?>

      <?php if ($sent): ?>
        <div class="vcc-success-msg" role="alert">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="20" height="20">
            <path d="M20 6L9 17l-5-5" />
          </svg>
          Thank you! We'll be in touch shortly.
        </div>
      <?php else: ?>

        <?php if ($error): ?>
          <div class="vcc-error-msg" role="alert"><?php echo esc_html($error); ?></div>
        <?php endif; ?>

        <form class="vcc-form" method="post" action="<?php echo esc_url(get_permalink()); ?>"
          enctype="multipart/form-data" novalidate>
          <?php wp_nonce_field('vcc_contact', 'vcc_nonce'); ?>
          <input type="hidden" name="vcc_tab" id="vcc_tab_hidden" value="partnerships" />

          <div class="vcc-form-body">

            <!-- Left -->
            <div class="vcc-form-left">
              <input class="vcc-input" type="text" name="vcc_name" placeholder="Full Name"
                maxlength="255"
                value="<?php echo isset($_POST['vcc_name']) ? esc_attr(sanitize_text_field(wp_unslash($_POST['vcc_name']))) : ''; ?>" />

              <input class="vcc-input" type="email" name="vcc_email" id="vcc_email_field" placeholder="Email*" required
                maxlength="255"
                value="<?php echo isset($_POST['vcc_email']) ? esc_attr(sanitize_email(wp_unslash($_POST['vcc_email']))) : ''; ?>" />

              <div id="vcc_phone_wrap" style="display: none; width: 100%;">
                <input class="vcc-input" type="tel" name="vcc_phone" id="vcc_phone_field" placeholder="Phone Number"
                  inputmode="tel" maxlength="20" pattern="^\+?[0-9\s().-]{7,20}$"
                  value="<?php echo isset($_POST['vcc_phone']) ? esc_attr(sanitize_text_field(wp_unslash($_POST['vcc_phone']))) : ''; ?>" />
              </div>

              <div id="vcc_resume_wrap" class="vcc-file-upload" style="display: none; width: 100%;">
                <span
                  style="font-family: 'Inter', sans-serif; font-size: 14px; color: #6e7180; display: block; margin-bottom: 6px;">Upload
                  Resume (PDF, DOCX)</span>
                <input class="vcc-input" type="file" name="vcc_resume" id="vcc_resume_field" accept=".pdf,.doc,.docx"
                  style="padding: 12px 16px; height: auto;" />
              </div>

              <div id="vcc_company_wrap" style="width: 100%;">
                <input class="vcc-input" type="text" name="vcc_company" id="vcc_company_field" placeholder="Company Name"
                  maxlength="255"
                  value="<?php echo isset($_POST['vcc_company']) ? esc_attr(sanitize_text_field(wp_unslash($_POST['vcc_company']))) : ''; ?>" />
              </div>

              <div id="vcc_looking_wrap" class="vcc-select-wrap" style="display: none; width: 100%;">
                <select class="vcc-select" name="vcc_looking" id="vcc_looking_field">
                  <option value="" <?php selected(empty($_POST['vcc_looking'])); ?>>What are you looking for?
                  </option>
                  <option value="Partnerships" <?php selected(($_POST['vcc_looking'] ?? ''), 'Partnerships'); ?>>
                    Partnerships</option>
                  <option value="Careers" <?php selected(($_POST['vcc_looking'] ?? ''), 'Careers'); ?>>Careers</option>
                  <option value="Press" <?php selected(($_POST['vcc_looking'] ?? ''), 'Press'); ?>>Press</option>
                  <option value="Other" <?php selected(($_POST['vcc_looking'] ?? ''), 'Other'); ?>>Other</option>
                </select>
                <div class="vcc-select-chevron" aria-hidden="true">
                  <svg width="14" height="8" viewBox="0 0 14 8" fill="none">
                    <path d="M1 1l6 6 6-6" stroke="#6e7180" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
              </div>
            </div>

            <!-- Right -->
            <div class="vcc-form-right">
              <textarea class="vcc-textarea" name="vcc_message" id="vcc_message_field" maxlength="255"
                placeholder="Message"><?php echo isset($_POST['vcc_message']) ? esc_textarea(sanitize_textarea_field(wp_unslash($_POST['vcc_message']))) : ''; ?></textarea>
              <button class="vcc-submit-btn" type="submit" name="vcc_submit">
                <span>SUBMIT</span>
              </button>
            </div>

          </div>
        </form>

      <?php endif; ?>
    </div><!-- /.vcc-form-card -->
  </div><!-- /.vcc-form-inner -->
</div><!-- /.vcc-form-section -->

<!-- ════════════════════════════════════════════════════════════
     CTA SECTION — copied EXACTLY from front-page.php
     Uses .vc-cta, .vc-cta-inner, .buttonwhite, .arrowright-wrapper
     which are already defined in valuecast.css
═════════════════════════════════════════════════════════════════ -->
<section class="vc-cta" id="contact">
  <img class="vector-icon top-right" alt=""
    src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/white-corner.png')); ?>">
  <img class="vector-icon bottom-left" alt=""
    src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/black-corner.png')); ?>">
  <div class="vc-cta-inner">
    <span class="vc-lbl" style="color:rgba(255,255,255,0.5); font-weight:600;">Contact Us</span>
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

<?php
// ════════════════════════════════════════════════════════════
// FOOTER — copied EXACTLY from front-page.php via footer-valuecast.php
// get_footer('valuecast') includes footer-valuecast.php which
// already has the full .site-footer markup + </body></html>
// ════════════════════════════════════════════════════════════
get_footer('valuecast');?>