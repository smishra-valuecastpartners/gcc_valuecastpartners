<?php
/**
 * Template Name: About Us – Valuecast
 * Template Post Type: page
 */

if (!defined('ABSPATH'))
    exit;

// Fetch Customizer settings to keep CTA dynamic
$cta_hl = get_theme_mod('vc_cta_headline', 'Explore Your Options');
$cta_btn = get_theme_mod('vc_cta_btn_text', 'Schedule a Free Demo Call');
$cta_url = 'tel:+919899189848';
$about_contact_url = home_url('/contact-us/#contact');

get_header('valuecast');
?>

<!-- Outer wrapper with vcc-about-page class to scope all custom CSS -->
<div class="vcc-about-page">
    <div class="about-us">
        <div class="hero">
            <div class="rectangle-parent">
                <img class="frame-child" alt=""
                    src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/vc_focus_image_1.gif')); ?>"
                    >
                <div class="frame-item"></div>
            </div>
            <div class="hero-inner">
                <div class="frame-parent">
                    <!-- <div class="our-india-gcc-label">Our India GCC</div> -->
                    <div class="rectangle-group">
                        <div class="frame-inner"></div>
                        <div class="our-philosophy">Our Philosophy</div>
                    </div>
                    <div class="led-by-practitioners">Led by Practitioners,<br>Not Financiers</div>
                </div>
            </div>
            <!-- The network wave line overlay, reuse from previous page or allow it to be empty -->
            <img class="vector-icon" alt=""
                src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/wave-line.png')); ?>">
        </div>

        <div class="middle">
            <div class="frame-group">
                <div class="frame-container">
                    <div class="frame-parent">
                        <div class="rectangle-group">
                            <div class="frame-inner"></div>
                            <div class="our-philosophy">WHO WE ARE</div>
                        </div>
                        <div class="we-are-operators">We are operators & practitioners</div>
                    </div>
                    <div class="valuecast-partners-was-container">
                        <b>ValueCast Partners</b>
                        <span> was created by operators with </span>
                        <b>decades of experience in digital marketing, attribution, AI, and building global capability
                            centers</b>
                        <span>.<br> <br>Our founders have scaled </span>
                        <b>Fortune 500</b>
                        <span> marketing organizations, managed </span>
                        <b>$350M+</b>
                        <span> media portfolios, and built </span>
                        <b>GCCs</b>
                        <span> that became </span>
                        <b>Global Growth Engines</b>
                        <span>.</span>
                    </div>
                </div>
                <!-- Placeholder for the large team photo -->
                <img class="frame-icon" alt=""
                    src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/we-are-support.png')); ?>"
                    style="background:#ddd;">
            </div>

            <div class="cards">
                <div class="component-17">
                    <div class="frame-parent2">
                        <div class="group-wrapper">
                            <!-- 'Our story' side image -->
                            <img class="group-icon" alt="Our Story"
                                src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/our-story.png')); ?>">
                        </div>
                        <div class="our-story-parent">
                            <div class="our-story">Our Story</div>
                            <div class="we-believe-middle-market">We believe middle-market companies deserve the same
                                sophistication that large enterprises enjoy — without losing their human spirit.<br>So
                                we built a platform that brings together capital, AI, marketing excellence, global
                                talent, and operational depth into one integrated ecosystem.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="middle-inner">
                <div class="frame-wrapper">
                    <div class="frame-parent3">
                        <div class="frame-parent4">
                            <div class="frame-parent5">
                                <div class="frame-parent">
                                    <div class="rectangle-group">
                                        <div class="frame-inner"></div>
                                        <div class="our-philosophy">Our India GCC</div>
                                    </div>
                                    <div class="we-are-operators" style="color:#fff;">Global Vision. India Engine.</div>
                                </div>
                                <div class="our-india-based-global" style="color:#fff;">Our India-based Global
                                    Capability Center is the operational heart of Valuecast. It powers:</div>
                            </div>
                            <!-- 6 Boxes -->
                            <div class="box-parent">
                                <div class="vcc-feature-box">
                                    <div class="performance-media-icon"> <img
                                            src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/Performance-Media.svg')); ?>"
                                            alt="performance-marketing"></div>
                                    <div class="performance-marketing">Performance marketing</div>
                                    <div class="accusamus-et-iusto">Drive scalable growth with data-driven paid
                                        campaigns, precision targeting, and high-converting acquisition strategies.
                                    </div>
                                </div>

                                <div class="vcc-feature-box active">
                                    <div class="performance-media-icon"><img
                                            src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/HeadCircuits.svg')); ?>"
                                            alt="performance-marketing"></div>
                                    <div class="performance-marketing">Data & analytics</div>
                                    <div class="accusamus-et-iusto">Transform raw data into actionable insights with
                                        custom dashboards, modern tracking solutions, and predictive modeling.</div>
                                </div>

                                <div class="vcc-feature-box">
                                    <div class="performance-media-icon">
                                        <div class="div-code">
                                            <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/web-development.svg')); ?>"
                                                alt="web-development">
                                        </div>
                                    </div>
                                    <div class="performance-marketing">Web development</div>
                                    <div class="accusamus-et-iusto">Build robust, high-performance websites and
                                        applications engineered for seamless user experiences and conversions.</div>
                                </div>

                                <div class="vcc-feature-box">
                                    <div class="performance-media-icon">
                                        <div class="div-code">
                                            <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/creative-branding.svg')); ?>"
                                                alt="Creative & branding">
                                        </div>
                                    </div>
                                    <div class="performance-marketing">Creative & branding</div>
                                    <div class="accusamus-et-iusto">Elevate your brand identity with compelling visual
                                        design, persuasive storytelling, and impactful multimedia assets.</div>
                                </div>

                                <div class="vcc-feature-box">
                                    <div class="performance-media-icon">
                                        <div class="div-code">
                                            <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/HeadCircuit.svg')); ?>"
                                                alt="Ai automation">
                                        </div>
                                    </div>
                                    <div class="performance-marketing">AI automation</div>
                                    <div class="accusamus-et-iusto">Streamline workflows and enhance efficiency through
                                        intelligent automation, custom logic, and machine learning integrations.</div>
                                </div>

                                <div class="vcc-feature-box">
                                    <div class="performance-media-icon">
                                        <div class="div-code">
                                            <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/opretion-gear.svg')); ?>"
                                                alt="Ai automation">
                                        </div>
                                    </div>
                                    <div class="performance-marketing">Operations & delivery</div>
                                    <div class="accusamus-et-iusto">Ensure flawless execution with expert project
                                        management, agile edge methodologies, and dedicated QA processes.</div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const featureBoxes = document.querySelectorAll('.vcc-feature-box');
                                    featureBoxes.forEach(box => {
                                        box.addEventListener('click', function () {
                                            featureBoxes.forEach(b => b.classList.remove('active'));
                                            this.classList.add('active');
                                        });
                                    });
                                });
                            </script>
                        </div>
                        <div class="this-engine-enables" style="color:#fff;">This engine enables speed, efficiency, and
                            innovation — reinvesting value back into every portfolio company.</div>
                    </div>
                </div>
            </div>

            <div class="get-to-know-us">
                <img class="mask-group-icon" alt=""
                    src="<?php echo esc_url(home_url('/wp-content/uploads/2026/03/vision-mission.png')); ?>"
                    style="background:#ddd;">
                <div class="rectangle-parent3">
                    <div class="frame-inner"></div>
                    <div class="our-philosophy">VISION & MISSION</div>
                </div>
                <div class="driving-innovation-and" style="color:#000;">Driving Innovation and<br>Excellence for
                    Sustainable<br>Corporate Success Worldwide</div>
                <div class="get-to-know-us-child"></div>
                <div class="vision-card">
                    <div class="vision" style="color:#000;">Vision</div>
                    <div class="to-build-the" style="color:#000;">To build the world's most trusted ecosystem for
                        middle-market growth, where companies thrive profitably, technology amplifies human creativity, and
                        value compounds across the network.</div>
                </div>
                <div class="group-div">
                    <div class="group-child"></div>
                    <div class="mission">Mission</div>
                    <div class="to-empower-visionary">To empower visionary entrepreneurs and mid-market firms through
                        capital, AI, and collaboration — enabling them to scale with excellence and resilience.</div>
                </div>
            </div>

            <div class="our-team">
                <div class="our-team2">
                    <div class="frame-inner"></div>
                    <div class="our-philosophy">our team</div>
                </div>
                <div class="success-stories-fuel-our-innov-wrapper">
                    <div class="success-stories-fuel">Success Stories Fuel Our Innovation</div>
                </div>


                <?php
                /* ── Dynamic Team Section ── */
                $team_data = vcc_get_team_members();
                $founders  = $team_data['founders'];
                $members   = $team_data['members'];
                ?>

                <!-- ── Founders Row (dynamic) ── -->
                <?php if ( ! empty( $founders ) ) : ?>
                    <div class="vcc-founders-row">
                        <?php foreach ( $founders as $f ) : ?>
                            <div class="rectangle-parent4">
                                <?php if ( $f['photo'] ) : ?>
                                    <img class="rectangle-icon" alt="<?php echo esc_attr( $f['name'] ); ?>"
                                         src="<?php echo esc_url( $f['photo'] ); ?>"
                                         style="height:400px; width:100%; object-fit:cover;">
                                <?php else : ?>
                                    <div class="rectangle-icon" style="background:#ddd; height:400px; width:100%;"></div>
                                <?php endif; ?>
                                <div class="mr-founder-name"><?php echo esc_html( $f['name'] ); ?></div>
                                <div class="designation"><?php echo esc_html( $f['designation'] ); ?></div>
                                <div class="founder-business"><?php echo esc_html( $f['bio'] ); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <!-- Fallback if no founders added yet -->
                    <div class="rectangle-parent4">
                        <div class="rectangle-icon" style="background:#ddd; height:400px; width:100%;"></div>
                        <div class="mr-founder-name">Mr. Founder Name</div>
                        <div class="designation">Designation</div>
                        <div class="founder-business">Add your founders via <strong>Our Team &rsaquo; Add Team Member</strong> in the WordPress admin and check "This person is a Founder".</div>
                    </div>
                <?php endif; ?>

                <!-- ── Team Members Swiper Slider ── -->
                <div class="our-team-inner">
                    <?php if ( ! empty( $members ) ) : ?>
                    <div class="vcc-team-swiper swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ( $members as $m ) : ?>
                            <div class="swiper-slide">
                                <div class="vcc-team-card">
                                    <div class="vcc-team-card__img-wrap">
                                        <?php if ( $m['photo'] ) : ?>
                                            <img src="<?php echo esc_url( $m['photo'] ); ?>"
                                                 alt="<?php echo esc_attr( $m['name'] ); ?>">
                                        <?php else : ?>
                                            <div class="vcc-team-card__placeholder">👤</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="vcc-team-card__info">
                                        <div class="name-sirname"><?php echo esc_html( $m['name'] ); ?></div>
                                        <div class="designation3"><?php echo esc_html( $m['designation'] ); ?></div>
                                        <div class="builds-scalable-businesses"><?php echo esc_html( $m['bio'] ); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Swiper navigation buttons (styled to match existing UI) -->
                    <div class="vcc-swiper-nav">
                        <button class="vcc-swiper-prev" aria-label="Previous">&lt;</button>
                        <button class="vcc-swiper-next" aria-label="Next">&gt;</button>
                    </div>
                    <?php else : ?>
                    <p style="text-align:center; padding:30px; color:#888;">
                        Add team members via <strong>Our Team &rsaquo; Add Team Member</strong> in the WordPress admin.
                    </p>
                    <?php endif; ?>

                     <a href="<?php echo esc_url($about_contact_url); ?>" class="interested-being-a">Interested being a part of ValueCast Partners?</a>
                <!-- <a href="<?php echo esc_url($about_contact_url); ?>" class="buttonwhite-about">
                    <div class="write-to-our">WRITE TO OUR TALENT EXPERT</div>
                </a> -->
                 <center>
                    <a href="<?php echo esc_url($about_contact_url); ?>" class="buttonwhite-about">
                        <div class="write-to-our">WRITE TO OUR TALENT EXPERT</div>
                        <div class="arrow-right-wrapper">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </div>
                    </a>
                </center>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    if (typeof Swiper === 'undefined') return;
                    new Swiper('.vcc-team-swiper', {
                        slidesPerView: 1,
                        spaceBetween: 20,
                        loop: true,
                        navigation: {
                            nextEl: '.vcc-swiper-next',
                            prevEl: '.vcc-swiper-prev',
                        },
                        breakpoints: {
                            600:  { slidesPerView: 2 },
                            900:  { slidesPerView: 3 },
                            1200: { slidesPerView: 4 },
                        },
                    });
                });
                </script>


               
            </div>
        </div>

        
    </div>
</div>

<!-- ================================================================
     CTA SECTION
     ================================================================ -->
<section class="vc-cta" id="contact">
    <img class="vector-icon top-right" alt=""
        src="<?php echo home_url('/wp-content/uploads/2026/03/white-corner.png'); ?>">
    <img class="vector-icon bottom-left" alt=""
        src="<?php echo home_url('/wp-content/uploads/2026/03/black-corner.png'); ?>">
    <div class="vc-cta-inner">
        <span class="vc-lbl" style="color:rgba(255,255,255,0.5); font-weight:600;">Contact Us</span>
        <h2><?php echo esc_html($cta_hl); ?></h2>
        <a href="<?php echo esc_url($cta_url); ?>" class="vc-cta-btn">
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