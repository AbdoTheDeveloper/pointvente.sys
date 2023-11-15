
   
   <style type="text/css">
     *{margin:0;padding:0;font-family: 'Arial Black', Gadget, sans-serif !important;}
    html{margin:0px 0px}
    body {
      font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif  !important;
    }
     @page {
        margin-top: 0;
        margin-bottom: 40px;
        }
      @media print  
        {
        a[href]:after {
        content: none !important;
         }
       
         
        #mainArea
        {
          padding-top: 72px !important;
        padding-bottom: 72px  !important;
        }
        }
   

table tr td
{
 border: 1px solid rgba(33,150,243,.85);
}
   </style>
</head>
<!-- MAIN CONTAINER -->
<body>

  <div id="drag" class="cv instaFade wrap" style="margin: 0px 5px !important;width: 100%">
    <div class="mainDetails" style="padding: 15px 25px;background: #f3f3f3;border: none !important">

    <table style="width: 100%">
       <tbody>
        <tr>
         
          <td style="width: 15%;">
              <center>
                <img src="{{public_path('images/eleve/'.$user->img) }}"  alt="{{$user->nom}}"  style="width: 120px; height: auto; -webkit-border-radius: 50%; border-radius: 50%;vertical-align: middle;" />
              <center>
          </td>
          <td style="width:60%;">
            <div style="height: 120px;text-align: center;padding: 10px">
                
                <center>
                  <h1 class="quickFade delayTwo" style='vertical-align: middle;line-height: normal;font-size: 1.5em;font-family: "Gudea", Helvetica, arial, sans-serif;text-align: center;'>{{$user->nom}}&nbsp;{{$user->prenom}}</h1>
                  <br>
                  <h4 class="quickFade delayThree"  style='vertical-align: middle;line-height: normal;font-size: 1.2em;font-family: "Gudea", Helvetica, arial, sans-serif;text-align: center;'>{{$user->classe->nom}}</h4>
                  <br>



                    @php
                    $date_naissance = $user->age;
                    $date_actuel = gmdate("Y-m-d");

                    $diff = abs(strtotime($date_actuel) - strtotime($date_naissance));

                    $years = floor($diff / (365*60*60*24));

                    @endphp

                   <h4 class="quickFade delayThree"  style='vertical-align: middle;line-height: normal;font-size: 1.2em;font-family: "Gudea", Helvetica, arial, sans-serif;text-align: center;'>{{$years." ans"}} </h4>


                </center>
            </div>
   

          </td>

          <td style="width: 25%;">
              
                <img src="{{public_path('images/certificat/'.$certificat) }}" title="Logo"   style=" width: 150px; height: auto; vertical-align: middle" />
             
          </td>

        </tr>
      </tbody>
       
    </table>
      
      
    </div>

    <div id="mainArea" class="quickFade delayFive" style="margin: 20px 5px !important;">


        @php($i=0)
      
        @foreach($array_parcours as $parcour_action)
      
              @php($i++)
              @php($color=($i==2) ?"#92d050":"#5b9bd5")
              <div style="border: 1px solid {{$color}};clear: both;background-color: {{$color}};display: flex;
  flex-direction: column; height: auto">
               
                <div style="width: 25%;float:left;color: white;vertical-align: middle; height: 100%;background-color: {{$color}}; clear:both;display: table;">
                  <div style="display: table-cell; vertical-align: middle;">
                      <center>
                          <h3 style='font-family: "Gudea", helvetica, arial, sans-serif; font-size: 13px !important; color: white;  text-transform: uppercase; letter-spacing: 1px;vertical-align: middle;'>
                          {{"- ".$parcour_action['parcour']['nom']->desc_parc}}</h3>
                          <h3 style='font-family: "Gudea", helvetica, arial, sans-serif; font-size: 13px !important; color: white;  text-transform: uppercase; letter-spacing: 1px;vertical-align: middle;'>
                          &nbsp;&nbsp;{{date('d/m/Y', strtotime($parcour_action['parcour']['nom']->updated_at))}}</h3>
                      <center>
                  </div>
                    
                </div>
                <div style="width:73%;float: right;background-color:#fff;border: 1px solid {{$color}}; clear:both;
    display:block;overflow: auto;">
                  <div style="height: auto;padding: 5px; ">
                        @foreach($parcour_action['parcour']['actions'] as $action )

                        <?php 
                         $desc=strip_tags($action->desc_act);
                        ?>

                        <h3 style="text-align: center;color:{{$color}};margin: 15px 0px; ">{{ $action->titre }}</h3>
                        <blockquote style="font-style: italic;margin: 5px 0; padding-left: 20px;">
                          <p>{{$desc}}</p>
                        </blockquote>
                        


                        

                        <h4 class="card-title" style='font-size: 1rem;font-family: Oswald,Helvetica Neue,Arial,sans-serif;font-weight: 400; line-height: 1.5; color:{{$color}};border: none;'>Liste des items</h4>
                    


                        <ol style="list-style: none;display: block;border: none;">
                          
                          @foreach($action->item_action as $ia )
                          <li class="comment" style="list-style: none;border: none;; margin-left: 10px;">
                            <div style="margin: 0; padding: 0;border: none;">
                              <h4 style='display: inline-block; font-size: 1em; font-family: "Merriweather", serif;border: none !important'>{{"- ".$ia->item->desc_Item}}</h4>
                             
                            </div>
                          </li>
                          @endforeach
                        
                        </ol>

                         @if($action->attachements->count()>0)
                          <h4 class="card-title"  style='   font-size: 1rem;font-family: Oswald,Helvetica Neue,Arial,sans-serif;font-weight: 400; line-height: 1.5; color: {{$color}};border: none;'>Attachement</h4>
                          <div class=" align-items-center">
                                  <ol style="list-style: none;display: block;">
                                    @foreach($action->attachements as $att)
                                
                                        @php( $file = "text_x16.png")
                                        @if(array_key_exists(strtolower($att->type_attach) ,$filetype))
                                            @php( $file = $filetype[strtolower($att->type_attach)])
                                        @else
                                             @php( $file = "text_x16.png")
                                        @endif
                                     
                                        <li class="comment" style="list-style: none;">
                                          <div style="margin: 0; padding: 0;">
                                           <a target="_blank" style="padding-right: 1em; padding-left: 1em;    display: inline-block;font-size: 1rem; font-weight: 500; text-align: center;text-decoration: none; background-color: transparent;margin-left: 10px;" href="{{$att->lien_attach}}" target="_blank" class="badge badge-white badge-pill">
                                         


                                             {{strlen($att->taille_attach) < 100 ? "- ".$att->taille_attach : "- ".substr($att->taille_attach,0,100) }}
                                          </a>
                                          </div>
                                        </li>
                                    @endforeach
                                  </ol>
                          </div>
                           @endif

                            @endforeach
                  </div>
         

                </div>

            </div>
         @endforeach

      
       
    </div>
  </div>
