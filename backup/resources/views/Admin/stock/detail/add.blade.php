@extends('Admin.main')

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
                        <li class="breadcrumb-item active">Ajouter produit</li>
                    </ol>
                    <h1 class="h2">Ajouter un nouveau produit</h1>

                    <div class="card border-left-3 border-left-primary card-2by1 mt50">
                        <div class="card-body">
                            <div class="media flex-wrap align-items-center">
                                <div class="media-left col-md-8">
                                    Ajouter un nouveau produit
                                </div>
                                <div class="media-right  col-md-4 mt-2 mt-xs-plus-0 ">
                                    <a class="btn btn-success pull-right" href="{{ route('admin.detail.stock.index',['id' =>$id ]) }} "> <i class="fa fa-list"></i>&nbsp;Tous les niveaux</a>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Nouveau niveau</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('admin.detail.stock.save')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_operationStock" value="{{$id}}">

                                <div class="form-group">
                                    <label for="exampleInputName1">Code Bar</label>
                                    <input type="text" class="form-control code_bar" name="code_bar" id="code_bar" placeholder="Code bar">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputName1">Categorie</label>
                                    <select class="form-control select2-single   select2-single cat" data-select2-id="1" tabindex="-1" aria-hidden="true" name="id_cat" id="id_cat">
                                        <option value="0">-----------</option>
                                        @foreach($cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nom_cat }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Produits</label>
                                    <select class="form-control select2-single   select2-single prod" data-select2-id="1" tabindex="-1" aria-hidden="true" name="id_prod" id="prod">
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="exampleInputqte">Quantité</label>
                                        <input type="number" class="form-control qte" id="exampleInputqte" placeholder="Quantité" name="qte" style="padding: 2em;" value="{{ old('prix') }}" step="any">
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleInputprix">Prix</label>
                                        <input type="number" class="form-control prixEntre" id="exampleInputprix" placeholder="prix" name="prix" style="padding: 2em;" value="{{ old('prix') }}" step="any">
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
        <br><br><br><br><br><br><br><br><br>
        @include('Admin.inc.footer')
    </div>


</div>
@endsection

@section('script')
<script src="{{url('assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(document).on('keypress', '#code_bar', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                let code_bar = $("#code_bar").val();

                $.ajax({
                    url: "{{ route('admin.get_prod_by_code') }}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        code_bar: code_bar,
                        _token: "{{ csrf_token() }}",

                    },
                    success: function(data) {
                        console.log(data);
                        $('#prod').empty();
                        $.each(data.prods, function(key, value) {
                            $('#prod').append('<option value="' + value.id + '" data-val="' + value.lebelle + '">' + value.lebelle + ' (' + value.code_bar + ') </option>');
                        });
                    },
                    error: function(values) {
                        console.log('il y a un problem technique...');
                    }
                });
            }
        });
        $('.cat').change(function() {
            idcat = $("select#id_cat option").filter(":selected").val();


            $.ajax({
                url: "{{ route('admin.get_articles_stock') }}",
                type: 'get',
                dataType: "json",
                data: {
                    id: idcat
                },
                success: function(data) {
                    console.log(data);
                    $('#prod').empty();
                    $.each(data.prods, function(key, value) {
                        $('#prod').append('<option value="' + value.id + '" data-val="' + value.lebelle + '">' + value.lebelle + ' (' + value.code_bar + ') </option>');
                    });
                },
                error: function(values) {
                    console.log('il y a un problem technique...');
                }
            });
        });


    });
</script>

@endsection