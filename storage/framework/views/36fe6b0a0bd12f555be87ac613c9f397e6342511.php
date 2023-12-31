

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(url('assets/css/sweetalert2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(url('assets/css/ticket.CSS')); ?>">
  <link rel="stylesheet" href="<?php echo e(url('assets/plugins/keybord/keybord.css')); ?>">
  <style>
  	@media  screen {
	#printSection {
		display: none;
	}
	}

	@media  print {
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
		#KioskBoard-VirtualKeyboard.kioskboard-theme-light, #KioskBoard-VirtualKeyboard.kioskboard-theme-material{
			background: #D3D3D379 !important
		}
		.cursorpointer{
			cursor: pointer;
		}
		</style>

<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
<!-- Modal Mode caisse-->

<!-- ticket -->




<div class="row">
	<div class="col-md-3 "  id="printtick">
		<div class="btn-group btn-group-lg d-flex" role="group" aria-label="Basic example">
		   <button id="ticktunpause" type="button" class="btn btn-secondary" >
		   <span class="material-icons">
		   replay
		   </span>
		   <?php if($optsCoutn): ?>
		   <span id="optsCoutn" class="badge badge-pill badge-secondary " data-optscoutn="<?php echo e($optsCoutn->count()); ?>"><?php echo e($optsCoutn->count()); ?></span>
		   <?php endif; ?>
		   </button>
		   <button id="ticktpause" type="button"  class="btn btn-warning"><span class="material-icons">
		   pause
		   </span></button>
		   <button id="deleteticket" type="button" class="btn btn-danger d-none"><span class="material-icons">
		   delete
		   </span></button>
		</div>
		<div class="box" id="box">
		   <div class='inner'>
			  <div class='info clearfix'>
				 <div class='wp'>
					<h2>Article</h2>
				 </div>
				 <div class='wp'>
					<h2>Qte</h2>
				 </div>
				 <div class='wp'>
					<h2>Prix</h2>
				 </div>
			  </div>
			  <div id="body_ticket">
			  </div>
			  <div class='total clearfix' id="total_ticket">
				 <h2  class="calculated-price"  style="font-size: 1.7rem">
					Total :
					<p> 00.00 DH</p>
				 </h2>

				 <h2 class="offer-price d-none" style="font-size: 1.7rem">
					Total :
					<p> 00.00 DH</p>
				 </h2>
			  </div>
			  <div class='total clearfix'  id="Remise_ticket" style="display: none">
				 <h2>
					Remise :
					<p> 00.00 DH</p>
				 </h2>
			  </div>
			  <div class='total clearfix'  id="reste_ticket" style="display: none">
				 <h2>
					Reste :
					<p> 00.00 DH</p>
				 </h2>
			  </div>
		   </div>
		</div>
 </div>
 <div class="col-9">
	<div class="row" style="align-items: center;">
		<div class="col-md-1">
		   <div class=" bmd-form-group poidsInputGroup">
			  <input type="text" name="prsnl" id="prsnl" class="form-control prsnl" value="c4ca4238a0" placeholder="ID Eleve" style="height: 55px">
			  
			  <input type="hidden" name="type" id="type" class="form-control " value="<?php echo e(Auth::user()->type); ?>">
			  <input type="hidden" name="total_a_payer" id="total_a_payer" class="form-control">
			  <input type="hidden" name="hidden_prix_payer_model" id="hidden_prix_payer_model" class="form-control">
			  <input type="hidden" name="hidden_remise_model" id="hidden_remise_model" class="form-control">
		   </div>
		</div>
		<div class="col-md-1">
		   <div class=" bmd-form-group poidsInputGroup">
			  <input type="text" autofocus name="code_bar" id="code_bar" class="form-control " autocomplete ="off" value="<?php echo e(old('code_bar')); ?>" placeholder="Code bar Produit" style="height: 55px">
		   </div>
		</div>
		<div class="col-md-1">
		   <div class=" bmd-form-group poidsInputGroup">
			  <input type="text" autofocus name="prix_payer" id="prix_payer" class="form-control  virtual-keyboard "  data-kioskboard-type="numpad"  changeplaceholder="Quantité"  autocomplete ="off" value="<?php echo e(old('prix_payer')); ?>" placeholder="Prix Payer" style="height: 55px">

			</div>



		</div>

		<div class="col-md-1 <?php echo e(Auth::user()->is_manager ? '' : 'd-none'); ?>"  id="remise_input">
		   <div class=" bmd-form-group poidsInputGroup">
			  <input type="text" autofocus name="remise" id="remise" class="form-control  " autocomplete ="off" value="<?php echo e(old('remise')); ?>" placeholder="Remise %" style="height: 55px">
			</div>
		 </div>




		  <div class="col-md-2">
			<div class=" bmd-form-group poidsInputGroup">

				<select class="form-control select2-single  " name="paie_methode" id="paie_methode">
					<option value="espece">Espece</option>
					<option value="carte-bancaire">Carte Bancaire</option>
					<option id="offert_option" class="d-none" value="offert">Offert</option>
					<option value="en-compte">En compte</option>
				</select>

				<style>
					select option{
						zoom:1.5;
					}
				</style>



			</div>

		</div>





		<div class="col-md-2 client_list_col d-none">
			<div class=" bmd-form-group poidsInputGroup">

				<select class="form-control select2-single d-none" name="client_list" id="client_list">
					<option value="">Sélectionner un client ... </option>
					<?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($client->id); ?>"><?php echo e($client->prenom); ?> <?php echo e($client->nom); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>

			</div>

		</div>




		<div class="col-md-2">
			<div class=" bmd-form-group poidsInputGroup">

				<select class="form-control select2-single " name="table_list" id="table_list">
					<option value="">Sélectionner une table ... </option>
					 <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($table->id); ?>"> <?php echo e($table->nom); ?> </option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>

			</div>

		</div>


		<div class="col-md-2">
			<div class=" bmd-form-group poidsInputGroup">

				<select class="form-control select2-single  " name="remarque" id="remarque">
					<option value="">Sélectionner une remarque ... </option>
				 <?php $__currentLoopData = $remarques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remarque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($remarque->id); ?>"> <?php echo e($remarque->remarque); ?> </option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				</select>

				<style>
					select option{
						zoom:1.5;
					}
				</style>
			</div>
	</div>


	<div class="col-md-6">
		   <div class=" bmd-form-group poidsInputGroup">
			  <input type="text" autofocus name="lebelle" id="lebelle" class="form-control " autocomplete ="off" value="<?php echo e(old('lebelle')); ?>" placeholder="Désignation" style="height: 55px">
		   </div>
		</div>
<button id="clear_search" class="btn btn-danger col-md-4"> Vider La Sélection </button>

		<div class="col-md-4">
			<?php if(session('message')): ?>
			<div class="alert alert-success">
				<?php echo e(session('message')); ?>

				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
			</div>
				<?php endif; ?>
		</div>
	</div>
	<br>




				<div class="row">


					<div class="col-md-12">

						  <div class="grid-margin stretch-card" style="padding: 0;">
							 <div class="card" style="margin-top: 0px !important">
								<div class="justify-content-center">
								   <span class="catShowSpan col-md-12" style="display: none;"><button type="button" class="btn btn-rounded btn-fw btn-block click_btn cat" style="background-color: white;color: black;">return</button></span>
								   <div class="row CategoryDiv">
									  <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									  <?php if($cat->type==Auth::user()->type || $cat->type=="Mix"): ?>
									  <button class="click_btn cat" style=" height: 2rem; color: black;padding: 20px !important; display: flex;align-items: center;justify-content: center;margin: 0 10px 10px 0 ; cursor: pointer;"
										 data-id="<?php echo e($cat->id); ?>" data-nom="<?php echo e($cat->nom_cat); ?>">
									  <?php echo e($cat->nom_cat); ?>

									  </button>
									  <?php endif; ?>
									  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								   </div>
								</div>
							 </div>
						  </div>
						  <div class=" grid-margin stretch-card" style="padding: 0;">
							 <div class="card" style="margin-top: 0px !important">
								<div class="row" id="articles" style="margin-bottom: 40px !important">
								</div>
							 </div>
						  </div>

					</div>
				</div>

			</div>

</div>



 <div class="row" style="position: fixed;bottom:0;width: 100% !important;">
	<div class="<?php echo e(($params->enable_cusisine == 1 && $params->enable_barman == 1) ? 'col-md-1' : 'col-md-2'); ?>">
	   <button type="button" class="btn btn-success btn-rounded  btn-fw btn-block click_btn ticket"
		  style="padding: 1em;margin-bottom:10px" id="btnPrint" >Ticket</button>
    </div>

	<div class="col-md-1 <?php echo e($params->enable_cusisine == 1 ? '' : 'd-none'); ?> ">
	   <button  type="button" class="btn btn-success btn-rounded  btn-fw btn-block click_btn"
		  style="padding: 1em;margin-bottom:10px" id="btnPrintCuisine" >Cuisine</button>
	</div>
	<div class="col-md-1  <?php echo e($params->enable_barman == 1 ? '' : 'd-none'); ?>">
	   <button type="button" class="btn btn-success btn-rounded btn-fw btn-block click_btn"
		  style="padding: 1em;margin-bottom:10px" id="btnPrintBar" >Barman</button>
	</div>

	<div class="col-md-1">
	   <button type="button" class="btn btn-primary btn-fw btn-block click_btn consulte" style="padding: 1em;" data-toggle="modal" data-target="#consulte">consulté</button>
	</div>
	<div class="col-md-1">
	   <button type="button" class="btn btn-info  btn-fw btn-block click_btn reset" style="padding: 1em;">relancer</button>
	</div>
	<div class="col-md-2">
	   <a href="#" class="btn btn-success  btn-fw btn-block " id="Imprimer_Cloturage" style="padding: 1em;">Imprimer </a>
	</div>
	<div class="col-md-2">
	   <a href="#" class="btn btn-warning  btn-fw btn-block click_btn cloturage" style="padding: 1em;">Cloturage</a>
	</div>
	<div class="col-md-1">
	   <a href="<?php echo e(route('trav.logout')); ?>" class="btn btn-danger btn-rounded btn-fw btn-block" style="padding: 1em;"><i class="material-icons">donut_large</i></a>
	</div>
	<div class="col-md-1 " id="remise_btn">
        <button class="btn btn-primary btn-rounded btn-fw btn-block" style="padding: 1em;" data-toggle="modal" data-target="#code_manager" >Manager</button>
 	</div>

	<div class="col-md-1">
	   <button type="button" class="btn btn-success btn-rounded btn-fw btn-block fullscreen" data-id="1" style="padding: 1em;" onclick="openFullscreen()"><span class="material-icons">
	   fullscreen
	   </span>
	   </button>
	</div>
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
							<th scope="col">Date</th>
							<th scope="col">Action</th>
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

 <!-- Modal Code Manager -->
 <div class="modal fade" id="code_manager" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	   <div class="modal-content">
        <form id="allow_op_form" >


                <?php echo e(csrf_field()); ?>


		  <div class="modal-header">
			 <h5 class="modal-title" id="exampleModalLabel">Code Manager </h5>
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			 <span aria-hidden="true">&times;</span>
			 </button>
		  </div>
		  <div class="modal-body">
			 <div class="row">
                        <div class="col-12">

                            <label class="d-none"> List Managers : </label>

				<select class="d-none form-control select2-single  " name="code_manager_username" id="code_manager_username">
				 <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($manager->username); ?>"> <?php echo e($manager->username); ?> </option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				</select>

                            <label>Code Manager : </label>
                            <input autofocus type="password" placeholder="Code Manager" id="code_manager_password" name="code_manager_password" data-kioskboard-type="numpad"  changeplaceholder="Quantité" class="form-control virtual-keyboard" />
					</div>
			 </div>
		  </div>
		  <div class="modal-footer">
             <button type="submit" class="btn btn-primary" id="validate_code_manager">Valider</button>
			 <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
		  </div>
        </form>
	   </div>
	</div>
 </div>

<!-- End Modal Code Manager -->




 <div class="modal fade" id="myModalUnite" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitlemyModalUnite" aria-hidden="true">
	<div class="modal-dialog " role="document">
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
				   <input id="qtemodel"  name="qtemodel" type="number" class="form-control virtual-keyboard "  data-kioskboard-type="numpad"  changeplaceholder="Quantité" >
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
	   <h1 id=""><?php echo e(Auth::user()->etab->nom); ?></h1>
	   <div id="info_ticket">
		  <div class='wp'>Ticket :</div>
		  <div class='wp'>Date :</div>
	   </div>
	   <div id="info_ticket_detail">
		  <div class='wp' id="hidden_ticket_num">RTGTVDVD</div>
            <div class='wp' id="hidden_ticket_date">20/09/2021</div>
        </div>



         <div id="info_ticket" style="margin-top: 1.5rem;">
          <div class='wp'>Table :</div>
		  <div class='wp'>Client :</div>
	   </div>
	   <div id="info_ticket_detail">
            <div class='wp' id="hidden_ticket_table">Table 1 </div>
		  <div class='wp' id="hidden_ticket_client">Client 1</div>
	   </div>




	   <hr>
	   <div class='info clearfix'>
		  <div class='wp'>
			 <h2>Article</h2>
		  </div>
		  <div class='wp'>
			 <h2>Qte</h2>
		  </div>
		  <div class='wp'>
			 <h2>Prix</h2>
		  </div>
	   </div>

	   <style>
		.wp {
			font-size:.8rem;
		}
		.wp h2{
			font-size:1.2rem;
		}
	   </style>


	   <div id="hidden_body_ticket">
	   </div>
	   <div class='total clearfix' id="hidden_total_ticket">
		  <h3 id="ticket_calc_price"  class="calculated-price" >
			 Total :
			 <p> 00.00 DH</p>
		  </h3>

		  <h3 id="ticket_free_price" class="offer-price d-none" >
			Total :
			<p> 00.00 DH</p>
		 </h3>
	   </div>
	   <div class='total clearfix' id="hidden_Remise_ticket" style="display: none" >
		  <h3>
			 Remise :
			 <p> 00.00 DH</p>
		  </h3>
	   </div>
	   <div class='total clearfix' id="hidden_ticket_rest" style="display: none" >
		  <h3>
			 Reste :
			 <p> 00.00 DH</p>
		  </h3>
	   </div>

	   <center>
		<h4 id="hidden_ticket_paie_methode">Espece</h4>
		<h4 id="hidden_ticket_user" >Utilisateur : <?php echo e(Auth::user()->username); ?></h4>

	 </center>

	   <center>
		  <p><?php echo e(Auth::user()->etab->msg); ?></p>
	   </center>
	</div>
 </div>





 <div class="box" id="hiddenbox2" style="display: none">
	<div class='inner'>
	   <h1 id=""><?php echo e(Auth::user()->etab->nom); ?></h1>
	   <div id="info_ticket2">
		  <div class='wp'>Ticket :</div>
		  <div class='wp'>Date :</div>
	   </div>
	   <div id="info_ticket_detail2">
		  <div class='wp' id="hidden_ticket_num2">RTGTVDVD</div>
            <div class='wp' id="hidden_ticket_date2">20/09/2021</div>
        </div>



         <div id="info_ticket2" style="margin-top: 1.5rem;">
          <div class='wp'>Table :</div>
          <div class='wp'>Remarque :</div>
	   </div>
	   <div id="info_ticket_detail2">
            <div class='wp' id="hidden_ticket_table2">Table 1 </div>
            <div  class='wp info_ticket_detail_cuisine2' id="info_ticket_detail2"> Remarque </div>
	   </div>




	   <hr>
	   <div class='info clearfix'>
		  <div class='wp'>
			 <h2>Article</h2>
		  </div>
		  <div class='wp'>
			 <h2>Qte</h2>
		  </div>

	   </div>

	   <style>
		.wp {
			font-size:.8rem;
		}
		.wp h2{
			font-size:1.2rem;
		}
	   </style>


	   <div id="hidden_body_ticket2">
	   </div>

	</div>
 </div>













 <div class="modal fade" id="pausedtickits" role="dialog" >
	<div class="modal-dialog " >
	   <div class="modal-content">
		  <div class="modal-header">
			 <h5 class="modal-title" id="exampleModalLabel">billets en attente</h5>
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			 <span aria-hidden="true">&times;</span>
			 </button>
		  </div>
		  <div class="" id="pausedtickitstable">



		  </div>
		  <div class="modal-footer">
			 <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
		  </div>
	   </div>
	</div>
 </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

<script src="<?php echo e(url('assets/js/sweetalert2.all.min.js')); ?>"></script>



<script src="<?php echo e(url('assets/plugins/keybord/dist/kioskboard-aio-1.3.3.min.js')); ?>"></script>


<script>
KioskBoard.Init({

keysArrayOfObjects: [{
	".": "."
}],

keysJsonUrl: "<?php echo e(url('assets/plugins/keybord/dist/kioskboard-keys-english.json')); ?>",

specialCharactersObject: null,
language: 'en',
theme: 'light',
capsLockActive: true,
allowRealKeyboard: true,
cssAnimations: true,
cssAnimationsDuration: 360,
cssAnimationsStyle: 'slide',
keysAllowSpacebar: true,
keysSpacebarText: 'Space',
keysFontFamily: 'sans-serif',
keysFontSize: '25px',
keysFontWeight: 'normal',
keysIconSize: '25px',
allowMobileKeyboard: true,
autoScroll: true,
});


// Run KioskBoard
// Select any input or textarea element(s) to run KioskBoard
KioskBoard.Run('.virtual-keyboard'); </script>


<script>



var count = 1;
var total = 0;
var qteArt = 0;
var totalTicket = [];
var totalTicketDH = 0;
var prixQte = 0;


$(document).ready(function () {


	localStorage.removeItem('isManager');

	localStorage.removeItem('nativeManager');
	localStorage.setItem('nativeManager',<?php echo e(Auth::user()->is_manager ? Auth::user()->is_manager : 0); ?>);


	if(localStorage.getItem('nativeManager')==1){
		console.log('native manager')
				document.getElementById("remise_btn").classList.add('d-none');
           	 	document.getElementById("remise_input").classList.remove('d-none');
            	document.getElementById("offert_option").classList.remove('d-none');
            	document.getElementById("deleteticket").classList.remove('d-none');
			}




	$("#paie_methode").on('change',function(){
		console.log($("#paie_methode").val());
		if($("#paie_methode").val()=="offert"){
			document.querySelectorAll('.calculated-price').forEach(x=>x.classList.add('d-none'));
			document.querySelectorAll('.offer-price').forEach(x=>x.classList.remove('d-none'));

		}
		else{
			document.querySelectorAll('.calculated-price').forEach(x=>x.classList.remove('d-none'));
			document.querySelectorAll('.offer-price').forEach(x=>x.classList.add('d-none'));
		}
	})



    $('#lebelle').on('keyup',function(e){

      	if (e.keyCode === 13) {
      let searcth_term = $(this).val();

      $.ajax({
		url: "<?php echo e(route('trav.search-prod-designation')); ?>",
		type: 'post',
		data: {
       searchTerm:searcth_term,
			_token: '<?php echo e(csrf_token()); ?>',
		},
		success: function (values) {
      let prods = JSON.parse(values);
      $('#articles').html('');

      Array.from(prods).forEach((prod,index)=>{
        $("#articles").append(`<div class="col-md-2 ">
    <button class="artLInk click_btn btn-primary ${index%2==0 ? 'btn-primary' : 'btn-success'}" style="width: 100%;min-height: 4rem;display: flex; align-items: center;justify-content: center;flex-direction: column; margin-bottom: .5rem" data-id="${prod.id}" data-prix="${prod.prix_vente}" data-art="${prod.lebelle}" data-unite="${prod.unite}" data-qte="${prod.qte}" data-type="${prod.type}">

    <b>${prod.lebelle}</b>
    <!-- <br><b>Quantité stock : </b>  -170 / qte -->
    <div><b>Prix : </b> ${prod.prix_vente}</div>


</button>
</div>`);
      })

    }
      })

        }
        
    });

  $('#clear_search').on('click',function(){
    $("#lebelle").val('');
      $('#articles').html('');
  })


$('#code_manager').on('show.bs.modal',function(){
	setTimeout(function(){
	document.getElementById('code_manager_password').focus();
	},500)

	})



    $("#paie_methode").on('change',function(){
        if($("#paie_methode").val()=="en-compte"){
            document.getElementById("client_list").classList.remove('d-none')
            document.querySelector(".client_list_col").classList.remove('d-none')
        }else{
            document.getElementById("client_list").classList.add('d-none')
            document.querySelector(".client_list_col").classList.add('d-none')
        }
    })



	function settickt(arraytick, data, body_ticket = "#body_ticket", total_ticket = "#total_ticket") {


				$(body_ticket).html('');

				var is_exist = false;
				var i = 0;
				if (data) {


				$.each(arraytick, function (key, value) {
					console.log(key)
					if (data.id == value.idProd) {
						is_exist = true;
						i = key;
						return;
					}
				});


				if (!is_exist) {

					var newprix = 0;
					var newqte = 0;


					if (data.uniteog == "kg") {

						if (data.unite == "kg") {
							newqte = parseFloat(data.qte);
							newprix += parseFloat(data.prix) * parseFloat(data.qte);
						} else {
							newqte = parseFloat(data.qte) / 1000;
							newprix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
						}

					} else if (data.uniteog == "g") {
						if (data.unite == "kg") {
							newqte = parseFloat(data.qte) * 1000;
							newprix += parseFloat(data.prix) * (parseFloat(data.qte) * 1000);
						} else {
							newqte = parseFloat(data.qte);
							newprix += parseFloat(data.prix) * (parseFloat(data.qte));
						}
					} else {
						newqte = parseFloat(data.qte);
						newprix = parseFloat(data.prix) * parseFloat(data.qte);
					}

					arraytick.push({
						idProd: data.id,
						prix: newprix,
						qte: newqte,
						name: data.name,
                        unite: data.uniteog,
                        type_prod:data.type_prod
					});


                //console.log("Here=>" , arraytick);
				} else {

					if (arraytick[i].unite == "kg") {

						if (data.unite == "kg") {
							arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
							arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte);
						} else {
							arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte) / 1000;
							arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) / 1000);
						}

					} else if (arraytick[i].unite == "g") {
						if (data.unite == "kg") {
							arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte) * 1000;
							arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte) * 1000);
						} else {
							arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
							arraytick[i].prix += parseFloat(data.prix) * (parseFloat(data.qte));
						}
					} else {
						arraytick[i].qte = parseFloat(arraytick[i].qte) + parseFloat(data.qte);
						arraytick[i].prix += parseFloat(data.prix) * parseFloat(data.qte);
					}

				}

				}

				totalTicketDH = 0;
				$.each(arraytick, function (index, val) {
					totalTicketDH = parseFloat(totalTicketDH) + parseFloat(arraytick[index].prix);
				});


				$.each(arraytick, function (key, value) {
					$(body_ticket).append(`
										<div class='info clearfix suprimerart ${value.type_prod != 3 ? 'hide_bar' : '' } ${value.type_prod != 1 ? 'hide_kitchen' : '' } '  data-id="${value.idProd}">
											<div class='wp'> ${value.name}</div>
											<div class='wp'> x ${value.qte.toFixed(2)} / ${value.unite}</div>
											<div class='wp'>${value.prix.toFixed(2)} DH</div>
										</div>`);

				});

				$('#total_a_payer').val(totalTicketDH);

				if($("#paie_methode").val()=="offert"){
					$(total_ticket).html(`<h2 class="calculated-price" style="font-size:1.7rem">Total : <p> ${totalTicketDH.toFixed(2)} DH</p></h2>`+`<h2 class="offer-price" style="font-size:1.7rem">Total : <p> 0.00 DH</p></h2>`);
					document.querySelectorAll('.calculated-price').forEach(x=>x.classList.add('d-none'))
					document.querySelectorAll('.offer-price').forEach(x=>x.classList.remove('d-none'))
				}
				else{
					$(total_ticket).html(`<h2 class="offer-price" style="font-size:1.7rem">Total : <p> 0.00 DH</p></h2>`+`<h2 class="calculated-price" style="font-size:1.7rem">Total : <p> ${totalTicketDH.toFixed(2)} DH</p></h2>`);
					document.querySelectorAll('.calculated-price').forEach(x=>x.classList.remove('d-none'))
					document.querySelectorAll('.offer-price').forEach(x=>x.classList.add('d-none'));

				}

					changeReste();
				changeRemise();


}


