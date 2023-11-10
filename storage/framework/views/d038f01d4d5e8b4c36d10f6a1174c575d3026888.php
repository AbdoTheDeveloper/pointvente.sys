
<style>
    @import  url(https://fonts.googleapis.com/css?family=Arvo);


@media  print {
    body{
        max-width:inherit;
        margin: inherit;
        width: 100%;
    }
    .box{ page-break-before: always;
    }
    .operationbox{
        break-inside: avoid;
    }
}

body{
    width: 900px;
    margin: auto
}

.box *{
  font-family:Arvo;}
.box{
  margin:0px auto;
   color:#333;
  text-transform:uppercase;
  padding:8px;
  font-weight:bold;
  text-shadow:0px 1px 0px #fff;
  font-family:"arvo";
  font-size: 11px;
}
 .inner h1{
  padding:5px 0px;
  margin:0px;
  font-size:30px;
  border-bottom: 1px solid rgba(51, 51, 51, 0.3);
  text-align:center;
}

#info_ticket .wp{
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 15px;
}
#info_ticket_detail .wp ,#info_ticket .wp{
    width: 24%;
    display: inline-block;
    box-sizing: border-box;
    text-align: center;
    padding: 10px;

}
#info_ticket_detail .wp{
    padding-top: 0px
}

.clearfix:after {
  content: ".";
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;

}

.total h2{

 margin:4px 0px;
 font-size: 15px;
}
.total p{float:right;margin:0px;margin-right: 15px;}



#operation_info_ticket .wp{
    font-size: 17px;
    font-weight: 600;
    margin-bottom: 10px;
    text-transform: uppercase;
}

#operation_info_ticket_detail .wp ,#operation_info_ticket .wp{
    width: 49%;
    display: inline-block;
    box-sizing: border-box;
    text-align: center;
}
#operation_info_ticket_detail .wp{

    margin-bottom: 10px;
}
.operationbox{

border: 3px #333;
border-style: dashed;
padding: 5px 15px;
margin-bottom: 15px
}

.operationboxinfo .wp {
    width: 33%;
    display: inline-block;
    box-sizing: border-box;
    text-align: left>0;
}

.operationboxdetail .wp {
    width: 33%;
    display: inline-block;
    box-sizing: border-box;
    text-align: left;
    margin-bottom: 10px
}

    </style>

<body>

    <?php ($recttotal = 0); ?>
    <?php ($espece = 0); ?>
    <?php ($carte = 0); ?>
    <?php ($compte = 0); ?>
    <?php ($offert = 0); ?>


<?php $__currentLoopData = $cloturages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Cloturage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php ($recttotal += $Cloturage->montant); ?>
<?php ($espece = $Cloturage->montant_espece ? $espece + $Cloturage->montant_espece : $espece); ?>
<?php ($carte = $Cloturage->montant_carte ? $carte + $Cloturage->montant_carte : $carte); ?>
<?php ($compte = $Cloturage->montant_compte ? $compte + $Cloturage->montant_compte : $compte); ?>
<?php ($offert = $Cloturage->montant_offert ? $offert + $Cloturage->montant_offert : $offert); ?>

<div class="box" id="hiddenbox" >
	<div class='inner'>
        <h1 id=""><?php echo e(Auth::user()->nom); ?></h1>
	<div id="info_ticket">
		<div class='wp'>Cloturage ID :</div>
		<div class='wp'>Date :</div>
        <div class='wp'>Num Operation :</div>
        <div class='wp'>montant :</div>

	</div>
	<div id="info_ticket_detail">
		<div class='wp' ><?php echo e($Cloturage->id); ?></div>
		<div class='wp' ><?php echo e($Cloturage->created_at); ?></div>
        <div class='wp' ><?php echo e($Cloturage->nombreOperation); ?></div>
        <div class='wp' ><?php echo e((float)$Cloturage->montant); ?> DH</div>
	</div>

	<hr>
	<?php $__currentLoopData = $Cloturage->operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="operation">
    <div id="operation_info_ticket">
		<div class='wp'>Ticket :</div>
		<div class='wp'>Date :</div>
	</div>
	<div id="operation_info_ticket_detail">
		<div class='wp' id="hidden_ticket_num"><?php echo e($operation->numtick); ?></div>
		<div class='wp' id="hidden_ticket_date"><?php echo e($operation->created_at); ?></div>
	</div>
    </div>
   <div class="operationbox">
    <div class='operationboxinfo clearfix'>
        <div class='wp'><h2>Article</h2></div>
        <div class='wp'><h2>Qte</h2></div>
        <div class='wp'><h2>Prix</h2></div>
      </div>
      <hr>
    <?php $__currentLoopData = $operation->DetailOperations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class='operationboxdetail clearfix'>
        <?php ($arti = $detail->article); ?>
        <?php ( $lebelle = $arti ? $arti->lebelle : ''); ?>
        <div class='wp'> <?php echo e($lebelle); ?></div>
        <div class='wp'> <?php echo e($detail->qte_prod); ?></div>
        <div class='wp'> <?php echo e($detail->prix); ?></div>
      </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <hr>
    <div class='total clearfix' id="hidden_total_ticket">
		<h2>Total : <p> <?php echo e($operation->total_a_payer); ?> DH</p></h2>

	</div>

    <?php if($operation->remise>0): ?>
        <div class='total clearfix' >
	<h2> Remise : <?php echo e($operation->remise); ?> % <p> <?php echo e($operation->total_a_payer - ($operation->total_a_payer*$operation->remise/100)); ?> DH</p></h2>

    </div>
    <?php endif; ?>
    <?php if($operation->prix_payer && $operation->prix_payer>0): ?>
	<div class='total clearfix' >
		<h2>Reste : <p> <?php echo e($operation->prix_payer - $operation->total_a_payer); ?> DH</p></h2>
	</div>
    <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





<h1 style="display: inline-block"> Total  Espece:  </h1>
           <p  style="display: inline-block; float:right;font-size:20px"><?php echo e($espece); ?> DH </p>

    <br>

<h1 style="display: inline-block"> Total  Carte:  </h1>
           <p  style="display: inline-block; float:right;font-size:20px"><?php echo e($carte); ?> DH </p>

<br>

<h1 style="display: inline-block"> Total  Compte:  </h1>
    <p  style="display: inline-block; float:right;font-size:20px"><?php echo e($compte); ?> DH </p>

    <br>

<h1 style="display: inline-block"> Total  Offert:  </h1>
    <p  style="display: inline-block; float:right;font-size:20px"><?php echo e($offert); ?> DH </p>


<br>
           <h1 style="display: inline-block"> Total  Recette:  </h1>
    <p  style="display: inline-block; float:right;font-size:20px"><?php echo e($recttotal - $offert); ?> DH </p>

<?php /**PATH /home/c2mserver/public_html/caisse.gcmi.store/resources/views/Admin/recette/Imprimer_Cloturage.blade.php ENDPATH**/ ?>