@extends('Admin.main')


@section('style')
<link href="{{url('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endsection


@section('script')
<script src="{{url('assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

    <script type="text/javascript">
    $(".editClassementByCat1").on("click",function() {

        var idcat1 = $(this).attr("val");
        var classement_value = $("#idcat1"+idcat1).val();
        var idcat_sm_niveau4= idcat1;
        var token = $("input[name='_token']").val();

        $.ajax({
        url: "<?php echo route('editClassementNiveau') ?>",
        method: 'POST',
        data: {idcat1:idcat1,
              classementcat1:classement_value,
             _token: token},
        success: function(data) 
        {


console.log(data);
            /*if(data=="")
            {
             swal({                         
             title: "success!",
             text: "Classement produit par niveau 4 effectue !!",
             button: "ok!",
             timer: 2500,
             type: "success",
             confirmButtonColor: "#4fa7f3"
             }); 
            }*/
            var res = data.split(";");
            if(res[0]=="error")
            {
                swal({                         
                 title: "erreur!",
                 text: res[1],
                 button: "ok!",
                 timer: 2500,
                 type: "danger",
                 confirmButtonColor: "#4fa7f3"
                 }); 
            }
            if(res[0]=="success")
            {
                 swal({                         
                 title: "success!",
                 text: "Classement modifier avec succée",
                 button: "ok!",
                 timer: 2500,
                 type: "success",
                 confirmButtonColor: "#4fa7f3"
                 }); 
            }

        }
        });
         return false;
    });
</script>
@endsection


@section('content')
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
        
                <div class="mdk-drawer-layout__content page ">
  {{ csrf_field() }}
                    <div class="container page__container">
                            <br><br><br>
                            <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                <div class="card-body">
                                    <div class="media flex-wrap align-items-center">
                                        <div class="media-left col-md-9">
                                            Listes des niveaux
                                        </div>
                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                            <a class="btn btn-success pull-right" href="{{ route('AddNiveau') }}"> <i class="fa fa-plus"></i>&nbsp;Ajouter niveau</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h2">Gérer les niveaux</h1>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                       
                                        <div class="col-lg-12">

                                            <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                                                @if (session('message'))
                                                    <div class="alert alert-success">
                                                        {{ session('message') }}
                                                    </div>
                                                @endif
                                                <table class="table table-centered table-bordered table-striped" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Niveau</th>
                                                            <th>Classement</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="search">


                                                        @foreach($niveaux as $niveau)



                                                        <tr>

                                                                
                                                            <td>

                                                                <span class="js-lists-values-employee-name">{{$niveau->Desc_niveau}}</span>

                                                            </td>
                                                                    
                                                            <td width="23%">
                          
                                                              <form class="form-inline ">
                                                                  
                                                                  
                                                                  <div class="form-group col-md-8">
                                                                    <input type="text"  class="form-control" id="idcat1{{$niveau->id}}" name="classement_cat1" value="{{$niveau->classement}}">
                                                                  </div>

                                                                  
                                                                  <button type="button" class="btn btn-primary btn-sm editClassementByCat1 col-md-3" val="{{$niveau->id}}" > <i class="material-icons">edit</i> </button>

                                                                </form>
                                                                
                                                            </td>

                                                            <td>
                                                                <div class="button-list">
                                                                   <a href="{{ route('deleteNiveau',["id"=>$niveau->id]) }}" class="btn btn-danger btn-sm">
                                                                        <i class="material-icons">close</i>
                                                                    </a>
                                                                   
                                                                    
                                                                    <a href="{{ route('editNiveau',["id"=>$niveau->id]) }}" type="button" class="btn btn-warning btn-sm">
                                                                        <i class="material-icons">edit</i>
                                                                    </a>

                                                                   
                                                                    
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                        

                                                        

                                                    </tbody>
                                                </table>
                                            </div>





                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                    </div>


                </div>
@endsection



@section('script')
   




    <script type="text/javascript">
          $(function(){
        'use strict';

         $('#myTable').DataTable({
          responsive: true,
           
         });
      });
    </script>






@endsection


