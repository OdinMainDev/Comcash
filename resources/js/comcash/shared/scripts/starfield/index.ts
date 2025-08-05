import $ from 'jquery';
import './starfield.scss';


$(function () {
  const $container = $('#stars');
  const STAR_COUNT = 200;
  const MIN_DIST = 50;
  const STAR_SIZE = 2;

  interface Point {
    x: number;
    y: number;
  }

  let placed: Point[] = [];

  function pageSize() {
    return {
      w: Math.max($(document).width() || 0, $(window).width() || 0),
      h: Math.max($(document).height() || 0, $(window).height() || 0),
    };
  }
  
  
  
  function farEnough(x: number, y: number): boolean {
    return placed.every(p => {
      const dx = x - p.x;
      const dy = y - p.y;
      return dx * dx + dy * dy >= MIN_DIST * MIN_DIST;
    });
  }

  function drawStars(): void {
    const { w, h } = pageSize();
    $container.css({ width: w, height: h }).empty();
    placed = [];

    let attempts = 0;
    while (placed.length < STAR_COUNT && attempts < STAR_COUNT * 10) {
      const x = Math.random() * (w - STAR_SIZE);
      const y = Math.random() * (h - STAR_SIZE);
      if (farEnough(x, y)) {
        placed.push({ x, y });
        $('<div class="star"></div>').css({ left: x, top: y }).appendTo($container);
      }
      attempts++;
    }
  }


  drawStars();

  $(window).on('load', drawStars);

  // Handle resize with debounce
  let resizeTimeout: ReturnType<typeof setTimeout> | null = null;

  $(window).on('resize', () => {
    if (resizeTimeout !== null) {
      clearTimeout(resizeTimeout);
    }
    resizeTimeout = setTimeout(() => {
      drawStars();
    }, 100); // 100ms debounce for smoother UX
  });
});
