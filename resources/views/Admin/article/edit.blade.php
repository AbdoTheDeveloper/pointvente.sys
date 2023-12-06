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
    <div class="mdk-drawer-layout__content page ">
        <div class="container-fluid page__container">
            <br><br>
            <div class="container page__container p-0">
                <div class="row m-0">
                    <div class="col-lg container-fluid page__container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                            <li class="breadcrumb-item active">Modifier les informations du produit</li>
                        </ol>
                        <h1 class="h2">Modifier les informations du produit</h1>
                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                            <div class="card-body">
                                <div class="media flex-wrap align-items-center">
                                    <div class="media-left col-md-8">
                                        Modifier les informations du produit
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
                                <h4 class="card-title">Modifier les informations du catégorie </h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.update_article') }}"
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
                                    <input type="hidden" name="id" value="{{ $prod->id }}">
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Image :</label>
                                        <div class="col-sm-9">
                                            <p><img alt=" {{ utf8_decode($prod->lebelle) }} "
                                                    src="{{ url('images/pro/' . $prod->img) }}" width="150"
                                                    class="rounded">
                                            </p>
                                            <input class="fileupload" type="file" name="img" id="img"
                                                style="position: absolute;  clip: rect(0px, 0px, 0px, 0px); ">

                                            <div class="bootstrap-filestyle input-group">
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                    <label for="img" class="btn btn-default ">
                                                        <span class="buttonText">Image Categorie</span>
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
                                                <option <?php if ($prod->id == $fournisseur->id_frns) {
                                                    echo 'selected';
                                                } ?> data-val="{{ $fournisseur->nom_frns }}">
                                                    {{ $fournisseur->nom_frns }}
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
                                                    <option <?php if ($prod->id_cat == $cat->id) {
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
                                                <option <?php if ($prod->unite == 'qte') {
                                                    echo 'selected';
                                                } ?> value="qte">Quantité</option>
                                                <option <?php if ($prod->unite == 'kg') {
                                                    echo 'selected';
                                                } ?> value="kg">KG</option>
                                                <option <?php if ($prod->unite == 'g') {
                                                    echo 'selected';
                                                } ?> value="g">G</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">lebelle article
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="lebelle" value="{{ $prod->lebelle }}" name="lebelle"
                                                type="text" class="form-control" placeholder="lebelle article">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Code bar article
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="code_bar" value="{{ $prod->code_bar }}" name="code_bar"
                                                type="text" class="form-control" placeholder="Code bar article">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">type
                                            article:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2-single  " name="type" id="type">
                                                <option <?php if ($prod->type == '1') {
                                                    echo 'selected';
                                                } ?> value="1">Local</option>
                                                <option <?php if ($prod->type == '0') {
                                                    echo 'selected';
                                                } ?> value="0">Externe</option>
                                                <option <?php if ($prod->type == '2') {
                                                    echo 'selected';
                                                } ?> value="2">Charge</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Prix Achat
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="prix_achat" value="{{ $prod->prix_achat }}" name="prix_achat"
                                                type="text" class="form-control" placeholder="prix achat article">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Prix vente
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="prix_vente" value="{{ $prod->prix_vente }}" name="prix_vente"
                                                type="text" class="form-control" placeholder="prix vente article">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quantité
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="qte" value="{{ $prod->qte }}" name="qte"
                                                type="text" class="form-control" placeholder="Quantité ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quantité alerte
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="qte_alert" value="{{ $prod->qte_alert }}" name="qte_alert"
                                                type="text" class="form-control" placeholder="Quantité alerte">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Remise Max
                                            :</label>
                                        <div class="col-sm-9">
                                            <input id="remise_max" value="{{ $prod->remise_max }}" name="remise_max"
                                                type="text" class="form-control" placeholder="Remise Max">
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
