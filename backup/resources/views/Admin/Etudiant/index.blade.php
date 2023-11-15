@extends('Admin.main')
@section('style')
<style>
    .wrapper { margin: 0 auto; position:relative; z-index:1;overflow:hidden;}
    .modal-backdrop{
        display: none !important;
    }
    </style>
@endsection
@section('content')
<!-- Header Layout Content -->
<!-- Header Layout Content -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modelcard">
         
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary"  onclick="PrintElem('modelcard')">Print</button>
          </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModalSold" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitlemyModalSold" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitlemyModalSold">Ajouter Sold</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
            <div class="form-group row">
                <label for="quiz_title" class="col-sm-3 col-form-label form-label">Type:</label>
                <div class="col-sm-9">
                    <select class="form-control select2-single  " name="type" id="typesold">
                        
                        <option  value="R">Restaurant</option>
                        <option  value="B">Buvette</option>
                        
                </select>
                    </div>
            </div>
            <div class="form-group row">
                <label for="quiz_title" class="col-sm-3 col-form-label form-label">Sold :</label>
                <div class="col-sm-9">
                    <input id="sold"  name="sold" type="number" class="form-control" placeholder="Sold" > 
                </div>
            </div>
            <div class="form-group row">
                <label for="quiz_title" class="col-sm-3 col-form-label form-label">remrque :</label>
                <div class="col-sm-9">
                 <textarea rows="3" name="remrque" class="form-control" id="remrque"></textarea>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="savesold" >Enregistrer</button>
          </div>
      </div>
    </div>
  </div>


