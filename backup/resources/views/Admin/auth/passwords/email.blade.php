@extends('auth.main')
@section('espaceimg',url('assets/images/pro/ad.png'))
@section('espace',"Récupération de mot de passe")

@section('content')

   
                    <form method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf
                        @if (session('status'))
                            <div class="alert alert-primary alert-styled-left login-form">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                            class="sr-only">Close</span></button>
                                <span class="text-semibold"> {{ session('status') }}</span>
                            </div>
                        @endif

                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i>
                                </div>
                                <h5 class="content-group">
                                    <small class="display-block">Nous vous enverrons des instructions par email</small>
                                </h5>
                            </div>

                            <div class="form-group has-feedback">
                                <input name="email" value="{{ old('email') }}" id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="Votre email">
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="help-block text-danger-300">- {{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Envoyer le lien de réinitialisation du mot de passe') }}
                                <i class="icon-arrow-right14 position-right"></i>
                            </button>

                        </div>
                    </form>
                

@endsection
