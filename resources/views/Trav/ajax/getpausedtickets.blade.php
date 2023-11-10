<div class="list-group" id="list-tab" role="tablist">
						
						@foreach ($optsCoutn as $item)
						<a class="cursorpointer list-group-item list-group-item-action pausedtickbtn" data-dismiss="modal" 
						 role="tab" 
						  data-idopt="{{$item->id}}">
						  {{$item->numtick}} - {{$item->created_at}} {{$item->nom ? '- Table : '.$item->nom : ' '}}
						
					        </a>
							
					
						@endforeach
					</div>