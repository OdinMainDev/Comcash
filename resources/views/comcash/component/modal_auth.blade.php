<div id='auth-popup' class='auth mfp-hide' method=''>
	<div class='auth__container'>
		<button type='button' class='mfp-close'>&#215;</button>
		<img src='/comcash/img/logo.svg' class='auth__logo' alt='Comcash' />
		<div class='templates'>
			@guest
				<form id='signin' class='auth__content auth__signin active' action="{{route("loginPost")}}">
					<p class='auth__title'>{{__("front.sign in header")}}</p>
					<p class='auth__subtitle'>
						{{__("front.first time?")}} 

						<a href='#'  onclick="window.setForm('signup')">
							{{__("front.sign up now!")}}
						</a>

					</p>
                    <div class="auth__input">
					    <input type='text' class='input' name="email" placeholder='{{__("front.email_placeholder")}}'/>
                    </div>
                    <div class="auth__input">
                        <div class='input-password'>
                            <input type='password' name="password" class='input' placeholder='{{__("front.password_placeholder")}}' />
                            <a class='input-password__eye'></a>
                        </div>
                    </div>
					<div class="auth__input">
                        <div class='input-password'>
                            <input type='password' name="otppassword" class='input' placeholder='{{__("front.2fa_otp_label_login")}}' />
                            <a class='input-password__eye'></a>
                        </div>
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
                    <div class="auth__input">
					    <input type='text' class='input' name="email" placeholder='{{__("front.email_placeholder")}}' />
                    </div>
                    <div class="auth__input">
                        <div class='input-password'>
                            <input type='password' class='input' name="password" placeholder='{{__("front.password_placeholder")}}' />
                            <a class='input-password__eye'></a>
                        </div>
                    </div>
                    <div class="auth__input">
                        <div class='input-password'>
                            <input type='password' class='input' name="repassword" placeholder='{{__("front.repassword_placeholder")}}' />
                            <a class='input-password__eye'></a>
                        </div>
                    </div>
					<a class='auth__forgot' href="#" onclick="window.setForm('forgot-password')">{{__("front.forgot password?")}}</a>
					<button type="submit" class='button button--dark button--auto auth__btn btn__submit'>{{__("front.continue")}}</button>
					<p class='signup-text'>
						{{__("front.pressing button")}}
						<a href='#'>“{{__("front.continue")}}”</a>
						- {{__("front.you are agree")}}
						<a href='{{route("comcashPage", ["rules"])}}'>“{{__("front.privacy policy")}}”</a>
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
					<button type="submit" class='button button--dark button--auto auth__btn btn__submit' style="margin-top: 50px">{{__("front.continue")}}</button>
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
					<a href="{{route("index")}}" class='button button--auto auth__btn'>{{__("front.continue")}}</a>
				</div>
				<div id='email-recover'
					class='email-recover auth__content'>
					<p class='auth__title'>
						{{__("front.successrestorepassword")}}
					</p>
					<p class='auth__subtitle'>{{__("front.nowyoucanaccessclientpanel")}}</p>
					<button class='button button--auto auth__btn'>{{__("front.continue")}}</button>
				</div>
			@endguest

			<form id='kyc-verification' class='auth__content'  action="{{route("exchgangeKyc")}}">
				<p class='auth__title'>
					{{__("front.verify-card title")}}
				</p>
				<input type="hidden" name="kyc_id" id="kyc_id" value="">
				<label class="input kyc__input">
                    <input type='file' name="file" placeholder="{{__("front.photoofcard")}}"/>
                    <div class="button button--dark">{{__("front.photoofcard")}}</div>
                </label>
                <label class="input kyc__input">
                    <input type='file' name="passport" placeholder="{{__("front.photoofpassport")}}"/>
                    <div class="button button--dark">{{__("front.photoofpassport")}}</div>
                </label>
				<button type="submit" class='button button--dark button--auto auth__btn btn__submit kyc__button'>{{__("front.continue")}}</button>
			</form>

			<div id="confirm-verification" class='auth__content class active'>
				<p class="auth__title confirm-verification__title">
					{{__("front.validatekyctitle")}}
				</p>
				<p class="auth__title confirm-verification__subtitle">
					{{__("front.validatekyctext2")}}
				</p>
				<div class="confirm-verification__loader">
				</div>
				<div class="confirm-verification__status">
					{{__("front.validatekycactiontext")}}
				</div>
			</div>
		</div>
	</div>
</div>
