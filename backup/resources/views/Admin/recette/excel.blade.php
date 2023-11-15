<meta charset="UTF-8">

@php($recttotal = 0)
@php($test = 0)
{{-- @foreach ($cloturages as $Cloturage)
    
@php($recttotal += $Cloturage->montant) --}}

{{-- <table class="fl-table" border="1">
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
	
</table> --}}

  

        <table class="fl-table" border="1">
            <thead>
                <tr style="background: #049B1D;text-align: center;" >
                    <th colspan="2" style="text-align: center;font-size:20px"> Date  </th>
                    <th colspan="2" style="text-align: center;font-size:20px">N° Ticket  </th>
                    <th colspan="2" style="text-align: center;font-size:20px"> Article</th>
                    <th style="text-align: center;font-size:20px"> Qte</th>
                    <th style="text-align: center;font-size:20px"> P.U</th>
                    <th style="text-align: center;font-size:20px">Mode d'encaissement</th>
                    <th colspan="3"> Remise</th>
                    <th colspan="3"> Montant</th>
                </tr>
            </thead>
            <tbody class="list" id="search">
                @foreach ($cloturages as $Cloturage)
                {{--  --}}
                @php($recttotal += $Cloturage->montant)
                @foreach ($Cloturage->operations as $operation)
                    @foreach ($operation->DetailOperations as $detail)
                    {{--  --}}
                    @php($test +=  (!empty($operation->remise) && $operation->remise >0)?($detail->prix) - (($detail->prix)*$operation->remise/100): $detail->prix)
                    <tr>
                        <td colspan="2">{{$operation->created_at}}</td>
                        <td colspan="2"> {{$operation->numtick}} </td>
                        @php($arti = $detail->article)
                        @php ( $lebelle = $arti ? $arti->lebelle : '')
                        <td colspan="2"> {{$lebelle}}  </td>
                        <td> {{$detail->qte_prod}}  </td>
                        <td> {{$detail->prix}}  </td>
                        <td style="text-align: center;"> {{$Cloturage->modeCaisse}}  </td>
                        <td colspan="3" style="text-align: right;">  {{ (!empty($operation->remise) && $operation->remise >0)?($operation->remise/100) :"Non Remise" }}  </td>
                        <td colspan="3" style="text-align: right;">  {{ (!empty($operation->remise) && $operation->remise >0)?($detail->prix) - (($detail->prix)*$operation->remise/100) .' DH': $detail->prix.' DH' }}  </td>
                    </tr>
                    @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
	
        {{-- <table class="fl-table" border="1">
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
        </table> --}}


        {{-- <table class="fl-table" border="1">
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
        </table> --}}

	
{{-- @endforeach --}}

{{-- <table class="fl-table" border="1">
    <thead>
        <tr>
            <th style="font-size: 30px;" colspan="3"> Total  Recette: </th>
            <td style="text-align: right;"> {{$recttotal}} DH </td>
            <td style="text-align: right;">test : {{$test}} DH </td>
        </tr>
    </thead>
</table> --}}