$('body').on('click', ".easy-get", () => {
	show_easy_numpad();
});

$('.catShowSpan').click(function () {
	$('.CategoryDiv').show();
	$('.catShowSpan').css("display", "none");
});

var artID = [];
var mainticket = [];
var ticketcons = [];


$("#allow_op_form").on('submit',function(e){
        e.preventDefault();

        let username = $("#code_manager_username").val();
        let password = $("#code_manager_password").val();

        $.ajax({
		url: "<?php echo e(route('trav.allow_op')); ?>",
		type: 'post',
		data: {
                username:username,
                password:password,
                _token:"<?php echo e(csrf_token()); ?>"
		},
		success: function (data) {

            document.getElementById("remise_btn").classList.add('d-none');
            document.getElementById("remise_input").classList.remove('d-none');
            document.getElementById("offert_option").classList.remove('d-none');
            document.getElementById("deleteticket").classList.remove('d-none');

            localStorage.setItem('isManager',1);

            $("#code_manager_username").val('');
            $("#code_manager_password").val('');
            $("#code_manager").hide();




		},
		error: function (data) {
			swal("il y a un problem technique...", "error");
		}
	});


    })


$('.cat').click(function () {
	var id_cat = $(this).data('id');
	var cat_nom = $(this).data('nom');


	$(".cat").removeClass('active');
	$(this).addClass('active');
	console.log(cat_nom);
	$.ajax({
		url: "<?php echo e(route('trav.get_articles.bycat')); ?>",
		type: 'get',
		data: {
			id: id_cat
		},
		success: function (data) {
			$('#tableArticle tr').remove();


			$('#articles').html(data);


			//console.log(data);

		},
		error: function (data) {
			swal("il y a un problem technique...", "error");
		}
	});

});

