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
                                            Listes des stocks
                                        </div>
                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                            <a class="btn btn-success pull-right" href="{{ route('admin.create_prodStock') }}"> <i class="fa fa-plus"></i>&nbsp;Ajouter Un stock</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h2">Gérer les stocks</h1>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                            @if(Session::has('message'))
                                          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                          @endif
                                          @if (session('success'))
                                          <div class="alert alert-success border-1 border-left-3 border-left-success d-flex alert-dismissible">
                                              
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
                  
                  
                                          <form method="get" name="frm" action="{{route('admin.StockOperationGet')}}" id="formfilter">
                                            <input type="hidden" name="act" value="filter">
                                            <div class="form-row">
                                              <div class="form-group col-md-2">
                                                <h4 class="mt-5 ">Mois de  recherche : </h4>
                                              </div>
                                              
                                              <div class="form-group col-md-2">
                                                <label for="id_client">A : </label>
                                                <select name='anne' class="form-control" id="anne">
                                                  <option value="0">Tous</option>
                                                  <?php for($d=Date("Y");$d>= 2009;$d--)
                                                  echo "<option value='$d'> $d</option>";?>
                                                </select>
                                              </div>
                                              <div class="form-group col-md-2">
                                                <label> M: </label>
                                                <select name='mois' class="form-control" id="mois">
                                                  <option value="0">Tous</option>
                                                  <?php for($m= 1;$m<=9;$m++)
                                                  echo "<option value='0$m' >0$m</option>";?>
                                                  <?php for($m= 10;$m<=12;$m++)
                                                  echo "<option value='$m' >$m</option>";?>
                                                </select>
                                              </div>
                                              
                                              <div class="form-group col-md-2">
                                                <button  type="submit" class="btn btn-success default btn-lg btn-block  mr-1 " style="margin-top: 25px;">Afficher</button>
                                              </div>
                                            </div>
                                          </form>

                                      
                  
                                              <hr>
                  
                                          <div class="row">							
                                          <div class="col-12">
                                              <table class="table text-center tableClick" id="myTable">
                                                  <thead class=" text-primary">
                                                      <th>User</th>
                                                      <th>fornisseurs</th>
                                                      <th>Date</th>
                                                      <th>Remarque</th>
                                                      <th></th>
                                                  </thead>
                                                  <tbody id="stock">
                                                    @foreach ($stocks as $stc)
                                                    <tr>
                                                    <td>{{$stc->nom}}</td>
                                                    <td>{{$stc->nom_frns}}</td>
                                                    <td>{{$stc->date_opt}}</td>
                                                    <td>{{$stc->remarque}}</td>
                                                    <td>
                                                        <a  href="{{ route('admin.delete_stock_ope',["id"=>$stc->id]) }}" onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément');" class="btn btn-danger btn-sm">
                                                            <i class="material-icons">close</i>
                                                        </a>
                                                    
                                                        <a target="_blanck" href="{{ route('admin.detail.stock.index',["id"=>$stc->id]) }}" class="btn btn-info btn-sm">
                                                            <i class="material-icons">list</i>
                                                        </a>
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


		


	   
	} );
</script>
    
@endsection
