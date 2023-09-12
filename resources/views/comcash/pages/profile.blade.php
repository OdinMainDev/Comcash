@extends('comcash.layout.main')

@section('content')
<div class="accounts">
    <div class="accounts__container">

      <p class="accounts__title-mobile">профиль</p>

      <div class="profile-menu">
        <div class='profile-menu__nav'>
          <a href='#'
             class="profile-menu__link profile-menu__link--active">Личный кабинет</a>
          <a href='#'
             class="profile-menu__link">Мои счета</a>
          <a href='#'
             class="profile-menu__link">История транзации</a>
          <a href='#'
             class="profile-menu__link">Безопасность</a>
          <a href='#'
             class="profile-menu__link">Выход</a>
        </div>
      </div>

      <div class="accounts__content">
        <form action="">
          <div class="input-box">
            <div class='label'>
              <span>добавить счет</span>
            </div>
            <input type="text"
                   class="input input--large">
          </div>
          <button class='button accounts__button'>добавить</button>
        </form>

        <div class="accounts__list">
          <p class="accounts__list-title">ваши счета</p>
          <!-- <p class="accounts__list-subtitle">нет счета</p> -->
          <div class='accounts__list-row'>
            <div class='accounts__list-item'>
              <img src='/img/sber-icon.svg'
                   alt='' />
              <p>Sberbank</p>
              <span>RUB</span>
            </div>
            <div class='accounts__list-item'>9999111133332222</div>
          </div>

          <div class='accounts__list-row'>
            <div class='accounts__list-item'>
              <img src='/img/sber-icon.svg'
                   alt='' />
              <p>Sberbank</p>
              <span>RUB</span>
            </div>
            <div class='accounts__list-item'>9999111133332222</div>

          </div>

        </div>
      </div>
    </div>
  </div>

  <footer class='footer'>
    <div class='footer__container'>
      <div class='footer__top'>
        <div class='footer__logo'>
          <img src='/img/logo.png' alt='' class='' />
          <p>Лучшая платформа на рынке</p>
        </div>
        <div class='footer__sitemap'>
  
          <div class='footer__sitemap-col'>
            <p class='footer__sitemap-title'>title</p>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
          </div>
          <div class='footer__sitemap-col'>
            <p class='footer__sitemap-title'>title</p>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
          </div>
          <div class='footer__sitemap-col'>
            <p class='footer__sitemap-title'>title</p>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
          </div>
          <div class='footer__sitemap-col'>
            <p class='footer__sitemap-title'>title</p>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
            <a href='#' class='footer__sitemap-link'>link</a>
          </div>
        </div>
      </div>
  
      <div class='footer__bottom'>
        <p class='footer__copyright'>© 2023 COMCASH. All Rights Reserved.</p>
        <div class='footer__socials'>
          <a href='' class='footer__socials-link'>
            <img src='/img/icons/socials/facebook.svg' alt='' />
          </a>
          <a href='' class='footer__socials-link'>
            <img src='/img/icons/socials/facebook.svg' alt='' />
          </a>
          <a href='' class='footer__socials-link'>
            <img src='/img/icons/socials/facebook.svg' alt='' />
          </a>
        </div>
      </div>
  
    </div>
  </footer>
@endsection


@section('js')
	@if(isset($auth_modal) && $auth_modal)
		<script>
			window.openAuthModal = true;
		</script>
	@endif
@endsection