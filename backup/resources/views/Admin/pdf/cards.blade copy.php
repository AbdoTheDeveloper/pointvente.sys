<html>
  
<head>
  <link rel="stylesheet" href="{{url('assets/css/app.css')}}" type="text/css" />
  
</head>
<body>
  
      @php ($i=0)
  
      @foreach ($eleves as $eleve)
      <div class="row" style="display:flex; padding:10px;clear:both;   ">

    <div class="col-md-3" style="">
    <img width="50" height="50" src="{{ url('/images/eleve/'.$eleve->img) }}" class="ounded img-responsive"> <br>
  <img width="50" style="margin-top: 5px" src="data:image/png;base64,{{DNS2D::getBarcodePNG(substr(md5($eleve->id),0,10), 'QRCODE',4,4)}}"> 
    </div>
    <div  class="col-md-9" style="position:relative;margin-left:15px;    width: 100%;">
          <h1 style="margin-bottom: 1rem;
          font-family: Oswald,Helvetica Neue,Arial,sans-serif;
          font-weight: 400;
          line-height: 2;
          color: rgba(57,68,77,.84);
          margin-bottom: 0px;
          margin-top: 25px;
          font-size: 12px;">{{$eleve->nom." ".$eleve->prenom}}</h1>
            
            <div class="font-a-icons">
                <div class="icon-group"  style="font-size: 10px; margin-bottom: 5px;">
                    <b>Tele: </b><span class="contact">{{$eleve->tele}}</span>
                <div class="icon-group" style="font-size: 10px; margin-bottom: 5px;">
                  <b>E-mail :</b> <a class="contact" href="mailto:{{$eleve->email}}" target="_top">{{$eleve->email}}</a>
                </div>
                 <div class="icon-group">
                    <p> {{$eleve->adress}}</p>
                </div>
            </div>
            </div>   
            <img style="position: absolute;top:0;right:10px;opacity: .6;" width="50" src="{{ url('/assets/images/logo.png') }}" class="ounded img-responsive">
         </div>
        
 </div>
 <img style="margin-left:10px" src="data:image/png;base64,{{DNS1D::getBarcodePNG(substr(md5($eleve->id),0,10), 'C39',1,15)}}" >
     <div style="height:100%"></div>  
  @endforeach
      
</body></html>