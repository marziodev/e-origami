console.log('Main JS loaded');
// WordPress jQuery Compatibility Mode BEGIN
jQuery(document).ready(function($) {
    
    // Attivo il tooltip di Bootstrap
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });

    // Incremento automatico dei counter - inizio
    // Seleziona tutti gli elementi con la classe "counter"
    const counters = document.querySelectorAll(".counter");

    // Crea un nuovo IntersectionObserver
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
        // Verifica se l'elemento è entrato nella viewport
        if (entry.intersectionRatio !== 0) {
            // Ottieni l'elemento corrispondente
            const counterElement = entry.target;
            const countTo = parseInt(counterElement.getAttribute("data-count"));

            // Avvia l'animazione del counter
            $({ countNum: parseInt(counterElement.textContent) }).animate(
            {
                countNum: countTo
            },
            {
                duration: 3000,
                easing: "linear",
                step: function() {
                counterElement.textContent = Math.floor(this.countNum);
                },
                complete: function() {
                counterElement.textContent = countTo;
                }
            }
            );

            // Disattiva l'osservazione per questo elemento
            io.unobserve(counterElement);
        }
        });
    });

    // Inizia ad osservare tutti gli elementi con la classe "counter"
    counters.forEach((counter) => {
        io.observe(counter);
    });
    // Incremento automatico dei counter - fine

    // Funzione jQuery per aggiungere gli attributi "data-toggle" e "data-target" ad una specifica voce di menù
    $('li.search-link').find('a').attr({
        'data-bs-toggle': 'modal',
        'data-bs-target': '#searchModal'
    });

    // Funzione jQuery per controllare il pulsante "ToTop" utilizzando le Intersection Observer API
    $(function() {
      const $btn = $('#backToTop');
      const sentinel = document.querySelector('#sentinel');

      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            $btn.fadeOut();
          } else {
            $btn.fadeIn();
          }
        });
      });

      observer.observe(sentinel);

      $btn.click(function() {
        $('html, body').animate({scrollTop: 0}, 500);
      });
    });


/* =======================================
   ACCESSIBILITY CONTROLS
   - Gestione font-size per layout specifici
   - Gestione contrasto elevato
   - ARIA e tastiera accessibili
   ======================================= */

    jQuery(document).ready(function($) {

      // Targets validi per l'aumento del testo
      const contentTargets = $('.nostalgia-entry-content, .shodo-entry-content, .origami-entry-content');
      const fontCtrl = $('.font-ctrl');
      //const contrastToggle = $('.contrast-toggle');
      const fontStorageKey = 'fontSizeMode';
      //const contrastStorageKey = 'contrastMode';

      /* ---- FAILSAFE ---- */
      if (contentTargets.length === 0) {
        fontCtrl.addClass('disabled').attr('aria-disabled', 'true');
      }

      /* ---- FONT SIZE ---- */
      function applyFontSize(mode) {
        contentTargets.removeClass('big-size bigger-size');
        if (mode === 'big') contentTargets.addClass('big-size');
        else if (mode === 'bigger') contentTargets.addClass('bigger-size');
      }

      fontCtrl.on('click', function() {
        if ($(this).hasClass('disabled')) return;

        const isBig = $(this).hasClass('big-size');
        const isBigger = $(this).hasClass('bigger-size');

        $(this)
          .addClass('magnified')
          .attr('aria-pressed', 'true')
          .siblings()
          .removeClass('magnified')
          .attr('aria-pressed', 'false');

        if (isBig) {
          applyFontSize('big');
          localStorage.setItem(fontStorageKey, 'big');
        } else if (isBigger) {
          applyFontSize('bigger');
          localStorage.setItem(fontStorageKey, 'bigger');
        } else {
          contentTargets.removeClass('big-size bigger-size');
          localStorage.removeItem(fontStorageKey);
        }
      });

      /* ---- CONTRASTO ---- */
      // contrastToggle.on('click', function() {
      //   $('body').toggleClass('high-contrast');
      //   const active = $('body').hasClass('high-contrast');
      //   $(this).attr('aria-pressed', active);
      //   if (active) localStorage.setItem(contrastStorageKey, 'enabled');
      //   else localStorage.removeItem(contrastStorageKey);
      // });

      /* ---- TASTIERA ---- */
      $('[role="button"]').on('keypress', function(e) {
        if (e.key === ' ' || e.key === 'Enter') {
          $(this).click();
        }
      });

      /* ---- RIPRISTINO PREFERENZE ---- */
      const savedFontMode = localStorage.getItem(fontStorageKey);
      // const savedContrast = localStorage.getItem(contrastStorageKey);

      if (savedFontMode) {
        applyFontSize(savedFontMode);
        $(`.font-ctrl.${savedFontMode}-size`).addClass('magnified').attr('aria-pressed', 'true');
        $(`.font-ctrl.${savedFontMode}-size`).siblings().removeClass('magnified').attr('aria-pressed', 'false');
      }

      // if (savedContrast === 'enabled') {
      //   $('body').addClass('high-contrast');
      //   contrastToggle.attr('aria-pressed', 'true');
      // }

    });

}); // WordPress jQuery Compatibility Mode END


