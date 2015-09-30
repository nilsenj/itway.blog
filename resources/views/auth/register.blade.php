@include('includes.head')
<body>

@include('includes.navigation')
<div class="absolute-lang">


    <h6></h6>

    @include('includes.language-chooser')
</div>

<div class="container" style="margin-top: 60px;margin-bottom: 40px;">

    <div class="row">
        <div class="l-8 l-offset-2 m-8 m-offset-2 s-10 s-offset-1 xs-12  bg-white">
            <div class="title text-center text-primary">Register</div>
            @include('includes.errors')

					<form class="form" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="l-4 m-4 s-4 xs-4 text-center label">Name</label>
							<div class="l-6 m-6 s-7 xs-7">
								<input type="text" class="input" placeholder=" type your name" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="l-4 m-4 s-4 xs-4 text-center label">E-Mail Address</label>
							<div class="l-6 m-6 s-7 xs-7">
								<input type="email" class="input" placeholder=" type your e-mail" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="l-4 m-4 s-4 xs-4 text-center label">Password</label>
							<div class="l-6 m-6 s-7 xs-7">
								<input type="password" class="input"  placeholder=" type your password"  name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="l-4 m-4 s-4 xs-4 text-center label">Confirm Password</label>
							<div class="l-6 m-6 s-7 xs-7">
								<input type="password" class="input" placeholder=" type your confirm password" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="l-6 m-6 s-7 xs-7   m-offset-4">
								<button type="submit" class="button button-primary">
									Register
								</button>
							</div>
						</div>
					</form>
        <div class="line"></div>
        <div class="form-group l-12 text-center">
            <span class="text-center width100">или ввойдите через</span>

        </div>
			<div class="form-group text-center">

				<div class=" l-12 s-12 xs-12">
					<a id="facebook" href="{{url('/auth/login/facebook')}}" class="button button-primary">Facebook <span class="icon-facebook"></span>
					</a>
					<a id="google" href="{{url('/auth/login/google')}}" class="button button-danger">Google+ <span class="icon-google"></span>
					</a>
					<a id="github" href="{{url('/auth/login/github')}}" class="button button-default">github <span class="icon-github"></span>
					</a>
				</div>
			</div>
			</div>
		</div>
    </div>
@include('includes.footer')



