@extends('Trav.main')

@section('style')
  <link rel="stylesheet" href="{{url('assets/css/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{url('assets/css/ticket.CSS') }}">
  <link rel="stylesheet" href="{{url('assets/plugins/keybord/keybord.css')}}">
  <style>
  	@media screen {
	#printSection {
		display: none;
	}
	} 

	@media print {
	body * {
		visibility:hidden;
	}
	#printSection, #printSection * {
		visibility:visible;
	}
	#printSection {
		position: absolute;
			left: 0;
			top: 0;
			height: 1000px;
	}
	}

    	.main-panel{
    		width: 100% !important;
    	}
    	.slider {
		  -webkit-appearance: none;
		  width: 100%;
		  height: 15px;
		  border-radius: 5px;  
		  background: #d3d3d3;
		  outline: none;
		  opacity: 0.7;
		  -webkit-transition: .2s;
		  transition: opacity .2s;
		}

		.slider::-webkit-slider-thumb {
		  -webkit-appearance: none;
		  appearance: none;
		  width: 25px;
		  height: 25px;
		  border-radius: 50%; 
		  background: #4CAF50;
		  cursor: pointer;
		}

		.slider::-moz-range-thumb {
		  width: 25px;
		  height: 25px;
		  border-radius: 50%;
		  background: #4CAF50;
		  cursor: pointer;
		}

		.dark-edition .form-control,
		.is-focused .dark-edition .form-control {
			background-image:linear-gradient(0deg,
			#029eb1 2px,
			rgba(156,
			39,
			176,
			0) 0),
			linear-gradient(0deg,
			hsla(0,
			0%,
			71%,
			.1) 1px,
			hsla(0,
			0%,
			71%,
			0) 0) !important;
		}
		.ticketBtn{
			padding: 10px !important;
		}

		hr {
			margin-top:0rem;
			margin-bottom:0rem;
			border:0;
			border-top:1px solid rgba(0,0,0,.1)
		}
	.click_btn:hover{

		background: #2196F3;
		

	}
		.click_btn.active{

		background: #2196F3;


		}
		.suprimerart:hover{
			outline: -webkit-focus-ring-color auto 1px;
			cursor: pointer;
		}
		.suh5 {
			margin: 0 !important;
			padding: 10px 5px;
		}
	
	
		.wrapper { margin: 0 auto; position:relative; z-index:1;overflow:hidden;}
		.modal-backdrop{
			display: none !important;
		}
		</style>
	
@endsection




@section('content')
<!-- Modal Mode caisse-->
{{-- <div class="btn-group btn-group-lg text-center" style="    margin: 21px auto;
display: inherit;" role="group" aria-label="...">

	<a type="button"  href="{{ route('trav.index')}}" class="btn {{\Request::route()->getName() == 'trav.index'? 'btn-success' : 'btn-outline-success'}} ">Restaurant</a>
	<a type="button" href="{{ route('trav.Buvette')}}" class="btn {{\Request::route()->getName() == 'trav.Buvette'? 'btn-success' : 'btn-outline-success'}} ">Buvette</a>
</div> --}}
<!-- ticket -->