$('body').on('click', ".suprimerart", function () {

	if(localStorage.getItem('isManager')==1 || localStorage.getItem('nativeManager')==1){
		var id = $(this).data('id');
	var is_exist = false;
	var i = 0;
	$.each(mainticket, function (key, value) {
		console.log(key)
		if (id == value.idProd) {
			is_exist = true;
			i = key;
			return;
		}
	});
	console.log(mainticket)
	mainticket.splice(i, 1)

	console.log(mainticket)

	settickt(mainticket, null);
	}
});
$('body').on('click', ".artLInk", function () {

  console.log($(this).data('qte') >= 0,$(this).data('qte'))
  if($(this).data('qte') > 0){

	//$('#ticktunpause').prop('disabled', true);
	var id = $(this).data('id');

	var prix = $(this).data('prix');
	var name = $(this).data('art');
	var unite = $(this).data('unite');
	var qteact = $(this).data('qte');
	var type_prod = $(this).data('type');

  $(this).data('qte',qteact - 1);

	data = {
		id: id,
		prix: prix,
		qte: 1,
		name: name,
		unite: unite,
        uniteog: unite,
        type_prod:type_prod

	};

	if (unite == "qte") {
		settickt(mainticket, data);
	} else {
		var id = $('#idmodel').val(data.id);
		var prix = $('#prixmodel').val(data.prix);
		var name = $('#artmodel').val(data.name);
		var name = $('#uniteogmodel').val(data.unite);
		$('#exampleModalCenterTitlemyModalUnite').html(`${data.name} : ${qteact} / ${data.unite}`)
		$('#myModalUnite').appendTo("body").modal('show');
	}
  
  }
  else{
    console.log("Not enough");
  }

});
$('body').on('click', "#saveqteunite", function () {


	var id = $('#idmodel').val();
	var prix = $('#prixmodel').val();
	var name = $('#artmodel').val();
	var unite = $('#unitemodel').val();
	var qteact = $('#qtemodel').val();
	var uniteog = $('#uniteogmodel').val();


	data = {
		id: id,
		prix: prix,
		qte: qteact,
		name: name,
		unite: unite,
		uniteog: uniteog,

	};
	settickt(mainticket, data);

	$('#myModalUnite').appendTo("body").modal('hide');


});



