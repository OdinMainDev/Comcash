import { ICurrency } from "@/shared/models/interfaces/currency";

export type UIDropdown = {
  input: JQuery<HTMLElement>;
  tabs: JQuery<HTMLElement>;
  elements: JQuery<HTMLElement>;
  block: JQuery<HTMLElement>;
};

export type UISelector = {
  selectedBlock: JQuery<HTMLElement>;
  selectedItem: JQuery<HTMLElement>;
  selectedArrow: JQuery<HTMLElement>;
  selectedFormItem: JQuery<HTMLElement>;
  list: UIDropdown;
};

export type UIFormElements = {
  form: JQuery<HTMLElement>;
  inputSend: JQuery<HTMLElement>;
  inputGet: JQuery<HTMLElement>;
  usdHintSend: JQuery<HTMLElement>;
  usdHintGet: JQuery<HTMLElement>;
  reverseBtn: JQuery<HTMLElement>;
  selectorSend: UISelector;
  selectorGet: UISelector;
  timer: JQuery<HTMLElement>;
  globalCourseFrom: JQuery<HTMLElement>;
  globalCourseTo: JQuery<HTMLElement>;
  blockLeft: JQuery<HTMLElement>;
  blockRight: JQuery<HTMLElement>;
  submitBtn: JQuery<HTMLElement>;
  lock: JQuery<HTMLElement> | null;
  errorDisplay: JQuery<HTMLElement> | null;
};

export type SelectedCurrency = {
  currency: ICurrency;
  amount?: number;
};


export type ExchangeViewCallbacks = {
  onInputSearchChange?: (query: string, isSend: boolean) => void;
  onInputChange?: (value: number, isSend: boolean) => void;
  onCurrencySelect?: (currency: ICurrency, isSend: boolean) => Promise<void>;
  onTabSelect?: (tab: string, isSend: boolean) => Promise<void>;
  onLock?: (locked: boolean) => Promise<void>;
  onSubmit?: (e: JQuery.ClickEvent<HTMLElement, undefined, HTMLElement, HTMLElement>) => Promise<void>;
  onReverse?: () => Promise<void>;
};

export type ParsedURLDefaults = {
    currencyFrom?: string;
    currencyTo?: string;
    amount?: number;
};


export type EventCallback = (...args: any[]) => void;

export enum Side {
  Send = "send",
  Get = "get",
}