import $ from 'jquery';
import { ExchangeView } from './view';
import { ExchangeController } from './controller';
import { UIFormElements, UISelector } from './types';

function createSelector(container: JQuery<HTMLElement>): UISelector {
  const dropdownBlock = container.find('.welcome-exchange__list');

  return {
    selectedItem:      container.find('.welcome-exchange__select-selected-value'),
    selectedBlock:     container.find('.welcome-exchange__select-selected'),
    selectedArrow:     container.find('.welcome-exchange__arrow'),
    selectedFormItem:  container.find('input[name="currency_to"]'),
    list: {
      block:     dropdownBlock,
      input:     dropdownBlock.find('input'),
      tabs:      dropdownBlock.find('.tab-list'),
      elements:  dropdownBlock.find('.list-items'),
    }
  };
}

function getFormElements(): UIFormElements {
  const form = $('.crypto-form__exchange-form');

  return {
    form:             form,
    inputSend:        form.find('.amount-send__input'),
    inputGet:         form.find('.amount-get__input'),
    usdHintSend:      form.find('#usdFromHint'),
    usdHintGet:       form.find('#usdToHint'),
    reverseBtn:       form.find('.welcome-exchange__icon-reverse'),
    selectorSend:     createSelector(form.find('.welcome-exchange-send__select')),
    selectorGet:      createSelector(form.find('.welcome-exchange-get__select')),
    timer:            form.find(".exchangeTimer"),
    globalCourseFrom: form.find(".courseFrom"),
    globalCourseTo:   form.find(".courseTo"),
    errorDisplay:     null
  };
}

async function bootstrap(): Promise<void> {
  const elements = getFormElements();
  const view = new ExchangeView(elements);

  const controller = new ExchangeController(view, {
    send: 'BTC',
    get:  'ETH'
  });

  await controller.init();
}

$(document).ready(() => {
  bootstrap().catch(console.error);
});