$('#btnPrintBar').click(function () {
localStorage.setItem("ticket-type","barman");
	/*	 	$("div#printThis").css("dislay", "block");*/
	var idPrnsl = $('#prsnl').val();
	var type = $('#type').val();
	var total_a_payer = $('#total_a_payer').val();
	var prix_payer = $('#prix_payer').val();
	var remise = $('#remise').val();
	var table = $('#table_list').val();
	var paie = $('#paie_methode').val();
	var client = $('#client_list').val();
	var remarque = $('#remarque').val();
	$.ajax({
		url: "<?php echo e(route('trav.ticket-bar')); ?>",
		type: 'post',
		data: {
			idPrnsl: idPrnsl,
			ticket: mainticket,
			type: type,
			total_a_payer: total_a_payer,
			prix_payer: prix_payer,
			remise: remise,
            table:table,
            paie:paie,
            client:client,
            remarque:remarque,
			_token: '<?php echo e(csrf_token()); ?>',
		},
		success: function (values) {

			if (values.msg == "success") {

				$('#hidden_nomeleve_ticket2').text(values.data.eleve.nom + " " + values.data.eleve.prenom);
				$('#hidden_ticket_num2').text(values.data.tickt.numtick);
				$('#hidden_ticket_date2').text(values.data.tickt.date_operation);



				$('#hidden_ticket_table2').text(values.new_data.table ? values.new_data.table.nom : "  ");
                $('#hidden_ticket_client2').text(values.new_data.client ? values.new_data.client.nom : "  ");

                $('.info_ticket_detail_cuisine2').text(values.new_data.remarque ? values.new_data.remarque.remarque : "  ");



				settickt(mainticket, null, '#hidden_body_ticket2', '#hidden_total_ticket2');


				<?php if(Auth::user()->canprint): ?>
				PrintElem('hiddenbox2');
localStorage.removeItem("ticket-type");

				<?php else: ?>

				<?php endif; ?>


			} else {
				Swal.fire({
					icon: 'error',
					title: "erreur",
					text: values.text,
				});
                }



		},
		error: function (values) {
			Swal.fire({
				icon: 'error',
				title: 'error...',
				text: 'il y a un problem technique ou cette ticket est vide...',
			});

		}
	});


});







