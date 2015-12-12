<div class="container-fluid">
	<div class="row">
		<div class="flash-container">
			@if (count($errors) > 0)
				<div class="flash-alert">
					Invalid login or password.
				</div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-7">
			logos here
		</div>
		<div class="col-md-5 ">
			<div class="login-box">
				<h3>Sign In</h3>
				<div class="login-box-content">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						{!! csrf_field() !!}

						<input type="username" id="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
						<input type="password" id="password" class="form-control" name="password" placeholder="Password">

						<div class="remember-me">
							<label>
								<input type="checkbox" name="remember"> Remember Me
							</label>
						</div>
						<div class="form-submit">
							<button type="submit" class="btn btn-primary">Login</button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

