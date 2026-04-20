<?php
/**
 * Techbiz Child Theme – functions.php
 * Merges original Techbiz child enqueues with Valuecast homepage features.
 *
 * @package  Techbiz Child / Valuecast
 * @version  2.2
 *
 * CHANGELOG v2.2
 * – Extended valuecast_is_custom_page() helper used by all filters
 * – valuecast_remove_parent_hooks() now also runs on contact page
 * – valuecast_undo_megamenu() now strips mega-menu on BOTH homepage
 *   AND contact page (was homepage-only — that was the nav bug)
 * – valuecast_body_class() adds .vc-page + .vc-contact-page on
 *   contact page so all valuecast.css scoped rules apply
 */

if (!defined('ABSPATH'))
    exit;

/* ================================================================
   HELPER — true on homepage OR contact page
   ================================================================ */
function valuecast_is_custom_page()
{
    $is_blog_listing = is_page_template('blog.php') || is_home() || is_page('blog');
    $is_blog_single = is_single() && get_post_type() === 'post';

    return is_front_page()
        || is_page_template('page-contact-us.php')
        || is_page_template('page-about-us.php')
        || is_page_template('our-approach.php')
        || is_page_template('our-portfolio.php')
        || is_page('contact-us')
        || is_page('about-us')
        || is_page('our-approach')
        || is_page('our-portfolio')
        || $is_blog_listing
        || $is_blog_single;
}

/* ================================================================
   1. ORIGINAL TECHBIZ CHILD ENQUEUE (unchanged)
   ================================================================ */