$('#btnPrintCuisine').click(function () {

localStorage.setItem("ticket-type","kitchen");

	/*	 	$("div#printThis").css("dislay", "block");*/
	var idPrnsl = $('#prsnl').val();
	var type = $('#type').val();
	var total_a_payer = $('#total_a_payer').val();
	var prix_payer = $('#prix_payer').val();
	var remise = $('#remise').val();
	var table = $('#table_list').val();
	var paie = $('#paie_methode').val();
	var client = $('#client_list').val();
	var remarque = $('#remarque').val();
	$.ajax({
		url: "<?php echo e(route('trav.ticket-cuisine')); ?>",
		type: 'post',
		data: {
			idPrnsl: idPrnsl,
			ticket: mainticket,
			type: type,
			total_a_payer: total_a_payer,
			prix_payer: prix_payer,
			remise: remise,
            table:table,
            paie:paie,
            client:client,
            remarque:remarque,
			_token: '<?php echo e(csrf_token()); ?>',
		},
		success: function (values) {

			if (values.msg == "success") {

				$('#hidden_nomeleve_ticket2').text(values.data.eleve.nom + " " + values.data.eleve.prenom);
				$('#hidden_ticket_num2').text(values.data.tickt.numtick);
				$('#hidden_ticket_date2').text(values.data.tickt.date_operation);



				$('#hidden_ticket_table2').text(values.new_data.table ? values.new_data.table.nom : "  ");
                $('#hidden_ticket_client2').text(values.new_data.client ? values.new_data.client.nom : "  ");

                $('.info_ticket_detail_cuisine2').text(values.new_data.remarque ? values.new_data.remarque.remarque : "  ");



				settickt(mainticket, null, '#hidden_body_ticket2', '#hidden_total_ticket2');


				<?php if(Auth::user()->canprint): ?>
				PrintElem('hiddenbox2');
localStorage.removeItem("ticket-type");
				<?php else: ?>

				<?php endif; ?>


			} else {
				Swal.fire({
					icon: 'error',
					title: "erreur",
					text: values.text,
				});
                }



		},
		error: function (values) {
			Swal.fire({
				icon: 'error',
				title: 'error...',
				text: 'il y a un problem technique ou cette ticket est vide...',
			});

		}
	});


});





