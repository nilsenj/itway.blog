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
            <div class="title text-center text-primary">Reset password</div>
            @include('includes.errors')
					<form class="form" role="form" method="POST" action="{{ url('/password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label class="l-4 m-4 s-4 xs-4 text-center label">E-Mail Address</label>
							<div class=" l-6 m-6 s-7 xs-7">
								<input type="email" class="input" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="l-4 m-4 s-4 xs-4 text-center label">Password</label>
							<div class=" l-6 m-6 s-7 xs-7">
								<input type="password" class="input" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="l-4 m-4 s-4 xs-4 text-center label">Confirm Password</label>
							<div class=" l-6 m-6 s-7 xs-7">
								<input type="password" class="input" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="l-8 m-8 s-8 xs-8  m-offset-4 s-offset-4 xs-offset-4">
								<button type="submit" class=" button button-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@include('includes.footer')
