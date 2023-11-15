@extends('auth.main')
@section('espaceimg',url('assets/images/pro/pa.png'))
@section('espace',__("Reset Password"))
@section('content')


<form method="POST" action="{{ route('trav.password.request') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <label class="form-label" for="email">E-Mail Address</label>
        <div class="input-group input-group-merge">
            
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{old('email') }}"  placeholder="E-Mail Address" required autofocus>
            @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Mot de passe:</label>
        <div class="input-group input-group-merge">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Mot de passe:">
            @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Confirme mot de passe:</label>
        <div class="input-group input-group-merge">
            
            <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Confirme mot de passe:" required>
            @if ($errors->has('password_confirmation'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
            {{ __('Reset Password') }}
            </button>
        </div>
    </div>
</form>


@endsection