<div class="row">
	<div class="col-md-12  " >
		<div class="card" >
			
			<div class="row">					
				<div class="col-md-1">
					<a href="{{route('trav.logout') }}" class="btn btn-danger btn-rounded btn-fw btn-block" style="padding: 1em;"><i class="material-icons">donut_large</i></a>
				
				</div>
				<div class="col-md-1">
					<button type="button" class="btn btn-success btn-rounded btn-fw btn-block fullscreen" data-id="1" style="padding: 1em;" onclick="openFullscreen()"><span class="material-icons">
						fullscreen
						</span>
					</button>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-primary btn-rounded btn-fw btn-block click_btn consulte" style="padding: 1em;" data-toggle="modal" data-target="#consulte">consulté</button>
				
				</div>
				<div class="col-md-2">
					<div class=" bmd-form-group poidsInputGroup">
						
						<input type="text" name="prsnl" id="prsnl" class="form-control prsnl" value="c4ca4238a0" placeholder="ID Eleve" style="height: 55px">
						{{-- <input type="hidden" name="type" id="type" class="form-control " value="{{Auth::user()->type = \Request::route()->getName() == 'trav.index'? 'R' : 'B'}}"> --}}
						
						<input type="hidden" name="type" id="type" class="form-control " value="{{Auth::user()->type}}">
					
						
						<input type="hidden" name="prixPayer" id="prixPayer" class="form-control">
						
					</div>
				</div>
				<div class="col-md-2">
					<div class=" bmd-form-group poidsInputGroup">
						
						<input type="text" autofocus name="code_bar" id="code_bar" class="form-control " autocomplete ="off" value="{{ old('code_bar') }}" placeholder="code bar Produit" style="height: 55px">
						
					</div>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-info  btn-fw btn-block click_btn reset" style="padding: 1em;">relancer</button>
				</div>	
				<div class="col-md-2">
					<a href="#" class="btn btn-warning  btn-fw btn-block click_btn cloturage" style="padding: 1em;">Cloturage</a>
				</div>
				
			</div>
		</div>
	</div>
	<div class="col-md-3 grid-margin stretch-card" style="padding: 0px; padding-right: 5px" id="printtick">
		
	

		<div class="box" id="box">
			<div class='inner'>
			<h1 id="nomeleve_ticket">{{ Auth::user()->nom  }}</h1>
			<button type="button" class="btn btn-success  btn-fw btn-block click_btn ticket"
			 style="padding: 1em;margin-bottom:10px" id="btnPrint" >Ticket</button>
			{{-- <div id="info_ticket">
				<div class='wp'>Ticket :</div>
				<div class='wp'>Date :</div>
			</div>
			<div id="info_ticket_detail">
				<div class='wp'>RTGTVDVD</div>
				<div class='wp'>20/09/2021</div>
			</div> --}}
		
			<hr>
			
			<div class='info clearfix'>
			  <div class='wp'><h2>Article</h2></div>
			  <div class='wp'><h2>Qte</h2></div>
			  <div class='wp'><h2>Prix</h2></div>
			</div>
			<div id="body_ticket">
			 
			</div>
			<div class='total clearfix' id="total_ticket">
				<h2>Total : <p> 00.00 DH</p></h2>
			</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		
		<div class="col-sm-12 col-xl-12" style="padding: 0;">
			<div class="col-sm-12 col-xl-12 grid-margin stretch-card" style="padding: 0;">
				<div class="card" style="margin-top: 0px !important">
					<div class="justify-content-center">
						<span class="catShowSpan col-md-12" style="display: none;"><button type="button" class="btn btn-rounded btn-fw btn-block click_btn cat" style="background-color: white;color: black;">return</button></span>
						<div class="row CategoryDiv">
							@foreach($cats as $cat)
							
							@if($cat->type==Auth::user()->type || $cat->type=="Mix")
								
								<button class="click_btn cat" style="color: black;padding: 10px !important; cursor: pointer;"
								data-id="{{$cat->id}}" data-nom="{{$cat->nom_cat}}">
										
									{{$cat->nom_cat}}
									</button>
								
							@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-xl-12 grid-margin stretch-card" style="padding: 0;">
				<div class="card" style="margin-top: 0px !important">
					<div class="row" id="articles">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	
</div>
<div class="row" style="padding: 0;">
	
</div>
</div>
</div>
<!-- The Modal -->
<div class="modal" id="consulterModel">
<div class="modal-dialog modal-lg">
<div class="modal-content">
	<!-- Modal Header -->
	<div class="modal-header">
		<h4 class="modal-title">Mes operations</h4>
	</div>
	<!-- Modal body -->
	<div class="modal-body">
		
		<div class="row">
			<div class="col-md-3">
				<h3>Les operations</h3>
				<table class="table tableClick table-info">
					<thead>
						<tr>
							<th>numtick</th>
							<th>Date operation</th>
						</tr>
					</thead>
					<tbody id="tableOperation">
						
					</tbody>
				</table>
			</div>
			<div class="col-md-3">
				<h3>Detail de operation</h3>
				<table class="table">
					<thead class="thead-light">
						<tr>
							<th>type</th>
							<th>prix</th>
							<th>qte</th>
						</tr>
					</thead>
					<tbody id="tableDetail">
						
					</tbody>
				</table>
			</div>
			<div class="col-md-3">
				<h3>Detail de option</h3>
				<table class="table">
					<thead class="thead-light">
						<tr>
							<th>option</th>
							<th>prix</th>
						</tr>
					</thead>
					<tbody id="tableoption">
						
					</tbody>
				</table>
			</div>
			<div class="col-md-3">
				<h3>Detail de option</h3>
				<table class="table">
					<thead class="thead-light">
						<tr>
							<th>total prod</th>
						</tr>
					</thead>
					<tbody id="prod">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Modal footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
	</div>
