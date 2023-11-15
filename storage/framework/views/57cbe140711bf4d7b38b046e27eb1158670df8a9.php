<style>
    @import  url(https://fonts.googleapis.com/css?family=Arvo);

    .box * {
        font-family: Arvo;
    }

    .box {
        margin: 0px auto;
        color: #333;
        text-transform: uppercase;
        padding: 8px;
        font-weight: bold;
        text-shadow: 0px 1px 0px #fff;
        font-family: "arvo";
        font-size: 11px;
    }

    .inner h1 {
        padding: 5px 0px;
        margin: 0px;
        font-size: 18px;
        border-bottom: 1px solid rgba(51, 51, 51, 0.3);
        text-align: center;
    }

    #info_ticket .wp {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    #info_ticket_detail .wp,
    #info_ticket .wp {
        width: 24%;
        display: inline-block;
        box-sizing: border-box;
        text-align: center;
        padding: 10px;

    }

    #info_ticket_detail .wp {
        padding-top: 0px
    }

    .clearfix:after {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;

    }

    .total h2 {

        margin: 4px 0px;
        font-size: 15px;
    }

    .total p {
        float: right;
        margin: 0px;
        margin-right: 15px;
    }



    #operation_info_ticket .wp {
        font-size: 17px;
        font-weight: 600;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    #operation_info_ticket_detail .wp,
    #operation_info_ticket .wp {
        width: 49%;
        display: inline-block;
        box-sizing: border-box;
        text-align: center;
    }

    #operation_info_ticket_detail .wp {

        margin-bottom: 10px;
    }

    .operationbox {

        border: 3px #333;
        border-style: dashed;
        padding: 5px 15px;
        margin-bottom: 15px
    }

    .operationboxinfo .wp {
        width: 24%;
        display: inline-block;
        box-sizing: border-box;
        text-align: left>0;
    }

    .operationboxinfo .wp:first-child {
        width: 50%;
        display: inline-block;
        box-sizing: border-box;
        text-align: left>0;
    }

    .operationboxdetail .wp {
        width: 24%;
        display: inline-block;
        box-sizing: border-box;
        text-align: left;
        margin-bottom: 10px
    }

    .operationboxdetail .wp:first-child {
        width: 50%;
        display: inline-block;
        box-sizing: border-box;
        text-align: left;
        margin-bottom: 10px
    }
</style>

