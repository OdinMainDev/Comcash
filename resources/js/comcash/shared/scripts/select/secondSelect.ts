import $ from 'jquery';

$(() => {
  $('.select').each(function() {
      const $select = $(this);
      const $optionsList = $select.find('.select__container .select__option');
      const $selected = $select.find('.select__current');

      $select.on('click', () => {
          $select.toggleClass('active');

          // Close on outside click
          $(document).on('click', function cb(e: JQuery.ClickEvent) {
              if (!$(e.target).closest('.select').length) {
                  $select.removeClass('active');
                  $(document).off('click', cb);
              }
          });
      });

      $optionsList.each(function() {
          const $opt = $(this);

          // Set default option
          if ($opt.find('input').is(':checked')) {
              $opt.addClass('selected');
              $selected.html($opt.find('label').html());
          }

          // Set option on click
          $opt.on('click', (e: JQuery.ClickEvent) => {
              e.stopPropagation();
              e.preventDefault();

              $optionsList.removeClass('selected');
              $opt.addClass('selected');
              $selected.html($opt.find('label').html());
              $select.removeClass('active');
          });
      });
  });
});
