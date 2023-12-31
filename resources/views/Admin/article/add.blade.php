@extends('Admin.main')
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".fileupload").on("change", function(event) {
                $(this).next().children(".form-control").val($(this).val().replace(/.*[\/\\]/, ''));
            });
        });
        $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endsection
@section('content')
    <!-- Header Layout Content -->
    <!-- Header Layout Content -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="mdk-drawer-layout__content page ">
        <div class="container-fluid page__container">
            <br><br>
            <div class="container page__container p-0">
                <div class="row m-0">
                    <div class="col-lg container-fluid page__container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                            <li class="breadcrumb-item active">Ajouter article</li>
                        </ol>
                        <h1 class="h2">Ajouter une nouveau produit</h1>
                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                            <div class="card-body">
                                <div class="media flex-wrap align-items-center">
                                    <div class="media-left col-md-8">
                                        Ajouter une nouveau produit
                                    </div>
                                    <div class="media-right  col-md-4 mt-2 mt-xs-plus-0 ">
                                        <a class="btn btn-success pull-right" href="{{ route('admin.index_article') }} "> <i
                                                class="fa fa-list"></i>&nbsp;Tous les articles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Nouveau article</h4>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-styled-left login-form">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li> <span class="text-semibold"> {{ $error }}</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('admin.store_article') }}"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @if (session('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    @if (session('message_error'))
                                        <div class="alert alert-danger">
                                            {{ session('message_error') }}
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Image :</label>
                                        <div class="col-sm-9">
                                            <input class="fileupload" type="file" name="img" id="img"
                                                style="position: absolute;  clip: rect(0px, 0px, 0px, 0px); ">
                                            <div class="bootstrap-filestyle input-group">
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                    <label for="img" class="btn btn-default ">
                                                        <span class="buttonText">Image article</span>
                                                    </label>
                                                </span>
                                                <input type="text" class="form-control " placeholder="" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Fournisseur</label>
                                        <select class="form-control select2-single   select2-single fournisseur"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true" name="id_frns"
                                            id="fournisseur">
                                            <option value="0">-----------</option>
                                            @foreach ($fournisseurs as $fournisseur)
                                                <option value="{{ $fournisseur->id }}"
                                                    data-val="{{ $fournisseur->nom_frns }}">{{ $fournisseur->nom_frns }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Categorie
                                            article:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2-single  " name="id_cat" id="id_cat">
                                                @foreach ($cats as $cat)
                                                    <option <?php if (Request::old('id_cat') == $cat->id) {
                                                        echo 'selected';
                                                    } ?> value="{{ $cat->id }}">
                                                        {{ $cat->nom_cat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Unite
                                            article:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2-single  " name="unite" id="unite">
                                                <option <?php if (Request::old('unite') == 'qte') {
                                                    echo 'selected';
                                                } ?> value="qte">Quantité</option>
                                                <option <?php if (Request::old('unite') == 'kg') {
                                                    echo 'selected';
                                                } ?> value="kg">KG</option>
                                                <option <?php if (Request::old('unite') == 'g') {
                                                    echo 'selected';
                                                } ?> value="g">G</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">lebelle article
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="lebelle" value="{{ Request::old('lebelle') }}" name="lebelle"
                                                type="text" class="form-control" placeholder="lebelle article">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Code bar article
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="code_bar" value="{{ Request::old('code_bar') }}" name="code_bar"
                                                type="text" class="form-control" placeholder="Code bar article">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">type
                                            article:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2-single  " name="type" id="type">
                                                <option <?php if (Request::old('type') == '1') {
                                                    echo 'selected';
                                                } ?> value="1">Local</option>
                                                <option <?php if (Request::old('type') == '0') {
                                                    echo 'selected';
                                                } ?> value="0">Externe</option>
                                                <option <?php if (Request::old('type') == '2') {
                                                    echo 'selected';
                                                } ?> value="2">Charge</option>
                                                <option <?php if (Request::old('type') == '3') {
                                                    echo 'selected';
                                                } ?> value="3">Bar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Prix Achat
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="prix_achat" value="{{ Request::old('prix_achat') }}"
                                                name="prix_achat" type="text" class="form-control"
                                                placeholder="prix achat article">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Prix vente
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="prix_vente" value="{{ Request::old('prix_vente') }}"
                                                name="prix_vente" type="text" class="form-control"
                                                placeholder="prix vente article">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quantité
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="qte" value="{{ Request::old('qte') }}" name="qte"
                                                type="text" class="form-control" placeholder="Quantité ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quantité alerte
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="qte_alert" value="{{ Request::old('qte_alert') }}"
                                                name="qte_alert" type="text" class="form-control"
                                                placeholder="Quantité alerte">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Remise Max
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="remise_max" value="{{ Request::old('remise_max') }}"
                                                name="remise_max" type="text" class="form-control"
                                                placeholder="Remise Max">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-success pull-right">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('Admin.inc.footer')
        </div>
    </div>
@endsection
