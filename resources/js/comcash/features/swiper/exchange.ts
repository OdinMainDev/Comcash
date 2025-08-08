function initSlider(): void {
    const wrapper = document.getElementById('slider-wrapper') as HTMLElement | null;
    const thumb = document.getElementById('slider-thumb') as HTMLElement | null;
    const overlay = document.getElementById('slider-overlay') as HTMLElement | null;
  
    if (!wrapper || !thumb || !overlay) return;
  
    let maxOffset = wrapper.offsetWidth - thumb.offsetWidth;
    let isDragging = false;
    let startX = 0;
    let currentX = 0;
    let completed = false;
  
    const getClientX = (e: MouseEvent | TouchEvent): number =>
      'touches' in e ? e.touches[0].clientX : e.clientX;
  
    const startDrag = (e: MouseEvent | TouchEvent): void => {
      if (completed) return;
      isDragging = true;
      startX = getClientX(e);
      thumb.style.transition = 'none';
      overlay.style.transition = 'none';
    };
  
    const moveDrag = (e: MouseEvent | TouchEvent): void => {
      if (!isDragging || completed) return;
  
      if ('cancelable' in e && e.cancelable) e.preventDefault();
  
      maxOffset = wrapper.offsetWidth - thumb.offsetWidth;
      currentX = Math.max(0, Math.min(getClientX(e) - startX, maxOffset));
  
      thumb.style.transform = `translateX(${currentX}px)`;
  
      const wipe = currentX + thumb.offsetWidth / 2;
      overlay.style.clipPath = `inset(0 0 0 ${wipe}px)`;
    };
  
    const endDrag = (): void => {
      if (!isDragging || completed) return;
      isDragging = false;
  
      maxOffset = wrapper.offsetWidth - thumb.offsetWidth;
      const passed = currentX >= maxOffset * 0.95;
  
      thumb.style.transition = 'transform 0.3s ease';
      overlay.style.transition = 'clip-path 0.3s ease';
  
      if (passed) {
        completed = true;
        thumb.style.transform = `translateX(${maxOffset}px)`;
        overlay.style.clipPath = `inset(0 0 0 100%)`;
  
        const form = document.querySelector<HTMLFormElement>('.exchange__form');
        if (form) {
          setTimeout(() => form.requestSubmit(), 400);
        }
      } else {
        thumb.style.transform = 'translateX(0)';
        overlay.style.clipPath = 'inset(0 0 0 0)';
      }
    };
  
    // Desktop events
    thumb.addEventListener('mousedown', startDrag);
    document.addEventListener('mousemove', moveDrag);
    document.addEventListener('mouseup', endDrag);
  
    // Mobile events
    thumb.addEventListener('touchstart', startDrag, { passive: true });
    document.addEventListener('touchmove', moveDrag, { passive: false });
    document.addEventListener('touchend', endDrag);
  }
  
  document.addEventListener('DOMContentLoaded', () => {
    initSlider();
  });
  