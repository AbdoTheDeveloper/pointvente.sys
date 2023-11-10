@extends('Elev.main')
@section('style')
<!-- Flatpickr -->
<link type="text/css" href="{{url('assets/css/quill.css')}}" rel="stylesheet">
<link type="text/css" href="{{url('assets/css/quill.rtl.css')}}" rel="stylesheet">
<style type="text/css">
    
    .card-body
    {
        padding-top: 0 !important;
    }
    .active-header
    {
        background-color: rgba(33,150,243,.85) !important;
    }

    .active-header-title
    {
        color: white !important;
    }
    
    /**
   * Profile image component
     */
    .profile-header-container{
        margin: 0 auto;
        text-align: center;
    }

    .profile-header-img {
        padding: 54px;
    }

    .profile-header-img > img.img-circle {
        width: 120px;
        height: 120px;
        border: 2px solid #51D2B7;
    }

    .profile-header {
        margin-top: 43px;
    }

    /**
     * Ranking component
     */
    .rank-label-container {
        margin-top: -50px;
        /* z-index: 1000; */
        text-align: center;
    }

    .label.label-default.rank-label {
        background-color: rgb(255, 211, 0);
        padding: 5px 10px 5px 10px;
        border-radius: 27px;
    }
    


</style>
@endsection
@section('script')
<script>
$("#search-action").click(function() {

        var keyword= $(".search-keyword-action").val();
        var token = $("input[name='_token']").val();
        $.ajax({

            url: "<?php echo route('elev.action.change.action.search') ?>",
            method: 'POST',
            data: {
                keyword: keyword,
                _token: token
            },
            success: function(data) {
                console.log(data);
                $(".reload-action-search").html('');
                $(".reload-action-search").html(data.options);
            }
        });
});


$(".search-keyword-action").keyup(function() {

        var keyword= $(this).val();
        var token = $("input[name='_token']").val();
       
        $.ajax({

            url: "<?php echo route('elev.action.change.action.search') ?>",
            method: 'POST',
            data: {
                keyword: keyword,
                _token: token
            },
            success: function(data) {
                console.log(data);
                $(".reload-action-search").html('');
                $(".reload-action-search").html(data.options);
            }
        });

        
});


</script>

@endsection
@section('content')
<div class="bg-primary mdk-box js-mdk-box mb-0" style="height: 192px;" data-effects="parallax-background blend-background">
    <div class="mdk-box__bg">
         <div class="mdk-box__bg-front" style="background-image: url({{ url('assets/images/classebanner.jpg')}}); background-position:bottom;"></div>
    </div>
</div>
<div class="container page__container d-flex align-items-end position-relative mb-4">
    <div class="avatar avatar-xxl position-absolute bottom-0 left-0 right-0 ">
        <img src="{{ url('/images/eleve/'.Auth::user()->img) }}" alt="{{Auth::user()->nom}}" class="avatar-img rounded-circle border-3   " @if($eleve_delegue_exist) style="border: 3px solid #ffd300 !important" @endif>
        @if($eleve_delegue_exist)
        <div class="rank-label-container">
            <span class="label label-default rank-label" style="font-size: 14px;font-weight: bold;">Délégué</span>
        </div>
        @endif
    </div>
    
    <br>
    <ul class="nav nav-tabs-links flex" style="margin-left: 265px;">
        <li class="nav-item">
            <a href="{{route('eleve.index')}}" class="nav-link active">Tous les actions</a>
        </li>
        
    </ul>
    
