

@php($recttotal = 0)
@foreach ($cloturages as $Cloturage)
    
@php($recttotal += $Cloturage->montant)

<table class="fl-table" border="1">
    <thead>
        <tr style="background: #FF9800;text-align: center;" >
         
		<th style="text-align: center;font-size:20px">Cloturage ID : </th>
		<th>Date :  </th>
        <th style="text-align: center;font-size:20px">Num Operation :</th>
       
        <th style="text-align: center;font-size:20px">montant : </th>
        </tr>
    </thead>  
	<tbody class="list" id="search">
        <tr>
		<td> {{$Cloturage->id}} </td> 
		<td> {{$Cloturage->created_at}} </td> 
        <td> {{$Cloturage->nombreOperation}} </td> 
        <td> {{ (float)$Cloturage->montant}} DH  </td>
        </tr>

        <tr>
        </tr>
        <tr>
        </tr>
    </tbody>
	
</table>

  
@foreach ($Cloturage->operations as $operation)
        <table class="fl-table" border="1">
            <thead>
                <tr style="background: #049B1D;text-align: center;" >
            
                <th colspan="2" style="text-align: center;font-size:20px"> Ticket : </th>
                <th colspan="2" style="text-align: center;font-size:20px"> Date : </th>
            
                </tr>
            </thead>

            <tbody class="list" id="search">
                <tr>
                <td colspan="2"> {{$operation->numtick}} </td>
                <td colspan="2">{{$operation->created_at}}</td>
                </tr>
                <tr></tr>
            </tbody>
        </table>
	
        <table class="fl-table" border="1">
            <thead>
                <tr style="background: #046B9B;text-align: center;" >
            
                    <th colspan="2" style="text-align: center;font-size:20px"> Article</th>
                    <th style="text-align: center;font-size:20px"> Qte</th>
                    <th style="text-align: center;font-size:20px"> Prix</th>
                    
              </tr>
            </thead>
            <tbody class="list" id="search">
                
                @foreach ($operation->DetailOperations as $detail)
                
                <tr>
                    
                    @php($arti = $detail->article)
                    @php ( $lebelle = $arti ? $arti->lebelle : '')
                    <td colspan="2"> {{$lebelle}}  </td>
                    <td> {{$detail->qte_prod}}  </td>
                    <td> {{$detail->prix}}  </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <table class="fl-table" border="1">
            <thead>
                <tr>
                    <th colspan="3"> Total : </th>
                    <td style="text-align: right;"> {{$operation->total_a_payer}} DH </td>
                </tr>

                @if($operation->remise>0)
                <tr>
                    <th colspan="3"> Remise :  {{$operation->remise}} %</th>
                    <td style="text-align: right;">  {{$operation->total_a_payer - ($operation->total_a_payer*$operation->remise/100) }} DH </td>
                </tr>
                @endif

                @if($operation->prix_payer && $operation->prix_payer>0)
                <tr>
                    <th colspan="3"> Reste : </th>
                    <td style="text-align: right;"> {{ $operation->prix_payer - $operation->total_a_payer }} DH</td>
                </tr>
                @endif
                <tr>
                    <td colspan="4">
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                    </td>
                </tr>
            </thead>
        </table>
    @endforeach
	
@endforeach

<table class="fl-table" border="1">
    <thead>
        <tr>
            <th style="font-size: 30px;" colspan="3"> Total  Recette: </th>
            <td style="text-align: right;"> {{$recttotal}} DH </td>
        </tr>
    </thead>
</table>
