import { isValidEmail } from "../exchageFormScripts/helpers/validators";
import { SelectedCurrency } from "./types";

export class ExchangeLayoutsManager {
  private readonly form: JQuery<HTMLElement>;
  private lastLayouts: string[] = [];
  private readonly courseFrom: JQuery<HTMLElement>;
  private readonly courseTo: JQuery<HTMLElement>;

  private readonly selectors = {
    send: {
      amount: $("#validation__you-send-amount"),
      currency: $("#validation__you-send-currency"),
      currencyImg: $("#validation__you-send-currency-img"),
    },
    get: {
      amount: $("#validation__you-get-amount"),
      currency: $("#validation__you-get-currency"),
      currencyImg: $("#validation__you-get-currency-img"),
    },
  };

  constructor(form: JQuery<HTMLElement>) {
    this.form = form;
    this.courseFrom = form.find("._courseFrom");
    this.courseTo = form.find("._courseTo");
  }

  updateCourse(from: string, to: string): void {
    this.courseFrom.text(from);
    this.courseTo.text(to);
  }

  updateSelected(selected: SelectedCurrency, isSend: boolean): void {
    const side = isSend ? "send" : "get";
    const sel = this.selectors[side];

    sel.amount.text(selected.amount?.toString() ?? "");
    sel.currency.text(selected.currency.name);
    sel.currencyImg.text(selected.currency.image);
  }

  showLayouts(layouts: string[]): void {
    layouts.forEach(l => this.form.find(`#exchange-${l}`).removeClass("hide"));
    this.lastLayouts = layouts;
  }

  hideSavedLayouts(): void {
    this.lastLayouts.forEach(l => this.form.find(`#exchange-${l}`).addClass("hide"));
    this.lastLayouts = [];
  }

  showUserValidationForm(): void {
    $(".exchange-title").addClass("hidden");
    this.form.find(".exchange__main-form").addClass("hide");
    this.form.find(".validation").removeClass("hide");
  }

  private markError($input: JQuery<HTMLElement>): void {
    $input.addClass("input--error");
    setTimeout(() => $input.removeClass("input--error"), 2000);
  }

  validate(): boolean {
    if (!this.lastLayouts.length) return true;

    let isValid = true;

    for (const layout of this.lastLayouts) {
      const $input = this.form.find(`#exchange-${layout} > input`);
      if (!$input.length) continue;

      let val = ($input.val() ?? "").toString().trim();
      if (layout === "phone") val = val.replace(/\+/g, "");

      if (!val || (layout === "email" && !isValidEmail(val))) {
        isValid = false;
        this.markError($input);
      }
    }

    if (isValid) this.showUserValidationForm();

    return isValid;
  }
}
