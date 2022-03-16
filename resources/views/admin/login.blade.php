@extends('admin.layouts.header')
@section('contents')
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Sign In Now</h2>
		<form action="/admin/login" method="post">
			@csrf
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
			@if (Session::has('error'))
				<p style="color: #F53718; !important">{{ Session::get('error') }}</p>
			@endif
			<input id="rememberme" name="remember" type="checkbox" value="true"/><label for="rememberme">Remember Me</label>
			<h6><a href="#">Forgot Password?</a></h6>
			<div class="clearfix"></div>
			<input type="submit" value="Sign In" name="login">
		</form>
		
		<p>Don't Have an Account ?<a href="/admin/register">Create an account</a></p>
</div>
</div>
</body>
@endsection