<div class="mdk-drawer-layout__content page ">
    <div class="container-fluid page__container">
        <br><br><br>
        <div class="card border-left-3 border-left-primary card-2by1 mt50">
            <div class="card-body">
                <div class="media flex-wrap align-items-center">
                    <div class="media-left col-md-9">
                        Listes des clients
                    </div>
                    <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                        
                        <a class="btn btn-success pull-right" href="{{ route('ajouter-etudiants') }}"> <i class="fa fa-plus"></i>&nbsp;Ajouter un client</a>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="h2">Gérer les clients</h1>
        <div class="card">
            <div class="card-body">
               
               
                <div class="row">
                    
                    <div class="col-lg-12">
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
                        <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                            
                            <table class="table table-centered table-bordered table-bordred table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        
                                        <th class="nowrap">Client</th>
                                        <th class="nowrap">Email</th>
                                        <th class="nowrap">Adress</th>
                                        <th class="nowrap">Tel</th>
                                        <th class="nowrap"></th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">
                                 
                                </tbody>
                            </table>
                            {{--  <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                                    <ul class="pagination">
                                        
                                        {{$eleves->links()}}
                                        
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
<!--
        <h1 class="h2">Gérer les élèves</h1>
        <div class="card">
            <div class="card-body">
               
               
                <div class="row">
                    
                    <div class="col-lg-12">
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

                        <form method="post" id="pdfform" target="_blank" action="{{ route('admin.export_pdf_card') }}" enctype="multipart/form-data"   >
                            {{ csrf_field() }}
                            <div class="list-group list-group-fit">
                                    
                                <div class="list-group-item">
                                    <div role="group" aria-labelledby="label-adresse" class="m-0 form-group">
                                        <div class="form-row">
                                            <label for="quiz_title" class="col-sm-3 col-form-label form-label">Niveau:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-single   form-control-prepended select2-single" name="id_niv" id="id_niv">
                                                    <option value="">Séléctionnez niveau</option>
                                                    @foreach($niveaux as $niveau)
                                                    <option <?php if(Request::old('id_niv')==$niveau->id) echo "selected"; ?>  value="{{$niveau->id}}">{{$niveau->Desc_niveau}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div role="group" aria-labelledby="label-adresse" class="m-0 form-group">
                                        <div class="form-row">
                                            <label for="quiz_title" class="col-sm-3 col-form-label form-label">Classe:</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-single   select2-single" name="id_class" id="id_class">
                                                    <option>Séléctionner nouveau pour charger les classes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group row mb-0">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-success pull-right">Export</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                        
                    </div>
                </div>
            </div>
            
        </div>
      -->
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

<script src="{{url('assets/js/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript">
$(function(){
'use strict';

$('#myTable').DataTable( {
"processing": true,
"serverSide": true,
"ajax": {
url: "{{route('getetudiants')}}"
},
"columns": [
{ data: 'nom',   name: 'nom', },
{ data: 'email',   name: 'email', },
{ data: 'adress',   name: 'adress', },
{ data: 'tele',   name: 'tele', },
{ data: 'name_en',   name: 'name_en',
                "render": function ( data, type, row ) {
                    console.log(row)
                     return  `<div class="button-list">
                      <a  href="{{ url('admin/supprimer-etudiants/') }}/${row.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément');" class="btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>
                      <a  href="{{ url('admin/etudiants/summary/') }}/${row.id}/"  class="btn btn-success btn-sm">
                     <i class="material-icons">print</i> </a>
                     <a href="{{ url('admin/modifier-etudiants/') }}/${row.id}/" type="button" class="btn btn-warning btn-sm">
                      <i class="material-icons">edit</i> </a>
                      <button type="button" class="btn btn-primary btn-sm cardinfo" data-id="${row.id}" >
                        <i class="material-icons">person_outline</i>
</button>
<button type="button" class="btn btn-success btn-sm modelsold" data-id="${row.id}" >
                        <i class="material-icons">money</i>
</button>
                       </div>`;
                  ;
                    }
        },
]
} );


$('body').on("click" ,".cardinfo", function(){
	 	var id_eleve=$(this).data('id');
       
	 	console.log(id_eleve);
   		$.ajax({
	            url: "{{ route('admin.get_card_eleve') }}",
	            type: 'get',
	            data:{id:id_eleve},
	            success: function (data)
	            {
                    $("#modelcard").html(data)
                    $('#myModal').appendTo("body").modal('show');
                }
           });



});

$('body').on("click" ,".modelsold", function(){
         var id_eleve=$(this).data('id');
        $("#savesold").data("id",id_eleve);
        $('#myModalSold').appendTo("body").modal('show');

});

$('body').on("click" ,"#savesold", function(){
         var id_eleve=$(this).data('id');


         var typesold=$("#typesold").val();
         var sold=$("#sold").val();
         var remrque=$("#remrque").val();
         
        
	 	console.log(id_eleve);
   		$.ajax({
	            url: "{{ route('admin.add_sold_eleve') }}",
	            type: 'post',
                data:{id:id_eleve,
                    type: typesold,
                    sold:sold,
                    remrque:remrque

                
                
                },
                beforeSend: function (xhr) { // Add this line
                     xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
                    },
	            success: function (values)
	            {
                    $("#sold").val("");
                    $("#remrque").val("");
                    if(values.msg == "success")
								{
								Swal.fire({
									  icon: 'success',
									  title: 'opération réussie!',
									  text: values.text,
								});
				             	
								}
								else{
									Swal.fire({
									icon: 'error',
									title: "erreur",
									text: values.text,
								});
					}
                   
                }
           });



});

// $('#pdfform').submit(function(e){
         
    
//     e.preventDefault();

//       var form = document.getElementById('pdfform');
	 	
//    		$.ajax({
//                 url: "{{ route('admin.export_pdf_card') }}",
//                 type: 'POST',
//                 data: new FormData(form),
//                    dataType: 'text',  
//                    cache: false,
//                    contentType: false,
//                    processData: false,
//                 beforeSend: function (xhr) { // Add this line
//         xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
//                     },
// 	            success: function (data)
// 	            {
//                     console.log(data);
//                     Popup(data);
//                 }
//            });


//  return false;
// });

    $("select[name='id_niv']").change(function(){
            var id_niv = $(this).val();
            var token = $("input[name='_token']").val();

            $.ajax({
            url: "<?php echo route('select-niveau-classes-etudiant') ?>",
            method: 'POST',
            data: {id_niv:id_niv, _token:token},
            success: function(data) {

            console.log(data);
            $("#id_class").html('');
            $("#id_class").html(data.options);
            }
            });
    });


});
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
function Popup(data) {
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

mywindow.document.write('<html><head><title>' + document.title  + '</title>');
mywindow.document.write('<link rel="stylesheet" href="{{url('assets/css/app.css')}}" type="text/css" />'); 
mywindow.document.write('</head><body >');
mywindow.document.write(data);
mywindow.document.write('</body></html>');

mywindow.document.close(); // necessary for IE >= 10
mywindow.focus(); // necessary for IE >= 10*/

mywindow.print();
mywindow.close();

return true;
}
</script>
@endsection
