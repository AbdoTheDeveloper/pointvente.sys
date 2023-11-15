
@if(!empty($classes))
  @foreach($classes as $key => $value)
  	<option value="{{$key}}"> {{$value}}</option>
  @endforeach
@endif
