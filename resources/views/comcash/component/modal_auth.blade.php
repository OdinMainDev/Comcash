<div id='auth-popup' class='auth mfp-hide' method=''>
	<div class='auth__container'>
		<button type='button' class='mfp-close'>&#215;</button>
		<img src='/comcash/img/logo.png' class='auth__logo' alt='Comcash' />
		<div class='templates'>
			<form id='signin' class='auth__content auth__signin active' action="{{route("loginPost")}}">
				<p class='auth__title'>{{__("front.sign in header")}}</p>
				<p class='auth__subtitle'>
					{{__("front.first time?")}} <a href='#'  onclick="window.setForm('signup')">{{__("front.sign up now!")}}</a>
				</p>
				<input type='text' class='input' name="email" placeholder='{{__("front.email_placeholder")}}'/>
                <div class='input-password'>
					<input type='password' name="password" class='input' placeholder='{{__("front.password_placeholder")}}' />
					<a class='input-password__eye'></a>
				</div>
				<a class='auth__forgot' href="#" onclick="window.setForm('forgot-password')">{{__("front.forgot password?")}}</a>
				<button type="submit" class='button button--dark button--auto auth__btn btn__submit'>{{__("front.continue")}}</button>
			</form>
			<form id='signup' class='auth__content auth__signup' action="{{route("registerPost")}}">
				<p class='auth__title'>
					{{__("front.sign up header")}}
				</p>
                <p class='auth__subtitle'>
					{{__("front.register by email")}}
				</p>
				<input type='text' class='input' name="email" placeholder='{{__("front.email_placeholder")}}' />
				<div class='input-password'>
					<input type='password' class='input' name="password" placeholder='{{__("front.password_placeholder")}}' />
					<a class='input-password__eye'></a>
				</div>
                <div class='input-password'>
					<input type='password' class='input' name="repassword" placeholder='{{__("front.repassword_placeholder")}}' />
					<a class='input-password__eye'></a>
				</div>
				<a class='auth__forgot' href="#" onclick="window.setForm('forgot-password')">Забыли пароль?</a>
				<button type="submit" class='button button--dark button--auto auth__btn btn__submit'>{{__("front.continue")}}</button>
				<p class='signup-text'>
					{{__("front.pressing button")}}
					<a href='#'>“{{__("front.continue")}}”</a>
					- {{__("front.you are agree")}}
					<a href='#'>“{{__("front.privacy policy")}}”</a>
				</p>

                <p class='signup-text'>
					{{__("front.already has account")}}
					<a  href="#" onclick="window.setForm('signin')">{{__("front.why not auth?")}}</a>
				</p>
			</form>
			<form id='forgot-password' class='auth__content'  action="{{route("resetPasswordPost")}}">
				<p class='auth__title'>
					{{__("front.forgot password?")}}
				</p>
				<input type='text' class='input' name="email" placeholder='{{__("front.email_placeholder")}}' />
				<button type="submit" class='button button--dark button--auto auth__btn btn__submit'>{{__("front.continue")}}</button>
			</form>
			<form id='recover-password' class='auth__content' action="{{route("resetPasswordConfirmPost")}}">
				<p class='auth__title'>
					{{__("front.recover your password")}}
				</p>
                <input type="hidden" name="hash" value="">
                <input type='text' class='input' name="code" placeholder='{{__("front.confirmcode_placeholder")}}' />
				<div class='input-password'>
					<input type='password' class='input' name="password" placeholder='{{__("front.password_placeholder")}}' />
					<a class='input-password__eye'></a>
				</div>
                <div class='input-password'>
					<input type='password' class='input' name="repassword" placeholder='{{__("front.repassword_placeholder")}}' />
					<a class='input-password__eye'></a>
				</div>
				<button type="submit" class='button button--dark button--auto auth__btn btn__submit'>{{__("front.continue")}}</button>
			</form>
			<div id='verification-sent' class='verification-sent auth__content'>
				<p class='auth__title'>
					{{__("front.check your email!")}}
				</p>
				<p class='auth__subtitle'>{{__("front.check your email text")}}</p>
				<a href="/" class='button button--auto auth__btn'>{{__("front.continue")}}</a>
			</div>
			<div id='email-recover'
				class='email-recover auth__content'>
				<p class='auth__title'>
					Вы успешно восстановили пароль!
				</p>
				<p class='auth__subtitle'>Теперь Вы можете зайти в профиль!</p>
				<button class='button button--auto auth__btn'>Продолжить</button>
			</div>
		</div>
	</div>
</div>