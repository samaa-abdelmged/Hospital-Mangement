@extends('Dashboard.layouts.master2')

@section('css')
    <style>
        .panel {
            display: none;
        }
    </style>

    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1"></label>
                                        <select class="form-control" id="sectionChooser">
                                            <option value="" selected disabled>
                                                {{ trans('dashboard/login_trans.Select_Enter') }}
                                            </option>

                                            <option value="patient" style="color: rgb(36, 90, 238); font-weight: bold;">
                                                {{ trans('dashboard/login_trans.user') }}
                                            </option>
                                            <option value="admin" style="color: rgb(36, 90, 238); font-weight: bold;">
                                                {{ trans('dashboard/login_trans.admin') }}
                                            </option>
                                            <option value="doctor" style="color: rgb(36, 90, 238); font-weight: bold;">
                                                {{ trans('dashboard/login_trans.doctor') }}
                                            </option>
                                            <option value="employee" style="color: rgb(36, 90, 238); font-weight: bold;">
                                                {{ trans('dashboard/login_trans.employee') }}
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="panel" id="patient">
                                        <div class="card-sigin">
                                            <div class="main-signup-header">
                                                <div class="mb-5 d-flex"><img
                                                        src="{{ URL::asset('Dashboard/img/sky.png') }}"
                                                        class="sign-favicon ht-40" alt="logo"></a>
                                                    <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Soft<span>Ware</span> Sky
                                                    </h1>
                                                </div>
                                                <h3 type="text" style="color: rgb(36, 90, 238); font-weight: bold;">
                                                    {{ trans('dashboard/login_trans.user') }}
                                                </h3>
                                                <form method="POST" action="{{ route('login/patient') }}">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label> {{ trans('dashboard/login_trans.Email') }}
                                                        </label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email" autofocus>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label> {{ trans('dashboard/login_trans.password') }}
                                                        </label>

                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="form-group row">
                                                            <div class="col-md-6 offset-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="remember" id="remember"
                                                                        {{ old('remember') ? 'checked' : '' }}>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label class="form-check-label" for="remember">
                                                                        {{ trans('dashboard/login_trans.remember') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-main-primary btn-block">
                                                        {{ trans('dashboard/login_trans.login') }}
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ trans('dashboard/login_trans.forget_password') }}
                                                        </a>
                                                    @endif

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel" id="admin">
                                        <div class="card-sigin">
                                            <div class="main-signup-header">
                                                <div class="mb-5 d-flex"><img
                                                        src="{{ URL::asset('Dashboard/img/sky.png') }}"
                                                        class="sign-favicon ht-40" alt="logo"></a>
                                                    <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Soft<span>Ware</span> Sky
                                                    </h1>
                                                </div>
                                                <h3 type="text" style="color: rgb(36, 90, 238); font-weight: bold;">
                                                    {{ trans('dashboard/login_trans.admin') }}
                                                </h3>
                                                <form method="POST" action="{{ route('login/admin') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label> {{ trans('dashboard/login_trans.Email') }}</label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email" autofocus>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label> {{ trans('dashboard/login_trans.password') }}</label>

                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="form-group row">
                                                            <div class="col-md-6 offset-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="remember" id="remember"
                                                                        {{ old('remember') ? 'checked' : '' }}>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label class="form-check-label" for="remember">
                                                                        {{ trans('dashboard/login_trans.remember') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-main-primary btn-block">
                                                        {{ trans('dashboard/login_trans.login') }}
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ trans('dashboard/login_trans.forget_password') }}
                                                        </a>
                                                    @endif

                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="panel" id="doctor">
                                        <div class="card-sigin">
                                            <div class="main-signup-header">
                                                <div class="mb-5 d-flex"><img
                                                        src="{{ URL::asset('Dashboard/img/sky.png') }}"
                                                        class="sign-favicon ht-40" alt="logo"></a>
                                                    <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Soft<span>Ware</span>
                                                        Sky
                                                    </h1>
                                                </div>
                                                <h3 type="text" style="color: rgb(36, 90, 238); font-weight: bold;">
                                                    {{ trans('dashboard/login_trans.doctor') }}
                                                </h3>
                                                <form method="POST" action="{{ route('login/doctor') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label> {{ trans('dashboard/login_trans.Email') }}</label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email" autofocus>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label> {{ trans('dashboard/login_trans.password') }}</label>

                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="form-group row">
                                                            <div class="col-md-6 offset-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="remember" id="remember"
                                                                        {{ old('remember') ? 'checked' : '' }}>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label class="form-check-label" for="remember">
                                                                        {{ trans('dashboard/login_trans.remember') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-main-primary btn-block">
                                                        {{ trans('dashboard/login_trans.login') }}
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ trans('dashboard/login_trans.forget_password') }}
                                                        </a>
                                                    @endif

                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="panel" id="employee">
                                        <div class="card-sigin">
                                            <div class="main-signup-header">
                                                <div class="mb-5 d-flex"><img
                                                        src="{{ URL::asset('Dashboard/img/sky.png') }}"
                                                        class="sign-favicon ht-40" alt="logo"></a>
                                                    <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Soft<span>Ware</span>
                                                        Sky
                                                    </h1>
                                                </div>
                                                <h3 type="text" style="color: rgb(36, 90, 238); font-weight: bold;">
                                                    {{ trans('dashboard/login_trans.employee') }}
                                                </h3>
                                                <form method="POST" action="{{ route('login/employee') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label> {{ trans('dashboard/login_trans.Email') }}</label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email" autofocus>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label> {{ trans('dashboard/login_trans.password') }}</label>

                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="form-group row">
                                                            <div class="col-md-6 offset-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="remember" id="remember"
                                                                        {{ old('remember') ? 'checked' : '' }}>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label class="form-check-label" for="remember">
                                                                        {{ trans('dashboard/login_trans.remember') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-main-primary btn-block">
                                                        {{ trans('dashboard/login_trans.login') }}
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ trans('dashboard/login_trans.forget_password') }}
                                                        </a>
                                                    @endif

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->

            <div
                class="col-md-6
                                                col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('Dashboard/img/media/welcome_back.jpeg') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#sectionChooser').change(function() {
            var myID = $(this).val();
            $('.panel').each(function() {
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
@endsection
