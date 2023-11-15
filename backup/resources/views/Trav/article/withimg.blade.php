@foreach ($prods as $key => $item)



<div class="col-md-2 " >
    <button class="artLInk click_btn {{fmod($key,2) == 0 ? 'btn-primary' : 'btn-success'}}" style="width: 100%;min-height: 4rem;display: flex; align-items: center;justify-content: center;flex-direction: column; margin-bottom: .5rem"
    data-id="{{$item->id}}" data-prix="{{$item->prix_vente}}"
    data-art="{{$item->lebelle}}"
    data-unite="{{$item->unite}}"
    data-code="{{$item->code_bar}}"
    data-qte="{{$item->qte}}"
    data-remise-max="{{$item->remise_max}}"
    data-type="{{$item->type}}"
    style="color: black;padding-bottom: 3px !important;cursor: pointer;">
<!-- <img  width="120" height="120" src="{{url('images/pro/'.$item->img)}}" > -->

    <b>{{$item->lebelle}}</b>
    <!-- <br><b>Quantité stock : </b>  {{$item->qte}} / {{$item->unite}} -->
    <div><b>Prix : </b> {{$item->prix_vente}}</div>


</button>
</div>

@endforeach
