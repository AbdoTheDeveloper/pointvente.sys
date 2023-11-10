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
                                            Liste des articles
                                        </div>
                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                            <a class="btn btn-success pull-right" href="{{ route('admin.create_article') }}"> <i class="fa fa-plus"></i>&nbsp;Ajouter article</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h2">Gérer les articles</h1>
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
                                                            <th>Article</th>  
                                                            <th>Categorie</th>
                                                            <th>Type</th>
                                                            <th>Prix Achat</th>
                                                            <th>Prix Vente</th>
                                                            <th>Quantité</th>
                                                            <th>Quantité alerte </th>
                                                            
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="search">


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
"processing": true,
"serverSide": true,
"ajax": {
url: "{{route('admin.get_articles')}}"
},
"columns": [
{ data: 'lebelle',   name: 'lebelle',"render": function ( data, type, row ) {
                     
                     return  ` <p><img alt="${row.lebelle}" src="{{url('images/pro')}}/${row.img}"   width="150" class="rounded">
                                                                    ${row.lebelle}
                                                                </p>`;
                   }
},
{ data: 'nom_cat',   name: 'nom_cat', },
{ data: 'type',   name: 'type', "render": function ( data, type, row ) {
    
                            var type ="";
                            if(row.type==1)
                            type = "Local";
                            else if(row.type==0)
                            type = "Externe";
                            else type= "Charge";

                     return  `<div class="button-list"> 
                     ${type}
                        

                        </div>
                     
                     `;
                  ;
                    }},
{ data: 'prix_achat',   name: 'prix_achat', },
{ data: 'prix_vente',   name: 'prix_vente', },
{ data: 'qte',   name: 'qte', 
                "render": function ( data, type, row ) {
                    console.log(row)
                     return  `<div class="button-list">  ${row.qte} ${row.unite} 
                        </div>
                     
                     `;
                  ;
                    }},
{ data: 'qte_alert',   name: 'qte_alert', },
{ data: 'name_en',   name: 'name_en',
                "render": function ( data, type, row ) {
                    console.log(row)
                     return  `<div class="button-list"> <a  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément');" href="{{ url('admin/deleteProd/') }}/${row.id}/"  class="btn btn-danger btn-sm"> <i class="material-icons">close</i> </a> 
                        <a href="{{ url('admin/edit-article/') }}/${row.id}/" type="button" class="btn btn-warning btn-sm">
                      <i class="material-icons">edit</i> </a>
                     
                        </div>
                     
                     `;
                  ;
                    }
        },
]
} );
});
</script>
@endsection