@extends('Admin.main')
@section('script')
<script type="text/javascript">
    
    $( document ).ready(function() {


                
  $(".fileupload" ).on( "change", function( event ) {

                $(this).next().children(".form-control").val($(this).val().replace(/.*[\/\\]/, ''));
});


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
                                            <li class="breadcrumb-item active">Modifier les informations du catégorie</li>
                                        </ol>
                                        <h1 class="h2">Modifier les informations du catégorie</h1>

                                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                            <div class="card-body">
                                                <div class="media flex-wrap align-items-center">
                                                    <div class="media-left col-md-8">
                                                        Modifier les informations du catégorie 
                                                    </div>
                                                    <div class="media-right  col-md-4 mt-2 mt-xs-plus-0 ">
                                                        <a class="btn btn-success pull-right" href="{{ route('admin.index_cat') }} "> <i class="fa fa-list"></i>&nbsp;Tous les Categories</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Modifier les informations du catégorie </h4>
                                            </div>
                                            <div class="card-body">
                                                  <form method="POST" action="{{ route('admin.update_cat') }}"  enctype="multipart/form-data"   >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$cat->id}}">

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
                                                            <p><img alt=" {{ utf8_decode($cat->nom_cat) }} " src="{{url('images/cat/'.$cat->img)}}"   width="150" class="rounded">
                                                            </p>

                                                            
                                                                     <input
                                            class="fileupload"
                                            type="file"
                                            name="img"
                                            id="img"
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

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Nom Categorie :</label>
                                                        <div class="col-sm-9">
                                                            <input id="nom" value="{{$cat->nom_cat}}" name="nom" type="text" class="form-control" placeholder="Nom Categorie" > 
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Type Categorie:</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2-single  " name="type" id="type">
                                                                
                                                                <option <?php if($cat->type=="R"){echo "selected";} ?> value="R">Restaurant</option>
                                                                <option <?php if($cat->type=="B"){echo "selected";} ?> value="B">Restaurant</option>
                                                                <option <?php if($cat->type=="Mix"){echo "selected";} ?> value="Mix">Mix</option>
                                                               
                                                        </select>
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