</div>
<div class="container page__container mb-3">
    <div class="row flex-sm-nowrap">
        
        <div class="col-sm-auto mb-3 mb-sm-0 stky" style="width: 265px;">
            <center>
                <h1 class="h2 mb-1">{!! Auth::user()->nom.' '.Auth::user()->prenom.', '.$eleveage !!}</h1>
            </center>
            
            <p class="d-flex align-items-center mb-4">
                <a href="{{route('eleve.action.add')}}" class="btn btn-block btn-sm btn-success mr-2">Ajouter une action</a>
            </p>

            <p class="d-flex align-items-center mb-4">
                <a href="{{route('eleve.portfeuille.pdf')}}" class="btn btn-block btn-sm btn-primary mr-2">Exporter portfeuille</a>
            </p>


            <div class="text-muted d-flex align-items-center mb-2">
                <i class="material-icons mr-1">account_box</i>
                <div class="flex">{!! Auth::user()->classe->nom !!}</div>
            </div>
            <div class="text-muted d-flex align-items-center mb-2">
                <i class="material-icons mr-1">email</i>
                <div class="flex">{!! Auth::user()->email !!}</div>
            </div>
            <div class="text-muted d-flex align-items-center mb-4">
                <i class="material-icons mr-1">location_on</i>
                <div class="flex">{!! Auth::user()->adress !!}</div>
            </div>
         {{--    
            <h4>About me</h4>
            <p class="text-black-70 measure-paragraph">Fueled by my passion for understanding the nuances of cross-cultural advertising, I consider myself a forever student, eager to both build on my academic foundations in psychology and sociology and stay in tune with the latest digital marketing strategies through continued coursework.</p>
            <h4>Connect</h4>
            <p class="text-black-70 measure-paragraph">I’m currently working as a freelance marketing director and always interested in a challenge. Here’s how to reach out and connect.</p> --}}
        </div>
            <div class="col-sm">

                

                <div class="flex   mb-4 row">
                    @foreach($parcours as $parcour)

                    <?php 
                        $active_header="";
                        $active_header_title="";
                        if(isset($idpar)):
                            if($parcour->id==$idpar):
                                $active_header="active-header";
                                $active_header_title="active-header-title";
                            endif;
                        endif;
                    ?>
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header text-center {{$active_header}}" >
                                <label class="card-title mb-0"><a class=" {{$active_header_title}}" href="{{ route('eleve.parcour.index',['parcour'=>$parcour->id]) }}">{{$parcour->desc_parc}}</a></label>
                                
                            </div>
                            <a href="{{ route('eleve.parcour.index',['parcour'=>$parcour->id]) }}">
                                <img src="{{ url('images/parcour/'.$parcour->img) }}" alt="{{$parcour->desc_parc}}" style="width:100%;">
                            </a> 
                            
                        </div>
                    </div>
                    @endforeach
                </div>
                <form enctype="multipart/form-data"  >
                    @csrf
                    <div class="flex search-form search-form--light mb-4">
                        <button id="search-action" class="btn pr-3 " type="button" role="button" ><i class="material-icons">search</i></button>
                        <input type="text" class="form-control search-keyword-action" placeholder="Recherchez" id="searchSample02">
                    </div>
                </form>
            @if (session('success'))
            <div class="alert alert-success border-1 border-left-3 border-left-success d-flex alert-dismissible">
                
                <i class="material-icons text-success mr-3">check_circle</i>
                <div class="text-body">{{ session('success') }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="reload-action-search">
                
                    @if($actions->count()>0)
                @foreach($actions as $action )
                <div class="card">
                    <div class="card-header">
                       
                        
                        
                        <div class="align-items-center">
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">
                                    <img src="{{ url('images/parcour/'.$action->parcour->img)}}" width="100" alt="" class="rounded">
                                </a>
                                <div class="flex">
                                 <h4 class="card-title mb-0 pull-left" style="    display: inline-block;" >  {{$action->titre}} </h4>
                                 <br><b>{{$action->parcour->desc_parc}}  </b>
                                    @if($action->id_prof!=0)
                                    <br>
                                   Ajouter par :  <b> {{$action->prof->nom.' '.$action->prof->prenom}} </b>
                                    @endif
                                </div>

                            </div>
                           
                        </div>
                    </div>
                    <div class="card-body">

                        <fieldset>
                            <legend> Description</legend>
                            <div>
                                
                                {!!$action->desc_act !!}
                            </div>
                        </fieldset>
                       <br>
                      
                        <h4 class="card-title">liste des items</h4>
                   
                    
                    <ul class="list-group list-group-fit">
                        @foreach($action->item_action as $ia )
                        <li class="list-group-item">
                            <a href="javascript:void(0)" class="text-body text-decoration-0 d-flex align-items-center">
                                <strong>{{$ia->item->desc_Item}}</strong>
                                <i class="material-icons text-muted ml-auto" style="font-size: inherit;">check</i>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    @if($action->attachements->count()>0)
                       <hr>

                        <h4 class="card-title">Rajouter une pièce jointe</h4>
                        <div class=" align-items-center">
                            
                            
                            @foreach($action->attachements as $att)
                            @php( $file = "text_x16.png")
                            @if(array_key_exists(strtolower($att->type_attach) ,$filetype))

                            @php( $file = $filetype[strtolower($att->type_attach)])
                            @endif
                            <a href="{{$att->lien_attach}}" target="_blanck" class="badge badge-white badge-pill">
                                <img src="{{url('assets/images/icons/'.$file)}}">
                            {{strlen($att->taille_attach) < 20 ? $att->taille_attach : substr($att->taille_attach,0,20).'...' }}</a>
                            @endforeach
                        </div>
                        
                    @endif
                          </div>
                </div>
                @endforeach

                @else
                                <div class="alert alert-info border-1 border-left-3 border-left-info d-flex alert-dismissible">
                                    
                                    <i class="material-icons text-info mr-3">info</i>
                                    <div class="text-body">Aucune donnée</div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                @endif
             </div>
        </div>
    </div>
</div>

@endsection