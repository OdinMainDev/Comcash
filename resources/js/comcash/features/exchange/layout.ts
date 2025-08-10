import $ from 'jquery';
import { isValidEmail } from "../exchageFormScripts/helpers/validators";
import { SelectedCurrency } from "./types";
import './validation.scss';


type Pair = {
  ids: string[];           
  containerClass: string; 
};

export class ExchangeLayoutsManager {
  private readonly form: JQuery<HTMLElement>;
  private lastLayouts: string[] = [];
  private readonly courseFrom: JQuery<HTMLElement>;
  private readonly courseTo: JQuery<HTMLElement>;
    private pairs: Pair[] = [
    { ids: ["email", "telegram"], containerClass: "exchange__contact" },
    { ids: ["phone", "bank"], containerClass: "exchange__contact" },
    { ids: ["first_name", "last_name"], containerClass: "exchange__name" },
  ];

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

   private wrapPairs(): void {
    const $form = this.form;

    this.pairs.forEach(({ ids, containerClass }) => {
      ids.forEach((id) => {
        const $el = $form.find(`#exchange-${id}`);
        const $parent = $el.parent();
        if ($parent.hasClass(containerClass)) {
          $parent.before($el);
          $parent.remove();
        }
      });
    });

    this.pairs.forEach(({ ids, containerClass }) => {
      const visibleElements = ids
        .map((id) => $form.find(`#exchange-${id}`))
        .filter(($el) => $el.is(":visible"));

      if (visibleElements.length === 0) return;

      const gridClass =
        visibleElements.length === 1
          ? "grid grid-cols-1 gap-4"
          : "grid grid-cols-2 gap-4 max-[620px]:grid-cols-1";

      const $container = $(`<div></div>`)
        .addClass(containerClass)
        .addClass(gridClass);

      visibleElements[0].before($container);

      visibleElements.forEach(($el) => {
        $container.append($el);
      });
    });
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
    sel.currencyImg.attr("src", selected.currency.image);
  }
  

  showLayouts(layouts: string[]): void {
    layouts.forEach(l => this.form.find(`#exchange-${l}`).removeClass("hide"));
    this.lastLayouts = layouts;
    this.wrapPairs();
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
