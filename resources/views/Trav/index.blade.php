@extends('Trav.main')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/ticket.CSS') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/keybord/keybord.css') }}">
    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                height: 1000px;
            }
        }

        .main-panel {
            width: 100% !important;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 15px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }

        .dark-edition .form-control,
        .is-focused .dark-edition .form-control {
            background-image: linear-gradient(0deg,
                    #029eb1 2px,
                    rgba(156,
                        39,
                        176,
                        0) 0),
                linear-gradient(0deg,
                    hsla(0,
                        0%,
                        71%,
                        .1) 1px,
                    hsla(0,
                        0%,
                        71%,
                        0) 0) !important;
        }

        .ticketBtn {
            padding: 10px !important;
        }

        hr {
            margin-top: 0rem;
            margin-bottom: 0rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1)
        }

        .click_btn:hover {
            background: #2196F3;
        }

        .click_btn.active {
            background: #2196F3;
        }

        .suprimerart:hover {
            outline: -webkit-focus-ring-color auto 1px;
            cursor: pointer;
        }

        .suh5 {
            margin: 0 !important;
            padding: 10px 5px;
        }

        .wrapper {
            margin: 0 auto;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .modal-backdrop {
            display: none !important;
        }

        #KioskBoard-VirtualKeyboard.kioskboard-theme-light,
        #KioskBoard-VirtualKeyboard.kioskboard-theme-material {
            background: #D3D3D379 !important
        }

        .cursorpointer {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <!-- Modal Mode caisse-->
    {{--
<div class="btn-group btn-group-lg text-center" style="    margin: 21px auto;
   display: inherit;" role="group" aria-label="...">
   <a type="button"  href="{{ route('trav.index')}}" class="btn {{\Request::route()->getName() == 'trav.index'? 'btn-success' : 'btn-outline-success'}} ">Restaurant</a>
<a type="button" href="{{ route('trav.Buvette')}}" class="btn {{\Request::route()->getName() == 'trav.Buvette'? 'btn-success' : 'btn-outline-success'}} ">Buvette</a>
</div>
--}}
    <!-- ticket -->
    <div class="row">
        <div class="col-md-3 " id="printtick">
            <div class="btn-group btn-group-lg d-flex" role="group" aria-label="Basic example">
                <button id="ticktunpause" type="button" class="btn btn-secondary">
                    <span class="material-icons">
                        replay
                    </span>
                    @if ($optsCoutn)
                        <span id="optsCoutn" class="badge badge-pill badge-secondary "
                            data-optscoutn="{{ $optsCoutn->count() }}">{{ $optsCoutn->count() }}</span>
                    @endif
                </button>
                <button id="ticktpause" type="button" class="btn btn-warning">
                    <span class="material-icons">
                        pause
                    </span></button>
                <button id="deleteticket" type="button" class="btn btn-danger d-none"><span class="material-icons">
                        delete
                    </span></button>
            </div>
            <div class="box" id="box">
                <div class='inner'>
                    <div class='info clearfix'>
                        <div class='wp'>
                            <h2>Article</h2>
                        </div>
                        <div class='wp'>
                            <h2>Qte</h2>
                        </div>
                        <div class='wp'>
                            <h2>Prix</h2>
                        </div>
                    </div>
                    <div id="body_ticket">
                    </div>
                    <div class='total clearfix' id="total_ticket">
                        <h2 class="calculated-price" style="font-size: 1.7rem">
                            Total :
                            <p> 00.00 DH</p>
                        </h2>
                        <h2 class="offer-price d-none" style="font-size: 1.7rem">
                            Total :
                            <p> 00.00 DH</p>
                        </h2>
                    </div>
                    <div class='total clearfix' id="Remise_ticket" style="display:none">
                        <h2>
                            Remise :
                            <p> 00.00 DH</p>
                        </h2>
                    </div>
                    <div class='total clearfix' id="reste_ticket" style="display: none">
                        <h2>
                            Reste :
                            <p> 00.00 DH</p>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="row" style="align-items: center;">
                <div class="col-md-1">
                    <div class=" bmd-form-group poidsInputGroup">
                        <input type="text" name="prsnl" id="prsnl" class="form-control prsnl" value="c4ca4238a0"
                            placeholder="ID Eleve" style="height: 55px">
                        {{-- <input type="hidden" name="type" id="type" class="form-control " value="{{Auth::user()->type = \Request::route()->getName() == 'trav.index'? 'R' : 'B'}}"> --}}
                        <input type="hidden" name="type" id="type" class="form-control "
                            value="{{ Auth::user()->type }}">
                        <input type="hidden" name="total_a_payer" id="total_a_payer" class="form-control">
                        <input type="hidden" name="hidden_prix_payer_model" id="hidden_prix_payer_model"
                            class="form-control">
                        <input type="hidden" name="hidden_remise_model" id="hidden_remise_model" class="form-control">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class=" bmd-form-group poidsInputGroup">
                        <input type="text" autofocus name="code_bar" id="code_bar" class="form-control "
                            autocomplete="off" value="{{ old('code_bar') }}" placeholder="Code bar Produit"
                            style="height: 55px">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class=" bmd-form-group poidsInputGroup">
                        <input type="text" autofocus name="qte_scan" id="qte_scan"
                            class="form-control virtual-keyboard  " autocomplete="off" value="1" placeholder="QTE"
                            data-kioskboard-type="numpad" changeplaceholder="QTE" style="height: 55px">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class=" bmd-form-group poidsInputGroup">
                        <input type="text" autofocus name="prix_payer" id="prix_payer"
                            class="form-control  virtual-keyboard " data-kioskboard-type="numpad"
                            changeplaceholder="Quantité" autocomplete="off" value="{{ old('prix_payer') }}"
                            placeholder="Prix Payer" style="height: 55px">
                    </div>
                </div>
                <div class="col-md-1 " id="remise_input">
                    <div class=" bmd-form-group poidsInputGroup">
                        <input type="text" autofocus name="remise" id="remise"
                            class="form-control virtual-keyboard  " autocomplete="off" value="{{ old('remise') }}"
                            data-kioskboard-type="numpad" changeplaceholder="Remise %" placeholder="Remise %"
                            style="height: 55px">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class=" bmd-form-group poidsInputGroup">
                        <select class="form-control select2-single  " name="paie_methode" id="paie_methode">
                            <option value="espece">Espece</option>
                            <option value="carte-bancaire">Carte Bancaire</option>
                            <option id="offert_option" class="d-none" value="offert">Offert</option>
                            <option value="en-compte">En compte</option>
                        </select>
                        <style>
                            select option {
                                zoom: 1.5;
                            }
                        </style>
                    </div>
                </div>
                <div class="col-md-2 client_list_col d-none">
                    <div class=" bmd-form-group poidsInputGroup">
                        <select class="form-control select2-single d-none" name="client_list" id="client_list">
                            <option value="">Sélectionner un client ... </option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->prenom }} {{ $client->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    @if ($params->table_select == 1)
                        <div class=" bmd-form-group poidsInputGroup">
                            <select class="form-control select2-single " name="table_list" id="table_list">
                                <option value="">Sélectionner une table ... </option>
                                @foreach ($tables as $table)
                                    <option value="{{ $table->id }}"> {{ $table->nom }} </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <div class="col-md-2">
                    @if ($params->remarque_select == 1)
                        <div class=" bmd-form-group poidsInputGroup">
                            <select class="form-control select2-single  " name="remarque" id="remarque">
                                <option value="">Sélectionner une remarque ... </option>
                                @foreach ($remarques as $remarque)
                                    <option value="{{ $remarque->id }}"> {{ $remarque->remarque }} </option>
                                @endforeach
                            </select>
                            <style>
                                select option {
                                    zoom: 1.5;
                                }
                            </style>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class=" bmd-form-group poidsInputGroup">
                        <input type="text" autofocus name="lebelle" id="lebelle" class="form-control "
                            autocomplete="off" value="{{ old('lebelle') }}" placeholder="Désignation"
                            style="height: 55px">
                    </div>
                </div>
                <button id="clear_search" class="btn btn-danger col-md-4"> Vider La Sélection </button>
                <div class="col-md-4">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="grid-margin stretch-card" style="padding: 0;">
                        <div class="card" style="margin-top: 0px !important">
                            <div class="justify-content-center">
                                <span class="catShowSpan col-md-12" style="display: none;"><button type="button"
                                        class="btn btn-rounded btn-fw btn-block click_btn cat"
                                        style="background-color: white;color: black;">return</button></span>
                                <div class="row CategoryDiv">
                                    @foreach ($cats as $cat)
                                        @if ($cat->type == Auth::user()->type || $cat->type == 'Mix')
                                            <button class="click_btn cat"
                                                style=" height: 2rem; color: black;padding: 20px !important; display: flex;align-items: center;justify-content: center;margin: 0 10px 10px 0 ; cursor: pointer;"
                                                data-id="{{ $cat->id }}" data-nom="{{ $cat->nom_cat }}">
                                                {{ $cat->nom_cat }}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" grid-margin stretch-card" style="padding: 0;">
                        <div class="card" style="margin-top: 0px !important">
                            <div class="row" id="articles" style="margin-bottom: 40px !important">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="position: fixed;bottom:0;width: 100% !important;">
        <div class="{{ $params->enable_cusisine == 1 && $params->enable_barman == 1 ? 'col-md-1' : 'col-md-2' }}">
            <button type="button" class="btn btn-success btn-rounded  btn-fw btn-block click_btn ticket"
                style="padding: 1em;margin-bottom:10px" id="btnPrint">Ticket</button>
        </div>
        <div class="col-md-1 {{ $params->enable_cusisine == 1 ? '' : 'd-none' }} ">
            <button type="button" class="btn btn-success btn-rounded  btn-fw btn-block click_btn"
                style="padding: 1em;margin-bottom:10px" id="btnPrintCuisine">Cuisine</button>
        </div>
        <div class="col-md-1  {{ $params->enable_barman == 1 ? '' : 'd-none' }}">
            <button type="button" class="btn btn-success btn-rounded btn-fw btn-block click_btn"
                style="padding: 1em;margin-bottom:10px" id="btnPrintBar">Barman</button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary btn-fw btn-block click_btn consulte" style="padding: 1em;"
                data-toggle="modal" data-target="#consulte">consulté</button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-info  btn-fw btn-block click_btn reset"
                style="padding: 1em;">relancer</button>
        </div>
        <div class="col-md-1">
            <a href="#" class="btn btn-success  btn-fw btn-block " id="Imprimer_Cloturage"
                style="padding: 1em;">Imprimer </a>
        </div>
        <div class="col-md-1">
            <a href="#" class="btn btn-danger  btn-fw btn-block " id="retour" style="padding: 1em;">Retour </a>
        </div>
        <div class="col-md-1">
            <a href="#" class="btn btn-warning  btn-fw btn-block click_btn cloturage"
                style="padding: 1em;">Cloturage</a>
        </div>
        <div class="col-md-1">
            <a href="{{ route('trav.logout') }}" class="btn btn-danger btn-rounded btn-fw btn-block"
                style="padding: 1em;"><i class="material-icons">donut_large</i></a>
        </div>
        <div class="col-md-1 " id="remise_btn">
            <button class="btn btn-primary btn-rounded btn-fw btn-block" style="padding: 1em;" data-toggle="modal"
                data-target="#code_manager">Manager</button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-success btn-rounded btn-fw btn-block fullscreen" data-id="1"
                style="padding: 1em;" onclick="openFullscreen()"><span class="material-icons">
                    fullscreen
                </span>
            </button>
        </div>
    </div>
    </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="consulterModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Mes operations</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>Les operations</h3>
                            <table class="table tableClick table-info">
                                <thead>
                                    <tr>
                                        <th>numtick</th>
                                        <th>Date operation</th>
                                    </tr>
                                </thead>
                                <tbody id="tableOperation">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <h3>Detail de operation</h3>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>type</th>
                                        <th>prix</th>
                                        <th>qte</th>
                                    </tr>
                                </thead>
                                <tbody id="tableDetail">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <h3>Detail de option</h3>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>option</th>
                                        <th>prix</th>
                                    </tr>
                                </thead>
                                <tbody id="tableoption">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <h3>Detail de option</h3>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>total prod</th>
                                    </tr>
                                </thead>
                                <tbody id="prod">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  consulte-->
    <div class="modal fade" id="consulte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Consultation des tickets</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <table class="table tableClick">
                                <thead>
                                    <tr>
                                        <th scope="col">Numtick</th>
                                        <th scope="col">Cloturage</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableOperationConsult">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Prod</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Qte</th>
                                    </tr>
                                </thead>
                                <tbody id="tableProdConsult">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Code Manager -->
    <div class="modal fade" id="code_manager" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="allow_op_form">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Code Manager </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label class="d-none"> List Managers : </label>
                                <select class="d-none form-control select2-single  " name="code_manager_username"
                                    id="code_manager_username">
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->username }}"> {{ $manager->username }} </option>
                                    @endforeach
                                </select>
                                <label>Code Manager : </label>
                                <input autofocus type="password" placeholder="Code Manager" id="code_manager_password"
                                    name="code_manager_password" data-kioskboard-type="numpad"
                                    changeplaceholder="Quantité" class="form-control virtual-keyboard" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="validate_code_manager">Valider</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Code Manager -->
    <div class="modal fade" id="myModalUnite" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitlemyModalUnite" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitlemyModalUnite"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idmodel">
                    <input type="hidden" id="prixmodel">
                    <input type="hidden" id="artmodel">
                    <input type="hidden" id="uniteogmodel">
                    <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Unite:</label>
                        <div class="col-sm-9">
                            <select class="form-control select2-single  " name="unitemodel" id="unitemodel">
                                <option value="kg">KG</option>
                                <option value="g">G</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quantité :</label>
                        <div class="col-sm-9">
                            <input id="qtemodel" name="qtemodel" type="number" class="form-control virtual-keyboard "
                                data-kioskboard-type="numpad" changeplaceholder="Quantité">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="saveqteunite">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="box" id="hiddenbox" style="display: none">
        <div class='inner'>
            <h1 id="title_ticket_ret">{{ Auth::user()->etab->nom }}</h1>
            <div id="info_ticket">
                <div class='wp'>Ticket :</div>
                <div class='wp'>Date :</div>
            </div>
            <div id="info_ticket_detail">
                <div class='wp' id="hidden_ticket_num">RTGTVDVD</div>
                <div class='wp' id="hidden_ticket_date">20/09/2021</div>
            </div>
            <div id="info_ticket" style="margin-top: 1.5rem;">
                <div class='wp'>Table :</div>
                <div class='wp'>Client :</div>
            </div>
            <div id="info_ticket_detail">
                <div class='wp' id="hidden_ticket_table">Table 1 </div>
                <div class='wp' id="hidden_ticket_client">Client 1</div>
            </div>
            <hr>
            <div class='info clearfix'>
                <div class='wp'>
                    <h2>Article</h2>
                </div>
                <div class='wp'>
                    <h2>Qte</h2>
                </div>
                <div class='wp'>
                    <h2>Prix</h2>
                </div>
                <div class='wp'>
                    <h2>Remise</h2>
                </div>
            </div>
            <style>
                .wp {
                    font-size: .8rem;
                }

                .wp h2 {
                    font-size: 1.2rem;
                }
            </style>
            <div id="hidden_body_ticket">
            </div>
            <div class='total clearfix' id="hidden_total_ticket">
                <h3 id="ticket_calc_price" class="calculated-price">
                    Total :
                    <p> 00.00 DH</p>
                </h3>
                <h3 id="ticket_free_price" class="offer-price d-none">
                    Total :
                    <p> 00.00 DH</p>
                </h3>
            </div>
            <div class='total clearfix' id="hidden_Remise_ticket" style="display:none">
                <h3>
                    Remise :
                    <p> 00.00 DH</p>
                </h3>
            </div>
            <div class='total clearfix' id="hidden_ticket_rest" style="display: none">
                <h3>
                    Reste :
                    <p> 00.00 DH</p>
                </h3>
            </div>
            <center>
                <h4 id="hidden_ticket_paie_methode">Espece</h4>
                <h4 id="hidden_ticket_user">Utilisateur : {{ Auth::user()->username }}</h4>
            </center>
            <center>
                <p>{{ Auth::user()->etab->msg }}</p>
            </center>
        </div>
    </div>
    <div class="box" id="hiddenbox2" style="display: none">
        <div class='inner'>
            <h1 id="">{{ Auth::user()->etab->nom }}</h1>
            <div id="info_ticket2">
                <div class='wp'>Ticket :</div>
                <div class='wp'>Date :</div>
            </div>
            <div id="info_ticket_detail2">
                <div class='wp' id="hidden_ticket_num2">RTGTVDVD</div>
                <div class='wp' id="hidden_ticket_date2">20/09/2021</div>
            </div>
            <div id="info_ticket2" style="margin-top: 1.5rem;">
                <div class='wp'>Table :</div>
                <div class='wp'>Remarque :</div>
            </div>
            <div id="info_ticket_detail2">
                <div class='wp' id="hidden_ticket_table2">Table 1 </div>
                <div class='wp info_ticket_detail_cuisine2' id="info_ticket_detail2"> Remarque </div>
            </div>
            <hr>
            <div class='info clearfix'>
                <div class='wp'>
                    <h2>Article</h2>
                </div>
                <div class='wp'>
                    <h2>Qte</h2>
                </div>
            </div>
            <style>
                .wp {
                    font-size: .8rem;
                }

                .wp h2 {
                    font-size: 1.2rem;
                }
            </style>
            <div id="hidden_body_ticket2">
            </div>
        </div>
    </div>
    <div class="modal fade" id="pausedtickits" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">billets en attente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="" id="pausedtickitstable">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('assets/js/sweetalert2.all.min.js') }}"></script>
    {{-- <script src="{{url('assets/plugins/keybord/keybord.js')}}"></script> --}}
    <script src="{{ url('assets/plugins/keybord/dist/kioskboard-aio-1.3.3.min.js') }}"></script>
    <script>
        KioskBoard.Init({
            keysArrayOfObjects: [{
                ".": "."
            }],
            keysJsonUrl: "{{ url('assets/plugins/keybord/dist/kioskboard-keys-english.json') }}",
            specialCharactersObject: null,
            language: 'en',
            theme: 'light',
            capsLockActive: true,
            allowRealKeyboard: true,
            cssAnimations: true,
            cssAnimationsDuration: 360,
            cssAnimationsStyle: 'slide',
            keysAllowSpacebar: true,
            keysSpacebarText: 'Space',
            keysFontFamily: 'sans-serif',
            keysFontSize: '25px',
            keysFontWeight: 'normal',
            keysIconSize: '25px',
            allowMobileKeyboard: true,
            autoScroll: true,
        });
        // Run KioskBoard
        // Select any input or textarea element(s) to run KioskBoard
        KioskBoard.Run('.virtual-keyboard');
    </script>
    <script>
        var count = 1;
        var total = 0;
        var qteArt = 0;
        var totalTicket = [];
        var totalTicketDH = 0;
        var prixQte = 0;
        $(document).ready(function() {
            localStorage.removeItem('isManager');
            localStorage.removeItem('nativeManager');
            localStorage.setItem('nativeManager', {{ Auth::user()->is_manager ? Auth::user()->is_manager : 0 }});
            if (localStorage.getItem('nativeManager') == 1) {
                console.log('native manager')
                document.getElementById("remise_btn").classList.add('d-none');
                //document.getElementById("remise_input").classList.remove('d-none');
                document.getElementById("offert_option").classList.remove('d-none');
                document.getElementById("deleteticket").classList.remove('d-none');
            }
            $("#paie_methode").on('change', function() {
                console.log($("#paie_methode").val());
                if ($("#paie_methode").val() == "offert") {
                    document.querySelectorAll('.calculated-price').forEach(x => x.classList.add('d-none'));
                    document.querySelectorAll('.offer-price').forEach(x => x.classList.remove('d-none'));
                } else {
                    document.querySelectorAll('.calculated-price').forEach(x => x.classList.remove(
                        'd-none'));
                    document.querySelectorAll('.offer-price').forEach(x => x.classList.add('d-none'));
                }
            })
            $('#lebelle').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    let searcth_term = $(this).val();
                    $.ajax({
                        url: "{{ route('trav.search-prod-designation') }}",
                        type: 'post',
                        data: {
                            searchTerm: searcth_term,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(values) {
                            let prods = JSON.parse(values);
                            $('#articles').html('');
                            Array.from(prods).forEach((prod, index) => {
                                $("#articles").append(`<div class="col-md-2 ">
    <button class="artLInk click_btn btn-primary ${index%2==0 ? 'btn-primary' : 'btn-success'}"
	 style="width: 100%;min-height: 4rem;display: flex; align-items: center;
	 justify-content: center;flex-direction: column; margin-bottom: .5rem" data-id="${prod.id}" data-prix="${prod.prix_vente}" data-code="${prod.code_bar}" 
	 data-art="${prod.lebelle}" data-unite="${prod.unite}"     data-remise-max="${prod.remise_max}" data-qte="${prod.qte}" data-type="${prod.type}">
    <b>${prod.lebelle}</b>
    <!-- <br><b>Quantité stock : </b>  -170 / qte -->
    <div><b>Prix : </b> ${prod.prix_vente}</div>
</button>
</div>`);
                            })
                        }
                    })
                }
            });
            $('#clear_search').on('click', function() {
                $("#lebelle").val('');
                $('#articles').html('');
            })
            $('#code_manager').on('show.bs.modal', function() {
                setTimeout(function() {
                    document.getElementById('code_manager_password').focus();
                }, 500)
            })
            $("#paie_methode").on('change', function() {
                if ($("#paie_methode").val() == "en-compte") {
                    document.getElementById("client_list").classList.remove('d-none')
                    document.querySelector(".client_list_col").classList.remove('d-none')
                } else {
                    document.getElementById("client_list").classList.add('d-none')
                    document.querySelector(".client_list_col").classList.add('d-none')
                }
            })
            var remise_tot = 0;
            var remise_max;
            var totalTicketDHSansRemise = 0;
            var re_total = 0 ;

            function settickt(arraytick, data, body_ticket = "#body_ticket", total_ticket = "#total_ticket") {
                var remise = $("#remise").val() > 0 ? $("#remise").val() : 0;
                if (data) {
                    remise_max = data.remise_max;
                }

                var inserted_remise = $("#remise").val() ? $("#remise").val() : 0;


                if (remise > 0) {
                    setTimeout(function() {


                        // $.ajax({
                        // 	url: "{{ route('trav.max_remise') }}",
                        // 	type: 'post',
                        // 	data: {
                        // 		code_bar: JSON.stringify(localStorage.getItem('lastest_code_bar')),
                        // 		_token: '{{ csrf_token() }}',
                        // 	},
                        // 	success: function(values) {
                        // 		if (JSON.parse(values) != -1) {
                        // 			if (JSON.parse(values) < remise) {
                        // 				remise = JSON.parse(values);
                        // 			}
                        // 		}
                        // 	}
                        // });
                        var is_exist = false;
                        var i = 0;
                        if (data) {
                            if (remise > data.remise_max) {
                                remise = data?.remise_max
                            }


                            totalTicketDHSansRemise = 0;
                            $.each(arraytick, function(key, value) {
                                console.log(key)
                                if (data.id == value.idProd) {
                                    is_exist = true;
                                    i = key;
                                    return;
                                }
                            });
                            // if (!is_exist) {
                            //     $(body_ticket).html('');
                            //     var newprix = 0;
                            //     var newqte = 0;
                            //     var prix_sans_remise = 0;
                            //     // if (data.uniteog == "kg") {
                            //     //     if (data.unite == "kg") {
                            //     //         newqte = parseFloat(data.qte);
                            //     //         newprix += parseFloat(data.prix) * parseFloat(data.qte);

                            //     //     } else {
                            //     //         newqte = parseFloat(data.qte) / 1000;
                            //     //         newprix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
                            //     //     }
                            //     // } else if (data.uniteog == "g") {
                            //     //     if (data.unite == "kg") {
                            //     //         newqte = parseFloat(data.qte) * 1000;
                            //     //         newprix += parseFloat(data.prix) * (parseFloat(data.qte) * 1000);

                            //     //     } else {

                            //     //         newqte = parseFloat(data.qte);
                            //     //         newprix += parseFloat(data.prix) * (parseFloat(data.qte));
                            //     //     }
                            //     // } else {
                            //     //     newqte = parseFloat(data.qte);
                            //     //     newprix = parseFloat(data.prix) * parseFloat(data.qte) - ((parseFloat(
                            //     //         data.prix) * parseFloat(data.qte)) * remise / 100).toFixed(2);

                            //     //     remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise / 100).toFixed(2);
                            //     //     prix_sans_remise = parseFloat(data.prix) * parseFloat(data.qte);
                            //     // }


                            //     if (data.uniteog == "kg") { 
                            //         if (data.unite == "kg") {
                            //             newqte = parseFloat(data.qte);
                            //             // newprix += parseFloat(data.prix) * parseFloat(data.qte);
                            //             newprix += parseFloat(data.prix) * parseFloat(data.qte) - ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /100).toFixed(2);
                            //             prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte) ; 
                            //             remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);

                            //         } else {
                            //             newqte = parseFloat(data.qte) / 1000;
                            //             newprix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
                            //             prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte) / 1000  - ((parseFloat(data.prix) * parseFloat(data.qte) / 1000) * remise /100).toFixed(2);
                            //             remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);

                            //         }
                            //     } else if (data.uniteog == "g") {
                            //         if (data.unite == "kg") {
                            //             newqte =  parseFloat(data.qte) * 1000;
                            //             newprix += parseFloat(data.prix) * (parseFloat(data.qte) *1000) - ((parseFloat(data.prix) * parseFloat(data.qte) * 1000) * remise /100).toFixed(2);
                            //             prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte) *
                            //                 1000 ; 
                            //                 remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);
                            //         } else {
                            //             newqte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
                            //             newprix += parseFloat(data.prix) * (parseFloat(data.qte)) - ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /100).toFixed(2);;
                            //             prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte)
                            //             remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);
                            //         }
                            //     } else {
                            //         newqte = parseFloat(data.qte) + parseFloat(data.qte);
                            //         newprix += parseFloat(data.prix) * parseFloat(data.qte) - ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /100).toFixed(2);
                            //         remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /100).toFixed(2);
                            //         prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte)

                            //     }




                            //     if (localStorage.getItem("isRetour")) {
                            //         console.log("is retour")


                            //         arraytick.push({
                            //             idProd: data.id,
                            //             prix: -newprix,
                            //             qte: -newqte,
                            //             name: data.name,
                            //             unite: data.uniteog,
                            //             type_prod: data.type_prod,
                            //             prix_sans_remise: prix_sans_remise,
                            //             max_remise: remise,
                            //             code_bar: data.code_bar
                            //         });
                            //     } else {
                            //         console.log("is not retour")
                            //         arraytick.push({
                            //             idProd: data.id,
                            //             prix: newprix,
                            //             qte: newqte,
                            //             name: data.name,
                            //             unite: data.uniteog,
                            //             type_prod: data.type_prod,
                            //             prix_sans_remise: prix_sans_remise,
                            //             max_remise: remise,
                            //             code_bar: data.code_bar
                            //         });
                            //     }
                            // } else {

                            //     if (arraytick[i].unite == "kg") {
                            //         if (data.unite == "kg") {
                            //             arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
                            //             arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte);
                            //             prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte)
                            //             arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(
                            //                 data.qte)
                            //                 remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);
                            //         } else {
                            //             arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data
                            //                 .qte) / 1000;
                            //             arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) /
                            //                 1000);
                            //             prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte) /
                            //                 1000
                            //             arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(
                            //                 data.qte) / 1000 ; 
                            //                 remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);
                            //         }
                            //     } else if (arraytick[i].unite == "g") {
                            //         if (data.unite == "kg") {
                            //             arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data
                            //                 .qte) * 1000;
                            //             arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) *
                            //                 1000);


                            //             arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(
                            //                 data.qte) * 1000
                            //                 remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);
                            //         } else {
                            //             arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data
                            //                 .qte);
                            //             arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte));
                            //             prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte)
                            //             arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(
                            //                 data.qte)
                            //                 remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);
                            //         }
                            //     } else {
                            //         arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
                            //         arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte) - ((
                            //                 parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);
                            //         remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                            //             100).toFixed(2);
                            //         prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte)
                            //         arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(data
                            //             .qte)
                            //     }
                            // }




                            if (!is_exist) {

                                var newprix = 0;
                                var newqte = 0;
                                var prix_sans_remise = 0;




                                if (data.uniteog == "kg") {

                                    if (data.unite == "kg") {
                                        newqte = parseFloat(data.qte);
                                        newprix += parseFloat(data.prix) * parseFloat(data.qte);
                                        prix_sans_remise = parseFloat(data.prix) * parseFloat(data.qte);
                                        remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                                        100).toFixed(2);
                                        // re_total += remise * data.qte 
                                    } else {
                                        newqte = parseFloat(data.qte) / 1000;
                                        newprix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
                                        prix_sans_remise = parseFloat(data.prix) * parseFloat(data.qte);
                                        remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                                        100).toFixed(2);
                                    }

                                } else if (data.uniteog == "g") {
                                    if (data.unite == "kg") {
                                        newqte = parseFloat(data.qte) * 1000;
                                        newprix += parseFloat(data.prix) * (parseFloat(data.qte) * 1000);
                                        prix_sans_remise = parseFloat(data.prix) * parseFloat(data.qte);
                                        remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                                        100).toFixed(2);
                                    } else {
                                        newqte = parseFloat(data.qte);
                                        newprix += parseFloat(data.prix) * (parseFloat(data.qte));
                                        prix_sans_remise = parseFloat(data.prix) * parseFloat(data.qte);
                                        remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                                        100).toFixed(2);
                                    }
                                } else {
                                    newqte = parseFloat(data.qte);
                                    newprix = parseFloat(data.prix) * parseFloat(data.qte) - ((parseFloat(
                                        data.prix) * parseFloat(data.qte)) * remise / 100).toFixed(2);
                                    remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                                        100).toFixed(2);
                                    prix_sans_remise = parseFloat(data.prix) * parseFloat(data.qte);
                                }

                                if (localStorage.getItem("isRetour")) {
                                    console.log("is retour")
                                    arraytick.push({
                                        idProd: data.id,
                                        prix: -newprix,
                                        qte: -newqte,
                                        name: data.name,
                                        unite: data.uniteog,
                                        type_prod: data.type_prod,
                                        prix_sans_remise: prix_sans_remise,
                                        max_remise: remise ,
                                        code_bar : code_bar
                                    });
                                } else {
                                    console.log("is not retour")
                                    arraytick.push({
                                        idProd: data.id,
                                        prix: newprix,
                                        qte: newqte,
                                        name: data.name,
                                        unite: data.uniteog,
                                        type_prod: data.type_prod,
                                        prix_sans_remise: prix_sans_remise,
                                        max_remise: remise ,
                                        code_bar : code_bar
                                    });
                                }



                            } else {



                                if (arraytick[i].unite == "kg") {

                                    if (data.unite == "kg") {
                                        arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
                                        arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte);
                                        prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte)
                                        arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(
                                            data.qte)
                                    } else {
                                        arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data
                                            .qte) / 1000;
                                        arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) /
                                            1000);
                                        prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte) /
                                            1000
                                        arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(
                                            data.qte) / 1000
                                    }

                                } else if (arraytick[i].unite == "g") {
                                    if (data.unite == "kg") {
                                        arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data
                                            .qte) * 1000;
                                        arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) *
                                            1000);
                                        prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte) *
                                            1000
                                        arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(
                                            data.qte) * 1000
                                    } else {
                                        arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data
                                            .qte);
                                        arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte));
                                        prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte)
                                        arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(
                                            data.qte)
                                    }
                                } else {
                                    arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
                                    arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte) - ((
                                            parseFloat(data.prix) * parseFloat(data.qte)) * remise /
                                        100).toFixed(2);
                                    remise_tot += ((parseFloat(data.prix) * parseFloat(data.qte)) * remise / 100).toFixed(2);

                                    prix_sans_remise += parseFloat(data.prix) * parseFloat(data.qte)
                                    arraytick[i].prix_sans_remise += parseFloat(data.prix) * parseFloat(data
                                        .qte)

                                }

                            }
                        }
                        if (localStorage.getItem("isRetour") == 1) {
                            totalTicketDH = 0;
                            $.each(arraytick, function(index, val) {
                                totalTicketDH = parseFloat(totalTicketDH) - parseFloat(arraytick[
                                    index].prix);
                            });
                            $(body_ticket).html('');
                            $.each(arraytick, function(key, value) {
                                $(body_ticket).append(`
        							<div class='info clearfix suprimerart ${value.type_prod != 3 ? 'hide_bar' : '' } ${value.type_prod != 1 ? 'hide_kitchen' : '' } '  data-id="${value.idProd}">
        								<div class='wp'> -${value.name}</div>
        								<div class='wp'> - ${value.qte.toFixed(2)}</div>
        								<div class='wp'>- ${value.prix_sans_remise.toFixed(2)}</div>
        								<div class='wp'>${value.max_remise * value.qte?? 0 } %</div>
        							</div>`);
                            });
                            // <div class='wp'>${value.max_remise ?? 0 } %</div>
                            console.log("Prix retour : " + totalTicketDH)
                            $('#total_a_payer').val(totalTicketDH);
                        } else {
                            totalTicketDH = 0;
                            totalTicketDHSansRemise = 0;
                            $.each(arraytick, function(index, val) {
                                totalTicketDH = parseFloat(totalTicketDH) + parseFloat(arraytick[index].prix - arraytick[index].prix *  (arraytick[index].max_remise * arraytick[index].qte) /100 );

                                totalTicketDHSansRemise = parseFloat(totalTicketDHSansRemise) +
                                    parseFloat(arraytick[index].prix_sans_remise);
                            });
                            console.log("TICKT PROD : ", arraytick);
                            $(body_ticket).html('');
                            $.each(arraytick, function(key, value) {

                                $(body_ticket).append(`
        							<div class='info clearfix suprimerart ${value.type_prod != 3 ? 'hide_bar' : '' } ${value.type_prod != 1 ? 'hide_kitchen' : '' } '  data-id="${value.idProd}">
        								<div class='wp'> ${value.name}</div>
        								<div class='wp'> x ${value.qte.toFixed(2)}</div>
        								<div class='wp'>${value.prix_sans_remise}</div>
        								<div class='wp'>${value.max_remise * value.qte?? 0} %</div>
        							</div>`);
                                return;
                            });
                        }

                        if ($("#paie_methode").val() == "offert") {
                            $(total_ticket).html(
                                `<h2 class="calculated-price" style="font-size:1.7rem">Total : <p> ${totalTicketDHSansRemise.toFixed(2)} DH</p></h2>` +
                                `<h2 class="offer-price" style="font-size:1.7rem">Total : <p> 0.00 DH</p></h2>`
                            );
                            $("#Remise_ticket").html(
                                `<h2 class="calculated-price" style="font-size:1.7rem">Total : <p> ${totalTicketDH.toFixed(2)} DH</p></h2>` +
                                `<h2 class="offer-price" style="font-size:1.7rem">Total : <p> 0.00 DH</p></h2>`
                            );
                            document.querySelectorAll('.calculated-price').forEach(x => x.classList.add(
                                'd-none'))
                            document.querySelectorAll('.calculated-price').forEach(x => x.classList.add(
                                'd-none'))
                            document.querySelectorAll('.offer-price').forEach(x => x.classList.remove(
                                'd-none'))
                        } else {
                            $(total_ticket).html(
                                `<h2 class="offer-price" style="font-size:1.7rem">Total : <p> 0.00 DH</p></h2>` +
                                `<h2 class="calculated-price" style="font-size:1.7rem">Total : <p> ${totalTicketDHSansRemise.toFixed(2)} DH</p></h2>`
                            );
                            $("#Remise_ticket").html(
                                `<h2 class="offer-price" style="font-size:1.7rem">Total : <p> 0.00 DH</p></h2>` +
                                `<h2 class="calculated-price" style="font-size:1.7rem">Total : <p> ${totalTicketDH.toFixed(2)} DH</p></h2>`
                            );

                            document.querySelectorAll('.calculated-price').forEach(x => x.classList.remove(
                                'd-none'))
                            document.querySelectorAll('.offer-price').forEach(x => x.classList.add(
                                'd-none'));
                            $("#remise").val(inserted_remise);
                            //$('#hidden_remise_model').val(inserted_remise);
                            //$('#hidden_prix_payer_model').val(totalTicketDH)
                        }
                        changeReste();
                        changeRemise();
                        $("#remise").val(inserted_remise);
                        remise = 0;
                        remise_tot = 0;
                        $('#hidden_prix_payer_model').val(0);
                        $('#hidden_remise_model').val(0);
                        $('#reste_ticket').hide();
                        $('#Remise_ticket').hide();
                    }, 0);
                }
                //IF NO REMISE :
                else {
                    $(body_ticket).html('');
                    var is_exist = false;
                    var i = 0;
                    var remise = 0;
                    if (data) {
                        $.each(arraytick, function(key, value) {
                            console.log(key)
                            if (data.id == value.idProd) {
                                is_exist = true;
                                i = key;
                                return;
                            }
                        });
                        if (!is_exist) {
                            var newprix = 0;
                            var newqte = 0;
                            if (data.uniteog == "kg") {
                                if (data.unite == "kg") {
                                   
                                    if(data.code_bar.length > 7 && data.code_bar.startsWith('21') ){
                                        poids = parseFloat(data.code_bar.slice(7, 12) / 1000)  
                                        newprix = parseFloat(data.prix) * poids;
                                        newqte = poids ; 
                                    }else{
                                        newprix += parseFloat(data.prix) * parseFloat(data.qte);
                                        newqte = parseFloat(data.qte);
                                    }
                                   
                                } else {
                                    newqte = parseFloat(data.qte) / 1000;
                                    newprix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
                                }
                            } else if (data.uniteog == "g") {
                                if (data.unite == "kg") {
                                    newqte = parseFloat(data.qte) * 1000;
                                    newprix += parseFloat(data.prix) * (parseFloat(data.qte) * 1000);
                                } else {
                                    newqte = parseFloat(data.qte);
                                    newprix += parseFloat(data.prix) * (parseFloat(data.qte));
                                }
                            } else {
                                newqte = parseFloat(data.qte);
                                newprix = parseFloat(data.prix) * parseFloat(data.qte) - ((parseFloat(data.prix) *
                                    parseFloat(data.qte)) * remise / 100);
                            }
                            if (localStorage.getItem("isRetour") == 1) {
                                arraytick.push({
                                    idProd: data.id,
                                    prix: -newprix,
                                    qte: -newqte,
                                    name: data.name,
                                    unite: data.uniteog,
                                    type_prod: data.type_prod,
                                    code_bar: data.code_bar
                                });
                            } else {
                                arraytick.push({
                                    idProd: data.id,
                                    prix: newprix,
                                    qte: newqte,
                                    name: data.name,
                                    unite: data.uniteog,
                                    type_prod: data.type_prod,
                                    code_bar: data.code_bar
                                });
                            }
                            //console.log("Here=>" , arraytick);
                        } else {
                            if (arraytick[i].unite == "kg") {
                                if (data.unite == "kg") {
                                   
                                   
                                    if(data.code_bar.length > 7 && data.code_bar.startsWith('21') ){
                                        poids =  parseFloat(data.code_bar.slice(7, 12) / 1000)  
                                        arraytick[i].prix += parseFloat(data.prix) * poids;
                                        arraytick[i].qte = parseFloat(arraytick[i].qte) + poids;
                                    }else{
                                         arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte);
                                         arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
                                    }
                                } else {
                                    arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte) / 1000;
                                    arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
                                }
                            } else if (arraytick[i].unite == "g") {
                                if (data.unite == "kg") {
                                    arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte) * 1000;
                                    arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) * 1000);
                                } else {
                                    arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
                                    arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte));
                                }
                            } else {
                                arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
                                arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte) - ((parseFloat(
                                    data.prix) * parseFloat(data.qte)) * remise / 100);
                            }
                        }
                    }
                    if (localStorage.getItem("isRetour") == 1) {
                        totalTicketDH = 0;
                        $.each(arraytick, function(index, val) {
                            console.log(
                                "sum " + arraytick[index].prix
                            )
                            totalTicketDH = parseFloat(totalTicketDH) - parseFloat(arraytick[index].prix);
                        });
                        $.each(arraytick, function(key, value) {
                            $(body_ticket).append(`
        							<div class='info clearfix suprimerart ${value.type_prod != 3 ? 'hide_bar' : '' } ${value.type_prod != 1 ? 'hide_kitchen' : '' } '  data-id="${value.idProd}">
        								<div class='wp'> -${value.name}</div>
        								<div class='wp'> - ${value.qte.toFixed(2)} </div>
        								<div class='wp'>- ${value.prix.toFixed(2)} </div>
        								<div class='wp'>${0}</div>
        							</div>`);
                        });
                        $('#total_a_payer').val(totalTicketDH);

                    } else {
                        // if(exist)
                        totalTicketDH = 0;
                        $.each(arraytick, function(index, val) {
                            // if (arraytick[index].code_bar) {
                            //     poids = arraytick[index].code_bar.slice(7, 12);
                            //     if (arraytick[index].unite == "kg" && arraytick[index].code_bar.startsWith(
                            //             "21") && arraytick[index].code_bar.length > 7) {
                            //         totalTicketDH = parseFloat(totalTicketDH) + parseFloat((arraytick[index]
                            //             .prix * ((poids * arraytick[index].qte) / 1000)));
                            //     } else if (arraytick[index].unite == "g" && arraytick[index].code_bar
                            //         .startsWith("21") && arraytick[index].code_bar.length > 7) {
                            //         totalTicketDH = parseFloat(totalTicketDH) + parseFloat((arraytick[index]
                            //             .prix * poids));
                            //     } else {
                            //         totalTicketDH = parseFloat(totalTicketDH) + parseFloat(arraytick[index]
                            //             .prix);
                            //     }

                            // } else {
                                totalTicketDH = parseFloat(totalTicketDH) + parseFloat(arraytick[index].prix);

                            // }
                        });
                        $.each(arraytick, function(key, value) {
                            // quantité = 0
                            // if (value.code_bar) {
                            //     if (value.unite == "kg" && value.code_bar.startsWith("21") && value.code_bar
                            //         .length > 7) {
                            //         poids = 0;
                            //         poids = value.code_bar.slice(7, 12);
                            //         quantité = (value.qte * poids) / 1000;
                            //     } else if (value.unite == "g" && value.code_bar.startsWith("21") && value
                            //         .code_bar.length > 7) {
                            //         poids = 0;
                            //         poids = value.code_bar.slice(7, 12);
                            //         quantité = value.qte * poids;
                            //     } else {
                            //         quantité = value.qte;

                            //     }
                            // } else {
                            //     quantité = value.qte;
                            // }

                            $(body_ticket).append(`
        							<div class='info clearfix suprimerart ${value.type_prod != 3 ? 'hide_bar' : '' } ${value.type_prod != 1 ? 'hide_kitchen' : '' } '  data-id="${value.idProd}">
        								<div class='wp'> ${value.name}</div>
        								<div class='wp'> x ${value.qte.toFixed(2)} </div>
        								<div class='wp'>${value.prix.toFixed(2)}  </div>
                                        <div class='wp'>${0}</div>
        							</div>`);
                        });

                        $('#total_a_payer').val(totalTicketDH);
                    }
                    if ($("#paie_methode").val() == "offert") {
                        $(total_ticket).html(
                            `<h2 class="calculated-price" style="font-size:1.7rem">Total : <p> ${totalTicketDH.toFixed(2)} DH</p></h2>` +
                            `<h2 class="offer-price" style="font-size:1.7rem">Total : <p> 0.00 DH</p></h2>`);
                        document.querySelectorAll('.calculated-price').forEach(x => x.classList.add('d-none'))
                        document.querySelectorAll('.offer-price').forEach(x => x.classList.remove('d-none'))
                    } else {
                        $(total_ticket).html(
                            `<h2 class="offer-price" style="font-size:1.7rem">Total : <p> 0.00 DH</p></h2>` +
                            `<h2 class="calculated-price" style="font-size:1.7rem">Total : <p> ${totalTicketDH.toFixed(2)} DH</p></h2>`
                        );
                        document.querySelectorAll('.calculated-price').forEach(x => x.classList.remove('d-none'))
                        document.querySelectorAll('.offer-price').forEach(x => x.classList.add('d-none'));
                    }
                    changeReste();
                    changeRemise();
                }
            }
            //----------------------------------------------------------------------------------------  Foncion de manipulation de ticket ----------------------------------------------------------------------------------------------










            // function settickt(arraytick, data, body_ticket = "#body_ticket", total_ticket = "#total_ticket") {
            //     $(body_ticket).html('');
            //     var is_exist = false;
            //     var i = 0;
            //     if (data) {
            //         $.each(arraytick, function(key, value) {
            //             console.log(key)
            //             if (data.id == value.idProd) {
            //                 is_exist = true;
            //                 i = key;
            //                 return;
            //             }
            //         });
            //         if (!is_exist) {
            //             var newprix = 0;
            //             var newqte = 0;
            //             if (data.uniteog == "kg") {
            //                 if (data.unite == "kg") {
            //                     newqte = parseFloat(data.qte);
            //                     newprix += parseFloat(data.prix) * parseFloat(data.qte);
            //                 } else {
            //                     newqte = parseFloat(data.qte) / 1000;
            //                     newprix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
            //                 }
            //             } else if (data.uniteog == "g") {
            //                 if (data.unite == "kg") {
            //                     newqte = parseFloat(data.qte) * 1000;
            //                     newprix += parseFloat(data.prix) * (parseFloat(data.qte) * 1000);
            //                 } else {
            //                     newqte = parseFloat(data.qte);
            //                     newprix += parseFloat(data.prix) * (parseFloat(data.qte));
            //                 }
            //             } else {
            //                 newqte = parseFloat(data.qte);
            //                 newprix = parseFloat(data.prix) * parseFloat(data.qte);
            //             }
            //             arraytick.push({
            //                 idProd: data.id,
            //                 prix: newprix,
            //                 qte: newqte,
            //                 name: data.name,
            //                 unite: data.uniteog,
            //             });
            //         } else {
            //             if (arraytick[i].unite == "kg") {
            //                 if (data.unite == "kg") {
            //                     arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
            //                     arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte);
            //                 } else {
            //                     arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte) / 1000;
            //                     arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
            //                 }
            //             } else if (arraytick[i].unite == "g") {
            //                 if (data.unite == "kg") {
            //                     arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte) * 1000;
            //                     arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) * 1000);
            //                 } else {
            //                     arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
            //                     arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte));
            //                 }
            //             } else {
            //                 arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
            //                 arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte);
            //             }
            //         }
            //     }
            //     totalTicketDH = 0;
            //     $.each(arraytick, function(index, val) {
            //         totalTicketDH = parseFloat(totalTicketDH) + parseFloat(arraytick[index].prix);
            //     });
            //     $.each(arraytick, function(key, value) {
            //         $(body_ticket).append(`
        //                     <div class='info clearfix suprimerart' data-id="${value.idProd}">
        //                         <div class='wp'> ${value.name}</div>
        //                         <div class='wp'> x ${value.qte.toFixed(2)} / ${value.unite}</div>
        //                         <div class='wp'>${value.prix.toFixed(2)} DH</div>
        //                     </div>`);
            //     });
            //     $('#total_a_payer').val(totalTicketDH);
            //     $(total_ticket).html(`<h2>Total : <p> ${totalTicketDH.toFixed(2)} DH</p></h2>`);
            //     changeReste();
            //     changeRemise();
            // }
            $('body').on('click', ".easy-get", () => {
                show_easy_numpad();
            });
            $('.catShowSpan').click(function() {
                $('.CategoryDiv').show();
                $('.catShowSpan').css("display", "none");
            });
            var artID = [];
            var mainticket = [];
            var ticketcons = [];
            $("#allow_op_form").on('submit', function(e) {
                e.preventDefault();
                let username = $("#code_manager_username").val();
                let password = $("#code_manager_password").val();
                $.ajax({
                    url: "{{ route('trav.allow_op') }}",
                    type: 'post',
                    data: {
                        username: username,
                        password: password,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        document.getElementById("remise_btn").classList.add('d-none');
                        //            document.getElementById("remise_input").classList.remove('d-none');
                        document.getElementById("offert_option").classList.remove('d-none');
                        document.getElementById("deleteticket").classList.remove('d-none');
                        localStorage.setItem('isManager', 1);
                        $("#code_manager_username").val('');
                        $("#code_manager_password").val('');
                        $("#code_manager").hide();
                    },
                    error: function(data) {
                        swal("il y a un problem technique...", "error");
                    }
                });
            })
            $('.cat').click(function() {
                var id_cat = $(this).data('id');
                var cat_nom = $(this).data('nom');
                $(".cat").removeClass('active');
                $(this).addClass('active');
                console.log(cat_nom);
                $.ajax({
                    url: "{{ route('trav.get_articles.bycat') }}",
                    type: 'get',
                    data: {
                        id: id_cat
                    },
                    success: function(data) {
                        $('#tableArticle tr').remove();
                        $('#articles').html(data);
                        //console.log(data);
                    },
                    error: function(data) {
                        swal("il y a un problem technique...", "error");
                    }
                });
            });
            $('body').on('click', ".suprimerart", function() {
                if (localStorage.getItem('isManager') == 1 || localStorage.getItem('nativeManager') == 1) {
                    var id = $(this).data('id');
                    var is_exist = false;
                    var i = 0;
                    $.each(mainticket, function(key, value) {
                        console.log(key)
                        if (id == value.idProd) {
                            is_exist = true;
                            i = key;
                            return;
                        }
                    });
                    console.log(mainticket)
                    mainticket.splice(i, 1)
                    console.log(mainticket)
                    settickt(mainticket, null);
                }
            });
            $('body').on('click', ".artLInk", function() {
                if ($(this).data('qte') > 0) {
                    //$('#ticktunpause').prop('disabled', true);
                    var id = $(this).data('id');
                    var prix = $(this).data('prix');
                    var name = $(this).data('art');
                    var unite = $(this).data('unite');
                    var qteact = $(this).data('qte');
                    var type_prod = $(this).data('type');
                    var code_bar = $(this).data('code');
                    var click_prod_remise = $(this).data('remise-max');
                    var qte_sca = $("#qte_scan").val();
                    console.log("QTE Scan " + qte_sca);
                    localStorage.setItem('lastest_code_bar', code_bar);
                    $(this).data('qte', qteact - 1);
                    data = {
                        id: id,
                        prix: prix,
                        qte: qte_sca,
                        name: name,
                        unite: unite,
                        uniteog: unite,
                        type_prod: type_prod,
                        remise_max: click_prod_remise,
                    };

                    if (unite == "qte") {
                        settickt(mainticket, data);
                    } else {
                        var id = $('#idmodel').val(data.id);
                        var prix = $('#prixmodel').val(data.prix);
                        var name = $('#artmodel').val(data.name);
                        var name = $('#uniteogmodel').val(data.unite);
                        $('#exampleModalCenterTitlemyModalUnite').html(
                            `${data.name} : ${qteact} / ${data.unite}`)
                        $('#myModalUnite').appendTo("body").modal('show');
                    }
                } else {
                    console.log("Not enough");
                }
            });
            $('body').on('click', "#saveqteunite", function() {
                var id = $('#idmodel').val();
                var prix = $('#prixmodel').val();
                var name = $('#artmodel').val();
                var unite = $('#unitemodel').val();
                var qteact = $('#qtemodel').val();
                var uniteog = $('#uniteogmodel').val();
                data = {
                    id: id,
                    prix: prix,
                    qte: qteact,
                    name: name,
                    unite: unite,
                    uniteog: uniteog,
                };
                settickt(mainticket, data);
                $('#myModalUnite').appendTo("body").modal('hide');
            });
            $('#btnPrintBar').click(function() {
                localStorage.setItem("ticket-type", "barman");
                /*	 	$("div#printThis").css("dislay", "block");*/
                var idPrnsl = $('#prsnl').val();
                var type = $('#type').val();
                var total_a_payer = $('#total_a_payer').val();
                var prix_payer = $('#prix_payer').val();
                var remise = $('#remise').val();
                var table = $('#table_list').val();
                var paie = $('#paie_methode').val();
                var client = $('#client_list').val();
                var remarque = $('#remarque').val();
                $.ajax({
                    url: "{{ route('trav.ticket-bar') }}",
                    type: 'post',
                    data: {
                        idPrnsl: idPrnsl,
                        ticket: mainticket,
                        type: type,
                        total_a_payer: total_a_payer,
                        prix_payer: prix_payer,
                        remise: remise,
                        table: table,
                        paie: paie,
                        client: client,
                        remarque: remarque,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(values) {
                        if (values.msg == "success") {
                            $('#hidden_nomeleve_ticket2').text(values.data.eleve.nom + " " +
                                values.data.eleve.prenom);
                            $('#hidden_ticket_num2').text(values.data.tickt.numtick);
                            $('#hidden_ticket_date2').text(values.data.tickt.date_operation);
                            $('#hidden_ticket_table2').text(values.new_data.table ? values
                                .new_data.table.nom : "  ");
                            $('#hidden_ticket_client2').text(values.new_data.client ? values
                                .new_data.client.nom : "  ");
                            $('.info_ticket_detail_cuisine2').text(values.new_data.remarque ?
                                values.new_data.remarque.remarque : "  ");
                            settickt(mainticket, null, '#hidden_body_ticket2',
                                '#hidden_total_ticket2');
                            @if (Auth::user()->canprint)
                                PrintElem('hiddenbox2');
                                localStorage.removeItem("ticket-type");
                            @else
                            @endif
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "erreur",
                                text: values.text,
                            });
                        }
                    },
                    error: function(values) {
                        Swal.fire({
                            icon: 'error',
                            title: 'error...',
                            text: 'il y a un problem technique ou cette ticket est vide...',
                        });
                    }
                });
            });
            $('#btnPrintCuisine').click(function() {
                localStorage.setItem("ticket-type", "kitchen");
                /*	 	$("div#printThis").css("dislay", "block");*/
                var idPrnsl = $('#prsnl').val();
                var type = $('#type').val();
                var total_a_payer = $('#total_a_payer').val();
                var prix_payer = $('#prix_payer').val();
                var remise = $('#remise').val();
                var table = $('#table_list').val();
                var paie = $('#paie_methode').val();
                var client = $('#client_list').val();
                var remarque = $('#remarque').val();
                $.ajax({
                    url: "{{ route('trav.ticket-cuisine') }}",
                    type: 'post',
                    data: {
                        idPrnsl: idPrnsl,
                        ticket: mainticket,
                        type: type,
                        total_a_payer: total_a_payer,
                        prix_payer: prix_payer,
                        remise: remise,
                        table: table,
                        paie: paie,
                        client: client,
                        remarque: remarque,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(values) {
                        if (values.msg == "success") {
                            $('#hidden_nomeleve_ticket2').text(values.data.eleve.nom + " " +
                                values.data.eleve.prenom);
                            $('#hidden_ticket_num2').text(values.data.tickt.numtick);
                            $('#hidden_ticket_date2').text(values.data.tickt.date_operation);
                            $('#hidden_ticket_table2').text(values.new_data.table ? values
                                .new_data.table.nom : "  ");
                            $('#hidden_ticket_client2').text(values.new_data.client ? values
                                .new_data.client.nom : "  ");
                            $('.info_t      icket_detail_cuisine2').text(values.new_data
                                .remarque ?
                                values.new_data.remarque.remarque : "  ");
                            settickt(mainticket, null, '#hidden_body_ticket2',
                                '#hidden_total_ticket2');
                            @if (Auth::user()->canprint)
                                PrintElem('hiddenbox2');
                                localStorage.removeItem("ticket-type");
                            @else
                            @endif
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "erreur",
                                text: values.text,
                            });
                        }
                    },
                    error: function(values) {
                        Swal.fire({
                            icon: 'error',
                            title: 'error...',
                            text: 'il y a un problem technique ou cette ticket est vide...',
                        });
                    }
                });
            });
            $('#retour').click(function() {
                localStorage.setItem("isRetour", 1);
                /*	 	$("div#printThis").css("display", "block");*/
                var idPrnsl = $('#prsnl').val();
                var type = $('#type').val();
                var total_a_payer = totalTicketDH;
                var prix_payer = $('#prix_payer').val();
                var remise = $('#remise').val();
                var table = $('#table_list').val();
                var paie = $('#paie_methode').val();
                var client = $('#client_list').val();
                $.ajax({
                    url: "{{ route('trav.retour') }}",
                    type: 'post',
                    data: {
                        idPrnsl: idPrnsl,
                        ticket: mainticket,
                        type: type,
                        total_a_payer: total_a_payer,
                        prix_payer: prix_payer,
                        remise: remise,
                        table: table,
                        paie: paie,
                        client: client,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(values) {
                        if (values.msg == "success") {
                            $('#title_ticket_ret').text("Ticket Retour : " + $(
                                '#title_ticket_ret').text());
                            $('#hidden_nomeleve_ticket').text(values.data.eleve.nom + " " +
                                values.data.eleve.prenom);
                            $('#hidden_ticket_num').text(values.data.tickt.numtick);
                            $('#hidden_ticket_date').text(values.data.tickt.date_operation);
                            $('#hidden_ticket_table').text(values.new_data.table ? values
                                .new_data.table.nom : "  ");
                            $('#hidden_ticket_client').text(values.new_data.client ? values
                                .new_data.client.nom : "  ");
                            settickt(mainticket, null, '#hidden_body_ticket',
                                '#hidden_total_ticket');
                            $('#prix_payer').val(0);
                            $('#remise').val(0);
                            $('#reste_ticket').hide();
                            $('#Remise_ticket').hide();
                            @if (Auth::user()->canprint)
                                PrintElem('hiddenbox');
                                setTimeout(function() {
                                    mainticket = [];
                                    settickt(mainticket, null)
                                }, 200);
                            @else
                                setTimeout(function() {
                                    mainticket = [];
                                    settickt(mainticket, null)
                                }, 200);
                            @endif
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "erreur",
                                text: values.text,
                            });
                        }
                        document.getElementById("remise_btn").classList.remove('d-none');
                        //            document.getElementById("remise_input").classList.add('d-none');
                        document.getElementById("offert_option").classList.add('d-none');
                        document.getElementById("deleteticket").classList.add('d-none');
                        document.getElementById("remise_btn").classList.remove('d-none');
                        localStorage.removeItem('isManager');
                        if (localStorage.getItem('nativeManager') == 1) {
                            document.getElementById("remise_btn").classList.add('d-none');
                            //           	 	document.getElementById("remise_input").classList.remove('d-none');
                            document.getElementById("offert_option").classList.remove('d-none');
                            document.getElementById("deleteticket").classList.remove('d-none');
                        }
                        setTimeout(function() {
                            localStorage.removeItem("isRetour");
                            $('#title_ticket_ret').text($('#title_ticket_ret').text()
                                .split('Ticket Retour : ').join(''));
                        }, 500)
                    },
                    error: function(values) {
                        Swal.fire({
                            icon: 'error',
                            title: 'error...',
                            text: 'il y a un problem technique ou cette ticket est vide...',
                        });
                    }
                });
                setTimeout(function() {
                    localStorage.removeItem("isRetour");
                }, 1500)
            });
            //btnPrint
            $('.ticket').click(function() {
                /*	 	$("div#printThis").css("display", "block");*/
                var idPrnsl = $('#prsnl').val();
                var type = $('#type').val();
                var total_a_payer = totalTicketDH;
                var prix_payer = $('#prix_payer').val();
                var remise = $('#remise').val();
                var table = $('#table_list').val();
                var paie = $('#paie_methode').val();
                var client = $('#client_list').val();
                $.ajax({
                    url: "{{ route('trav.ticket') }}",
                    type: 'post',
                    data: {
                        idPrnsl: idPrnsl,
                        ticket: mainticket,
                        type: type,
                        total_a_payer: total_a_payer,
                        prix_payer: prix_payer,
                        remise: remise,
                        table: table,
                        paie: paie,
                        client: client,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(values) {
                        if (values.msg == "success") {
                            $('#hidden_nomeleve_ticket').text(values.data.eleve.nom + " " +
                                values.data.eleve.prenom);
                            $('#hidden_ticket_num').text(values.data.tickt.numtick);
                            $('#hidden_ticket_date').text(values.data.tickt.date_operation);
                            $('#hidden_ticket_table').text(values.new_data.table ? values
                                .new_data.table.nom : "  ");
                            $('#hidden_ticket_client').text(values.new_data.client ? values
                                .new_data.client.nom : "  ");
                            settickt(mainticket, null, '#hidden_body_ticket',
                                '#hidden_total_ticket');
                            $('#prix_payer').val(0);
                            $('#remise').val(0);
                            $('#reste_ticket').hide();
                            $('#Remise_ticket').hide();
                            @if (Auth::user()->canprint)
                                PrintElem('hiddenbox');
                                setTimeout(function() {
                                    mainticket = [];
                                    settickt(mainticket, null)
                                }, 200);
                            @else
                                setTimeout(function() {
                                    mainticket = [];
                                    settickt(mainticket, null)
                                }, 200);
                            @endif
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "erreur",
                                text: values.text,
                            });
                        }
                        document.getElementById("remise_btn").classList.remove('d-none');
                        //            document.getElementById("remise_input").classList.add('d-none');
                        document.getElementById("offert_option").classList.add('d-none');
                        document.getElementById("deleteticket").classList.add('d-none');
                        document.getElementById("remise_btn").classList.remove('d-none');
                        localStorage.removeItem('isManager');
                        if (localStorage.getItem('nativeManager') == 1) {
                            document.getElementById("remise_btn").classList.add('d-none');
                            //           	 	document.getElementById("remise_input").classList.remove('d-none');
                            document.getElementById("offert_option").classList.remove('d-none');
                            document.getElementById("deleteticket").classList.remove('d-none');
                        }
                    },
                    error: function(values) {
                        Swal.fire({
                            icon: 'error',
                            title: 'error...',
                            text: 'il y a un problem technique ou cette ticket est vide...',
                        });
                    }
                });
            });
            $('#ticktpause').click(function() {
                /*	 	$("div#printThis").css("display", "block");*/
                var idPrnsl = $('#prsnl').val();
                var type = $('#type').val();
                var total_a_payer = $('#total_a_payer').val();
                var prix_payer = $('#prix_payer').val();
                var remise = $('#remise').val();
                var table = $('#table_list').val();
                var paie = $('#paie_methode').val();
                var client = $('#client_list').val();
                $.ajax({
                    url: "{{ route('trav.ticket.puase') }}",
                    type: 'post',
                    data: {
                        idPrnsl: idPrnsl,
                        ticket: mainticket,
                        type: type,
                        total_a_payer: total_a_payer,
                        prix_payer: prix_payer,
                        remise: remise,
                        table: table,
                        paie: paie,
                        client: client,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(values) {
                        if (values.msg == "success") {
                            mainticket = [];
                            $('#prix_payer').val(0);
                            $('#remise').val(0);
                            settickt(mainticket, null);
                            let optsCoutn = $('#optsCoutn');
                            $('#optsCoutn').text(parseInt(optsCoutn.data("optscoutn")) + 1);
                            $('#optsCoutn').data("optscoutn", parseInt(optsCoutn.data(
                                "optscoutn")) + 1);
                            //$('#ticktunpause').prop('disabled', false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "erreur",
                                text: values.text,
                            });
                        }
                    },
                    error: function(values) {
                        Swal.fire({
                            icon: 'error',
                            title: 'error...',
                            text: 'il y a un problem technique ou cette ticket est vide...',
                        });
                    }
                });
            });
            $("body").on('click', '.pausedtickbtn', function(e) {
                var id_opt = $(this).data("idopt");
                $.ajax({
                    url: "{{ route('trav.ticket.unpause.id', '') }}/" + id_opt,
                    type: 'get',
                    success: function(values) {
                        console.log(values.data)
                        ticketcons = [];
                        if (values.msg == "success") {
                            $('#prix_payer').val(values.data.tickt.prix_payer);
                            $('#remise').val(values.data.tickt.remise);
                            $('#paie_methode').val(values.data.tickt[0].methode_paie).change();
                            $('#client_list').val(values.data.tickt[0].id_client).change();
                            $('#table_list').val(values.data.tickt[0].id_table).change();
                            let optsCoutn = $('#optsCoutn');
                            $('#optsCoutn').text(parseInt(optsCoutn.data("optscoutn")) - 1);
                            $('#optsCoutn').data("optscoutn", parseInt(optsCoutn.data(
                                "optscoutn")) - 1);
                            //$('#ticktunpause').prop('disabled', true);
                            $.each(values.data.detail, function(key, value) {
                                settickt(mainticket, value);
                            })
                        }
                    }
                });
            });
            $("#ticktunpause").on('click', function(e) {
                $.ajax({
                    url: "{{ route('trav.get.ticket.pauseed') }}",
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(values) {
                        console.log(values.text)
                        $("#pausedtickits").modal('show');
                        $("#pausedtickitstable").html(" ")
                        $("#pausedtickitstable").html(values.text);
                    },
                    error: function(values) {
                        Swal.fire({
                            icon: 'error',
                            title: 'error...',
                            text: 'il y a un problem technique ou cette ticket est vide...',
                        });
                    }
                });
            });
            $("#deleteticket").on('click', function(e) {
                mainticket = [];
                $('#prix_payer').val(0);
                $('#remise').val(0);
                settickt(mainticket, null);
                //$('#ticktunpause').prop('disabled', false);
            });
            $('.numbre').click(function(event) {
                $('.poidsInputGroup').removeClass('is-focused');
                var val = $(this).val();
                var numbre = $('.poidsInput').val() + val.toString();
                console.log(numbre);
                $('.poidsInput').val(numbre);
                $('.poidsInputGroup').addClass('is-focused');
            });
            $('.reset').click(function() {
                location.reload();
            });
            $('.numbreC').click(function() {
                $('.poidsInput').val('');
            });
            $('.consulte').click(function() {
                $.ajax({
                    url: "{{ route('trav.consulte') }}",
                    type: 'get',
                    success: function(data) {
                        /*$("#example").dataTable().fnDestroy();*/
                        // console.log(data);
                        if (localStorage.getItem("isManager") == 1 || localStorage.getItem(
                                "nativeManager") == 1) {
                            $('#tableOperationConsult tr').remove();
                            $.each(data.operations, function(key, value) {
                                if (value.cloturage == null) {
                                    var cloturage = 'non';
                                } else {
                                    var cloturage = 'oui';
                                }
                                $('#tableOperationConsult').append(`<tr>
				<td> <span data-id="${value.id}" class="badge badge-pill badge-primary showtickdetail" > ${value.numtick}</span> </td>
				<td>${cloturage}</td>
				<td>${value.date_operation}</td>
				<td>
					<a  href="{{ url('trav/delete-opt/') }}/${value.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cette operation');" class=" btn-delete-tick  btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>
				 </td>
				</tr>`);
                            });
                        } else {
                            $('#tableOperationConsult tr').remove();
                            $.each(data.operations, function(key, value) {
                                if (value.cloturage == null) {
                                    var cloturage = 'non';
                                } else {
                                    var cloturage = 'oui';
                                }
                                $('#tableOperationConsult').append(`<tr>
				<td> <span data-id="${value.id}" class="badge badge-pill badge-primary showtickdetail" > ${value.numtick}</span> </td>
				<td>${cloturage}</td>
				<td>${value.date_operation}</td>
				<td>
					<a  href="{{ url('trav/delete-opt/') }}/${value.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cette operation');" class=" btn-delete-tick d-none btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>
				 </td>
				</tr>`);
                            });
                        }
                        $('#tableOperationConsult tr').remove();
                        $.each(data.operations, function(key, value) {
                            if (value.cloturage == null) {
                                var cloturage = 'non';
                            } else {
                                var cloturage = 'oui';
                            }
                            if (localStorage.getItem('isManager') == 1 || localStorage
                                .getItem('nativeManager') == 1) {
                                $('#tableOperationConsult').append(`<tr>
				<td> <span data-id="${value.id}" class="badge badge-pill badge-primary showtickdetail" > ${value.numtick}</span> </td>
				<td>${cloturage}</td>
				<td>${value.date_operation}</td>
				<td>
					<a  href="{{ url('trav/delete-opt/') }}/${value.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cette operation');" class=" btn-delete-tick btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>
				 </td>
				</tr>`);
                            } else {
                                $('#tableOperationConsult').append(`<tr>
				<td> <span data-id="${value.id}" class="badge badge-pill badge-primary showtickdetail" > ${value.numtick}</span> </td>
				<td>${cloturage}</td>
				<td>${value.date_operation}</td>
				<td>
					<a  href="{{ url('trav/delete-opt/') }}/${value.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cette operation');" class=" d-none btn-delete-tick btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>
				 </td>
				</tr>`);
                            }
                        });
                    },
                    error: function(values) {}
                });
            });
            ///@@@@@@@@@@@@@@@@@@ Imprimer_Cloturage @@@@@@@@@@@
            $('#Imprimer_Cloturage').click(function() {
                $.ajax({
                    url: "{{ route('trav.Imprimer_Cloturage') }}",
                    type: 'get',
                    success: function(data) {
                        PrintDiv(data);
                    },
                    error: function(values) {}
                });
            });
            $("body").on('click', '.showtickdetail', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ route('trav.tableOperationConsult') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data)
                        $('#tableProdConsult tr').remove();
                        $.each(data.prods, function(key, value) {
                            if (value.typeQte == null) {
                                var qte = ' ';
                            } else {
                                var qte = value.typeQte;
                            }
                            $('#tableProdConsult').append(
                                '<tr><td>' + value.lebelle +
                                '</td><td>' + value.prixTicket +
                                '</td><td>' + value.qte_prod + ' ' + qte +
                                '</td></tr>');
                        });
                        @if (Auth::user()->canprint)
                            $('#tableProdConsult').append(
                                `<tr >
							<td col="3">
								<button type="button" class="btn btn-success  " data-id="${id}"
								 style="" id="btnPrintcon" >Imprimer</button>
							</td>
						</tr>`);
                        @endif
                    },
                    error: function(values) {
                        swal("il y a un problem technique...", "error");
                    }
                });
            });
            $('.cloturage').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('trav.cloturage') }}",
                    type: 'get',
                    success: function(data) {
                        console.log(data);
                        if (data != "") {
                            Swal.fire({
                                title: 'votre cloturage est',
                                text: 'Total : ' + (data.montant - data
                                        .montant_offert) + ' , Espece : ' + data
                                    .montant_espece + ' Carte : ' + data.montant_carte +
                                    ' Offert : ' + data.montant_offert +
                                    ' Sur Compte : ' + data.montant_compte,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'oui'
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        url: "{{ route('trav.cloturage.confirm') }}",
                                        type: 'get',
                                        success: function(data) {
                                            console.log(data)
                                            location.reload();
                                        },
                                    });
                                    //location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'un cloturage exist déja ...',
                            });
                        }
                    },
                    error: function(values) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'un cloturage exist déja ...',
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    }
                });
            });
            $('.mode').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('trav.modeCaisse') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    },
                    error: function(values) {}
                });
            });
            $("#code_bar").on('keyup', function(e) {
                var valu = $(this);
                if (e.keyCode === 13) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('trav.getprodbycode_bar') }}",
                        data: {
                            code_bar: valu.val(),
                            qte: $("#qte_scan").val()
                        },
                        success: function(data) {
                            valu.val('');
                            if (data.msg == "success") {
                                remise_max = data.remise_max
                                settickt(mainticket, data.data);
                            } else {
                                valu.val('');
                            }
                        }
                    });
                }
            });
            $("body").on('click', '#btnPrintcon', function(e) {
                var id_opt = $(this).data("id");
                $.ajax({
                    url: "{{ route('trav.ticket.opt', '') }}/" + id_opt ,
                    type: 'get',
                    success: function(values) {
                        console.log(values.data)
                        ticketcons = [];
                        if (values.msg == "success") {
                            $('#hidden_nomeleve_ticket').text(values.data.eleve.nom ?? ' ' +" " + values.data.eleve.prenom ?? ' ');
                            $('#hidden_ticket_num').text(values.data.tickt.numtick);
                            $('#hidden_ticket_date').text(values.data.tickt.date_operation);
                            $('#hidden_ticket_table').text(values.new_data.table?.nom ?? '');
                            $('#hidden_ticket_client').text(values.new_data.client?.nom ?? '');
                            $('#hidden_prix_payer_model').val(values.data.tickt.prix_payer)
                            $('#hidden_remise_model').val(values.data.tickt.remise)
                            $('#remise').val(values.data.tickt.remise)
                            $.each(values.data.detail, function(key, value) {
                                settickt(ticketcons, value, '#hidden_body_ticket',
                                    '#hidden_total_ticket');
                            })
                            if ($("#paie_methode").val() == "offert") {
                                document.getElementById("ticket_calc_price").remove();
                            } else {
                                document.getElementById("ticket_free_price")?.remove();
                            }
                            PrintElem('hiddenbox');
                            setTimeout(function() {
                                $('#hidden_prix_payer_model').val(0);
                                $('#hidden_remise_model').val(0);
                                $('#reste_ticket').hide();
                                $('#Remise_ticket').hide();
                                $('#remise').val(0)
                                $('#paie_methode').val("espece").change();
                            }, 200)
                        }
                    }
                });
            });
            $("#prix_payer").on('change keyup', function(e) {
                settickt(mainticket, null, '#hidden_body_ticket', '#hidden_total_ticket');
                changeReste();
            });
            // remise_ticket
            $("#remise").on('keyup', function(e) {
                if (e.keyCode === 13) {
                    settickt(mainticket, null, '#hidden_body_ticket', '#hidden_total_ticket');
                }
            });

            function changeReste() {
                var prix_payer = $("#prix_payer").val() > 0 ? $("#prix_payer").val() : $('#hidden_prix_payer_model')
                    .val();
                var remise = $("#remise").val() > 0 ? $("#remise").val() : $('#hidden_remise_model').val();
                var totalTic = $('#total_a_payer').val();
                if (prix_payer > 0) {
                    $('#reste_ticket').show();
                    $('#reste_ticket').html(
                        `<h2>Reste : <p> ${(prix_payer - (totalTic - totalTic*remise/100)).toFixed(2) } DH</p></h2>`
                    );
                    $('#hidden_ticket_rest').show();
                    $('#hidden_ticket_rest').html(
                        `<h2>Reste : <p> ${(prix_payer - (totalTic - totalTic*remise/100)).toFixed(2) } DH</p></h2>`
                    );
                } else {
                    $('#hidden_ticket_rest').hide();
                    $('#reste_ticket').hide();
                }
            }

            function changeRemise() {
                var remise = $("#remise").val() > 0 ? $("#remise").val() : $('#hidden_remise_model').val();
                //var totalTic = $('#total_a_payer').val();
<<<<<<< HEAD
                // var re_total += remise * parseInt($("#qte_scan").val()) ; 
=======
                 // var re_total += remise * parseInt($("#qte_scan").val()) ; 
>>>>>>> 10e02ba090dc8c1aed6fad43681d61e57aa8b7f9
                if (remise > 0) {
                    $('#Remise_ticket').show();
                    if (remise <= remise_max) {
                        $('#Remise_ticket').html(
                            `<h2>Remise : <p>${remise}%</p> <br> Montant :  <p> ${((totalTicketDH)).toFixed(2) }</p></h2>`
                        );
                    } else {
                        $('#Remise_ticket').html(
<<<<<<< HEAD
                            `<h2>Remise : <p>${remise_max}%</p> <br> Montant :  <p> ${((totalTicketDH)).toFixed(2) }</p></h2>`
=======
                            `<h2>Remise : <p>${remise }%</p> <br> Montant :  <p> ${((totalTicketDH)).toFixed(2) }</p></h2>`
>>>>>>> 10e02ba090dc8c1aed6fad43681d61e57aa8b7f9
                        );
                    }


                    document.getElementById('#hidden_Remise_ticket').style.display = "";
                    $('#hidden_Remise_ticket').html(
                        `<h2>Remise : <p>${$('#remise').val()}%</p> <br> Montant : <p> ${(totalTicketDH ).toFixed(2) } DH</p></h2>`
                    );
                } else {
                    // $('#hidden_Remise_ticket').hide();
                    // $('#Remise_ticket').hide();
                }
            }
        });
        var elem = document.documentElement;
        /* View in fullscreen */
        function openFullscreen() {
            var btn = $('.fullscreen');
            if (btn.data('id') == 1) {
                btn.html('<span class="material-icons">fullscreen_exit</span>')
                btn.data("id", 0)
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.webkitRequestFullscreen) {
                    /* Safari */
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    /* IE11 */
                    elem.msRequestFullscreen();
                }
            } else {
                btn.html('<span class="material-icons">fullscreen</span>')
                btn.data("id", 1)
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    /* Safari */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    /* IE11 */
                    document.msExitFullscreen();
                }
            }
        }
        /* Close fullscreen */
        function closeFullscreen() {}

        function PrintElem(elem) {
            setTimeout(function() {
                var mywindow = window.open('', 'PRINT', 'height=400,width=600');
                if ($("#paie_methode").val() == "offert") {
                    document.querySelectorAll('.calculated-price').forEach(x => x.classList.add('d-none'));
                    document.querySelectorAll('.offer-price').forEach(x => x.classList.remove('d-none'));
                } else {
                    document.querySelectorAll('.calculated-price').forEach(x => x.classList.remove('d-none'));
                    document.querySelectorAll('.offer-price').forEach(x => x.classList.add('d-none'));
                }
                document.getElementById('hidden_ticket_paie_methode').innerText = document.getElementById(
                    'paie_methode').value;
                if (localStorage.getItem('ticket-type') == "kitchen") {
                    document.querySelectorAll('.hide_kitchen').forEach(x => x.classList.add('d-none'));
                }
                if (localStorage.getItem('ticket-type') == "barman") {
                    document.querySelectorAll('.hide_bar').forEach(x => x.classList.add('d-none'));
                }
                mywindow.document.write('<html><head>');
                mywindow.document.write("<link href=\"{{ url('assets/css/ticket.css') }}\" rel=\"stylesheet\">")
                mywindow.document.write('</head><body >');
                mywindow.document.write(document.getElementById(elem).innerHTML);
                mywindow.document.write('</body></html>');
                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/
                setTimeout(function() {
                    mywindow.print();
                    mywindow.close();
                    document.querySelectorAll('.hide_kitchen').forEach(x => x.classList.remove('d-none'));
                    document.querySelectorAll('.hide_bar').forEach(x => x.classList.remove('d-none'));
                }, 1000)
                return true;
            }, 50)
        }

        function PrintDiv(elem) {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');
            mywindow.document.write('<html><head>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(elem);
            mywindow.document.write('</body></html>');
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/
            setTimeout(function() {
                mywindow.print();
                mywindow.close();
            }, 1000)
            return true;
        }
        $('#hidden_Remise_ticket').hide();
        $('#Remise_ticket').hide();
    </script>
@endsection
