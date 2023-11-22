<style>
    @import url(https://fonts.googleapis.com/css?family=Arvo);

    .box * {
        font-family: Arvo;
    }

    .box {
        margin: 0px auto;
        color: #333;
        text-transform: uppercase;
        padding: 8px;
        font-weight: bold;
        text-shadow: 0px 1px 0px #fff;
        font-family: "arvo";
        font-size: 11px;
    }

    .inner h1 {
        padding: 5px 0px;
        margin: 0px;
        font-size: 18px;
        border-bottom: 1px solid rgba(51, 51, 51, 0.3);
        text-align: center;
    }

    #info_ticket .wp {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    #info_ticket_detail .wp,
    #info_ticket .wp {
        width: 24%;
        display: inline-block;
        box-sizing: border-box;
        text-align: center;
        padding: 10px;

    }

    #info_ticket_detail .wp {
        padding-top: 0px
    }

    .clearfix:after {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;

    }

    .total h2 {

        margin: 4px 0px;
        font-size: 15px;
    }

    .total p {
        float: right;
        margin: 0px;
        margin-right: 15px;
    }



    #operation_info_ticket .wp {
        font-size: 17px;
        font-weight: 600;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    #operation_info_ticket_detail .wp,
    #operation_info_ticket .wp {
        width: 49%;
        display: inline-block;
        box-sizing: border-box;
        text-align: center;
    }

    #operation_info_ticket_detail .wp {

        margin-bottom: 10px;
    }

    .operationbox {

        border: 3px #333;
        border-style: dashed;
        padding: 5px 15px;
        margin-bottom: 15px
    }

    .operationboxinfo .wp {
        width: 24%;
        display: inline-block;
        box-sizing: border-box;
        text-align: left>0;
    }

    .operationboxinfo .wp:first-child {
        width: 50%;
        display: inline-block;
        box-sizing: border-box;
        text-align: left>0;
    }

    .operationboxdetail .wp {
        width: 24%;
        display: inline-block;
        box-sizing: border-box;
        text-align: left;
        margin-bottom: 10px
    }

    .operationboxdetail .wp:first-child {
        width: 50%;
        display: inline-block;
        box-sizing: border-box;
        text-align: left;
        margin-bottom: 10px
    }
</style>

@php($clot=[])

<div class="box" id="hiddenbox">
    <div class='inner'>
        <h1 id="">{{Auth::user()->etab->nom}}</h1>

        <div id="info_ticket">
            <div class='wp'>Cloturage ID :</div>
            <div class='wp'>Date :</div>
            <div class='wp'>Num Operation :</div>
            <div class='wp'>montant :</div>

        </div>
        <div id="info_ticket_detail">
            <div class='wp'>{{$Cloturage->id}}</div>
            <div class='wp'>{{$Cloturage->created_at}}</div>
            <div class='wp'>{{$Cloturage->nombreOperation}}</div>
            <div class='wp'>{{ round((float)$Cloturage->montant - (float)$Cloturage->montant_offert,2) }} DH</div>
        </div>

        <div id="info_ticket">
            <div class='wp'>Espece :</div>
            <div class='wp'>Carte :</div>
            <div class='wp'>Sur Compte :</div>
            <div class='wp'>Offert :</div>

        </div>
        <div id="info_ticket_detail">
            <div class='wp'>{{ (float)$Cloturage->montant_espece}} DH</div>
            <div class='wp'>{{ (float)$Cloturage->montant_carte}} DH</div>
            <div class='wp'>{{ (float)$Cloturage->montant_compte}} DH</div>
            <div class='wp'>{{ (float)$Cloturage->montant_offert}} DH</div>
        </div>

        <hr>
        <div class="operation">
            <div id="operation_info_ticket">
            </div>
            <div id="operation_info_ticket_detail">
            </div>
        </div>
        <div class="operationbox">



            @php($total = 0)
            @php($reste = 0)
            @foreach ($Cloturage->operations()->get() as $operation)
            @foreach ($operation->DetailOperations()->get() as $detail)

            @php($total = $total + $operation->total_a_payer)
            @php($reste = $reste + ($operation->prix_payer - $operation->total_a_payer))

            @php(isset($clot["'".App\Model\Categorie::Find($detail->article()->first()->id_cat)->nom_cat."'"]["detail"]) ? $clot["'".App\Model\Categorie::Find($detail->article()->first()->id_cat)->nom_cat."'"]["detail"][count($clot["'".App\Model\Categorie::Find($detail->article()->first()->id_cat)->nom_cat."'"]["detail"]) + 1]=$detail : $clot["'".App\Model\Categorie::Find($detail->article()->first()->id_cat)->nom_cat."'"]["detail"][0]=$detail)

            @php(isset($clot["'".App\Model\Categorie::Find($detail->article()->first()->id_cat)->nom_cat."'"]["article"]) ? $clot["'".App\Model\Categorie::Find($detail->article()->first()->id_cat)->nom_cat."'"]["article"][count($clot["'".App\Model\Categorie::Find($detail->article()->first()->id_cat)->nom_cat."'"]["article"])+1]=$detail->article()->first() : $clot["'".App\Model\Categorie::Find($detail->article()->first()->id_cat)->nom_cat."'"]["article"][0]=$detail->article()->first() )



            @endforeach
            @endforeach


            @foreach($clot as $c)


            @php($cat=App\Model\Categorie::Find($c['article'][0]->id_cat)->nom_cat)
            <h2>{{$cat}}</h2>

            @php($tot_cat = 0)
            @foreach($c['article'] as $index=>$ar)

            @php($tot_cat = $tot_cat + (float)$c['detail'][$index]->prix )
            <div class='operationboxdetail clearfix'>
                @php ( $lebelle = $ar ? $ar->lebelle : '')
                <div class='wp'> {{$lebelle}}</div>
                <div class='wp'> {{$c['detail'][$index]->qte_prod}}</div>
                <div class='wp'> {{$c['detail'][$index]->prix}}</div>
            </div>
            @endforeach

            <br>
            <br>

            <div class="operationboxdetail" 
                 style="display: flex; align-items: flex-end; justify-content: end; width: 100%;">

                <div class="wp"> Total : &nbsp; {{$tot_cat}} DH</div>

            </div>


            @endforeach



            <hr>
            <div class='total clearfix' id="hidden_total_ticket">

                <h2>Total : <p> {{ (float)$Cloturage->montant - (float)$Cloturage->montant_offert }} DH</p>
                </h2>

            </div>


            @if($operation->prix_payer && $operation->prix_payer>0)
            <div class='total clearfix'>
                <h2>Reste : <p> {{ $reste }} DH</p>
                </h2>
            </div>
            @endif
        </div>

    </div>
</div>
