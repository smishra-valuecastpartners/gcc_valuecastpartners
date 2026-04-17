/**
 * valuecast.js – Header + page interactions
 */
(function ($) {
  'use strict';

  function initHeader() {
    var $navbar    = $('#vc-navbar');
    var $hamburger = $('#vc-hamburger');
    var $overlay   = $('#vc-mobile-overlay');
    var $body      = $('body');
    var scrollPos  = 0;
    var isOpen     = false;

    if (!$navbar.length) return;

    /* ── Sticky on scroll ──────────────────────────────────── */
    function handleScroll() {
      if (!isOpen) {
        $navbar.toggleClass('scrolled', $(window).scrollTop() > 60);
      }
    }
    $(window).off('scroll.vc').on('scroll.vc', handleScroll);
    handleScroll();

    if (!$hamburger.length || !$overlay.length) return;

    /* ── Open ──────────────────────────────────────────────── */
    function openMenu() {
      if (isOpen) return;
      isOpen = true;
      scrollPos = window.pageYOffset || document.documentElement.scrollTop;

      // Force navbar fixed + dark
      $navbar.addClass('vc-menu-is-open scrolled');

      // Animate hamburger to X
      $hamburger.addClass('open').attr('aria-expanded', 'true');

      // Show overlay (rAF ensures transition fires after display change)
      requestAnimationFrame(function () {
        $overlay.addClass('open');
      });

      // Lock body scroll
      $body.addClass('vc-menu-open');
      $body.css({
        'position': 'fixed',
        'top': -scrollPos + 'px',
        'left': '0',
        'right': '0',
        'width': '100%',
        'overflow': 'hidden'
      });
    }

    /* ── Close ─────────────────────────────────────────────── */
    function closeMenu() {
      if (!isOpen) return;
      isOpen = false;

      $hamburger.removeClass('open').attr('aria-expanded', 'false');
      $overlay.removeClass('open');

      // Unlock body
      $body.removeClass('vc-menu-open');
      $body.css({
        'position': '',
        'top': '',
        'left': '',
        'right': '',
        'width': '',
        'overflow': ''
      });

      // Restore scroll
      window.scrollTo(0, scrollPos);

      // Let scroll handler decide navbar state
      $navbar.removeClass('vc-menu-is-open');
      handleScroll();
    }

    /* ── Toggle (prevents ghost double-tap on Android) ─────── */
    var touchHandled = false;

    $hamburger
      .off('touchstart.vcMenu click.vcMenu')
      .on('touchstart.vcMenu', function (e) {
        e.preventDefault();
        e.stopPropagation();
        touchHandled = true;
        if (isOpen) { closeMenu(); } else { openMenu(); }
      })
      .on('click.vcMenu', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (touchHandled) { touchHandled = false; return; }
        if (isOpen) { closeMenu(); } else { openMenu(); }
      });

    /* ── Close on nav link click ───────────────────────────── */
    $overlay.off('click.vcLink').on('click.vcLink', 'a', function () {
      setTimeout(closeMenu, 100);
    });

    /* ── Close on outside tap ──────────────────────────────── */
    $(document).off('click.vcOut touchstart.vcOut').on('click.vcOut touchstart.vcOut', function (e) {
      if (!isOpen) return;
      if (!window.matchMedia('(max-width: 991px)').matches) return;
      if (
        !$(e.target).closest('#vc-mobile-overlay').length &&
        !$(e.target).closest('#vc-hamburger').length &&
        !$(e.target).closest('.vc-nav-actions').length
      ) {
        closeMenu();
      }
    });

    /* ── Escape key ────────────────────────────────────────── */
    $(document).off('keydown.vcMenu').on('keydown.vcMenu', function (e) {
      if (e.key === 'Escape' && isOpen) closeMenu();
    });

    /* ── Auto-close on resize above mobile ─────────────────── */
    $(window).off('resize.vcMenu').on('resize.vcMenu', function () {
      if (!window.matchMedia('(max-width: 991px)').matches && isOpen) closeMenu();
    });
  }

  /* ── Focus area tabs ─────────────────────────────────────── */
  $(document).on('click', '.vc-tab', function () {
    var tab = $(this).data('tab');
    $('.vc-tab').removeClass('active');
    $(this).addClass('active');
    $('.vc-pane').removeClass('active');
    $('#vc-tab-' + tab).addClass('active');
  });

  /* ── Scroll reveal ───────────────────────────────────────── */
  function initReveal() {
    if (!('IntersectionObserver' in window)) {
      $('.vc-r').addClass('on');
      return;
    }
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('on');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    document.querySelectorAll('.vc-r').forEach(function (el) {
      observer.observe(el);
    });
  }

  /* ── Smooth scroll ───────────────────────────────────────── */
  $(document).on('click', 'a[href^="#"]', function (e) {
    var target = $(this).attr('href');
    if (target.length > 1 && $(target).length) {
      e.preventDefault();
      var $nb = $('#vc-navbar');
      var offset = $nb.length ? $nb.outerHeight() : 72;
      $('html, body').animate({ scrollTop: $(target).offset().top - offset }, 600);
    }
  });

  /* ── Init ────────────────────────────────────────────────── */
  $(document).ready(function () {
    initHeader();
    $('.vc-card, .vc-wi, .vc-wwd-right').each(function () {
      if (!$(this).hasClass('vc-r')) $(this).addClass('vc-r');
    });
    initReveal();
  });

}(jQuery));