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
                            

                            <h1 class="h2">Gérer les Cloturages</h1>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                            @if(Session::has('message'))
                                          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          @if (session('success'))
                                          <div class="alert alert-danger border-1 border-left-3 border-left-success d-flex alert-dismissible">							
                                              <i class="material-icons text-success mr-3">check_circle</i>
                                              <div class="text-body">{{ session('success') }}</div>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          @endif
                                          @if (session('error'))
                                          <div class="alert alert-danger alert-styled-left login-form">
                                              <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                          class="sr-only">Close</span></button>
                                          <span class="text-semibold"> {{ session('error') }}</span>
                                          </div>
                                          @endif
                                          
                                      </div> 
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <div class="form-group">
                                                <label for="exampleInputName1">Nom travailleur</label>
                                                <select class="form-control select2-single   id_trav" data-select2-id="1" tabindex="-1" aria-hidden="true" name="id_trav" id="id_trav">
                                                    <option value="0" selected="selected">------</option>
                                                  @foreach($travailleurs as $travailleur)
                                                    <option value="{{ $travailleur->id  }}">{{ $travailleur->nom }}</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                  
                                              <div class="row">
                                                  <div class="col-6">
                                                      <label for="exampleInputqte">date Début</label>
                                                      <input value="{{date('Y-m-d')}}" type="date" class="form-control id_trav dateD" id="exampleInputqte" placeholder="date Debut" name="dateD" style="padding: 2em;">
                                                    </div>
                                                    <div class="col-6">
                                                      <label for="exampleInputqte">date Fin</label>
                                                      <input value="{{date('Y-m-d')}}" type="date" class="form-control id_trav dateF" id="exampleInputqte" placeholder="date fi" name="dateF" style="padding: 2em;">
                                                    </div>
                                                 </div>
                  
                                              <hr>
                  
                                              <div class="row">
                                                  <div class="col-md-6">
                                                      <table class="table table-striped table-bordered tableClick" id="example">
                                                          <thead>
                                                            <tr>
                                                                <th>Travailleur</th>
                                                              <th>Montant</th>
                                                              <th>Nombre de opérations</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody id="tableOperation">
                                                              
                                                          </tbody>
                                                      </table>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <table class="table table-striped table-bordered">
                                                          <thead>
                                                            <tr>
                                                                <th>num ticket</th>
                                                              <th>lebelle</th>
                                                              <th>prix</th>
                                                              <th>quantité</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody id="tableDetail">
                                                              
                                                          </tbody>
                                                      </table>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                </div>
                            </div>
                    </div>
                </div>
                
@endsection




@section('script')
<script src="{{url('assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{url('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{url('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script>
	$(document).ready(function() {
 	
	    var id_trav=0;

	    var dateD=0;
		var dateF=0;

	    $('.id_trav').change(function(){
	    	id_trav = $("select#id_trav option").filter(":selected").val();
	    	dateD = $(".dateD").val();
			dateF = $(".dateF").val();
console.log(dateD,dateF);
	   		$.ajax({
		            url: "{{ route('admin.cloturageOperation') }}",
		            type: 'get',
		            dataType: "json",
		            data: {id:id_trav,dateD:dateD,dateF:dateF},
		            success: function (data)
		            {
		                console.log(data);
		                $("#example").dataTable().fnDestroy();
		                $('#tableOperation tr').remove();
		                $.each(data.cloturages, function(key,value) {
							$('#tableOperation').append('<tr value="'+value.idC+'"><td>'+value.nom+'</td><td>'+value.montant+'</td><td>'+value.nombreOperation+'</td></tr>');
						});

						$('#example').DataTable({
						 	ordering: true,
							paging: true,
				        	dom: 'Bfrtip',
				        	buttons: [
				            	'excel', 'pdf'
				            ]
					    });

		            },
		            error: function (values)
		            {
		            	console.log('il y a un problem technique...');
		            }
		        });
		 });



	     $(".tableClick").on('click','tr',function(e){
	    e.preventDefault();
	    var id = $(this).attr('value');
	    console.log(id);
	     $.ajax({
	            url: "{{ route('admin.prodCloturage') }}",
	            type: 'get',
	            data: {id:id},
	            dataType: "json",
	            success: function (data)
	            {
	                console.log(data);
	                $('#tableDetail tr').remove();
	                $.each(data.cloturages, function(key,value) {
	                	if (value.typeQte == null) {
	                	 var qte = ' ';
	                	}else{
	                		var qte = value.typeQte;
	                	}
						$('#tableDetail').append('<tr><td>'+value.numtick+'</td><td>'+value.lebelle+'</td><td>'+value.prixTicket+'</td><td>'+value.qte_prod+' '+qte+'</td></tr>');
					});

	            },
	            error: function (values)
	            {
	            	swal("il y a un problem technique...", "error");
	            }
	        }); 
		}); 
	} );
</script>
    
@endsection