$('.ticket').click(function () {
	/*	 	$("div#printThis").css("display", "block");*/
	var idPrnsl = $('#prsnl').val();
	var type = $('#type').val();
	var total_a_payer = $('#total_a_payer').val();
	var prix_payer = $('#prix_payer').val();
	var remise = $('#remise').val();
	var table = $('#table_list').val();
	var paie = $('#paie_methode').val();
	var client = $('#client_list').val();
	$.ajax({
		url: "<?php echo e(route('trav.ticket')); ?>",
		type: 'post',
		data: {
			idPrnsl: idPrnsl,
			ticket: mainticket,
			type: type,
			total_a_payer: total_a_payer,
			prix_payer: prix_payer,
			remise: remise,
            table:table,
            paie:paie,
            client:client,
			_token: '<?php echo e(csrf_token()); ?>',
		},
		success: function (values) {

			if (values.msg == "success") {

				$('#hidden_nomeleve_ticket').text(values.data.eleve.nom + " " + values.data.eleve.prenom);
				$('#hidden_ticket_num').text(values.data.tickt.numtick);
				$('#hidden_ticket_date').text(values.data.tickt.date_operation);



				$('#hidden_ticket_table').text(values.new_data.table ? values.new_data.table.nom : "  ");
                $('#hidden_ticket_client').text(values.new_data.client ? values.new_data.client.nom : "  ");



				settickt(mainticket, null, '#hidden_body_ticket', '#hidden_total_ticket');

				$('#prix_payer').val(0);
				$('#remise').val(0);
				$('#reste_ticket').hide();
				$('#Remise_ticket').hide();

				<?php if(Auth::user()->canprint): ?>
				PrintElem('hiddenbox');
				setTimeout(function () {
					mainticket = [];
					settickt(mainticket, null)
				}, 200);
				<?php else: ?>
				setTimeout(function () {
					mainticket = [];
					settickt(mainticket, null)
				}, 200);
				<?php endif; ?>


			} else {
				Swal.fire({
					icon: 'error',
					title: "erreur",
					text: values.text,
				});
                }



            document.getElementById("remise_btn").classList.remove('d-none');
            document.getElementById("remise_input").classList.add('d-none');
            document.getElementById("offert_option").classList.add('d-none');
            document.getElementById("deleteticket").classList.add('d-none');
            document.getElementById("remise_btn").classList.remove('d-none');

            localStorage.removeItem('isManager');

			if(localStorage.getItem('nativeManager')==1){
				document.getElementById("remise_btn").classList.add('d-none');
           	 	document.getElementById("remise_input").classList.remove('d-none');
            	document.getElementById("offert_option").classList.remove('d-none');
            	document.getElementById("deleteticket").classList.remove('d-none');
			}

		},
		error: function (values) {
			Swal.fire({
				icon: 'error',
				title: 'error...',
				text: 'il y a un problem technique ou cette ticket est vide...',
			});

		}
	});


});


$('#ticktpause').click(function () {
	/*	 	$("div#printThis").css("display", "block");*/
	var idPrnsl = $('#prsnl').val();
	var type = $('#type').val();
	var total_a_payer = $('#total_a_payer').val();
	var prix_payer = $('#prix_payer').val();
	var remise = $('#remise').val();
	var table = $('#table_list').val();
	var paie = $('#paie_methode').val();
	var client = $('#client_list').val();
	$.ajax({
		url: "<?php echo e(route('trav.ticket.puase')); ?>",
		type: 'post',
		data: {
			idPrnsl: idPrnsl,
			ticket: mainticket,
			type: type,
			total_a_payer: total_a_payer,
			prix_payer: prix_payer,
			remise: remise,
			table: table,
			paie: paie,
			client: client,
			_token: '<?php echo e(csrf_token()); ?>',
		},
		success: function (values) {

			if (values.msg == "success") {
				mainticket = [];

					$('#prix_payer').val(0);
					$('#remise').val(0);
				settickt(mainticket, null);
				let optsCoutn = $('#optsCoutn');
				$('#optsCoutn').text(parseInt(optsCoutn.data("optscoutn")) + 1);
				$('#optsCoutn').data("optscoutn",parseInt(optsCoutn.data("optscoutn")) + 1);
				//$('#ticktunpause').prop('disabled', false);
			} else {
				Swal.fire({
					icon: 'error',
					title: "erreur",
					text: values.text,
				});
			}
		},
		error: function (values) {
			Swal.fire({
				icon: 'error',
				title: 'error...',
				text: 'il y a un problem technique ou cette ticket est vide...',
			});

		}
	});


});
$("body").on('click', '.pausedtickbtn', function (e) {
	var id_opt = $(this).data("idopt");


	$.ajax({
		url: "<?php echo e(route('trav.ticket.unpause.id','')); ?>/" + id_opt,
		type: 'get',
		success: function (values) {
			console.log(values.data)
			ticketcons = [];
			if (values.msg == "success") {

			    $('#prix_payer').val(values.data.tickt.prix_payer);
				$('#remise').val(values.data.tickt.remise);


				$('#paie_methode').val(values.data.tickt[0].methode_paie).change();
				$('#client_list').val(values.data.tickt[0].id_client).change();
				$('#table_list').val(values.data.tickt[0].id_table).change();



				let optsCoutn = $('#optsCoutn');
				$('#optsCoutn').text(parseInt(optsCoutn.data("optscoutn")) - 1);
				$('#optsCoutn').data("optscoutn",parseInt(optsCoutn.data("optscoutn")) - 1);
				//$('#ticktunpause').prop('disabled', true);
				$.each(values.data.detail, function (key, value) {

					settickt(mainticket, value);
				})


			}
		}

	});
});


$("#ticktunpause").on('click',function (e) {


	$.ajax({
		url: "<?php echo e(route('trav.get.ticket.pauseed')); ?>",
		type: 'get',
		data: {

			_token: '<?php echo e(csrf_token()); ?>',
		},
		success: function (values) {
			console.log(values.text)

			$("#pausedtickits").modal('show');
			$("#pausedtickitstable").html(" ")
			$("#pausedtickitstable").html(values.text);
		},
		error: function (values) {
			Swal.fire({
				icon: 'error',
				title: 'error...',
				text: 'il y a un problem technique ou cette ticket est vide...',
			});

		}
	});


});
$("#deleteticket").on('click',function (e) {
	mainticket = [];

				  $('#prix_payer').val(0);
				  $('#remise').val(0);
			  settickt(mainticket, null);
			  //$('#ticktunpause').prop('disabled', false);
});
$('.numbre').click(function (event) {
	$('.poidsInputGroup').removeClass('is-focused');
	var val = $(this).val();
	var numbre = $('.poidsInput').val() + val.toString();
	console.log(numbre);
	$('.poidsInput').val(numbre);
	$('.poidsInputGroup').addClass('is-focused');
});


