@extends('Admin.main')
@section('style')
<link href="{{ url('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Header Layout Content -->
<!-- Header Layout Content -->

<div class="mdk-drawer-layout__content page ">
    <div class="container page__container">
        <br><br><br>
        <div class="card border-left-3 border-left-primary card-2by1 mt50">
            <div class="card-body">
                <div class="media flex-wrap align-items-center">
                    <div class="media-left col-md-9">
                        Liste des ventes a synchromiser :
                    </div>

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">


                    <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                            <table class="table table-centered table-bordered table-bordred table-striped" id="myTable">
                                <thead>
                                    <tr>

                                        <th class="nowrap"> <input id="select_all_details" type="checkbox" /> </th>
                                        <th class="nowrap">ID</th>
                                        <th class="nowrap">Designation</th>
                                        <th class="nowrap">Categorie</th>
                                        <th class="nowrap">QTE</th>
                                        <th class="nowrap">Prix</th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">


                                    @foreach($ventes as $vente)

                                    <tr>
                                        <td><input data-id="{{$vente->id_detail}}" class="select_detail" id="select_detail_{{$vente->id_detail}}" type="checkbox" /></td>
                                        <td>{{$vente->id_vente}}</td>
                                        <td>{{$vente->designation}}</td>
                                        <td>{{$vente->nom}}</td>
                                        <td>{{$vente->qte_vendu}}</td>
                                        <td>{{$vente->prix_produit}}</td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-body">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                            <table class="table table-centered table-bordered table-bordred table-striped" id="myTable">
                                <thead>
                                    <tr>

                                        <th class="nowrap"> <input id="select_all_details" type="checkbox" /> </th>
                                        <th class="nowrap">ID</th>
                                        <th class="nowrap">Designation</th>
                                        <th class="nowrap">Categorie</th>
                                        <th class="nowrap">QTE</th>
                                        <th class="nowrap">Prix</th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">

                              @foreach($avoirs as $vente)

                                    <tr>
                                        <td><input data-id="{{$vente->id_detail}}" class="select_detail" id="select_detail_{{$vente->id_detail}}" type="checkbox" /></td>
                                        <td>{{$vente->id_avoir}}</td>
                                        <td>{{$vente->designation}}</td>
                                        <td>{{$vente->nom}}</td>
                                        <td>{{$vente->qte_rendu}}</td>
                                        <td>{{$vente->prix_produit}}</td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>



        <form action="{{ route("fusionner-pv") }}" method="POST">

            {{ csrf_field() }}

            <input hidden name="liste_ventes" value="{{json_encode($unique_ventes)}}" />
            <input hidden name="liste_avoir" value="{{json_encode($unique_avoir)}}" />
            <input hidden id="selected_details" name="selected_details" value="" />

            <div class="form-group" style="display: flex;">
                @if($unique_ventes || $unique_avoir)
                <button id="refresh-pv" class="btn btn-primary" style="margin: auto; margin-right: 1rem">Fusionner </button>
                @endif
            </div>
        </form>



    </div>
</div>
@endsection
@section('script')
<!-- Required datatable js -->
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ url('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        'use strict';
        $('#myTable').DataTable({
            responsive: true,

        });

    });
</script>

<script type="text/javascript">
    // document.getElementById("pv_config_submit").addEventListener('click', () => {
    //   document.forms[1].submit();
    //})

    let selected_details = [];

    document.getElementById("refresh-pv").addEventListener('click', () => {
        document.forms[0].submit();
    })

    $("#select_all_details").on('click', function() {

        if (!$(this).is(':checked')) {
            let allInputs = document.getElementsByTagName("input");
            for (var i = 0, max = allInputs.length; i < max; i++) {
                if (allInputs[i].type === 'checkbox')
                    allInputs[i].checked = false;
            }
        } else {
            let allInputs = document.getElementsByTagName("input");
            for (var i = 0, max = allInputs.length; i < max; i++) {
                if (allInputs[i].type === 'checkbox')
                    allInputs[i].checked = true;
            }
        }


    });



    $(".select_detail").on('click', function() {
        selected_details.push($(this).data('id'));
        document.getElementById("selected_details").value = JSON.stringify(selected_details);
    });
</script>
@endsection