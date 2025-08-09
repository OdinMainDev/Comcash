import { UISelector } from "./types";

export class SelectorDropdown {
  constructor(private selector: UISelector) {}

  toggle() {
    const isOpen = this.selector.list.block.is(":visible");
    this.selector.list.block.toggle();
    this.setArrowState(isOpen);
    this.setBlockState(isOpen);
  }

  close() {
    this.selector.list.block.hide();
    this.setArrowState(true);
    this.setBlockState(true);
  }

  private setArrowState(isOpen: boolean) {
    this.selector.selectedArrow
      .removeClass("rotate-0 rotate-180 stroke-white stroke-[#06AB6B]")
      .addClass(!isOpen ? "rotate-180 stroke-[#06AB6B]" : "rotate-0 stroke-white");
  }

  private setBlockState(isOpen: boolean) {
    this.selector.selectedBlock
      .removeClass("bg-[#2A2A2A] bg-[#06AB6B]")
      .addClass(!isOpen ? "bg-[#06AB6B]" : "bg-[#2A2A2A]");
  }
  
}
