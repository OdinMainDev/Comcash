import $ from 'jquery';


$(document).ready(() => {
  const $tabButtons = $('.welcome__tabs-btn');
  const $tabsContent = $('.welcome__tabs-content');

  function openTab(e: JQuery.ClickEvent, tab: string): void {
      $tabButtons.removeClass('active');
      $(e.target).addClass('active');

      $tabsContent.removeClass('active').filter(`[data-tab="${tab}"]`).addClass('active');
  }

  $tabButtons.on('click', function(e: JQuery.ClickEvent) {
      const tab = $(this).data('tab');
      openTab(e, tab);
  });

});


