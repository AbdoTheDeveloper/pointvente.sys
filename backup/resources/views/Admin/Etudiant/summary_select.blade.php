
@extends('Admin.main')


@section('style')
<link href="{{url('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endsection




@section('content')
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
        
                <div class="mdk-drawer-layout__content page ">
                    {{ csrf_field() }}
                    <div class="container page__container">
                            <br><br><br>
                            

                            <h1 class="h2"> Total pour : {{$client->nom}} {{$client->prenom}} </h1>
                            <div class="card">
                                <div class="card-body">

                                    <form target="_blank" action="{{route('etudiants.summary_data',$client->id)}}" id="addform" method="post" name="form_warenbewegungen" enctype="multipart/form-data">
               
                                      @csrf 

                                      <div class="row">
                                        <input type="text" hidden readonly name="client_id" value="{{$client->id}}" >
                                                  <div class="form-group col-6 offset-md-3">
                                                      <label for="exampleInputqte">date Début</label>
                                                      <input value="{{date('Y-m-d')}}" type="date" class="form-control id_trav dateD" id="exampleInputqte" placeholder="date Debut" name="dateD" style="padding: 2em;">
                                                    </div>
                                                    <div class="form-group col-6 offset-md-3">
                                                      <label for="exampleInputqte">date Fin</label>
                                                      <input value="{{date('Y-m-d')}}" type="date" class="form-control id_trav dateF" id="exampleInputqte" placeholder="date fi" name="dateF" style="padding: 2em;">
                                                    </div>
                                        </div>
                                        <div class="offset-md-3 text-zero">
                                            <button type="submit" class="btn btn-primary btn-lg  mr-1 ">Total</button>
                                          </div>
                                         
                                        </form>
                                    </div>

                                </div>
                            </div>
                    </div>

                  
                  
                
@endsection




@section('script')


<script>

$("#exportexcel" ).on( "click", function( event ) {
            
         
         var form = $( "#addform" );
         var datafrom = new FormData(document.getElementById("addform"))
         $.ajax({
            type: "POST",
            url: "{{route('admin.recette.export.excel')}}",
            data: datafrom,
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
            

                var blob=new Blob([data]);
            var link=document.createElement('a');
            link.href=window.URL.createObjectURL(blob);
            link.download="Recette_<?php echo date('Y-m-d') ?>.xls";
            link.click();
            $( ".loadingex" ).hide();      
                     
                                          
            }
        });
       
        });
  </script>

@endsection