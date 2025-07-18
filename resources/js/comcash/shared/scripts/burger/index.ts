


const CLASSES = {
  hidden: "hidden",
  pointerNone: "pointer-events-none",
  opacity0: "opacity-0",
  opacity100: "opacity-100",
  scale95: "scale-95",
  scale100: "scale-100",
  toggleActive: ["border-[#06AB6B]", "bg-[#06AB6B0D]/5"],
  iconActive: ["rotate-180", "stroke-[#06AB6B]"],
};

class MenuManager {
  private menuContainer!: HTMLElement;
  private dropdownWrapper!: HTMLElement;
  private dropdownMenu!: HTMLElement;
  private dropdownToggle!: HTMLElement;
  private dropdownIcon!: SVGElement;
  private burgerButton!: HTMLElement;
  private burgerIcon!: HTMLElement;
  private closeIcon!: HTMLElement;
  private overlay!: HTMLElement;
  private overlayMenuItems!: HTMLElement;

  private menuItems: HTMLElement[] = [];
  private baseDropdownItems: HTMLElement[] = [];
  private hiddenItems: HTMLElement[] = [];
  private isOpen: boolean = false;
  private resizeTimeout: number | null = null;

  constructor() {
    document.addEventListener("DOMContentLoaded", () => {
      this.init();
    });
  }

  private init() {
    this.initializeElements();
    this.setupEvents();
    this.cacheWidths();
    this.updateMenu();
  }

  private initializeElements() {
    this.menuContainer = this.queryById("menu-items");
    this.dropdownWrapper = this.queryById("dropdown-wrapper");
    this.dropdownMenu = this.queryById("dropdown-menu");
    this.dropdownToggle = this.querySelector(".dropdown-toggleb", this.dropdownWrapper);
    this.dropdownIcon = this.querySelector("svg", this.dropdownToggle);
    this.burgerButton = this.queryById("menuBtn");
    this.burgerIcon = this.queryById("burgerIcon");
    this.closeIcon = this.queryById("closeIcon");
    this.overlay = this.queryById("menuOverlay");
    this.overlayMenuItems = this.queryById("overlayMenuItems");

    this.menuItems = Array.from(this.menuContainer.children).filter(el => el !== this.dropdownWrapper) as HTMLElement[];
    this.baseDropdownItems = Array.from(this.dropdownMenu.children) as HTMLElement[];
  }

  private setupEvents() {
    this.dropdownToggle.addEventListener("click", () => this.toggleDropdown());
    this.burgerButton.addEventListener("click", () => this.toggleOverlay(!this.isOpen));

    window.addEventListener("resize", () => {
      if (this.resizeTimeout) clearTimeout(this.resizeTimeout);
      this.resizeTimeout = window.setTimeout(() => {
        this.updateMenu();
        this.handleResizeForOverlay();
      }, 10);
    });
  }

  private updateMenu() {
    this.restoreItems();

    const containerWidth = this.menuContainer.offsetWidth;
    const dropdownWidth = this.dropdownWrapper.offsetWidth;
    let used = dropdownWidth;

    this.hiddenItems = [];
    this.menuItems.forEach(item => {
      used += item.offsetWidth;
      if (used > containerWidth) this.hiddenItems.push(item);
    });

    this.hiddenItems.forEach(item => {
      if (!this.dropdownMenu.contains(item)) this.dropdownMenu.appendChild(item);
    });

    this.baseDropdownItems.forEach(base => {
      if (!this.dropdownMenu.contains(base)) this.dropdownMenu.appendChild(base);
    });
    
    if (this.hiddenItems.length > 0) {
      this.dropdownWrapper.classList.remove("hidden");
    } else {
      this.dropdownWrapper.classList.add("hidden");
    }

    this.closeDropdown();
  }

  private restoreItems() {
    this.hiddenItems.forEach(item => this.menuContainer.insertBefore(item, this.dropdownWrapper));
    this.hiddenItems = [];
  }

