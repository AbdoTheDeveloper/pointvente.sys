@extends('auth.main')
@section('espaceimg',url('assets/images/pro/ad.png'))
@section('espace',"Espace Administrateur")
@section('content')
<form method="POST" action="{{ route('admin.ShowLogin') }}">
   @csrf
    <div class="form-group">
        <label class="form-label" for="email">Email:</label>
        <div class="input-group input-group-merge">
            <input id="email" type="email" required="" name="email" class="form-control form-control-prepended {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}"  value="{{ old('email') }}" required autofocus>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
                </div>
            </div>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Mot de passe:</label>
        <div class="input-group input-group-merge">
            <input id="password" type="password" required="" class="form-control form-control-prepended {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Mot de passe') }}"  name="password" required />
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="custom-control custom-checkbox">
        <input id="terms" class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="terms" class="custom-control-label text-black-70">
            {{ __('Enregistrer mon compte') }}
        </label>
    </div>
    <div class=" text-right">
                                    <a href="{{ route('admin.password.request') }}">
                                        Mot de passe oublié ?
                                    </a>
                                </div>
    <br>

      
    <div class="form-group ">
        <button type="submit" class="btn btn-primary btn-block">    {{ __('Connecter') }}</button>
    </div>

</form>
@endsection  