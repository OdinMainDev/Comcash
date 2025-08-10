// bank-autocomplete.ts

type Bank = {
  ru: string;
  en: string;
  aliases?: string[]; // на будущее
};

const bankList: Bank[] = [
  { ru: 'Сбер', en: 'Sber' },
  { ru: 'ВТБ', en: 'VTB Bank' },
  { ru: 'Газпромбанк', en: 'Gazprombank' },
  { ru: 'Альфа-Банк', en: 'Alfa-Bank' },
  { ru: 'Россельхозбанк', en: 'Rosselkhozbank' },
  { ru: 'МКБ', en: 'Moscow Credit Bank' },
  { ru: 'ПСБ', en: 'Promsvyazbank' },
  { ru: 'Совкомбанк', en: 'Sovcombank' },
  { ru: 'Райффайзенбанк', en: 'Raiffeisenbank Russia' },
  { ru: 'Росбанк', en: 'Rosbank' },
  { ru: 'Дом.РФ', en: 'DOM.RF Bank' },
  { ru: 'Т-Банк', en: 'T-Bank' },
  { ru: 'ЮниКредит Банк', en: 'UniCredit Bank' },
  { ru: 'АК БАРС Банк', en: 'AK BARS Bank' },
  { ru: 'МТС Банк', en: 'MTS Bank' },
  { ru: 'Банк Санкт-Петербург', en: 'Bank Saint Petersburg' },
  { ru: 'Уралсиб', en: 'URALSIB Bank' },
  { ru: 'Кредит Европа Банк', en: 'Credit Europe Bank' },
];

function initBankAutocomplete(options?: {
  containerId?: string;
  inputSelector?: string;
  dropdownId?: string;
  maxItems?: number;
  setValue?: (bank: Bank) => string;
}) {
  const {
    containerId = 'exchange-bank',
    inputSelector = 'input[name="bank"]',
    dropdownId = 'bank-dropdown',
    maxItems = 50,
    setValue = (b) => b.ru,
  } = options || {};

  const container = document.getElementById(containerId);
  if (!container) return;

  const input = container.querySelector<HTMLInputElement>(inputSelector);
  if (!input) return;

  let dropdown = container.querySelector<HTMLUListElement>(`#${dropdownId}`);
  if (!dropdown) {
    dropdown = document.createElement('ul');
    dropdown.id = dropdownId;
    dropdown.className =
      'absolute w-full bg-[#1E1E1ECC]/90 backdrop-blur-xl border border-white/10 mt-1 rounded max-h-[250px] overflow-y-auto hidden z-[999]';
    container.classList.add('relative');
    container.appendChild(dropdown);
  }

  // ARIA для доступности
  input.setAttribute('role', 'combobox');
  input.setAttribute('aria-autocomplete', 'list');
  input.setAttribute('aria-expanded', 'false');
  input.setAttribute('aria-controls', dropdown.id);
  dropdown.setAttribute('role', 'listbox');

  let items: Bank[] = [];
  let highlightedIndex = -1;

  const normalize = (s: string) =>
    s.toLowerCase().replace(/\s+/g, ' ').trim().replace(/[-–—]+/g, '-');

  const score = (bank: Bank, q: string): number => {
    const r = normalize(bank.ru);
    const e = normalize(bank.en);
    const qn = normalize(q);
    if (!qn) return -1;
    if (r.startsWith(qn) || e.startsWith(qn)) return 0;
    if (r.includes(qn) || e.includes(qn)) return 1;
    return 999;
  };

  const filterBanks = (q: string): Bank[] => {
    const ranked = bankList
      .map((b) => ({ b, s: score(b, q) }))
      .filter(({ s }) => s < 999)
      .sort((a, b) => a.s - b.s)
      .slice(0, maxItems)
      .map(({ b }) => b);
    return ranked;
  };

  const setExpanded = (expanded: boolean) => {
    input.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    dropdown!.classList.toggle('hidden', !expanded);
  };

  const clearDropdown = () => {
    dropdown!.innerHTML = '';
    highlightedIndex = -1;
    input.removeAttribute('aria-activedescendant');
  };

  const highlight = (index: number) => {
    const children = Array.from(dropdown!.children) as HTMLElement[];
    if (children.length === 0) return;
    if (highlightedIndex >= 0 && children[highlightedIndex]) {
      children[highlightedIndex].classList.remove('bg-[#06AB6B]/40');
    }
    highlightedIndex = Math.max(0, Math.min(index, children.length - 1));
    const el = children[highlightedIndex];
    el.classList.add('bg-[#06AB6B]/40');
    input.setAttribute('aria-activedescendant', el.id);
    // Прокрутить в область видимости
    el.scrollIntoView({ block: 'nearest' });
  };

  const selectBank = (bank: Bank) => {
    input.value = setValue(bank);
    clearDropdown();
    setExpanded(false);
  };

  const render = (list: Bank[]) => {
    clearDropdown();
    if (list.length === 0) {
      setExpanded(false);
      return;
    }

    const frag = document.createDocumentFragment();
    list.forEach((bank, idx) => {
      const li = document.createElement('li');
      li.id = `${dropdownId}-option-${idx}`;
      li.setAttribute('role', 'option');
      li.dataset.index = String(idx);
      li.className =
        'px-4 py-2 cursor-pointer text-white/90 truncate hover:bg-[#06AB6B]/40';

      const ruSpan = document.createElement('span');
      ruSpan.textContent = bank.ru;

      const sep = document.createTextNode(' — ');

      const enSpan = document.createElement('span');
      enSpan.className = 'text-white/50';
      enSpan.textContent = bank.en;

      li.appendChild(ruSpan);
      li.appendChild(sep);
      li.appendChild(enSpan);

      li.addEventListener('mouseenter', () => {
        const i = Number(li.dataset.index);
        if (!Number.isNaN(i)) highlight(i);
      });

      li.addEventListener('mousedown', (e) => {
        e.preventDefault();
      });

      li.addEventListener('click', () => {
        const i = Number(li.dataset.index);
        if (!Number.isNaN(i)) selectBank(items[i]);
      });

      frag.appendChild(li);
    });

    dropdown!.appendChild(frag);
    setExpanded(true);
    highlight(0);
  };

  const onInput = () => {
    const q = input.value;
    items = filterBanks(q);
    render(items);
  };

  const onKeyDown = (e: KeyboardEvent) => {
    if (dropdown!.classList.contains('hidden')) return;

    const max = items.length - 1;
    switch (e.key) {
      case 'ArrowDown':
        e.preventDefault();
        highlight(Math.min(highlightedIndex + 1, max));
        break;
      case 'ArrowUp':
        e.preventDefault();
        highlight(Math.max(highlightedIndex - 1, 0));
        break;
      case 'Enter':
        if (highlightedIndex >= 0 && items[highlightedIndex]) {
          e.preventDefault();
          selectBank(items[highlightedIndex]);
        }
        break;
      case 'Escape':
        e.preventDefault();
        clearDropdown();
        setExpanded(false);
        break;
    }
  };

    const onFocus = () => {
    const q = input.value;
    items = filterBanks(q);
    // Если поле пустое — покажем весь список
    if (!q.trim()) {
        items = bankList.slice(0, maxItems); // можно сортировать по ru/en при желании
    }
    render(items);
    };

  const onClickOutside = (e: MouseEvent) => {
    if (!container!.contains(e.target as Node)) {
      clearDropdown();
      setExpanded(false);
    }
  };

  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.addEventListener('focus', onFocus);
  document.addEventListener('click', onClickOutside);
}

document.addEventListener('DOMContentLoaded', () => {
  initBankAutocomplete();
});