  private toggleDropdown() {
    const isHidden = this.dropdownMenu.classList.contains(CLASSES.hidden);

    this.dropdownMenu.classList.toggle(CLASSES.hidden, !isHidden);
    this.dropdownMenu.classList.toggle(CLASSES.pointerNone, !isHidden);
    this.dropdownMenu.classList.toggle(CLASSES.opacity0, !isHidden);
    this.dropdownMenu.classList.toggle(CLASSES.opacity100, isHidden);
    this.dropdownMenu.classList.toggle(CLASSES.scale95, !isHidden);
    this.dropdownMenu.classList.toggle(CLASSES.scale100, isHidden);

    CLASSES.toggleActive.forEach(cls => this.dropdownToggle.classList.toggle(cls, isHidden));
    CLASSES.iconActive.forEach(cls => this.dropdownIcon.classList.toggle(cls, isHidden));
  }

  private closeDropdown() {
    this.dropdownMenu.classList.add(CLASSES.hidden, CLASSES.pointerNone, CLASSES.opacity0, CLASSES.scale95);
    this.dropdownMenu.classList.remove(CLASSES.opacity100, CLASSES.scale100);
    CLASSES.toggleActive.forEach(cls => this.dropdownToggle.classList.remove(cls));
    CLASSES.iconActive.forEach(cls => this.dropdownIcon.classList.remove(cls));
  }

  private renderOverlayMenu() {
    this.overlayMenuItems.innerHTML = "";

    const visibleItems = Array.from(this.menuContainer.children).filter(el => el !== this.dropdownWrapper);
    visibleItems.forEach(item => {
      this.overlayMenuItems.appendChild(item.cloneNode(true));
    });

    Array.from(this.dropdownMenu.children).forEach(dropItem => {
      this.overlayMenuItems.appendChild(dropItem.cloneNode(true));
    });
  }

  private toggleOverlay(state: boolean) {
    this.isOpen = state;

    if (this.isOpen) {
      this.burgerButton.classList.remove("bg-gradient-to-br", "from-[#06AB6B]", "to-[#009C74]", "hover:from-[#05c183]", "hover:to-[#00b488]");
      this.burgerButton.classList.add("bg-white", "hover:bg-gray-100");
      document.body.classList.replace("overflow-y-auto", "overflow-y-hidden");
    } else {
      this.burgerButton.classList.add("bg-gradient-to-br", "from-[#06AB6B]", "to-[#009C74]", "hover:from-[#05c183]", "hover:to-[#00b488]");
      this.burgerButton.classList.remove("bg-white", "hover:bg-gray-100");
      document.body.classList.replace("overflow-y-hidden", "overflow-auto");
    }

    this.burgerIcon.classList.toggle("opacity-0", this.isOpen);
    this.burgerIcon.classList.toggle("scale-75", this.isOpen);
    this.burgerIcon.classList.toggle("opacity-100", !this.isOpen);
    this.burgerIcon.classList.toggle("scale-100", !this.isOpen);

    this.closeIcon.classList.toggle("opacity-0", !this.isOpen);
    this.closeIcon.classList.toggle("scale-75", !this.isOpen);
    this.closeIcon.classList.toggle("opacity-100", this.isOpen);
    this.closeIcon.classList.toggle("scale-100", this.isOpen);

    if (this.isOpen) {
      this.renderOverlayMenu();
      this.overlay.classList.remove("opacity-0", "pointer-events-none", "hidden");
      this.overlay.classList.add("opacity-100");
    } else {
      this.overlay.classList.remove("opacity-100");
      this.overlay.classList.add("opacity-0", "pointer-events-none");
    }
  }

  private handleResizeForOverlay() {
    if (window.innerWidth > 620 && this.isOpen) {
      this.toggleOverlay(false);
    }
  }

  private queryById<T extends HTMLElement = HTMLElement>(id: string): T {
    const el = document.getElementById(id);
    if (!el) throw new Error(`Element #${id} not found`);
    return el as T;
  }

  private querySelector<T extends HTMLElement = HTMLElement>(selector: string, parent: Element): T {
    const el = parent.querySelector(selector);
    if (!el) throw new Error(`Selector ${selector} not found in element`);
    return el as T;
  }

  private cacheWidths() {
    // Reserved for future optimization (memoize widths)
  }
}

new MenuManager();
