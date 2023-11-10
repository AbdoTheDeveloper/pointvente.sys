@foreach ($stocks as $stc)
<tr>
<td>{{$stc->nom}}</td>
<td>{{$stc->nom_frns}}</td>
<td>{{$stc->created_at}}</td>
<td>{{$stc->remarque}}</td>
<td>
    <a  href="{{ route('admin.delete_stock_ope',["id"=>$stc->id]) }}" onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément');" class="btn btn-danger btn-sm">
        <i class="material-icons">close</i>
    </a>

    <a  href="{{ route('admin.detail.stock.index',["id"=>$stc->id]) }}" class="btn btn-info btn-sm">
        <i class="material-icons">list</i>
    </a>
</td>

</tr>

@endforeach