<div class="box" id="hiddenbox">
    <div class='inner'>
        <h1 id=""><?php echo e(Auth::user()->etab->nom); ?></h1>

        <div id="info_ticket">
            <div class='wp'>Cloturage ID :</div>
            <div class='wp'>Date :</div>
            <div class='wp'>Num Operation :</div>
            <div class='wp'>montant :</div>

        </div>
        <div id="info_ticket_detail">
            <div class='wp'><?php echo e($Cloturage->id); ?></div>
            <div class='wp'><?php echo e($Cloturage->created_at); ?></div>
            <div class='wp'><?php echo e($Cloturage->nombreOperation); ?></div>
            <div class='wp'><b><?php echo e((float)$Cloturage->montant_espece + (float)$Cloturage->montant_carte + (float)$Cloturage->montant_compte +(float)$Cloturage->montant_offert); ?> DH</b></div>
        </div>

        <br>

        <h2>TOTAL VENTES :</h2>

        <br>

        <div id="info_ticket">
            <div class='wp'>Espece :</div>
            <div class='wp'>Carte :</div>
            <div class='wp'>Sur Compte :</div>
            <div class='wp'>Offert :</div>

        </div>
        <div id="info_ticket_detail">
            <div class='wp'><?php echo e((float)$Cloturage->montant_espece); ?> DH</div>
            <div class='wp'><?php echo e((float)$Cloturage->montant_carte); ?> DH</div>
            <div class='wp'><?php echo e((float)$Cloturage->montant_compte); ?> DH</div>
            <div class='wp'><?php echo e((float)$Cloturage->montant_offert); ?> DH</div>
        </div>
        <div id="info_ticket">

            <div class='wp'><b>Total : </b> </div>

        </div>
        <div id="info_ticket_detail">


            <div class='wp'><b><?php echo e((float)$Cloturage->montant_espece + (float)$Cloturage->montant_carte + (float)$Cloturage->montant_compte +(float)$Cloturage->montant_offert); ?> DH</b></div>

        </div>
        <br>

        <h2>TOTAL TIROIR :</h2>

        <br>

        <div id="info_ticket">
            <div class='wp'>Espece :</div>
            <div class='wp'>Carte :</div>
            <div class='wp'><b>Total : </b></div>

        </div>
        <div id="info_ticket_detail">
            <div class='wp'><?php echo e((float)$Cloturage->montant_espece); ?> DH</div>
            <div class='wp'><?php echo e((float)$Cloturage->montant_carte); ?> DH</div>
            <div class='wp'><b><?php echo e((float)$Cloturage->carte + (float)$Cloturage->montant_espece  + (float)$Cloturage->montant_carte); ?> DH</b></div>
        </div>


        <br>

        <h2>Transactions :</h2>

        <br>

        <div id="info_ticket">
            <div class='wp'>Nb Espece :</div>
            <div class='wp'>Nb Carte :</div>
            <div class='wp'>Nb Sur Compte :</div>
            <div class='wp'>Nb Offert :</div>

        </div>
        <div id="info_ticket_detail">

            <div class='wp'><?php echo e($Compteur['espece']); ?></div>
            <div class='wp'><?php echo e($Compteur['carte']); ?></div>
            <div class='wp'><?php echo e($Compteur['compte']); ?></div>
            <div class='wp'><?php echo e($Compteur['offert']); ?></div>

        </div>
        <div id="info_ticket">

            <div class='wp'><b>Nb Remise 5% : </b> </div>
            <div class='wp'><b>Nb Remise 10% : </b> </div>
            <div class='wp'><b>Nb Remise 15% : </b> </div>
            <div class='wp'><b>Nb Remise 20% : </b> </div>

        </div>
        <div id="info_ticket_detail">


            <div class='wp'><?php echo e($Compteur['remise_cinq']); ?> </div>
            <div class='wp'><?php echo e($Compteur['remise_dix']); ?> </div>
            <div class='wp'><?php echo e($Compteur['remise_quinze']); ?> </div>
            <div class='wp'><?php echo e($Compteur['remise_vingt']); ?> </div>
        </div>


        <div id="info_ticket">
            <div class='wp'><b>MT Remise 5% : </b> </div>
            <div class='wp'><b>MT Remise 10% : </b> </div>
            <div class='wp'><b>MT Remise 15% : </b> </div>
            <div class='wp'><b>MT Remise 20% : </b> </div>
        </div>
        <div id="info_ticket_detail">

            <div class='wp'><?php echo e($Compteur['montant_remise_cinq']); ?> </div>
            <div class='wp'><?php echo e($Compteur['montant_remise_dix']); ?> </div>
            <div class='wp'><?php echo e($Compteur['montant_remise_quinze']); ?> </div>
            <div class='wp'><?php echo e($Compteur['montant_remise_vingt']); ?> </div>
        </div>
        <div id="info_ticket">
            <div class='wp'><b>Nb Retour : </b> </div>
            <div class='wp'><b>MT Retour : </b> </div>
        </div>
        <div id="info_ticket_detail">
            <div class='wp'><?php echo e($Compteur['retour']); ?> </div>
            <div class='wp'> <?php echo e($Compteur['montant_retour']); ?> </div>
        </div>




        
        <?php $__currentLoopData = $Cloturage->operations()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        

<?php $__currentLoopData = $operation->DetailOperations()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class='total clearfix' id="hidden_total_ticket">
    

</div>

<?php if($operation->remise>0): ?>
<div class='total clearfix'>
    

</div>
<?php endif; ?>
<?php if($operation->prix_payer && $operation->prix_payer>0): ?>
<div class='total clearfix'>
    
</div>
<?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div><?php /**PATH E:\wamp64\www\caisse\resources\views/Trav/print/Imprimer_Cloturage_v2.blade.php ENDPATH**/ ?>