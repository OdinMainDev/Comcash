import $ from 'jquery';
import { UISelector } from "./types";
import { ICurrency } from "@/shared/models/interfaces/currency";
import { getCurrentLanguage } from "./utils";

export class CurrencyListRenderer {
  constructor(
    private selector: UISelector,
    private onSelect: (currency: ICurrency) => void
  ) {}

  render(currencies: ICurrency[]) {
    const container = this.selector.list.elements;
    container.empty();

    currencies.forEach((currency) => {
      const $item = $(this.getHTML(currency));
      $item.on("click", () => this.onSelect(currency));
      container.append($item);
    });
  }

  private getHTML(currency: ICurrency): string {
    const lang = getCurrentLanguage();
    return `
      <div list-item-name="${currency.name}" class="dropdown-item px-4 h-[40px] hover:bg-[#333] flex items-center gap-2 cursor-pointer">
        <img class="w-5 h-5 rounded-full bg-green-500" src="${currency.image}">
        <span class="text-sm">${currency.data.titles[lang]}</span>
      </div>
    `;
  }
}
