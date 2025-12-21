/*=========================================================================================
  File Name: form-tooltip-valid.js
  Description: form tooltip validation etc..
==========================================================================================*/
(function (window, document, $) {
  'use strict';

  // Validate only when a submit button is clicked, and only for its own form
  $(document).on('click', 'button[type="submit"], input[type="submit"], .btn-submit', function (e) {
    var $form = $(this).closest('form.needs-validation'); // scope to the clicked button's form
    if (!$form.length) return;                             // not inside a form? do nothing

    var formEl = $form.get(0);
    if (typeof formEl.checkValidity === 'function' && formEl.checkValidity() === false) {
      e.preventDefault();
      e.stopPropagation();
    }
    $form.addClass('was-validated');
  });

})(window, document, jQuery);
