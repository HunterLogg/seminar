@extends('admin.layouts.header')
@section('contents')
<body>
    <div class="reg-w3">
    <div class="w3layouts-main">
        <h2>Register Now</h2>
            <form action="/admin/register" method="post">
                <input type="text" class="ggg" name="name" placeholder="FULL NAME" required="">
                <input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
                <input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
                <input type="password" class="ggg" name="password_confirmation" placeholder="RE-PASSWORD" required="">
                @if (Session::has('error'))
				    <p style="color: #F53718; !important">{{ Session::get('error') }}</p>
			    @endif
                <div class="clearfix"></div>
                <input type="submit" value="submit" name="register">
                @csrf
            </form>
            <p>Already Registered.<a href="/admin/login">Login</a></p>
    </div>
    </div>
</body>
@endsection