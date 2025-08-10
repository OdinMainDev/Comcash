import $ from 'jquery';
$(document).ready(function () {
    $('.js-pass-group').each(function () {
      var $group = $(this);
      var $input = $group.find('.js-pass-input');
      var $toggleBtn = $group.find('.js-pass-toggle');
      var $eyeShow = $group.find('.js-eye-show');
      var $eyeHide = $group.find('.js-eye-hide');
  
      if (!$input.length || !$toggleBtn.length || !$eyeShow.length || !$eyeHide.length) return;
  
      $toggleBtn.on('click', function () {
        var isText = $input.attr('type') === 'text';
        $input.attr('type', isText ? 'password' : 'text');
        $eyeShow.toggleClass('hidden', !isText);
        $eyeHide.toggleClass('hidden', isText);
      });
  
      const toggleVisibility = () => {
        const val = $input.val();
        const hasValue = val !== undefined && val !== null && val.toString().trim().length > 0;
        $toggleBtn.toggleClass('invisible', !hasValue);
      };
      
      toggleVisibility();
      $input.on('input', toggleVisibility);
    });
  });
  