/**
 * form-handler.js — 2-stage form handler + Telegram submit
 * Включается на всех страницах с формами
 */

(function() {
  'use strict';

  // Bot token & chat IDs — are set via PHP in form-submit.php
  // JS only sends to our endpoint

  function getPageLabel() {
    const path = window.location.pathname;
    const map = {
      '/glavnaya/': 'Главная',
      '/sell/': 'Владельцам',
      '/sell/estimate/': 'Оценка квартиры',
      '/sell/diagnostic/': 'Диагностика потерь',
      '/sell/prepare/': 'Подготовка к продаже',
      '/sell/documents/': 'Документы',
      '/sell/showings/': 'Показы',
      '/sell/negotiation/': 'Переговоры',
      '/sell/taxes/': 'Налоги',
      '/sell/alternative/': 'Альтернативная сделка',
      '/buyers/': 'Покупателям',
      '/buyers/catalog/': 'Каталог',
      '/buyers/catalog/new-buildings/': 'Новостройки',
      '/buyers/catalog/resale/': 'Вторичка',
      '/buyers/selection/': 'Подбор',
      '/buyers/check/': 'Проверить объект',
      '/buyers/check-developer/': 'Проверить застройщика',
      '/buyers/mortgage/': 'Ипотека',
      '/buyers/support/': 'Сопровождение',
      '/buyers/checklist/': 'Чек-лист',
      '/buyers/new-vs-resale/': 'Новостройка vs Вторичка'
    };
    return map[path] || path || 'unknown';
  }

  function initForm(form) {
    var action = form.getAttribute('data-action') || 'consult';
    var step1 = form.querySelector('.form-step-1');
    var step2 = form.querySelector('.form-step-2');
    var nextBtn = form.querySelector('.btn-next');
    var backBtn = form.querySelector('.btn-back');
    var submitBtn = form.querySelector('.btn-submit');
    var step1Indicator = form.querySelector('.step-indicator-1');
    var step2Indicator = form.querySelector('.step-indicator-2');

    if (!step1 || !step2) return;

    // Validate step 1 on "Далее"
    if (nextBtn) {
      nextBtn.addEventListener('click', function(e) {
        e.preventDefault();
        var required = step1.querySelectorAll('[required]');
        var valid = true;
        required.forEach(function(field) {
          if (!field.value.trim()) {
            field.style.borderColor = '#E53E3E';
            valid = false;
          } else {
            field.style.borderColor = '';
          }
        });
        if (!valid) {
          alert('Пожалуйста, заполните все обязательные поля');
          return;
        }
        // Hide all .form-step-2 across the page (in case there are multiple forms)
        document.querySelectorAll('.form-step-1').forEach(function(el) { el.style.display = 'none'; });
        document.querySelectorAll('.form-step-2').forEach(function(el) { el.style.display = 'block'; });
        if (step1Indicator) step1Indicator.classList.remove('active');
        if (step2Indicator) step2Indicator.classList.add('active');
      });
    }

    // "Назад" button
    if (backBtn) {
      backBtn.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.form-step-2').forEach(function(el) { el.style.display = 'none'; });
        document.querySelectorAll('.form-step-1').forEach(function(el) { el.style.display = 'block'; });
        if (step2Indicator) step2Indicator.classList.remove('active');
        if (step1Indicator) step1Indicator.classList.add('active');
      });
    }

    // Submit handler
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      var formData = new FormData(form);
      var data = {};
      formData.forEach(function(value, key) {
        data[key] = value;
      });

      // Add page info
      data.page = getPageLabel();
      data.page_url = window.location.href;
      data.action = action;

      // Disable button
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Отправка...';
      }

      fetch('/wp-content/scripts/form-submit.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      })
      .then(function(r) { return r.json(); })
      .then(function(res) {
        if (res.success) {
          form.innerHTML = '<div style="text-align:center;padding:20px;color:#2F7D46;font-size:18px;">' +
            '✓ Спасибо! Мы получили вашу заявку и перезвоним в течение 30 минут.</div>';
        } else {
          alert('Ошибка: ' + (res.error || 'попробуйте позже'));
          if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = submitBtn.getAttribute('data-label') || 'Отправить'; }
        }
      })
      .catch(function(err) {
        alert('Ошибка сети: ' + err.message);
        if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = submitBtn.getAttribute('data-label') || 'Отправить'; }
      });
    });
  }

  // Init on DOM ready
  if (document.readyState !== 'loading') {
    document.querySelectorAll('form[data-stage="2"]').forEach(initForm);
  } else {
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('form[data-stage="2"]').forEach(initForm);
    });
  }

})();
