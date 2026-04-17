/**
 * portfolio.js — Dynamic Our Portfolio page
 * Valuecast Theme  |  page-our-portfolio.php
 *
 * Features:
 *  - Click industry tab → AJAX fetch filtered cards
 *  - Click "View Case Study" → AJAX fetch modal content
 *  - Marquee animation
 *  - Card drag-scroll
 *  - Keyboard accessible tabs
 */
(function ($) {
  'use strict';

  var ajaxUrl    = (typeof VCPortfolio !== 'undefined') ? VCPortfolio.ajaxUrl    : '/wp-admin/admin-ajax.php';
  var nonce      = (typeof VCPortfolio !== 'undefined') ? VCPortfolio.nonce      : '';
  var contactUrl = (typeof VCPortfolio !== 'undefined') ? VCPortfolio.contactUrl : '#contact';

  /* ─────────────────────────────────────────
     INDUSTRY TAB — AJAX CARD FILTERING
  ───────────────────────────────────────── */
  var $tabs       = $('.industry-item');
  var $wrap       = $('#portfolio-cards-wrap');
  var $spinner    = $('#pf-spinner');
  var $indicator  = $('#industry-indicator');
  var $highlight  = $('#industry-highlight');

  function activateTab($tab) {
    var slug  = $tab.data('slug');
    var idx   = parseInt($tab.data('index'), 10) || 0;

    // Update active visual state
    $tabs.removeClass('industry-item--active text-wrapper-3').addClass('text-wrapper-4');
    $tab.addClass('industry-item--active text-wrapper-3').removeClass('text-wrapper-4');

    // Move the blue bar and highlight (desktop sidebar)
    var topPx = 111 + idx * 90;
    $indicator.css('top', topPx + 'px');
    $highlight.css('top', topPx + 'px');

    // Show spinner, clear cards
    $spinner.show();
    $wrap.css('opacity', '0.3');

    // AJAX request
    $.ajax({
      url:  ajaxUrl,
      type: 'POST',
      data: {
        action:   'vc_filter_portfolio',
        nonce:    nonce,
        industry: slug,
      },
      success: function (res) {
        if (res.success && res.data.html) {
          $wrap.html(res.data.html);
          initDragScroll();   // re-bind drag on new cards
        }
      },
      error: function () {
        $wrap.html('<div class="pc-empty"><p>Could not load items. Please try again.</p></div>');
      },
      complete: function () {
        $spinner.hide();
        $wrap.css('opacity', '1');
      },
    });
  }

  // Click handler
  $tabs.on('click', function () {
    activateTab($(this));
  });

  // Keyboard handler (Enter / Space)
  $tabs.on('keydown', function (e) {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      activateTab($(this));
    }
  });

  /* ─────────────────────────────────────────
     CASE STUDY MODAL — AJAX CONTENT LOAD
  ───────────────────────────────────────── */
  var $modal    = $('#cs-modal');
  var $loading  = $('#cs-loading');
  var $content  = $('#cs-content');
  var emptyStateHtml = '<div class="cs-empty-state"><p class="cs-empty-state__title">No Case Study</p><p class="cs-empty-state__text">We are preparing this case study. Please check back soon.</p></div>';

  function openModal() {
    $modal.addClass('is-open').attr('aria-hidden', 'false');
    $('body').css('overflow', 'hidden');
  }

  function closeModal() {
    $modal.removeClass('is-open').attr('aria-hidden', 'true');
    $('body').css('overflow', '');
    // Reset content for next open
    $loading.show();
    $content.hide();
    $('#cs-thumb').hide().attr('src', '');
  }

  function populateModal(data) {
    $('#cs-title').text(data.title || '');
    $('#cs-location').text(data.location || '').toggle(!!data.location);
    $('#cs-industry').text(data.industry || '').toggle(!!data.industry);

    var $thumb = $('#cs-thumb');
    if (data.thumb) {
      $thumb.attr('src', data.thumb).attr('alt', data.title).show();
    } else {
      $thumb.hide();
    }

    $('#cs-stats').html(data.stats_html || '').toggle(!!data.stats_html);
    $('#cs-body').html(data.body || emptyStateHtml);
    $('#cs-cta').attr('href', contactUrl);

    $loading.hide();
    $content.show();
  }

  // Delegate click on cards wrap (works after AJAX re-render too)
  $(document).on('click', '.pc-case-study-btn', function () {
    var pid = $(this).data('id');
    openModal();

    $.ajax({
      url:  ajaxUrl,
      type: 'POST',
      data: {
        action:  'vc_get_case_study',
        nonce:   nonce,
        post_id: pid,
      },
      success: function (res) {
        if (res.success) {
          populateModal(res.data);
        } else {
          $('#cs-body').html(emptyStateHtml);
          $loading.hide();
          $content.show();
        }
      },
      error: function () {
        $('#cs-body').html(emptyStateHtml);
        $loading.hide();
        $content.show();
      },
    });
  });

  // Close triggers
  $('#cs-close, #cs-backdrop').on('click', closeModal);
  $(document).on('keydown', function (e) {
    if (e.key === 'Escape') closeModal();
  });

  /* ─────────────────────────────────────────
     DRAG SCROLL — portfolio cards row
  ───────────────────────────────────────── */
  function initDragScroll() {
    var $row  = $('#portfolio-cards-wrap');
    var isDown = false, startX, scrollLeft;

    $row.off('mousedown mouseleave mouseup mousemove'); // unbind stale handlers

    $row.on('mousedown', function (e) {
      isDown     = true;
      startX     = e.pageX - $row.offset().left;
      scrollLeft = $row.scrollLeft();
    });
    $row.on('mouseleave mouseup', function () { isDown = false; });
    $row.on('mousemove', function (e) {
      if (!isDown) return;
      e.preventDefault();
      var x    = e.pageX - $row.offset().left;
      var walk = (x - startX) * 1.5;
      $row.scrollLeft(scrollLeft - walk);
    });
  }

  initDragScroll();

  /* ─────────────────────────────────────────
     MARQUEE ANIMATION
  ───────────────────────────────────────── */
  var track = document.querySelector('.element-our-portfolio .marquee-track');
  if (track) {
    var pos = 0;
    (function tick() {
      pos -= 0.5;
      if (Math.abs(pos) >= track.scrollWidth / 2) pos = 0;
      track.style.transform = 'translateX(' + pos + 'px)';
      requestAnimationFrame(tick);
    })();
  }

  /* ─────────────────────────────────────────
     SMOOTH SCROLL — in-page anchor links
  ───────────────────────────────────────── */
  $(document).on('click', '.element-our-portfolio a[href^="#"]', function (e) {
    var target = document.querySelector($(this).attr('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth' });
    }
  });

})(jQuery);