</div>
</div>
</div>
<!-- Modal  consulte-->
<div class="modal fade" id="consulte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Consultation des tickets</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-6">
				<table class="table tableClick">
					<thead>
						<tr>
							<th scope="col">Numtick</th>
							<th scope="col">Cloturage</th>
							<th scope="col">Date operation</th>
						</tr>
					</thead>
					<tbody id="tableOperationConsult">
						
					</tbody>
				</table>
			</div>
			<div class="col-6">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Prod</th>
							<th scope="col">Prix</th>
							<th scope="col">Qte</th>
						</tr>
					</thead>
					<tbody id="tableProdConsult">
						
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
	</div>
</div>
</div>
</div>


<div class="modal fade" id="myModalUnite" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitlemyModalUnite" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitlemyModalUnite"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        <div class="modal-body" >
			<input type="hidden" id="idmodel">
			<input type="hidden" id="prixmodel">
			<input type="hidden" id="artmodel">
			<input type="hidden" id="uniteogmodel">
			
            <div class="form-group row">
                <label for="quiz_title" class="col-sm-3 col-form-label form-label">Unite:</label>
                <div class="col-sm-9">
					<select class="form-control select2-single  " name="unitemodel" id="unitemodel">
                                                               
						<option  value="kg">KG</option>
						<option  value="g">G</option>
					 
						 </select>
                    </div>
            </div>
            <div class="form-group row">
                <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quantité :</label>
                <div class="col-sm-9">
                    <input id="qtemodel"  name="qtemodel" type="number" class="form-control easy-get" placeholder="Quantité" > 
                </div>
            </div>
           
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="saveqteunite" >Enregistrer</button>
          </div>
      </div>
    </div>
  </div>

 
  
  
  <div class="box" id="hiddenbox" style="display: none">
	<div class='inner'>
	<h1 id="">{{Auth::user()->etab->nom}}</h1>
	
	<div id="info_ticket">
		<div class='wp'>Ticket :</div>
		<div class='wp'>Date :</div>
	</div>
	<div id="info_ticket_detail">
		<div class='wp' id="hidden_ticket_num">RTGTVDVD</div>
		<div class='wp' id="hidden_ticket_date">20/09/2021</div>
	</div>

	<hr>
	
	<div class='info clearfix'>
	  <div class='wp'><h2>Article</h2></div>
	  <div class='wp'><h2>Qte</h2></div>
	  <div class='wp'><h2>Prix</h2></div>
	</div>
	<div id="hidden_body_ticket">
	 
	</div>
	<div class='total clearfix' id="hidden_total_ticket">
		<h2>Total : <p> 00.00 DH</p></h2>
	</div>
	<br>
	<center>
	<p>Merci pour votre visite</p>
	</center>
	</div>
</div>

@endsection


@section('script')

<script src="{{url('assets/js/sweetalert2.all.min.js')}}"></script>

<script src="{{url('assets/plugins/keybord/keybord.js')}}"></script>
<script>

var count=1;	
var total=0;
var qteArt=0;
var totalTicket=[];
var totalTicketDH=0;
var prixQte=0;



