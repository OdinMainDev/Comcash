import $ from 'jquery';
import './starfield.scss';

$(function () {
  const $container = $('#stars');
  const container = $container.get(0);

  if (!container) {
    console.error("Element with ID 'stars' not found.");
    return;
  }

  const STAR_COUNT = 200;
  const MIN_DIST = 50;
  const STAR_SIZE = 1;

  interface Point {
    x: number;
    y: number;
  }

  let placed: Point[] = [];

  const pageSize = () => ({
    w: Math.max(document.documentElement.clientWidth, document.body.clientWidth),
    h: Math.max(document.documentElement.clientHeight, document.body.clientHeight),
  });

  const farEnough = (x: number, y: number): boolean =>
    placed.every((p) => {
      const dx = x - p.x;
      const dy = y - p.y;
      return dx * dx + dy * dy >= MIN_DIST * MIN_DIST;
    });

  function drawStars(): void {
    const { w, h } = pageSize();

    container.style.width = `${w}px`;
    container.style.height = `${h}px`;
    container.innerHTML = '';

    placed = [];

    let attempts = 0;
    const maxAttempts = STAR_COUNT * 10;

    while (placed.length < STAR_COUNT && attempts < maxAttempts) {
      const x = Math.random() * (w - STAR_SIZE);
      const y = Math.random() * (h - STAR_SIZE);

      if (farEnough(x, y)) {
        placed.push({ x, y });

        $('<div class="star"></div>')
          .css({
            position: 'absolute',
            left: x,
            top: y,
            width: STAR_SIZE,
            height: STAR_SIZE,
          })
          .appendTo($container);
      }

      attempts++;
    }
  }

  drawStars();
  $(window).on('load', drawStars);

  let resizeTimeout: ReturnType<typeof setTimeout> | null = null;

  $(window).on('resize', () => {
    if (resizeTimeout !== null) {
      clearTimeout(resizeTimeout);
    }
    resizeTimeout = setTimeout(() => {
      drawStars();
    }, 50);
  });
});
