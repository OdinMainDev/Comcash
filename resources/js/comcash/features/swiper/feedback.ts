import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import type { SwiperOptions } from 'swiper/types';

import 'swiper/css';
import 'swiper/css/navigation';

Swiper.use([Navigation]);

function InitSwiper(): void {
  const swiperContainer = document.querySelector<HTMLElement>('.feedbackSwiper');
  const prevBtn = document.getElementById('custom-prev') as HTMLElement | null;
  const nextBtn = document.getElementById('custom-next') as HTMLElement | null;

  if (!swiperContainer || !prevBtn || !nextBtn || typeof Swiper === 'undefined') {
    return;
  }

  let currentDirection: 'vertical' | 'horizontal' = window.innerWidth <= 670 ? 'vertical' : 'horizontal';

  const swiperConfig: SwiperOptions = {
    direction: currentDirection,
    slidesPerView: 'auto',
    slidesPerGroup: 1,
    spaceBetween: 30,
    navigation: {
      nextEl: nextBtn,
      prevEl: prevBtn,
    },
    breakpoints: {
      0: {
        direction: 'vertical',
        slidesPerView: 3,
        slidesPerGroup: 1,
        spaceBetween: 20,
      },
      671: {
        direction: 'horizontal',
        slidesPerView: 3,
        slidesPerGroup: 1,
        spaceBetween: 30,
      },
    },
    on: {
      init(swiper) {
        currentDirection = swiper.params.direction as 'vertical' | 'horizontal';
        updateNavButtons(swiper, prevBtn, nextBtn);
      },
      slideChange(swiper) {
        updateNavButtons(swiper, prevBtn, nextBtn);
      },
      resize(swiper) {
        const newDirection: 'vertical' | 'horizontal' = window.innerWidth <= 670 ? 'vertical' : 'horizontal';
        if (newDirection !== currentDirection) {
          currentDirection = newDirection;
          swiper.changeDirection(newDirection, false);
        }
        swiper.update();
        updateNavButtons(swiper, prevBtn, nextBtn);
      },
    },
  };

  new Swiper(swiperContainer, swiperConfig);
}

function updateNavButtons(swiper: Swiper, prevBtn: HTMLElement, nextBtn: HTMLElement): void {
  const isAtStart = swiper.isBeginning;
  const isAtEnd = swiper.isEnd;

  const activeClass = ['bg-gradient-to-r', 'from-[#06AB6B]', 'to-[#009C74]'];
  const disabledClass = ['bg-white/5', 'pointer-events-none'];

  [prevBtn, nextBtn].forEach((btn) => {
    btn.classList.remove(...activeClass, ...disabledClass);
  });

  if (isAtStart) {
    prevBtn.classList.add(...disabledClass);
  } else {
    prevBtn.classList.add(...activeClass);
  }

  if (isAtEnd) {
    nextBtn.classList.add(...disabledClass);
  } else {
    nextBtn.classList.add(...activeClass);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  InitSwiper();
});