$(document).ready(function() {

	
	$('body').on('click',".easy-get", () => {
        show_easy_numpad();
    });

	$('.catShowSpan').click(function(){
	$('.CategoryDiv').show();
	 $('.catShowSpan').css("display", "none");
	});

var artID=[];
var mainticket=[];
var ticketcons=[];
	 $('.cat').click(function(){
	 	var id_cat=$(this).data('id');
	 	var cat_nom=$(this).data('nom');


$(".cat").removeClass('active');
$(this).addClass('active');
	 	console.log(cat_nom);
   		$.ajax({
	            url: "{{ route('trav.get_articles.bycat') }}",
	            type: 'get',
	            data:{id:id_cat},
	            success: function (data)
	            {
	            	$('#tableArticle tr').remove();
	            
		               
		                
							$('#articles').html(data);
								
								
					
	                console.log(data);
	              
	            },
	            error: function (data)
	            {
	            	swal("il y a un problem technique...", "error");
	            }
	    });
	
	 });
   
	 $('body').on('click', ".suprimerart" ,function(){

		var id = $(this).data('id');
		var is_exist = false ;
		var i = 0;
		$.each( mainticket, function( key, value ) {
								console.log(key)
							if (id == value.idProd) {
								is_exist = true;
								i = key;
								return;
							}
							});
							console.log(mainticket)
							mainticket.splice( i  , 1) 

						console.log(mainticket)
					  
		settickt (mainticket,null);
	 });
	 $('body').on('click', ".artLInk" ,function(){
		
					  	   console.log('done');
					    var id = $(this).data('id');
					   
					    var prix = $(this).data('prix');
						var name = $(this).data('art');
						var unite = $(this).data('unite');
						var qteact = $(this).data('qte');
					 	 
					    	
							data = {
								id : id, 
							    prix : prix,
							    qte:1,
								name: name,
								unite: unite,
								uniteog: unite,

							};

							if(unite =="qte")
							{
								settickt (mainticket,data);
							}
							else
							{
											var id = $('#idmodel').val(data.id);
											var prix = $('#prixmodel').val(data.prix);
											var name = $('#artmodel').val(data.name);
											var name = $('#uniteogmodel').val(data.unite);
											$('#exampleModalCenterTitlemyModalUnite').html(`${data.name} : ${qteact} / ${data.unite}`)
								$('#myModalUnite').appendTo("body").modal('show');
							}
							
							
						
					}); 
					$('body').on('click', "#saveqteunite" ,function(){
		
	
											var id = $('#idmodel').val();
											var prix = $('#prixmodel').val();
											var name = $('#artmodel').val();
											var unite = $('#unitemodel').val();
											var qteact = $('#qtemodel').val();
											var uniteog = $('#uniteogmodel').val();
											
												
												data = {
													id : id, 
													prix : prix,
													qte:qteact,
													name: name,
													unite: unite,
													uniteog: uniteog,

												};
													settickt (mainticket,data);
													
													$('#myModalUnite').appendTo("body").modal('hide');
												
												
												
											
											}); 
		



					function settickt (arraytick,data , body_ticket = "#body_ticket" , total_ticket = "#total_ticket")
					{


						console.log(data)
						$(body_ticket).html(''); 
						
						var is_exist = false ;
						 var i = 0;
						if(data){
						

							$.each( arraytick, function( key, value ) {
								console.log(key)
							if (data.id == value.idProd) {
								is_exist = true;
								i = key;
								return;
							}
						});
					 

					  if(!is_exist){

						var newprix = 0;
						var newqte = 0;



							if(data.uniteog == "kg"){

									if(data.unite == "kg"){
									newqte =  parseFloat(data.qte);
									newprix += parseFloat(data.prix) * parseFloat(data.qte) ;
									}
									else
									{
										newqte =parseFloat(data.qte)/1000;
										newprix += parseFloat(data.prix) * (parseFloat(data.qte)/1000) ;
									}

									}
									else if(data.uniteog == "g")
									{
									if(data.unite == "kg"){
									newqte =  parseFloat(data.qte)*1000;
									newprix += parseFloat(data.prix) * (parseFloat(data.qte)*1000) ;
									}
									else
									{
										newqte =  parseFloat(data.qte);
										newprix += parseFloat(data.prix) * (parseFloat(data.qte)) ;
									}
									}
									else{
									newqte =  parseFloat(data.qte);
									newprix = parseFloat(data.prix) * parseFloat(data.qte) ;
									}

								arraytick.push({
									idProd : data.id, 
									prix : newprix,
									qte:   newqte,
									name: data.name,
									unite: data.uniteog,
								});
					  }
					  else
					  {

						if(arraytick[i].unite == "kg"){

							if(data.unite == "kg"){
								arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
								arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte) ;
							}
							else
							{
								arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte)/1000;
								arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte)/1000) ;
							}

						}
						else if(arraytick[i].unite == "g")
						{
							if(data.unite == "kg"){
								arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte)*1000;
								arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte)*1000) ;
							}
							else
							{
								arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
								arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte)) ;
							}
						}
						else{
							arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
							arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte) ;
						}

					  }

			      		}			    	

						totalTicketDH=0;
							$.each(arraytick, function(index, val) {								
								totalTicketDH = parseFloat(totalTicketDH) + parseFloat(arraytick[index].prix);
							});

					   
							$.each( arraytick, function( key, value ) {
								$(body_ticket).append(`
								<div class='info clearfix suprimerart' data-id="${value.idProd}">
									<div class='wp'> ${value.name}</div>
									<div class='wp'> x ${value.qte.toFixed(2)} / ${value.unite}</div>
									<div class='wp'>${value.prix.toFixed(2)} DH</div>
								</div>`);
												
							});
					    
						$('#prixPayer').val(totalTicketDH); 
						$(total_ticket).html(`<h2>Total : <p> ${totalTicketDH.toFixed(2)} DH</p></h2>`); 
				}


	  $('.ticket').click(function(){ 
/*	 	$("div#printThis").css("display", "block");*/
	 	var idPrnsl = $('#prsnl').val();
		 var type = $('#type').val();
		 var prixPayer = $('#prixPayer').val();
		 
		 $.ajax({
				            url: "{{ route('trav.ticket') }}", 
				            type: 'post',
				            data: {
								idPrnsl:idPrnsl,
				            	ticket:mainticket,
								type:type,
								prixPayer:prixPayer,
								 _token: '{{csrf_token()}}',
				                },
				            success: function (values)
				            {
							console.log(values.data)
								if(values.msg == "success")
								{
								
									$('#hidden_nomeleve_ticket').text(values.data.eleve.nom+" "+values.data.eleve.prenom);
									$('#hidden_ticket_num').text(values.data.tickt.numtick);
									$('#hidden_ticket_date').text(values.data.tickt.date_operation);
								
									settickt (mainticket,null,'#hidden_body_ticket','#hidden_total_ticket');
								

								
									@if(Auth::user()->canprint)
									PrintElem('hiddenbox');
									setTimeout(function(){
									mainticket = [];
									settickt(mainticket,null)
									}, 200);
									@else
									setTimeout(function(){
									mainticket = [];
									settickt(mainticket,null)
									}, 200);
									@endif
									
								
									
				             	
								}
								else{
									Swal.fire({
									icon: 'error',
									title: "erreur",
									text: values.text,
								});
								}
				            },
				            error: function (values)
				            {	
				            	Swal.fire({
								  icon: 'error',
								  title: 'Oops...',
								  text: 'il y a un problem technique ou cette ticket est vide...',
								});
								
				            }
				        });




	 });



	 $('.numbre').click(function(event) {
	 	$('.poidsInputGroup').removeClass('is-focused');
	 	var val = $(this).val();
	 	var numbre = $('.poidsInput').val()+val.toString();
	 	console.log(numbre);
  		$('.poidsInput').val(numbre);
  		$('.poidsInputGroup').addClass('is-focused');
	 });


	 $('.reset').click(function(){
	 	location.reload();
	 });

	 $('.numbreC').click(function(){
	 	$('.poidsInput').val('');
	 });



	 $('.consulte').click(function(){
	 	$.ajax({
	            url: "{{ route('trav.consulte') }}",
	            type: 'get',
	            success: function (data)
	            {	    
	            	/*$("#example").dataTable().fnDestroy();*/
	            	console.log(data);
		            $('#tableOperationConsult tr').remove();
		            $.each(data.operations, function(key,value) {
		            	if (value.cloturage == null) {
		            		var cloturage = 'non';
		            	}else{
		            		var cloturage = 'oui';
		            	}
						$('#tableOperationConsult').append('<tr value="'+value.id+'"><td>'+value.numtick+'</td><td>'+cloturage+'</td><td>'+value.date_operation+'</td></tr>');
					});
	            },
	            error: function (values)
	            {	
	            	
	            }
	        });
	 });

	  $(".tableClick").on('click','tr',function(e){
	    e.preventDefault();
	    var id = $(this).attr('value');
	    console.log(id);
	     $.ajax({
	            url: "{{ route('trav.tableOperationConsult') }}",
	            type: 'get',
	            data: {id:id},
	            dataType: "json",
	            success: function (data)
	            {
					console.log(data)
	                
	                $('#tableProdConsult tr').remove();
	                $.each(data.prods, function(key,value) {
	                	if (value.typeQte == null) {
	                	 var qte = ' ';
	                	}else{
	                		var qte = value.typeQte;
	                	}
						$('#tableProdConsult').append(
							'<tr><td>'+value.lebelle+
							'</td><td>'+value.prixTicket+
							'</td><td>'+value.qte_prod+' '+qte+
							'</td></tr>');
					});

					@if(Auth::user()->canprint)
									
									
									
					$('#tableProdConsult').append(
							`<tr >
								<td col="3">
									<button type="button" class="btn btn-success  btn-fw btn-block" data-id="${id}"
									 style="padding: 1em;margin-bottom:10px;float:right" id="btnPrintcon" >Print</button>
								</td>
							</tr>`);
							@endif


	            },
	            error: function (values)
	            {
	            	swal("il y a un problem technique...", "error");
	            }
	        }); 
		});


		
	 $('.cloturage').click(function(e){
	 	e.preventDefault();
	 		
	 		$.ajax({
	            url: "{{ route('trav.cloturage') }}",
	            type: 'get',
	            success: function (data)
	            {	    

					console.log(data)
	            	if(data!="")
					{
	            	Swal.fire({
					  title: 'votre cloturage est',
					  text: ' '+data+' ',
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'oui'
					}).then((result) => {
					  if (result.value) {
					  	$.ajax({
					            url: "{{ route('trav.cloturage.confirm') }}",
					            type: 'get',
					            success: function (data)
					            {	         
									
									console.log(data)
									
									location.reload();
					            },
					        });
						    //location.reload();
					  }
					});
				}  
					else {
						Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'un cloturage exist déja ...',
					});
					}   	
	            },
	            error: function (values)
	            {	
	            	Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'un cloturage exist déja ...',
					}).then(function(isConfirm) {
						  if (isConfirm) {
						    location.reload();
						  }
					});
					
	            }
	        });
	 });


	 


	$('.mode').click(function(){
	 	 	var id = $(this).data('id');
	 	$.ajax({
	            url: "{{ route('trav.modeCaisse') }}",
	            type: 'get',
	            data:{id:id},
	            success: function (data)
	            {	    
	            	console.log(data);
	            
					location.reload();
	            },
	            error: function (values)
	            {	
	            	
	            }
	        });
	 });

	 $("#code_bar").on('keyup', function(e) {

//   var valu = e.originalEvent.clipboardData.getData('text')
   
  var valu = $(this);

if(e.keyCode===13){
   $.ajax({
	   type: "get",
	   url: "{{ route('trav.getprodbycode_bar') }}",
	   data: {
	   code_bar:valu.val()
	   },
	   success: function (data) {
		 valu.val('');
		if(data.msg == "success")
								{

console.log(data.data)
									if(data.data.unite =="qte")
										{
											
										
											settickt(mainticket,data.data);
											
												
											
										}
										else
										{
											console.log(data.data)
											if(data.data.prodqte)
											{
												$('#qtemodel').val(data.data.prodqte)
											}
														var id = $('#idmodel').val(data.data.id);
														var prix = $('#prixmodel').val(data.data.prix);
														var name = $('#artmodel').val(data.data.name);
														var unite = $('#uniteogmodel').val(data.data.unite);

														
											$('#exampleModalCenterTitlemyModalUnite').html(`${data.data.name} : ${data.data.qteact} / ${data.data.unite}`)		
											$('#myModalUnite').appendTo("body").modal('show');

										}

					
				             	
								}
								else{
									valu.val('');
								}
		  
	


	   }
   });
}
});


