import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import type { SwiperOptions } from 'swiper/types';

import 'swiper/css';
import 'swiper/css/navigation';

Swiper.use([Navigation]);

function initReviewSwiper(): void {
  const swiperContainer = document.querySelector<HTMLElement>('.review-swiper');
  const prevBtn = document.getElementById('custom-prev') as HTMLElement | null;
  const nextBtn = document.getElementById('custom-next') as HTMLElement | null;

  if (!swiperContainer || !prevBtn || !nextBtn || typeof Swiper === 'undefined') {
    return;
  }

  let currentSlidesPerView = window.innerWidth < 721 ? 1 : 2;
  let currentRows = window.innerWidth < 401 ? 8 : (window.innerWidth < 721 ? 6 : 5);

  const swiperConfig: SwiperOptions = {
    direction: 'horizontal',
    slidesPerView: currentSlidesPerView,
    spaceBetween: 24,
    grid: {
      rows: currentRows,
      fill: 'row',
    },
    navigation: {
      nextEl: nextBtn,
      prevEl: prevBtn,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        grid: {
          rows: 6,
          fill: 'row',
        },
      },
      401: {
        slidesPerView: 1,
        grid: {
          rows: 8,
          fill: 'row',
        },
      },
      721: {
        slidesPerView: 2,
        grid: {
          rows: 5,
          fill: 'row',
        },
      },
    },
    on: {
      init(swiper) {
        updateNavButtons(swiper, prevBtn, nextBtn);
      },
      slideChange(swiper) {
        updateNavButtons(swiper, prevBtn, nextBtn);
      },
      resize(swiper) {
        swiper.update();
        const width = window.innerWidth;
        let slides = width < 721 ? 1 : 2;
        let rows = width < 401 ? 8 : (width < 721 ? 6 : 5);

        if (swiper.params.slidesPerView !== slides) {
          swiper.params.slidesPerView = slides;
          (swiper.params.grid as any).rows = rows;
          swiper.update();
        }

        updateNavButtons(swiper, prevBtn, nextBtn);
      },
    },
  };

  new Swiper(swiperContainer, swiperConfig);
}

function updateNavButtons(swiper: Swiper, prevBtn: HTMLElement, nextBtn: HTMLElement): void {
  const isAtStart = swiper.isBeginning;
  const isAtEnd = swiper.isEnd;

  const activeClasses = ['bg-gradient-to-r', 'from-[#06AB6B]', 'to-[#009C74]'];
  const disabledClasses = ['bg-white/5', 'pointer-events-none'];

  [prevBtn, nextBtn].forEach(btn => {
    btn.classList.remove(...activeClasses, ...disabledClasses);
  });

  if (isAtStart) {
    prevBtn.classList.add(...disabledClasses);
  } else {
    prevBtn.classList.add(...activeClasses);
  }

  if (isAtEnd) {
    nextBtn.classList.add(...disabledClasses);
  } else {
    nextBtn.classList.add(...activeClasses);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  initReviewSwiper();
});
