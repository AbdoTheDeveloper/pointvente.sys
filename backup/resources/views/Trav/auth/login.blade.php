@extends('auth.main')
@section('espaceimg',url('assets/images/pro/pa.png'))
@section('espace',"ESPACE Travailleurs")
@section('content')





<form method="POST" action="{{ route('trav.ShowLogin') }}">
   @csrf


    <div class="row d-none" style="align-items: center; justify-content: space-around; flex-wrap: wrap;">
        @foreach($travs as $trav)
        <div class="user-wrapper" style="text-align: center;">
             <div class="username" name="username" data-id="{{$trav->username}}" style=" background-image: url({{asset('/assets/images/pro/ad.png')}}); background-position:center;background-size:contain; height: 100px; width: 100px;border-radius: 50%; "></div>
            <h4>{{$trav->username}}</h4>
        </div>
        @endforeach


        <input id="username" name="username" type="text" class="d-none" >

    </div>


    <div class="form-group">
        <label class="form-label" for="password">Mot de passe:</label>
        <div class="input-group input-group-merge">
            <input id="password" autocomplete="off" autoselect type="password" required="" class="input form-control form-control-prepended {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Mot de passe') }}" name="password" required />
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
        <input id="terms"  class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="terms" class="custom-control-label text-black-70">
            {{ __('Enregistrer mon compte') }}
        </label>
    </div>
    <div class=" text-right">
                                    <a href="{{ route('trav.password.request') }}">
                                        Mot de passe oublié ?
                                    </a>
                                </div>
    <br>
    <div class="form-group ">
        <button type="submit" class="btn btn-primary btn-block">    {{ __('Connecter') }}</button>
    </div>

<div class="simple-keyboard hg-theme-default hg-layout-numeric numeric-theme keyboardDefContainer hg-layout-default" data-skinstance="simpleKeyboard"></div>


</form>
@endsection
@section("style")
<style>
/* .simple-keyboard{
    position:absolute;
    top:0;
    left:0
} */


.selected{
    border:5px solid #05e7dc;
}


</style>
<link rel="stylesheet" href="{{url('assets/plugins/simple-keyboard/simple-keyboard.css')}}">
@endsection
@section("script")









  <script src="{{url('assets/plugins/simple-keyboard/simple-keyboard.js')}}"></script>

<script>

$(".username").on('click',function(){
    localStorage.setItem('selectedUser',$(this).attr('data-id'));
    $("#username").val($(this).attr('data-id'));
    $(".username").removeClass('selected');
    $(this).addClass('selected');
})

window.onload = function () {

    if(localStorage.getItem('selectedUser')){
 item = $("[data-id="+localStorage.getItem('selectedUser')+"]")


    item.addClass('selected');


    $("#username").val(localStorage.getItem('selectedUser'));

    }

  var input = document.getElementById('password');
  input.focus();
  input.select();
}


    let Keyboard = window.SimpleKeyboard.default;
    let selectedInput;

let keyboard = new Keyboard({
  onChange: input => onChange(input),
  onKeyPress: button => onKeyPress(button)
});

/**
 * Update simple-keyboard when input is changed directly
 */

 document.querySelectorAll(".input").forEach(input => {
  input.addEventListener("focus", onInputFocus);
  // Optional: Use if you want to track input changes
  // made without simple-keyboard
  input.addEventListener("input", onInputChange);
});


function onInputChange(event) {
  keyboard.setInput(event.target.value, event.target.id);
}

function onInputFocus(event) {
  selectedInput = `#${event.target.id}`;

  keyboard.setOptions({
    inputName: event.target.id
  });
}

function onChange(input) {
  console.log("Input changed", input);
  document.querySelector(selectedInput || ".input").value = input;
}

function onKeyPress(button) {
  console.log("Button pressed", button);

  /**
   * If you want to handle the shift and caps lock buttons
   */
  if (button === "{shift}" || button === "{lock}") handleShift();
}

function handleShift() {
  let currentLayout = keyboard.options.layoutName;
  let shiftToggle = currentLayout === "default" ? "shift" : "default";

  keyboard.setOptions({
    layoutName: shiftToggle
  });
}
    </script>
@endsection
