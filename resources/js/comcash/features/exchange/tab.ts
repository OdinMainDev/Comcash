import $ from 'jquery';
export class TabController {
    constructor(
      private tabsContainer: JQuery<HTMLElement>,
      private onTabSelect: (tab: string) => void
    ) {}
  
    render(tags: string[]) {
      this.tabsContainer.empty();
      const allTab = this.createTab("all", true);
      this.tabsContainer.append(allTab);
  
      tags.forEach((tag) => {
        const tab = this.createTab(tag);
        this.tabsContainer.append(tab);
      });
    }
  
    private createTab(tag: string, active = false): JQuery<HTMLElement> {
      const $tab = $(`
        <button class="tab-button text-sm font-medium px-3 py-1 rounded ${active ? "active-tab bg-[#06AB6B]" : "hover:bg-white hover:text-black"}"
          data-tabname="${tag}">
          ${tag}
        </button>
      `);
      $tab.on("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.onTabSelect(tag);
        this.setActiveTab(tag);
      });
      return $tab;
    }
  
    private setActiveTab(tag: string) {
      this.tabsContainer.find("[data-tabname]")
        .removeClass("active-tab bg-[#06AB6B]")
        .addClass("hover:bg-white hover:text-black");
  
      this.tabsContainer.find(`[data-tabname="${tag}"]`)
        .addClass("active-tab bg-[#06AB6B]")
        .removeClass("hover:bg-white hover:text-black");
    }
  }
  