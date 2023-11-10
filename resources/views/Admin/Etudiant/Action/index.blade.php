@extends('Admin.main')


@section('style')
   
    <link href="{{url('assets/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/libs/datatables/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />

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
                                            Listes des actions
                                        </div>
                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                            <a class="btn btn-success pull-right"> <i class="fa fa-plus"></i>&nbsp;Ajouter une actions</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h2">Gérer les actions</h1>
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
                                                            <th>ID</th>
                                                            <th>Titre</th>
                                                            <th>Professeur</th>
                                                            <th>Eleve</th>
                                                            <th>Date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="search">


                                                        @foreach($actions as $action)



                                                        <tr>

                                                            <td>
                                                                {{$action->id}}
                                                            </td>    
                                                            <td>

                                                                <span class="js-lists-values-employee-name">{{$action->titre}}</span>

                                                            </td>
                                                        
                                                            <td>

                                                                <span class="js-lists-values-employee-name">{{$action->parcour->desc_parc}}</span>

                                                            </td>

                                                            <td>

                                                                <span class="js-lists-values-employee-name">{{$action->prof->nom." ".$action->prof->prenom}}</span>

                                                            </td>

                                                            <td>

                                                                <span class="js-lists-values-employee-name">{{$action->eleve->nom." ".$action->eleve->prenom}}</span>

                                                            </td>

                                                            <td>

                                                                <span class="js-lists-values-employee-name">{{$action->niveau->date_saisie}}</span>

                                                            </td>
                                                            
                                                            
                                       

                     
                                                            <td>
                                                                <div class="button-list">
                                                                   <a href="{{ route('deleteAction',["id"=>$action->id]) }}" class="btn btn-danger btn-sm">
                                                                        <i class="material-icons">close</i>
                                                                    </a>
                                                                   
                                                                    
                                                                    <a href="{{ route('editClasse',["id"=>$action->id]) }}" type="button" class="btn btn-warning btn-sm">
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
   

    <!-- Required datatable js -->
    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{url('assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{url('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{url('assets/plugins/datatables/buttons.print.min.js')}}"></script>


    <script type="text/javascript">
          $(function(){
        'use strict';

         $('#myTable').DataTable({
          responsive: true,
           
         });

       

      });
    </script>
@endsection