$('.reset').click(function () {
	location.reload();
});

$('.numbreC').click(function () {
	$('.poidsInput').val('');
});


$('.consulte').click(function () {
	$.ajax({
		url: "<?php echo e(route('trav.consulte')); ?>",
		type: 'get',
		success: function (data) {
			/*$("#example").dataTable().fnDestroy();*/
               // console.log(data);

                if(localStorage.getItem("isManager")==1 || localStorage.getItem("nativeManager")==1){


	$('#tableOperationConsult tr').remove();
			$.each(data.operations, function (key, value) {
				if (value.cloturage == null) {
					var cloturage = 'non';
				} else {
					var cloturage = 'oui';
				}
				$('#tableOperationConsult').append(`<tr>
				<td> <span data-id="${value.id}" class="badge badge-pill badge-primary showtickdetail" > ${value.numtick}</span> </td>
				<td>${cloturage}</td>
				<td>${value.date_operation}</td>
				<td>

					<a  href="<?php echo e(url('trav/delete-opt/')); ?>/${value.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cette operation');" class=" btn-delete-tick  btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>


				 </td>


				</tr>`);
			});

                }
                else{
	$('#tableOperationConsult tr').remove();
			$.each(data.operations, function (key, value) {
				if (value.cloturage == null) {
					var cloturage = 'non';
				} else {
					var cloturage = 'oui';
				}
				$('#tableOperationConsult').append(`<tr>
				<td> <span data-id="${value.id}" class="badge badge-pill badge-primary showtickdetail" > ${value.numtick}</span> </td>
				<td>${cloturage}</td>
				<td>${value.date_operation}</td>
				<td>

					<a  href="<?php echo e(url('trav/delete-opt/')); ?>/${value.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cette operation');" class=" btn-delete-tick d-none btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>


				 </td>


				</tr>`);
			});

                }

			$('#tableOperationConsult tr').remove();
			$.each(data.operations, function (key, value) {
				if (value.cloturage == null) {
					var cloturage = 'non';
				} else {
					var cloturage = 'oui';
				}


                    if(localStorage.getItem('isManager')==1 || localStorage.getItem('nativeManager')==1){
                        	$('#tableOperationConsult').append(`<tr>
				<td> <span data-id="${value.id}" class="badge badge-pill badge-primary showtickdetail" > ${value.numtick}</span> </td>
				<td>${cloturage}</td>
				<td>${value.date_operation}</td>
				<td>

					<a  href="<?php echo e(url('trav/delete-opt/')); ?>/${value.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cette operation');" class=" btn-delete-tick btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>


				 </td>


				</tr>`);

                    }else{
                        	$('#tableOperationConsult').append(`<tr>
				<td> <span data-id="${value.id}" class="badge badge-pill badge-primary showtickdetail" > ${value.numtick}</span> </td>
				<td>${cloturage}</td>
				<td>${value.date_operation}</td>
				<td>

					<a  href="<?php echo e(url('trav/delete-opt/')); ?>/${value.id}/"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cette operation');" class=" d-none btn-delete-tick btn btn-danger btn-sm">
                     <i class="material-icons">close</i> </a>


				 </td>


				</tr>`);

                    }


                });
		},
		error: function (values) {

		}
	});
});
///@@@@@@@@@@@@@@@@@@ Imprimer_Cloturage @@@@@@@@@@@
$('#Imprimer_Cloturage').click(function () {
	$.ajax({
		url: "<?php echo e(route('trav.Imprimer_Cloturage')); ?>",
		type: 'get',
		success: function (data) {
			PrintDiv(data);

		},
		error: function (values) {

		}
	});
});


$("body").on('click', '.showtickdetail', function (e) {
	e.preventDefault();
	var id = $(this).data('id');
	console.log(id);
	$.ajax({
		url: "<?php echo e(route('trav.tableOperationConsult')); ?>",
		type: 'get',
		data: {
			id: id
		},
		dataType: "json",
		success: function (data) {
			console.log(data)

			$('#tableProdConsult tr').remove();
			$.each(data.prods, function (key, value) {
				if (value.typeQte == null) {
					var qte = ' ';
				} else {
					var qte = value.typeQte;
				}
				$('#tableProdConsult').append(
					'<tr><td>' + value.lebelle +
					'</td><td>' + value.prixTicket +
					'</td><td>' + value.qte_prod + ' ' + qte +
					'</td></tr>');
			});

			<?php if(Auth::user()->canprint): ?>


			$('#tableProdConsult').append(
				`<tr >
							<td col="3">
								<button type="button" class="btn btn-success  " data-id="${id}"
								 style="" id="btnPrintcon" >Imprimer</button>
							</td>
						</tr>`);
			<?php endif; ?>


		},
		error: function (values) {
			swal("il y a un problem technique...", "error");
		}
	});
});


$('.cloturage').click(function (e) {
	e.preventDefault();

	$.ajax({
		url: "<?php echo e(route('trav.cloturage')); ?>",
		type: 'get',
		success: function (data) {

			console.log(data)
			if (data != "") {
                Swal.fire({


					title: 'votre cloturage est',
					text: 'Total : ' + (data.montant - data.montant_offert)+ ' , Espece : ' + data.montant_espece + ' Carte : ' + data.montant_carte + ' Offert : '+data.montant_offert+' Sur Compte : '+data.montant_compte,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'oui'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url: "<?php echo e(route('trav.cloturage.confirm')); ?>",
							type: 'get',
							success: function (data) {

								console.log(data)

								location.reload();
							},
						});
						//location.reload();
					}
				});
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'un cloturage exist déja ...',
				});
			}
		},
		error: function (values) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'un cloturage exist déja ...',
			}).then(function (isConfirm) {
				if (isConfirm) {
					location.reload();
				}
			});

		}
	});
});


$('.mode').click(function () {
	var id = $(this).data('id');
	$.ajax({
		url: "<?php echo e(route('trav.modeCaisse')); ?>",
		type: 'get',
		data: {
			id: id
		},
		success: function (data) {
			console.log(data);

			location.reload();
		},
		error: function (values) {

		}
	});
});

$("#code_bar").on('keyup', function (e) {

	var valu = $(this);

  if (e.keyCode === 13) {


		$.ajax({
			type: "get",
			url: "<?php echo e(route('trav.getprodbycode_bar')); ?>",
			data: {
				code_bar: valu.val()
			},
			success: function (data) {
				valu.val('');
				if (data.msg == "success") {


					settickt(mainticket, data.data);


				} else {
					valu.val('');
				}


			}
		});
	}
});


