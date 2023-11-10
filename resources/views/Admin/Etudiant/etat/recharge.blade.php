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
                            <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                <div class="card-body">
                                    <div class="media flex-wrap align-items-center">
                                        <div class="media-left col-md-9">
                                            Listes des recharges
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <h1 class="h2">Gérer les recharges</h1>
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
                                          @if (session('error') )
                                          <div class="alert alert-danger alert-styled-left login-form">
                                              <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                          class="sr-only">Close</span></button>
                                          <span class="text-semibold"> {{ session('error') }}</span>
                                          </div>
                                          @endif
                  
                  
                                          <div class="row">
                                                  <div class="col-6">
                                                      <label for="exampleInputqte">date Debut</label>
                                                      <input type="date" class="form-control date dateD" value="{{date('Y-m-d')}}" id="exampleInputqte" placeholder="date Debut" name="dateD" style="padding: 2em;">
                                                    </div>
                                                    <div class="col-6">
                                                      <label for="exampleInputqte">date Fin</label>
                                                    <input type="date" class="form-control date dateF" value="{{date('Y-m-d')}}" id="exampleInputqte" placeholder="date fi" name="dateF" style="padding: 2em;">
                                                    </div>
                                          </div>
                  
                                              <hr>
                  
                                          <div class="row">							
                                         
                                          <div class="col-12">
                                              <table class="table text-center">
                                                  <thead class=" text-primary">
                                                      <th>Eleve</th>
                                                      <th>User</th>
                                                      <th>Type</th>
                                                      <th>Sold</th>
                                                      <th>Date</th>
                                                      <th>Remarque</th>
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
@endsection




@section('script')
<script src="{{url('assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

<script>
	$(document).ready(function() {


		var dateD=0;
		var dateF=0;

		 $(".date").on('change',function(){

	     dateD = $('[name=dateD]').val()
	     dateF = $('[name=dateF]').val()

	     $.ajax({
	            url: "{{ route('admin.etat.recharge.data') }}",
	            type: 'get', 
	            data: {dateD:dateD,
	            		dateF:dateF},
	            success: function (data)
	            {
	                console.log(data);
	                $('#tableDetail').html(data);
	               

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
