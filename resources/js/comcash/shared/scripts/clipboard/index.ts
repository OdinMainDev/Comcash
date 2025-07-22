class ClipboardCopier {
    private elements: NodeListOf<HTMLElement>;

    constructor(selector: string = '.copy-to-clipboard') {
        this.elements = document.querySelectorAll<HTMLElement>(selector);
        this.attachListeners();
    }

    private attachListeners(): void {
        this.elements.forEach((el) => {
            el.addEventListener('click', () => this.copy(el));
        });
    }

    private copy(el: HTMLElement): void {
        const text = el.dataset.copyText || el.textContent?.trim() || '';

        if (!text) return;

        navigator.clipboard.writeText(text).then(() => {
            this.showTooltip(el);
        }).catch((err) => {
            console.error('Failed to copy text: ', err);
        });
    }

    private showTooltip(el: HTMLElement): void {
        const tooltip = el.querySelector<HTMLElement>('.tooltip');
        if (tooltip) {
            tooltip.hidden = false; 

            setTimeout(() => {
                tooltip.hidden = true; 
            }, 1500);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ClipboardCopier();
});