$("body").on('click', '#btnPrintcon', function (e) {

	var id_opt = $(this).data("id");


	$.ajax({
		url: "<?php echo e(route('trav.ticket.opt','')); ?>/" + id_opt,
		type: 'get',
		success: function (values) {
			console.log(values.data)
			ticketcons = [];
			if (values.msg == "success") {

				$('#hidden_nomeleve_ticket').text(values.data.eleve.nom + " " + values.data.eleve.prenom);
				$('#hidden_ticket_num').text(values.data.tickt.numtick);
                $('#hidden_ticket_date').text(values.data.tickt.date_operation);


				$('#hidden_ticket_table').text(values.new_data.table.nom);
                $('#hidden_ticket_client').text(values.new_data.client.nom);

				$('#hidden_prix_payer_model').val(values.data.tickt.prix_payer)
				$('#hidden_remise_model').val(values.data.tickt.remise)



				$.each(values.data.detail, function (key, value) {

					settickt(ticketcons, value, '#hidden_body_ticket', '#hidden_total_ticket');
				})


				if($("#paie_methode").val()=="offert"){
					document.getElementById("ticket_calc_price").remove();
				}
				else{
					document.getElementById("ticket_free_price").remove();
				}




				PrintElem('hiddenbox');

				setTimeout(function () {

					$('#hidden_prix_payer_model').val(0);
					$('#hidden_remise_model').val(0);
					$('#reste_ticket').hide();
					$('#Remise_ticket').hide();
					$('#paie_methode').val("espece").change();
				}, 50)
			}
		}

	});
});


$("#prix_payer").on('change keyup', function (e) {

	settickt(mainticket, null, '#hidden_body_ticket', '#hidden_total_ticket');

	setTimeout(()=> {
		changeReste();
	}
      ,500);


});
// remise_ticket
$("#remise").on('change keyup', function (e) {


	settickt(mainticket, null, '#hidden_body_ticket', '#hidden_total_ticket');


});

function changeReste() {

	var prix_payer = $("#prix_payer").val() > 0 ? $("#prix_payer").val() : $('#hidden_prix_payer_model').val();
	var remise = $("#remise").val() > 0 ? $("#remise").val() : $('#hidden_remise_model').val();
	var totalTic = $('#total_a_payer').val();


	if (prix_payer > 0) {
		$('#reste_ticket').show();
		$('#reste_ticket').html(`<h2>Reste : <p> ${(prix_payer - (totalTic - totalTic*remise/100)).toFixed(2) } DH</p></h2>`);

		$('#hidden_ticket_rest').show();

		$('#hidden_ticket_rest').html(`<h2>Reste : <p> ${(prix_payer - (totalTic - totalTic*remise/100)).toFixed(2) } DH</p></h2>`);
	} else {
		$('#hidden_ticket_rest').hide();
		$('#reste_ticket').hide();

	}
}

function changeRemise() {
	var remise = $("#remise").val() > 0 ? $("#remise").val() : $('#hidden_remise_model').val();
	var totalTic = $('#total_a_payer').val();


	if (remise > 0) {
		$('#Remise_ticket').show();
		$('#Remise_ticket').html(`<h2>Remise : <p>${remise}%</p> <br> Montant TTC:  <p> ${(totalTic - totalTic*remise/100 ).toFixed(2) } DH</p></h2>`);
		$('#hidden_Remise_ticket').show();
		$('#hidden_Remise_ticket').html(`<h2>Remise : <p>${remise}%</p> <br> Montant TTC: <p> ${(totalTic - totalTic*remise/100 ).toFixed(2) } DH</p></h2>`);
	} else {

		$('#hidden_Remise_ticket').hide();
		$('#Remise_ticket').hide();
	}
}

});

var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
var btn = $('.fullscreen');
if (btn.data('id') == 1) {
	btn.html('<span class="material-icons">fullscreen_exit</span>')
	btn.data("id", 0)

	if (elem.requestFullscreen) {
		elem.requestFullscreen();
	} else if (elem.webkitRequestFullscreen) {
		/* Safari */
		elem.webkitRequestFullscreen();
	} else if (elem.msRequestFullscreen) {
		/* IE11 */
		elem.msRequestFullscreen();
	}
} else {
	btn.html('<span class="material-icons">fullscreen</span>')
	btn.data("id", 1)
	if (document.exitFullscreen) {
		document.exitFullscreen();
	} else if (document.webkitExitFullscreen) {
		/* Safari */
		document.webkitExitFullscreen();
	} else if (document.msExitFullscreen) {
		/* IE11 */
		document.msExitFullscreen();
	}

}
}

/* Close fullscreen */
function closeFullscreen() {

}

function PrintElem(elem) {
var mywindow = window.open('', 'PRINT', 'height=400,width=600');

if($("#paie_methode").val()=="offert"){
			document.querySelectorAll('.calculated-price').forEach(x=>x.classList.add('d-none'));
			document.querySelectorAll('.offer-price').forEach(x=>x.classList.remove('d-none'));

		}
		else{
			document.querySelectorAll('.calculated-price').forEach(x=>x.classList.remove('d-none'));
			document.querySelectorAll('.offer-price').forEach(x=>x.classList.add('d-none'));



		}

        document.getElementById('hidden_ticket_paie_methode').innerText = document.getElementById('paie_methode').value;

        if(localStorage.getItem('ticket-type')=="kitchen"){

		document.querySelectorAll('.hide_kitchen').forEach(x=>x.classList.add('d-none'));
        }

        if(localStorage.getItem('ticket-type')=="barman"){

		document.querySelectorAll('.hide_bar').forEach(x=>x.classList.add('d-none'));
        }







mywindow.document.write('<html><head>');
mywindow.document.write("<link href=\"<?php echo e(url('assets/css/ticket.css')); ?>\" rel=\"stylesheet\">")
mywindow.document.write('</head><body >');
mywindow.document.write(document.getElementById(elem).innerHTML);
mywindow.document.write('</body></html>');

mywindow.document.close(); // necessary for IE >= 10
mywindow.focus(); // necessary for IE >= 10*/


setTimeout(function () {
	mywindow.print();
    mywindow.close();
    document.querySelectorAll('.hide_kitchen').forEach(x=>x.classList.remove('d-none'));
    document.querySelectorAll('.hide_bar').forEach(x=>x.classList.remove('d-none'));
}, 1000)
return true;
}

function PrintDiv(elem) {
var mywindow = window.open('', 'PRINT', 'height=400,width=600');

mywindow.document.write('<html><head>');
mywindow.document.write('</head><body >');
mywindow.document.write(elem);
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Trav.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Trav/index.blade.php ENDPATH**/ ?>