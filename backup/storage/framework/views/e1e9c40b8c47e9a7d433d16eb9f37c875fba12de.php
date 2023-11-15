<?php if(strtolower($eleve->classe->nom) == "staff"): ?>
<div style="display:flex; padding:10px;clear:both;     padding-bottom: 0;  ">

<div  style="width: fit-content;">

<img width="40" style="" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG(substr(md5($eleve->id),0,10), 'QRCODE',4,4)); ?>"> 
<img width="40" style="margin-top: 5px ; display: flex;"  src="<?php echo e(url('/assets/images/logo.png')); ?>" >

</div>
<div   style="position:relative;margin-left:7px;    width: 100%;">
<h1 style="margin-bottom: 1rem;

font-family: Oswald,Helvetica Neue,Arial,sans-serif;
font-size: 18px;

color: rgba(57,68,77,.84);

margin: 0;">CARTE STAFF</h1>
<h1 style="margin-bottom: 1rem;
font-family: Oswald,Helvetica Neue,Arial,sans-serif;
font-weight: 700;
margin-top:5px;
margin-bottom: 0px;

font-size: 14px;"><?php echo e($eleve->nom." ".$eleve->prenom); ?></h1>
  
  <div >
      <div  style="font-size: 10px; margin-bottom: 5px;">
         <span class="contact"><b>Matricule:</b> <?php echo e($eleve->username); ?></span> <br>
     
  </div>
  </div>   
 
</div>

</div>
<img style="margin-left:10px" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG(substr(md5($eleve->id),0,10), 'C39',1,15)); ?>" >
<div style="height:100%"></div>  
<?php else: ?> 
<div style="display:flex; padding:10px;clear:both;     padding-bottom: 0;  ">

<div  style="width: fit-content;">

<img width="40" style="" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG(substr(md5($eleve->id),0,10), 'QRCODE',4,4)); ?>"> 
<img width="40" style="margin-top: 5px ; display: flex;"  src="<?php echo e(url('/assets/images/logo.png')); ?>" >

</div>
<div   style="position:relative;margin-left:7px;    width: 100%;">
<h1 style="margin-bottom: 1rem;

font-family: Oswald,Helvetica Neue,Arial,sans-serif;
font-size: 18px;

color: rgba(57,68,77,.84);

margin: 0;">CARTE ETUDIANT</h1>
<h1 style="margin-bottom: 1rem;
font-family: Oswald,Helvetica Neue,Arial,sans-serif;
font-weight: 700;
margin-top:5px;
margin-bottom: 0px;

font-size: 14px;"><?php echo e($eleve->nom." ".$eleve->prenom); ?></h1>
  
  <div >
      <div  style="font-size: 10px; margin-bottom: 5px;">
        <span class="contact"><b>Classe:</b> <?php echo e($eleve->classe->nom); ?></span> <br>
        <span class="contact"><b>Date de naissance:</b> <?php echo e($eleve->age); ?></span> <br>
         <span class="contact"><b>Matricule:</b> <?php echo e($eleve->username); ?></span> <br>
     
  </div>
  </div>   
 
</div>

</div>
<img style="margin-left:10px" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG(substr(md5($eleve->id),0,10), 'C39',1,15)); ?>" >
<div style="height:100%"></div>  
<?php endif; ?><?php /**PATH D:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Admin/Etudiant/card.blade.php ENDPATH**/ ?>