function techbiz_child_enqueue_styles()
{
    wp_enqueue_style('techbiz-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('techbiz-child-style', get_stylesheet_directory_uri() . '/style.css', array('techbiz-style'), wp_get_theme()->get('Version'));
    wp_enqueue_script('custom-js', get_theme_file_uri('/assets/js/custom.js'), array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'techbiz_child_enqueue_styles', 100000);

/* ================================================================
   2. VALUECAST ASSETS – only loaded on front page
   ================================================================ */
function valuecast_enqueue_assets()
{
    if (!is_front_page())
        return;

    wp_enqueue_style(
        'valuecast-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&family=Barlow+Condensed:wght@600;700;800&family=Outfit:wght@200;300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'valuecast-css',
        get_stylesheet_directory_uri() . '/assets/css/valuecast.css',
        array('techbiz-child-style', 'valuecast-fonts'),
        '3.1'
    );

    wp_enqueue_script(
        'valuecast-js',
        get_stylesheet_directory_uri() . '/assets/js/valuecast.js',
        array('jquery'),
        '3.1',
        true
    );

    wp_localize_script('valuecast-js', 'VCData', array(
        'themeUrl' => get_stylesheet_directory_uri(),
        'nonce' => wp_create_nonce('valuecast_nonce'),
    ));

    // Three.js globe for "Why It Matters" section
    wp_enqueue_script(
        'threejs',
        'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js',
        array(),
        'r128',
        true
    );
    wp_enqueue_script(
        'threejs-orbit',
        'https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js',
        array('threejs'),
        'r128',
        true
    );
    wp_enqueue_script(
        'vc-globe',
        get_stylesheet_directory_uri() . '/assets/js/vc-globe.js',
        array('threejs', 'threejs-orbit'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'valuecast_enqueue_assets', 200000);

/* ================================================================
   2a. SHARED HEADER BEHAVIOR (site-wide)
   Ensures mobile menu toggle + sticky scroll behavior works anywhere
   the Valuecast header is present.
   ================================================================ */
function valuecast_enqueue_shared_header_behavior()
{
    if (is_admin()) {
        return;
    }

    wp_enqueue_script(
        'valuecast-js',
        get_stylesheet_directory_uri() . '/assets/js/valuecast.js',
        array('jquery'),
        '3.1',
        true
    );

    wp_localize_script('valuecast-js', 'VCData', array(
        'themeUrl' => get_stylesheet_directory_uri(),
        'nonce' => wp_create_nonce('valuecast_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'valuecast_enqueue_shared_header_behavior', 200000);

/* ================================================================
   2b. CONTACT US PAGE ASSETS
   Separate top-level function — NOT nested inside valuecast_enqueue_assets().
   ================================================================ */
function valuecast_contact_enqueue_assets()
{

    $is_contact = is_page_template('page-contact-us.php')
        || is_page('contact-us');
    $is_about = is_page_template('page-about-us.php')
        || is_page('about-us');

    if (!$is_contact && !$is_about)
        return;

    // Outfit + Inter fonts
    wp_enqueue_style(
        'valuecast-contact-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&family=Barlow+Condensed:wght@600;700;800&family=Outfit:wght@200;300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap',
        array(),
        null
    );

    // valuecast.css — needed for .vc-cta, .vc-navbar, .site-footer rules
    wp_enqueue_style(
        'valuecast-css',
        get_stylesheet_directory_uri() . '/assets/css/valuecast.css',
        array('techbiz-child-style', 'valuecast-contact-fonts'),
        '3.1'
    );

    if ($is_contact) {
        // Contact page stylesheet
        wp_enqueue_style(
            'valuecast-contact-css',
            get_stylesheet_directory_uri() . '/assets/css/contact-us.css',
            array('valuecast-css'),
            '1.2'
        );

        // Contact page JS
        wp_enqueue_script(
            'valuecast-contact-js',
            get_stylesheet_directory_uri() . '/assets/js/contact-us.js',
            array('jquery'),
            '1.2',
            true
        );
    }
    
    if ($is_about) {
        // About us page stylesheet
        wp_enqueue_style(
            'valuecast-about-css',
            get_stylesheet_directory_uri() . '/assets/css/about-us.css',
            array('valuecast-css'),
            '1.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'valuecast_contact_enqueue_assets', 200001);

/* ================================================================
   2c. OUR APPROACH PAGE ASSETS
   ================================================================ */
function valuecast_approach_enqueue_assets()
{
    $is_approach = is_page_template('our-approach.php')
        || is_page('our-approach');

    if (!$is_approach)
        return;

    // Outfit + Inter fonts
    wp_enqueue_style(
        'valuecast-approach-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&family=Barlow+Condensed:wght@600;700;800&family=Outfit:wght@200;300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap',
        array(),
        null
    );

    // valuecast.css — needed for .vc-navbar, .site-footer rules
    wp_enqueue_style(
        'valuecast-css',
        get_stylesheet_directory_uri() . '/assets/css/valuecast.css',
        array('techbiz-child-style', 'valuecast-approach-fonts'),
        '3.1'
    );

    // Approach page stylesheet
    wp_enqueue_style(
        'valuecast-approach-css',
        get_stylesheet_directory_uri() . '/assets/css/approach.css',
        array('valuecast-css'),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'valuecast_approach_enqueue_assets', 200002);

/* ================================================================
   2d. OUR PORTFOLIO PAGE ASSETS
   ================================================================ */
function valuecast_portfolio_enqueue_assets()
{
    $is_portfolio = is_page_template('our-portfolio.php')
        || is_page('our-portfolio');

    if (!$is_portfolio)
        return;

    wp_enqueue_style(
        'valuecast-portfolio-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&family=Barlow+Condensed:wght@600;700;800&family=Outfit:wght@200;300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'valuecast-css',
        get_stylesheet_directory_uri() . '/assets/css/valuecast.css',
        array('techbiz-child-style', 'valuecast-portfolio-fonts'),
        '3.1'
    );

    wp_enqueue_style(
        'valuecast-portfolio-css',
        get_stylesheet_directory_uri() . '/assets/css/portfolio.css',
        array('valuecast-css'),
        '1.0'
    );

    wp_enqueue_script(
        'valuecast-portfolio-js',
        get_stylesheet_directory_uri() . '/assets/js/portfolio.js',
        array('jquery'),
        '1.0',
        true
    );

    wp_localize_script('valuecast-portfolio-js', 'VCPortfolio', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('vc_portfolio_nonce_front'),
        'contactUrl' => esc_url(home_url('/contact-us')),
    ));
}
add_action('wp_enqueue_scripts', 'valuecast_portfolio_enqueue_assets', 200003);

/* ================================================================
   3. THEME SETUP
   ================================================================ */
function valuecast_theme_setup()
{
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 220,
        'flex-width' => true,
        'flex-height' => true,
    ));
    add_theme_support('title-tag');

    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'techbiz-valuecast'),
        'mobile-menu' => __('Mobile Menu', 'techbiz-valuecast'),
    ));
}
add_action('after_setup_theme', 'valuecast_theme_setup');

function valuecast_inherit_menu_locations()
{
    $current_locations = get_theme_mod('nav_menu_locations');
    if (is_array($current_locations) && !empty(array_filter($current_locations)))
        return;

    foreach (array('techbiz-child', 'techbiz') as $slug) {
        $mods = get_option('theme_mods_' . $slug);
        if (!empty($mods['nav_menu_locations']) && is_array($mods['nav_menu_locations'])) {
            set_theme_mod('nav_menu_locations', $mods['nav_menu_locations']);
            return;
        }
    }
}
add_action('after_switch_theme', 'valuecast_inherit_menu_locations');
add_action('init', 'valuecast_inherit_menu_locations');

/* ================================================================
   4. BODY CLASSES
   .vc-page         → activates all valuecast.css scoped rules
   .vc-contact-page → activates contact-us.css footer mirrors + nav fix
   ================================================================ */
function valuecast_body_class($classes)
{

    if (is_front_page()) {
        $classes[] = 'vc-page';
    }

    $is_contact = is_page_template('page-contact-us.php')
        || is_page('contact-us');

    if ($is_contact) {
        $classes[] = 'vc-page';
        $classes[] = 'vc-contact-page';
    }
    
    $is_about = is_page_template('page-about-us.php')
        || is_page('about-us');

    if ($is_about) {
        $classes[] = 'vc-page';
        $classes[] = 'vcc-about-page';
    }

    $is_approach = is_page_template('our-approach.php')
        || is_page('our-approach');

    if ($is_approach) {
        $classes[] = 'vc-page';
        $classes[] = 'vc-approach-page';
    }

    $is_portfolio = is_page_template('our-portfolio.php')
        || is_page('our-portfolio');

    if ($is_portfolio) {
        $classes[] = 'vc-page';
        $classes[] = 'vc-portfolio-page';
    }

    return $classes;
}
add_filter('body_class', 'valuecast_body_class');

/* ================================================================
   5. CUSTOMIZER OPTIONS
   ================================================================ */
function valuecast_customizer_settings($wp_customize)
{

    $wp_customize->add_section('vc_hero_section', array(
        'title' => '🎯 Valuecast – Hero',
        'priority' => 25
    ));

    $hero_fields = array(
        'vc_hero_eyebrow' => array('label' => 'Eyebrow Text', 'default' => 'We are Valuecast Partners'),
        'vc_hero_headline' => array('label' => 'Main Headline', 'default' => 'Building The Future'),
        'vc_hero_subheadline' => array('label' => 'Sub Headline', 'default' => 'of the middle market.'),
        'vc_hero_description' => array('label' => 'Description', 'default' => "We're not a private equity firm — we're builders of an ecosystem."),
        'vc_hero_cta1_text' => array('label' => 'CTA 1 Text', 'default' => 'Explore More'),
        'vc_hero_cta1_url' => array('label' => 'CTA 1 URL', 'default' => '#mission'),
        'vc_hero_cta2_text' => array('label' => 'CTA 2 Text', 'default' => 'Our Team'),
        'vc_hero_cta2_url' => array('label' => 'CTA 2 URL', 'default' => '#team'),
    );
    foreach ($hero_fields as $key => $args) {
        $wp_customize->add_setting($key, array('default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($key, array('label' => $args['label'], 'section' => 'vc_hero_section', 'type' => $key === 'vc_hero_description' ? 'textarea' : 'text'));
    }

    $wp_customize->add_section('vc_contact_section', array('title' => '🎯 Valuecast – Contact & CTA', 'priority' => 27));

    $wp_customize->add_section('vc_focus_images_section', array(
        'title' => '🎯 Valuecast – Focus Area Images',
        'priority' => 26,
    ));
    $focus_tabs = array(
        'digital' => 'Digital Marketing',
        'ecommerce' => 'Amazon & E-Commerce',
        'influencer' => 'Influencer & Creator',
        'ai' => 'AI Business Intelligence',
        'creative' => 'Creative & Brand Studios',
    );
    foreach ($focus_tabs as $tab_key => $tab_label) {
        $setting_id = 'vc_focus_image_' . $tab_key;
        $wp_customize->add_setting($setting_id, array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $setting_id, array(
            'label' => $tab_label . ' Image',
            'section' => 'vc_focus_images_section',
        )));
    }

    $wp_customize->add_section('vc_about_images_section', array(
        'title' => '🎯 Valuecast – About Us Images',
        'priority' => 28,
    ));
    $about_images = array(
        'vc_about_hero_bg' => 'Hero Background (GIF/Image)',
        'vc_about_team_photo' => 'Team Photo (Middle)',
        'vc_about_story_image' => 'Our Story Side Image',
        'vc_about_vision_image' => 'Vision/Mission Image',
        'vc_about_founder1' => 'Founder 1 Photo',
        'vc_about_founder2' => 'Founder 2 Photo',
    );
    foreach ($about_images as $key => $label) {
        $wp_customize->add_setting($key, array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $key, array(
            'label' => $label,
            'section' => 'vc_about_images_section',
        )));
    }

    $wp_customize->add_section('vc_casestudies_images_section', array(
        'title' => '🎯 Valuecast – Case Studies Thumbnails',
        'priority' => 29,
    ));
    $casestudies_images = array(
        'vc_cs_problems_image' => 'Problems Section Thumbnail',
        'vc_cs_execution_image' => 'Execution Section Thumbnail',
        'vc_cs_results_image' => 'Results Section Thumbnail',
    );
    foreach ($casestudies_images as $key => $label) {
        $wp_customize->add_setting($key, array('default' => '', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $key, array(
            'label' => $label,
            'section' => 'vc_casestudies_images_section',
        )));
    }

    foreach (array(
        'vc_contact_email' => array('label' => 'Email', 'default' => 'info@valuecast.com'),
        'vc_contact_phone' => array('label' => 'Phone', 'default' => '+91 9911053033'),
        'vc_header_btn_text' => array('label' => 'Header Button Text', 'default' => 'Call Now'),
        'vc_cta_headline' => array('label' => 'CTA Headline', 'default' => 'Explore Your Options'),
        'vc_cta_btn_text' => array('label' => 'CTA Button Text', 'default' => 'Schedule a Free Demo Call'),
        'vc_cta_btn_url' => array('label' => 'CTA Button URL', 'default' => '#contact'),
    ) as $key => $args) {
        $wp_customize->add_setting($key, array('default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($key, array('label' => $args['label'], 'section' => 'vc_contact_section', 'type' => 'text'));
    }
}
add_action('customize_register', 'valuecast_customizer_settings');

/* ================================================================
   6. HELPERS
   ================================================================ */
function valuecast_logo_url()
{
    $logo_id = (int) get_theme_mod('custom_logo');

    // If logo is saved in parent theme mods, reuse it in this child theme.
    if (!$logo_id) {
        foreach (array('techbiz-child', 'techbiz') as $slug) {
            $mods = get_option('theme_mods_' . $slug);
            if (!empty($mods['custom_logo'])) {
                $logo_id = (int) $mods['custom_logo'];
                break;
            }
        }
    }

    if ($logo_id) {
        $src = wp_get_attachment_image_src($logo_id, 'full');
        if ($src)
            return $src[0];
    }
    return get_stylesheet_directory_uri() . '/assets/images/logo.png';
}

function valuecast_video_url()
{
    return get_stylesheet_directory_uri() . '/assets/video/hero-bg.mp4';
}

function valuecast_fallback_menu()
{
    echo '<ul class="vc-menu-list">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    wp_list_pages(array(
        'title_li' => '',
        'depth' => 1,
        'sort_column' => 'menu_order, post_title',
    ));
    echo '</ul>';
}

/* ================================================================
   7. DISABLE PARENT THEME / PLUGIN INTERFERENCE
   ================================================================ */

/**
 * Remove parent Techbiz header hook on homepage AND contact page.
 * Also dequeue Mega Menu assets on both pages.
 */
function valuecast_remove_parent_hooks()
{
    if (!valuecast_is_custom_page())
        return;   // ← was is_front_page() only

    remove_action('techbiz_header', 'techbiz_header_cb', 10);
    wp_dequeue_style('megamenu');
    wp_dequeue_script('megamenu');
}
add_action('wp', 'valuecast_remove_parent_hooks');

/**
 * Strip Mega Menu walker on homepage AND contact page.
 *
 * FIX v2.2: was restricted to is_front_page() — this caused the
 * Mega Menu <div class="mega-menu-wrap"> to hijack the nav on
 * the contact page, making it render as a full-width white box.
 * Now extended to all our custom pages via valuecast_is_custom_page().
 */
function valuecast_undo_megamenu($args)
{

    if (!valuecast_is_custom_page()) {          // ← was is_front_page() only
        return $args;
    }

    // Strip mega-menu walker whenever it has been applied
    if (isset($args['menu_class']) && strpos($args['menu_class'], 'mega-menu') !== false) {
        $args['container'] = '';
        $args['container_class'] = '';
        $args['container_id'] = '';
        $args['menu_class'] = 'vc-menu-list';
        $args['depth'] = 2;
        $args['walker'] = '';
        $args['fallback_cb'] = false;
        $args['items_wrap'] = '<ul id="%1$s" class="%2$s">%3$s</ul>';
        $args['before'] = '';
        $args['after'] = '';
        $args['link_before'] = '';
        $args['link_after'] = '';
    }

    return $args;
}
// Keep old function name registered (homepage) + add new one (all custom pages)
add_filter('wp_nav_menu_args', 'valuecast_undo_megamenu', 9999999);

// Backward-compat alias so any code referencing the old function name still works
function valuecast_undo_megamenu_on_frontpage($args)
{
    return valuecast_undo_megamenu($args);
}

/* ================================================================
   8. ELEMENTOR FULL SUPPORT
   ================================================================ */
add_action('after_setup_theme', function () {
    add_theme_support('elementor');
});

add_action('elementor/theme/register_locations', function ($elementor_theme_manager) {
    $elementor_theme_manager->register_all_core_location();
});

add_action('template_redirect', function () {
    if (!is_front_page())
        return;
    if (!did_action('elementor/loaded'))
        return;

    $page_id = (int) get_option('page_on_front');
    if (!$page_id)
        return;

    if (\Elementor\Plugin::$instance->db->is_built_with_elementor($page_id)) {
        remove_filter('template_include', 'valuecast_frontpage_template_override', 99);
    }
}, 1);

function valuecast_frontpage_template_override($template)
{
    if (is_front_page()) {
        $custom = locate_template('front-page.php');
        if ($custom)
            return $custom;
    }
    return $template;
}
add_filter('template_include', 'valuecast_frontpage_template_override', 99);

add_filter('elementor/fonts/additional_fonts', function ($fonts) {
    $fonts['Barlow'] = 'googlefonts';
    $fonts['Barlow Condensed'] = 'googlefonts';
    $fonts['Inter'] = 'googlefonts';
    return $fonts;
});

add_action('wp_enqueue_scripts', function () {
    if (!class_exists('\Elementor\Plugin'))
        return;
    $page_id = get_queried_object_id();
    if (!$page_id)
        return;
    if (\Elementor\Plugin::$instance->db->is_built_with_elementor($page_id)) {
        wp_enqueue_style(
            'valuecast-elementor-base',
            get_stylesheet_directory_uri() . '/assets/css/valuecast.css',
            array(),
            '3.1'
        );
    }
}, 150000);

/* ================================================================
   9. CONTACT FORM SUBMISSIONS (CUSTOM POST TYPE)
   ================================================================ */
function valuecast_register_contact_cpt()
{
    $labels = array(
        'name' => 'For Talent & Hiring',
        'singular_name' => 'Contact Entry',
        'menu_name' => 'For Talent & Hiring',
        'all_items' => 'All Entries',
        'view_item' => 'View Entry',
        'search_items' => 'Search Entries',
        'not_found' => 'No entries found.',
        'not_found_in_trash' => 'No entries found in Trash.',
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 30,
        'menu_icon' => 'dashicons-email',
        'supports' => array('title', 'editor'),
        'capabilities' => array(
            'create_posts' => 'do_not_allow', // Prevents manually creating new entries in admin
        ),
        'map_meta_cap' => true,
    );
    register_post_type('vcc_contact_entry', $args);
}
add_action('init', 'valuecast_register_contact_cpt');

// Add custom columns for Contact Entries
function valuecast_contact_cpt_columns($columns)
{
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Name / Subject',
        'vcc_tab' => 'Category',
        'vcc_email' => 'Email',
        'vcc_phone' => 'Phone',
        'vcc_resume' => 'Resume',
        'date' => 'Date',
    );
    return $new_columns;
}
add_filter('manage_vcc_contact_entry_posts_columns', 'valuecast_contact_cpt_columns');

// Populate custom columns
function valuecast_contact_cpt_column_content($column, $post_id)
{
    switch ($column) {
        case 'vcc_tab':
            echo esc_html(get_post_meta($post_id, '_vcc_tab', true));
            break;
        case 'vcc_email':
            echo esc_html(get_post_meta($post_id, '_vcc_email', true));
            break;
        case 'vcc_phone':
            $phone = get_post_meta($post_id, '_vcc_phone', true);
            echo $phone ? esc_html($phone) : '-';
            break;
        case 'vcc_resume':
            $resume_url = get_post_meta($post_id, '_vcc_resume', true);
            if ($resume_url) {
                echo '<a href="' . esc_url($resume_url) . '" target="_blank">Download</a>';
            } else {
                echo '-';
            }
            break;
    }
}

add_action('manage_vcc_contact_entry_posts_custom_column', 'valuecast_contact_cpt_column_content', 10, 2);

/* ================================================================
   10. TEAM MEMBER CPT — Dynamic About-Us Team Section
   ================================================================ */

/**
 * Register the 'team_member' custom post type.
 * Shows in admin as "Our Team" with person icon.
 */
function vcc_register_team_member_cpt() {
    $labels = array(
        'name'               => 'Our Team',
        'singular_name'      => 'Team Member',
        'menu_name'          => 'Our Team',
        'add_new'            => 'Add Team Member',
        'add_new_item'       => 'Add New Team Member',
        'edit_item'          => 'Edit Team Member',
        'new_item'           => 'New Team Member',
        'view_item'          => 'View Team Member',
        'search_items'       => 'Search Team Members',
        'not_found'          => 'No team members found.',
        'not_found_in_trash' => 'No team members found in trash.',
        'all_items'          => 'All Team Members',
    );

    register_post_type('team_member', array(
        'labels'          => $labels,
        'public'          => false,
        'publicly_queryable' => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'query_var'       => false,
        'rewrite'         => false,
        'capability_type' => 'post',
        'has_archive'     => false,
        'hierarchical'    => false,
        'menu_position'   => 25,
        'menu_icon'       => 'dashicons-id',
        'supports'        => array('title', 'thumbnail'),
        'show_in_rest'    => true,
    ));
}
add_action('init', 'vcc_register_team_member_cpt');

/**
 * Add meta box for team member details.
 */
function vcc_team_member_meta_box() {
    add_meta_box(
        'vcc_team_member_details',
        'Team Member Details',
        'vcc_team_member_meta_box_html',
        'team_member',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vcc_team_member_meta_box');

/**
 * Render the meta box HTML.
 */
function vcc_team_member_meta_box_html($post) {
    wp_nonce_field('vcc_team_member_save', 'vcc_team_member_nonce');

    $designation  = get_post_meta($post->ID, '_vcc_tm_designation', true);
    $bio          = get_post_meta($post->ID, '_vcc_tm_bio', true);
    $is_founder   = get_post_meta($post->ID, '_vcc_tm_is_founder', true);
    $order        = get_post_meta($post->ID, '_vcc_tm_order', true);

    ?>
    <style>
        .vcc-meta-box { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 8px 0; }
        .vcc-meta-box .full-width { grid-column: 1 / -1; }
        .vcc-meta-box label { display: block; font-weight: 600; margin-bottom: 4px; color: #1d2327; }
        .vcc-meta-box input[type="text"],
        .vcc-meta-box input[type="number"],
        .vcc-meta-box textarea { width: 100%; padding: 6px 10px; border: 1px solid #8c8f94; border-radius: 4px; }
        .vcc-meta-box textarea { min-height: 80px; resize: vertical; }
        .vcc-founder-toggle { display: flex; align-items: center; gap: 10px; padding: 10px 14px;
            background: #f6f7f7; border-radius: 4px; border: 1px solid #dcdcde; }
        .vcc-founder-toggle input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; }
        .vcc-meta-hint { font-size: 12px; color: #646970; margin-top: 3px; }
        .vcc-photo-preview { margin-top: 8px; }
        .vcc-photo-preview img { max-width: 160px; border-radius: 6px; border: 1px solid #dcdcde; display: block; }
    </style>

    <div class="vcc-meta-box">
        <div>
            <label for="vcc_tm_designation">Designation / Role</label>
            <input type="text" id="vcc_tm_designation" name="vcc_tm_designation"
                   value="<?php echo esc_attr($designation); ?>"
                   placeholder="e.g. Co-Founder & CEO">
        </div>

        <div>
            <label for="vcc_tm_order">Display Order</label>
            <input type="number" id="vcc_tm_order" name="vcc_tm_order"
                   value="<?php echo esc_attr($order !== '' ? $order : '10'); ?>"
                   min="1" max="99">
            <p class="vcc-meta-hint">Lower numbers appear first (1 = first).</p>
        </div>

        <div class="full-width">
            <label for="vcc_tm_bio">Short Bio</label>
            <textarea id="vcc_tm_bio" name="vcc_tm_bio"
                      placeholder="A brief description of this team member's role and expertise..."><?php echo esc_textarea($bio); ?></textarea>
        </div>

        <div class="full-width">
            <div class="vcc-founder-toggle">
                <input type="checkbox" id="vcc_tm_is_founder" name="vcc_tm_is_founder" value="1"
                       <?php checked($is_founder, '1'); ?>>
                <label for="vcc_tm_is_founder" style="margin:0; cursor:pointer;">
                    ⭐ This person is a <strong>Founder</strong> — display in the featured founder row (large card)
                </label>
            </div>
            <p class="vcc-meta-hint">Leave unchecked to place this person in the team slider below the founders.</p>
        </div>

        <div class="full-width">
            <label>Photo</label>
            <p class="vcc-meta-hint">Set the photo using the <strong>Featured Image</strong> box on the right sidebar. Recommended size: 400×480px.</p>
            <?php
            $thumb_id  = get_post_thumbnail_id($post->ID);
            $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, array(160, 200)) : '';
            if ($thumb_url) {
                echo '<div class="vcc-photo-preview"><img src="' . esc_url($thumb_url) . '" alt="Preview"></div>';
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 * Save team member meta on post save.
 */
function vcc_team_member_save_meta($post_id) {
    // Security checks
    if (!isset($_POST['vcc_team_member_nonce'])) return;
    if (!wp_verify_nonce($_POST['vcc_team_member_nonce'], 'vcc_team_member_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save designation
    if (isset($_POST['vcc_tm_designation'])) {
        update_post_meta($post_id, '_vcc_tm_designation', sanitize_text_field($_POST['vcc_tm_designation']));
    }

    // Save bio
    if (isset($_POST['vcc_tm_bio'])) {
        update_post_meta($post_id, '_vcc_tm_bio', sanitize_textarea_field($_POST['vcc_tm_bio']));
    }

    // Save order
    if (isset($_POST['vcc_tm_order'])) {
        update_post_meta($post_id, '_vcc_tm_order', absint($_POST['vcc_tm_order']));
    }

    // Save is_founder toggle
    $is_founder = isset($_POST['vcc_tm_is_founder']) ? '1' : '0';
    update_post_meta($post_id, '_vcc_tm_is_founder', $is_founder);
}
add_action('save_post_team_member', 'vcc_team_member_save_meta');

/**
 * Custom admin columns for team members list.
 */
function vcc_team_member_admin_columns($columns) {
    return array(
        'cb'            => '<input type="checkbox" />',
        'vcc_tm_photo'  => 'Photo',
        'title'         => 'Name',
        'vcc_tm_desig'  => 'Designation',
        'vcc_tm_type'   => 'Type',
        'vcc_tm_order'  => 'Order',
    );
}
add_filter('manage_team_member_posts_columns', 'vcc_team_member_admin_columns');

function vcc_team_member_admin_column_content($column, $post_id) {
    switch ($column) {
        case 'vcc_tm_photo':
            $thumb = get_the_post_thumbnail($post_id, array(50, 60));
            if ($thumb) {
                echo '<div style="width:50px;height:60px;overflow:hidden;border-radius:4px;">' . $thumb . '</div>';
            } else {
                echo '<div style="width:50px;height:60px;background:#e5e7eb;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:20px;">👤</div>';
            }
            break;
        case 'vcc_tm_desig':
            echo esc_html(get_post_meta($post_id, '_vcc_tm_designation', true) ?: '—');
            break;
        case 'vcc_tm_type':
            $is_founder = get_post_meta($post_id, '_vcc_tm_is_founder', true);
            if ($is_founder === '1') {
                echo '<span style="background:#0446f2;color:#fff;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;">⭐ Founder</span>';
            } else {
                echo '<span style="background:#e5e7eb;color:#374151;padding:2px 10px;border-radius:20px;font-size:11px;">Team Member</span>';
            }
            break;
        case 'vcc_tm_order':
            echo esc_html(get_post_meta($post_id, '_vcc_tm_order', true) ?: '10');
            break;
    }
}
add_action('manage_team_member_posts_custom_column', 'vcc_team_member_admin_column_content', 10, 2);

/**
 * Make order column sortable.
 */
function vcc_team_member_sortable_columns($columns) {
    $columns['vcc_tm_order'] = 'vcc_tm_order';
    return $columns;
}
add_filter('manage_edit-team_member_sortable_columns', 'vcc_team_member_sortable_columns');

/**
 * Helper: Get all team members sorted by order.
 * Returns array split into [ 'founders' => [...], 'members' => [...] ]
 */
function vcc_get_team_members() {
    $query = new WP_Query(array(
        'post_type'      => 'team_member',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => '_vcc_tm_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
    ));

    $founders = array();
    $members  = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $member = array(
                'id'          => $id,
                'name'        => get_the_title(),
                'designation' => get_post_meta($id, '_vcc_tm_designation', true),
                'bio'         => get_post_meta($id, '_vcc_tm_bio', true),
                'is_founder'  => get_post_meta($id, '_vcc_tm_is_founder', true) === '1',
                'photo'       => get_the_post_thumbnail_url($id, 'large') ?: '',
                'thumb'       => get_the_post_thumbnail_url($id, 'medium') ?: '',
            );
            if ($member['is_founder']) {
                $founders[] = $member;
            } else {
                $members[] = $member;
            }
        }
        wp_reset_postdata();
    }

    return array('founders' => $founders, 'members' => $members);
}

/**
 * Enqueue Swiper.js on the About Us page for the team slider.
 */
function vcc_enqueue_team_slider_assets() {
    $is_about = is_page_template('page-about-us.php') || is_page('about-us');
    if (!$is_about) return;

    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11'
    );
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11',
        true
    );
}

add_action('wp_enqueue_scripts', 'vcc_enqueue_team_slider_assets', 200005);

/**
 * ================================================================
 * VALUECAST — PORTFOLIO DYNAMIC SYSTEM
 * Paste this entire block at the bottom of functions.php
 *
 * What this adds:
 *   1. Custom Post Type  : vc_portfolio
 *   2. Custom Taxonomy   : portfolio_industry (the left-side tabs)
 *   3. Post Meta boxes   : subtitle, location, stats, case study body
 *   4. AJAX handler      : filter cards by industry tab
 *   5. AJAX handler      : load case study modal content
 *   6. Asset enqueue     : portfolio.css + portfolio.js (only on this page)
 * ================================================================
 */

if (!defined('ABSPATH')) exit;

/* ================================================================
   1. CUSTOM POST TYPE — vc_portfolio
   ================================================================ */
function vc_register_portfolio_cpt()
{
    register_post_type('vc_portfolio', array(
        'label'              => 'Portfolio',
        'labels'             => array(
            'name'               => 'Portfolio',
            'singular_name'      => 'Portfolio Item',
            'add_new'            => 'Add New Item',
            'add_new_item'       => 'Add New Portfolio Item',
            'edit_item'          => 'Edit Portfolio Item',
            'view_item'          => 'View Portfolio Item',
            'search_items'       => 'Search Portfolio',
            'not_found'          => 'No portfolio items found',
            'not_found_in_trash' => 'No portfolio items in trash',
            'menu_name'          => 'Portfolio',
        ),
        'public'             => true,
        'show_in_menu'       => true,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'has_archive'        => false,
        'rewrite'            => array('slug' => 'portfolio-item'),
        'show_in_rest'       => true,   // enables Gutenberg editor
    ));
}
add_action('init', 'vc_register_portfolio_cpt');

/* ================================================================
   2. CUSTOM TAXONOMY — portfolio_industry (the left sidebar tabs)
   ================================================================ */
function vc_register_portfolio_taxonomy()
{
    register_taxonomy('portfolio_industry', 'vc_portfolio', array(
        'label'        => 'Industries',
        'labels'       => array(
            'name'          => 'Industries',
            'singular_name' => 'Industry',
            'add_new_item'  => 'Add New Industry',
            'edit_item'     => 'Edit Industry',
            'search_items'  => 'Search Industries',
            'not_found'     => 'No industries found',
            'menu_name'     => 'Industries',
        ),
        'hierarchical'      => true,    // behaves like categories
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'industry'),
        'show_admin_column' => true,
    ));
}
add_action('init', 'vc_register_portfolio_taxonomy');

/* ================================================================
   3. META BOX — extra fields on the portfolio edit screen
      Fields: Subtitle, Location, Key Stats (JSON), Case Study Body
   ================================================================ */
function vc_portfolio_meta_boxes()
{
    add_meta_box(
        'vc_portfolio_details',
        '📋 Portfolio Item Details',
        'vc_portfolio_meta_box_html',
        'vc_portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vc_portfolio_meta_boxes');

function vc_portfolio_meta_box_html($post)
{
    wp_nonce_field('vc_portfolio_save', 'vc_portfolio_nonce');

    $subtitle       = get_post_meta($post->ID, 'vc_subtitle',        true);
    $location       = get_post_meta($post->ID, 'vc_location',        true);
    $case_value     = get_post_meta($post->ID, 'vc_case_study_value', true);
    $stats          = get_post_meta($post->ID, 'vc_stats',           true); // e.g. "3× ROAS | 40% Revenue Lift"
    $case_study     = get_post_meta($post->ID, 'vc_case_study_body', true);
    ?>
    <style>
      .vc-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
      .vc-meta-field label { display: block; font-weight: 600; margin-bottom: 4px; color: #1e1e1e; }
      .vc-meta-field input, .vc-meta-field textarea { width: 100%; border: 1px solid #ccc; border-radius: 4px; padding: 8px 10px; font-size: 14px; }
      .vc-meta-field textarea { min-height: 100px; resize: vertical; }
      .vc-meta-hint { font-size: 12px; color: #888; margin-top: 4px; }
      .vc-meta-full { grid-column: 1 / -1; }
    </style>
    <div class="vc-meta-grid">
      <div class="vc-meta-field">
        <label for="vc_subtitle">Card Subtitle</label>
        <input type="text" id="vc_subtitle" name="vc_subtitle"
               value="<?php echo esc_attr($subtitle); ?>"
               placeholder="Visual precision and brand clarity…" />
        <p class="vc-meta-hint">Short description shown on the portfolio card.</p>
      </div>
      <div class="vc-meta-field">
        <label for="vc_location">Location / Country</label>
        <input type="text" id="vc_location" name="vc_location"
               value="<?php echo esc_attr($location); ?>"
               placeholder="USA" />
        <p class="vc-meta-hint">Shown next to the company name, e.g. "USA".</p>
      </div>
            <div class="vc-meta-field vc-meta-full">
                <label for="vc_case_study_value">Case Study Value (shown on card)</label>
                <input type="text" id="vc_case_study_value" name="vc_case_study_value"
                             value="<?php echo esc_attr($case_value); ?>"
                             placeholder="Nutrition Brand | D2C Growth" />
                <p class="vc-meta-hint">Per-portfolio label shown under company name on card. Use this instead of shared industry description.</p>
            </div>
      <div class="vc-meta-field vc-meta-full">
        <label for="vc_stats">Key Stats (shown in modal)</label>
        <input type="text" id="vc_stats" name="vc_stats"
               value="<?php echo esc_attr($stats); ?>"
               placeholder="3× ROAS | 40% Revenue Lift | 2M+ Impressions" />
        <p class="vc-meta-hint">Separate each stat with  |  — displayed as highlighted badges in the case study modal.</p>
      </div>
      <div class="vc-meta-field vc-meta-full">
        <label for="vc_case_study_body">Case Study Description (shown in modal)</label>
        <textarea id="vc_case_study_body" name="vc_case_study_body"
                  placeholder="Describe the problem, the approach taken, and the results achieved…"><?php echo esc_textarea($case_study); ?></textarea>
        <p class="vc-meta-hint">This text appears inside the "View Case Study" popup modal. HTML is allowed.</p>
      </div>
    </div>
    <?php
}

function vc_portfolio_save_meta($post_id)
{
    if (!isset($_POST['vc_portfolio_nonce']) || !wp_verify_nonce($_POST['vc_portfolio_nonce'], 'vc_portfolio_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('vc_subtitle', 'vc_location', 'vc_case_study_value', 'vc_stats', 'vc_case_study_body');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, wp_kses_post($_POST[$field]));
        }
    }
}
add_action('save_post_vc_portfolio', 'vc_portfolio_save_meta');

/* Returns the URL used when a portfolio item has no image */
function vc_portfolio_placeholder_url() {
    return get_theme_mod(
        'vc_portfolio_placeholder',
        get_template_directory_uri() . '/assets/images/logo.png'
    );
}

/* Resolve a dynamic per-item image: featured image -> first content image -> first attached image */
function vc_portfolio_item_image_url($post_id, $size = 'large') {
    $thumb = get_the_post_thumbnail_url($post_id, $size);
    if ($thumb) {
        return $thumb;
    }

    $post = get_post($post_id);
    if ($post && !empty($post->post_content)) {
        if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $post->post_content, $m) && !empty($m[1])) {
            return esc_url_raw($m[1]);
        }
    }

    $attachments = get_children(array(
        'post_parent'    => $post_id,
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'numberposts'    => 1,
        'orderby'        => 'menu_order ID',
        'order'          => 'ASC',
        'fields'         => 'ids',
    ));

    if (!empty($attachments)) {
        $img = wp_get_attachment_image_url((int) $attachments[0], $size);
        if ($img) {
            return $img;
        }
    }

    return '';
}

/* ================================================================
   4. AJAX — Filter portfolio cards by industry tab
      Called when user clicks a left-sidebar tab
   ================================================================ */
function vc_ajax_filter_portfolio()
{
    check_ajax_referer('vc_portfolio_nonce_front', 'nonce');

    $slug = isset($_POST['industry']) ? sanitize_text_field($_POST['industry']) : '';

    $args = array(
        'post_type'      => 'vc_portfolio',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
    );

    if ($slug && $slug !== 'all') {
        $args['tax_query'] = array(array(
            'taxonomy' => 'portfolio_industry',
            'field'    => 'slug',
            'terms'    => $slug,
        ));
    }

    $query = new WP_Query($args);
    $html  = '';

    if ($query->have_posts()) {
        $used_industry_descriptions = array();
        while ($query->have_posts()) {
            $query->the_post();
            $pid      = get_the_ID();
            $thumb    = vc_portfolio_item_image_url($pid, 'large');
            $subtitle = get_post_meta($pid, 'vc_subtitle', true);
            $location = get_post_meta($pid, 'vc_location', true);
            $title           = get_the_title();
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

            $html .= '<div class="portfolio-card-item portfolio-card" data-id="' . esc_attr($pid) . '">';
            $img_src = $thumb ?: vc_portfolio_placeholder_url();
            $html .= '<img class="pc-image' . ($thumb ? '' : ' pc-image--placeholder') . '" src="' . esc_url($img_src) . '" alt="' . esc_attr($title) . '" loading="lazy" />';
            $html .= '<div class="pc-meta"><span class="pc-title">' . esc_html($title) . '</span>';
            if ($location) {
                $html .= '<span class="pc-location">' . esc_html($location) . '</span>';
            }
            $html .= '</div>';
            if ($card_descriptor) {
                $html .= '<p class="pc-industry-description">' . esc_html($card_descriptor) . '</p>';
            }
            if ($subtitle) {
                $html .= '<p class="pc-subtitle">' . esc_html($subtitle) . '</p>';
            }
            $html .= '<button class="button-white pc-case-study-btn" data-id="' . esc_attr($pid) . '">'
                   . '<span class="view-case-study">VIEW CASE STUDY</span>'
                   . '<img class="img" src="https://c.animaapp.com/mneev3h6UBBWIw/img/frame-2147227740.svg" alt="" />'
                   . '</button></div>';
        }
        wp_reset_postdata();
    } else {
        $add_url = admin_url('post-new.php?post_type=vc_portfolio');
        $html    = '<div class="pc-empty pc-empty--case-study"><p>No Case Study.<br>'
                 . '</p></div>';
    }

    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_vc_filter_portfolio',        'vc_ajax_filter_portfolio');
add_action('wp_ajax_nopriv_vc_filter_portfolio', 'vc_ajax_filter_portfolio');

/* ================================================================
   5. AJAX — Load case study modal content for a single post
   ================================================================ */
function vc_ajax_get_case_study()
{
    check_ajax_referer('vc_portfolio_nonce_front', 'nonce');

    $pid = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    if (!$pid || get_post_type($pid) !== 'vc_portfolio') {
        wp_send_json_error('Invalid post');
    }

    $title     = get_the_title($pid);
    $thumb     = vc_portfolio_item_image_url($pid, 'large');
    $location  = get_post_meta($pid, 'vc_location',        true);
    $stats_raw = get_post_meta($pid, 'vc_stats',           true);
    $body      = get_post_meta($pid, 'vc_case_study_body', true);

    // Fallback: use WP editor content if case study body meta is empty
    if (!$body) {
        $post = get_post($pid);
        $body = $post ? apply_filters('the_content', $post->post_content) : '';
    }

    // Build stats badges HTML
    $stats_html = '';
    if ($stats_raw) {
        $badges = array_map('trim', explode('|', $stats_raw));
        foreach ($badges as $badge) {
            if ($badge) {
                $stats_html .= '<span class="cs-stat-badge">' . esc_html($badge) . '</span>';
            }
        }
    }

    // Get industry terms for this post
    $terms        = get_the_terms($pid, 'portfolio_industry');
    $industry_tag = '';
    if ($terms && !is_wp_error($terms)) {
        $industry_tag = implode(', ', wp_list_pluck($terms, 'name'));
    }

    wp_send_json_success(array(
        'title'       => $title,
        'thumb'       => $thumb ?: '',
        'location'    => $location,
        'industry'    => $industry_tag,
        'stats_html'  => $stats_html,
        'body'        => wp_kses_post($body),
    ));
}
add_action('wp_ajax_vc_get_case_study',        'vc_ajax_get_case_study');
add_action('wp_ajax_nopriv_vc_get_case_study', 'vc_ajax_get_case_study');

/* ================================================================
   7. FLUSH REWRITE RULES on activation (run once)
   ================================================================ */
function vc_portfolio_flush_rewrite()
{
    vc_register_portfolio_cpt();
    vc_register_portfolio_taxonomy();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'vc_portfolio_flush_rewrite');

// Custom Blog Feature - Add Excerpt Support to Pages

/**
 * ================================================================
 * VALUECAST — BLOG DYNAMIC SYSTEM
 * Paste this entire block at the bottom of functions.php
 *
 * What this adds:
 *   1. Blog listing page enqueue  (blog.css + blog.js)
 *   2. Single post page enqueue   (blog.css for detail styles)
 *   3. Body classes for scoping   (.vc-blog-page / .vc-blog-detail)
 *   4. Marquee JS inline          (no extra file needed)
 *   5. Customizer fields          (hero headline, intro text)
 *   6. Comment form hooks         (clean WP native comments)
 *   7. Excerpt length override    (cleaner card excerpts)
 *   8. Featured image support     (if not already enabled)
 * ================================================================
 */

if (!defined('ABSPATH')) exit;

/* ================================================================
   1. ENQUEUE — Blog listing page
   ================================================================ */
function vc_blog_listing_enqueue()
{
    $is_blog = is_page_template('blog.php') || is_home() || is_page('blog');
    if (!$is_blog) return;

    wp_enqueue_style(
        'vc-blog-fonts',
        'https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;800&family=Inter:wght@300;400;500;600&family=Hanken+Grotesk:wght@400;500;600&display=swap',
        array(), null
    );
    wp_enqueue_style(
        'valuecast-css',
        get_stylesheet_directory_uri() . '/assets/css/valuecast.css',
        array('techbiz-child-style', 'vc-blog-fonts'), '3.1'
    );
    wp_enqueue_style(
        'vc-blog-css',
        get_stylesheet_directory_uri() . '/assets/css/blog.css',
        array('valuecast-css'), '1.0'
    );
}
add_action('wp_enqueue_scripts', 'vc_blog_listing_enqueue', 200010);

/* ================================================================
   2. ENQUEUE — Single post (blog detail)
   ================================================================ */
function vc_blog_single_enqueue()
{
    if (!is_single()) return;

    wp_enqueue_style(
        'vc-blog-fonts-single',
        'https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600&family=Inter:wght@300;400;500;600&family=Hanken+Grotesk:wght@400;500;600&display=swap',
        array(), null
    );
    wp_enqueue_style(
        'valuecast-css-single',
        get_stylesheet_directory_uri() . '/assets/css/valuecast.css',
        array('techbiz-child-style', 'vc-blog-fonts-single'), '3.1'
    );
    wp_enqueue_style(
        'vc-blog-css-single',
        get_stylesheet_directory_uri() . '/assets/css/blog.css',
        array('valuecast-css-single'), '1.0'
    );
}
add_action('wp_enqueue_scripts', 'vc_blog_single_enqueue', 200011);

/* ================================================================
   3. BODY CLASSES — scoping
   ================================================================ */
add_filter('body_class', function ($classes) {
    if (is_page_template('blog.php') || is_home() || is_page('blog')) {
        $classes[] = 'vc-page';
        $classes[] = 'vc-blog-page';
    }
    if (is_single()) {
        $classes[] = 'vc-page';
        $classes[] = 'vc-blog-detail';
    }
    return $classes;
});

/* ================================================================
   4. MARQUEE JS — injected inline for blog & single pages
   ================================================================ */
add_action('wp_footer', function () {
    if (!is_page_template('blog.php') && !is_home() && !is_page('blog')) return;
    ?>
    <script>
    (function() {
      var track = document.querySelector('.marquee-track-blog');
      if (!track) return;
      var pos = 0;
      (function tick() {
        pos -= 0.5;
        if (Math.abs(pos) >= track.scrollWidth / 2) pos = 0;
        track.style.transform = 'translateX(' + pos + 'px)';
        requestAnimationFrame(tick);
      })();
    })();
    </script>
    <?php
});

/* ================================================================
   5. CUSTOMIZER — Blog page settings
   ================================================================ */
add_action('customize_register', function ($wp_customize) {

    // Section
    $wp_customize->add_section('vc_blog_section', array(
        'title'    => '📰 Valuecast – Blog',
        'priority' => 30,
    ));

    // Hero headline
    $wp_customize->add_setting('vc_blog_hero_headline', array(
        'default'           => 'Insights for Forward Thinking Leaders',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vc_blog_hero_headline', array(
        'label'   => 'Blog Hero Headline',
        'section' => 'vc_blog_section',
        'type'    => 'text',
    ));

    // Intro paragraph
    $wp_customize->add_setting('vc_blog_intro', array(
        'default'           => 'Explore perspectives on AI, marketing, commerce, ecosystem strategy, and the future of middle-market growth.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('vc_blog_intro', array(
        'label'   => 'Blog Intro Text',
        'section' => 'vc_blog_section',
        'type'    => 'textarea',
    ));

    // Newsletter headline
    $wp_customize->add_setting('vc_blog_newsletter_headline', array(
        'default'           => 'Join 3,000+ Leaders',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vc_blog_newsletter_headline', array(
        'label'   => 'Newsletter Banner Headline',
        'section' => 'vc_blog_section',
        'type'    => 'text',
    ));
});

/* ================================================================
   6. EXCERPT LENGTH — cleaner card excerpts
   ================================================================ */
add_filter('excerpt_length', function ($length) {
    return 20; // ~20 words for cards
}, 20);

add_filter('excerpt_more', function ($more) {
    return '…';
});

/* ================================================================
   7. FEATURED IMAGE SUPPORT (safety net — usually already enabled)
   ================================================================ */
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    add_image_size('vc-blog-card',     605, 400, true);
    add_image_size('vc-blog-thumb',    320, 200, true);
    add_image_size('vc-blog-featured', 1240, 520, true);
}, 5);

/* ================================================================
   8. REMOVE PARENT THEME CONFLICTS on blog pages
      (same pattern as other Valuecast custom pages)
   ================================================================ */
add_action('wp', function () {
    if (!is_page_template('blog.php') && !is_single() && !is_home() && !is_page('blog')) return;

    // Remove Techbiz parent theme widgets/sidebars that might inject
    remove_action('wp_head', 'feed_links_extra', 3);

    // Prevent parent theme from outputting its own blog template
    add_filter('template_include', function ($template) {
        if (is_single() && get_post_type() === 'post') {
            $custom = get_stylesheet_directory() . '/single.php';
            if (file_exists($custom)) return $custom;
        }
        if ((is_home() || is_page('blog')) && !is_page_template('blog.php')) {
            $custom = get_stylesheet_directory() . '/blog.php';
            if (file_exists($custom)) return $custom;
        }
        return $template;
    }, 98);
});

/* ================================================================
   9. COMMENT FORM — remove website URL field (optional clean-up)
   ================================================================ */
add_filter('comment_form_default_fields', function ($fields) {
    unset($fields['url']);
    return $fields;
});

/* ================================================================
   10. NEWSLETTER SUBSCRIBE FORM HANDLER (blog fallback form)
   ================================================================ */
function valuecast_handle_subscribe_form()
{
    $redirect = wp_get_referer();

    if (!$redirect) {
        $redirect = home_url('/blog/');
    }

    if (!isset($_POST['vc_subscribe_nonce']) || !wp_verify_nonce($_POST['vc_subscribe_nonce'], 'vc_subscribe')) {
        wp_safe_redirect(add_query_arg('vc_subscribe', 'invalid_nonce', $redirect));
        exit;
    }

    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    if (!$email || !is_email($email)) {
        wp_safe_redirect(add_query_arg('vc_subscribe', 'invalid_email', $redirect));
        exit;
    }

    $to = get_option('admin_email');
    $subject = 'New Valuecast Blog Subscriber';
    $message = "A new user subscribed from the blog newsletter form.\n\n";
    $message .= 'Email: ' . $email . "\n";
    $message .= 'Date: ' . current_time('mysql') . "\n";
    $message .= 'IP: ' . (isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : 'Unknown') . "\n";

    $sent = wp_mail($to, $subject, $message);

    wp_safe_redirect(add_query_arg('vc_subscribe', $sent ? 'success' : 'mail_failed', $redirect));
    exit;
}
add_action('admin_post_nopriv_vc_subscribe', 'valuecast_handle_subscribe_form');
add_action('admin_post_vc_subscribe', 'valuecast_handle_subscribe_form');

/* ================================================================
   11. DISABLE EMBEDS in post content (prevents WP default oEmbed)
       Remove if you want YouTube embeds to work in posts
   ================================================================ */
// remove_action('wp_head', 'wp_oembed_add_host_js'); // Uncomment to disable


/* ================================================================
   11. DISABLE EMBEDS in post content (prevents WP default oEmbed)
       Remove if you want YouTube embeds to work in posts
   ================================================================ */
// remove_action('wp_head', 'wp_oembed_add_host_js'); // Uncomment to disable

/* ================================================================
   🔥 NEW GLOBAL CSS SYSTEM (SAFE ADDITION — NO BREAK)
   ================================================================ */
function valuecast_new_css_system() {

    $css = get_stylesheet_directory_uri() . '/assets/css/';

    // Core Design System
    wp_enqueue_style('vc-base', $css . 'base.css', ['techbiz-child-style'], '1.0');
    wp_enqueue_style('vc-layout', $css . 'layout.css', ['vc-base'], '1.0');
    wp_enqueue_style('vc-components', $css . 'components.css', ['vc-layout'], '1.0');

    // Global Sections
    wp_enqueue_style('vc-header', $css . 'header.css', ['vc-components'], '1.0');
    wp_enqueue_style('vc-footer', $css . 'footer.css', ['vc-components'], '1.0');
    wp_enqueue_style('vc-sections', $css . 'sections.css', ['vc-components'], '1.0');

    // Global Responsive (LAST LAYER)
    wp_enqueue_style('vc-responsive', $css . 'responsive.css', ['vc-sections'], '1.0');

}
add_action('wp_enqueue_scripts', 'valuecast_new_css_system', 200100);

add_filter('nav_menu_css_class', function($classes) {
    if (is_front_page()) {
        $classes = array_diff($classes, ['current_page_parent']);
    }
    return $classes;
});

add_filter('body_class', function($classes) {
    $classes[] = 'vc-page';
    return $classes;
});


// Add vc-contact-page body class to Contact Us page
add_filter( 'body_class', function( $classes ) {
    if ( is_page( 'contact-us' ) || is_page( 'contact' ) ) {
        $classes[] = 'vc-contact-page';
    }
    return $classes;
} );