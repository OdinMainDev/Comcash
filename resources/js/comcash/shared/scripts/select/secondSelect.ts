import $ from 'jquery';

$(() => {
  $('.select').each(function () {
    const $select = $(this);
    const $optionsList = $select.find('.select__container .select__option');
    const $selected = $select.find('.select__current');
    const $wrapper = $select.closest('.flex');

    const currentPathParts = window.location.pathname.split('/').filter(Boolean);
    const currentLocale = currentPathParts.length ? currentPathParts[0] : '';

    $optionsList.each(function () {
      const $opt = $(this);
      const $input = $opt.find('input[name="language"]');

      if ($input.val() === currentLocale) {
        $opt.hide();
      }
    });

    $select.on('click', () => {
      $select.toggleClass('active');

      if ($select.hasClass('active')) {
        $wrapper.removeClass('bg-[#2A2A2A]').removeClass('hover:bg-[#06AB6B0D]').addClass('bg-[#06AB6B]');
      } else {
        $wrapper.removeClass('bg-[#06AB6B]').addClass('bg-[#2A2A2A]').addClass('hover:bg-[#06AB6B0D]');
      }

      $(document).on('click.localeOutside', (e) => {
        if (!$(e.target).closest('.select').length) {
          $select.removeClass('active');
          $wrapper.removeClass('bg-[#06AB6B]').addClass('bg-[#2A2A2A]');
          $(document).off('click.localeOutside');
        }
      });
    });

    $optionsList.each(function () {
      const $opt = $(this);
      const $input = $opt.find('input[name="language"]');
      const $label = $opt.find('label');

      if ($input.prop('checked') && $label.length && $selected.length) {
        $opt.addClass('selected');
        $selected.html($label.html());
      }

      $opt.on('click', (e: JQuery.ClickEvent) => {
        e.preventDefault();
        e.stopPropagation();

        $optionsList.removeClass('selected');
        $opt.addClass('selected');
        $selected.html($label.html());
        $select.removeClass('active');
        $wrapper.removeClass('bg-[#06AB6B]').addClass('bg-[#2A2A2A]');

        const rawLocale = $input.val();
        const selectedLocale: string =
          typeof rawLocale === 'string' ? rawLocale : Array.isArray(rawLocale) ? rawLocale[0] : String(rawLocale);

        const pathParts = window.location.pathname.split('/').filter(Boolean);

        const availableLocales = $optionsList
          .map(function () {
            return $(this).find('input[name="language"]').val();
          })
          .get()
          .filter(Boolean)
          .map(val =>
            typeof val === 'string' ? val : Array.isArray(val) ? val[0] : String(val)
          );

        if (availableLocales.includes(pathParts[0])) {
          pathParts[0] = selectedLocale;
        } else {
          pathParts.unshift(selectedLocale);
        }

        const newPath = '/' + pathParts.join('/');
        const newUrl = newPath + window.location.search;
        window.location.href = newUrl;
      });
    });
  });
});
