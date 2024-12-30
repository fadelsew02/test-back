@extends('auth.template')
@section('title')
    Connexion
@endsection

@section('picture')
    {{-- <img src="{{asset("assets/img/login.jpg")}}" alt=""> --}}
@endsection

@section('content')
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Bienvenue!</h1>
        </div>
        <form class="user" method="POST" action="{{ route('login') }}">
            @csrf
        
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        
            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" 
                    aria-describedby="emailHelp" placeholder="Enter Email Address..." value="{{ old('email') }}" required>
            </div>
        
            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword"
                    placeholder="Password" required>
            </div>
        
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Se connecter
            </button>
            <hr>
        </form>
        
        <hr>

        <div class="text-center">
            <a class="small" href=" {{route('register')}} ">Créer un compte!</a>
        </div>
    </div>
@endsection
