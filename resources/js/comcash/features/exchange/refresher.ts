import { SelectedCurrency } from "./types";

export class RateRefresher {
  private timerId: ReturnType<typeof setInterval> | null = null;
  private tickTimerId: ReturnType<typeof setInterval> | null = null;
  private intervalMs: number;
  private secondsLeft: number = 0;

  private onUpdate: (send: SelectedCurrency, get: SelectedCurrency) => Promise<void>;
  private onTick?: (formattedTime: string) => void;

  constructor(
    intervalMs: number,
    onUpdate: (send: SelectedCurrency, get: SelectedCurrency) => Promise<void>,
    onTick?: (formattedTime: string) => void
  ) {
    this.intervalMs = intervalMs;
    this.onUpdate = onUpdate;
    this.onTick = onTick;
  }

  start(send: SelectedCurrency, get: SelectedCurrency) {
    this.stop();

    this.secondsLeft = Math.floor(this.intervalMs / 1000);
    this.emitTick();

    this.timerId = setInterval(() => {
      this.onUpdate(send, get).catch(err => {
        console.warn("Ошибка автообновления курса:", err);
      });
      this.secondsLeft = Math.floor(this.intervalMs / 1000); // сброс таймера
    }, this.intervalMs);

    this.tickTimerId = setInterval(() => {
      this.secondsLeft--;
      if (this.secondsLeft < 0) this.secondsLeft = 0;
      this.emitTick();
    }, 1000);
  }

  stop() {
    if (this.timerId) {
      clearInterval(this.timerId);
      this.timerId = null;
    }
    if (this.tickTimerId) {
      clearInterval(this.tickTimerId);
      this.tickTimerId = null;
    }
  }

  private emitTick() {
    if (this.onTick) {
      const formatted = this.formatTime(this.secondsLeft);
      this.onTick(formatted);
    }
  }

  private formatTime(seconds: number): string {
    const m = Math.floor(seconds / 60).toString().padStart(2, "0");
    const s = (seconds % 60).toString().padStart(2, "0");
    return `${m}:${s}`;
  }
}
