type ExpandableOptions = {
    collapsedHeight?: number;
    collapsedText?: string;
    expandedText?: string;
    rotateClass?: string;
  };
  
  export function initExpandables(options: ExpandableOptions = {}) {
    const {
      collapsedHeight = 70,
      collapsedText = 'Показать больше',
      expandedText = 'Скрыть',
      rotateClass = 'rotate-180',
    } = options;
  
    document.querySelectorAll<HTMLElement>('[data-expandable]').forEach((block) => {
      const wrapper = block.querySelector<HTMLElement>('[data-wrapper]');
      if (!wrapper)
        return;

      const inner = wrapper.querySelector<HTMLElement>('[data-expandable-inner]');
      const toggleBtn = block.querySelector<HTMLElement>('[data-expandable-toggle]');
      const arrow = block.querySelector<HTMLElement>('[data-expandable-arrow]');
  
      if (!inner || !toggleBtn) return;
  
      let expanded = false;
  
      toggleBtn.addEventListener('click', () => {
        expanded = !expanded;
  
        if (expanded) {
          const fullHeight = inner.scrollHeight;
          wrapper.style.maxHeight = `${fullHeight}px`;
          arrow?.classList.add(rotateClass);
          if (toggleBtn.firstChild) {
            toggleBtn.firstChild.textContent = expandedText;
          }
        } else {
          wrapper.style.maxHeight = `${collapsedHeight}px`;
          arrow?.classList.remove(rotateClass);
          if (toggleBtn.firstChild) {
            toggleBtn.firstChild.textContent = collapsedText;
          }
        }
      });
  
      // Стартовое состояние
      wrapper.style.maxHeight = `${collapsedHeight}px`;
    });
  }
  

document.addEventListener("DOMContentLoaded", () => {
    initExpandables({
        collapsedHeight: 70,
        collapsedText: "Показать больше",
        expandedText: "Показать больше",
        rotateClass: "rotate-180",
    });
});
