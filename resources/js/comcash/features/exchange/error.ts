export class ErrorDisplay {
    constructor(private container: JQuery<HTMLElement> | null) {}
  
    show(message: string) {
      if (!this.container) {
        console.warn("[ERROR]", message);
        return;
      }
      this.container.text(message).show();
      setTimeout(() => this.container?.hide(), 3000);
    }
  }
  