import $ from 'jquery';
import { ExchangeView } from './view';
import { ExchangeController } from './controller';
import { SelectedCurrency, UIFormElements, UISelector } from './types';
import { ISetting } from '@/shared/models/interfaces/settings';
import { ExchangeLayoutsManager } from './layout';

const createSelector = (container: JQuery<HTMLElement>): UISelector => {
  const dropdownBlock = container.find('.welcome-exchange__list');
  return {
    selectedItem:     container.find('.welcome-exchange__select-selected-value'),
    selectedBlock:    container.find('.welcome-exchange__select-selected'),
    selectedArrow:    container.find('.welcome-exchange__arrow'),
    selectedFormItem: container.find('.hidden-currency'),
    list: {
      block:    dropdownBlock,
      input:    dropdownBlock.find('input'),
      tabs:     dropdownBlock.find('.tab-list'),
      elements: dropdownBlock.find('.list-items'),
    },
  };
};

const getFormElements = (form: JQuery<HTMLElement>): UIFormElements => ({
  form,
  inputSend:        form.find('.amount-send__input'),
  inputGet:         form.find('.amount-get__input'),
  usdHintSend:      form.find('#usdFromHint'),
  usdHintGet:       form.find('#usdToHint'),
  reverseBtn:       form.find('.welcome-exchange__icon-reverse'),
  selectorSend:     createSelector(form.find('.welcome-exchange-send__select')),
  selectorGet:      createSelector(form.find('.welcome-exchange-get__select')),
  blockLeft:        form.find('.exchnage-panel-left'),
  blockRight:       form.find('.exchnage-panel-right'),
  timer:            form.find(".exchangeTimer"),
  globalCourseFrom: form.find(".courseFrom"),
  globalCourseTo:   form.find(".courseTo"),
  submitBtn:        form.find(".submit-button"),
  lock:             form.find(".get-lock"),
  errorDisplay:     null,
});

const initializeLayoutsManager = (controller: ExchangeController, form: JQuery<HTMLElement>) => {
  if (!$(".validation").length) return;

  const layoutsManager = new ExchangeLayoutsManager(form);

  const hideLayouts = () => layoutsManager.hideSavedLayouts();
  controller.on("updateSettings", (settings: ISetting) => {
    hideLayouts();
    layoutsManager.showLayouts(settings.layout);
  });


  // controller.on("reverse", hideLayouts);
  // controller.on("currencySelect", hideLayouts);

  controller.on("onSubmit", (e: JQuery.Event) => {
    e.preventDefault();
    layoutsManager.validate();
  });

  controller.on("onUpdateGlobalCourse", (from: string, to: string) => {
    layoutsManager.updateCourse(from, to);
  });

  controller.on("onSetSelected", (selected: SelectedCurrency, isSend: boolean) => {
    layoutsManager.updateSelected(selected, isSend);
  });
};

const setupModal = () => {
  const $openBtn = $("#openConverter");
  const $closeBtn = $("#closeConverter");
  const $modal = $("#converterModal");
  const $inner = $("#converterInner");

  if (!$openBtn.length || !$closeBtn.length || !$modal.length || !$inner.length) return;

  const openModal = () => {
    $modal.removeClass("hidden");
    $("body").css({ overflow: "hidden", height: "100vh" });
    setTimeout(() => $inner.removeClass("translate-y-full").addClass("translate-y-0"), 20);
  };

  const closeModal = () => {
    $inner.removeClass("translate-y-0").addClass("translate-y-full");
    setTimeout(() => {
      $modal.addClass("hidden");
      $("body").css({ overflow: "", height: "" });
    }, 300);
  };

  $openBtn.on("click", openModal);
  $closeBtn.on("click", closeModal);

  $modal.on("click", e => {
    if (e.target === e.currentTarget) closeModal();
  });

  $(window).on("resize", () => {
    if (($(window).width() ?? 0) >= 760 && !$modal.hasClass("hidden")) {
      closeModal();
    }
  });
};

async function initWithRetry(controller: any) {
  while (true) {
    const result = await controller.init();
    if (result) break; 
    await new Promise(resolve => setTimeout(resolve, 5000)); 
  }
}
async function bootstrapForm(): Promise<void> {
  const form = $('.crypto-form__exchange-form');
  const elements = getFormElements(form);
  const view = new ExchangeView(elements);

  const controller = new ExchangeController(view, { send: 'BTC', get: 'ETH' });

  initializeLayoutsManager(controller, form);

  await initWithRetry(controller);
}

$(document).ready(() => {
  bootstrapForm().catch(console.error);
  setupModal();
});
