@extends('layouts.app')

@section('content')
    <div class="container mt-lg-5 py-5">

        <div class="container d-flex align-items-center justify-content-center flex-column smooth-scroll">
            <!-- Message if success -->
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success">
                    <strong>Success!</strong> {{ session('message') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- Message if Have errors -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> There was an error, please, <a href="#cards" class="alert-link">scroll down</a> to see more details.
                    <span class="error d-none"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="alert alert-danger fade d-none" role="alert" id="error">
                <strong>Whoops!</strong> <span class="error"></span>
            </div>

            <!--Profile Picture-->
            <div class="card testimonial-card z-depth-0 @if(session('isDark')) dark-mode @else light-mode @endif">
                <div class="mx-auto">
                    <div class="rounded-circle view overlay zoom overflow-hidden">
                        <a title="Change your photo" href="javascript:changeProfile()">
                            <img src="@if(Auth::user()->image === null || empty(Auth::user()->image)) {{ asset('img/noimage.png') }} @else {{ asset('storage/users/' . Auth::user()->image) }} @endif" alt="profile picture" class="rounded-circle mx-auto d-block profile-photo preview_image">

                            <!--Loader animation-->
                            <span id="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="position: absolute; left: 45%; top: 45%; display: none"></span>
                            <div class="mask flex-center text-white blue-gradient-rgba overflow-hidden">
                                <i class="fa fa-camera fa-2x"></i>
                            </div>
                        </a>
                    </div>
                    <input type="file" id="file" style="display: none"/>
                    <input type="hidden" id="file_name"/>
                </div>
            </div>
            <!-- Profile Picture -->

            <h2 class="h2-responsive">Welcome, {{ '@' . Auth::user()->nick }}</h2>
            <p>Manage your info, privacy and security to make us work better for you</p>
        </div>
        <div class="row">
            <!-- Card Dark -->
            <div class="col-md-4 mb-4" id="cards">
                <div class="card">

                    <!-- Card image -->
                    <div class="view overlay">
                        <img class="card-img-top"
                             src="{{ asset('img/1.jpg') }}"
                             alt="Card image cap">
                    </div>

                    <!-- Card content -->
                    <div class="card-body @if(session('isDark')) mdb-color darken-3 @else default-color-dark @endif white-text rounded-bottom">

                        <!-- Title -->
                        <h4 class="card-title h5-responsive"><i class="fas fa-user"></i> Personal</h4>
                        <hr class="hr-light">
                        <!-- Text -->
                        <p class="card-text white-text">Basic info, such as your name and surname on
                            <strong>Instavel</strong>.</p>
                        <!-- Form -->
                        <form method="POST" action="{{ route('user.personal') }}" class="text-center">
                            @csrf
                            <div class="form-row justify-content-center">
                                <div class="col-12 col-md-6">
                                    <!-- First name -->
                                    <div class="md-form w-100">
                                        <input id="name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} text-white"
                                               name="name" value="{{ Auth::user()->name }}" required>
                                        <label for="name" class="text-white">{{ __('Name') }}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- Surname -->
                                    <div class="md-form w-100">
                                        <input id="surname" type="text"
                                               class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }} text-white"
                                               name="surname" value="{{ Auth::user()->surname }}" required>
                                        <label for="surname" class="text-white">{{ __('Surname') }}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Errors -->
                            <div class="container-fluid">
                                @if ($errors->has('name'))
                                    <div class="alert alert-light" role="alert">
                                        <strong class="text-danger text-sm"><i
                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}
                                        </strong>
                                    </div>
                                @elseif($errors->has('surname'))
                                    <div class="alert alert-light" role="alert">
                                        <strong class="text-danger text-sm"><i
                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('surname') }}
                                        </strong>
                                    </div>
                                @endif
                            </div>
                            <!-- Save-->
                            <div class="d-flex justify-content-end align-self-end">
                                <button type="submit" class="btn-sm btn-rounded white border-0 hoverable">
                                    <i class="fas fa-check @if(session('isDark')) mdb-color-text darken-3 @else text-default accent-4 @endif"
                                       aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Card Dark -->

            <!-- Card Dark -->
            <div class="col-md-4 mb-4">
                <div class="card">

                    <!-- Card image -->
                    <div class="view overlay">
                        <img class="card-img-top"
                             src="{{ asset('img/2.jpg') }}"
                             alt="Card image cap">
                    </div>

                    <!-- Card content -->
                    <div class="card-body @if(session('isDark')) unique-color-dark @else indigo accent-4 @endif white-text rounded-bottom">

                        <!-- Title -->
                        <h4 class="card-title h5-responsive"><i class="fas fa-lock-open"></i> Login</h4>
                        <hr class="hr-light">
                        <!-- Text -->
                        <p class="card-text white-text">Account info, such as your nickname and email on
                            <strong>Instavel</strong>.</p>
                        <form method="POST" action="{{ route('user.login') }}" class="text-center">
                            @csrf
                            <div class="form-row justify-content-center">
                                <div class="col-12 col-md-6">
                                    <!-- Nick -->
                                    <div class="md-form">
                                        <input id="nick" type="text"
                                               class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }} text-white"
                                               name="nick"
                                               value="{{ Auth::user()->nick }}" required>
                                        <label for="nick" class="text-white">{{ __('Nick') }}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- E-mail -->
                                    <div class="md-form">
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} text-white"
                                               name="email"
                                               value="{{ Auth::user()->email }}" required>
                                        <label for="email" class="text-white">{{ __('E-Mail') }}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Errors -->
                            <div class="container-fluid">
                                @if ($errors->has('nick'))
                                    <div class="alert alert-light" role="alert">
                                        <strong class="text-danger text-sm"><i
                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('nick') }}
                                        </strong>
                                    </div>
                                @else
                                    @if($errors->has('email'))
                                    <div class="alert alert-light" role="alert">
                                        <strong class="text-danger text-sm"><i
                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}
                                        </strong>
                                    </div>
                                    @endif
                                @endif
                            </div>
                            <!-- Save-->
                            <div class="d-flex justify-content-end align-self-end">
                                <button type="submit" class="btn-sm btn-rounded white border-0 hoverable">
                                    <i class="fas fa-check @if(session('isDark')) text-dark @else text-indigo accent-4 @endif"
                                       aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <!-- Card Dark -->
            <div class="col-md-4 mb-4">
                <div class="card">

                    <!-- Card image -->
                    <div class="view overlay">
                        <img class="card-img-top"
                             src="{{ asset('img/3.jpg') }}"
                             alt="Card image cap">
                    </div>

                    <!-- Card content -->
                    <div class="card-body @if(session('isDark')) stylish-color-dark @else deep-purple darken-4 @endif white-text rounded-bottom">

                        <!-- Title -->
                        <h4 class="card-title h5-responsive"><i class="fas fa-key"></i> Security</h4>
                        <hr class="hr-light">
                        <!-- Text -->
                        <p class="card-text white-text">Change your password regularly to help us keep your account secure.</p>
                        <form method="POST" action="{{ route('user.password') }}" class="text-center">
                            @csrf
                            <div class="form-row justify-content-center">
                                <div class="col-12 col-md-6">
                                    <!-- Password -->
                                    <div class="md-form">
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} text-white"
                                               name="password" placeholder="******" required>
                                        <label for="password" class="text-white">{{ __('Password') }}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- Password Confirm -->
                                    <div class="md-form">
                                        <input id="password-confirm" type="password" class="form-control text-white"
                                               name="password_confirmation" placeholder="******" required>
                                        <label for="password-confirm"
                                               class="text-white">{{ __('Confirm Password') }}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Errors -->
                            <div class="container-fluid">
                                @if ($errors->has('password'))
                                    <div class="alert alert-light" role="alert">
                                        <strong class="text-danger text-sm"><i
                                                    class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}
                                        </strong>
                                    </div>
                                @endif
                            </div>
                            <!-- Save-->
                            <div class="d-flex justify-content-end align-self-end">
                                <button type="submit" class="btn-sm btn-rounded white border-0 hoverable">
                                    <i class="fas fa-check @if(session('isDark')) mdb-color-text @else deep-purple-ic darken-4 @endif"
                                       aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection