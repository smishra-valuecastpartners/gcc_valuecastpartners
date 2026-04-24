/**
 * contact-us.js — Tab switcher + form validation
 * Place at: techbiz-valuecast/assets/js/contact-us.js
 */
(function ($) {
  'use strict';

  $(function () {

    var $tabs = $('.vcc-tab');
    var $hidden = $('#vcc_tab_hidden');

    if (!$tabs.length) return;

    // ── Tab switching ──────────────────────────────────────────
    $tabs.on('click', function () {
      var $this = $(this);
      var tabKey = $this.data('tab');

      $tabs.removeClass('vcc-tab--active').attr('aria-selected', 'false');
      $this.addClass('vcc-tab--active').attr('aria-selected', 'true');

      if ($hidden.length) {
        $hidden.val(tabKey);
      }

      // Handle dynamic fields based on active tab
      var $phoneWrap = $('#vcc_phone_wrap');
      var $resumeWrap = $('#vcc_resume_wrap');
      var $companyWrap = $('#vcc_company_wrap');
      var $lookingWrap = $('#vcc_looking_wrap');

      var $phoneField = $('#vcc_phone_field');

      // Reset all custom fields visibility
      $phoneWrap.hide();
      $resumeWrap.hide();
      $companyWrap.hide();
      $lookingWrap.hide();
      $phoneField.removeAttr('required');

      if (tabKey === 'partnerships') {
        $companyWrap.show();
        $('#vcc-form').css('border-radius', '0 30px 30px 30px');
      } else if (tabKey === 'talent') {
        $phoneWrap.show();
        $resumeWrap.show();
        $phoneField.attr('required', 'required');
        $('#vcc-form').css('border-radius', '30px');
      } else if (tabKey === 'general') {
        $phoneWrap.show();
        $phoneField.attr('required', 'required');
        $lookingWrap.show();
        $('#vcc-form').css('border-radius', '30px');
      }

      // Pre-select matching dropdown option
      var $select = $('#vcc_looking_field');
      if ($select.length) {
        var map = { 'partnerships': 'Partnerships', 'talent': 'Careers', 'general': '' };
        if (Object.prototype.hasOwnProperty.call(map, tabKey)) {
          $select.val(map[tabKey]);
        }
      }
    });

    // ── Scroll to success / error message ─────────────────────
    var $notice = $('.vcc-success-msg, .vcc-error-msg');
    if ($notice.length) {
      $('html, body').animate({ scrollTop: $notice.offset().top - 130 }, 400);
    }

    // ── Client-side email validation ───────────────────────────
    $('.vcc-form').on('submit', function (e) {
      var $emailField = $('#vcc_email_field');
      var $phoneField = $('#vcc_phone_field');
      var $messageField = $('#vcc_message_field');
      var activeTab = $('#vcc_tab_hidden').val();
      var email = $emailField.val().trim();
      var phone = $phoneField.val().trim();
      var phoneDigits = phone.replace(/\D+/g, '');
      var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      var phoneRe = /^\+?[0-9\s().-]{7,20}$/;

      $('#vcc-email-err').remove();
      $('#vcc-phone-err').remove();
      $('#vcc-message-err').remove();

      if (!re.test(email)) {
        e.preventDefault();
        $emailField.css('border-color', '#c62828');
        $('<span id="vcc-email-err" style="color:#c62828;font-size:13px;display:block;margin-top:4px;">'
          + 'Please enter a valid email address.</span>').insertAfter($emailField);
        $emailField.focus();
      } else {
        $emailField.css('border-color', '');
      }

      if (activeTab === 'talent' || activeTab === 'general') {
        if (!phoneRe.test(phone) || phoneDigits.length < 7 || phoneDigits.length > 15) {
          e.preventDefault();
          $phoneField.css('border-color', '#c62828');
          $('<span id="vcc-phone-err" style="color:#c62828;font-size:13px;display:block;margin-top:4px;">'
            + 'Please enter a valid phone number.</span>').insertAfter($phoneField);
          if (re.test(email)) {
            $phoneField.focus();
          }
        } else {
          $phoneField.css('border-color', '');
        }
      } else {
        $phoneField.css('border-color', '');
      }

      if ($messageField.length && $messageField.val().length > 255) {
        e.preventDefault();
        $messageField.css('border-color', '#c62828');
        $('<span id="vcc-message-err" style="color:#c62828;font-size:13px;display:block;margin-top:4px;">'
          + 'Message must be 255 characters or fewer.</span>').insertAfter($messageField);
        if (re.test(email) && (activeTab !== 'talent' && activeTab !== 'general' || (phoneRe.test(phone) && phoneDigits.length >= 7 && phoneDigits.length <= 15))) {
          $messageField.focus();
        }
      } else {
        $messageField.css('border-color', '');
      }
    });

  });

}(jQuery));
