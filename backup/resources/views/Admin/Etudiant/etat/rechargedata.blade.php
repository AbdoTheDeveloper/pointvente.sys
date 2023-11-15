@foreach($detailsolds as $sold)

<tr>
   
    <td>

        <span class="js-lists-values-employee-name">{{ $sold->nom}} </span>

    </td>
    <td>

        <span class="js-lists-values-employee-name">{{ $sold->user_nom}} </span>

    </td>
    <td><small class="text-muted">{{ $sold->type == "R" ?'Restaurant' : "Buvette" }}</small></td>  
    <td>{{ @$sold->sold }}</td>         
    <td>

        <span class="js-lists-values-employee-name">{{ $sold->date }}</span>

    </td>

    <td>{{ @$sold->remrque }}</td>
    

</tr>

@endforeach