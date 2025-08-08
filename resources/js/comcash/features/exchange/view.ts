import $ from 'jquery';
import { UIFormElements, SelectedCurrency, ExchangeViewCallbacks } from "./types";
import { SelectorDropdown } from "./dropdown";
import { CurrencyListRenderer } from "./currenciesRender";
import { TabController } from "./tab";
import { ErrorDisplay } from "./error";
import { getCurrentLanguage } from './utils';
import { ICurrency } from '@/shared/models/interfaces/currency';

export class ExchangeView {
  private dropdownSend: SelectorDropdown;
  private dropdownGet: SelectorDropdown;
  private errorDisplay: ErrorDisplay;

  constructor(private elements: UIFormElements, private callbacks: ExchangeViewCallbacks = {}) {
    this.dropdownSend = new SelectorDropdown(elements.selectorSend);
    this.dropdownGet = new SelectorDropdown(elements.selectorGet);
    this.errorDisplay = new ErrorDisplay(elements.errorDisplay);
    this.attachEvents();
  }

  private attachEvents() {
    this.elements.inputSend.on("input", () => {
      const val = Number(this.elements.inputSend.val());
      if (!isNaN(val)) this.callbacks.onInputChange?.(val, true);
    });

    this.elements.inputGet.on("input", () => {
      const val = Number(this.elements.inputGet.val());
      if (!isNaN(val)) this.callbacks.onInputChange?.(val, false);
    });

    this.elements.selectorSend.selectedBlock.on("click", () => this.dropdownSend.toggle());
    this.elements.selectorGet.selectedBlock.on("click", () => this.dropdownGet.toggle());

    this.elements.selectorSend.list.input.on("input", async () => {
      const query = this.elements.selectorSend.list.input.val()?.toString().toLowerCase() || "";
      await this.callbacks.onInputSearchChange?.(query, true);
    });

    this.elements.selectorGet.list.input.on("input", async () => {
      const query = this.elements.selectorGet.list.input.val()?.toString().toLowerCase() || "";
      await this.callbacks.onInputSearchChange?.(query, false);
    });

    this.elements.reverseBtn.on("click", async () => {
      await this.callbacks.onReverse?.();
    });

    $(document).on("click", (event) => {
      const target = $(event.target);
      [this.elements.selectorSend, this.elements.selectorGet].forEach((selector, i) => {
        const dropdown = i === 0 ? this.dropdownSend : this.dropdownGet;
        if (
          !target.closest(selector.selectedBlock).length &&
          !target.closest(selector.list.block).length
        ) {
          if (selector.list.block.is(":visible")) dropdown.close();
        }
      });
    });
  }

  updateCurrencyList(currencies: ICurrency[], isSend: boolean) {
    const selector = isSend ? this.elements.selectorSend : this.elements.selectorGet;
    debugger;
    const renderer = new CurrencyListRenderer(selector, async (currency) => {
      this.setSelected({ currency }, isSend);
      await this.callbacks.onCurrencySelect?.(currency, isSend);
      (isSend ? this.dropdownSend : this.dropdownGet).close();
    });
    renderer.render(currencies);
  }

  updateTabList(currencies: ICurrency[], isSend: boolean) {
    const selector = isSend ? this.elements.selectorSend : this.elements.selectorGet;
    const tags = Array.from(new Set(currencies.map(c => c.tag)));
    const controller = new TabController(selector.list.tabs, async (tag) => {
      await this.callbacks.onTabSelect?.(tag, isSend);
    });
    controller.render(tags);
  }
  updateGlobalCourse(from: string, to: string) {
    if (this.elements.globalCourseFrom && this.elements.globalCourseTo) {
      this.elements.globalCourseFrom.text(from);
      this.elements.globalCourseTo.text(to);
    }
  }

  setSelected(selected: SelectedCurrency, isSend: boolean) {
    const input = isSend ? this.elements.inputSend : this.elements.inputGet;
    const selector = isSend ? this.elements.selectorSend : this.elements.selectorGet;
    input.val(selected.amount ?? 0);
    selector.selectedItem.html(this.getHTMLSelectedItem(selected.currency));
    selector.selectedFormItem.val(selected.currency.name);
    selector.list.elements.find(`[list-item-name="${selected.currency.name}"]`).hide();
    selector.list.elements.find(`[list-item-name]`)
      .not(`[list-item-name="${selected.currency.name}"]`)
      .filter(':hidden')
      .show();
  }

  updateUSDTHint(value: number) {
    this.elements.usdHintGet.text(value);
    this.elements.usdHintSend.text(value);
  }

  showError(message: string) {
    this.errorDisplay.show(message);
  }

  setCallbacks(callbacks: typeof this.callbacks) {
    this.callbacks = callbacks;
  }

  updateTimer(time: string) {
    this.elements.timer?.text(time);
  }

  private getHTMLSelectedItem(currency: ICurrency): string {
    const lang = getCurrentLanguage();
    return `
      <div class="flex items-center gap-[12px] welcome-exchange__select-selected-value">
        <img src="${currency.image}" class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img"/>
        <span class="text-sm">
          <div class="welcome-exchange__name">${currency.data.titles[lang]}</div>
        </span>
      </div>
    `;
  }
}