$("body").on('click','#btnPrintcon',function(e){

	var id_opt = $(this).data("id");


	
						$.ajax({
				            url: "{{ route('trav.ticket.opt','') }}/"+id_opt, 
				            type: 'get',
				            success: function (values)
				            {
							console.log(values.data)
							ticketcons = [];
								if(values.msg == "success")
								{ 
								
									$('#hidden_nomeleve_ticket').text(values.data.eleve.nom+" "+values.data.eleve.prenom);
									$('#hidden_ticket_num').text(values.data.tickt.numtick);
									$('#hidden_ticket_date').text(values.data.tickt.date_operation);
								
									$.each(values.data.detail, function(key,value) {
	                	
									settickt (ticketcons,value,'#hidden_body_ticket','#hidden_total_ticket');
									})
								
									PrintElem('hiddenbox');

								}
							}

						});
});


});

var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
var btn = $('.fullscreen');
if(btn.data('id') == 1)
{
	btn.html('<span class="material-icons">fullscreen_exit</span>')
	btn.data("id",0)
	
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}
  else{
	btn.html('<span class="material-icons">fullscreen</span>')
	btn.data("id",1)
	if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
	
  }
}

/* Close fullscreen */
function closeFullscreen() {
 
}
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head>');
    mywindow.document.write("<link href=\"{{url('assets/css/ticket.css')}}\" rel=\"stylesheet\">")
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/


    setTimeout(function () {
    mywindow.print();
    mywindow.close();
    }, 1000)
    return true;
}

</script>
@endsection
