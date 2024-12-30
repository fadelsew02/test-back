@extends('auth.template')
@section('title')
    Inscription
@endsection

@section('picture')
    {{-- <img src="{{asset("assets/img/register.jpg")}}" alt="" > --}}
@endsection

@section('content')
<div class="p-5">
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Inscription!</h1>
    </div>
    <form class="user" method="POST" action="{{ route('register') }}">
        @csrf
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="first_name" class="form-control form-control-user" id="exampleFirstName"
                    placeholder="First Name" value="{{ old('first_name') }}" required>
            </div>
            <div class="col-sm-6">
                <input type="text" name="last_name" class="form-control form-control-user" id="exampleLastName"
                    placeholder="Last Name" value="{{ old('last_name') }}" required>
            </div>
        </div>
    
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                placeholder="Email Address" value="{{ old('email') }}" required>
        </div>
    
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword"
                    placeholder="Password" required>
            </div>
            <div class="col-sm-6">
                <input type="password" name="password_confirmation" class="form-control form-control-user"
                    id="exampleConfirmPassword" placeholder="Confirm Password" required>
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary btn-user btn-block">
            S'inscrire
        </button>
    </form>
    
    <hr>

    <div class="text-center">
        <a class="small" href=" {{route('login')}} ">Déjà un compte? Se connecter!</a>
    </div>
</div>
@endsection